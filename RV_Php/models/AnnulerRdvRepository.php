<?php
require_once './config/Database.php';
require_once './entity/AnnulerRdv.php';

class AnnulerRdvRepository {

    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function insert(AnnulerRdv $annuler): int {
        $sql = "INSERT INTO annulation (id, date, motif, id_rendezvous) 
                VALUES (" . $annuler->getId() . ", '" . $annuler->getDate()->format('Y-m-d H:i:s') . "', '" . $annuler->getMotif() . "', " . $annuler->getIdRendezVous() . ")";
        try {
            return $this->database->getPdo()->exec($sql);
        } catch (\PDOException $ex) {
            echo "Erreur " . $ex->getMessage();
            exit;
        }
    }

    public function findAll(): array {
        $sql = "SELECT * FROM annulation";
        try {
            $stmt = $this->database->getPdo()->query($sql);
            $annulations = [];
            while ($row = $stmt->fetch()) {
                $annulations[] = new AnnulerRdv(
                    $row['id'],
                    $row['motif'],
                    $row['id_rendezvous']
                );
            }
            return $annulations;
        } catch (\PDOException $ex) {
            echo "Erreur " . $ex->getMessage();
            exit;
        }
        return [];
    }

    public function findById(int $id): ?AnnulerRdv {
        $sql = "SELECT * FROM annulation WHERE id = $id";
        try {
            $stmt = $this->database->getPdo()->query($sql);
            if ($row = $stmt->fetch()) {
                return new AnnulerRdv(
                    $row['id'],
                    $row['motif'],
                    $row['id_rendezvous']
                );
            }
        } catch (\PDOException $ex) {
            echo "Erreur " . $ex->getMessage();
            exit;
        }
        return null;
    }
}
