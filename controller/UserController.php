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

    public function listUsers()
    {
        $id = $_SESSION['user']->getId();

        $userManager = new UserManager();
        $profile = $userManager->findOneById($id);
        $listUsers = $userManager->findAll(['level', 'ASC']);

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
            $reasonBan = $_POST['banTemp'];
            $precisionBan = $_POST['raison'];

            //Ils doivent être obligatoirement renseigné
            if (empty($reasonBan) || empty($precisionBan)) {
                Session::addFlash("error", "Pour un bannissement, tous les champs doivent être renseignés.");
                $this->redirectTo("user", "listUsers");
                return;
            } else {
                // Récup user pour maj dateEndBan
                $user = $updateUser->findOneById($id);
                $user->setDateEndBan(); // Maj dateEndBan dans bdd

                // Now maj infos du ban
                $updateUser->updateBanInfo($id, $newRole, $reasonBan, $precisionBan); // Maj bdd

                Session::addFlash("success", "Le bannissement temporaire a bien été mis en place");
            }
        } else if ($newRole === "Banni Définitivement") {

            "jsuis banni pour toujours à jamais";
            Session::addFlash("success", "Le bannissement définitif a bien été mis en place");
        } else {

            $role = $updateUser->updateRoleForUser($id, $newRole);

            Session::addFlash("success", "Le role a bien été modifié");
        }


        $this->redirectTo("user", "listUsers");
        exit();
    }
}
