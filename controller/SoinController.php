<?php
class SoinController extends Tm_Controller{

    ##################### action
    /**
     * affichage des  à la (vue)
     */
    public function liste($alertFlash = []){
        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST["update"])){
                //modification
                $this->update($alertFlash);
            }
        }

        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();
        $soins = $this->getSoins();

        $this->load->view("soin/liste", compact("soins", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("SoinModel");

            $motif = htmlspecialchars(trim($_POST["motif"]));
            $id_eleve = htmlspecialchars(trim($_POST["id_eleve"]));
            $date_soin = date("Y-m-d");

            $eleveController = new EleveController();
            $eleve = $eleveController->getEleve($id_eleve);

            $soin = new Soin(null, $motif, $date_soin, $eleve);
            SoinModel::insert($soin);

            $alertFlash = array("info" => "soin enregistré avec succès");
        }
        //redirection
        $eleveController = new EleveController();
        $eleveController->liste($alertFlash);
    }

    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("SoinModel");

            $motif = htmlspecialchars(trim($_POST["motif"]));
            $id_soin = $_POST["id_soin"];

            $soin = $this->getSoin($id_soin);
            $soin->setMotif($motif);
            SoinModel::update($soin);

            $alertFlash = array("info" => "soin modifié avec succès");
        }
    }

    ####################################### method

    /**
     * @param $id_soin
     * @return Soin|false
     */
    public function getSoin($id_soin)
    {
        $this->load->model("SoinModel");
        return SoinModel::getSoin($id_soin);
    }

    /**
     * liste des
     * @return array
     */
    public function getSoins(){
        $this->load->model("SoinModel");
        return SoinModel::getSoins();
    }

}