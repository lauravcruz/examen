<?php

declare(strict_types=1);
include_once "Soporte.php";

class Juego extends Soporte
{

    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        public string $consola,
        private int $minNumJugadores,
        private int $maxNumJugadores
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function mostrarJugadoresPosibles()
    {
        if ($this->maxNumJugadores <= 1) {
            //Si el número máximo de jugadores es 1 o menor, mostramos solo 1: 
            return "1 jugador";
        } else {
            return "De $this->minNumJugadores  a  $this->maxNumJugadores jugadores";
        }
    }

    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "<p>Consola: $this->consola </p>
        <p>" . $this->mostrarJugadoresPosibles() . "</p>";
    }
}
