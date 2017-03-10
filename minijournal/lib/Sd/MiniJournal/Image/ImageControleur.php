<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocumentControleur;
use Sd\Framework\FileManager\FileManager;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

class ImageControleur extends AbstractDocumentControleur
{
    /**
     * @var ImageBd
     */
    private $imageBd;
    /**
     * @var Requete
     */
    private $requete;
    /**
     * @var Reponse
     */
    private $reponse;
    /**
     * @var
     */
    private $twig;

    /**
     * ImageControleur constructor.
     * @param Requete $requete
     * @param Reponse $reponse
     * @param $twig
     */
    public function __construct(Requete $requete, Reponse $reponse, $twig)
    {
        $this->imageBd = new ImageBd();
        $this->requete = $requete;
        $this->reponse = $reponse;
        $this->twig = $twig;
    }

    /**
     *
     */
    public function afficherListe()
    {
        $this->reponse->ajouterFragment('titre', "Liste des images");
        $images = $this->imageBd->lireTous();
        $afficheur = new ImageHtml();
        $contenu = $afficheur->liste($images);
        $this->reponse->ajouterFragment('contenu', $contenu);
    }

    /**
     *
     */
    public function afficherDetail()
    {
        $this->reponse->ajouterFragment('titre', "Détail de l'image");
        $idImage = $this->requete->getItemGet('idImage');
        $image = $this->imageBd->lire($idImage);
        $afficheur = new ImageHtml();
        $this->reponse->ajouterFragment('contenu', $afficheur->image($image));
    }

    /**
     *
     */
    public function editer()
    {
        if (!is_null($this->requete->getItemGet('idImage'))) {
            $this->reponse->ajouterFragment('titre', "Modifier l'image");
            $idImage = $this->requete->getItemGet('idImage');
            $image = $this->imageBd->lire($idImage);
        } else {
            $this->reponse->ajouterFragment('titre', "Editer l'image");
            $image = Image::creerDocumentVide();
        }
        $form = new ImageForm($image);
        $afficheur = new ImageHtml();
        $this->reponse->ajouterFragment('contenu', $afficheur->formulaire($image, $form->getErreurs()));
    }

    /**
     *
     */
    public function enregistrer()
    {
        $formData = $this->requete->getPost();
        $formData['fichier'] = $this->requete->getItemFiles('fichier')['tmp_name'];
        $formData = ImageForm::nettoyer($formData);
        if (!is_null($this->requete->getItemPost('id'))) {
            $idImage = (int)$this->requete->getItemPost('id');
            $image = $this->imageBd->lire($idImage);
            $image->modifierDepuisTableau($formData);
        } else {
            $image = Image::creerDepuisTableau($formData);
        }
        $form = new ImageForm($image);
        if ($form->estValide()) {
            $fichier = new FileManager();
            $fichier = $fichier->upload($formData['fichier']);
            $image->setFichier($fichier);
            $this->reponse->ajouterFragment('titre', "Enregistrement de l'image");
            $this->imageBd->persister($image) or die("Problème d'enregistrement en BD");
            $this->reponse->ajouterFragment('contenu', (new ImageHtml())->image($image));
        } else {
            $this->reponse->ajouterFragment('titre', "Compléter le formulaire");
            $afficheur = new ImageHtml();
            $this->reponse->ajouterFragment('contenu', $afficheur->formulaire($image, $form->getErreurs()));
        }
    }

    /**
     *
     */
    public function supprimer()
    {
        $idImage = $_GET['idImage'];
        $image = $this->imageBd->lire($idImage);
        $path = $image->getFichier();
        unlink($path);
        $this->imageBd->supprimer($idImage);
        header('Location: index.php?objet=image&amp;action=afficherListe');
    }
}