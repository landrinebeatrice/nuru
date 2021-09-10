<?php
require_once("model/tm_models/AuthModel.php");

class AuthController extends Tm_Controller{
    /**
     * traitement authentification utilisateur
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username,$password){
        if(AuthModel::login($username, $password)) {

            return true;
        }
        return false;
    }

    /**
     * redirige l'utilisateur à la page de connexion si la session n'existe pas
     * @param string $cleSessionUtilisateur
     * @return string
     */
    static function is_connected($cleSessionUtilisateur = "auth"){
        if(!(self::getSession($cleSessionUtilisateur))){
            //$_SESSION['flash']['danger'] = "vous n'avez pas le droit d'acceder à ce contenu, veuillez vous connecter";

            self::redirect("index.php?m=nuru-utilisateur.login");
        }

        return "connected";
    }

    /**
     * retourne la session
     * @param string $key
     * @return false|mixed
     */
    public static function getSession($key = "auth"){
        if(isset($_SESSION[$key]) && !empty($_SESSION[$key])){
            return $_SESSION[$key];
        }

        return false;
    }

}