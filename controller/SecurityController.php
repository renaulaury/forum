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
            $password2 = filter_input(INPUT_POST, "password1", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/")));

            //on les vérifie
            if ($nickname && $email && $password1 && $password2) {

                $verifyNickname = $user->findOneByNickname($nickname);
                $verifyEmail = $user->findOneByEmail($email);

                if (!$verifyNickname && !$verifyEmail) { //Vérification si l'un ou l'autre n'existe pas  en bdd
                    // add in bdd
                    if ($password1 == $password2 && strlen($password1) >= 4) {
                        $user->add([
                            "nickname" => $nickname,
                            "email" => $email,
                            "password" => password_hash($password1, PASSWORD_DEFAULT)
                        ]);
                    } else {
                        $errorMessage = "Mot de passe incorrect.";
                    }
                } else {
                    $errorMessage = "Utilisateur non trouvé.";
                }
            }
        }

        return [
            "view" => VIEW_DIR . "security/register.php",
            "meta_description" => "Enregistrement",
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

            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //on les verifie
            if ($email && $password) {
                $user = $userManager->findOneByEmail($email);

                //on vérifie empreinte numérique et on ouvre la session
                if ($user) {
                    $hash = $user->getPassword();
                    if (password_verify($password, $hash)) {
                        $session->setUser($user);

                        $this->redirectTo("forum", "listCategories");
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


        return [
            "view" => VIEW_DIR . "security/login.php",
            "meta_description" => "Login to the forum"
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
}
