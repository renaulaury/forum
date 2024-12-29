<?php

namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity
{

    private $id;
    private $topicTitle;
    private $user;
    private $category;
    private $textTopic;
    private $topicCreation;
    private $locked;
    private $userId;
    private $nbPost;

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
     * Get the value of title
     */
    public function getTopicTitle()
    {
        return $this->topicTitle;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTopicTitle($topicTitle)
    {
        $this->topicTitle = $topicTitle;
        return $this;
    }

    public function getTextTopic()
    {
        return $this->textTopic;
    }

    public function setTextTopic($textTopic)
    {
        $this->textTopic = $textTopic;
        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTopicCreation()
    {
        return $this->topicCreation;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTopicCreation($topicCreation)
    {
        $this->topicCreation = $topicCreation;
        return $this;
    }

    public function getTopicCreationFr()
    {
        $date = new \DateTime($this->topicCreation);
        return $date->format("d-m-y à H:i");
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }


    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        $this;
    }

    public function getCategoryId()
    {
        // Vérifie si la catégorie est un objet ou déjà un ID
        return is_object($this->category) ? $this->category->getId() : $this->category;
    }

    public function getCategoryType()
    {
        return $this->category->getTypeCategory();
    }


    /**
     * Get the value of locked
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set the value of locked
     *
     * @return  self
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }




    /**
     * Set the value of nbPost
     *
     * @return  self
     */
    public function setNbPost($nbPost)
    {
        $this->nbPost = $nbPost;

        return $this;
    }

    /**
     * Get the value of nbPost
     */
    public function getNbPost()
    {
        return $this->nbPost;
    }


    public function __toString()
    {
        return $this->topicTitle;
    }
}
