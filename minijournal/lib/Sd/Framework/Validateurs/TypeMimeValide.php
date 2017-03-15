<?php
namespace Sd\Framework\Validateurs;

use finfo;
use Sd\Framework\AppInterfaces\ValidateurInterface;

class TypeMimeValide implements ValidateurInterface
{
    private $mimeListe;

    /**
     * TypeMimeValide constructor.
     * @param $mimeListe
     */
    public function __construct(array $mimeListe)
    {
        $this->mimeListe = $mimeListe;
    }

    public function valider($valeur)
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        return in_array($finfo->file($valeur), $this->mimeListe);
    }

    public function getMessage()
    {
        return "Ce type de fichier n'est pas pris en compte.";
    }
}