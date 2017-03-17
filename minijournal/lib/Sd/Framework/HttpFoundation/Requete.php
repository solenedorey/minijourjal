<?php

namespace Sd\Framework\HttpFoundation;

/**
 * Classe Requete encapsulant les données GET, POST et FILES.
 * @package Sd\Framework\HttpFoundation
 */
class Requete
{
    /**
     * @var
     */
    private $get;
    /**
     * @var
     */
    private $post;
    /**
     * @var
     */
    private $files;

    /**
     * Constructeur de la classe Requete.
     * @param $get
     * @param $post
     * @param $files
     */
    public function __construct($get, $post, $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
    }

    /**
     * @param $cle
     * @return null
     */
    public function getItemGet($cle)
    {
        return isset($this->get[$cle]) ? $this->get[$cle] : null;
    }

    /**
     * @param $cle
     * @return null
     */
    public function getItemPost($cle)
    {
        return isset($this->post[$cle]) ? $this->post[$cle] : null;
    }

    /**
     * @param $cle
     * @return null
     */
    public function getItemFiles($cle)
    {
        return isset($this->files[$cle]) ? $this->files[$cle] : null;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }
}
