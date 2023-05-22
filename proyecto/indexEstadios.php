<!DOCTYPE html>
<html>

<head>
<title>Estadios - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/estadio.php";
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
            <div class="jumbotron" align="center">
                <h1><b>ESTADIOS</b></h1>
                <br><br>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th class='text-center'>Nombre</th>
                            <th class='text-center'>Equipo</th>
                            <th class='text-center'>Capacidad</th>
                            <th class='text-center'>Ubicación</th>
                            <th class='text-center'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $estadios = new Estadio();
                        $listadoEstadios = $estadios->obtenerListadoEstadios();

                        foreach ($listadoEstadios as $estadio) {

                            echo "<tr>
                            <th class='text-center'>" . $estadio->getNombre_Estadio(). "</th>";
                            if($estadio->getNombre_Equipo() == ""){
                                echo "<th class='text-center' style='color:red'>SIN EQUIPO PROPIETARIO</th>";
                            }else{
                                echo "<th class='text-center'>" . $estadio->getNombre_Equipo() . "</th>";
                            }
                            echo "<th class='text-center'>" . number_format($estadio->getCapacidad(), 0, ",", ".") . "</th>
                            <th class='text-center'>" . $estadio->getUbicacion() . "</th>

                            <th class='text-center'>
                                <a href=editarEstadio.php?estadio=" . rawurlencode($estadio->getNombre_Estadio()) . "><button type='button' class='btn btn-info'>Editar</button></a>
                                <a href=borrarEstadio.php?estadio=" . rawurlencode($estadio->getNombre_Estadio()) . "><button type='button' class='btn btn-danger'>Borrar</button></a>
                            </th>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <br>
                <a href="insertarEstadio.php"><button class="btn btn-primary">Nuevo estadio</button></a>
            </div>
        </div>
    </body>
    <div class="footer">
        <h3>© 2022 Real Federación Española de Fútbol</h3>
        Todos los derechos protegidos<br>
        <br>
    </div>
</html>