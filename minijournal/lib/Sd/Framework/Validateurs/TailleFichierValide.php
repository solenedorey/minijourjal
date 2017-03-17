<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe TailleFichierValide vérifiant si un fichier ne dépasse pas une taille donnée.
 * @package Sd\Framework\Validateurs
 */
class TailleFichierValide implements ValidateurInterface
{
    /**
     * @var
     */
    private $tailleMax;

    /**
     * Constructeur de la classe TailleFichierValide.
     * @param $tailleMax
     */
    public function __construct($tailleMax)
    {
        $this->tailleMax = $tailleMax;
    }

    /**
     * Retourne faux si le fichier dépasse la taille définie et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        return filesize($valeur) > $this->tailleMax ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Le fichier excède " . number_format($this->tailleMax / 1048576) . "Mo.";
    }
}
