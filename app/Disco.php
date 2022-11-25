<?php

declare(strict_types=1);

namespace examen\app;

//include_once "Soporte.php"; 
include_once "autoload.php"; 

class Disco extends Soporte
{
    public function __construct(
        string $titulo,
        int $numero,
        float $precio,
        public string $idiomas,
        private string $formatPantalla
    ) {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void
    {
        echo parent::muestraResumen() .
            "<p>Idiomas: $this->idiomas</p>
        <p>Formato de pantalla: $this->formatPantalla</p>";
    }
}
