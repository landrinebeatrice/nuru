<?php
    require_once ("model/date/DateModel.php");
    require_once ("model/date/MoisModel.php");
    require_once ("model/date/AnneeModel.php");

class AuthModel{
    /**
     * Traitement Authentification utilisateur
     * @param $username
     * @param $password
     * @return bool
     */
    static function login($username, $password)
    {
        $pdo = Connexion::getConnexion();
        $sql = $pdo->prepare("SELECT * FROM utilisateur WHERE username=:username");
        $sql->execute(['username' => $username]);

        $user = $sql->fetch(PDO::FETCH_OBJ);
       if($user)
       {
           if(password_verify($password, $user->password))
           {
               //ouverture session utilisateur
                $_SESSION["auth"] = $user;

                $dateController = new DateController();
                //insertion de la date du jour si elle n'existe pas dans la base des donnéees
                $dateController->addDateToday();
               //reccupere la derniere date
                $lastDate = $dateController->getLastDate();
                $mois = $lastDate->getMois();
                $annee = $lastDate->getAnnee();

                $_SESSION["dateSysteme"] = $lastDate->getJour()->format("d-m-Y");
                $_SESSION['moisSysteme'] = $mois->getMoisEnChiffre();
                $_SESSION['anneeSysteme'] = $annee->getAnnee();

               return true;
           }
       }
        return false;
    }
}