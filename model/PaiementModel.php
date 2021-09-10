<?php
require_once("entities/Paiement.php");
require_once("model/tm_models/MainModel.php");
require_once("model/EleveModel.php");
require_once("model/tm_models/UtilisateurModel.php");
require_once("model/FraisModel.php");

class PaiementModel extends MainModel{
    /**
     * @param Paiement $paiement
     * @return bool
     */
    public static function insert(Paiement $paiement){
        $eleve = $paiement->getEleve();
        $utilisateur = $paiement->getUtilisateur();
        $frais = $paiement->getFrais();

        $query = "INSERT INTO paiement SET montant=?, date_paiement=?, eleve_id=?, utilisateur_id=?, frais_id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$paiement->getMontant(), $paiement->getDatePaiement(), $eleve->getId(), $utilisateur->getId(), $frais->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Paiement $paiement
     * @return bool
     */
    public static function update(Paiement $paiement){
        $eleve = $paiement->getEleve();
        $utilisateur = $paiement->getUtilisateur();
        $frais = $paiement->getFrais();

        $query = "UPDATE paiement SET montant=?, eleve_id=?, frais_id=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$paiement->getMontant(), $eleve->getId(), $frais->getId(), $paiement->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_paiement
     * @return Paiement|false
     */
    public static function getPaiement($id_paiement){
        $sql = self::pdo()->prepare("SELECT * FROM paiement WHERE id = ?");
        $sql->execute([$id_paiement]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $eleve = EleveModel::getEleve($res->eleve_id);
            $utilisateur = UtilisateurModel::getUtilisateur("id", $res->utilisateur_id);
            $frais = FraisModel::getFrais($res->frais_id);

            $paiement = new Paiement($res->id, $res->montant, $res->date_paiement, $eleve, $utilisateur, $frais);

            return $paiement;
        }

        return false;
    }

    /**
     * @return array : Paiement
     */
    public static function getPaiements(){
        $query="SELECT * FROM paiement ORDER BY id DESC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $eleve = EleveModel::getEleve($res->eleve_id);
                $utilisateur = UtilisateurModel::getUtilisateur("id", $res->utilisateur_id);
                $frais = FraisModel::getFrais($res->frais_id);

                $data[] = new Paiement($res->id, $res->montant, $res->date_paiement, $eleve, $utilisateur, $frais);
            }
        }
        return $data;
    }

}