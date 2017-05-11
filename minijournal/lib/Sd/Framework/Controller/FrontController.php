<?php
namespace Sd\Framework\Controller;

use Sd\Framework\Exceptions\AuthentificationException;
use Sd\Framework\Managers\AuthentificationManager;
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
    protected $requete;

    /**
     * @var Reponse
     */
    protected $response;

    /**
     * Constructeur de la classe FrontController.
     * @param Router $router
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Router $router, Requete $requete, Reponse $reponse)
    {
        $this->router = $router;
        $this->requete = $requete;
        $this->response = $reponse;
    }

    /**
     * Permet de lancer le contrôleur et exécuter l'action à faire.
     * @return mixed
     */
    public function execute()
    {
        $authManager = AuthentificationManager::getInstance($this->requete);
        $formData = $this->requete->getPost();
        if (isset($formData['auth_login']) && isset($formData['auth_password'])) {
            try {
                $authManager->connexion($formData['auth_login'], $formData['auth_password']);
            } catch (AuthentificationException $e) {
                $erreur = $e->getMessage();
            }
        }
        $className = $this->router->getControllerClassName();
        $controller = new $className($this->requete, $this->response);
        $action = $this->router->getControllerAction();
        $controller->execute($action);
    }
}
