<?php

declare(strict_types=1);

class Soporte
{
    const IVA = 0.21;
    //TODO: estática privada??

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

    public function muestraResumen()
    {
        echo "<p>Nombre: $this->titulo</p>
        <p>Precio: " . $this->precio . " euros</p>
        <p>Precio con IVA:" . $this->getPrecioConIva() . " euros</p>";
    }
}
