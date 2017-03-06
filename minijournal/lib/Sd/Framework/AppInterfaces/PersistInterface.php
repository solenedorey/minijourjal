<?php
namespace Sd\Framework\AppInterfaces;

use Sd\Framework\AbstractClasses\Document;

interface PersistInterface
{
    public function lire($id);

    public function lireTous();

    public function persister(Document $document);

    public function enregistrer(Document $document);

    public function modifier(Document $document);

    public function supprimer($id);
}
