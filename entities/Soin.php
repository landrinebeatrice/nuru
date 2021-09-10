<?php


class Soin
{
    private $id;
    private $motif;
    private $date_soin;
    private $eleve;

    /**
     * Soin constructor.
     * @param $id
     * @param $motif
     * @param $date_soin
     * @param $eleve
     */
    public function __construct($id, $motif, $date_soin, Eleve $eleve)
    {
        $this->id = $id;
        $this->motif = $motif;
        $this->date_soin = $date_soin;
        $this->eleve = $eleve;
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
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param mixed $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    /**
     * @return mixed
     */
    public function getDateSoin()
    {
        return $this->date_soin;
    }

    /**
     * @param mixed $date_soin
     */
    public function setDateSoin($date_soin)
    {
        $this->date_soin = $date_soin;
    }

    /**
     * @return Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param Eleve $eleve
     */
    public function setEleve(Eleve $eleve)
    {
        $this->eleve = $eleve;
    }

}