<?php
namespace Sd\Framework\Nettoyeur;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

class Trim implements NettoyeurInterface
{
    public function nettoyer($valeur)
    {
        return trim($valeur);
    }
}