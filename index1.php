<?php
//include_once "app/CintaVideo.php";

//Cargamos el autoload y usamos la clase que necesitemos en cada index
include_once("autoload.php");

use examenPHP\app\CintaVideo;

/*Al hacer Soporte abstracta, ya no podemos crear un objeto de este tipo: 

$soporte1 = new Soporte("Tenet", 22, 3);
echo "<strong>" . $soporte1->titulo . "</strong>";
echo "<br>Precio: " . $soporte1->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros<br>";
$soporte1->muestraResumen();*/

$miCinta = new Cintavideo("Los cazafantasmas", 23, 3.5, 107);
echo "<strong>" . $miCinta->titulo . "</strong>";
echo "<br>Precio: " . $miCinta->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";
$miCinta->muestraResumen();
