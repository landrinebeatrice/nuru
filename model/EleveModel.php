<?php
require_once("entities/Eleve.php");
require_once("model/tm_models/MainModel.php");

class EleveModel extends MainModel{
    /**
     * @param Eleve $eleve
     * @return bool
     */
    public static function insert(Eleve $eleve){
        $query = "INSERT INTO eleve SET matricule=?, nom=?, postnom=?, prenom=?, genre=?, etat_sante=?, lieu_naissance=?,
                            date_naissance=?, nom_pere=?, nom_mere=?, nom_tuteur=?, adresse_responsable=?, contact_responsable=?, 
                            ecole_provenance=?, date_inscription=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$eleve->getMatricule(), $eleve->getNom(), $eleve->getPostnom(), $eleve->getPrenom(), $eleve->getGenre(), $eleve->getEtatSante(),
            $eleve->getLieuNaissance(), $eleve->getDateNaissance(), $eleve->getNomPere(), $eleve->getNomMere(), $eleve->getNomTuteur(),
            $eleve->getAdresseResponsable(), $eleve->getContactResponsable(), $eleve->getEcoleProvenance(), $eleve->getDateInscription()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param Eleve $eleve
     * @return bool
     */
    public static function update(Eleve $eleve){
        $query = "UPDATE eleve SET nom=?, postnom=?, prenom=?, genre=?, etat_sante=?, lieu_naissance=?,
                            date_naissance=?, nom_pere=?, nom_mere=?, nom_tuteur=?, adresse_responsable=?, contact_responsable=?, 
                            ecole_provenance=?, date_inscription=? WHERE id=?";
        $sql = self::pdo()->prepare($query);

        if($sql->execute([$eleve->getNom(), $eleve->getPostnom(), $eleve->getPrenom(), $eleve->getGenre(), $eleve->getEtatSante(),
            $eleve->getLieuNaissance(), $eleve->getDateNaissance(), $eleve->getNomPere(), $eleve->getNomMere(), $eleve->getNomTuteur(),
            $eleve->getAdresseResponsable(), $eleve->getContactResponsable(), $eleve->getEcoleProvenance(), $eleve->getDateInscription(), $eleve->getId()]))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $id_eleve
     * @return Eleve|false
     */
    public static function getEleve($id_eleve){
        $sql = self::pdo()->prepare("SELECT * FROM eleve WHERE id = ?");
        $sql->execute([$id_eleve]);
        $res = $sql->fetch(PDO::FETCH_OBJ);

        if($res){
            $eleve = new Eleve($res->id, $res->matricule, $res->nom, $res->postnom, $res->prenom, $res->genre,
                $res->etat_sante, $res->lieu_naissance, $res->date_naissance, $res->nom_pere, $res->nom_pere,
                $res->nom_tuteur, $res->adresse_responsable, $res->contact_responsable, $res->ecole_provenance,
                $res->date_inscription);

            return $eleve;
        }

        return false;
    }

    /**
     * @return array : Eleve
     */
    public static function getEleves(){
        $query="SELECT * FROM eleve ORDER BY nom ASC";
        $sql = self::pdo()->prepare($query);
        $sql->execute();

        $data = array(); //contient un tableau des objets
        if($sql != null)
        {
            while($res = $sql->fetch(PDO::FETCH_OBJ))
            {
                $data[]= new Eleve($res->id, $res->matricule, $res->nom, $res->postnom, $res->prenom, $res->genre,
                    $res->etat_sante, $res->lieu_naissance, $res->date_naissance, $res->nom_pere, $res->nom_pere,
                    $res->nom_tuteur, $res->adresse_responsable, $res->contact_responsable, $res->ecole_provenance,
                    $res->date_inscription);
            }
        }
        return $data;
    }

}