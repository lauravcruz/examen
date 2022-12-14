<?php
// include_once "app/Cliente.php";
// include_once "app/Juego.php";
// include_once "app/Disco.php";
// include_once "app/CintaVideo.php";
include_once("autoload.php");

use examen\app\Cliente;
use examen\app\Juego;
use examen\app\Disco;
use examen\app\CintaVideo;

/* Esto lo dejamos comentado porque si no da fallo: ahora el constructor debe llevar username y password
$cliente1 = new Cliente("Bruce Wayne", 23);
$cliente2 = new Cliente("Clark Kent", 33);
*/
//mostramos el número de cada cliente creado 
echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero();

//instancio algunos soportes 
$soporte1 = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
$soporte2 = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);
$soporte3 = new Disco("Origen", 24, 15, "es,en,fr", "16:9");
$soporte4 = new Disco("El Imperio Contraataca", 4, 3, "es,en", "16:9");

//alquilo algunos soportes
$cliente1->alquilar($soporte1);
$cliente1->alquilar($soporte2);
$cliente1->alquilar($soporte3);


//Al meter en cliente las excepciones, se producirán errores en esta página: 
//En el index5 capturamos los errores con los try/catch de Videoclub

//voy a intentar alquilar de nuevo un soporte que ya tiene alquilado
$cliente1->alquilar($soporte1);
//el cliente tiene 3 soportes en alquiler como máximo
//este soporte no lo va a poder alquilar
$cliente1->alquilar($soporte4);
//este soporte no lo tiene alquilado
$cliente1->devolver(4);
//devuelvo un soporte que sí que tiene alquilado: he tenido que cambiar el número porque no coincidía:
$cliente1->devolver(26);
//alquilo otro soporte
$cliente1->alquilar($soporte4);
//listo los elementos alquilados
$cliente1->listaAlquileres();
//este cliente no tiene alquileres
$cliente2->devolver(2);

//PROBAMOS EL ENCADENAMIENTO DE MÉTODOS: 
echo "Encadenamiento: ";
//24 -> 3 ; 23-> 1
$cliente2->alquilar($soporte1)->devolver(23);
$cliente2->alquilar($soporte3)->devolver(24)->alquilar($soporte3);
$cliente2->devolver(24)->alquilar($soporte1);
