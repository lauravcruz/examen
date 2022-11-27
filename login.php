<?php

declare(strict_types=1);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        //Si están vacíos, le devolvemos al index con el error: 
        $errores = "Debes introducir un usuario y contraseña";
        include "index.php";
    } else {
        //Si no está vacío, comprobamos si los datos son correctos:
        if ($username == "usuario" && $password == "usuario") {
            //Lo guardamos en la sesión y lo mandamos a 012peliculas.php
            session_start();
            $_SESSION['user'] = $username;
            include_once "mainCliente.php";
        } else if ($username == "admin" && $password == "admin") {
            //Lo llevamos a mainAdmin
            session_start();
            //Cargamos el videoclub de prueba del index5
            include_once("index5.php");
            $_SESSION['user'] = $username;
            $_SESSION['clientes'] = $vc->listarSocios();
            $_SESSION['soportes'] = $vc->listarProductos();
            include_once "mainAdmin.php";
        } else {
            // Si las credenciales no son válidas, se vuelven a pedir
            $errores = "Usuario o contraseña no válidos";
            include "index.php";
        }
    }
}
