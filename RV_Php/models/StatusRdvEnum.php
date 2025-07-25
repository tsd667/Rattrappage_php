<?php

enum StatusRdvEnum: int {
    case EN_ATTENTE = 1;
    case VALIDE = 2;
    case REFUSE = 3;
    case ANNULE = 4;
    case ERROR = 0;

    public function getValeur(): int {
        return $this->value;
    }
}
