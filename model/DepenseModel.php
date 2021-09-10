<?php
require_once("entities/Depense.php");
require_once("model/tm_models/MainModel.php");
require_once("model/tm_models/UtilisateurModel.php");


class DepenseModel extends MainModel{
    /**
     * @param Depense $depense
     * @return bool
     */
    public static function insert(Depense $depense){
        $utilisateur = $depense->getUtilisateur();

        $query = "INSERT INTO depense SET montant=?, motif=?, devise=?, date_depense=?, utilisateur_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$depense->getMontant(), $depense->getMotif(), $depense->getDevise(), $depense->getDateDepense(), $utilisateur->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Depense $depense
     * @return bool
     */
    public static function update(Depense $depense){

        $query = "UPDATE depense SET montant=?, motif=?, devise=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$depense->getMontant(), $depense->getMotif(), $depense->getDevise(), $depense->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_depense
     * @return Depense|false
     */
    public static function getDepense($id_depense){
        $sql = self::pdo()->prepare("SELECT * FROM depense WHERE id = ?");
        $sql->execute([$id_depense]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $utilisateur = UtilisateurModel::getUtilisateur("id", $res->utilisateur_id);

            $depense = new Depense($res->id, $res->montant, $res->motif, $res->devise, $res->date_depense, $utilisateur);

            return $depense;
        }

        return false;
    }

    /**
     * @return array : Depense
     */
    public static function getDepenses(){
        $query="SELECT * FROM depense ORDER BY id DESC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $utilisateur = UtilisateurModel::getUtilisateur("id", $res->utilisateur_id);

                $data[] = new Depense($res->id, $res->montant, $res->motif, $res->devise, $res->date_depense, $utilisateur);
            }
        }
        return $data;
    }

}