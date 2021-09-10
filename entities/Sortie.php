<?php


class Sortie
{
    private $id;
    private $qte_sortie;
    private $date_sortie;
    private $produit;
    private $bon_sortie;

    /**
     * Sortie constructor.
     * @param $id
     * @param $qte_sortie
     * @param $date_sortie
     * @param $produit
     * @param $bon_sortie
     */
    public function __construct($id, $qte_sortie, $date_sortie, Produit $produit, Bonsortie $bon_sortie)
    {
        $this->id = $id;
        $this->qte_sortie = $qte_sortie;
        $this->date_sortie = $date_sortie;
        $this->produit = $produit;
        $this->bon_sortie = $bon_sortie;
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
    public function getQteSortie()
    {
        return $this->qte_sortie;
    }

    /**
     * @param mixed $qte_sortie
     */
    public function setQteSortie($qte_sortie)
    {
        $this->qte_sortie = $qte_sortie;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * @param mixed $date_sortie
     */
    public function setDateSortie($date_sortie)
    {
        $this->date_sortie = $date_sortie;
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

    /**
     * @return Bonsortie
     */
    public function getBonSortie()
    {
        return $this->bon_sortie;
    }

    /**
     * @param Bonsortie $bon_sortie
     */
    public function setBonSortie(Bonsortie $bon_sortie)
    {
        $this->bon_sortie = $bon_sortie;
    }

}