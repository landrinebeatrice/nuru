<?php
require_once("entities/Frais.php");
require_once("model/tm_models/MainModel.php");

class FraisModel extends MainModel{
    /**
     * @param Frais $frais
     * @return bool
     */
    public static function insert(Frais $frais){
        $query = "INSERT INTO frais SET designation=?, montant=?, devise=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$frais->getDesignation(), $frais->getMontant(), $frais->getDevise()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Frais $frais
     * @return bool
     */
    public static function update(Frais $frais){
        $query = "UPDATE frais SET designation=?, montant=?, devise=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$frais->getDesignation(), $frais->getMontant(), $frais->getDevise(), $frais->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_frais
     * @return Frais|false
     */
    public static function getFrais($id_frais){
        $sql = self::pdo()->prepare("SELECT * FROM frais WHERE id = ?");
        $sql->execute([$id_frais]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $eleve = new Frais($res->id, $res->designation, $res->montant, $res->devise);

            return $eleve;
        }

        return false;
    }

    /**
     * @return array : Frais
     */
    public static function getAllFrais(){
        $query="SELECT * FROM frais ORDER BY id ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $data[]= new Frais($res->id, $res->designation, $res->montant, $res->devise);
            }
        }
        return $data;
    }

}