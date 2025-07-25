<?php

class AnnulerRdv {
    private int $id;
    private DateTime $date;
    private string $motif;
    private int $idRendezVous;

    public function __construct(int $id, string $motif, int $idRendezVous) {
        $this->id = $id;
        $this->motif = $motif;
        $this->idRendezVous = $idRendezVous;
        $this->date = new DateTime(); 
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getMotif(): string {
        return $this->motif;
    }

    public function getIdRendezVous(): int {
        return $this->idRendezVous;
    }

    public function __toString(): string {
        return "DemandeAnnulation [id=" . $this->id .
            ", date=" . $this->date->format('Y-m-d H:i:s') .
            ", motif=" . $this->motif .
            ", idRendezVous=" . $this->idRendezVous . "]";
    }
}
