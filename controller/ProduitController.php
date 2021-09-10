<?php
class ProduitController extends Tm_Controller{

    ##################### action
    /**
     * affichage des  à la (vue)
     */
    public function liste(){
        $alertFlash=[];

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST["create"])){
                //enregistrement
                $this->add($alertFlash);
            }elseif(isset($_POST["update"])){
                //modification
                $this->update($alertFlash);
            }
        }

        $categorieController = new CategorieController();
        $categories = $categorieController->getCategories();
        $produits = $this->getProduits();

        $this->load->view("produit/liste", compact("produits", "categories", "alertFlash"));
    }

    /**
     * affoichage stock
     */
    public function stock(){
        $alertFlash=[];

        $categorieController = new CategorieController();
        $categories = $categorieController->getCategories();
        $produits = $this->getProduits();

        $this->load->view("produit/stock", compact("produits", "categories", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("ProduitModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));
            $id_categorie = htmlspecialchars(trim($_POST["id_categorie"]));

            $categorieController = new CategorieController();
            $categorie = $categorieController->getCategorie($id_categorie);

            $produit = new Produit(null, $designation, $categorie);
            ProduitModel::insert($produit);

            $designation_categorie = ucfirst($categorie->getDesignation());
            $alertFlash = array("info" => "Le produit a été ajouté avec succes dans la categorie <b>{$designation_categorie}</b>.");

        }
    }

    /**
     * @param $alertFlash
     * modification
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("ProduitModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));
            $id_categorie = htmlspecialchars(trim($_POST["id_categorie"]));
            $id_produit = $_POST["id_produit"];

            $categorieController = new CategorieController();
            $categorie = $categorieController->getCategorie($id_categorie);

            $produit = $this->getProduit($id_produit);
            $produit->setDesignation($designation);
            $produit->setCategorie($categorie);
            ProduitModel::update($produit);

            $designation_categorie = ucfirst($categorie->getDesignation());
            $alertFlash = array("info" => "Le produit a été modifié avec succes dans la categorie <b>{$designation_categorie}</b>.");

        }
    }


    ####################################### method

    /**
     * @param $id_produit
     * @return Produit|false
     */
    public function getProduit($id_produit)
    {
        $this->load->model("ProduitModel");
        return ProduitModel::getProduit($id_produit);
    }

    /**
     * liste des
     * @return array
     */
    public function getProduits(){
        $this->load->model("ProduitModel");
        return ProduitModel::getProduits();
    }

    /**
     * retourne le total quantité entrée du produit
     * @param Produit $produit
     * @return int
     */
    public function getTotalQteEntree(Produit $produit)
    {
        $this->load->model("ProduitModel");
        $qte_entree = ProduitModel::getTotalQte($produit, "entree");

        return ($qte_entree) ? $qte_entree : 0;
    }

    /**
     * retourne le total quantité sortie du produit
     * @param Produit $produit
     * @return int
     */
    public function getTotalQteSortie(Produit $produit)
    {
        $this->load->model("ProduitModel");
        $qte_sortie = ProduitModel::getTotalQte($produit, "sortie");

        return ($qte_sortie) ? $qte_sortie : 0;
    }

    /**
     * retourne le stock final du produit
     * @param Produit $produit
     * @return int
     */
    public function getStockFinal(Produit $produit)
    {
        $qte_entree = $this->getTotalQteEntree($produit);
        $qte_sortie = $this->getTotalQteSortie($produit);

        return ($qte_entree-$qte_sortie);
    }

}