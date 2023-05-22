<!DOCTYPE html>
<html>

<head>
<title>Añadir equipo - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/equipo.php";
?>

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
                    <h2><b>Añadir equipo</b></h2>
                </div>
                <br>

                <?php

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

                    echo $equipo->insertarEquipo();
                }

                ?>
                    <div class="container-fluid">
                        <form id="insertarEquipoForm" action="insertarEquipo.php" method="post">

                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="Nombre_Equipo" required>
                            </div>

                            <div class="form-group">
                                <label>Abreviatura</label>
                                <input type="text" class="form-control" name="Abreviatura" required>
                            </div>

                            <div class="form-group">
                                <label>Escudo</label>
                                <input type="text" class="form-control" name="Escudo" required>
                            </div>

                            <div class="form-group">
                                <label>Palmarés</label>
                                <input type="text" class="form-control" name="Palmares">
                            </div>

                            <button type="submit" class="btn btn-primary">Añadir equipo</button>
                        </form>
                        <br>
                        <a href="indexEquipos.php"><button>Volver al listado</button></a>
                    </div>
            </div>
        </div>
        <div class="footer">
            <h3>© 2022 Real Federación Española de Fútbol</h3>
            Todos los derechos protegidos<br>
            <br>
        </div>
    </body>
</html>