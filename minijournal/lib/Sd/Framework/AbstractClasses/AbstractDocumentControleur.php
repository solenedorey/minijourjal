<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\HttpFoundation\Reponse;

/**
 * Class AbstractDocumentControleur
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocumentControleur
{
    private $reponse;

    /**
     * AbstractDocumentControleur constructor.
     * @param $reponse
     */
    public function __construct(Reponse $reponse)
    {
        $this->reponse = $reponse;
    }

    /**
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

    public function afficheur($file, $fragments = null)
    {
        $this->reponse->setFile($file);
        if ($fragments != null){
            $this->reponse->setFragments($fragments);
        }
    }
}
