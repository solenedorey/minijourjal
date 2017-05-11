<?php
namespace Sd\Framework\Twig;

use Sd\Framework\HttpFoundation\Requete;
use Sd\Framework\Managers\AuthentificationManager;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;

/**
 * Classe Twig permettant de gérer les templates.
 * @package Sd\Framework\Twig
 */
class Twig
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var Requete
     */
    private $requete;

    /**
     * Constructeur de la classe Twig.
     */
    public function __construct(Requete $requete)
    {
        $this->requete = $requete;

        //loader
        $loader = new Twig_Loader_Filesystem(array('assets/templates', 'lib/Sd/Framework/Vues'));

        //init
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
            'debug' => true
        ));

        //globals

        $globals = array();
        $user = AuthentificationManager::getInstance()->getInfoUtilisateur();
        if ($user !== null) {
            $globals['session'] = $user;
        }
        $this->twig->addGlobal('global', $globals);

        //debug
        $this->twig->addExtension(new \Twig_Extension_Debug());

        //functions
        $displayErrors = new Twig_SimpleFunction('display_errors', function ($errors) {
            echo $this->twig->render('frag/formErrors.twig', array(
                'errors' => $errors
            ));
        });
        $this->twig->addFunction($displayErrors);

        $requestUri = new Twig_SimpleFunction('request_uri', function () {
            echo $_SERVER['REQUEST_URI'];
        });
        $this->twig->addFunction($requestUri);

        $estConnecte = new Twig_SimpleFunction('est_connecte', function () {
            return AuthentificationManager::getInstance($this->requete)->estConnecte();
        });
        $this->twig->addFunction($estConnecte);

        $flashInfo = new Twig_SimpleFunction('flash_info', function ($param) {
            return $_SESSION[$param];
        });
        $this->twig->addFunction($flashInfo);

        $isXhrRequest = new Twig_SimpleFunction('is_xhr_request', function () {
            return $this->requete->isXhrRequest();
        });
        $this->twig->addFunction($isXhrRequest);
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
