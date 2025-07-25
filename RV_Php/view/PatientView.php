<?php
require_once './entity/Patient.php';

class PatientView {

    public static function saisirPatient(): Patient {
        $id = readline("Entrez l'ID du patient : ");
        $nom = readline("Entrez le nom du patient : ");
        $prenom = readline("Entrez le prénom du patient : ");
        $addresse = readline("Entrez l'adresse du patient : ");

        $patient = new Patient($id);
        $patient->setNom($nom)
                ->setPrenom($prenom)
                ->setAddresse($addresse);

        return $patient;
    }

    public static function afficherPatients(array $patients): void {
        foreach ($patients as $patient) {
            print($patient . "\n");
        }
    }
}
