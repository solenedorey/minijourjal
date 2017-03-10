<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\FormInterface;

abstract class AbstractDocumentForm implements FormInterface
{
    protected $document;
    protected $erreurs;

    public function __construct(AbstractDocument $document)
    {
        $this->document = $document;
    }

    public function getErreurs()
    {
        return $this->erreurs;
    }

    public function getErreur($champ)
    {
        if (isset($this->erreurs[$champ])) {
            return "<span class=\"erreur\">{$this->erreurs[$champ]}</span>";
        } else {
            return '';
        }
    }

    public function estValide()
    {
        $manager = $this->strategieValidation();
        $this->erreurs = $manager->valider($this->document);
        return count($this->erreurs) > 0 ? false : true;
    }

    abstract public function strategieValidation();
}
