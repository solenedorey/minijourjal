<?php
namespace Sd\MiniJournal\Image;

use Sd\Framework\AbstractClasses\AbstractDocumentControleur;
use Sd\Framework\Managers\FileManager;
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
     * ImageControleur constructor.
     * @param Requete $requete
     * @param Reponse $reponse
     * @param $twig
     */
    public function __construct(Requete $requete, Reponse $reponse)
    {
        $this->imageBd = new ImageBd();
        $this->requete = $requete;
        parent::__construct($reponse);
    }

    /**
     *
     */
    public function afficherListe()
    {
        $images = $this->imageBd->lireTous();
        $this->afficheur('image/listImages.twig', array('images' => $images));
    }

    /**
     *
     */
    public function afficherDetail()
    {
        $idImage = $this->requete->getItemGet('idImage');
        $image = $this->imageBd->lire($idImage);
        $this->afficheur('image/detailsImage.twig', array('image' => $image));
    }

    /**
     *
     */
    public function editer()
    {
        if (!is_null($this->requete->getItemGet('idImage'))) {
            $idImage = $this->requete->getItemGet('idImage');
            $image = $this->imageBd->lire($idImage);
        } else {
            $image = Image::creerDocumentVide();
        }
        $this->afficheur('image/formImage.twig', array('image' => $image));
    }

    /**
     *
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
                $formData['fichier'] = $oldName;
            }
            $image->modifierDepuisTableau($formData);
        } else {
            $image = Image::creerDepuisTableau($formData);
        }
        $form = new ImageForm($image);
        if ($form->estValide()) {
            if ($this->requete->getItemFiles('fichier')['tmp_name'] !== '') {
                $path = IMAGE_BASEFILE . $oldName;
                if (is_file($path)){
                    unlink($path);
                }
                $fichier = new FileManager();
                $fichier = $fichier->upload($formData['fichier']);
                $image->setFichier($fichier);
            }
            $this->imageBd->persister($image) or die("Problème d'enregistrement en BD");
            $this->afficheur('image/detailsImage.twig', array('image' => $image));
        } else {
            $this->afficheur('image/formImage.twig', array('image' => $image, 'erreurs' => $form->getErreurs()));
        }
    }

    /**
     *
     */
    public function supprimer()
    {
        $idImage = $_GET['idImage'];
        $image = $this->imageBd->lire($idImage);
        $path = IMAGE_BASEFILE . $image->getFichier();
        unlink($path);
        $this->imageBd->supprimer($idImage);
        header('Location: index.php?objet=image&amp;action=afficherListe');
    }
}
