<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\FormInterface;

/**
 * Class AbstractDocumentForm
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocumentForm implements FormInterface
{
    /**
     * @var AbstractDocument
     */
    protected $document;
    /**
     * @var
     */
    protected $erreurs;

    /**
     * AbstractDocumentForm constructor.
     * @param AbstractDocument $document
     */
    public function __construct(AbstractDocument $document)
    {
        $this->document = $document;
    }

    /**
     * @return mixed
     */
    public function getErreurs()
    {
        return $this->erreurs;
    }

    /**
     * @param $champ
     * @return string
     */
    public function getErreur($champ)
    {
        if (isset($this->erreurs[$champ])) {
            return "<span class=\"erreur\">{$this->erreurs[$champ]}</span>";
        } else {
            return '';
        }
    }

    public static function nettoyer($form)
    {
        $manager = static::strategieNettoyage();
        $form = $manager->nettoyer($form);
        return $form;
    }

    /**
     * @return bool
     */
    public function estValide()
    {
        $manager = $this->strategieValidation();
        $this->erreurs = $manager->valider($this->document);
        return count($this->erreurs) > 0 ? false : true;
    }

    /**
     * @return mixed
     */
    abstract public function strategieValidation();
}
