<?php
namespace Sd\Framework\Managers;

use Sd\Framework\AppInterfaces\NettoyeurInterface;

class NettoyeurManager
{
    private $nettoyeurs = array();

    public function ajouter($propriete, NettoyeurInterface $nettoyeur)
    {
        $this->nettoyeurs[] = [$propriete, $nettoyeur];
        return $this;
    }

    public function nettoyer($form)
    {
        foreach ($this->nettoyeurs as $nettoyeurItem) {
            $propriete = $nettoyeurItem[0];
            $nettoyeur = $nettoyeurItem[1];
            $form[$propriete] = $nettoyeur->nettoyer($form[$propriete]);
        }
        return $form;
    }
}