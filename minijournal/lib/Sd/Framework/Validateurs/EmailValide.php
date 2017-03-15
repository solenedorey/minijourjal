<?php
namespace Sd\Framework\Validateurs;

use Sd\Framework\AppInterfaces\ValidateurInterface;

class EmailValide implements ValidateurInterface
{
    public function valider($valeur)
    {
        return filter_var($valeur, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public function getMessage()
    {
        return "Le champ auteur n'est pas valide. Une adresse mail est requise.";
    }
}
