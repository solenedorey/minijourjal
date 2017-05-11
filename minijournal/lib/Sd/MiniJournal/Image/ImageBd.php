<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\Framework\AbstractClasses\AbstractDocumentBd;

/**
 * Classe ImageBd
 * @package Sd\MiniJournal\Image
 */
class ImageBd extends AbstractDocumentBd
{
    /**
     * Constante permettant de stocker le nom de la table de la BD.
     */
    const TABLE_NAME = 'image';

    /**
     * Constructeur de la classe ImageBd.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Permet de lire en bd une image.
     *
     * Effectue la requête SELECT et instancie un objet Image avec les données extraites de la BD.
     * @param $idImage
     * @return Image
     * @throws \Exception
     */
    public function lire($idImage)
    {
        $requete = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_image = :idImage";
        $row = parent::requete($requete, true, array(':idImage' => $idImage));
        if ($row == false) {
            throw new \Exception("Image non trouvée en bd");
        }
        $row = $row[0];
        $image = new Image(
            $row['id_image'],
            $row['titre'],
            $row['auteur'],
            $row['fichier'],
            $row['date_creation']
        );
        return $image;
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
                $liste[] = new Image(
                    $resultat['id_image'],
                    $resultat['titre'],
                    $resultat['auteur'],
                    $resultat['fichier'],
                    $resultat['date_creation']
                );
            }
        }
        return $liste;
    }

    /**
     * Permet l'enregistrement en BD d'un article.
     * @param AbstractDocument $image
     * @return mixed
     */
    public function enregistrer(AbstractDocument $image)
    {
        $requete = "INSERT INTO " . self::TABLE_NAME . " " .
            $this->partieRequete() . ", date_creation=now()";
        parent::requete($requete, false, $this->partieData($image));
        return $this->db->lastInsertId();
    }

    /**
     * Permet la modification en BD d'un document.
     * @param AbstractDocument $image
     * @return bool
     */
    public function modifier(AbstractDocument $image)
    {
        $requete = "UPDATE " . self::TABLE_NAME . " " . $this->partieRequete() . " WHERE id_image=:idImage";
        $data = $this->partieData($image);
        $data["idImage"] = $image->getId();
        return parent::requete($requete, false, $data);
    }

    /**
     * Méthode interne pour la partie commune de la requête.
     * @return string
     */
    protected function partieRequete()
    {
        $sql = "SET titre=:titre, auteur=:auteur, fichier=:fichier";
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
            'fichier' => $article->getFichier()
        );
    }

    /**
     * Permet la suppression en BD d'un article.
     * @param $idImage
     * @return bool
     */
    public function supprimer($idImage)
    {
        $requete = "DELETE FROM " . self::TABLE_NAME . " WHERE id_image=:idImage";
        return parent::requete($requete, false, array(':idImage' => $idImage));
    }
}
