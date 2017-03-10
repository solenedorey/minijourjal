<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocument;

class Article extends AbstractDocument
{
    private $auteur;
    private $chapo;
    private $contenu;
    private $statutPublication;
    private $datePublication;

    public function __construct(
        $idArticle,
        $titre,
        $auteur,
        $chapo,
        $contenu,
        $statutPublication,
        $dateCreation,
        $datePublication
    ) {
        parent::__construct($idArticle, $titre, $dateCreation);
        $this->auteur = $auteur;
        $this->chapo = $chapo;
        $this->contenu = $contenu;
        $this->statutPublication = $statutPublication;
        $this->datePublication = $datePublication;
    }

    public static function creerDocumentVide()
    {
        return new self("", "", "", "", "", "", "", "");
    }

    public static function creerDepuisTableau($data)
    {
        $titre = isset($data['titre']) && $data['titre'] != '' ? $data['titre'] : '';
        $auteur = isset($data['auteur']) && $data['auteur'] != '' ? $data['auteur'] : '';
        $chapo = isset($data['chapo']) && $data['chapo'] != '' ? $data['chapo'] : '';
        $contenu = isset($data['contenu']) && $data['contenu'] != '' ? $data['contenu'] : '';
        $statutPublication = isset($data['statutPublication']) &&
        $data['statutPublication'] != '' ? $data['statutPublication'] : '';
        $dateCreation = date('Y-m-d', time());
        $datePublication = $statutPublication === 2 ? date('Y-m-d', time()) : null;
        return new self(null, $titre, $auteur, $chapo, $contenu, $statutPublication, $dateCreation, $datePublication);
    }

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
        if (isset($data['statutPublication'])) {
            $this->setStatutPublication($data['statutPublication']);
        }
        if ($this->statutPublication == '2') {
            $this->setDatePublication(date('Y-m-d', time()));
        } else {
            $this->setDatePublication(null);
        }
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    public function getChapo()
    {
        return $this->chapo;
    }

    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getStatutPublication()
    {
        return $this->statutPublication;
    }

    public function setStatutPublication($statutPublication)
    {
        $this->statutPublication = $statutPublication;
    }

    public function getDatePublication()
    {
        return $this->datePublication;
    }

    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }
}
