<?php
namespace Sd\Framework\HttpFoundation;

/**
 * Classe Reponse passée au contrôleur afin que les données de réponse puissent être remplies.
 * @package Sd\Framework\HttpFoundation
 */
class Reponse
{
    /**
     * @var array
     */
    private $fragments;

    /**
     * @var
     */
    private $file;

    /**
     * Constructeur de la classe Reponse.
     */
    public function __construct()
    {
        $this->fragments = array();
    }

    /**
     * @return array
     */
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
