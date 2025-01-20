<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class PostController extends AbstractController implements ControllerInterface
{

    public function listPostsByTopic($id)
    {

        $postManager = new PostManager();
        $topicManager = new TopicManager();

        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);
        $profile = null;

        if (isset($_SESSION['user'])) {
            $id_SESSION = $_SESSION['user']->getId();
            $userManager = new UserManager();
            $profile = $userManager->findOneById($id_SESSION);

            return [
                "view" => VIEW_DIR . "post/listPosts.php",
                "meta_description" => "Liste des posts par topic : " . $topic->getTopicTitle(),
                "data" => [
                    "topic" => $topic,
                    "posts" => $posts,
                    "profile" => $profile
                ]
            ];
        } else {
            return [
                "view" => VIEW_DIR . "post/listPostsVisitor.php",
                "meta_description" => "Liste des posts par topic : " . $topic->getTopicTitle(),
                "data" => [
                    "topic" => $topic,
                    "posts" => $posts
                ]
            ];
        }
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
        $text = $_POST['postMsg'] ?? null;

        if ($text) {
            $postManager->add([
                'postMsg' => $text,
                'topic_id' => $id,
                'user_id' => \App\Session::getUser()->getId(),
            ]);
            $this->redirectTo("post", "listPostsBytopic", $id);
        } else {
            \App\Session::addFlash('error', 'Le contenu du message ne peut pas être vide.');
            $this->redirectTo("post", "listPostsBytopic", $id);
        }
    }
}
