<?php

namespace examen;

include_once("autoload.php");

use examen\app\Videoclub;

$vc = new Videoclub("Severo 8A");

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente",  4.5, "es", "16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

//listo los productos 
$vc->listarProductos();

//voy a crear algunos socios: 
//he cambiado el máximo de alquileres para que cuadre con el ejemplo de la siguiente parte (dice que el socio 1 tenía como máximo 2) 
$vc->incluirSocio("Amancio Ortega", 2);
$vc->incluirSocio("Pablo Picasso", 2);

/*
$vc->listarSocios();

$vc->alquilaSocioProducto(1, 2); //Has alquilado The Last of Us
$vc->alquilaSocioProducto(1, 3); //Has alquilado Torrente

//alquilo otra vez el soporte 2 al socio 1. 
$vc->alquilaSocioProducto(1, 2); // no debe dejarme porque ya lo tiene alquilado 

//alquilo el soporte 6 al socio 1. 
$vc->alquilaSocioProducto(1, 6); //no se puede porque el socio 1 tiene 2 alquileres como máximo 

//listo los socios 
$vc->listarSocios();

$vc->alquilaSocioProducto(2, 3); //No me deja porque ya lo tiene alquilado el 1
$vc->alquilaSocioProducto(2, 4); //Alquila origen
$vc->alquilaSocioProducto(2, 5); //Alquila el imperio...

//PROBAMOS ENCADENAMIENTO: 
echo "Encadenamiento";
$vc->incluirSocio("Batman", 2);
$vc->incluirSocio("Robin");
$vc->incluirCintaVideo("Scary Movie", 3.5, 107);

//Nombre de la rosa / Error: ya lo tiene alquilado / el soporte no está disponible
$vc->alquilaSocioProducto(3, 7)->alquilaSocioProducto(3, 7)->alquilaSocioProducto(4, 7);

//PROBAMOS EXCEPCIONES
echo "Excepciones: ";
$vc->incluirCintaVideo("Forrest Gump", 1.5, 140);

//No está disponible / Alquila Scary Movie / Ha superado el cupo 
$vc->alquilaSocioProducto(4, 2)->alquilaSocioProducto(4, 8)->alquilaSocioProducto(4, 3);

//Alquila los cazafantasmas / Devuelve los cazafantasmas / error: no alquilado 
$vc->alquilaSocioProducto(3, 6)->devolverSocioProducto(3, 6)->devolverSocioProducto(3, 6);

//Nuevas: 
echo "Alquilar varios productos: ";
$vc->incluirDvd("El año que ganamos el Mundial", 3, "es,en", "16:9");
$vc->incluirDvd("Lo imposible", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("The Imitation Game", 3, "es,en", "16:9");
$vc->incluirSocio("Luis Enrique", 5);

//Alquilado x 3 / Devuelto x 3 / Cancelada: no lo tiene alquilado
$vc->alquilarSocioProductos(5, [10, 11, 12])->devolverSocioProductos(5, [10, 11, 12])->devolverSocioProductos(5, [10, 11, 12]);

//Operación cancelada: uno no disponible / cancelada: no lo tiene alquilado 
$vc->alquilarSocioProductos(5, [10, 11, 12, 2])->devolverSocioProductos(5, [10, 11, 12, 2]);

//Socio no registrado / No existe el soporte 
$vc->alquilaSocioProducto(100, [2, 2, 5])->devolverSocioProductos(5, [26, 27, 29]);
*/