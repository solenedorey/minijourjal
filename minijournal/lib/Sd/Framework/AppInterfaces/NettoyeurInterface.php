<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface NettoyeurInterface définissant les méthodes obligatoires pour tout objet de type Nettoyeur.
 * @package Sd\Framework\AppInterfaces
 */
interface NettoyeurInterface
{
    /**
     * Permet de renvoyer une valeur nettoyée.
     * @param $valeur
     * @return mixed
     */
    public function nettoyer($valeur);
}
