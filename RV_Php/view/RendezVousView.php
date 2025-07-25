<?php
require_once './entity/RendezVous.php';

class RendezVousView {
    
    public function saisirRendezVous(Patient $patient): RendezVous {
        $dateString = readline("Entrez la date du rendez-vous (format : YYYY-MM-DD HH:MM) : ");
        $date = DateTime::createFromFormat('Y-m-d H:i', $dateString);

        if (!$date) {
            $date = new DateTime(); 
        }

        return new RendezVous($patient, $date);
    }

    public function listerRendezVous(array $rdvs): void {
        foreach ($rdvs as $rdv) {
            if ($rdv instanceof RendezVous) {
                echo $rdv->__toString();
            }
        }
    }
}
