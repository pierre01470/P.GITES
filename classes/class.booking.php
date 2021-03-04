<?php
class Booking
{
    private $_idBooking;
    private $_idLodge;
    private $_arrival;
    private $_departure;


    /* -------------------------------- CONSTRUCT ------------------------------- */
    public function __construct(array $data)
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }


    /* --------------------------------- HYDRATE -------------------------------- */
    public function hydrate(array $element)
    {
        foreach ($element as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    /* --------------------------------- GETTER --------------------------------- */
    public function getIdBooking()
    {
        return $this->_idBooking;
    }

    public function getIdLodge()
    {
        return $this->_idLodge;
    }

    public function getArrival()
    {
        return $this->_arrival;
    }

    public function getDeparture()
    {
        return $this->_departure;
    }


    /* --------------------------------- SETTER --------------------------------- */
    public function setIdBooking(int $idBooking)
    {
        $this->_idBooking = $idBooking;
    }

    public function setIdLodge(int $idLodge)
    {
        $this->_idLodge = $idLodge;
    }
    public function setArrival($arrival)
    {
        $this->_arrival = $arrival;
    }
    public function setDeparture($departure)
    {
        $this->_departure = $departure;
    }
}
