<?php
namespace Sd\Framework\AppInterfaces;

/**
 * Interface ValidateurInterface définissant les méthodes obligatoires pour tout objet de type Validateur.
 * @package Sd\Framework\AppInterfaces
 */
interface ValidateurInterface
{
    /**
     * @param $valeur
     * @return mixed
     */
    public function valider($valeur);

    /**
     * @return mixed
     */
    public function getMessage();
}
