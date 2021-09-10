<?php

/**
 * Description of SystemeAnnee
 *
 * @author mwamb
 */
class SystemeAnnee {
    private $id;
    private $annee;
    
    public function __construct($id, $annee) {
        $this->id = $id;
        $this->annee = $annee;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

}
