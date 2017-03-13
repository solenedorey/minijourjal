<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocumentForm;
use Sd\Framework\Validateur\ChaineNonVide;
use Sd\Framework\Validateur\EmailValide;
use Sd\Framework\Validateur\LongueurMaxi;
use Sd\Framework\Managers\ValidateurManager;

class ImageForm extends AbstractDocumentForm
{
    public static function nettoyer($form)
    {
        foreach ($form as $key => &$value) {
            $value = trim($value);
            $value = strip_tags($value);
        }
        return $form;
    }

    public function strategieValidation()
    {
        $validateurManager = new ValidateurManager();
        $validateurManager->ajouter('titre', new ChaineNonVide())
            ->ajouter('titre', new LongueurMaxi(255))
            ->ajouter('auteur', new ChaineNonVide())
            ->ajouter('auteur', new EmailValide());
        return $validateurManager;
    }
}
