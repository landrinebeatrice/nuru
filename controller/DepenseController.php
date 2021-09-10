<?php
class DepenseController extends Tm_Controller{

    ##################### action
    /**
     * affichage des depenses à la (vue)
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

        $depenses = $this->getDepenses();

        $this->load->view("depense/liste", compact("depenses", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("DepenseModel");

            $montant = htmlspecialchars(trim($_POST["montant"]));
            $motif = htmlspecialchars(trim($_POST["motif"]));
            $devise = htmlspecialchars(trim($_POST["devise"]));
            $date_depense = date("Y-m-d");

            $user = AuthController::getSession();
            $utilisateurController = new UtilisateurController();
            $utilisateur = $utilisateurController->getUtilisateur("id", $user->id);

            $depense = new Depense(null, $montant, $motif, $devise, $date_depense, $utilisateur);
            DepenseModel::insert($depense);

            $alertFlash = array("info" => "depense enregistré avec succes.");
        }
    }

    /**
     * modification
     * @param $alertFlash
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("DepenseModel");

            $montant = htmlspecialchars(trim($_POST["montant"]));
            $motif = htmlspecialchars(trim($_POST["motif"]));
            $id_depense = $_POST["id_depense"];

            $depense = $this->getDepense($id_depense);
            $depense->setMotif($motif);
            $depense->setMontant($montant);
            DepenseModel::update($depense);

            $alertFlash = array("info" => "depense modifiée avec succes.");
        }
    }


    ####################################### method

    /**
     * @param $id_depense
     * @return Depense|false
     */
    public function getDepense($id_depense)
    {
        $this->load->model("DepenseModel");
        return DepenseModel::getDepense($id_depense);
    }

    /**
     * liste des
     * @return array
     */
    public function getDepenses(){
        $this->load->model("DepenseModel");
        return DepenseModel::getDepenses();
    }

}