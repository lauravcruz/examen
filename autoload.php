<?php

declare(strict_types=1);
define('BASE_PATH', realpath(dirname(__FILE__)));
function autoload($nombreClase)
{
    $dir = BASE_PATH . '/lib/' . str_replace('\\', '/', $nombreClase) . '.php';
    echo $dir;
    include_once $dir;
};



spl_autoload_register('autoload');

//Incluimos autoload en cada clase y automáticamente se cargan las que se necesiten
