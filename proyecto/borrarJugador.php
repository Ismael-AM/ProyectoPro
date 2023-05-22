<!DOCTYPE html>
<html>
<?php
    include "componentes/head.php";
    require "modelo/jugador.php";
?>

    <body>
        <h1>Borrar jugador: </h1>
        <br>

        <?php

        if (isset($_GET['dni']) && !empty($_GET['dni'])) {
            $dni = $_GET['dni'];
            $jugador = new Jugador();
            $jugador->setDNI_Jugador($dni);
            echo $jugador->eliminarJugador();
        }

        ?>
        <br>
        <a href="indexJugadores.php"><button button class="btn btn-primary">Volver al listado</button></a>

    </body>
</html>