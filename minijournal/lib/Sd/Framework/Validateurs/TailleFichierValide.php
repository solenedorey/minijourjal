<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

class TailleFichierValide implements ValidateurInterface
{
    private $tailleMax;

    /**
     * TailleFichierValide constructor.
     * @param $tailleMax
     */
    public function __construct($tailleMax)
    {
        $this->tailleMax = $tailleMax;
    }

    public function valider($valeur)
    {
        return filesize($valeur) > $this->tailleMax ? false : true;
    }

    public function getMessage()
    {
        return "Le fichier excède " . number_format($this->tailleMax / 1048576) . "Mo.";
    }
}