<?php
require_once ("entities/date/SystemeAnnee.php");
require_once ("model/tm_models/MainModel.php");

class AnneeModel extends MainModel{
    /**
     * @return SystemeAnnee | false
     */
    public static function getAnnee($condition, $value){
        $sql = self::pdo()->prepare("SELECT * FROM systeme_annee WHERE $condition = ?");
        $sql->execute([$value]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $annee = new SystemeAnnee($res->id, $res->annee);
            return $annee;
        }
        return false;
    }

    /**
     * @return array : SystemeAnnee
     */
    public static function getAllAnnee() {
        $query="SELECT * FROM systeme_annee ORDER BY annee ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $data[]= new SystemeAnnee($res->id, $res->annee);
            }

        }

        return $data;
    }
}