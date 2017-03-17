<?php
namespace Sd\Framework\Twig;

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
     * Constructeur de la classe Twig.
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('assets/templates');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false
        ));

        $displayErrors = new Twig_SimpleFunction('display_errors', function ($errors) {
            echo $this->twig->render('frag/formErrors.twig', array(
                'errors' => $errors
            ));
        });
        $this->twig->addFunction($displayErrors);
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }
}
