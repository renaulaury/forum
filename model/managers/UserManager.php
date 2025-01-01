<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct()
    {
        parent::connect();
    }

    public function findOneByEmail($email)
    {

        $sql = "SELECT *
                FROM " . $this->tableName . " t
                WHERE t.email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }

    public function findOneByNickname($nickname)
    {

        $sql = "SELECT *
                FROM " . $this->tableName . " t
                WHERE t.nickname = :nickname";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['nickname' => $nickname], false),
            $this->className
        );
    }

    public function findOneById($id)
    {
        $sql = "SELECT * 
                FROM " . $this->tableName . "
                WHERE id_user = :id";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], false),
            $this->className
        );
    }

    public function updateRoleForUser($id, $newRole)
    {
        // Vérifie si les paramètres sont corrects
        if (empty($id) || empty($newRole)) {
            var_dump("Erreur : ID ou rôle manquant");
            return false;
        }

        $sql = "UPDATE user SET role = :newRole WHERE id_user = :id";

        // Debug : Affiche la requête et les paramètres
        var_dump($sql);
        var_dump(['newRole' => $newRole, 'id' => $id]);
        die;

        try {
            return DAO::update($sql, [
                "newRole" => $newRole,
                "id" => $id
            ]);
        } catch (\Exception $e) {
            var_dump('Erreur SQL: ' . $e->getMessage());
            return false;
        }
    }
}
