<?php

namespace Sd\Framework\HttpFoundation;

/**
 * Class Requete encapsulant les données SESSION, GET, POST et FILES.
 * @package Sd\Framework\HttpFoundation
 */
class Requete
{
    /**
     * @var
     */
    private $session;

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
     * @param $session
     * @param $get
     * @param $post
     * @param $files
     */
    public function __construct($session, $get, $post, $files)
    {
        $this->session = $session;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
    }

    /**
     * Permet de faire la synchronisation avec la variable de session.
     */
    public function synchroniserSession()
    {
        $_SESSION = $this->session;
    }

    /**
     * Permet de savoir si la requête HTTP en cours a été faite via XHR ou non.
     * @return bool
     */
    public function isXhrRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @param $cle
     * @return null
     */
    public function getItemSession($cle)
    {
        return isset($this->session[$cle]) ? $this->session[$cle] : null;
    }

    /**
     * @param $cle1
     * @param $cle2
     * @param $valeur
     * @internal param $cle
     */
    public function addItemSession($cle1, $cle2, $valeur)
    {
        $this->session[$cle1][$cle2] = $valeur;
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
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param $cle
     */
    public function unsetSession($cle)
    {
        unset($this->session[$cle]);
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }
}
