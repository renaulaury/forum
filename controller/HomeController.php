<?php

namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class HomeController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $topicManager = new TopicManager;
        $topics = $topicManager->lastTopics();

        $categoryManager2 = new CategoryManager();

        $allTopics = $categoryManager2->allTopics();

        return [
            "view" => VIEW_DIR . "home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "topics" => $topics,
                "allTopics" => $allTopics
            ]
        ];
    }

    public function users()
    {
        $this->restrictTo("user");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR . "security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [
                "users" => $users
            ]
        ];
    }
}
