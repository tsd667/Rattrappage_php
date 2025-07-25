<?php
require_once './config/Database.php';
require_once './entity/Patient.php';

class PatientRepository {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function selectAllPatients(): array {
        $sql = "SELECT * FROM patient";
        $patients = [];

        try {
            $stmt = $this->database->getPdo()->query($sql);
            while ($row = $stmt->fetch()) {
                $patients[] = self::toPatient($row);
            }
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return $patients;
    }

    public function selectPatientById(string $id): ?Patient {
        $sql = "SELECT * FROM patient WHERE id = '$id'";

        try {
            $stmt = $this->database->getPdo()->query($sql);
            $row = $stmt->fetch();
            return $row ? self::toPatient($row) : null;
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return null;
    }

    public function insertPatient(Patient $patient): int {
        $sql = "INSERT INTO patient (id, nom, prenom, addresse)
                VALUES (
                    '" . $patient->getId() . "',
                    '" . $patient->getNom() . "',
                    '" . $patient->getPrenom() . "',
                    '" . $patient->getAddresse() . "'
                )";

        try {
            return $this->database->getPdo()->exec($sql);
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return 0;
    }

    private static function toPatient(array $row): Patient {
        $patient = new Patient($row['id']);
        $patient->setNom($row['nom'])
                ->setPrenom($row['prenom'])
                ->setAddresse($row['addresse']);
        return $patient;
    }
}
