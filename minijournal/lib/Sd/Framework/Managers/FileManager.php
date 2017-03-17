<?php
namespace Sd\Framework\Managers;

/**
 * Classe FileManager gérant l'upload de fichiers.
 * @package Sd\Framework\Managers
 */
class FileManager
{
    /**
     * Permet de renommer et de déplacer le fichier uploadé.
     * @param $tmp_name
     * @return string
     */
    public function upload($tmp_name)
    {
        $extension = $this->getExtension($tmp_name);
        $newName = $this->creerNomUnique('img_') . $extension;
        $newPath = 'assets' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'images';
        $fullPath = $newPath . DIRECTORY_SEPARATOR . $newName;
        if (!is_dir($newPath)) {
            mkdir($newPath, 0777, true);
        }
        move_uploaded_file($tmp_name, $fullPath);
        return $newName;
    }

    /**
     * Permet de récupérer l'extension du fichier.
     * @param $file
     * @return array|string
     */
    public function getExtension($file)
    {
        $type = getimagesize($file);
        $type = image_type_to_extension($type[2]);
        return $type;
    }

    /**
     * Permet de créer un nom unique.
     * @param null $prefix
     * @return string
     */
    public function creerNomUnique($prefix = null)
    {
        $name = uniqid($prefix);
        return $name;
    }
}
