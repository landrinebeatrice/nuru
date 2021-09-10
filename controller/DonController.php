<?php
class DonController extends Tm_Controller{

    ##################### action
    /**
     * affichage des  à la (vue)
     */
    public function liste($alertFlash = []){
        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();

        if(isset($_POST) && !empty($_POST)){
            if(isset($_POST["create"])){
                //enregistrement
                $this->add($alertFlash);
            }elseif(isset($_POST["update"])){
                //modification
                $this->update($alertFlash);
            }
        }

        $dons = $this->getDons();

        $this->load->view("don/liste", compact("dons", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("DonModel");

            $nom_bienfaiteur = htmlspecialchars(trim($_POST["nom_bienfaiteur"]));
            $cout = htmlspecialchars(trim($_POST["cout"]));
            $date_don = date("Y-m-d");

            $user = AuthController::getSession();
            $utilisateurController = new UtilisateurController();
            $utilisateur = $utilisateurController->getUtilisateur("id", $user->id);

            $don = new Don(null, $cout, $nom_bienfaiteur, $date_don, $utilisateur);
            DonModel::insert($don);
            //reccuperation de l'ID du don enregisté pour finaliser le processus d'enregistrement
            $id_don = self::getLasteInsertId("don");

            self::redirect("index.php?m=nuru-don.addEntree.d{$id_don}");

        }
    }

    /**
     * modification
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("DonModel");

            $nom_bienfaiteur = htmlspecialchars(trim($_POST["nom_bienfaiteur"]));
            $cout = htmlspecialchars(trim($_POST["cout"]));
            $id_don = $_POST["id_don"];

            $don = $this->getDon($id_don);
            $don->setNomBienfaiteur($nom_bienfaiteur);
            $don->setCout($cout);
            DonModel::update($don);

            $alertFlash = array("info" => "modification du don effectuée avec succès.");

        }
    }

    /**
     * processus d'enregistrement des details du don (produit, qte_entree)
     * @param null $keyDon
     */
    public function addEntree($keyDon=null){
        $alertFlash = [];
        if($keyDon){
            /**
             * [0] : d (don)
             * [1] : ID du don
             */
            $keyDon = explode("d",$keyDon);
            if(isset($keyDon[1])){
                $id_don = $keyDon[1];
                $don = $this->getDon($id_don);
                if($don){
                    $produitController = new ProduitController();
                    $produits = $produitController->getProduits();

                    if(isset($_POST) && !empty($_POST)){
                        //ajout produit à la session
                        if(isset($_POST["addProduitDon"]))
                        {
                            $id_produit = $_POST["id_produit"];
                            $qte_entree = $_POST["qte_entree"];
                            $_SESSION["detailDon"][$id_produit] = $qte_entree;
                        }

                        //annulation
                        if(isset($_POST["annulerDetail"]))
                        {
                            unset($_SESSION["detailDon"]);
                        }
                    }

                    $this->load->view("don/addentree", compact("don", "produits", "alertFlash"));
                    return;
                }
            }
        }
        self::redirect("index.php?m=nuru-don.liste");
    }

    /**
     * valiation et enregistrement dans la base de données
     */
    public function addDetail(){
        $alertFlash = array("danger" => "le processus d'enregistrement du don ne pas terminé avec succès. une erreur s'est produite. veuillez reessayer.");
        if(isset($_POST["createDetail"]) && isset($_SESSION["detailDon"]) && !empty($_SESSION["detailDon"])){
            $produitController = new ProduitController();
            $produits = $produitController->getProduits();
            $date_entree = date("Y-m-d");
            $id_don = $_POST["id_don"];
            $don = $this->getDon($id_don);

            $dataIdProduitSession = array_keys($_SESSION["detailDon"]);
            foreach ($produits as $produit) {
                //on exclu tous les produits qui ne sont pas ajouté dans la session
                if (!in_array($produit->getId(), $dataIdProduitSession)) { continue; }
                $qte_entree = $_SESSION["detailDon"][$produit->getId()];

                $this->load->model("EntreeModel");
                $entree = new Entree(null, $qte_entree, $date_entree, $don, $produit);
                EntreeModel::insert($entree);

            }

            unset($_SESSION["detailDon"]);
            $alertFlash = array("info" => "le don a été enregistré avec succès.");
        }elseif (isset($_POST["annulerDetail"])){
            unset($_SESSION["detailDon"]);

            $id_don = $_POST["id_don"];
            self::redirect("index.php?m=nuru-don.addEntree.d{$id_don}");
        }

        $this->liste($alertFlash);
    }

    ####################################### method

    /**
     * @param $id_don
     * @return Don|false
     */
    public function getDon($id_don)
    {
        $this->load->model("DonModel");
        return DonModel::getDon($id_don);
    }

    /**
     * liste des
     * @return array
     */
    public function getDons(){
        $this->load->model("DonModel");
        return DonModel::getDons();
    }

    /**
     * retourne les details du don en parametre
     * @param Don $don
     * @return array
     */
    public function getAllEntree(Don $don){
        $this->load->model("EntreeModel");
        return EntreeModel::getAllEntreeDon($don);
    }

    /**
     * total des dons
     * @return int
     */
    public function getTotal(){
        $this->load->model("EntreeModel");
        return EntreeModel::countTableElement("don");
    }
}