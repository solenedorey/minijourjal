<?php

namespace Sd\Framework\Tools;

class Requete
{
    private $get;
    private $post;
    private $files;

    public function __construct($get, $post, $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
    }

    public function getItemGet($cle)
    {
        return isset($this->get[$cle]) ? $this->get[$cle] : null;
    }

    public function getItemPost($cle)
    {
        return isset($this->post[$cle]) ? $this->post[$cle] : null;
    }

    public function getItemFiles($cle)
    {
        return isset($this->files[$cle]) ? $this->files[$cle] : null;
    }

    public function getPost()
    {
        return $this->post;
    }
}
