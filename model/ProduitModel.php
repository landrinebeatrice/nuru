<?php
require_once("entities/Produit.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/CategorieModel.php");

class ProduitModel extends MainModel{
    /**
     * @param Produit $produit
     * @return bool
     */
    public static function insert(Produit $produit){
        $categorie = $produit->getCategorie();

        $query = "INSERT INTO produit SET designation=?, categorie_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$produit->getDesignation(), $categorie->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Produit $produit
     * @return bool
     */
    public static function update(Produit $produit){
        $categorie = $produit->getCategorie();

        $query = "UPDATE produit SET designation=?, categorie_id=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$produit->getDesignation(), $categorie->getId(), $produit->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_produit
     * @return Produit|false
     */
    public static function getProduit($id_produit){
        $sql = self::pdo()->prepare("SELECT * FROM produit WHERE id = ?");
        $sql->execute([$id_produit]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $categorie = CategorieModel::getCategorie($res->categorie_id);
            $produit = new Produit($res->id, $res->designation, $categorie);

            return $produit;
        }

        return false;
    }

    /**
     * @return array :
     */
    public static function getProduits(){
        $query="SELECT * FROM produit ORDER BY designation ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $categorie = CategorieModel::getCategorie($res->categorie_id);
                $data[] = new Produit($res->id, $res->designation, $categorie);

            }
        }
        return $data;
    }

    /**
     * retourne le total qte_ (entree, sortie) (details) du produit en parametre
     * @param Produit $produit
     * @param string $table
     * @return int
     */
    public static function getTotalQte(Produit $produit, $table="sortie"){
        $field = "qte_{$table}";

        $query="SELECT SUM($field) as total_qte FROM $table WHERE produit_id=?";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$produit->getId()]);

        $qte_total = 0;
        if($sql != null)
        {
            $qte_total = $sql->fetch(PDO::FETCH_OBJ)->total_qte;
        }
        return $qte_total;
    }

}