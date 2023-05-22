<!DOCTYPE html>
<html>
<?php
    include "componentes/head.php";
    require "modelo/equipo.php";
?>

<body>
    <h1>Borrar equipo: </h1>
    <br>

    <?php

    if (isset($_GET['equipo']) && !empty($_GET['equipo'])) {
        $eq = $_GET['equipo'];
        $equipo = new Equipo();
        $equipo->setNombre_Equipo($eq);
        echo $equipo->eliminarEquipo();
    }

    ?>
    <br>
    <a href="indexEquipos.php"><button button class="btn btn-primary">Volver al listado</button></a>

</body>

</html>