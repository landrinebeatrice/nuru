<?php
class StatistiqueController extends Tm_Controller{

    ##################### action
    /**
     * statistique vue stock
     */
    public function stock($filtre = "month"){
        $alertFlash=[];
        $this->load->model("StatistiqueModel");

        $dateController = new DateController();
        $dateSysteme = new DateTime(AuthController::getSession("dateSysteme"));
        $dateSystemeFormatSql = $dateSysteme->format("Y-m-d");
        $moisSysteme = $dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
        $anneeSysteme = $dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));

        //filtrage soit par jour (si $filtre vaut day) soit par mois le cas contraire
        $stock_statistique = StatistiqueModel::getStockMensuel($moisSysteme, $anneeSysteme);
        if($filtre == "day"){ $stock_statistique = StatistiqueModel::getStockJournalier($dateSystemeFormatSql); }


        $this->load->view("statistique/stock", compact( "stock_statistique", "filtre", "alertFlash"));
    }

    /**
     * statistique vue budget
     */
    public function budget(){
        $alertFlash=[];
        $this->load->model("StatistiqueModel");

        $dateController = new DateController();
        $moisSysteme = $dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
        $anneeSysteme = $dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));

        $budget_statistique = StatistiqueModel::budgetByDate($moisSysteme, $anneeSysteme);
        $total_paiement_mois = StatistiqueModel::getMontantMois("paiement", $moisSysteme, $anneeSysteme);
        $total_don_mois = StatistiqueModel::getMontantMois("don", $moisSysteme, $anneeSysteme);
        $total_depense_mois = StatistiqueModel::getMontantMois("depense", $moisSysteme, $anneeSysteme);
        $total_revenu_mois = ($total_paiement_mois+$total_don_mois);

        $this->load->view("statistique/budget", compact( "budget_statistique","total_paiement_mois", "total_don_mois", "total_depense_mois", "total_revenu_mois", "alertFlash"));
    }


}