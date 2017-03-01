<?php

namespace Sd\Framework\Controller;

use Sd\MiniJournal\Router\Router;
use Sd\Framework\Tools\Reponse;
use Sd\Framework\Tools\Requete;

class FrontController
{
    protected $router;
    protected $request;
    protected $response;

    /**
     * FrontController constructor.
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
     * @return mixed
     */
    public function execute($twig)
    {
        $className = $this->router->getControllerClassName();
        $controller = new $className($this->request, $this->response, $twig);
        $action = $this->router->getControllerAction();
        $controller->execute($action);
    }
}
