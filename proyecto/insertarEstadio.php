<!DOCTYPE html>
<html>

<head>
<title>Añadir estadio - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/estadio.php";
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
                    <h2><b>Añadir estadio</b></h2>
                </div>
                <br>

                <?php

                if (
                    isset($_POST['Nombre_Estadio'])
                    && isset($_POST['Ubicacion'])
                    && isset($_POST['Capacidad'])
                    && isset($_POST['Nombre_Equipo'])
                ) {
                    $Nombre_Estadio = $_POST['Nombre_Estadio'];
                    $Ubicacion = $_POST['Ubicacion'];
                    $Capacidad = $_POST['Capacidad'];
                    $Nombre_Equipo = rawurldecode($_POST['Nombre_Equipo']);
                    
                    $estadio = new Estadio();
                        
                    $estadio->setNombre_Estadio($Nombre_Estadio);
                    $estadio->setUbicacion($Ubicacion);
                    $estadio->setCapacidad($Capacidad);
                    $estadio->setNombre_Equipo($Nombre_Equipo);

                    echo $estadio->insertarEstadio();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->EquiposSinEstadio();

                ?>
                    <div class="container-fluid">
                        <form id="insertarEstadioForm" action="insertarEstadio.php" method="post">

                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="Nombre_Estadio" required>
                            </div>

                            <div class="form-group">
                                <label>Ubicacion</label>
                                <input type="text" class="form-control" name="Ubicacion" required>
                            </div>

                            <div class="form-group">
                                <label>Capacidad</label>
                                <input type="int" class="form-control" name="Capacidad" required>
                            </div>
                            
                            <?php
                            echo"<div class='form-group'>";
                            echo"<label>Equipo</label>";
                                if (count($listadoEquipos) > 0) { 
                                    echo "<select class='form-control' name='Nombre_Equipo' required>";
                                        foreach ($listadoEquipos as $equipo) { 
                                            echo "<option value=" . rawurlencode($equipo->getNombre_Equipo()) . ">" . $equipo->getNombre_Equipo() . "</option>";
                                        } 
                                    echo "</select>";
                                    echo "<br><button type='submit' class='btn btn-primary'>Añadir estadio</button>";
                                } else {
                                    echo "<p>No hay equipos sin estadio.</p>";
                                }
                            echo "</div>";
                            ?>
                        </form>
                        <a href="indexEstadios.php"><button>Volver al listado</button></a>
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