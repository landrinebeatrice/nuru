<?php
require_once("entities/Sortie.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/BonsortieModel.php");
require_once ("model/ProduitModel.php");

class SortieModel extends MainModel{
    /**
     * @param Sortie $sortie
     * @return bool
     */
    public static function insert(Sortie $sortie){
        $produit = $sortie->getProduit();
        $bon = $sortie->getBonSortie();

        $query = "INSERT INTO sortie SET qte_sortie=?, date_sortie=?, produit_id=?, bon_sortie_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$sortie->getQteSortie(), $sortie->getDateSortie(), $produit->getId(), $bon->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * retourne les details (sortie) du bon en param
     * @param Bonsortie $bon
     * @return array
     */
    public static function getAllSortieBon(Bonsortie $bon){
        $query="SELECT * FROM sortie WHERE bon_sortie_id=?";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$bon->getId()]);

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $produit = ProduitModel::getProduit($res->produit_id);
                $data[] = new Sortie($res->id, $res->qte_sortie, $res->date_sortie, $produit, $bon);

            }
        }
        return $data;
    }

    /**
     * retourne les sorties (details) du produit en parametre
     * @param Produit $produit
     * @return array
     */
    public static function getAllSortieProduit(Produit $produit){
        $query="SELECT * FROM sortie WHERE produit_id=?";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$produit->getId()]);

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $bon = BonsortieModel::getBonsortie($res->bon_sortie_id);
                $data[] = new Sortie($res->id, $res->qte_sortie, $res->date_sortie, $produit, $bon);

            }
        }
        return $data;
    }

}