<?php

namespace Sd\Framework\Controller;

use Sd\MiniJournal\Router\Router;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

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
    public function execute()
    {
        $className = $this->router->getControllerClassName();
        $controller = new $className($this->request, $this->response);
        $action = $this->router->getControllerAction();
        $controller->execute($action);
    }
}
