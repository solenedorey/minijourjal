<?php
namespace Sd\MiniJournal\Image;

class ImageHtml
{
    public function liste($images)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Image/Vues/list.php');
        $liste = ob_get_contents();
        ob_end_clean();
        return $liste;
    }

    public function image($image)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Image/Vues/details.php');
        $detailsImage = ob_get_contents();
        ob_end_clean();
        return $detailsImage;
    }

    public function formulaire($image, $erreurs)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Image/Vues/form.php');
        $contenu = ob_get_contents();
        ob_end_clean();
        return $contenu;
    }
}