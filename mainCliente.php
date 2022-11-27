<?php

declare(strict_types=1);
if (!isset($_SESSION)) {
    session_start();
}
// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['user'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
?>

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
<main>
        <div class="container-fluid p-5">
            <h1 class="display-1 text-center">Bienvenid@ <?php echo $_SESSION['user'] ?></h1>
            <a class="nav-link active text-secondary" aria-current="page" href="logout.php">LOG OUT</a>
        </div>
    </main>
</body>

</html>