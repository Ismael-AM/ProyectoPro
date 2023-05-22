<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require "modelo/jugador.php";
require "modelo/equipo.php";
?>

<head>
    <title>Editar datos jugador - RFEF</title>
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
                    <h2><b>Modificar datos jugador</b></h2>
                </div>

                <?php

                if (isset($_GET['dni']) && !empty($_GET['dni'])) {
                    $dni = $_GET['dni'];
                    $jugadores = new Jugador();
                    $jugadores->setDNI_Jugador($dni);
                    $jugador = $jugadores->obtenerJugador();             
                }

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

                    echo $jugador->actualizarJugador();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->obtenerListadoEquipos();

                ?>
                <div class="container-fluid">
                    <form id="editarJugadorForm" action="editarJugador.php" method="post">

                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" class="form-control" name="DNI_Jugador" value="<?php echo $jugador->getDNI_Jugador(); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="Nombre_Jugador" value="<?php echo $jugador->getNombre_Jugador(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" name="Apellidos_Jugador" value="<?php echo $jugador->getApellidos_Jugador(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control" name="Alias" value="<?php echo $jugador->getAlias(); ?>" required>
                    </div>

                    <?php
                        $posiciones = array("Portero", "Defensa", "Centrocampista", "Delantero");

                        echo "<div class='form-group'>";
                        echo "<label>Posición</label><br>";
                        echo "<select class='custom-select' name='Posicion' required>";

                        foreach($posiciones as $posicion){
                            echo "<option value=" . $posicion;
                            if(isset($jugador) && $posicion == $jugador->getPosicion()){
                                echo " selected='selected'";
                            }
                            echo ">" . $posicion . "</option>";
                        }
                        echo "</select>";
                        echo "</div>"
                    ?>

                    <div class="form-group">
                        <label>Valor de mercado</label>
                        <input type="number" class="form-control" name="Valor_Mercado" value="<?php echo $jugador->getValor_Mercado(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Dorsal</label>
                        <input type="number" class="form-control" name="Num_Camiseta" value="<?php echo $jugador->getNum_Camiseta(); ?>" required>
                    </div>

                    <?php
                        echo "<div class='form-group'>";
                        echo "<label>Equipo</label><br>";
                        echo "<select class='form-control' name='Equipo' required>";

                        foreach($listadoEquipos as $equipo){
                            echo "<option value=" . rawurlencode($equipo->getNombre_Equipo());
                            if(isset($jugador) && $equipo->getNombre_Equipo() == $jugador->getNombre_Equipo()){
                                echo " selected='selected'";
                            }
                            echo ">" . $equipo->getNombre_Equipo() . "</option>";
                        }
                        echo "</select>";
                        echo "</div>"
                    ?>

                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="text" class="form-control" name="Imagen" value="<?php echo $jugador->getImagen(); ?>">
                    </div>

                        <button type="submit" class="btn btn-primary">Editar jugador</button>
                    </form>
                    <br>
                    <a href="indexJugadores.php"><button>Volver al listado</button></a>
                </div>
            </div>
    </body>
</html>