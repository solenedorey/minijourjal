<?php
namespace Sd\Framework\Nettoyeur;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

/**
 * Classe Trim supprimant les espaces en début et fin de chaîne.
 * @package Sd\Framework\Nettoyeur
 */
class Trim implements NettoyeurInterface
{
    /**
     * Permet de retourner une chaîne trimée.
     * @param $valeur
     * @return string
     */
    public function nettoyer($valeur)
    {
        return trim($valeur);
    }
}
