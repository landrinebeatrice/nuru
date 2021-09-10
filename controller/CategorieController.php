<?php
class CategorieController extends Tm_Controller{

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

        $categories = $this->getCategories();

        $this->load->view("categorie/liste", compact("categories", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("CategorieModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));

            $categorie = new Categorie(null, $designation);
            CategorieModel::insert($categorie);

            $alertFlash = array("info" => "La categorie a été ajouté avec succes.");

        }
    }

    /**
     * modification
     * @param $alertFlash
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("CategorieModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));
            $id_categorie = $_POST["id_categorie"];

            $categorie = $this->getCategorie($id_categorie);
            $categorie->setDesignation($designation);
            CategorieModel::update($categorie);

            $alertFlash = array("info" => "La categorie a été modifiée avec succes.");
        }
    }


    ####################################### method

    /**
     * @param $id_categorie
     * @return Categorie|false
     */
    public function getCategorie($id_categorie)
    {
        $this->load->model("CategorieModel");
        return CategorieModel::getCategorie($id_categorie);
    }

    /**
     * liste des
     * @return array
     */
    public function getCategories(){
        $this->load->model("CategorieModel");
        return CategorieModel::getCategories();
    }

}