<?php
require_once("entities/Bonsortie.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/tm_models/UtilisateurModel.php");

class BonsortieModel extends MainModel{
    /**
     * @param Bonsortie $bon_sortie
     * @return bool
     */
    public static function insert(Bonsortie $bon_sortie){
        $utilisateur = $bon_sortie->getUtilisateur();

        $query = "INSERT INTO bon_sortie SET description=?, date_bon=?, utilisateur_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$bon_sortie->getDescription(), $bon_sortie->getDateBon(), $utilisateur->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Bonsortie $bon_sortie
     * @return bool
     */
    public static function update(Bonsortie $bon_sortie){
        $utilisateur = $bon_sortie->getUtilisateur();

        $query = "UPDATE bon_sortie SET description=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$bon_sortie->getDescription(), $bon_sortie->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_bon
     * @return Bonsortie|false
     */
    public static function getBonsortie($id_bon){
        $sql = self::pdo()->prepare("SELECT * FROM bon_sortie WHERE id = ?");
        $sql->execute([$id_bon]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $utilisateur = UtilisateurModel::getUtilisateur("id",$res->utilisateur_id);
            $bon_sortie = new Bonsortie($res->id, $res->description, $res->date_bon, $utilisateur);

            return $bon_sortie;
        }

        return false;
    }

    /**
     * @return array :
     */
    public static function getBonsorties(){
        $query="SELECT * FROM bon_sortie ORDER BY id DESC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $utilisateur = UtilisateurModel::getUtilisateur("id",$res->utilisateur_id);
                $data[] = new Bonsortie($res->id, $res->description, $res->date_bon, $utilisateur);

            }
        }
        return $data;
    }

}