<?php
class EleveController extends Tm_Controller{

    ##################### action
    /**
     * liste des eleves
     */
    public function liste($alertFlash=[]){
        $this->dateController = new DateController();
        $moisSysteme = $this->dateController->getMois("mois_en_chiffre", AuthController::getSession("moisSysteme"));
        $anneeSysteme = $this->dateController->getAnnee("annee", AuthController::getSession("anneeSysteme"));

        $dates = $this->dateController->selectAllDate($moisSysteme, $anneeSysteme);

        //statitique du jour selectionner
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();

        //data vers la vue

        $eleves = $this->getEleves();

        $fraisController = new FraisController();
        $allFrais = $fraisController->getAllFrais();

        $this->load->view("eleve/liste", compact("alertFlash", "eleves", "allFrais", "dates"));
    }

    /**
     * enregistrement
     */
    public function add(){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données de l'echantillon valide.");
        if(!empty($_POST)){
            $this->load->model("EleveModel");

            $nom = htmlspecialchars(trim($_POST["nom"]));
            $postnom = htmlspecialchars(trim($_POST["postnom"]));
            $prenom = htmlspecialchars(trim($_POST["prenom"]));
            $genre = htmlspecialchars(trim($_POST["genre"]));
            $etat_sante = htmlspecialchars(trim($_POST["etat_sante"]));
            $lieu_naissance = htmlspecialchars(trim($_POST["lieu_naissance"]));
            $date_naissance = htmlspecialchars(trim($_POST["date_naissance"]));
            $nom_pere = htmlspecialchars(trim($_POST["nom_pere"]));
            $nom_mere = htmlspecialchars(trim($_POST["nom_mere"]));
            $nom_tuteur = htmlspecialchars(trim($_POST["nom_tuteur"]));
            $adresse_responsable = htmlspecialchars(trim($_POST["adresse_responsable"]));
            $contact_responsable = htmlspecialchars(trim($_POST["contact_responsable"]));
            $ecole_provenance = htmlspecialchars(trim($_POST["ecole_provenance"]));
            $date_inscription = date("Y-m-d");

            $matricule = self::getCodeFile("code_eleve");
            $eleve = new Eleve(null, $matricule,$nom, $postnom, $prenom, $genre, $etat_sante, $lieu_naissance, $date_naissance,
                        $nom_pere, $nom_mere, $nom_tuteur, $adresse_responsable, $contact_responsable, $ecole_provenance, $date_inscription);

            EleveModel::insert($eleve);

            $alertFlash = array("info" => "L'élève {$nom} {$postnom} {$prenom} a été enregistré avec succes. Matricule: {$matricule}.");
        }

        $this->liste($alertFlash);
    }

    /**
     * modification
     */
    public function update(){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données de l'echantillon valide.");
        if(!empty($_POST)){
            $this->load->model("EleveModel");

            $nom = htmlspecialchars(trim($_POST["nom"]));
            $postnom = htmlspecialchars(trim($_POST["postnom"]));
            $prenom = htmlspecialchars(trim($_POST["prenom"]));
            $genre = htmlspecialchars(trim($_POST["genre"]));
            $etat_sante = htmlspecialchars(trim($_POST["etat_sante"]));
            $lieu_naissance = htmlspecialchars(trim($_POST["lieu_naissance"]));
            $date_naissance = htmlspecialchars(trim($_POST["date_naissance"]));
            $nom_pere = htmlspecialchars(trim($_POST["nom_pere"]));
            $nom_mere = htmlspecialchars(trim($_POST["nom_mere"]));
            $nom_tuteur = htmlspecialchars(trim($_POST["nom_tuteur"]));
            $adresse_responsable = htmlspecialchars(trim($_POST["adresse_responsable"]));
            $contact_responsable = htmlspecialchars(trim($_POST["contact_responsable"]));
            $ecole_provenance = htmlspecialchars(trim($_POST["ecole_provenance"]));
            $id_eleve = $_POST["id_eleve"];

            $eleve = $this->getEleve($id_eleve);
            $eleve->setNom($nom);
            $eleve->setPostnom($postnom);
            $eleve->setPrenom($prenom);
            $eleve->setGenre($genre);
            $eleve->setEtatSante($etat_sante);
            $eleve->setLieuNaissance($lieu_naissance);
            $eleve->setDateNaissance($date_naissance);
            $eleve->setNomPere($nom_pere);
            $eleve->setNomMere($nom_mere);
            $eleve->setNomTuteur($nom_tuteur);
            $eleve->setAdresseResponsable($adresse_responsable);
            $eleve->setContactResponsable($contact_responsable);
            $eleve->setEcoleProvenance($ecole_provenance);

            EleveModel::update($eleve);
            $alertFlash = array("info" => "modification effectuée avec succès.");

        }

        $this->liste($alertFlash);
    }

    //////////////////////////////////PAIEMENT FRAIS
    /**
     * enregistrement paiement eleve
     */
    public function paiement(){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données de l'echantillon valide.");
        if(!empty($_POST)){
            $this->load->model("EleveModel");

            $id_eleve = $_POST["id_eleve"];
            $id_frais = $_POST["id_frais"];
            $montant = $_POST["montant"];
            $date_paiement = date("Y-m-d");

            $user = AuthController::getSession();
            $utilisateurController = new UtilisateurController();
            $utilisateur = $utilisateurController->getUtilisateur("id", $user->id);

            $eleve = $this->getEleve($id_eleve);
            $fraisController = new FraisController();
            $frais = $fraisController->getFrais($id_frais);

            $reste = ($frais->getMontant()-$montant);
            if($reste < 0){
                //si le montant payé est superieur au total à payer pour un frais donné
                $alertFlash = array("danger" => "le montant payé ne doit pas être superieur au montant du frais. veuillez ressayer avec un montant valide");
            }else{
                $this->load->model("PaiementModel");
                $paiement = new Paiement(null, $montant, $date_paiement, $eleve, $utilisateur, $frais);
                PaiementModel::insert($paiement);

                $nom_eleve = strtoupper($eleve->getNom(). " ".$eleve->getNom()." ".$eleve->getNom());
                $motif = strtoupper($frais->getDesignation());

                $alertFlash = array("info" => "Paiement frais reussi.<br> motif: {$motif} <br> Eleve: {$nom_eleve} <br> Montant payé: {$montant} <br> Reste à payer: {$reste}  ");
            }
        }

        $this->liste($alertFlash);
    }


    ####################################### method

    /**
     * @param $id_eleve
     * @return Eleve|false
     */
    public function getEleve($id_eleve){
        $this->load->model("EleveModel");
        return EleveModel::getEleve($id_eleve);
    }

    /**
     * liste des eleves
     * @return array
     */
    public function getEleves(){
        $this->load->model("EleveModel");
        return EleveModel::getEleves();
    }

    /**
     * total des eleves
     * @return int
     */
    public function getTotal(){
        $this->load->model("EleveModel");
        return EleveModel::countTableElement("eleve");
    }
}