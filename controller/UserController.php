<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;


class UserController extends AbstractController
{
    public function profile()
    {
        $id = $_SESSION['user']->getId();
        $userManager = new UserManager();
        $profile = $userManager->findOneById($id);


        return [
            "view" => VIEW_DIR . "user/profile.php",
            "meta_description" => "Profil de l'utilisateur",
            "data" => [
                "profile" => $profile
            ]
        ];
    }

    public function editProfile()
    {
        $userManager = new UserManager();
        $errorMessage = null;

        // Vérifier si un utilisateur est connecté
        if (!Session::getUser()) {
            Session::addFlash("error", "Vous devez être connecté pour modifier votre profil.");
            $this->redirectTo("security", "login");
            exit();
        }

        $user = Session::getUser();

        if (isset($_POST["submit"])) {
            // Filtrer les données
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newPassword = filter_input(INPUT_POST, "newPassword", FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/")));
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Vérifier si des informations ont été soumises
            if ($nickname || $email || $password || $newPassword || $confirmPassword) {
                // Vérification des informations du profil
                $isEmailAvailable = $email && $userManager->isEmailAvailable($email, $user->getId());
                $isNicknameAvailable = $nickname && $userManager->isNicknameAvailable($nickname, $user->getId());

                // Si un mot de passe est soumis, vérifier sa validité
                if ($password && !$newPassword) {
                    $errorMessage = "Veuillez entrer un nouveau mot de passe.";
                } else if ($newPassword && $confirmPassword) {
                    // Vérifier que les mots de passe correspondent
                    if ($newPassword !== $confirmPassword) {
                        $errorMessage = "Les mots de passe ne correspondent pas.";
                    }
                }

                // Si tout est valide, mettre à jour le profil
                if (!$errorMessage) {
                    // Mise à jour des champs modifiés
                    $updateData = [];
                    if ($nickname && $isNicknameAvailable) {
                        $updateData['nickname'] = $nickname;
                        $user->setNickname($nickname); // Mettre à jour dans la session
                    }
                    if ($email && $isEmailAvailable) {
                        $updateData['email'] = $email;
                        $user->setEmail($email); // Mettre à jour dans la session
                    }
                    if ($newPassword) {
                        $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT); // Hacher le mot de passe
                        $user->setPassword($newPassword); // Mettre à jour dans la session
                    }

                    // Si des données ont été mises à jour, les enregistrer dans la base
                    if (!empty($updateData)) {
                        $userManager->updateProfile($user->getId(), $updateData);
                        Session::setUser($user); // Mettre à jour la session avec les nouvelles informations

                        Session::addFlash("success", "Votre profil a été mis à jour avec succès.");
                        $this->redirectTo("user", "profile");
                    } else {
                        $errorMessage = "Aucune modification n'a été effectuée.";
                    }
                }
            } else {
                $errorMessage = "Tous les champs doivent être remplis correctement.";
            }
        }

        return [
            "view" => VIEW_DIR . "user/profile.php",
            "meta_description" => "Profil de l'utilisateur",
            "data" => [
                "user" => $user,
                "errorMessage" => $errorMessage,
            ]
        ];
    }


    public function listUsers()
    {
        $id = $_SESSION['user']->getId();

        $userManager = new UserManager();
        $profile = $userManager->findOneById($id);
        $listUsers = $userManager->findAll(['nickname', 'ASC']);

        return [
            "view" => VIEW_DIR . "user/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [
                'listUsers' => $listUsers,
                "profile" => $profile
            ]
        ];
    }

    public function verifDeleteProfile()
    {
        $userManager = new UserManager;
        $profile = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "user/deleteProfile.php",
            "meta_description" => "Confirmation de suppression du profil",
            "data" => [
                "profile" => $profile,
            ]
        ];
    }

    public function deleteProfile()
    {
        $userManager = new UserManager();
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $id = $_SESSION['user']->getId();
        $nickname = $_SESSION['user']->getNickname();

        // Remplacer le nom du user et maj topics & posts
        $topicManager->updateTopicsForDeletedUser($id, "Utilisateur supprimé");
        $postManager->updatePostsForDeletedUser($id, "Utilisateur supprimé");

        // Delete user
        $userManager->delete($id);

        Session::addFlash("success", "Votre compte a été supprimé avec succès.");

        $this->redirectTo("security", "logout");
        exit();
    }

    public function editRole($id)
    {
        $userManager = new UserManager;
        $listUsers = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR . "user/editRole.php",
            "meta_description" => "Edition du rôle d'un membre",
            "data" => [
                'listUsers' => $listUsers,
            ]
        ];
    }

    public function updateRole($id)
    {

        $id = $_POST['id'];
        $newRole = $_POST['option'];

        $updateUser = new UserManager;


        if ($newRole === "Banni Temporairement") {
            // Récup raison et précision du ban
            $reasonBanTemp = $_POST['banTemp'];
            $precisionBanTemp = $_POST['precisionBanTemp'];

            //Ils doivent être obligatoirement renseigné
            if (empty($reasonBanTemp) || empty($precisionBanTemp)) {
                Session::addFlash("error", "Pour un bannissement, tous les champs doivent être renseignés.");
                $this->redirectTo("user", "listUsers");
                return;
            } else {
                // Récup user pour maj dateEndBan
                $user = $updateUser->findOneById($id);
                $dateEndBan = $user->setDateEndBan(true); // Maj dateEndBan dans bdd

                // Now maj infos du ban
                $updateUser->updateBanTemp($id, $newRole, $reasonBanTemp, $precisionBanTemp, $dateEndBan); // Maj bdd

                Session::addFlash("success", "Le bannissement temporaire a bien été mis en place");
            }
        } else if ($newRole === "Banni Définitivement") {
            // Récup raison et précision du ban
            $reasonBanDef = $_POST['banDef'];
            $precisionBanDef = $_POST['precisionBanDef'];

            //Ils doivent être obligatoirement renseigné
            if (empty($reasonBanDef) || empty($precisionBanDef)) {
                Session::addFlash("error", "Pour un bannissement, tous les champs doivent être renseignés.");
                $this->redirectTo("user", "listUsers");
                return;
            } else {
                // Récup user pour maj dateEndBan
                $user = $updateUser->findOneById($id);
                $dateEndBan = $user->setDateEndBan(false); // Maj dateEndBan dans bdd

                // Now maj infos du ban
                $updateUser->updateBanDef($id, $newRole, $reasonBanDef, $precisionBanDef, $dateEndBan); // Maj bdd

                Session::addFlash("success", "Le bannissement définitif a bien été mis en place");
            }
        } else {

            $role = $updateUser->updateRoleForUser($id, $newRole);

            Session::addFlash("success", "Le role a bien été modifié");
        }


        $this->redirectTo("user", "listUsers");
        exit();
    }
}
