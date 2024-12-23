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

    public function lockTopic($id)
{
    // Vérifie si un user est connecté
    $user = \App\Session::getUser();
    if (!$user) {        
        // Si l'utilisateur n'est pas connecté, redirige vers la liste des topics de la catégorie
        $topicManager = new \Model\Managers\TopicManager();
        $topic = $topicManager->findOneById($id);
        
        if ($topic) {
            $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
        }
        return;
    }

    // Récup du topic
    $topicManager = new \Model\Managers\TopicManager();
    $topic = $topicManager->findOneById($id);

    if ($topic) {
        // Vérif si user = auteur
        if ($topic->getUserId() !== $user->getId()) {
            // Si user != auteur > liste des topics 
            $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
            return;
        }

        // Si user = auteur, change le statut du verrouillage
        $newLockStatus = $topic->getLocked() ? 0 : 1;
        $topicManager->updateLockStatus($id, $newLockStatus);

        // Redirige vers la liste des topics de la catégorie
        $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategory()->getId());
    } else {
       
        $this->redirectTo("home");
    }
}

    
}


