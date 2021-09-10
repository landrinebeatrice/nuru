<?php
class PaiementController extends Tm_Controller{

    ##################### action
    /**
     * affichage des paiement à la (vue)
     */
    public function liste(){
        $alertFlash=[];

        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST["update"])){
                //enregistrement du frais
                $this->add($alertFlash);
            }
        }

        $paiements = $this->getPaiements();

        $this->load->view("paiement/liste", compact("paiements", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
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


    ####################################### method

    /**
     * @param $id_paiement
     * @return Paiement|false
     */
    public function getFrais($id_paiement)
    {
        $this->load->model("PaiementModel");
        return PaiementModel::getPaiement($id_paiement);
    }

    /**
     * liste des paiements
     * @return array
     */
    public function getPaiements(){
        $this->load->model("PaiementModel");
        return PaiementModel::getPaiements();
    }

}