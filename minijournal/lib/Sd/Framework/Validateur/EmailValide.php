<?php
namespace Sd\Framework\Validateur;

use Sd\Framework\AppInterfaces\ValidateurInterface;

class EmailValide implements ValidateurInterface
{
    public function valider($valeur)
    {
        return filter_var($valeur, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function getMessage()
    {
        return "L'adresse n'est pas valide.";
    }
}
