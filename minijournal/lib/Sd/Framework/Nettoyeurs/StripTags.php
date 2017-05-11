<?php
namespace Sd\Framework\Nettoyeurs;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

/**
 * Classe StripTags supprimant les balises HTML et PHP d'une chaîne.
 * @package Sd\Framework\Nettoyeurs
 */
class StripTags implements NettoyeurInterface
{
    /**
     * @var null
     */
    private $exclusion;

    /**
     * Constructeur de la classe StripTags.
     * @param $exclusion
     */
    public function __construct($exclusion = null)
    {
        $this->exclusion = $exclusion;
    }

    /**
     * Permet de retourner une chaîne sans balises HTML et PHP.
     * @param $valeur
     * @return string
     */
    public function nettoyer($valeur)
    {
        return strip_tags($valeur, $this->exclusion);
    }
}
