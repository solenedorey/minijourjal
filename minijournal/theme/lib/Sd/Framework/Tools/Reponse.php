<?php

namespace Sd\Framework\Tools;

class Reponse
{
    private $fragments;

    public function __construct()
    {
        $this->fragments = array();
    }

    public function ajouterFragment($nom, $contenu)
    {
        $this->fragments[$nom] = $contenu;

    }

    public function getFragments($nom)
    {
        return $this->fragments[$nom];
    }
}
