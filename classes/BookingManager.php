<?php
class BookingManager
{
    private $_db;


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct($db)
    {
        $this->setDb($db);
    }


    /* --------------------------------- CREATE --------------------------------- */
    public function addBooking(Booking $b)
    {
        try {
            $req = $this->_db->prepare('INSERT INTO `booking` (`idlodge`, `arrival`, `departure`) VALUES (:idlodge , :arrival , :departure)');
            $req->bindValue(':idlodge', $b->getIdLodge());
            $req->bindValue(':arrival', $b->getArrival());
            $req->bindValue(':departure', $b->getDeparture());

            $req->execute();
        } catch (Exception $e) {
            echo 'Echec de la requete insert: ' . $e->getMessage();
        }
    }


    /* --------------------------------- SETTER --------------------------------- */
    public function setDb($db)
    {
        return $this->_db = $db;
    }
}
