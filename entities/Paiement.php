<?php


class Paiement
{
    private $id;
    private $montant;
    private $date_paiement;
    private $eleve;
    private $utilisateur;
    private $frais;

    /**
     * Paiement constructor.
     * @param $id
     * @param $montant
     * @param $date_paiement
     * @param $eleve
     * @param $utilisateur
     * @param $frais
     */
    public function __construct($id, $montant, $date_paiement, Eleve $eleve, Utilisateur $utilisateur, Frais $frais)
    {
        $this->id = $id;
        $this->montant = $montant;
        $this->date_paiement = $date_paiement;
        $this->eleve = $eleve;
        $this->utilisateur = $utilisateur;
        $this->frais = $frais;
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
    public function getDatePaiement()
    {
        return $this->date_paiement;
    }

    /**
     * @param mixed $date_paiement
     */
    public function setDatePaiement($date_paiement)
    {
        $this->date_paiement = $date_paiement;
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

    /**
     * @return Frais
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * @param Frais $frais
     */
    public function setFrais(Frais $frais)
    {
        $this->frais = $frais;
    }

}