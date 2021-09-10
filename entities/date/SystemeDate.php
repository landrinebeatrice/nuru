<?php

/**
 * Description of SystemeDate
 *
 * @author mwamb
 */
class SystemeDate {
    private $id;
    private $jour;
    private $mois;
    private $annee;
    
    public function __construct($id, DateTime $jour, SystemeMois $mois, SystemeAnnee $annee) {
        $this->id = $id;
        $this->jour = $jour;
        $this->mois = $mois;
        $this->annee = $annee;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getJour() {
        return $this->jour;
    }

    public function getMois() {
        return $this->mois;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setJour(DateTime $jour) {
        $this->jour = $jour;
    }

    public function setMois($mois) {
        $this->mois = $mois;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

}
