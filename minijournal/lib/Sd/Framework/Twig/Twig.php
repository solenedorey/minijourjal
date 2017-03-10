<?php
namespace Sd\Framework\Twig;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;

class Twig
{
    private $twig;

    /**
     * Twig constructor.
     */
    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem('assets/templates');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false
        ));

        $displayErrors = new Twig_SimpleFunction('display_errors', function ($errors) {
            echo $this->twig->render('formErrors.twig', array(
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
