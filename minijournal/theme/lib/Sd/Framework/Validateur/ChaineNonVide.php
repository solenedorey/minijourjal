<?php
namespace Sd\Framework\Validateur;

use Sd\Framework\AppInterfaces\ValidateurInterface;

class ChaineNonVide implements ValidateurInterface
{
    public function valider($valeur)
    {
        return $valeur === "" ? false : true;
    }

    public function getMessage()
    {
        return "Le champ ne doit pas être vide.";
    }
}
