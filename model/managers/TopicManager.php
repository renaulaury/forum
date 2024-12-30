<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct()
    {
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id)
    {

        $sql = "SELECT *
                FROM " . $this->tableName . " t 
                WHERE t.category_id = :id
                ORDER BY topicCreation DESC";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function updateLockStatus(int $id, int $status)
    {
        $sql = "UPDATE " . $this->tableName . " 
                SET locked = :status 
                WHERE id_topic = :id";

        $params = [
            'status' => $status,
            'id' => $id
        ];

        return DAO::update($sql, $params);
    }

    public function updateTopicsForDeletedUser(int $userId)
    {
        // Maj des topics post user delete
        $sql = "UPDATE topic 
            SET user_id = NULL
            WHERE user_id = :userId";

        // Remplacer par "Utilisateur supprimé"
        return DAO::update($sql, [
            'userId' => $userId
        ]);
    }

    public function lastTopics()
    {
        $sql = "SELECT user.nickname, topicTitle, topicCreation, COUNT(postMsg) AS nbPost
                FROM topic
                LEFT JOIN post ON topic.id_topic = post.topic_id                
                LEFT JOIN user ON topic.user_id = user.id_user
                GROUP by user.nickname, topicTitle, topicCreation
                ORDER BY topicCreation DESC
                LIMIT 3";


        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
}
