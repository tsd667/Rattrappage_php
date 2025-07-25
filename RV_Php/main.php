<?php
require_once 'services/PatientService.php';
require_once 'views/PatientView.php';

class App {
    public static function main(): void {
        $service = new PatientService();
        $patients = [];

        do {
            $choix = self::menu();
            switch ($choix) {
                case '1':
                    $patient = PatientView::saisiePatient();
                    if (!array_key_exists($patient->getId(), $patients)) {
                        $patients[$patient->getId()] = $patient;
                        print("Patient ajouté avec succès.\n");
                    } else {
                        print("Un patient avec ce même ID existe déjà.\n");
                    }
                    break;

                case '2':
                    $id = readline("ID du patient : ");
                    if (isset($patients[$id])) {
                        $ok = $service->DemandeRendezVous($patients[$id]);
                        print($ok ? "Demande de rendez-vous enregistrée.\n" : "Échec de la demande de rendez-vous.\n");
                    } else {
                        print("Patient introuvable.\n");
                    }
                    break;

                case '3':
                    PatientView::afficherListeRdv($service->getRdvs());
                    break;

                case '4':
                    $idRdv = (int) readline("ID du RDV : ");
                    $rdv = $service->rechercherRdvById($idRdv);
                    if ($rdv !== null) {
                        PatientView::afficherUnRdv($rdv);
                    } else {
                        print("Aucun rendez-vous trouvé avec cet ID.\n");
                    }
                    break;

                case '5':
                    $idRdv = (int) readline("ID du RDV à annuler : ");
                    $motif = readline("Motif d'annulation : ");
                    $ok = $service->AnnulaterRendezVous($idRdv, $motif);
                    print($ok ? "Rendez-vous annulé avec succès.\n" : "Échec de l'annulation (peut-être moins de 48h ou déjà traité).\n");
                    break;
            }
        } while ($choix !== '6');
    }

    public static function menu(): string {
        print("\n1 - Créer un Patient\n");
        print("2 - Demander un Rendez-vous\n");
        print("3 - Lister tous les Rendez-vous\n");
        print("4 - Chercher un Rendez-vous\n");
        print("5 - Annuler un Rendez-vous\n");
        print("6 - Quitter\n");
        return readline("Choix : ");
    }
}

App::main();
