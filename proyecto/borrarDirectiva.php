<!DOCTYPE html>
<html>
<?php
    include "componentes/head.php";
    require "modelo/directiva.php";
?>

<body>
    <h1>Borrar directiva: </h1>
    <br>

    <?php

    if (isset($_GET['dni']) && !empty($_GET['dni'])) {
        $dni= $_GET['dni'];
        $directiva = new Directiva();
        $directiva->setDNI_Presidente($dni);
        echo $directiva->eliminarDirectiva();
    }

    ?>
    <br>
    <a href="indexDirectivas.php"><button button class="btn btn-primary">Volver al listado</button></a>

</body>

</html>