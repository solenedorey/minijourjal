<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface DocumentInterface définissant les méthodes obligatoires pour tout objet de type Document.
 * @package Sd\Framework\AppInterfaces
 */
interface DocumentInterface
{
    /**
     * Créer un document "vide".
     * @return mixed
     */
    public static function creerDocumentVide();

    /**
     * Créer un document à partir d'un tableau de données.
     * @param $data
     * @return mixed
     */
    public static function creerDepuisTableau($data);

    /**
     * Modifier un document à partir de données d'un tableau.
     * @param $data
     * @return mixed
     */
    public function modifierDepuisTableau($data);
}
