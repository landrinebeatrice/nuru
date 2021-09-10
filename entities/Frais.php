<?php


class Frais
{
    private $id;
    private $designation;
    private $montant;
    private $devise;

    /**
     * Frais constructor.
     * @param $id
     * @param $designation
     * @param $montant
     * @param $devise
     */
    public function __construct($id, $designation, $montant, $devise)
    {
        $this->id = $id;
        $this->designation = $designation;
        $this->montant = $montant;
        $this->devise = $devise;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @param mixed $devise
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;
    }

}