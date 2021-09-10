<?php
require_once("entities/Categorie.php");
require_once("model/tm_models/MainModel.php");

class CategorieModel extends MainModel{
    /**
     * @param Categorie $categorie
     * @return bool
     */
    public static function insert(Categorie $categorie){
        $query = "INSERT INTO categorie SET designation=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$categorie->getDesignation()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Categorie $categorie
     * @return bool
     */
    public static function update(Categorie $categorie){
        $query = "UPDATE categorie SET designation=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$categorie->getDesignation(), $categorie->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_categorie
     * @return Categorie|false
     */
    public static function getCategorie($id_categorie){
        $sql = self::pdo()->prepare("SELECT * FROM categorie WHERE id = ?");
        $sql->execute([$id_categorie]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $categorie = new Categorie($res->id, $res->designation);

            return $categorie;
        }

        return false;
    }

    /**
     * @return array : Categorie
     */
    public static function getCategories(){
        $query="SELECT * FROM categorie ORDER BY designation ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $data[]= new Categorie($res->id, $res->designation);
            }
        }
        return $data;
    }

}