<?php

declare(strict_types=1);
include_once "Soporte.php";

class CintaVideo extends Soporte
{
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        private int $duracion,
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . "<p>Duración: $this->duracion</p>";
    }
}
