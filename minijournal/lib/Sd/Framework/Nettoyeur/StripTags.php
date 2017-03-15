<?php
namespace Sd\Framework\Nettoyeur;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

class StripTags implements NettoyeurInterface
{
    private $exclusion;

    /**
     * StripTags constructor.
     * @param $exclusion
     */
    public function __construct($exclusion = null)
    {
        $this->exclusion = $exclusion;
    }

    public function nettoyer($valeur)
    {
        return strip_tags($valeur, $this->exclusion);
    }
}