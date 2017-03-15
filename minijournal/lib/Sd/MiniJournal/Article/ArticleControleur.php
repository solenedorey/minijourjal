<?php

namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractDocumentControleur;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

class ArticleControleur extends AbstractDocumentControleur
{
    private $articleBd;
    private $requete;

    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->articleBd = new ArticleBd();
        $this->requete = $requete;
        parent::__construct($reponse);
    }

    public function afficherListe()
    {
        $articles = $this->articleBd->lireTous();
        $this->afficheur('article/listArticles.twig', array('articles' => $articles));
    }

    public function afficherDetail()
    {
        $idArticle = $this->requete->getItemGet('idArticle');
        $article = $this->articleBd->lire($idArticle);
        $this->afficheur('article/detailsArticle.twig', array('article' => $article));
    }

    public function editer()
    {
        if (!is_null($this->requete->getItemGet('idArticle'))) {
            $idArticle = $this->requete->getItemGet('idArticle');
            $article = $this->articleBd->lire($idArticle);
        } else {
            $article = Article::creerDocumentVide();
        }
        $this->afficheur('article/formArticle.twig', array('article' => $article));
    }

    public function enregistrer()
    {
        $formData = ArticleForm::nettoyer($this->requete->getPost());
        if (!is_null($this->requete->getItemPost('id'))) {
            $idArticle = (int)$this->requete->getItemPost('id');
            $article = $this->articleBd->lire($idArticle);
            $article->modifierDepuisTableau($formData);
        } else {
            $article = Article::creerDepuisTableau($formData);
        }
        $form = new ArticleForm($article);
        if ($form->estValide()) {
            $this->articleBd->persister($article) or die("Problème d'enregistrement en BD");
            $this->afficheur('article/detailsArticle.twig', array('article' => $article));
        } else {
            $this->afficheur('article/formArticle.twig', array('article' => $article, 'erreurs' => $form->getErreurs()));
        }
    }

    public function supprimer()
    {
        $idArticle = $_GET['idArticle'];
        $this->articleBd->supprimer($idArticle);
        header('Location: index.php?objet=article&amp;action=afficherListe');
    }
}
