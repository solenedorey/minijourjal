<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\MiniJournal\Image\ImageBd;

/**
 * Classe Article
 * @package Sd\MiniJournal\Article
 */
class Article extends AbstractDocument
{
    /**
     * @var
     */
    private $chapo;

    /**
     * @var
     */
    private $contenu;

    /**
     * @var
     */
    private $listImages = array();

    /**
     * @var
     */
    private $statutPublication;

    /**
     * @var
     */
    private $datePublication;

    /**
     * Constructeur de la classe Article.
     * @param $idArticle
     * @param $titre
     * @param $auteur
     * @param $chapo
     * @param $contenu
     * @param $listImages
     * @param $statutPublication
     * @param $dateCreation
     * @param $datePublication
     */
    public function __construct(
        $idArticle,
        $titre,
        $auteur,
        $chapo,
        $contenu,
        $listImages,
        $statutPublication,
        $dateCreation,
        $datePublication
    ) {
        parent::__construct($idArticle, $titre, $auteur, $dateCreation);
        $this->chapo = $chapo;
        $this->contenu = $contenu;
        $this->listImages = $listImages;
        $this->statutPublication = $statutPublication;
        $this->datePublication = $datePublication;
    }

    /**
     * Permet de savoir si une image est liée à un article.
     * @param $id
     * @return string
     */
    public function imageSelectionnee($id)
    {
        $images = $this->getListImages();
        $idImages = array();
        foreach ($images as $image) {
            $idImages[] = $image->getId();
        }
        return in_array($id, $idImages) ? 'checked' : '';
    }

    /**
     * Permet d'instancier un nouvel article vide.
     * @return Article
     */
    public static function creerDocumentVide()
    {
        return new self('', '', '', '', '', '', '', '', '');
    }

    /**
     * Permet d'instancier un nouvel article depuis les valeurs d'un tableau.
     * @param $data
     * @return Article
     */
    public static function creerDepuisTableau($data)
    {
        $titre = isset($data['titre']) && $data['titre'] != '' ? $data['titre'] : '';
        $auteur = isset($data['auteur']) && $data['auteur'] != '' ? $data['auteur'] : '';
        $chapo = isset($data['chapo']) && $data['chapo'] != '' ? $data['chapo'] : '';
        $contenu = isset($data['contenu']) && $data['contenu'] != '' ? $data['contenu'] : '';
        $listImages = array();
        if (isset($data['images']) && $data['images'] != '') {
            $imageBd = new ImageBd();
            foreach ($data['images'] as $image) {
                $listImages[] = $imageBd->lire($image);
            }
        }
        $statutPublication = isset($data['statutPublication']) &&
        $data['statutPublication'] != '' ? $data['statutPublication'] : '';
        $dateCreation = date('Y-m-d', time());
        $datePublication = $statutPublication === 2 ? date('Y-m-d', time()) : null;
        return new self(
            null,
            $titre,
            $auteur,
            $chapo,
            $contenu,
            $listImages,
            $statutPublication,
            $dateCreation,
            $datePublication
        );
    }

    /**
     * Permet de modifier les attributs d'un article depuis les valeurs d'un tableau.
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
        if (isset($data['chapo'])) {
            $this->setChapo($data['chapo']);
        }
        if (isset($data['contenu'])) {
            $this->setContenu($data['contenu']);
        }
        if (isset($data['images'])) {
            $imageBd = new ImageBd();
            $listImages = array();
            foreach ($data['images'] as $image) {
                $listImages[] = $imageBd->lire($image);
            }
            $this->setListImages($listImages);
        }
        if (isset($data['statutPublication'])) {
            $this->setStatutPublication($data['statutPublication']);
        }
        if ($this->statutPublication == '2') {
            $this->setDatePublication(date('Y-m-d', time()));
        } else {
            $this->setDatePublication(null);
        }
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param $chapo
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getListImages()
    {
        return $this->listImages;
    }

    /**
     * @param mixed $listImages
     */
    public function setListImages($listImages)
    {
        $this->listImages = $listImages;
    }

    /**
     * @return mixed
     */
    public function getStatutPublication()
    {
        return $this->statutPublication;
    }

    /**
     * @param $statutPublication
     */
    public function setStatutPublication($statutPublication)
    {
        $this->statutPublication = $statutPublication;
    }

    /**
     * @return mixed
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param $datePublication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }
}
