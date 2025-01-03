<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
use App\Session;

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
        $sql = "UPDATE user
                SET role = :newRole
                WHERE id_user = :id";

        return
            DAO::update($sql, [
                "newRole" => $newRole,
                "id" => $id
            ]);
    }

    public function updateBanTemp($id, $newRole, $reasonBanTemp, $precisionBanTemp, $dateEndBan)
    {
        $sql = "UPDATE user
                SET role = :newRole,
                    reasonBan = :reasonBan,
                    precisionBan = :precisionBan,
                    dateEndBan = :dateEndBan
                    WHERE id_user = :id";

        return
            DAO::update($sql, [
                "newRole" => $newRole,
                "reasonBan" => $reasonBanTemp,
                "precisionBan" => $precisionBanTemp,
                "dateEndBan" => $dateEndBan,
                "id" => $id
            ]);
    }

    public function updateBanDef($id, $newRole, $reasonBanDef, $precisionBanDef, $dateEndBan)
    {
        $sql = "UPDATE user
                SET role = :newRole,
                    reasonBan = :reasonBan,
                    precisionBan = :precisionBan,
                    dateEndBan = :dateEndBan
                    WHERE id_user = :id";

        return
            DAO::update($sql, [
                "newRole" => $newRole,
                "reasonBan" => $reasonBanDef,
                "precisionBan" => $precisionBanDef,
                "dateEndBan" => $dateEndBan,
                "id" => $id
            ]);
    }
}
