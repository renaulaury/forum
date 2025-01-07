<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct()
    {
        parent::connect();
    }

    public function allTopics()
    {
        $sql = "SELECT typeCategory, COUNT(textTopic) AS nbTopic
                FROM topic
                INNER JOIN category ON topic.category_id = category.id_category
                GROUP BY typeCategory
                ORDER BY typeCategory DESC";


        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
}
