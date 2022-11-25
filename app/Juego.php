<?php

declare(strict_types=1);

namespace examenPHP\app;

//include_once "Soporte.php"; 
include_once "autoload.php";

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
        if ($this->minNumJugadores == 1 && $this->maxNumJugadores == 1) {
            return "1 jugador";
        } else {
            return "De $this->minNumJugadores  a  $this->maxNumJugadores jugadores";
        }
    }

    public function muestraResumen(): void
    {
        echo parent::muestraResumen() .
            "<p>Consola: $this->consola </p>
        <p>" . $this->mostrarJugadoresPosibles() . "</p>";
    }
}

$miDisco = new Disco("Origen", 24, 15, "es,en,fr", "16:9");
