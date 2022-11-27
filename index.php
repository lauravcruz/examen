<?php

declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <script defer src="js/bootstrap.bundle.js"></script>
    <title>VIDEOCLUB ILERNA</title>
</head>

<body>
    <?php

    ?>
    <section class="vh-100 bg-black">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5 text-danger">INICIA SESIÓN</h3>
                            <form action="login.php" method="POST">
                                <div><span class='errores'>
                                        <!--Imprimimos los errores que devuelve el controlador en caso de que los haya-->
                                        <?php echo $errores ?? ""; ?>
                                    </span></div>
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                    <label class="form-label" for="username">Usuario</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                    <label class="form-label" for="password">Contraseña</label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" name="login" value="login" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>