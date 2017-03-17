<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\Framework\AbstractClasses\AbstractDocumentBd;

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
        $row = parent::requete($requete, true, array(':idArticle' => $idArticle))[0];
        if ($row == false) {
            throw new \Exception("Article non trouvé en bd");
        }
        $article = new Article(
            $row['id_article'],
            $row['titre'],
            $row['auteur'],
            $row['chapo'],
            $row['contenu'],
            $row['statut_publication'],
            $row['date_creation'],
            $row['date_publication']
        );
        return $article;
    }

    /**
     * Permet de lire en BD une liste d'article.
     * @return array
     */
    public function lireTous()
    {
        $requete = "SELECT * 
        FROM " . self::TABLE_NAME;
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
        return $this->db->lastInsertId();
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
        return parent::requete($requete, false, array(':idArticle' => $idArticle));
    }
}
