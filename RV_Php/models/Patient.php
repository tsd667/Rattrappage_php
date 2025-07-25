<?php
require_once 'Personne.php';

class Patient extends Personne {
    private string $id;
    private array $rendezVous = [];

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

    public function getRendezVous(): array {
        return $this->rendezVous;
    }

    public function addRdv(RendezVous $rdv): void {
        if ($rdv !== null) {
            $this->rendezVous[] = $rdv;
        }
    }

    public function __toString(): string {
        return "Patient [nom=" . $this->nom . ", id=" . $this->id . ", prenom=" . $this->prenom . ", addresse=" . $this->addresse . "]";
    }
}
