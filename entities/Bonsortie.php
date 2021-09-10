<?php


class Bonsortie
{
    private $id;
    private $description;
    private $date_bon;
    private $utilisateur;

    /**
     * Bonsortie constructor.
     * @param $id
     * @param $description
     * @param $date_bon
     * @param $utilisateur
     */
    public function __construct($id, $description, $date_bon, Utilisateur $utilisateur)
    {
        $this->id = $id;
        $this->description = $description;
        $this->date_bon = $date_bon;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateBon()
    {
        return $this->date_bon;
    }

    /**
     * @param mixed $date_bon
     */
    public function setDateBon($date_bon)
    {
        $this->date_bon = $date_bon;
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