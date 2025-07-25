<?php
require_once 'entity/Patient.php';
require_once 'entity/RendezVous.php';
require_once 'entity/AnnulerRdv.php';
require_once 'enum/StatusRdvEnum.php';

class PatientService {
    private array $rdvs = [];
    private array $annulations = [];
    private int $compteurIdRdv = 1;
    private int $compteurAnnulation = 1;

    public function DemandeRendezVous(Patient $patient): bool {
        $rdv = new RendezVous($this->compteurIdRdv++, $patient);
        $this->rdvs[] = $rdv;
        $patient->addRdv($rdv);
        return true;
    }

    public function AnnulaterRendezVous(int $idRdv, string $motif): bool {
        foreach ($this->rdvs as $rdv) {
            if ($rdv->getId() === $idRdv) {
                $maintenant = new DateTime();
                $diff = $maintenant->diff($rdv->getDate());
                $heures = ($diff->days * 24) + $diff->h;

                if ($heures >= 48 && $rdv->getStatus() === StatusRdvEnum::En_attente) {
                    $rdv->setStatus(StatusRdvEnum::Annuler);
                    $annulation = new AnnulerRdv($this->compteurAnnulation++, $motif, $idRdv);
                    $this->annulations[] = $annulation;
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function getRdvs(): array {
        return $this->rdvs;
    }

    public function getAnnulations(): array {
        return $this->annulations;
    }

    public function rechercherRdvById(int $idRdv): ?RendezVous {
        foreach ($this->rdvs as $rdv) {
            if ($rdv->getId() === $idRdv) {
                return $rdv;
            }
        }
        return null;
    }

 }

