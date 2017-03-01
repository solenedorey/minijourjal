<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\Document;
use Sd\Framework\AbstractClasses\DocumentBd;

class ArticleBd extends DocumentBd
{
    const TABLE_NAME = 'article';

    public function __construct()
    {
        parent::__construct();
    }

    public function lire($idArticle)
    {
        $requete = "SELECT * FROM " . self::TABLE_NAME . " WHERE id_article = :idArticle";
        $row = parent::requete($requete, array(':idArticle' => $idArticle))[0];
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

    public function lireTous()
    {
        $requete = "SELECT * FROM " . self::TABLE_NAME;
        $liste = array();
        $resultats = parent::requete($requete);
        if($resultats){
            foreach ($resultats as $resultat){
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

    public function enregistrer(Document $article)
    {
        $requete = "INSERT INTO " . self::TABLE_NAME . " ";
        $requete .= $this->partieRequete() . ", date_creation=now()";
        $stmt = $this->db->prepare($requete);
        return $stmt->execute($this->partieData($article));
    }

    public function modifier(Document $article)
    {
        $requete = "UPDATE " . self::TABLE_NAME . " " . $this->partieRequete() . " WHERE id_article=:idArticle";
        $stmt = $this->db->prepare($requete);
        $data = array('idArticle' => $article->getId());
        $data = $data + $this->partieData($article);
        return $stmt->execute($data);
    }

    protected function partieRequete()
    {
        $sql = "SET titre=:titre, auteur=:auteur, chapo=:chapo, contenu=:contenu, statut_publication=:statutPublication, date_publication=:datePublication";
        return $sql;
    }

    protected function partieData(Document $article)
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

    public function supprimer($idArticle)
    {
        $requete = "DELETE FROM " . self::TABLE_NAME . " WHERE id_article=:idArticle";
        parent::requete($requete, array(':idArticle' => $idArticle));
    }
}
