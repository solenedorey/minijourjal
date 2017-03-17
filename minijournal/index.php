<?php
require 'config/config.php';
require 'vendor/autoload.php';
require 'lib/Sd/Framework/Loader/autoload.php';

spl_autoload_register('autoload');

use Sd\Framework\Controller\FrontController;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;
use Sd\Framework\Twig\Twig;
use Sd\MiniJournal\Router\Router;

try {

    /**
     * Initialiser Requete et Reponse
     */
    $requete = new Requete($_GET, $_POST, $_FILES);
    $reponse = new Reponse();

    $router = new Router($requete);

    /**
     * Initialiser le FrontController et l'exécuter
     */
    $controller = new FrontController($router, $requete, $reponse);
    $controller->execute();

} catch (Exception $e) {
    $reponse->setFile('errorPage.twig');
    if (MODE_DEV) {
        $erreur = $e->getMessage();
        $erreur .= nl2br($e->getTraceAsString());
        $reponse->setFragments(array('erreur' => $erreur));
    } else {
        $erreur = "<p>Une erreur d'exécution s'est produite.</p>";
        $reponse->setFragments(array('erreur' => $erreur));
    }
    header("HTTP/1.0 404 Not Found");
}

/**
 * Récupérer les contenus de la page et les mettre dans les variables du template de page
 */
echo (new Twig())->getTwig()->render($reponse->getFile(), $reponse->getFragments());
