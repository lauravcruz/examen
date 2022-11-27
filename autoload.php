<?php

declare(strict_types=1);

function autoload($nombreClase)
{
    $dir = str_replace("\\", "/", $nombreClase); 
    include_once $dir . ".php";
};

spl_autoload_register('autoload');

//Incluimos autoload en cada clase y automáticamente se cargan las que se necesiten
