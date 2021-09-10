<?php
require_once ("entities/date/SystemeMois.php");
require_once ("model/tm_models/MainModel.php");

class MoisModel extends MainModel{
    /**
     * @return SystemeMois | false
     */
    public static function getMois($condition, $value){
        $sql = self::pdo()->prepare("SELECT * FROM systeme_mois WHERE $condition = ?");
        $sql->execute([$value]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $mois = new SystemeMois($res->id, $res->mois_en_chiffre, $res->mois_en_lettre);
            return $mois;
        }
        return false;
    }

    /**
     * @return array : SystemeMois
     */
    public static function getAllMois() {
        $query="SELECT * FROM systeme_mois ORDER BY id ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $data[]= new SystemeMois($res->id, $res->mois_en_chiffre, $res->mois_en_lettre);
            }

        }

        return $data;
    }
}