<?php

declare(strict_types=1);

namespace examen\app;

use examen\util\ClienteNoEncontradoException;
use examen\util\CupoSuperadoException;
use examen\util\SoporteNoEncontradoException;
use examen\util\SoporteYaAlquiladoException;

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
    private $numProductosAlquilados = 0;
    private $numTotalAlquileres = 0;


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

    public function listarProductos():string
    {
        //Cambiamos para que devuelva un string almacenable en la SESSION['productos']
        $listarProducto = "<p>PRODUCTOS: </p><ul>";
        foreach ($this->productos as $producto) {
            $listarProducto .= "<li>$producto->titulo</li>";
        }
        $listarProducto .= "</ul>";
        return $listarProducto;
    }

    public function listarSocios(): string
    {
        $listarSocio = "<p>SOCIOS: </p><ul>";

        foreach ($this->socios as $socio) {
            $listarSocio .= "<li>$socio->nombre</li>";
            //echo $socio->listaAlquileres();
        }
        $listarSocio .= "</ul>";
        return $listarSocio;
    }

    public function alquilaSocioProducto($numeroCliente, $numeroSoporte)
    {
        $socioExiste = false;
        $productoExiste = false;
        try {
            //Buscamos al socio para identificarlo con el número
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numeroCliente) {
                    $socioExiste = true;
                    //Identificamos el soporte de la misma manera: 
                    try {
                        foreach ($this->productos as $soporte) {
                            if ($soporte->getNumero() == $numeroSoporte) {
                                $productoExiste = true;
                                //Una vez encontrados ambos, realizamos la acción de alquilar
                                $socio->alquilar($soporte);
                            }
                        }
                        if (!$productoExiste) {
                            throw new SoporteNoEncontradoException("<p>Error: no existe ese soporte</p>");
                        }
                        return $this;
                        //Capturamos las excepciones e informamos al usuario: 
                    } catch (CupoSuperadoException $e) {
                        echo $e->getMessage();
                    } catch (SoporteYaAlquiladoException $e) {
                        echo $e->getMessage();
                    } catch (SoporteNoEncontradoException $e) {
                        echo $e->getMessage();
                    }
                }
            }
            if (!$socioExiste) {
                throw new ClienteNoEncontradoException("<p>Error: socio no registrado</p>");
            }
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMessage();
        }
        return $this;
    }

    public function getNumProductosAlquilados()
    {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres()
    {
        return $this->numTotalAlquileres;
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos)
    {
        //Inicializamos una variable que se pondrá true si encuentra un producto alquilado (cancela la operación)
        $ocupado = false;
        try {
            foreach ($this->productos as $vcproducto) {
                foreach ($numerosProductos as $numProducto) {
                    if ($vcproducto->getNumero() == $numProducto) {
                        if ($vcproducto->alquilado) {
                            //Cancelamos
                            $ocupado = true;
                        }
                    }
                }
            }
            if (!$ocupado) {
                foreach ($numerosProductos as $numProducto) {
                    $this->alquilaSocioProducto($numSocio, $numProducto);
                }
            } else {
                throw new SoporteYaAlquiladoException("<p>Operación cancelada: uno de los soportes no está disponible</p>");
            }
        } catch (SoporteYaAlquiladoException $e) {
            echo $e->getMessage();
        }
        return $this;
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto)
    {
        $socioExiste = false;
        $productoExiste = false;
        try {
            //Buscamos al socio para identificarlo con el número
            foreach ($this->socios as $socio) {
                if ($socio->getNumero() == $numSocio) {
                    $socioExiste = true;
                    //Identificamos el soporte de la misma manera: 
                    try {
                        foreach ($this->productos as $soporte) {
                            if ($soporte->getNumero() == $numeroProducto) {
                                $productoExiste = true;
                                //Una vez encontrados ambos, realizamos la acción de devolver
                                $socio->devolver($soporte->getNumero());
                                return $this;
                            }
                        }
                        if (!$productoExiste) {
                            throw new SoporteNoEncontradoException("<p>Error: no existe ese soporte</p>");
                        }
                        //Capturamos las excepciones e informamos al usuario: 
                    } catch (SoporteNoEncontradoException $e) {
                        echo $e->getMessage();
                    }
                }
            }
            if (!$socioExiste) {
                throw new ClienteNoEncontradoException("<p>Error: socio no registrado</p>");
            }
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMessage();
        }
        return $this;
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos)
    {
        //Inicializamos una variable que se pondrá true si encuentra un producto que no tiene alquilado
        $alquilado = true;
        $socioExiste = false;
        $productoExiste = false;
        try {
            //Recorro los socios para identificarlo 
            foreach ($this->socios as $vcsocio) {
                if ($vcsocio->getNumero() == $numSocio) {
                    $socioExiste = true;
                    foreach ($numerosProductos as $numProducto) {
                        //Identificamos el producto
                        foreach ($this->productos as $producto) {
                            if ($producto->getNumero() == $numProducto) {
                                $productoExiste = true;
                                //Comprobamos que el socio tenga alquilado cada soporte
                                if (!$vcsocio->tieneAlquilado($producto)) {
                                    //Cancelamos
                                    $alquilado = false;
                                }
                            }
                        }
                    }
                }
            }
            if (!$socioExiste) {
                /*Aunque en devolver() ya se controla si el socio existe lo repito para evitar que se lance el error
                    varias veces (al recorrer cada producto lo lanzaba)*/
                throw new ClienteNoEncontradoException("<p>Error: Socio no registrado </p>");
            }
            if (!$productoExiste) {
                /*Aunque en devolver() ya se controla si el socio existe lo repito para evitar que se lance el error
                    varias veces (al recorrer cada producto lo lanzaba)*/
                throw new SoporteNoEncontradoException("<p>Error: no existe ese soporte</p>");
            }
            if ($alquilado) {
                foreach ($numerosProductos as $numProducto) {
                    $this->devolverSocioProducto($numSocio, $numProducto);
                }
            } else {
                throw new SoporteNoEncontradoException("<p>Operación cancelada: uno de los soportes no lo tenía alquilado</p>");
            }
        } catch (SoporteNoEncontradoException $e) {
            echo $e->getMessage();
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMessage();
        }
        return $this;
    }
}
