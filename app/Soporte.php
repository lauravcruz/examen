<?php

declare(strict_types=1);

namespace examen\app;

include_once "autoload";


/*Al hacerla abstracta, no podemos instanciarla. Simplemente sirve de plantilla
para las clases que hereden de ella. En este caso viene muy bien porque nunca vamos a crear un
objeto Soporte. Crearemos DVD, Juego o Cinta. Las propiedades que los 3 comparte son las 
que tenemos en Soporte*/

abstract class Soporte implements Resumible
{
    const IVA = 0.21;

    public function __construct(
        public String $titulo,
        protected int $numero,
        private float $precio
    ) {
    }
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }
    public function getPrecioConIva(): float
    {
        return $this->precio - ($this->precio * $this::IVA);
    }

    public function muestraResumen(): void
    {
        echo "<p>Nombre: $this->titulo</p>
        <p>Precio: " . $this->precio . " euros</p>
        <p>Precio con IVA:" . $this->getPrecioConIva() . " euros</p>";
    }
}
