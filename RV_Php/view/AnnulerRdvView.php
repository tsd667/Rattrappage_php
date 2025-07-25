<?php 
require_once "./entity/AnnulerRdv.php";

class AnnulerRdvView {

    public static function saisirAnnulation(): AnnulerRdv {
        $id = (int)readline("Entrez l'ID de la demande d'annulation : ");
        $motif = readline("Entrez le motif d'annulation : ");
        $idRdv = (int)readline("Entrez l'ID du rendez-vous à annuler : ");

        return new AnnulerRdv($id, $motif, $idRdv);
    }

    public static function afficheAnnulations(array $annulations): void {
        foreach ($annulations as $annulation) {
            print($annulation . "\n");
        }
    }
}
