<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe LongueurMini vérifiant qu'une valeur dépasse une taille donnée.
 * @package Sd\Framework\Validateurs
 */
class LongueurMini implements ValidateurInterface
{
    /**
     * @var int
     */
    private $limit;

    /**
     * Constructeur de la classe LongueurMini.
     * @param $limit
     */
    public function __construct($limit = 200)
    {
        $this->limit = $limit;
    }

    /**
     * Retourne faux si la chaîne ne dépasse pas la taille définie et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        return strlen($valeur) < $this->limit ? false : true;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Il faut saisir un contenu de plus de " . $this->limit . " caractères";
    }
}
