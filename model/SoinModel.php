<?php
require_once("entities/Soin.php");
require_once("model/tm_models/MainModel.php");
require_once ("model/EleveModel.php");

class SoinModel extends MainModel{
    /**
     * @param Soin $soin
     * @return bool
     */
    public static function insert(Soin $soin){
        $eleve = $soin->getEleve();

        $query = "INSERT INTO soin SET motif=?, date_soin=?, eleve_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$soin->getMotif(), $soin->getDateSoin(), $eleve->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Soin $soin
     * @return bool
     */
    public static function update(Soin $soin){
        $eleve = $soin->getEleve();

        $query = "UPDATE soin SET motif=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$soin->getMotif(), $soin->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_soin
     * @return Soin|false
     */
    public static function getSoin($id_soin){
        $sql = self::pdo()->prepare("SELECT * FROM soin WHERE id = ?");
        $sql->execute([$id_soin]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $eleve = EleveModel::getEleve($res->eleve_id);
            $soin = new Soin($res->id, $res->motif, $res->date_soin, $eleve);

            return $soin;
        }

        return false;
    }

    /**
     * @return array :
     */
    public static function getSoins()
    {
        $query="SELECT * FROM soin ORDER BY id DESC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $eleve = EleveModel::getEleve($res->eleve_id);
                $data[] = new Soin($res->id, $res->motif, $res->date_soin, $eleve);
            }
        }
        return $data;
    }

}