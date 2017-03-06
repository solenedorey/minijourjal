<?php
namespace Sd\Framework\AbstractClasses;

abstract class AbstractDocumentControleur
{
    public function execute($action)
    {
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            // que faire si l'action n'existe pas ??
            throw new \Exception("Action {$action} non trouvée");
        }
    }
}