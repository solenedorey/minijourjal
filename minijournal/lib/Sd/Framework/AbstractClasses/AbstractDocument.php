<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\DocumentInterface;

/**
 * Class AbstractDocument
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocument implements DocumentInterface
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $titre;
    /**
     * @var
     */
    protected $dateCreation;

    /**
     * AbstractDocument constructor.
     * @param $id
     * @param $titre
     * @param $dateCreation
     */
    protected function __construct($id, $titre, $dateCreation)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
}
