<?php
class UtilisateurController extends Tm_Controller{
    #************************************** ACTION *********************************************
    /**
     * authentification utilisateur (vue)
     */
    public function login(){
        $this->load->view("utilisateur/login");
    }

    /**
     * deconnexion utilisateur
     */
    public function logout(){
        if(isset($_SESSION["auth"])){
            unset($_SESSION["auth"]);

            unset($_SESSION["jourSysteme"]);
            unset($_SESSION['moisSysteme']);
            unset($_SESSION['anneeSysteme']);

        }
        $url = "index.php?m=nuru-utilisateur.login";
        self::redirect($url);
    }

    public function liste(){
        $alertFlash = array();
        if(!empty($_POST)){
            //enregistrement 
            if(isset($_POST["create"])){
                $this->add($_POST, $alertFlash);

            }elseif(isset($_POST["update"])){
                $this->update($_POST, $alertFlash);

            }
        }

        $utilisateurs = $this->getUtilisateurs();
        
        $this->load->view("utilisateur/liste", compact("utilisateurs", "alertFlash"));
    }


    ################################################### METHODE 

    //enregistrement nouveau compte utilisateur
    public function add($data, &$alertFlash){
        $this->load->model("tm_models/UtilisateurModel");

        $nom = strtolower(htmlspecialchars(trim($data["nom"])));
        $postnom = htmlspecialchars(trim($data["postnom"]));
        $prenom = htmlspecialchars(trim($data["prenom"]));
        $contact = htmlspecialchars(trim($data["contact"]));
        $email = htmlspecialchars(trim($data["email"]));
        $username = htmlspecialchars(trim($data["username"]));
        $role = htmlspecialchars(trim($data["role"]));

        if($this->getUtilisateur("username", $username))
        {
            $alertFlash = array("danger" => "Le nom d'utilisateur <b>{$username}</b>, est déjà utilisé par un autre utilisateur; si il s'agit d'un autre utilisateur veuillez l'enregistrer avec un autre prefixe.");
            return;
        }

        $code_acces = self::generatorCodeAleatoire(6);
        $password = strtolower($code_acces);
        $utilisateur = new Utilisateur(null, $nom, $postnom, $prenom, $contact, $email, $username, self::getPasswordHash($password), $role);
        UtilisateurModel::insert($utilisateur);

        $alertFlash = array("info" => "l'utilisateur a été configuré avec succès. coordonnnées de connexion -> Nom d'utilisateur: <b>{$username}</b> | Mot de passe (par defaut): <b>{$code_acces}</b> | Role: <b>{$role}</b>");
    }

    /**
     * @param $by : la condition de selection (le champ de verification)
     * @param $value : la valeur
     * @return Utilisateur|false
     */
    public function getUtilisateur($by, $value){
        $this->load->model("tm_models/UtilisateurModel");

        $utilisateur = UtilisateurModel::getUtilisateur($by, $value);
        return $utilisateur;
    }

    /**
     * @return array
     */
    public function getUtilisateurs(){
        $this->load->model("tm_models/UtilisateurModel");

        $utilisateurs = UtilisateurModel::getUtilisateurs();
        return $utilisateurs;
    }

}