<?php
namespace Sd\Framework\Utilisateur;

use Jml\Tools\Database\ConnectionSingleton;

/**
 * Class UtilisateurBd
 * @package Sd\Framework\Utilisateur
 */
class UtilisateurBd
{
    /**
     * @var
     */
    protected $db;

    /**
     * Constructeur de la classe UtilisateurBd.
     */
    public function __construct()
    {
        $this->db = ConnectionSingleton::getInstance()->getConnexion();
    }

    /**
     * Permet la récupération d'un utilisateur en bd.
     * @param $login
     * @param $password
     * @return bool|Utilisateur
     */
    public function lire($login, $password)
    {
        $requete = "SELECT id_utilisateur, login, nom 
        FROM utilisateur 
        JOIN statut USING (id_statut) 
        WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($requete);
        $stmt->execute(array(':login' => $login, ':password' => $password));
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            $utilisateur = new Utilisateur(
                $row['id_utilisateur'],
                $row['login'],
                $row['nom']
            );
            return $utilisateur;
        }
        return false;
    }
}
