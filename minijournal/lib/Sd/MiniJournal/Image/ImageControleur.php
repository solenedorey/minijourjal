<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractControleur;
use Sd\Framework\Managers\FileManager;
use Sd\Framework\HttpFoundation\Reponse;
use Sd\Framework\HttpFoundation\Requete;

/**
 * Classe ImageControleur
 * @package Sd\MiniJournal\Image
 */
class ImageControleur extends AbstractControleur
{
    /**
     * @var ImageBd
     */
    private $imageBd;

    /**
     * Cosntructeur de la classe ImageControleur.
     * @param Requete $requete
     * @param Reponse $reponse
     */
    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->imageBd = new ImageBd();
        parent::__construct($requete, $reponse);
    }

    /**
     * Action par défaut de l'objet Image -> affiche la liste des images.
     */
    public function home()
    {
        $this->afficherListe();
    }

    /**
     * Afficher la liste des images.
     */
    public function afficherListe()
    {
        $images = $this->imageBd->lireTous();
        $this->afficheur('image/listImages.twig', array('images' => $images));
    }

    /**
     * Voir une Image
     * - obtenir l'identifiant de l'image à partir de $_GET
     * - récupérer les infos de l'image et instancier un objet Image (méthode lire de ArticleBd)
     * - afficher l'Image
     */
    public function afficherDetail()
    {
        $idImage = $this->requete->getItemGet('idImage');
        $image = $this->imageBd->lire($idImage);
        $this->afficheur('image/detailsImage.twig', array('image' => $image));
    }

    /**
     * Création/modification d'une image :
     * - initialiser une image "vide" ou lecture en BD de l'image à modifier
     * - instancier l'objet gérant le formulaire et créer le formulaire
     */
    public function editer()
    {
        if (!is_null($this->requete->getItemGet('idImage'))) {
            $idImage = $this->requete->getItemGet('idImage');
            $image = $this->imageBd->lire($idImage);
            $this->roleManager->verifyAccess('auteur', $image);
        } else {
            $image = Image::creerDocumentVide();
            $this->roleManager->verifyAccess('auteur');
        }
        $this->afficheur('image/formImage.twig', array('image' => $image));
    }

    /**
     * Enregistrement d'une nouvelle image :
     * - récupérer les données POST et les nettoyer
     * - initialiser un objet Image avec ces données ou bien lire l'image en BD et la modifier
     * - instancier un gestionnaire du formulaire
     * - demander au gestionnaire si les données sont valides :
     *     - si oui, enregister l'image en BD puis l'afficher
     *     - si non, réafficher le formulaire avec les erreurs
     */
    public function enregistrer()
    {
        $oldName = '';
        $formData = $this->requete->getPost();
        $formData['fichier'] = $this->requete->getItemFiles('fichier')['tmp_name'];
        $formData = ImageForm::nettoyer($formData);
        if (!is_null($this->requete->getItemPost('id'))) {
            $idImage = (int)$this->requete->getItemPost('id');
            $image = $this->imageBd->lire($idImage);
            $oldName = $image->getFichier();
            if ($formData['fichier'] === '') {
                $formData['fichier'] = IMAGE_BASEFILE . $oldName;
            }
            $image->modifierDepuisTableau($formData);
            $this->roleManager->verifyAccess('auteur', $image);
        } else {
            $image = Image::creerDepuisTableau($formData);
            $this->roleManager->verifyAccess('auteur');
        }
        $form = new ImageForm($image);
        if ($form->estValide()) {
            if ($this->requete->getItemFiles('fichier')['tmp_name'] !== '') {
                $path = IMAGE_BASEFILE . $oldName;
                if (is_file($path)) {
                    unlink($path);
                }
                $fichier = new FileManager();
                $fichier = $fichier->upload($formData['fichier']);
                $image->setFichier($fichier);
            } else {
                $image->setFichier($oldName);
            }
            $this->imageBd->persister($image) or die("Problème d'enregistrement en BD");
            $this->afficheur('image/detailsImage.twig', array('image' => $image));
        } else {
            $this->afficheur('image/formImage.twig', array('image' => $image, 'erreurs' => $form->getErreurs()));
        }
    }

    /**
     * Supprime l'Image.php
     */
    public function supprimer()
    {
        $idImage = $_GET['idImage'];
        $image = $this->imageBd->lire($idImage);
        $path = IMAGE_BASEFILE . $image->getFichier();
        unlink($path);
        $this->imageBd->supprimer($idImage);
        $this->afficherListe();
    }
}
