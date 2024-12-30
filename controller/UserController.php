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

        $userManager = new UserManager();
        $listUsers = $userManager->findAll(['nickname', 'ASC']);

        return [
            "view" => VIEW_DIR . "user/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [
                'listUsers' => $listUsers
            ]
        ];
    }

    public function verifDeleteProfile()
    {
        $id = $_SESSION['user']->getId();
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
}
