<?php
class DateController extends Tm_Controller{
    /**
     * @action modify current monthSystem
     */
    public function configuration(){
        if(!empty($_POST)){
            $url_redirect = $_POST["current_url"];
            if(isset($_POST["dateSystemSelected"])){
                $_SESSION["dateSysteme"] = $_POST["dateSystemSelected"];

            }elseif(isset($_POST["moisSystemSelected"])){
                $_SESSION["moisSysteme"] = $_POST["moisSystemSelected"];;

            }elseif(isset($_POST["anneeSystemSelected"])){
                $_SESSION["anneeSysteme"] = $_POST["anneeSystemSelected"];;
            }

            //actualisation page actuelle de l'utilisateur
            self::redirect($url_redirect);
        }else{
            //redirect home
            self::redirect("index.php?m=tm.error");
        }
    }

    /**
     * enregistre la date du jour
     * @throws Exception
     */
    public function addDateToday(){
        $lastDate = $this->getLastDate();
        $lastJour = $lastDate->getJour()->format("Y-m-d");
        $todayFormatSql = date("Y-m-d");

        if($lastJour != $todayFormatSql){
            //on insere si la date d'aujourd'hui n'existe pas
            $this->load->model("date/DateModel");

            $mois = MoisModel::getMois("mois_en_chiffre", date("m"));
            $annee = AnneeModel::getAnnee("annee", date("Y"));
            $date_of_day = new SystemeDate(null, new DateTime($todayFormatSql), $mois, $annee);

            DateModel::insert($date_of_day);
        }

    }

     /** 
     * @param $date : EntitieDate
     * @return array : EntitieDate
     */
    public function selectAllDate(SystemeMois $mois, SystemeAnnee $annee){
        $this->load->model("date/DateModel");
        return DateModel::getDates($mois, $annee);
    }

    /**
     * @return SystemeDate
     */
    public function getLastDate(){
        $this->load->model("date/DateModel");
        return DateModel::getLastDate();
    }

    /**
     * retorune la derniere date du mois et année donnée
     */
    public function getDerniereDateDuMois(SystemeMois $mois, SystemeAnnee $annee){
        $this->load->model("date/DateModel");
        return DateModel::getDerniereDateDuMois($mois, $annee);
    }

    ################################################# MOIS ##########################################
    public function getMois($condition, $value){
        $this->load->model("date/MoisModel");
        $mois = MoisModel::getMois($condition, $value);

        return $mois;
    }
    
    public function getAllMois(){
        $this->load->model("date/MoisModel");
        $mois = MoisModel::getAllMois();
        return $mois;
    }

    ################################################# ANNEE #########################################
    public function getAnnee($condition, $value){
        $this->load->model("date/AnneeModel");
        $annee = AnneeModel::getAnnee($condition, $value);
        return $annee;
    }
    
    public function getAllAnnee(){
        $this->load->model("date/AnneeModel");
        $annee = AnneeModel::getAllAnnee();
        return $annee;
    }
}