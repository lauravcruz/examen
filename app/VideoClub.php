<?php

declare(strict_types=1);

namespace examenPHP\app;
//include_once "app/Cliente.php";
//include_once "app/Juego.php";
// include_once "app/Disco.php";
// include_once "app/CintaVideo.php";
include_once("autoload.php");

class Videoclub
{
    private $productos = []; //Tipo soporte
    private $numProductos = 0;
    private $socios = []; //Tipo cliente
    private $numSocios = 0;

    public function __construct(
        private String $nombre
    ) {
    }
    private function incluirProducto(Soporte $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirCintaVideo($titulo, $precio, $duracion)
    {
        ++$this->numProductos;
        $cinta = new CintaVideo($titulo, $this->numProductos, $precio, $duracion);
        $this->incluirProducto($cinta);
    }

    public function incluirDVD($titulo, $precio, $idiomas, $pantalla)
    {
        ++$this->numProductos;
        $dvd = new Disco($titulo, $this->numProductos, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
    }
    public function incluirJuego($titulo, $precio, $consola, $minJ, $maxJ)
    {
        ++$this->numProductos;
        $juego = new Juego($titulo, $this->numProductos, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }
    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3)
    {
        ++$this->numSocios;
        $cliente = new Cliente($nombre, $this->numSocios, $maxAlquileresConcurrentes);
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
            echo $socio->listaAlquileres();
        }
        echo "</ul>";
    }

    public function alquilaSocioProducto($numeroCliente, $numeroSoporte)
    {
        $completado = false;
        //Buscamos al socio para identificarlo con el número
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numeroCliente) {
                //Identificamos el soporte de la misma manera: 
                foreach ($this->productos as $soporte) {
                    if ($soporte->getNumero() == $numeroSoporte) {
                        //Una vez encontrados ambos, realizamos la acción de alquilar
                        $completado = true;
                        $socio->alquilar($soporte);
                    }
                }
            }
        }
        if (!$completado) {
            //Mandamos el mensaje de error por si metemos ids que no existen
            echo "Error: nº de soporte o nº de socio no encontrado";
        }
        return $this;
    }
}
