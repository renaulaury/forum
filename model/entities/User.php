<?php

namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class User extends Entity
{

    private $id;
    private $nickname;
    private $mail;
    private $password;
    private $role;
    // private $nbTopics;
    // private $nbPosts;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of nickName
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function __toString()
    {
        return $this->nickname;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    // La méthode explode(',',$this->role) découpe la chaîne de caractères contenue dans la propriété $this->role
    // Ensuite, la fonction in_array vérifie si le rôle spécifié est présent dans ce tableau de rôles.
    public function hasRole($role)
    {
        return in_array($role, explode(',', $this->role));
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrateur');
    }
}
