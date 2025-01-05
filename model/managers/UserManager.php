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

    public function isNicknameAvailable($nickname, $id)
    {
        $sql = "SELECT id_user 
            FROM user 
            WHERE nickname = :nickname AND id_user != :id";

        $result = DAO::select($sql, [
            "nickname" => $nickname,
            "id" => $id
        ]);

        return empty($result);
    }


    public function isEmailAvailable($email, $id)
    {
        $sql = "SELECT id_user 
        FROM user 
        WHERE email = :email AND id_user != :id"; //Evite de considérer l'id du user co comme un doublon

        $result = DAO::select($sql, [
            "email" => $email,
            "id" => $id
        ]);

        return empty($result);
    }

    public function updateProfile($id, $data)
    {
        $sql = "UPDATE user 
            SET nickname = :nickname, email = :email, password = :password 
            WHERE id_user = :id";

        return DAO::update($sql, [
            "nickname" => $data["nickname"],
            "email" => $data["email"],
            "password" => $data["password"],
            "id" => $id
        ]);
    }
}
