<?php


class Depense
{
    private $id;
    private $montant;
    private $motif;
    private $devise;
    private $date_depense;
    private $utilisateur;

    /**
     * Depense constructor.
     * @param $id
     * @param $montant
     * @param $motif
     * @param $devise
     * @param $date_depense
     * @param $utilisateur
     */
    public function __construct($id, $montant, $motif, $devise, $date_depense, Utilisateur $utilisateur)
    {
        $this->id = $id;
        $this->montant = $montant;
        $this->motif = $motif;
        $this->devise = $devise;
        $this->date_depense = $date_depense;
        $this->utilisateur = $utilisateur;
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

    /**
     * @return mixed
     */
    public function getDateDepense()
    {
        return $this->date_depense;
    }

    /**
     * @param mixed $date_depense
     */
    public function setDateDepense($date_depense)
    {
        $this->date_depense = $date_depense;
    }

    /**
     * @return Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param Utilisateur $utilisateur
     */
    public function setUtilisateur(Utilisateur $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

}