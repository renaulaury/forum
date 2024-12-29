<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct()
    {
        parent::connect();
    }

    public function findPostsByTopic($id)
    {

        $sql = "SELECT *
                FROM " . $this->tableName . " t
                WHERE t.topic_id = :id
                ORDER BY postCreation DESC ";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function updatePostsForDeletedUser($userId, $newNickname)
    {
        // Maj des topics post user delete
        $sql = "UPDATE post 
            SET user_id = NULL
            WHERE user_id = :userId";

        // Remplacer par "Utilisateur supprimé"
        return DAO::update($sql, [
            'userId' => $userId
        ]);
    }
}
