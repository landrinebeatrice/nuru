<?php


class Entree
{
    private $id;
    private $qte_entree;
    private $date_entree;
    private $don;
    private $produit;

    /**
     * Entree constructor.
     * @param $id
     * @param $qte_entree
     * @param $date_entree
     * @param $don
     * @param $produit
     */
    public function __construct($id, $qte_entree, $date_entree, Don $don, Produit $produit)
    {
        $this->id = $id;
        $this->qte_entree = $qte_entree;
        $this->date_entree = $date_entree;
        $this->don = $don;
        $this->produit = $produit;
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
    public function getQteEntree()
    {
        return $this->qte_entree;
    }

    /**
     * @param mixed $qte_entree
     */
    public function setQteEntree($qte_entree)
    {
        $this->qte_entree = $qte_entree;
    }

    /**
     * @return mixed
     */
    public function getDateEntree()
    {
        return $this->date_entree;
    }

    /**
     * @param mixed $date_entree
     */
    public function setDateEntree($date_entree)
    {
        $this->date_entree = $date_entree;
    }

    /**
     * @return Don
     */
    public function getDon()
    {
        return $this->don;
    }

    /**
     * @param Don $don
     */
    public function setDon(Don $don)
    {
        $this->don = $don;
    }

    /**
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param Produit $produit
     */
    public function setProduit(Produit $produit)
    {
        $this->produit = $produit;
    }

}