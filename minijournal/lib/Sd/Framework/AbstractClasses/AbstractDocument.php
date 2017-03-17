<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\DocumentInterface;

/**
 * Classe AbstractDocument qui factorise les données et méthodes communes à tout type de document.
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocument implements DocumentInterface
{
    /**
     * Identifiant du document.
     * @var int $id
     */
    protected $id;

    /**
     * Titre du document.
     * @var string
     */
    protected $titre;

    /**
     * Date de création du document.
     * @var string
     */
    protected $dateCreation;

    /**
     * Constructeur de la classe AbstractDocument.
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
