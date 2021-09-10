<?php


class Eleve
{
    private $id;
    private $matricule;
    private $nom;
    private $postnom;
    private $prenom;
    private $genre;
    private $etat_sante;
    private $lieu_naissance;
    private $date_naissance;
    private $nom_pere;
    private $nom_mere;
    private $nom_tuteur;
    private $adresse_responsable;
    private $contact_responsable;
    private $ecole_provenance;
    private $date_inscription;

    /**
     * Eleve constructor.
     * @param $id
     * @param $matricule
     * @param $nom
     * @param $postnom
     * @param $prenom
     * @param $genre
     * @param $etat_sante
     * @param $lieu_naissance
     * @param $date_naissance
     * @param $nom_pere
     * @param $nom_mere
     * @param $nom_tuteur
     * @param $adresse_responsable
     * @param $contact_responsable
     * @param $ecole_provenance
     * @param $date_inscription
     */
    public function __construct($id, $matricule, $nom, $postnom, $prenom, $genre, $etat_sante, $lieu_naissance, $date_naissance, $nom_pere, $nom_mere, $nom_tuteur, $adresse_responsable, $contact_responsable, $ecole_provenance, $date_inscription)
    {
        $this->id = $id;
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->postnom = $postnom;
        $this->prenom = $prenom;
        $this->genre = $genre;
        $this->etat_sante = $etat_sante;
        $this->lieu_naissance = $lieu_naissance;
        $this->date_naissance = $date_naissance;
        $this->nom_pere = $nom_pere;
        $this->nom_mere = $nom_mere;
        $this->nom_tuteur = $nom_tuteur;
        $this->adresse_responsable = $adresse_responsable;
        $this->contact_responsable = $contact_responsable;
        $this->ecole_provenance = $ecole_provenance;
        $this->date_inscription = $date_inscription;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPostnom()
    {
        return $this->postnom;
    }

    /**
     * @param mixed $postnom
     */
    public function setPostnom($postnom)
    {
        $this->postnom = $postnom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getEtatSante()
    {
        return $this->etat_sante;
    }

    /**
     * @param mixed $etat_sante
     */
    public function setEtatSante($etat_sante)
    {
        $this->etat_sante = $etat_sante;
    }

    /**
     * @return mixed
     */
    public function getLieuNaissance()
    {
        return $this->lieu_naissance;
    }

    /**
     * @param mixed $lieu_naissance
     */
    public function setLieuNaissance($lieu_naissance)
    {
        $this->lieu_naissance = $lieu_naissance;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getNomPere()
    {
        return $this->nom_pere;
    }

    /**
     * @param mixed $nom_pere
     */
    public function setNomPere($nom_pere)
    {
        $this->nom_pere = $nom_pere;
    }

    /**
     * @return mixed
     */
    public function getNomMere()
    {
        return $this->nom_mere;
    }

    /**
     * @param mixed $nom_mere
     */
    public function setNomMere($nom_mere)
    {
        $this->nom_mere = $nom_mere;
    }

    /**
     * @return mixed
     */
    public function getNomTuteur()
    {
        return $this->nom_tuteur;
    }

    /**
     * @param mixed $nom_tuteur
     */
    public function setNomTuteur($nom_tuteur)
    {
        $this->nom_tuteur = $nom_tuteur;
    }

    /**
     * @return mixed
     */
    public function getAdresseResponsable()
    {
        return $this->adresse_responsable;
    }

    /**
     * @param mixed $adresse_responsable
     */
    public function setAdresseResponsable($adresse_responsable)
    {
        $this->adresse_responsable = $adresse_responsable;
    }

    /**
     * @return mixed
     */
    public function getContactResponsable()
    {
        return $this->contact_responsable;
    }

    /**
     * @param mixed $contact_responsable
     */
    public function setContactResponsable($contact_responsable)
    {
        $this->contact_responsable = $contact_responsable;
    }

    /**
     * @return mixed
     */
    public function getEcoleProvenance()
    {
        return $this->ecole_provenance;
    }

    /**
     * @param mixed $ecole_provenance
     */
    public function setEcoleProvenance($ecole_provenance)
    {
        $this->ecole_provenance = $ecole_provenance;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->date_inscription;
    }

    /**
     * @param mixed $date_inscription
     */
    public function setDateInscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

}