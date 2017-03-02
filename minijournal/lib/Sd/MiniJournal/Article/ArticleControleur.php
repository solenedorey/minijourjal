<?php

namespace Sd\MiniJournal\Article;

use Sd\Framework\Tools\Reponse;
use Sd\Framework\Tools\Requete;

class ArticleControleur
{
    private $articleBd;
    private $requete;
    private $reponse;
    private $twig;

    public function __construct(Requete $requete, Reponse $reponse, $twig)
    {
        $this->articleBd = new ArticleBd();
        $this->requete = $requete;
        $this->reponse = $reponse;
        $this->twig = $twig;

    }

    public function execute($action)
    {
        if (method_exists($this, $action)) {
            return $this->$action();
        } else {
            // que faire si l'action n'existe pas ??
            throw new \Exception("Action {$action} non trouvée");
        }
    }

    public function test()
    {
        echo $this->twig->render('index.twig', array(
            'moteur_name' => 'Twig'
        ));
    }

    public function afficherListe()
    {
        $this->reponse->ajouterFragment('titre', "Liste des articles");
        $articles = $this->articleBd->lireTous();
        $afficheur = new ArticleHtml();
        $contenu = $afficheur->liste($articles);
        $this->reponse->ajouterFragment('contenu', $contenu);
    }

    public function afficherDetail()
    {
        $this->reponse->ajouterFragment('titre', "Détail de l'article");
        $idArticle = $this->requete->getItemGet('idArticle');
        $article = $this->articleBd->lire($idArticle);
        $afficheur = new ArticleHtml();
        $this->reponse->ajouterFragment('contenu', $afficheur->article($article));
    }

    public function editer()
    {
        $this->reponse->ajouterFragment('titre', "Editer l'article");
        if (!is_null($this->requete->getItemGet('idArticle'))) {
            $idArticle = $this->requete->getItemGet('idArticle');
            $article = $this->articleBd->lire($idArticle);
        } else {
            $article = Article::creerArticleVide();
        }
        $form = new ArticleForm($article);
        $afficheur = new ArticleHtml();
        $this->reponse->ajouterFragment('contenu', $afficheur->formulaire($article, $form->getErreurs()));
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
            $this->reponse->ajouterFragment('titre', "Enregistrement de l'article");
            $this->articleBd->persister($article) or die("Problème d'enregistrement en BD");
            $this->reponse->ajouterFragment('contenu', (new ArticleHtml())->article($article));
        } else {
            $this->reponse->ajouterFragment('titre', "Compléter le formulaire");
            $this->reponse->ajouterFragment('contenu', $form->formulaire());
        }
    }

    public function supprimer()
    {
        $idArticle = $_GET['idArticle'];
        $this->articleBd->supprimer($idArticle);
        header('Location: index.php');
    }
}
