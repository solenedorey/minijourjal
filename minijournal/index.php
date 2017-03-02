<?php
require 'config/config.php';
require 'twig.php';
require 'config/autoload.php';

spl_autoload_register('autoload');

use Sd\Framework\Controller\FrontController;
use Sd\Framework\Tools\Reponse;
use Sd\Framework\Tools\Requete;
use Sd\MiniJournal\Router\Router;

try {
    $requete = new Requete($_GET, $_POST);
    $reponse = new Reponse();

    $router = new Router($requete);
    $controller = new FrontController($router, $requete, $reponse);
    $controller->execute($twig);

    $titre = $reponse->getFragments('titre');
    $contenu = $reponse->getFragments('contenu');

} catch (Exception $e) {
    $titre = "Erreur 404";
    // utiliser la constante MODE_DEV déclarée en config pour décider du message à afficher
    if (MODE_DEV) {
        $contenu = $e->getMessage();
        $contenu .= "<div>" . nl2br($e->getTraceAsString()) . "</div>";
    } else {
        $contenu .= "<p>Une erreur d'exécution s'est produite.</p>";
    }
    header("HTTP/1.0 404 Not Found");
}

require 'vues/page.html';
