<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\Framework\AbstractClasses\AbstractDocumentBd;

class ImageBd extends AbstractDocumentBd
{
    const TABLE_NAME = 'image';

    public function __construct()
    {
        parent::__construct();
    }

    public function lire($idImage)
    {
        $requete = "SELECT * 
        FROM " . self::TABLE_NAME . " 
        WHERE id_image = :idImage";
        $row = parent::requete($requete, true, array(':idImage' => $idImage))[0];
        if ($row == false) {
            throw new \Exception("Image non trouvée en bd");
        }
        $image = new Image(
            $row['id_image'],
            $row['titre'],
            $row['auteur'],
            $row['fichier'],
            $row['date_creation']
        );
        return $image;
    }

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

    public function enregistrer(AbstractDocument $image)
    {
        $requete = "INSERT INTO " . self::TABLE_NAME . " " .
            $this->partieRequete() . ", date_creation=now()";
        parent::requete($requete, false, $this->partieData($image));
        return $this->db->lastInsertId();
    }

    public function modifier(AbstractDocument $image)
    {
        $requete = "UPDATE " . self::TABLE_NAME . " " . $this->partieRequete() . " WHERE id_image=:idImage";
        $data = array('idImage' => $image->getId());
        $data[] = $this->partieData($image);
        return parent::requete($requete, false, $data);
    }

    protected function partieRequete()
    {
        $sql = "SET titre=:titre, auteur=:auteur, fichier=:fichier";
        return $sql;
    }

    protected function partieData(AbstractDocument $article)
    {
        return array(
            'titre' => $article->getTitre(),
            'auteur' => $article->getAuteur(),
            'fichier' => $article->getFichier()
        );
    }

    public function supprimer($idImage)
    {
        $requete = "DELETE FROM " . self::TABLE_NAME . " WHERE id_image=:idImage";
        return parent::requete($requete, false, array(':idImage' => $idImage));
    }
}