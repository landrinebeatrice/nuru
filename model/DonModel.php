<?php
require_once("entities/Don.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/tm_models/UtilisateurModel.php");

class DonModel extends MainModel{
    /**
     * @param Don $don
     * @return bool
     */
    public static function insert(Don $don){
        $utilisateur = $don->getUtilisateur();

        $query = "INSERT INTO don SET cout=?, nom_bienfaiteur=?, date_don=?, utilisateur_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$don->getCout(), $don->getNomBienfaiteur(), $don->getDateDon(), $utilisateur->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Don $don
     * @return bool
     */
    public static function update(Don $don){
        $utilisateur = $don->getUtilisateur();

        $query = "UPDATE don SET cout=?, nom_bienfaiteur=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$don->getCout(), $don->getNomBienfaiteur(), $don->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_don
     * @return Don|false
     */
    public static function getDon($id_don){
        $sql = self::pdo()->prepare("SELECT * FROM don WHERE id = ?");
        $sql->execute([$id_don]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $utilisateur = UtilisateurModel::getUtilisateur("id",$res->utilisateur_id);
            $don = new Don($res->id, $res->cout, $res->nom_bienfaiteur, $res->date_don, $utilisateur);

            return $don;
        }

        return false;
    }

    /**
     * @return array :
     */
    public static function getDons(){
        $query="SELECT * FROM don ORDER BY id DESC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $utilisateur = UtilisateurModel::getUtilisateur("id",$res->utilisateur_id);
                $data[] = new Don($res->id, $res->cout, $res->nom_bienfaiteur, $res->date_don, $utilisateur);

            }
        }
        return $data;
    }

}