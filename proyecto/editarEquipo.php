<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require "modelo/equipo.php";
?>

<head>
    <title>Editar datos 
        <?php 
        $eq = $_GET['equipo'];
        echo $eq; ?> - RFEF
    </title>
</head>

    <body>
        <div class="top">
            <h1 style="color:#ffffff"><b>Real Federación Española de Fútbol</b></h1>
            <img src="imagenes/rfef/rfef.png" width="100" height="100" style="border-radius: 3rem;"><br>
            <div class="header-right">
                <a href="index.php" style="color:#ffffff;">Inicio</a><br>
                <a href="indexEquipos.php" style="color:#ffffff;">Equipos</a><br>
                <a href="indexJugadores.php" style="color:#ffffff;">Jugadores</a><br>
            </div>
        </div>
        <div class="container-fluid">
            <div class="jumbotron">
                <div align="center">
                    <h2><b>Editar datos <?php $eq = $_GET['equipo']; echo $eq; ?></b></h2>
                </div>

                <?php

                if (isset($_GET['equipo']) && !empty($_GET['equipo'])) {
                    $eq = $_GET['equipo'];
                    $equipos = new Equipo();
                    $equipos->setNombre_Equipo($eq);
                    $equipo = $equipos->obtenerEquipo();             
                }

                if (
                    isset($_POST['Nombre_Equipo'])
                    && isset($_POST['Abreviatura'])
                    && isset($_POST['Escudo'])
                    && isset($_POST['Palmares'])
                ) {
                    $Nombre_Equipo = $_POST['Nombre_Equipo'];
                    $Abreviatura = $_POST['Abreviatura'];
                    $Escudo = $_POST['Escudo'];
                    $Palmares = $_POST['Palmares'];

                    $equipo = new Equipo();
                    
                    $equipo->setNombre_Equipo($Nombre_Equipo);
                    $equipo->setAbreviatura($Abreviatura);
                    $equipo->setEscudo($Escudo);
                    $equipo->setPalmares($Palmares);

                    echo $equipo->actualizarEquipo();
                }

                ?>
                <div class="container-fluid">
                    <form id="editarEquipoForm" action="editarEquipo.php" method="post">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="Nombre_Equipo" value="<?php echo $equipo->getNombre_Equipo(); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Abreviatura</label>
                            <input type="text" class="form-control" name="Abreviatura" value="<?php echo $equipo->getAbreviatura(); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Escudo</label>
                            <input type="text" class="form-control" name="Escudo" value="<?php echo $equipo->getEscudo(); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Palmarés</label>
                            <input type="text" class="form-control" name="Palmares" value="<?php echo $equipo->getPalmares(); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Editar equipo</button>
                    </form>
                    <br>
                    <a href="indexEquipos.php"><button>Volver al listado</button></a>
                </div>
            </div>
    </body>
</html>