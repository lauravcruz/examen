<?php

declare(strict_types=1);

namespace examen\app;

use examen\util\CupoSuperadoException;
use examen\util\SoporteNoEncontradoException;
use examen\util\SoporteYaAlquiladoException;


class Cliente
{
    private $soportesAlquilados = []; //Tipo disco, cinta... heredados de soporte
    private int $numSoportesAlquilados = 0;

    public function __construct(
        public String $nombre,
        private int $numero,
        private int $maxAlquilerconcurrente = 3
    ) {
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->nombre = $numero;
        return $this;
    }

    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado(Soporte $s): bool
    {
        //Recorre el array de soportes y comprueba si está el soporte
        foreach ($this->soportesAlquilados as $alquilado) {
            if ($alquilado->getNumero() == $s->getNumero()) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s)
    {
        //Comprobamos que el soporte no esté alquilado
        if (!$this->tieneAlquilado($s)) {
            //Comprobamos que no haya superado el cupo de alquileres
            if ($this->numSoportesAlquilados >= $this->maxAlquilerconcurrente) {
                //Ahora no hace falta que devolver false ni mostremos el error. Tenemos una excepción: 
                throw new CupoSuperadoException("<p>Error: ha superado el cupo de alquileres</p>");
                //echo "<p>Error: ha superado el cupo de alquileres</p>";
                //return false;
            } else if (!$s->alquilado) {
                //Añadimos el soporte
                array_push($this->soportesAlquilados, $s);
                $this->numSoportesAlquilados++;
                //Marcamos el soporte como alquilado: 
                $s->alquilado = true;
                echo "<p>¡Has alquilado $s->titulo!</p>";
                //return true; 
            } else {
                echo "<p>El soporte no está disponible en estos momentos</p>";
            }
        } else {
            throw new SoporteYaAlquiladoException("<p>Error: Ese soporte ya lo tiene alquilado</p>");
            //echo "<p>Ese soporte ya lo tiene alquilado</p>";
            //return false;
        }
        return $this;
    }

    public function devolver(int $numSoporte)
    {
        $completado = false;
        //Comprobamos que esté alquilado 
        foreach ($this->soportesAlquilados as $alquilado => $valor) {
            //Si está alquilado, aceptamos la devolución y actualizamos el num de alquilados
            if ($valor->getNumero() == $numSoporte) {
                //Si se acepta la devolución, restamos 1 a los soportes alquilados y lo sacamos del array
                $this->numSoportesAlquilados--;
                //Indicamos al soporte que ya está disponible: 
                $valor->alquilado = false;
                unset($this->soportesAlquilados[$alquilado]);
                echo "<p>Devolución completada</p>";
                //return true
                $completado = true;
            }
        }
        if (!$completado) {
            throw new SoporteNoEncontradoException("<p>Error: el soporte no estaba alquilado</p>");
            //echo "<p>Error: el soporte no estaba alquilado</p>";
            //return false
        }
        return $this;
    }
    public function listaAlquileres(): void
    {
        echo "<p>Número de alquileres: $this->numSoportesAlquilados</p><ul>";
        foreach ($this->soportesAlquilados as $alquilado) {
            echo "<li>" . $alquilado->titulo . "</li>";
        }
        echo "</ul>";
    }

    public function muestraResumen(): void
    {
        echo "<p>Nombre: $this->nombre</p>
        <p>Cantidad de alquileres: $this->numSoportesAlquilados</p>";
    }
}
