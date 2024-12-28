<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;



class UserController
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

    public function deleteProfile()
    {
        return [
            "view" => VIEW_DIR . "user/profile.php",
            "meta_description" => "Suppression du profil",
            // "data" => [
            //     'listUsers' => $listUsers
            // ]
        ];
    }
}
