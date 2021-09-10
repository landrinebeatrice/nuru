<?php
    class HomeController extends Tm_Controller{
        private $dateController;

        /**
         * interface accueil administration
         */
        public function index($alertFlash=[]){
            $this->dateController = new DateController();
            $mois = date("m");
            $annee = date("Y");
            if(AuthController::getSession("moisSysteme")){
                $mois = AuthController::getSession("moisSysteme");
                $annee = AuthController::getSession("anneeSysteme");
            }
            $moisSysteme = $this->dateController->getMois("mois_en_chiffre", $mois);
            $anneeSysteme = $this->dateController->getAnnee("annee", $annee);

            /**
            $moisSysteme = $this->dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
            $anneeSysteme = $this->dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));
            */

            $dates = $this->dateController->selectAllDate($moisSysteme, $anneeSysteme);
        
            //statitique du jour selectionner
            $dateSystemeFormatSql = self::getDateSystemeFormatSql();

            //data vers la vue
            $eleveController = new EleveController();
            $totalEleve = $eleveController->getTotal();

            $donController = new DonController();
            $totalDon = $donController->getTotal();


            $this->load->view("home", compact("alertFlash", "totalEleve", "totalDon", "dates"));
        }

    }