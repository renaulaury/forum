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
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["typeCategory", "DESC"]);


        $topicManager = new TopicManager;
        $topics = $topicManager->lastTopics();


        return [
            "view" => VIEW_DIR . "home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "categories" => $categories,
                "topics" => $topics
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
