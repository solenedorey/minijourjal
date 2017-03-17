<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe LongueurMaxi vérifiant qu'une valeur ne dépasse pas une taille donnée.
 * @package Sd\Framework\Validateurs
 */
class LongueurMaxi implements ValidateurInterface
{
    /**
     * @var
     */
    private $limit;

    /**
     * Constructeur de la classe LongueurMaxi.
     * @param $limit
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    /**
     * Retourne faux si la chaîne dépasse la taille définie et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        return strlen($valeur) > $this->limit ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Il faut saisir un contenu de moins de " . $this->limit . " caractères";
    }
}
