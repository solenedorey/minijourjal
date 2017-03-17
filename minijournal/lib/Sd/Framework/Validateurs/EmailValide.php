<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe EmailValide vérifiant la validité d'un e-mail.
 * @package Sd\Framework\Validateurs
 */
class EmailValide implements ValidateurInterface
{
    /**
     * Retourne faux si l'e-mail n'est pas valide et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        return filter_var($valeur, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Le champ auteur n'est pas valide. Une adresse mail est requise.";
    }
}
