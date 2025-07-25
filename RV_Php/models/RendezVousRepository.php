<?php
require_once './config/Database.php';
require_once './entity/RendezVous.php';

class RendezVousRepository {

    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function selectAllRendezVous(): array {
        $sql = "SELECT * FROM rendezvous";
        $rendezVousList = [];

        try {
            $stmt = $this->database->getPdo()->query($sql);
            while ($row = $stmt->fetch()) {
                $rendezVousList[] = $this->toRendezVous($row);
            }
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return $rendezVousList;
    }

    public function selectRendezVousById(int $id): ?RendezVous {
        $sql = "SELECT * FROM rendezvous WHERE id = $id";

        try {
            $stmt = $this->database->getPdo()->query($sql);
            $row = $stmt->fetch();
            return $row ? $this->toRendezVous($row) : null;
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return null;
    }

    public function insertRendezVous(RendezVous $rdv): int {
        $dateStr = $rdv->getDate()->format('Y-m-d H:i:s');
        $status = $rdv->getStatus()->value;
        $patientId = $rdv->getPatient()->getId();
        $medecinId = $rdv->getMedecin() ? $rdv->getMedecin()->getId() : "NULL";

        $sql = "INSERT INTO rendezvous (status, date, patient_id, medecin_id)
                VALUES ('$status', '$dateStr', '$patientId', " . ($medecinId === "NULL" ? "NULL" : "'$medecinId'") . ")";

        try {
            return $this->database->getPdo()->exec($sql);
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return 0;
    }

    private function toRendezVous(array $row): RendezVous {
        require_once './entity/StatusRdvEnum.php';
        require_once './entity/PatientRepository.php';
        require_once './entity/MedecinRepository.php';

        $patientRepo = new PatientRepository();
        $medecinRepo = new MedecinRepository();

        $patient = $patientRepo->selectPatientById($row['patient_id']);
        $medecin = $row['medecin_id'] !== null ? $medecinRepo->selectMedecinById($row['medecin_id']) : null;

        $date = new DateTime($row['date']);
        $status = StatusRdvEnum::from($row['status']);

        $rdv = new RendezVous($patient, $date, (int)$row['id'], $medecin);
        $rdv->setStatus($status);

        return $rdv;
    }
}
