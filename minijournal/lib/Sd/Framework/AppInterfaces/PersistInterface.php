<?php
namespace Sd\Framework\AppInterfaces;

use Sd\Framework\AbstractClasses\AbstractDocument;

/**
 * Interface PersistInterface définissant les méthodes obligatoires pour tout objet de type Bd.
 * @package Sd\Framework\AppInterfaces
 */
interface PersistInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function lire($id);

    /**
     * @return mixed
     */
    public function lireTous();

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    public function persister(AbstractDocument $document);

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    public function enregistrer(AbstractDocument $document);

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    public function modifier(AbstractDocument $document);

    /**
     * @param $id
     * @return mixed
     */
    public function supprimer($id);
}
