<?php
namespace Sd\MiniJournal\Article;

class ArticleHtml
{
    public function liste($articles)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Article/Vues/list.php');
        $liste = ob_get_contents();
        ob_end_clean();
        return $liste;
    }

    public function article($article)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Article/Vues/details.php');
        $detailsArticle = ob_get_contents();
        ob_end_clean();
        return $detailsArticle;
    }

    public static function formulaire($article, $erreurs)
    {
        ob_start();
        include('lib/Sd/MiniJournal/Article/Vues/form.php');
        $contenu = ob_get_contents();
        ob_end_clean();
        return $contenu;
    }
}
