<?php

declare(strict_types=1);
include_once("Soporte.php");
include_once("Juego.php");
include_once("Disco.php");
include_once("CintaVideo.php");
include_once("Cliente.php");

class Videoclub
{
    private $productos = []; //Tipo soporte
    private $numProductos;
    private $socios = []; //Tipo cliente
    private $numSocios;

    public function __construct(
        private String $nombre
    ) {
    }
    private function incluirProducto(Soporte $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirCintaVideo($titulo, $numero, $precio, $duracion)
    {
        $cinta = new CintaVideo($titulo, $numero, $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    public function incluirDVD($titulo, $numero, $precio, $idiomas, $pantalla)
    {
        $dvd = new Disco($titulo, $numero, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
    }
    public function incluirJuego($titulo, $numero,  $precio, $consola, $minJ, $maxJ)
    {
        $juego = new Juego($titulo, $numero, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }
    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3)
    {
        $cliente = new Cliente($nombre, $maxAlquileresConcurrentes);
        array_push($this->socios, $cliente);
    }

    public function listarProductos()
    {
        echo "<p>PRODUCTOS: </p><ul>";
        foreach ($this->productos as $producto) {
            echo "<li>$producto->titulo</li>";
        }
        echo "</ul>";
    }

    public function listarSocios()
    {
        echo "<p>SOCIOS: </p><ul>";
        foreach ($this->socios as $socio) {
            echo "<li>$socio->nombre</li>";
        }
        echo "</ul>";
    }
}
