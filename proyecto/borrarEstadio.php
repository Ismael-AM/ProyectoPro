<!DOCTYPE html>
<html>
<?php
    include "componentes/head.php";
    require "modelo/estadio.php";
?>

<body>
    <h1>Borrar estadio: </h1>
    <br>

    <?php

    if (isset($_GET['estadio']) && !empty($_GET['estadio'])) {
        $est = $_GET['estadio'];
        $estadio = new Estadio();
        $estadio->setNombre_Estadio($est);
        echo $estadio->eliminarEstadio();
    }

    ?>
    <br>
    <a href="indexEstadios.php"><button button class="btn btn-primary">Volver al listado</button></a>

</body>

</html>