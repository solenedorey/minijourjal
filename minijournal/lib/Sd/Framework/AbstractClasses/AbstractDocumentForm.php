<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\FormInterface;

/**
 * Classe AbstractDocumentForm
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
     * Constructeur de la classe AbstractDocumentForm.
     * @param AbstractDocument $document
     */
    public function __construct(AbstractDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Permet de récupérer une erreur.
     * @param $champ
     * @return string
     */
    public function getErreur($champ)
    {
        if (isset($this->erreurs[$champ])) {
            return '<span class="erreur">' . $this->erreurs[$champ] . '</span>';
        } else {
            return '';
        }
    }

    /**
     * @return mixed
     */
    public function getErreurs()
    {
        return $this->erreurs;
    }

    /**
     * Permet de récupérer les actions de nettoyage à réaliser sur les différentes valeurs
     * et d'exécuter ces actions.
     * @param $form
     * @return mixed
     */
    public static function nettoyer($form)
    {
        $manager = static::strategieNettoyage();
        $form = $manager->nettoyer($form);
        return $form;
    }

    /**
     * Permet de récupérer les actions de validation à réaliser sur les différentes valeurs
     * et d'exécuter ces actions.
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
