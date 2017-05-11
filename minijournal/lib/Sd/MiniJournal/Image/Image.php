<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocument;

/**
 * Classe Image
 * @package Sd\MiniJournal\Image
 */
class Image extends AbstractDocument
{
    /**
     * @var
     */
    private $fichier;

    /**
     * Constructeur de la classe Image.
     * @param $idImage
     * @param $titre
     * @param $auteur
     * @param $fichier
     * @param $dateCreation
     */
    public function __construct(
        $idImage,
        $titre,
        $auteur,
        $fichier,
        $dateCreation
    ) {
        parent::__construct($idImage, $titre, $auteur, $dateCreation);
        $this->fichier = $fichier;
    }

    /**
     * @return mixed
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * @param $fichier
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * Permet d'instancier une nouvelle image vide.
     * @return Image
     */
    public static function creerDocumentVide()
    {
        return new self("", "", "", "", "");
    }

    /**
     * Permet d'instancier une nouvelle image depuis les valeurs d'un tableau.
     * @param $data
     * @return Image
     */
    public static function creerDepuisTableau($data)
    {
        $titre = isset($data['titre']) && $data['titre'] != '' ? $data['titre'] : '';
        $auteur = isset($data['auteur']) && $data['auteur'] != '' ? $data['auteur'] : '';
        $fichier = isset($data['fichier']) && $data['fichier'] != '' ? $data['fichier'] : '';
        $dateCreation = date('Y-m-d', time());
        return new self(null, $titre, $auteur, $fichier, $dateCreation);
    }

    /**
     * Permet de modifier les attributs d'une image depuis les valeurs d'un tableau.
     * @param $data
     * @return mixed|void
     */
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
