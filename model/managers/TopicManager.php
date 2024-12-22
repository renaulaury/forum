<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT *
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id
                ORDER BY topicCreation DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function lockTopic($id, $lockStatus) {
        $sql = "UPDATE " . $this->tableName . " 
                SET locked = :locked 
                WHERE id = :id";
        
        
        DAO::update($sql, ['id' => $id, 'locked' => $lockStatus]);
    }

    public function canLock($user, $topic) {
        // if user admin ou auteur
        if ($user->getRole() === 'admin') {
            // user = admin -> lock
            return true;
        } elseif ($user->getId() === $topic->getUserId()) {
            // user = auteur -> lock
            return true;
        } else {
            // user != admin/auteur -> no lock
            return false;
        }
    }
    
    
}