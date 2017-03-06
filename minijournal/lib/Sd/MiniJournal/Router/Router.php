<?php

namespace Sd\MiniJournal\Router;

use Sd\Framework\Tools\Requete;

class Router
{
    protected $controllerClassName;
    protected $controllerAction;
    protected $request;

    public function __construct(Requete $request)
    {
        $this->request = $request;
        $this->parseRequest();
    }

    public function getControllerClassName()
    {
        return $this->controllerClassName;
    }

    public function getControllerAction()
    {
        return $this->controllerAction;
    }

    protected function parseRequest()
    {
        // ici le code qui détermine le contrôleur de classe et l'action
        // et les met dans $this->controllerClassName et $this->controllerAction
        $objet = isset($_GET['objet']) ? $_GET['objet'] : 'article';
        $action = isset($_GET['action']) ? $_GET['action'] : 'afficherListe';

        switch ($objet) {
            case 'article':
                $this->controllerClassName = 'Sd\MiniJournal\Article\ArticleControleur';
                try {
                    class_exists($this->controllerClassName);
                } catch (Exception $e) {
                    throw new \Exception("Classe {$this->controllerClassName} non existante");
                }
                $this->controllerAction = $action;
                break;
            case 'image':
                $this->controllerClassName = 'Sd\MiniJournal\Image\ImageControleur';
                try {
                    class_exists($this->controllerClassName);
                } catch (Exception $e) {
                    throw new \Exception("Classe {$this->controllerClassName} non existante");
                }
                $this->controllerAction = $action;
                break;
            default:
                break;
        }
    }
}
