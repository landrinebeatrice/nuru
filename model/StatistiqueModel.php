<?php
require_once("model/tm_models/MainModel.php");
require_once ("model/EleveModel.php");

class StatistiqueModel extends MainModel{

    /**
     * genere le statisque bugetaire du mois en param et l'annee
     * @param SystemeMois $mois
     * @param SystemeAnnee $annee
     * @return false|string
     */
    public static function budgetByDate(SystemeMois $mois, SystemeAnnee $annee){

        $sql = self::pdo()->prepare("SELECT DISTINCT jour, 
                                (SELECT SUM(cout) FROM don WHERE date_don=jour) AS total_montant_don,
                                (SELECT SUM(montant) FROM depense WHERE date_depense=jour) AS total_montant_depense,
                                (SELECT SUM(montant) FROM paiement WHERE date_paiement=jour) AS total_montant_paiement
                                FROM systeme_date WHERE mois_id=? AND annee_id=? ORDER BY jour ASC");
        $sql->execute([$mois->getId(), $annee->getId()]);
        $data = array();
        foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $row) {
            $row->total_montant_don = ($row->total_montant_don) ? $row->total_montant_don : 0;
            $row->total_montant_depense = ($row->total_montant_depense) ? $row->total_montant_depense : 0;
            $row->total_montant_paiement = ($row->total_montant_paiement) ? $row->total_montant_paiement : 0;
            $data[] = $row;
        }

        return json_encode($data);
    }

    /**
     * retourne le montant du mois de la table en param
     * @param $table
     * @param SystemeMois $mois
     * @param SystemeAnnee $annee
     * @return int
     */
    public static function getMontantMois($table, SystemeMois $mois, SystemeAnnee $annee){
        $field_sum = "montant";
        $field_date = "date_{$table}";
        if($table=="don"){ $field_sum = "cout"; }

        $query="SELECT SUM($field_sum) as montant_total_du_mois FROM $table 
                    WHERE $field_date IN(SELECT jour FROM systeme_date WHERE mois_id=? AND annee_id=?)";
        $sql = self::pdo()->prepare($query);
        $sql->execute([$mois->getId(), $annee->getId()]);

        $total = 0;
        if($sql != null)
        {
            $total = $sql->fetch(PDO::FETCH_OBJ)->montant_total_du_mois;
        }
        return ($total) ? $total : 0;
    }

    /**
     * genere le statistique de stock (qte_entree, qte_sortie) de produit pour le mois en param et l'annee en param
     * @param SystemeMois $mois
     * @param SystemeAnnee $annee
     * @return false|string
     */
    public static function getStockMensuel(SystemeMois $mois, SystemeAnnee $annee){
        $flag = array(
            "id_mois" => $mois->getId(),
            "id_annee" => $annee->getId()
        );
        $sql = self::pdo()->prepare("SELECT DISTINCT produit.designation, produit.id, 
                                (SELECT SUM(qte_entree) FROM entree WHERE produit_id=produit.id AND date_entree IN (SELECT jour FROM systeme_date WHERE mois_id=:id_mois AND annee_id=:id_annee)) AS qte_entree,
                                (SELECT SUM(qte_sortie) FROM sortie WHERE produit_id=produit.id AND date_sortie IN (SELECT jour FROM systeme_date WHERE mois_id=:id_mois AND annee_id=:id_annee)) AS qte_sortie
                                FROM produit ORDER BY produit.designation ASC");
        $sql->execute($flag);

        $data = array();
        foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $row) {
            $row->qte_entree = ($row->qte_entree) ? $row->qte_entree : 0;
            $row->qte_sortie = ($row->qte_sortie) ? $row->qte_sortie : 0;
            $data[] = $row;
        }

        return json_encode($data);
    }

    /**
     * genere le statistique de stock (qte_entree, qte_sortie) de produit pour le jour en param
     * @param string $date_filtre
     * @return false|string
     */
    public static function getStockJournalier($date_filtre){
        $flag = array(
            "date_filtre" => $date_filtre
        );
        $sql = self::pdo()->prepare("SELECT DISTINCT produit.designation, produit.id, 
                                (SELECT SUM(qte_entree) FROM entree WHERE produit_id=produit.id AND date_entree=:date_filtre) AS qte_entree,
                                (SELECT SUM(qte_sortie) FROM sortie WHERE produit_id=produit.id AND date_sortie=:date_filtre) AS qte_sortie
                                FROM produit ORDER BY produit.designation ASC");
        $sql->execute($flag);

        $data = array();
        foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $row) {
            $row->qte_entree = ($row->qte_entree) ? $row->qte_entree : 0;
            $row->qte_sortie = ($row->qte_sortie) ? $row->qte_sortie : 0;
            $data[] = $row;
        }

        return json_encode($data);
    }
}