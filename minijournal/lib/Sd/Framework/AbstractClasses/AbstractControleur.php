<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\HttpFoundation\Reponse;

/**
 * Classe AbstractControleur
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractControleur
{
    /**
     * @var Reponse
     */
    private $reponse;

    /**
     * Constructeur de la classe AbstractControleur.
     * @param $reponse
     */
    public function __construct(Reponse $reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * Permet d'exécuter le contrôleur de classe pour effectuer l'action $action.
     * @param $action
     * @return mixed
     * @throws \Exception
     */
    public function execute($action)
    {
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            // que faire si l'action n'existe pas ??
            throw new \Exception("Action {$action} non trouvée");
        }
    }

    /**
     * Permet de charger les données dans le template correspondant.
     * @param $file
     * @param null $fragments
     */
    public function afficheur($file, $fragments = null)
    {
        $this->reponse->setFile($file);
        if ($fragments != null) {
            $this->reponse->setFragments($fragments);
        }
    }
}
