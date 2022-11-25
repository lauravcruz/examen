<?php
declare(strict_types=1);

namespace examen\app;


interface Resumible
{
    /*No hace falta que las clases hijas de Soporte implementen muestraResumen() porque
    Soporte ya la implementa. Si un objeto de una clase hija de soporte muestraResumen imprimirá
    la función definida en la clase padre Soporte*/
    public function muestraResumen(): void;
}
