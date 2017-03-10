<?php
namespace Sd\Framework\FileManager;

class FileManager
{
    public function upload($tmp_name)
    {
        $extension = $this->getExtension($tmp_name);
        $newName = $this->creerNomUnique('img_') . $extension;
        $newPath = 'assets' . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'images';
        $fullPath = $newPath . DIRECTORY_SEPARATOR . $newName;
        if (is_dir($newPath)) {
            move_uploaded_file($tmp_name, $fullPath);
        }
        return $fullPath;
    }

    public function getExtension($file)
    {
        $type = getimagesize($file);
        $type = image_type_to_extension($type[2]);
        return $type;
    }

    public function creerNomUnique($prefix = null)
    {
        $name = uniqid($prefix);
        return $name;
    }
}
