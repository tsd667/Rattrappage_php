<?php
require_once './entity/StatusRdvEnum.php';
require_once './entity/Patient.php';
require_once './entity/Medecin.php';

class RendezVous {
    private static int $compteurId = 0;

    private int $id;
    private StatusRdvEnum $status;
    private DateTime $date;
    private Patient $patient;
    private ?Medecin $medecin = null;

    public function __construct(Patient $patient, ?DateTime $date = null, ?int $id = null, ?Medecin $medecin = null) {
        if ($id !== null) {
            $this->id = $id;
            if ($id > self::$compteurId) {
                self::$compteurId = $id;
            }
        } else {
            $this->id = ++self::$compteurId;
        }

        $this->status = StatusRdvEnum::EN_ATTENTE;
        $this->date = $date ?? new DateTime();
        $this->patient = $patient;
        $this->medecin = $medecin;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getStatus(): StatusRdvEnum {
        return $this->status;
    }

    public function setStatus(StatusRdvEnum $status): void {
        $this->status = $status;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    public function getPatient(): Patient {
        return $this->patient;
    }

    public function setPatient(Patient $patient): void {
        $this->patient = $patient;
    }

    public function getMedecin(): ?Medecin {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): void {
        $this->medecin = $medecin;
    }

    public function __toString(): string {
        return "RendezVous [id={$this->id}, status={$this->status->value}, date={$this->date->format('Y-m-d H:i:s')}, patient={$this->patient->getNom()}, medecin=" . ($this->medecin ? $this->medecin->getNom() : "Aucun") . "]";
    }
}
