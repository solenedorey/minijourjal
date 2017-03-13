<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocument;

class Image extends AbstractDocument
{
    private $auteur;
    private $fichier;

    public function __construct(
        $idImage,
        $titre,
        $auteur,
        $fichier,
        $dateCreation
    ) {
        parent::__construct($idImage, $titre, $dateCreation);
        $this->auteur = $auteur;
        $this->fichier = $fichier;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    public static function creerDocumentVide()
    {
        return new self("", "", "", "", "");
    }

    public static function creerDepuisTableau($data)
    {
        $titre = isset($data['titre']) && $data['titre'] != '' ? $data['titre'] : '';
        $auteur = isset($data['auteur']) && $data['auteur'] != '' ? $data['auteur'] : '';
        $fichier = isset($data['fichier']) && $data['fichier'] != '' ? $data['fichier'] : '';
        $dateCreation = date('Y-m-d', time());
        return new self(null, $titre, $auteur, $fichier, $dateCreation);
    }

    public function modifierDepuisTableau($data)
    {
        if (isset($data['titre'])) {
            $this->setTitre($data['titre']);
        }
        if (isset($data['auteur'])) {
            $this->setAuteur($data['auteur']);
        }
        if (isset($data['fichier'])) {
            $this->setFichier($data['fichier']);
        }
    }
}
