<?php
class BonsortieController extends Tm_Controller{

    ##################### action
    /**
     * affichage des  à la (vue)
     */
    public function liste($alertFlash = []){
        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();

        if(isset($_POST) && !empty($_POST)){
           if(isset($_POST["update"])){
                //modification
                $this->update($alertFlash);
            }
        }

        $bons = $this->getBonsorties();

        $this->load->view("bonsortie/liste", compact("bons", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
    }

    /**
     * ajout
     */
    public function add(){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        $url_redirect = "index.php?m=nuru-bonsortie.liste";
        if(!empty($_POST)){
            $this->load->model("BonsortieModel");

            $description = trim($_POST["description"]);
            $date_bon = date("Y-m-d");

            $user = AuthController::getSession();
            $utilisateurController = new UtilisateurController();
            $utilisateur = $utilisateurController->getUtilisateur("id", $user->id);

            $bon = new Bonsortie(null, $description, $date_bon, $utilisateur);
            BonsortieModel::insert($bon);
            //reccuperation de l'ID du bon enregisté pour finaliser le processus d'enregistrement
            $id_bon = self::getLasteInsertId("bon_sortie");

            $url_redirect = "index.php?m=nuru-bonsortie.addSortie.b{$id_bon}";
        }

        self::redirect($url_redirect);
    }

    /**
     * modification
     */
    public function update(&$alertFlash){
        $alertFlash = array("danger" => "une erreur s'est produite lors de l'enregistrement; veuillez renseigner des données valide.");
        if(!empty($_POST)){
            $this->load->model("BonsortieModel");

            $description = trim($_POST["description"]);
            $id_bon = $_POST["id_bon"];

            $bon = $this->getBonsortie($id_bon);
            $bon->setDescription($description);
            BonsortieModel::update($bon);

            $alertFlash = array("info" => "bon de sortie modifié avec succès.");
        }

    }

    /**
     * processus d'enregistrement des details du don (produit, qte_sortie)
     * @param null $keyBon
     */
    public function addSortie($keyBon=null){
        $alertFlash = [];
        if($keyBon){
            /**
             * [0] : b (bon)
             * [1] : ID du bon_sortie
             */
            $keyBon = explode("b",$keyBon);
            if(isset($keyBon[1])){
                $id_bon_sortie = $keyBon[1];
                $bon_sortie = $this->getBonsortie($id_bon_sortie);
                if($bon_sortie){
                    $produitController = new ProduitController();
                    $produits = $produitController->getProduits();

                    if(isset($_POST) && !empty($_POST)){
                        //ajout produit à la session
                        if(isset($_POST["addProduitBon"]))
                        {
                            $id_produit = $_POST["id_produit"];
                            $qte_sortie = $_POST["qte_sortie"];
                            //on verifie si la quantité demandé ne pas superireure au stock du produit
                            $produit = $produitController->getProduit($id_produit);
                            $stock_final_produit = $produitController->getStockFinal($produit);
                            if($qte_sortie < $stock_final_produit){
                                //si c'est inferieur on ajoute au panier
                                $_SESSION["detailBon"][$id_produit] = $qte_sortie;
                            }else{
                                $nom_produit = strtoupper($produit->getDesignation());
                                $alertFlash = array("danger" => "ERREUR: le produit {$nom_produit} a un stock final de {$stock_final_produit}, il est donc impossible de sortir {$qte_sortie}. utilisez une quantité inferieur ou égal au stock final du produit.");
                            }

                        }
                    }

                    $this->load->view("bonsortie/addsortie", compact("bon_sortie", "produits", "alertFlash"));
                    return;
                }
            }
        }
        self::redirect("index.php?m=nuru-bonsortie.liste");
    }

    /**
     * valiation et enregistrement dans la base de données
     */
    public function addDetail(){
        $alertFlash = array("danger" => "le processus d'enregistrement du don ne pas terminé avec succès. une erreur s'est produite. veuillez reessayer.");
        if(isset($_POST["createDetail"]) && isset($_SESSION["detailBon"]) && !empty($_SESSION["detailBon"])){
            $produitController = new ProduitController();
            $produits = $produitController->getProduits();

            $date_sortie = date("Y-m-d");
            $id_bon_sortie = $_POST["id_bon_sortie"];
            $bon_sortie = $this->getBonsortie($id_bon_sortie);

            $dataIdProduitSession = array_keys($_SESSION["detailBon"]);
            foreach ($produits as $produit) {
                //on exclu tous les produits qui ne sont pas ajouté dans la session
                if (!in_array($produit->getId(), $dataIdProduitSession)) { continue; }
                $qte_sortie = $_SESSION["detailBon"][$produit->getId()];

                $this->load->model("SortieModel");
                $sortie = new Sortie(null, $qte_sortie, $date_sortie, $produit, $bon_sortie);
                SortieModel::insert($sortie);

            }

            unset($_SESSION["detailBon"]);
            $alertFlash = array("info" => "le bon a été enregistré avec succès.");

        }elseif (isset($_POST["annulerDetail"])){
            unset($_SESSION["detailBon"]);

            $id_bon_sortie = $_POST["id_bon_sortie"];
            self::redirect("index.php?m=nuru-bonsortie.addSortie.b{$id_bon_sortie}");
        }

        //redirection
        $this->liste($alertFlash);
    }

    ####################################### method

    /**
     * @param $id_bon_sortie
     * @return Bonsortie|false
     */
    public function getBonsortie($id_bon_sortie)
    {
        $this->load->model("BonsortieModel");
        return BonsortieModel::getBonsortie($id_bon_sortie);
    }

    /**
     * liste des
     * @return array
     */
    public function getBonsorties(){
        $this->load->model("BonsortieModel");
        return BonsortieModel::getBonsorties();
    }

    /**
     * retourne les details du bon en parametre
     * @param Bonsortie $bon
     * @return array
     */
    public function getAllSortie(Bonsortie $bon){
        $this->load->model("SortieModel");
        return SortieModel::getAllSortieBon($bon);
    }
}