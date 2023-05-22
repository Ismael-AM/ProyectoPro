<!DOCTYPE html>
<html>

<head>
<title>Añadir jugador - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/jugador.php";
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
                    <h2><b>Añadir jugador</b></h2>
                </div>
                <br>

                <?php

                if (
                    isset($_POST['DNI_Jugador'])
                    && isset($_POST['Nombre_Jugador'])
                    && isset($_POST['Apellidos_Jugador'])
                    && isset($_POST['Alias'])
                    && isset($_POST['Posicion'])
                    && isset($_POST['Valor_Mercado'])
                    && isset($_POST['Num_Camiseta'])
                    && isset($_POST['Equipo'])
                    && isset($_POST['Imagen'])
                ) {
                    $DNI_Jugador = $_POST['DNI_Jugador'];
                    $Nombre_Jugador = $_POST['Nombre_Jugador'];
                    $Apellidos_Jugador = $_POST['Apellidos_Jugador'];
                    $Alias = $_POST['Alias'];
                    $Posicion = $_POST['Posicion'];
                    $Valor_Mercado = $_POST['Valor_Mercado'];
                    $Num_Camiseta = $_POST['Num_Camiseta'];
                    $Equipo = rawurldecode($_POST['Equipo']);
                    $Imagen = $_POST['Imagen'];
                    
                    $jugador = new Jugador();

                    $jugador->setDNI_Jugador($DNI_Jugador);
                    $jugador->setNombre_Jugador($Nombre_Jugador);
                    $jugador->setApellidos_Jugador($Apellidos_Jugador);
                    $jugador->setAlias($Alias);
                    $jugador->setPosicion($Posicion);
                    $jugador->setValor_Mercado($Valor_Mercado);
                    $jugador->setNum_Camiseta($Num_Camiseta);
                    $jugador->setNombre_Equipo($Equipo);
                    $jugador->setImagen($Imagen);
                    echo $jugador->insertarJugador();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->obtenerListadoEquipos();

                ?>
                <form id="insertarJugadorForm" action="insertarJugador.php" method="post">
                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" class="form-control" name="DNI_Jugador" required>
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="Nombre_Jugador" required>
                    </div>

                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="Apellidos_Jugador" required>
                    </div>

                    <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" name="Alias" required>
                    </div>

                    <div class="form-group">
                        <label>Posición</label>
                        <br>
                        <select class="custom-select" name="Posicion" required>
                            <option value="Portero">Portero</option>
                            <option value="Defensa">Defensa</option>
                            <option value="Centrocampista">Centrocampista</option>
                            <option value="Delantero">Delantero</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Valor de mercado</label>
                        <input type="number" class="form-control" name="Valor_Mercado" required>
                    </div>

                    <div class="form-group">
                        <label>Dorsal</label>
                        <input type="number" class="form-control" name="Num_Camiseta" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Equipo</label>
                        <br>
                        <select class ="form-control" name="Equipo" required>
                            <?php
                            foreach ($listadoEquipos as $equipo){
                                echo "<option value=" . rawurlencode($equipo->getNombre_Equipo()) . ">" . $equipo->getNombre_Equipo() . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="text" class="form-control" name="Imagen" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Añadir jugador</button>
                </form>
                <br>
                <a href="indexJugadores.php"><button>Volver al listado de jugadores</button></a>
            </div>
        </div>
        <div class="footer">
            <h3>© 2022 Real Federación Española de Fútbol</h3>
            Todos los derechos protegidos<br>
            <br>
        </div>
    </body>
</html>