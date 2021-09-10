<?php


class Produit
{
    private $id;
    private $designation;
    private $categorie;

    /**
     * Produit constructor.
     * @param $id
     * @param $designation
     * @param $categorie
     */
    public function __construct($id, $designation, Categorie $categorie)
    {
        $this->id = $id;
        $this->designation = $designation;
        $this->categorie = $categorie;
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
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie)
    {
        $this->categorie = $categorie;
    }


}