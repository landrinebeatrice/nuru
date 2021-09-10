<?php


class Don
{
    private $id;
    private $cout;
    private $nom_bienfaiteur;
    private $date_don;
    private $utilisateur;

    /**
     * Don constructor.
     * @param $id
     * @param $cout
     * @param $nom_bienfaiteur
     * @param $date_don
     * @param $utilisateur
     */
    public function __construct($id, $cout, $nom_bienfaiteur, $date_don, Utilisateur $utilisateur)
    {
        $this->id = $id;
        $this->cout = $cout;
        $this->nom_bienfaiteur = $nom_bienfaiteur;
        $this->date_don = $date_don;
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
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @param mixed $cout
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    }

    /**
     * @return mixed
     */
    public function getNomBienfaiteur()
    {
        return $this->nom_bienfaiteur;
    }

    /**
     * @param mixed $nom_bienfaiteur
     */
    public function setNomBienfaiteur($nom_bienfaiteur)
    {
        $this->nom_bienfaiteur = $nom_bienfaiteur;
    }

    /**
     * @return mixed
     */
    public function getDateDon()
    {
        return $this->date_don;
    }

    /**
     * @param mixed $date_don
     */
    public function setDateDon($date_don)
    {
        $this->date_don = $date_don;
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