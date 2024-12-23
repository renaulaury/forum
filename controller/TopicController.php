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
        
        
        // Récup session et user pour locked
        $session = new \App\Session();
        $user = $session->getUser();
        
        // // Récup datas pour locked
        // $topicsLock = [];
        // foreach ($topics as $topic) {
        //     $canLock = $this->canLockTopic($user, $topic);
        //     $topicsLock[] = [
        //         'topic' => $topic,
        //         'canLock' => $canLock
        //     ];
        
    
        return [
            "view" => VIEW_DIR."topic/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : " . $category->getTypeCategory(),
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }
    

    public function addTopic(int $id) {

        $topicManager = new TopicManager();
        $session = new \App\Session();

        $topicTitle = filter_input(INPUT_POST, 'topicTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($topicTitle && $textTopic && $session->getUser()) {
            $user = $session->getUser(); //Récup l id du user connecté
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

    public function lockTopic(int $id) {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);  // Trouver le topic avec ID
    
        $session = new \App\Session();
        $user = $session->getUser();
    
        // si admin ou auteur
        if ($this->canLockTopic($user, $topic)) {
            if ($topic->getLocked()) {
                $newLockStatus = 0; // Déverrouiller si le topic est actuellement verrouillé
            } else {
                $newLockStatus = 1; // Verrouiller si le topic n'est pas encore verrouillé
            }
            $topicManager->updateLockStatus($topic, $newLockStatus);  // Maj dans BDD
        }
    
        
        $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategoryId());
    }
    
    // User droit locked ?
    // public function canLockTopic($user, $topic) {
    // // user admin ou auteur
    // if ($user->isAdmin()) {
    //     return true;
    // } else {
    //     if ($user->getId() === $topic->getUserId()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}


