<?php
require_once './entity/Personne.php';
require_once './enum/SpecialiteEnum.php';

class Medecin extends Personne {
    private string $id;
    private ?SpecialiteEnum $specialite = null;

    public function __construct(string $id) {
        parent::__construct();
        $this->id = $id;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): self {
        $this->id = $id;
        return $this;
    }

    public function getSpecialite(): ?SpecialiteEnum {
        return $this->specialite;
    }

    public function setSpecialite(SpecialiteEnum $specialite): self {
        $this->specialite = $specialite;
        return $this;
    }

    public function __toString(): string {
        return "Medecin [nom=" . $this->getNom() . ", id=" . $this->id . ", prenom=" . $this->getPrenom() . ", addresse=" . $this->getAddresse() . "]";
    }
}
