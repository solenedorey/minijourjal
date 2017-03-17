<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe ChaineNonVide permettant de vérifier si une chaîne n'est pas vide.
 * @package Sd\Framework\Validateurs
 */
class ChaineNonVide implements ValidateurInterface
{
    /**
     * Retourne faux si la chaîne est vide et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        return $valeur === "" ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Le champ ne doit pas être vide.";
    }
}
