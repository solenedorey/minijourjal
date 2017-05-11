<?php
namespace Sd\MiniJournal\Managers;

use Sd\Framework\AbstractClasses\AbstractDocument;
use Sd\Framework\Exceptions\AccessDeniedException;
use Sd\Framework\Managers\AuthentificationManager;

/**
 * Class RoleManager permettant de gérer les droits d'accès.
 * @package Sd\MiniJournal\Managers
 */
class RoleManager
{
    /**
     * $instance est privée pour implémenter le pattern Singleton
     * et être sûr qu'il n'y a qu'une et une seule instance
     */
    private static $instance;

    /**
     * Méthode pour accéder à l'UNIQUE instance de la classe.
     * @return RoleManager , l'instance du singleton
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * Permet de vérifier les droits d'accès.
     * @param $statut
     * @param AbstractDocument|null $document
     * @param bool $exception
     * @return bool
     * @throws AccessDeniedException
     */
    public function verifyAccess($statut, AbstractDocument $document = null, $exception = true)
    {
        $authManager = AuthentificationManager::getInstance();
        $statutUtilisateur = $authManager->getInfoUtilisateur('statut');
        if ($statutUtilisateur == 'admin') {
            return true;
        }
        if ($statutUtilisateur !== $statut) {
            if ($exception) {
                throw new AccessDeniedException();
            } else {
                return false;
            }
        }
        if ($document !== null && $document->getAuteur() !== $authManager->getInfoUtilisateur('login')) {
            if ($exception) {
                throw new AccessDeniedException();
            } else {
                return false;
            }
        }
        return true;
    }
}
