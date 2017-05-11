<?php
namespace Sd\Framework\Utilisateur;

/**
 * Class Utilisateur
 * @package Sd\Framework\Utilisateur
 */
class Utilisateur
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $login;

    /**
     * @var
     */
    private $statut;

    /**
     * Constructeur de la classe Utilisateur.
     * @param $id
     * @param $login
     * @param $statut
     */
    public function __construct($id, $login, $statut)
    {
        $this->id = $id;
        $this->login = $login;
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
