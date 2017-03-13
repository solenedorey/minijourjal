<?php
namespace Sd\Framework\AppInterfaces;

interface ValidateurInterface
{
    public function valider($valeur);
    public function getMessage();
}
