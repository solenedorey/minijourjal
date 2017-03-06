<?php
namespace Sd\Framework\Validateur;

use Sd\Framework\AppInterfaces\ValidateurInterface;

class ValidateurManager
{
    private $validateurs = array();

    public function ajouter($propriete, ValidateurInterface $validateur)
    {
        $this->validateurs[] = [$propriete, $validateur];
        return $this;
    }

    public function valider($objet)
    {
        $erreurs =array();
        foreach ($this->validateurs as $validateurItem) {
            $propriete = $validateurItem[0];
            $validateur = $validateurItem[1];
            // le getter est de la forme getTitre
            // il faut donc prendre la propriété avec la 1ère lettre en majuscule
            $getter = 'get' . ucfirst($propriete);
            if (!method_exists($objet, $getter)) {
                // si le getter n'existe pas => lever Exception
                $message = "Méthode {$getter} non existante pour la classe " . get_class($objet);
                throw new Exception($message);
            }
            // récupérer la valeur à vérifier
            $value = $objet->$getter();

            if (! $validateur->valider($value)) {
                // la validation a échoué => ajouter un message d'erreur.
                $erreurs[$propriete] = $validateur->getMessage();
            }
        }
        return $erreurs;
    }
}
