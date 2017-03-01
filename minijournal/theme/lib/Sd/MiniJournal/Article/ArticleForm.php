<?php

namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\DocumentForm;
use Sd\Framework\Validateur\ChaineNonVide;
use Sd\Framework\Validateur\EmailValide;
use Sd\Framework\Validateur\LongueurMini;
use Sd\Framework\Validateur\LongueurMaxi;
use Sd\Framework\Validateur\ValidateurManager;

class ArticleForm extends DocumentForm
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

    public function formulaire()
    {
        ob_start();
        include('theme/lib/Sd/MiniJournal/Article/Vues/form.php');
        $contenu = ob_get_contents();
        ob_end_clean();
        return $contenu;
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
