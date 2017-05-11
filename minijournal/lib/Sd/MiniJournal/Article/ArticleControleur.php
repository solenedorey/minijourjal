<?php
namespace Sd\MiniJournal\Article;

use Sd\Framework\AbstractClasses\AbstractControleur;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;
use Sd\MiniJournal\Image\ImageBd;

/**
 * Classe ArticleControleur
 * @package Sd\MiniJournal\Article
 */
class ArticleControleur extends AbstractControleur
{
    /**
     * @var ArticleBd
     */
    private $articleBd;

    /**
     * Constructeur de la classe ArticleControleur.
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->articleBd = new ArticleBd();
        parent::__construct($requete, $reponse);
    }

    /**
     *
     */
    public function inverseStatutPublication()
    {
        $idArticle = $this->requete->getItemGet('idArticle');
        $article = $this->articleBd->lire($idArticle);
        $this->roleManager->verifyAccess('auteur', $article);
        $article->setStatutPublication($article->getStatutPublication() == 2 ? 1 : 2);
        $article->setDatePublication($article->getStatutPublication() == 2 ? date('Y-m-d', time()) : null);
        $this->articleBd->persister($article);
        $this->afficherDetail();
    }

    /**
     * Action par défaut de l'objet Article -> affiche la liste des articles.
     */
    public function home()
    {
        $this->afficherListe();
    }

    /**
     * Afficher la liste des articles.
     */
    public function afficherListe()
    {
        if ($this->roleManager->verifyAccess('auteur', null, false)) {
            $articles = $this->articleBd->lireTous();
        } else {
            $articles = $this->articleBd->lireTous(true);
        }
        $this->afficheur('article/listArticles.twig', array('articles' => $articles));
    }

    /**
     * Voir un Article
     * - obtenir l'identifiant de l'article à partir de $_GET
     * - récupérer les infos de l'article et instancier un objet Article (méthode lire de ArticleBd)
     * - afficher l'Article
     */
    public function afficherDetail()
    {
        $idArticle = $this->requete->getItemGet('idArticle');
        $article = $this->articleBd->lire($idArticle);
        $this->afficheur('article/detailsArticle.twig', array('article' => $article));
    }

    /**
     * Création/modification d'un article :
     * - initialiser un article "vide" ou lecture en BD de l'article à modifier
     * - instancier l'objet gérant le formulaire et créer le formulaire
     */
    public function editer()
    {
        if (!is_null($this->requete->getItemGet('idArticle'))) {
            $idArticle = $this->requete->getItemGet('idArticle');
            $article = $this->articleBd->lire($idArticle);
            $this->roleManager->verifyAccess('auteur', $article);
        } else {
            $article = Article::creerDocumentVide();
            $this->roleManager->verifyAccess('auteur');
        }
        $imageBd = new ImageBd();
        $images = $imageBd->lireTous();
        $this->afficheur('article/formArticle.twig', array('article' => $article, 'images' => $images));
    }

    /**
     * Enregistrement d'un nouvel article :
     * - récupérer les données POST et les nettoyer
     * - initialiser un objet Article avec ces données ou bien lire l'article en BD et le modifier
     * - instancier un gestionnaire du formulaire
     * - demander au gestionnaire si les données sont valides :
     *     - si oui, enregister l'article en BD puis l'afficher
     *     - si non, réafficher le formulaire avec les erreurs
     */
    public function enregistrer()
    {
        $formData = ArticleForm::nettoyer($this->requete->getPost());
        if (!is_null($this->requete->getItemPost('id'))) {
            $idArticle = (int)$this->requete->getItemPost('id');
            $article = $this->articleBd->lire($idArticle);
            $article->modifierDepuisTableau($formData);
            $this->roleManager->verifyAccess('auteur', $article);
        } else {
            $article = Article::creerDepuisTableau($formData);
            $this->roleManager->verifyAccess('auteur');
        }
        $form = new ArticleForm($article);
        if ($form->estValide()) {
            $this->articleBd->persister($article) or die("Problème d'enregistrement en BD");
            $this->afficheur('article/detailsArticle.twig', array('article' => $article));
        } else {
            $images = (new ImageBd())->lireTous();
            $this->afficheur(
                'article/formArticle.twig',
                array('article' => $article,'images' => $images, 'erreurs' => $form->getErreurs())
            );
        }
    }

    /**
     * Supprime un article.
     */
    public function supprimer()
    {
        $idArticle = $_GET['idArticle'];
        $article = $this->articleBd->lire($idArticle);
        $this->roleManager->verifyAccess('auteur', $article);
        if ($article->getStatutPublication() == 1) {
            $this->articleBd->supprimer($idArticle);
        }
        $this->afficherListe();
    }
}
