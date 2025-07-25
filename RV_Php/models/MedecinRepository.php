<?php
require_once './config/Database.php';
require_once './entity/Medecin.php';

class MedecinRepository {
    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function selectAllMedecins(): array {
        $sql = "SELECT * FROM medecin";
        $medecins = [];

        try {
            $stmt = $this->database->getPdo()->query($sql);
            while ($row = $stmt->fetch()) {
                $medecins[] = self::toMedecin($row);
            }
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return $medecins;
    }

    public function selectMedecinById(string $id): ?Medecin {
        $sql = "SELECT * FROM medecin WHERE id = '$id'";

        try {
            $stmt = $this->database->getPdo()->query($sql);
            $row = $stmt->fetch();
            return $row ? self::toMedecin($row) : null;
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return null;
    }

    public function insertMedecin(Medecin $medecin): int {
        $sql = "INSERT INTO medecin (id, nom, prenom, addresse, specialite)
                VALUES (
                    '" . $medecin->getId() . "',
                    '" . $medecin->getNom() . "',
                    '" . $medecin->getPrenom() . "',
                    '" . $medecin->getAddresse() . "',
                    '" . $medecin->getSpecialite()->value . "'
                )";

        try {
            return $this->database->getPdo()->exec($sql);
        } catch (\PDOException $ex) {
            echo("Erreur " . $ex->getMessage());
            exit;
        }

        return 0;
    }

    private static function toMedecin(array $row): Medecin {
        $medecin = new Medecin($row['id']);
        $medecin->setNom($row['nom'])
                ->setPrenom($row['prenom'])
                ->setAddresse($row['addresse'])
                ->setSpecialite(SpecialiteEnum::from($row['specialite']));
        return $medecin;
    }
}
