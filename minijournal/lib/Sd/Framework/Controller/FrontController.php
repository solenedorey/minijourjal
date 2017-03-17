<?php

namespace Sd\Framework\Controller;

use Sd\MiniJournal\Router\Router;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

/**
 * Classe FrontController
 * @package Sd\Framework\Controller
 */
class FrontController
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Requete
     */
    protected $request;

    /**
     * @var Reponse
     */
    protected $response;

    /**
     * Constructeur de la classe FrontController.
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Router $router, Requete $requete, Reponse $reponse)
    {
        $this->router = $router;
        $this->request = $requete;
        $this->response = $reponse;
    }

    /**
     * Permet de lancer le contrôleur et exécuter l'action à faire.
     * @return mixed
     */
    public function execute()
    {
        $className = $this->router->getControllerClassName();
        $controller = new $className($this->request, $this->response);
        $action = $this->router->getControllerAction();
        $controller->execute($action);
    }
}
