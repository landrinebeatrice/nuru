<?php
require_once("entities/Entree.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/DonModel.php");
require_once ("model/ProduitModel.php");

class EntreeModel extends MainModel{
    /**
     * @param Entree $entree
     * @return bool
     */
    public static function insert(Entree $entree){
        $don = $entree->getDon();
        $produit = $entree->getProduit();

        $query = "INSERT INTO entree SET qte_entree=?, date_entree=?, don_id=?, produit_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$entree->getQteEntree(), $entree->getDateEntree(), $don->getId(), $produit->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * retourne les details (entree) du don en param
     * @param Don $don
     * @return array
     */
    public static function getAllEntreeDon(Don $don){
        $query="SELECT * FROM entree WHERE don_id=?";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$don->getId()]);

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $produit = ProduitModel::getProduit($res->produit_id);
                $data[] = new Entree($res->id, $res->qte_entree, $res->date_entree, $don, $produit);

            }
        }
        return $data;
    }

    /**
     * retourne les entrees (details) du produit en parametre
     * @param Produit $produit
     * @return array
     */
    public static function getAllEntreeProduit(Produit $produit){
        $query="SELECT * FROM entree WHERE produit_id=?";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$produit->getId()]);

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $don = DonModel::getDon($res->don_id);
                $data[] = new Entree($res->id, $res->qte_entree, $res->date_entree, $don, $produit);

            }
        }
        return $data;
    }
}