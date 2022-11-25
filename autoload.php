<?php

declare(strict_types=1);

function autoload($nombreClase)
{
    include_once "$nombreClase.php";
};

spl_autoload_register('autoload');
