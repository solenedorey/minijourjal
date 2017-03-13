<?php
namespace Sd\Framework\HttpFoundation;

class Reponse
{
    private $fragments;
    private $file;

    public function __construct()
    {
        $this->fragments = array();
    }

    public function ajouterFragment($nom, $contenu)
    {
        $this->fragments[$nom] = $contenu;

    }

    public function getFragments()
    {
        return $this->fragments;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param array $fragments
     */
    public function setFragments($fragments)
    {
        $this->fragments = $fragments;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
}
