<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\PersistInterface;
use Jml\Tools\Database\ConnectionSingleton;

abstract class DocumentBd implements PersistInterface
{
    protected $db;

    public function __construct()
    {
        $this->db = ConnectionSingleton::getInstance()->getConnexion();
    }

    protected function requete($requete, $param = null)
    {
        $arrayReturn = array();
        $stmt = $this->db->prepare($requete);
        if ($param != null) {
            $stmt->execute($param);
        } else {
            $stmt->execute();
        }
        if ($resultats = $stmt->fetchAll(\PDO::FETCH_ASSOC)) {
            foreach ($resultats as $row) {
                array_push($arrayReturn, $row);
            }
            return $arrayReturn;
        } else {
            return false;
        }
    }

    abstract public function lire($id);

    abstract public function lireTous();

    public function persister(Document $document)
    {
        if (is_null($document->getId())) {
            return $this->enregistrer($document);
        } else {
            return $this->modifier($document);
        }
    }

    abstract public function enregistrer(Document $document);

    abstract public function modifier(Document $document);

    abstract public function supprimer($id);
}