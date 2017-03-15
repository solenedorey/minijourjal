<?php

namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocumentForm;
use Sd\Framework\Managers\NettoyeurManager;
use Sd\Framework\Managers\ValidateurManager;
//Nettoyeurs
use Sd\Framework\Nettoyeur\StripTags;
use Sd\Framework\Nettoyeur\Trim;
//Validateurs
use Sd\Framework\Validateurs\ChaineNonVide;
use Sd\Framework\Validateurs\EmailValide;
use Sd\Framework\Validateurs\LongueurMini;
use Sd\Framework\Validateurs\LongueurMaxi;

class ArticleForm extends AbstractDocumentForm
{
    public static function strategieNettoyage()
    {
        $nettoyeurManager = new NettoyeurManager();
        $nettoyeurManager->ajouter('titre', new Trim())
            ->ajouter('titre', new StripTags())
            ->ajouter('auteur', new Trim())
            ->ajouter('auteur', new StripTags())
            ->ajouter('chapo', new Trim())
            ->ajouter('chapo', new StripTags())
            ->ajouter('contenu', new Trim())
            ->ajouter('contenu', new StripTags('<p><em><strong><u><ul><li>'));
        return $nettoyeurManager;
    }

    public function strategieValidation()
    {
        $validateurManager = new ValidateurManager();
        $validateurManager->ajouter('titre', new ChaineNonVide())
            ->ajouter('titre', new LongueurMaxi(255))
            ->ajouter('auteur', new ChaineNonVide())
            ->ajouter('auteur', new EmailValide())
            ->ajouter('chapo', new ChaineNonVide())
            ->ajouter('chapo', new LongueurMaxi(255))
            ->ajouter('contenu', new LongueurMini(255));
        return $validateurManager;
    }
}
