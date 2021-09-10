<?php

/**
 * Description of SystemeMois
 *
 * @author mwamb
 */
class SystemeMois {
    private $id;
    private $mois_en_chiffre;
    private $mois_en_lettre;
    
    public function __construct($id, $mois_en_chiffre, $mois_en_lettre) {
        $this->id = $id;
        $this->mois_en_chiffre = $mois_en_chiffre;
        $this->mois_en_lettre = $mois_en_lettre;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getMoisEnChiffre() {
        return $this->mois_en_chiffre;
    }

    public function getMoisEnLettre() {
        return $this->mois_en_lettre;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMoisEnChiffre($mois_en_chiffre) {
        $this->mois_en_chiffre = $mois_en_chiffre;
    }

    public function setMoisEnLettre($mois_en_lettre) {
        $this->mois_en_lettre = $mois_en_lettre;
    }

}
