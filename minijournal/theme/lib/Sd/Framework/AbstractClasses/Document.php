<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\DocumentInterface;

abstract class Document implements DocumentInterface
{
    protected $id;
    protected $titre;
    protected $dateCreation;

    protected function __construct($id, $titre, $dateCreation)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->dateCreation = $dateCreation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }
}
