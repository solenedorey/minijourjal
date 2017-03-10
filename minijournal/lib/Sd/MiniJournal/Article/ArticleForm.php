<?php

namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocumentForm;
use Sd\Framework\Validateur\ChaineNonVide;
use Sd\Framework\Validateur\EmailValide;
use Sd\Framework\Validateur\LongueurMini;
use Sd\Framework\Validateur\LongueurMaxi;
use Sd\Framework\Validateur\ValidateurManager;

class ArticleForm extends AbstractDocumentForm
{
    public static function nettoyer($form)
    {
        foreach ($form as $key => &$value) {
            $value = trim($value);
            if ($key !== 'contenu') {
                $value = strip_tags($value);
            } else {
                $value = strip_tags($value, '<br>');
            }
        }
        return $form;
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
