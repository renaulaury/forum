<?php

namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Category extends Entity
{

    private $id;
    private $typeCategory;
    private $sortCategory;
    private $nbTopic;

    // chaque entité aura le même constructeur grâce à la méthode hydrate (issue de App\Entity)
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
     * Get the value of category
     */
    public function getTypeCategory()
    {
        return $this->typeCategory;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setTypeCategory($typeCategory)
    {
        $this->typeCategory = $typeCategory;
        return $this;
    }

    /**
     * Get the value of sortCategory
     */
    public function getSortCategory()
    {
        return $this->sortCategory;
    }

    /**
     * Set the value of sortCategory
     *
     * @return  self
     */
    public function setSortCategory($sortCategory)
    {
        $this->sortCategory = $sortCategory;

        return $this;
    }

    public function __toString()
    {
        return $this->typeCategory;
    }

    /**
     * Get the value of nbTopic
     */
    public function getNbTopic()
    {

        return $this->nbTopic;
    }

    /**
     * Set the value of nbTopic
     *
     * @return  self
     */
    public function setNbTopic($nbTopic)
    {
        $this->nbTopic = $nbTopic;

        return $this;
    }
}
