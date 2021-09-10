<?php
require_once ("entities/date/SystemeDate.php");
require_once ("model/date/MoisModel.php");
require_once ("model/date/AnneeModel.php");
require_once ("model/tm_models/MainModel.php");

class DateModel extends MainModel{
    /**
     * @param $date : SystemeDate
     * @return bool 
     */
    public static function insert(SystemeDate $date){
        if(!self::verifyDate($date)){
            $d = $date->getJour();
            $mois = $date->getMois();
            $annee = $date->getAnnee();
    
            $query = "INSERT INTO systeme_date SET jour = ?, mois_id = ?, annee_id = ?";
            $sql = self::pdo()->prepare($query);
            $sql->execute([$d->format("Y-m-d"), $mois->getId(), $annee->getId()]);
        }

        return true;
    }

    /**
     * retourne la derniere date du systeme
     */
    public static function getLastDate(){
        $sql = self::pdo()->query("SELECT * FROM systeme_date ORDER BY id DESC LIMIT 0,1");
        $res = $sql->fetch(PDO::FETCH_OBJ);

        $jour = new DateTime($res->jour);
        $mois = MoisModel::getMois("id",$res->mois_id);
        $annee = AnneeModel::getAnnee("id",$res->annee_id);
        $date = new SystemeDate($res->id, $jour, $mois, $annee);

        return $date;
    } 

    /**
     * @return boolean
     */
    public static function verifyDate(SystemeDate $date){
        $d = $date->getJour();
        $d = $d->format("Y-m-d");

        $sql = self::pdo()->prepare("SELECT * FROM systeme_date WHERE jour = ?");
        $sql->execute([$d]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            return true;
        }
        return false;
    }

    /**
     * @return array: SystemeDate
     */
    public static function getDates(SystemeMois $mois, SystemeAnnee $annee){ 
        $query="SELECT * FROM systeme_date WHERE mois_id = ? AND annee_id = ? ORDER BY id ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$mois->getId(), $annee->getId()]);

        $data = array(); //contient un tableau des objets
        if($sql != null){
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $jour = new DateTime($res->jour);
                $data[] = new SystemeDate($res->id, $jour, $mois, $annee);
            }
        }

        return $data;
    }

    /**
     * @return SystemeDate | false
     */
    public static function getDate($condition = "date", $value){
        $sql = self::pdo()->prepare("SELECT * FROM systeme_date WHERE $condition = ?");
        $sql->execute([$value]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $mois = MoisModel::getMois("id",$res->mois_id);
            $annee = AnneeModel::getAnnee("id",$res->annee_id);
            $date = new SystemeDate($res->id, new DateTime($res->jour), $mois, $annee);
            
            return $date;
        }
        return false;
    }

    /**
     * retourne la derniere date du mois et de l'annee donnée
     * @param SystemeMois
     * @param SystemeAnnee
     * @return SystemeDate 
     */
    public static function getDerniereDateDuMois(SystemeMois $mois, SystemeAnnee $annee){
        $sql = self::pdo()->prepare("SELECT * FROM systeme_date WHERE mois_id=? AND annee_id=? ORDER BY id DESC LIMIT 0,1");
        $sql->execute([$mois->getId(), $annee->getId()]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $mois = MoisModel::getMois("id",$res->mois_id);
            $annee = AnneeModel::getAnnee("id",$res->annee_id);
            $date = new SystemeDate($res->id, new DateTime($res->jour), $mois, $annee);
            
            return $date;
        }
        return false;
    }
    
}