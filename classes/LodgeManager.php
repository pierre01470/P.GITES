<?php
class LodgeManager
{
    private $_db;


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct($db)
    {
        $this->setDb($db);
    }


    /* --------------------------------- CREATE --------------------------------- */
   
    // FORM
    public function addLodge(Lodge $l)
    {
        try {
            $req = $this->_db->prepare('INSERT INTO `lodge` (`lodgename`,`bedroom`,`bathroom`,`price`,`arrival`,`departure`,`location`,`category`,`specificity`,`image`,`description`) VALUE (:lodgename, :bedroom, :bathroom, :price, :arrival, :departure, :location, :category, :specificity, :image, :description)');

            $req->bindValue(':lodgename', $l->getLodgename());
            $req->bindValue(':bedroom', $l->getBedroom());
            $req->bindValue(':bathroom', $l->getBathroom());
            $req->bindValue(':price', $l->getPrice());
            $req->bindValue(':arrival', $l->getArrival());
            $req->bindValue(':departure', $l->getDeparture());
            $req->bindValue(':location', $l->getLocation());
            $req->bindValue(':category', $l->getCategory());
            $req->bindValue(':specificity', $l->getSpecificity());
            $req->bindValue(':image', $l->getImage());
            $req->bindValue(':description', $l->getDescription());

            $req->execute();
        } catch (Exception $e) {
            echo 'Echec de la requete insert: ' . $e->getMessage();
        }
        
    }


    /* ---------------------------------- READ ---------------------------------- */
    // HISTORIQUE
    public function getListLodge()
    {
        $lodge = [];
        $req = $this->_db->query('SELECT * FROM `lodge` ORDER BY idlodge ASC');
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $lodge[] = new Lodge($donnees);
        }
        return $lodge;
    }


    /* --------------------------------- UPDATE --------------------------------- */

    public function getListid(int $idlodge) // préremplir form
    {
        $req = $this->_db->query('SELECT * FROM `lodge` WHERE idlodge = ' . $idlodge);
        return new Lodge($req->fetch(PDO::FETCH_ASSOC));
    }

    
        
    /* ------------------------------ UPDATE LODGE ------------------------------ */
    public function update(Lodge $l)
    {
        $req = $this->_db->prepare('UPDATE lodge SET `lodgename` = :lodgename, `bedroom` = :bedroom, `bathroom` = :bathroom, `price` = :price, `arrival` = :arrival, `departure` = :departure, `location` = :location, `category` = :category, `specificity` = :specificity, `image` = :image, `description` = :description WHERE `idlodge` = :id');

        $req->bindValue(':id', $l->getIdlodge(),PDO::PARAM_INT);
        $req->bindValue(':lodgename', $l->getLodgename());  
        $req->bindValue(':bedroom', $l->getBedroom());
        $req->bindValue(':bathroom', $l->getBathroom());
        $req->bindValue(':price', $l->getPrice());
        $req->bindValue(':arrival', $l->getArrival());
        $req->bindValue(':departure', $l->getDeparture());
        $req->bindValue(':location', $l->getLocation());
        $req->bindValue(':category', $l->getCategory());
        $req->bindValue(':specificity', $l->getSpecificity());
        $req->bindValue(':image', $l->getImage());
        $req->bindValue(':description', $l->getDescription());

        $req->execute();
    }

    /* --------------------------------- DELETE --------------------------------- */
    public function deleteLodge(Lodge $l)
    {
        $this->_db->query('DELETE FROM `lodge` WHERE idlodge = ' . $l->getIdLodge());
        header("Location: historique.php");
    }


    /* ---------------------------- ADD DISPONIBILITY --------------------------- */
    public function addDisponibility(Lodge $l)
    {
        $req = $this->_db->prepare('UPDATE lodge SET `arrival` = :arrival, `departure` = :departure WHERE `idlodge` = :id');
        $req->bindValue(':id', $l->getIdlodge(),PDO::PARAM_INT);
        $req->bindValue(':arrival', $l->getArrival());
        $req->bindValue(':departure', $l->getDeparture());
    }


    /* ------------------------------- SETTER --------------------------------- */
    public function setDb($db)
    {
        return $this->_db = $db;
    }
}



