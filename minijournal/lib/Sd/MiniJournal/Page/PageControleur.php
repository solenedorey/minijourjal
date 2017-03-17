<?php
namespace Sd\MiniJournal\Page;

use Sd\Framework\AbstractClasses\AbstractControleur;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

/**
 * Classe PageControleur
 * @package Sd\MiniJournal\Page
 */
class PageControleur extends AbstractControleur
{
    /**
     * @var Requete
     */
    private $requete;

    /**
     * Constructeur de la classe PageControleur.
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->requete = $requete;
        parent::__construct($reponse);
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
}
