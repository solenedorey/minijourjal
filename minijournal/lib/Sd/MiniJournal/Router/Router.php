<?php
namespace Sd\MiniJournal\Router;

use Sd\Framework\HttpFoundation\Requete;

/**
 * Classe Router
 * @package Sd\MiniJournal\Router
 */
class Router
{
    /**
     * @var
     */
    protected $controllerClassName;
    /**
     * @var
     */
    protected $controllerAction;
    /**
     * @var Requete
     */
    protected $request;

    /**
     * Constructeur de la classe Router.
     * @param Requete $request
     */
    public function __construct(Requete $request)
    {
        $this->request = $request;
        $this->parseRequest();
    }

    /**
     * @return mixed
     */
    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    /**
     * @return mixed
     */
    public function getControllerAction()
    {
        return $this->controllerAction;
    }

    /**
     * Implémente la logique entre requête reçue et contrôleur à instancier et action à exécuter.
     * @throws \Exception
     */
    protected function parseRequest()
    {
        // ici le code qui détermine le contrôleur de classe et l'action
        // et les met dans $this->controllerClassName et $this->controllerAction
        $objet = isset($_GET['objet']) ? $_GET['objet'] : 'home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        switch ($objet) {
            case 'article':
                $this->controllerClassName = 'Sd\MiniJournal\Article\ArticleControleur';
                break;
            case 'image':
                $this->controllerClassName = 'Sd\MiniJournal\Image\ImageControleur';
                break;
            case 'home':
            case 'about':
            default:
                $this->controllerClassName = 'Sd\MiniJournal\Page\PageControleur';
                break;
        }

        try {
            class_exists($this->controllerClassName);
        } catch (\Exception $e) {
            throw new \Exception("Classe {$this->controllerClassName} non existante.<br>");
        }

        $this->controllerAction = $action;
    }
}
