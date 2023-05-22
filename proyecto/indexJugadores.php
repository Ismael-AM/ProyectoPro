<!DOCTYPE html>
<html>

<head>
    <title>Jugadores - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/jugador.php";
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
                <h1><b>JUGADORES<b></h1>
                <br><br>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th></th>
                            <th class='text-center'>Nombre</th>
                            <th class='text-center'>Apellidos</th>
                            <th class='text-center'>Alias</th>
                            <th class='text-center'>Posicion</th>
                            <th class='text-center'>Dorsal</th>
                            <th class='text-center'>Valor de mercado</th>
                            <th class='text-center'>Equipo</th>
                            <th class='text-center'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $jugadores = new Jugador();
                        $listadoJugadores = $jugadores->obtenerListadoJugadores();

                        foreach ($listadoJugadores as $jugador) {
                            echo "<tr>
                            <th class='text-center'><img src=" . $jugador->getImagen(). " width='90' height='100'></th>
                            <th class='text-center'>" . $jugador->getNombre_Jugador() . "</th>
                            <th class='text-center'>" . $jugador->getApellidos_Jugador() . "</th>
                            <th class='text-center'>" . $jugador->getAlias() . "</th>
                            <th class='text-center'>" . $jugador->getPosicion() . "</th>
                            <th class='text-center'>" . $jugador->getNum_Camiseta() . "</th>
                            <th class='text-center'>" . number_format($jugador->getValor_Mercado(), 0, ",", ".") . "€</th>";
                            if($jugador->getNombre_Equipo() == ""){
                                echo "<th class='text-center' style='color: red'>AGENTE LIBRE</th>";
                            }else{
                                echo "<th class='text-center'>" . $jugador->getNombre_Equipo() . "</th>";
                            }

                            echo"<th class='text-center'>
                                <a href=editarJugador.php?dni=" . $jugador->getDNI_Jugador() . "><button type='button' class='btn btn-info'>Editar datos</button></a>
                                <a href=borrarJugador.php?dni=" . $jugador->getDNI_Jugador() . "><button type='button' class='btn btn-danger'>Borrar</button></a>
                            </th>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <br>
                <a href="insertarJugador.php"><button class="btn btn-primary">Añadir jugador</button></a>
            </div>
        </div>
        <div class="footer">
            <h3>© 2022 Real Federación Española de Fútbol</h3>
            Todos los derechos protegidos<br>
            <br>
        </div>
    </body>
</html>