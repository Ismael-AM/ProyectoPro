<!DOCTYPE html>
<html>


<?php
include "componentes/head.php";
require "modelo/equipo.php";
?>

<head>
    <title>Plantilla    
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
            <div class="jumbotron" align="center">
                <h1><b><?php $eq = $_GET['equipo']; $equipo = new Equipo(); $equipo->setNombre_Equipo($eq);$team = $equipo->obtenerEquipo(); echo $eq; ?> - PLANTILLA  </b></h1>
                <?php echo "<img src=" . $team->getEscudo() . " width='100' height='100'>"?>
                <br><br>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th class='text-center'></th>
                            <th class='text-center'>Nombre</th>
                            <th class='text-center'>Apellidos</th>
                            <th class='text-center'>Alias</th>
                            <th class='text-center'>Posicion</th>
                            <th class='text-center'>Dorsal</th>
                            <th class='text-center'>Valor de mercado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nombre = $_GET["equipo"];

                        $equipo = new Equipo();
                        $listadoJugadores = $equipo->obtenerJugadoresEquipo($nombre);

                        foreach ($listadoJugadores as $jugador) {
                            echo "<tr>
                            <th class='text-center'><img src=" . $jugador->getImagen(). " width='90' height='100'></th>
                            <th class='text-center'>" . $jugador->getNombre_Jugador() . "</th>
                            <th class='text-center'>" . $jugador->getApellidos_Jugador() . "</th>
                            <th class='text-center'>" . $jugador->getAlias() . "</th>
                            <th class='text-center'>" . $jugador->getPosicion() . "</th>
                            <th class='text-center'>" . $jugador->getNum_Camiseta() . "</th>
                            <th class='text-center'>" . $jugador->getValor_Mercado() . "€</th>

                            <th class='text-center'>
                                <a href=editarJugador.php?dni=" . $jugador->getDNI_Jugador() . "><button type='button' class='btn btn-info'>Editar datos</button></a>
                                <a href=borrarJugador.php?dni=" . $jugador->getDNI_Jugador() . "><button type='button' class='btn btn-danger'>Borrar</button></a>
                            </th>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <br>
                <a href="indexEquipos.php"><button class="btn btn-primary">Volver al listado de equipos</button></a>
            </div>
        </div>
    </body>
    <div class="footer">
        <h3>© 2022 Real Federación Española de Fútbol</h3>
        Todos los derechos protegidos<br>
        <br>
    </div>
</html>