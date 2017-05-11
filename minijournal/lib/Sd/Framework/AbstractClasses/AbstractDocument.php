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
     * Auteur du document
     * @var string
     */
    protected $auteur;

    /**
     * Date de création du document.
     * @var string
     */
    protected $dateCreation;

    /**
     * Constructeur de la classe AbstractDocument.
     * @param $id
     * @param $titre
     * @param $auteur
     * @param $dateCreation
     */
    protected function __construct($id, $titre, $auteur, $dateCreation)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
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
