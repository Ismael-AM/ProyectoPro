<!DOCTYPE html>
<html>

<head>
    <title>Directivas - RFEF</title>
</head>

<?php
include "componentes/head.php";
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
                <h1><b>DIRECTIVAS<b></h1>
                <br><br>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th class='text-center'>Nombre presidente</th>
                            <th class='text-center'>Apellidos presidente</th>
                            <th class='text-center'>Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $directivas = new Directiva();
                        $listadoDirectivas = $directivas->obtenerListadoDirectivas();

                        foreach ($listadoDirectivas as $directiva) {
                            echo "<tr>
                            <th class='text-center'>" . $directiva->getNombre_Presidente() . "</th>
                            <th class='text-center'>" . $directiva->getApellidos_Presidente() . "</th>
                            <th class='text-center'>" . $directiva->getNombre_Equipo() . "</th>";

                            echo"<th class='text-center'>
                                <a href=editarDirectiva.php?dni=" . $directiva->getDNI_Presidente() . "><button type='button' class='btn btn-info'>Editar datos</button></a>
                                <a href=borrarDirectiva.php?dni=" . $directiva->getDNI_Presidente() . "><button type='button' class='btn btn-danger'>Borrar</button></a>
                            </th>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <br>
                <a href="insertarDirectiva.php"><button class="btn btn-primary">Añadir directiva</button></a>
            </div>
        </div>
        <div class="footer">
            <h3>© 2022 Real Federación Española de Fútbol</h3>
            Todos los derechos protegidos<br>
            <br>
        </div>
    </body>
</html>