<?php
class ClientController extends Tm_Controller{
    #************************************** ACTION *********************************************
    public function liste(){
        $alertFlash = array();
        if(!empty($_POST)){
            //enregistrement 
            if(isset($_POST["create"])){
                $this->createClient($_POST, $alertFlash);

            }elseif(isset($_POST["update"])){
                $this->updateCredit($_POST, $alertFlash);

            }
        }

        $dateSystemeFormatNormal = self::getDateSystemeFormatNormal();
        $dateSystemeFormatSql = self::getDateSystemeFormatSql();


        $this->load->model("ClientModel");
        $clients = $this->getClients();
        $echantillonController = new EleveController();
        
        $this->load->view("frais/view", compact("clients", "echantillonController", "dateSystemeFormatNormal", "dateSystemeFormatSql", "alertFlash"));
    }


    ################################################### METHODE 

    //enregistrement nouveau frais
    public function createClient($data, &$alertFlash){
        $this->load->model("ClientModel");

        $nom_complet = strtolower(htmlspecialchars(trim($data["nom_complet"])));
        $contact = htmlspecialchars(trim($data["contact"]));
        $adresse = htmlspecialchars(trim($data["adresse"]));

        if(ClientModel::getClient("nom_complet", $nom_complet))
        {
            //le cas où il existe un frais avec ce nom
            $alertFlash = array("danger" => "<b>{$nom_complet}</b>, est déjà enregistré comme frais; si il s'agit d'un autre frais veuillez l'enregistrer avec un autre prefixe.");
            return;
        }
        elseif (ClientModel::getClient("contact",$contact))
        {
            //le cas où le numero est deja utilisé par un autre frais
            $alertFlash = array("danger" => "<b>{$contact}</b>, est un numero utiliser par un autre frais; si il s'agit d'un autre frais veuillez fournir un autre numero.");
            return;
        }

        //enregistrement frais
        $code = self::getCodeFile("code_client");
        $client = new Client(null, $code, $nom_complet, $contact, $adresse);
        ClientModel::insert($client);
        $alertFlash = array("info" => "frais enregistré avec succès.");

    }

    //modification frais
    public function updateClient($data, &$alertFlash){
        $this->load->model("ClientModel");

        $credit_id = $data["credit_id"];
        $client = htmlspecialchars(trim($data["frais"]));
        $montant_a_payer = $data["montant_a_payer"];
        $date_credit = $data["date_credit"];

        $userConnected = AuthController::getSession();
        $utilisateur = new Utilisateur($userConnected->id, $userConnected->username, $userConnected->password, $userConnected->role, $userConnected->etat);

        $credit = new Credit($credit_id, $client, $montant_a_payer, $date_credit, $utilisateur);        
        ClientModel::update($credit);
            
        $alertFlash = array("warning" => "modification reussie.");
    }

    /**
     * @param $by : la condition de selection (le champ de verification)
     * @param $value : la valeur
     * @return Client|false
     */
    public function getClient($by, $value){
        $this->load->model("ClientModel");

        $client = ClientModel::getClient($by, $value);
        return $client;
    }

    /**
     * @return array
     */
    public function getClients(){
        $this->load->model("ClientModel");

        $clients = ClientModel::getClients();
        return $clients;
    }

    public static function getTotalClients(){
        return Tm_Controller::getCountElementOfTable("frais");
    }
}