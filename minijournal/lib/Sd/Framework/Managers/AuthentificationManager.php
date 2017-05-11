<?php
namespace Sd\Framework\Managers;

use Sd\Framework\Exceptions\AuthentificationException;
use Sd\Framework\HttpFoundation\Requete;
use Sd\Framework\Utilisateur\UtilisateurBd;

/**
 * Classe AuthentificationManager qui gère l'authentification des utlisateurs
 * @package Sd\Framework\Managers
 */
class AuthentificationManager
{
    /**
     * $instance est privée pour implémenter le pattern Singleton
     * et être sûr qu'il n'y a qu'une et une seule instance
     */
    private static $instance;

    /**
     * @var
     */
    private $requete;

    /**
     * Constructeur de la classe AuthentificationManager.
     * @param Requete $requete
     */
    private function __construct(Requete $requete)
    {
        $this->requete = $requete;
    }

    /**
     * Méthode pour accéder à l'UNIQUE instance de la classe.
     *
     * @param Requete $requete
     * @return AuthentificationManager , l'instance du singleton
     */
    public static function getInstance(Requete $requete = null)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($requete);
        }
        return self::$instance;
    }

    /**
     * Permet de savoir si un utlisateur est connecté ou non.
     * @return bool
     */
    public function estConnecte()
    {
        return array_key_exists('utilisateur', $this->requete->getSession()) ? true : false;
    }

    /**
     * Permet de récupérer les infos concernant l'utilisateur.
     * @param null $cle
     * @return null
     */
    public function getInfoUtilisateur($cle = null)
    {
        if ($cle !== null) {
            return $this->estConnecte() ? $this->requete->getItemSession('utilisateur')[$cle] : null;
        }
        return $this->estConnecte() ? $this->requete->getItemSession('utilisateur') : null;
    }

    /**
     * Permet d'initialiser la connexion de l'utilisateur.
     * @param $id
     * @param $login
     * @param $statut
     */
    public function authentification($id, $login, $statut)
    {
        $this->requete->addItemSession('utilisateur', 'id', $id);
        $this->requete->addItemSession('utilisateur', 'login', $login);
        $this->requete->addItemSession('utilisateur', 'statut', $statut);
    }

    /**
     * Permet la déconnexion de l'utilisateur
     */
    public function deconnexion()
    {
        $this->requete->unsetSession('utilisateur');
    }

    /**
     * Vérifie si un utilisateur existe bien et lance sa connexion.
     * @param $login
     * @param $password
     * @throws AuthentificationException
     */
    public function connexion($login, $password)
    {
        $utilisateur = (new UtilisateurBd())->lire($login, $password);
        if ($utilisateur) {
            $this->authentification($utilisateur->getId(), $utilisateur->getLogin(), $utilisateur->getStatut());
        } else {
            throw new AuthentificationException("frtftfvtv");
        }
    }
}
