<?php
namespace Sd\MiniJournal\Page;

use Sd\Framework\AbstractClasses\AbstractControleur;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;
use Sd\Framework\Managers\AuthentificationManager;

/**
 * Classe PageControleur
 * @package Sd\MiniJournal\Page
 */
class PageControleur extends AbstractControleur
{
    /**
     * Constructeur de la classe PageControleur.
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->requete = $requete;
        parent::__construct($requete, $reponse);
    }

    /**
     * Affiche la page A propos.
     */
    public function about()
    {
        $this->afficheur('about.twig');
    }

    /**
     * Affiche la page d'accueil.
     */
    public function home()
    {
        $this->afficheur('index.twig');
    }

    /**
     * Permet la déconnexion de l'utilisateur connecté et redirige vers l'accueil.
     */
    public function deconnexion()
    {
        AuthentificationManager::getInstance($this->requete)->deconnexion();
        header('Location: index.php');
    }
}
