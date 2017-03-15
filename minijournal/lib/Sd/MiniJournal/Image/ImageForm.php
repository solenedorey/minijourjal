<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocumentForm;
use Sd\Framework\Managers\NettoyeurManager;
use Sd\Framework\Managers\ValidateurManager;
//Nettoyeurs
use Sd\Framework\Nettoyeur\StripTags;
use Sd\Framework\Nettoyeur\Trim;
//Validateurs
use Sd\Framework\Validateurs\ChaineNonVide;
use Sd\Framework\Validateurs\EmailValide;
use Sd\Framework\Validateurs\LongueurMaxi;
use Sd\Framework\Validateurs\TailleFichierValide;
use Sd\Framework\Validateurs\TypeMimeValide;


class ImageForm extends AbstractDocumentForm
{
    public static function strategieNettoyage()
    {
        $nettoyeurManager = new NettoyeurManager();
        $nettoyeurManager->ajouter('titre', new Trim())
            ->ajouter('titre', new StripTags())
            ->ajouter('auteur', new Trim())
            ->ajouter('auteur', new StripTags());
        return $nettoyeurManager;
    }

    public function strategieValidation()
    {
        $validateurManager = new ValidateurManager();
        $validateurManager->ajouter('titre', new ChaineNonVide())
            ->ajouter('titre', new LongueurMaxi(255))
            ->ajouter('auteur', new ChaineNonVide())
            ->ajouter('auteur', new EmailValide())
            ->ajouter('fichier', new TypeMimeValide(array('image/jpeg')))
            ->ajouter('fichier', new TailleFichierValide(3145728));
        return $validateurManager;
    }
}
