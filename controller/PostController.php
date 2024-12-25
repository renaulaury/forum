<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class PostController extends AbstractController implements ControllerInterface{

    public function listPostsByTopic($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();        
        $categoryManager = new CategoryManager();

        $topic = $topicManager->findOneById($id);
        $category = $categoryManager->findOneById($topic->getCategoryType());
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."post/listPosts.php",
            "meta_description" => "Liste des posts par topic : " .$topic->getTopicTitle(),
            "data" => [
                "topic" => $topic,
                "category_id" => $id,
                "posts" => $posts
            ]
        ];
    }

    

    public function addPost($id)
{
    $topicManager = new TopicManager();
    $topic = $topicManager->findOneById($id);

    if ($topic->getLocked()) {
        // Si topic verr :
        \App\Session::addFlash('error', 'Ce sujet est verrouillé. Vous ne pouvez pas poster de message.');
        $this->redirectTo("topic", "listTopicsByCategory", $topic->getCategoryId());
        return;
    }

    // Sinon, add post
    $postManager = new PostManager();
    $text = $_POST['content'] ?? null;

    if ($text) {
        $postManager->add([
            'content' => $text,
            'topic_id' => $id,
            'user_id' => \App\Session::getUser()->getId(),
        ]);
        $this->redirectTo("topic", "viewTopic", $id);
    } else {
       
        $this->redirectTo("topic", "viewTopic", $id);
    }
}

}
