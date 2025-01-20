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

    public function checkBanStatus($userId)
    {
        $user = $this->findOneById($userId);

        // User est ban temp
        if ($user->getRole() === 'Banni temporairement') {
            $dateEndBan = new \DateTime($user->getDateEndBan());
            $now = new \DateTime();

            // Si la date de fin de ban est dépassée, on réévalue le rôle de l'utilisateur
            if ($dateEndBan < $now) {
                // Réinitialiser les champs de bannissement
                $this->clearBan($userId);

                // New role user
                $user->setRole('Utilisateur');

                // Maj role dans bdd
                $this->updateRoleForUser($userId, 'Utilisateur');
            }
        }
    }

    public function clearBan($id)
    {
        $sql = "UPDATE user
            SET reasonBan = NULL,
                precisionBan = NULL,
                dateEndBan = NULL
            WHERE id_user = :id";

        return DAO::update($sql, ["id" => $id]);
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


    public function updateNickname($id, $nickname)
    {
        $sql = "UPDATE user SET nickname = :nickname WHERE id_user = :id";

        return DAO::update($sql, [
            "nickname" => $nickname,
            "id" => $id
        ]);
    }

    public function updateEmail($id, $email)
    {
        $sql = "UPDATE user 
                SET email = :email 
                WHERE id_user = :id";

        return DAO::update($sql, [
            "email" => $email,
            "id" => $id
        ]);
    }

    public function updatePassword($id, $password)
    {
        $sql = "UPDATE user 
                SET password = :password 
                WHERE id_user = :id";

        return DAO::update($sql, [
            "password" => $password,
            "id" => $id
        ]);
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
