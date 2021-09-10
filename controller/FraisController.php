<?php
class FraisController extends Tm_Controller{

    ##################### action
    /**
     * affichage des frais à la (vue)
     */
    public function liste(){
        $alertFlash=[];

        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST["create"])){
                //enregistrement du frais
                $this->add($alertFlash);
            }elseif(isset($_POST["update"])){
                //modification du frais
                $this->update($alertFlash);
            }
        }

        $allFrais = $this->getAllFrais();

        $this->load->view("frais/liste", compact("allFrais", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("FraisModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));
            $montant = htmlspecialchars(trim($_POST["montant"]));
            $devise = htmlspecialchars(trim($_POST["devise"]));

            $frais = new Frais(null, $designation, $montant, $devise);
            FraisModel::insert($frais);

            $alertFlash = array("info" => "Le frais a été ajouté avec succes.");

        }
    }

    /**
     * modifier
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("FraisModel");

            $designation = htmlspecialchars(trim($_POST["designation"]));
            $montant = htmlspecialchars(trim($_POST["montant"]));
            $id_frais = $_POST["id_frais"];

            $frais = $this->getFrais($id_frais);
            $frais->setDesignation($designation);
            $frais->setMontant($montant);
            FraisModel::update($frais);

            $alertFlash = array("info" => "Le frais a été modifié avec succes.");

        }
    }


    ####################################### method

    /**
     * @param $id_frais
     * @return Frais|false
     */
    public function getFrais($id_frais)
    {
        $this->load->model("FraisModel");
        return FraisModel::getFrais($id_frais);
    }

    /**
     * liste des frais
     * @return array
     */
    public function getAllFrais(){
        $this->load->model("FraisModel");
        return FraisModel::getAllFrais();
    }

}