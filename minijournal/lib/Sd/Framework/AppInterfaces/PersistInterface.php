<?php
namespace Sd\Framework\AppInterfaces;

use Sd\Framework\AbstractClasses\AbstractDocument;

interface PersistInterface
{
    public function lire($id);

    public function lireTous();

    public function persister(AbstractDocument $document);

    public function enregistrer(AbstractDocument $document);

    public function modifier(AbstractDocument $document);

    public function supprimer($id);
}
