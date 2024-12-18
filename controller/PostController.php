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
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."post/listPosts.php",
            "meta_description" => "Liste des posts par topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function addPost($id) {

        $postManager = new PostManager();

        $postMsg = filter_input(INPUT_POST, 'postMsg', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($postMsg) {
            $postManager->add([
                "postMsg" => $postMsg, 
                "user_id" => 1,
                "topic_id" => $id
            ]);
        } 

        $this->redirectTo("post", "listPostsByTopic", $id);
        // header("Location: index.php?forum&action=listPostsByTopic");
        exit();

    }
}
