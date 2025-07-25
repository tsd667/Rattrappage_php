<?php

abstract class Personne {
    protected string $nom;
    protected string $prenom;
    protected string $addresse;

    public function __construct() {
    
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;
        return $this;
    }

    public function getAddresse(): string {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self {
        $this->addresse = $addresse;
        return $this;
    }

    public function __toString(): string {
        return "Personne [nom=" . $this->nom . ", prenom=" . $this->prenom . ", addresse=" . $this->addresse . "]";
    }
}
