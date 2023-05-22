<!DOCTYPE html>
<html>

<head>
<title>Equipos - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/equipo.php";
require "modelo/estadio.php";
require "modelo/directiva.php";
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
                <h1><b>EQUIPOS</b></h1>
                <br><br>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th></th>
                            <th class='text-center'>Nombre</th>
                            <th class='text-center'>Abreviatura</th>
                            <th class='text-center'>Estadio</th>
                            <th class='text-center'>Presidente</th>
                            <th class='text-center'>Nº de jugadores</th>
                            <th class='text-center'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $equipos = new Equipo();
                        $listadoEquipos = $equipos->obtenerListadoEquipos();

                        foreach ($listadoEquipos as $equipo) {

                            $nombre_equipo = $equipo->getNombre_Equipo();

                            $numJugadores = $equipo->getNumeroJugadores($nombre_equipo);

                            $estadio = $equipo->obtenerEstadioEquipo($nombre_equipo);
                            $nombreEstadio = $estadio ? $estadio->getNombre_Estadio() : "<span style='color: red;'>SIN ESTADIO ASIGNADO</span>";

                            $directiva = $equipo->obtenerDirectivaEquipo($nombre_equipo);
                            $nombrePresidente = isset($directiva) ? $directiva->getNombre_Presidente() : "<span style='color: red;'>SIN PRESIDENTE ASIGNADO</span>";
                            $apellidosPresidente = isset($directiva) ? $directiva->getApellidos_Presidente() : "";

                            echo "<tr>
                            <th class='text-center'><img src=" . $equipo->getEscudo(). " width='75' height='75'></th>
                            <th class='text-center'>" . $equipo->getNombre_Equipo() . "</th>
                            <th class='text-center'>" . $equipo->getAbreviatura() . "</th>
                            <th class='text-center'>" . $nombreEstadio . "</th>
                            <th class='text-center'>" . $nombrePresidente . " " . $apellidosPresidente . "</th>
                            <th class='text-center'>" . $numJugadores . "</th>

                            <th class='text-center'>
                                <a href=jugadoresEquipo.php?equipo=" . rawurlencode($equipo->getNombre_Equipo()) . "><button type='button' class='btn btn-success'>Jugadores</button></a>
                                <a href=editarEquipo.php?equipo=" . rawurlencode($equipo->getNombre_Equipo()) . "><button type='button' class='btn btn-info'>Editar</button></a>
                                <a href=borrarEquipo.php?equipo=" . rawurlencode($equipo->getNombre_Equipo()) . "><button type='button' class='btn btn-danger'>Borrar</button></a>
                            </th>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <br>
                <a href="insertarEquipo.php"><button class="btn btn-primary">Nuevo equipo</button></a>
                <br><br>
                <a href="indexEstadios.php"><button class="btn btn-primary">Estadios</button></a>
                <br><br>
                <a href="indexDirectivas.php"><button class="btn btn-primary">Directivas</button></a>
            </div>
        </div>
    </body>
    <div class="footer">
        <h3>© 2022 Real Federación Española de Fútbol</h3>
        Todos los derechos protegidos<br>
        <br>
    </div>
</html>