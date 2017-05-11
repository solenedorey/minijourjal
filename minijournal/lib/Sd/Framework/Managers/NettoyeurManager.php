<?php
namespace Sd\Framework\Managers;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

/**
 * Classe NettoyeurManager gérant les nettoyeurs.
 * @package Sd\Framework\Managers
 */
class NettoyeurManager
{
    /**
     * @var array
     */
    private $nettoyeurs = array();

    /**
     * Permet de définir les nettoyeurs à utiliser sur une valeur donnée.
     * @param $propriete
     * @param NettoyeurInterface $nettoyeur
     * @return $this
     */
    public function ajouter($propriete, NettoyeurInterface $nettoyeur)
    {
        $this->nettoyeurs[] = [$propriete, $nettoyeur];
        return $this;
    }

    /**
     * Permet d'exécuter le nettoyage selon la liste des nettoyeurs.
     * @param $form
     * @return mixed
     */
    public function nettoyer($form)
    {
        foreach ($this->nettoyeurs as $nettoyeurItem) {
            $propriete = $nettoyeurItem[0];
            $nettoyeur = $nettoyeurItem[1];
            if (isset($form[$propriete])) {
                $form[$propriete] = $nettoyeur->nettoyer($form[$propriete]);
            }
        }
        return $form;
    }
}
