<?php
namespace Sd\Framework\AbstractClasses;

use Sd\Framework\AppInterfaces\PersistInterface;
use Jml\Tools\Database\ConnectionSingleton;

/**
 * Class AbstractDocumentBd
 * @package Sd\Framework\AbstractClasses
 */
abstract class AbstractDocumentBd implements PersistInterface
{
    /**
     * @var
     */
    protected $db;

    /**
     * AbstractDocumentBd constructor.
     */
    public function __construct()
    {
        $this->db = ConnectionSingleton::getInstance()->getConnexion();
    }

    /**
     * @param $requete
     * @param $return
     * @param null $param
     * @return bool
     */
    protected function requete($requete, $return, $param = null)
    {
        $stmt = $this->db->prepare($requete);
        $stmt->execute($param);
        return $return ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : true;
    }

    /**
     * @param $id
     * @return mixed
     */
    abstract public function lire($id);

    /**
     * @return mixed
     */
    abstract public function lireTous();

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    public function persister(AbstractDocument $document)
    {
        if (is_null($document->getId())) {
            return $this->enregistrer($document);
        } else {
            return $this->modifier($document);
        }
    }

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    abstract public function enregistrer(AbstractDocument $document);

    /**
     * @param AbstractDocument $document
     * @return mixed
     */
    abstract public function modifier(AbstractDocument $document);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function supprimer($id);
}
