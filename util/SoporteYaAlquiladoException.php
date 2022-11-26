<?php

declare(strict_types=1);

namespace examen\util;

use Exception;

class SoporteYaAlquiladoException extends VideoclubException
{
    public function __construct($msj, $codigo = 0, Exception $previa = null)
    {
        parent::__construct($msj, $codigo, $previa);
    }
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
