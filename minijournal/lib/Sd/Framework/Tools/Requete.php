<?php

namespace Sd\Framework\Tools;

class Requete
{
    private $get;
    private $post;

    public function __construct($get, $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function getItemGet($cle)
    {
        return isset($this->get[$cle]) ? $this->get[$cle] : null;
    }

    public function getItemPost($cle)
    {
        return isset($this->post[$cle]) ? $this->post[$cle] : null;
    }

    public function getPost()
    {
        return $this->post;
    }
}
