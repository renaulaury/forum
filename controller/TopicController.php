<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class TopicController extends AbstractController implements ControllerInterface{

    public function listTopicsByCategory(int $id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."topic/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : " .$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function addTopic(int $id) {

        $topicManager = new TopicManager();

        $topicTitle = filter_input(INPUT_POST, 'topicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($topicTitle && $textTopic) {
          
            $topicManager->add([
                "topicTitle" => $topicTitle,
                "textTopic" => $textTopic, 
                "category_id" => $id,
                "user_id" => 1                
            ]);
        } 

        $this->redirectTo("topic", "listTopicsByCategory", $id);
        exit();

    }
}
