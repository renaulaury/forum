<?php

namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use App\Session;

class SecurityController extends AbstractController
{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register()
    {
        $user = new UserManager();
        $errorMessage = null;

        if (isset($_POST["submit"])) {           

            //on filtre
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/")));
            // ^: debut de chaine, $ : fin de chaine, (?=.*[A-Z]) : lettres, (?=.*\d) : digit, (?=.*[\W_]) : caracteres speciaux, {12,} : 12 caracteres
            $password2 = filter_input(INPUT_POST, "password2", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/")));
            $terms = isset($_POST['terms']) ? true : false;  // Vérifie si la case est cochée

            if (!$terms) {
                $errorMessage = "Vous devez accepter les termes et conditions pour vous inscrire.";
            }

            //on les vérifie
            if (!$errorMessage && $nickname && $email && $password1 && $password2) {

                $verifyNickname = $user->findOneByNickname($nickname);
                $verifyEmail = $user->findOneByEmail($email);

                if (!$verifyNickname && !$verifyEmail) { //Vérification si l'un ou l'autre n'existe pas en bdd
                    // add in bdd
                    if ($password1 == $password2 && strlen($password1) >= 12) {
                        $user->add([
                            "nickname" => $nickname,
                            "email" => $email,
                            "password" => password_hash($password1, PASSWORD_DEFAULT)
                        ]);

                        Session::addFlash("success", "Compte créé avec succès. Veuillez vous connecter.");
                        $this->redirectTo("security", "login");
                        exit();
                    } else {
                        $errorMessage = "Les mots de passe ne correspondent pas ou sont trop faibles.";
                    }
                } else {
                    $errorMessage = $verifyNickname
                        ? "Ce pseudo est déjà utilisé."
                        : "Cette adresse email est déjà enregistrée.";
                }
            } else {
                $errorMessage = "Tous les champs doivent être remplis correctement et 
                vous devez accepter les termes et conditions pour vous inscrire.";
            }
        }               

        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "Enregistrement",
            "data" => [
                "errorMessage" => $errorMessage,  // Transmission de l'erreur à la vue
            ]
            
        ];
    }



    public function login()
    {
        // session

        $session = new Session();
        $userManager = new UserManager();
        $errorMessage = null;

        //on filtre
        if (isset($_POST['submit'])) {
             // Vérification du token CSRF
            if (
                !isset($_POST['csrf_token']) ||
                !isset($_SESSION['csrf_token']) ||
                $_POST['csrf_token'] !== $_SESSION['csrf_token']
            ) {
                $errorMessage = "Échec de sécurité : jeton CSRF invalide.";
            } else {
                unset($_SESSION['csrf_token']); // Invalide le token après vérif
            }


            // Si pas d'erreur CSRF, on continue
            if (!$errorMessage) {
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                //on les verifie
                if ($email && $password) {
                    $user = $userManager->findOneByEmail($email);

                    //on vérifie empreinte numérique et on ouvre la session
                    if ($user) {
                        $hash = $user->getPassword();
                        if (password_verify($password, $hash)) {
                            // Vérification du statut de bannissement
                            $this->checkBanStatus($user->getId());

                            //Si user validé, ouverture session
                            $session->setUser($user);

                            $this->redirectTo("home", "home");
                            exit();
                        } else {
                            $errorMessage = "Mot de passe incorrect.";
                        }
                    } else {
                        $errorMessage = "Utilisateur non trouvé.";
                    }
                } else {
                    $errorMessage = "Veuillez remplir correctement les champs.";
                }
            }
        }

        // Génération du token CSRF
            $csrfToken = bin2hex(random_bytes(32)); //32o aléatoires convertit en chaine hexadéc
            $_SESSION['csrf_token'] = $csrfToken; //Stocké en session

        return [
            "view" => VIEW_DIR . "security/login.php",
            "meta_description" => "Login to the forum",
            "data" => [
                "errorMessage" => $errorMessage,                
                "csrfToken" => $csrfToken
            ]
        ];
    }



    public function logout()
    {
        unset($_SESSION["user"]);

        return [
            "view" => VIEW_DIR . "security/login.php",
            "meta_description" => "Login to the forum"
        ];
    }

    public function checkBanStatus($id)
    {
        // Récup user
        $updateUser = new UserManager();
        $user = $updateUser->findOneById($id);

        // Si user est banni temporairement
        if ($user->getRole() === 'Banni Temporairement') {
            $dateEndBan = new \DateTime($user->getDateEndBanVo());
            $currentDate = new \DateTime('now', new \DateTimeZone('Europe/Paris'));

            // Si la date de fin de bannissement est dépassée
            if ($dateEndBan <= $currentDate) {
                // Réactiver le rôle en tant qu'utilisateur
                $updateUser->updateRoleForUser($id, 'Utilisateur');
                Session::addFlash("success", "Le bannissement temporaire a pris fin, votre rôle a été réactivé.");
            }
        }
    }
}
