<?php
namespace Sd\Framework\Validateurs;

use finfo;
use Sd\Framework\AppInterfaces\ValidateurInterface;

/**
 * Classe TypeMimeValide vérifiant le type mime d'un fichier.
 * @package Sd\Framework\Validateurs
 */
class TypeMimeValide implements ValidateurInterface
{
    /**
     * @var array
     */
    private $mimeListe;

    /**
     * Constructeur de la classse TypeMimeValide.
     * @param $mimeListe
     */
    public function __construct(array $mimeListe)
    {
        $this->mimeListe = $mimeListe;
    }

    /**
     * Retourne faux si le type mime du fichier n'est pas pris en compte et vrai au contraire.
     * @param $valeur
     * @return bool
     */
    public function valider($valeur)
    {
        if (file_exists($valeur)) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            return in_array($finfo->file($valeur), $this->mimeListe);
        }
        return false;
    }

    /**
     * Retourne le message à afficher en cas d'erreur.
     * @return string
     */
    public function getMessage()
    {
        return "Ce type de fichier n'est pas pris en compte.";
    }
}
