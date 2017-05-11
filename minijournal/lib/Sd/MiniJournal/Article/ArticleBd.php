<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\Framework\AbstractClasses\AbstractDocumentBd;
use Sd\MiniJournal\Image\Image;

/**
 * Classe ArticleBd
 * @package Sd\MiniJournal\Article
 */
class ArticleBd extends AbstractDocumentBd
{
    /**
     * Constante permettant de stocker le nom de la table de la BD.
     */
    const TABLE_NAME = 'article';

    /**
     * Constructeur de la classe ArticleBd.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Permet de lire en bd un article.
     *
     * Effectue la requête SELECT et instancie un objet Article avec les données extraites de la BD.
     *
     * @param $idArticle
     * @return Article
     * @throws \Exception
     */
    public function lire($idArticle)
    {
        $requete = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_article = :idArticle";
        $row = parent::requete($requete, true, array(':idArticle' => $idArticle));
        if ($row == false) {
            throw new \Exception("Article non trouvé en bd");
        }
        $row = $row[0];
        $article = new Article(
            $row['id_article'],
            $row['titre'],
            $row['auteur'],
            $row['chapo'],
            $row['contenu'],
            null,
            $row['statut_publication'],
            $row['date_creation'],
            $row['date_publication']
        );
        $images = $this->recupererImages($idArticle);
        $article->setListImages($images);
        return $article;
    }

    /**
     * Permet de récupérer les images qui sont liées à un article en particulier en BD
     * @param $idArticle
     * @return array
     */
    public function recupererImages($idArticle)
    {
        $requete = "SELECT *
        FROM article_image as ai, image as i
        WHERE ai.id_article = :idArticle
        AND ai.id_image = i.id_image";
        $images = array();
        $rows = parent::requete($requete, true, array(':idArticle' => $idArticle));
        /*if (count($rows) == 1) {
            $rows = $rows[0];
        }*/
        foreach ($rows as $row) {
            $image = new Image(
                $row['id_image'],
                $row['titre'],
                $row['auteur'],
                $row['fichier'],
                $row['date_creation']
            );
            $images[] = $image;
        }
        return $images;
    }

    /**
     * Permet de lire en BD une liste d'article.
     * @param bool $publie
     * @return array
     */
    public function lireTous($publie = false)
    {
        $requete = "SELECT * 
        FROM " . self::TABLE_NAME;
        if ($publie) {
            $requete .=  " WHERE statut_publication = 2";
        }
        $liste = array();
        $resultats = parent::requete($requete, true);
        if ($resultats) {
            foreach ($resultats as $resultat) {
                $liste[] = new Article(
                    $resultat['id_article'],
                    $resultat['titre'],
                    $resultat['auteur'],
                    $resultat['chapo'],
                    $resultat['contenu'],
                    null,
                    $resultat['statut_publication'],
                    $resultat['date_creation'],
                    $resultat['date_publication']
                );
            }
        }
        return $liste;
    }

    /**
     * Permet l'enregistrement en BD d'un article.
     * @param AbstractDocument $article
     * @return mixed
     */
    public function enregistrer(AbstractDocument $article)
    {
        $requete = "INSERT INTO " . self::TABLE_NAME . " " .
        $this->partieRequete() . ", date_creation=now()";
        parent::requete($requete, false, $this->partieData($article));
        $lastId = $this->db->lastInsertId();
        $article->setId($lastId);
        $this->enregistrerLienArticleImage($article);
        return $lastId;
    }

    /**
     * Permet l'enregistrement en BD des informations concernant le lien entre un article et des images.
     * @param AbstractDocument $article
     */
    public function enregistrerLienArticleImage(AbstractDocument $article)
    {
        $images = $article->getListImages();
        $idArticle = $article->getId();
        foreach ($images as $image) {
            $requete = "INSERT INTO article_image SET id_article=:idArticle, id_image=:idImage";
            parent::requete($requete, false, array(':idArticle' => $idArticle, ':idImage' => $image->getId()));
        }
    }

    /**
     * Permet la modification en BD d'un document.
     * @param AbstractDocument $article
     * @return bool
     */
    public function modifier(AbstractDocument $article)
    {
        $requete = "UPDATE " . self::TABLE_NAME . " " . $this->partieRequete() . " WHERE id_article=:idArticle";
        $data = $this->partieData($article);
        $data["idArticle"] = $article->getId();
        return parent::requete($requete, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function partieRequete()
    {
        $sql = "SET titre=:titre, auteur=:auteur, chapo=:chapo, contenu=:contenu, 
        statut_publication=:statutPublication, date_publication=:datePublication";
        return $sql;
    }

    /**
     * Méthode interne pour construire le tableau de donées à donner en paramètre pour l'exécution de la requete
     * préparée.
     * @param AbstractDocument $article
     * @return array
     */
    protected function partieData(AbstractDocument $article)
    {
        return array(
            'titre' => $article->getTitre(),
            'auteur' => $article->getAuteur(),
            'chapo' => $article->getChapo(),
            'contenu' => $article->getContenu(),
            'statutPublication' => $article->getStatutPublication(),
            'datePublication' => $article->getDatePublication()
        );
    }

    /**
     * Permet la suppression en BD d'un article.
     * @param $idArticle
     * @return bool
     */
    public function supprimer($idArticle)
    {
        $requete = "DELETE FROM " . self::TABLE_NAME . " WHERE id_article=:idArticle";
        parent::requete($requete, false, array(':idArticle' => $idArticle));
        return;
    }
}
