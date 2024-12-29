<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class TopicController extends AbstractController implements ControllerInterface
{

    public function listTopicsByCategory(int $id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);



        return [
            "view" => VIEW_DIR . "topic/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : " . $category->getTypeCategory(),
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }


    public function addTopic(int $id)
    {

        $topicManager = new TopicManager();
        $session = new Session();

        $topicTitle = filter_input(INPUT_POST, 'topicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($topicTitle && $textTopic && $session::getUser()) {
            $user = $session::getUser(); //Récup l id du user connecté
            $userId = $user->getId();

            $topicManager->add([
                "topicTitle" => $topicTitle,
                "textTopic" => $textTopic,
                "category_id" => $id,
                "user_id" => $userId
            ]);
        }

        $this->redirectTo("topic", "listTopicsByCategory", $id);
        exit();
    }

    public function lockTopic(int $id)
    {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $session = new Session();

        if ($session->getUser()) { // si user co
            if ($topic->getUser()->getId() == $session->getUser()->getId() || $session->getUser()->isAdmin()) {
                $newLockStatus = $topic->getLocked() ? 0 : 1;
                $topicManager->updateLockStatus($id, $newLockStatus);
            }

            $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
        }
    }
}
