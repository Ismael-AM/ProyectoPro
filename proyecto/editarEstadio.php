<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require "modelo/estadio.php";
require "modelo/equipo.php";

?>

<head>
    <title>Editar datos - RFEF </title>
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
                    <h2><b>Editar datos</b></h2>
                </div>

                <?php

                if (isset($_GET['estadio']) && !empty($_GET['estadio'])) {
                    $est = $_GET['estadio'];
                    $estadios = new Estadio();
                    $estadios->setNombre_Estadio($est);
                    $estadio = $estadios->obtenerEstadio();             
                }

                if (
                    isset($_POST['Nombre_Estadio'])
                    && isset($_POST['Ubicacion'])
                    && isset($_POST['Capacidad'])
                    && isset($_POST['Nombre_Equipo'])
                ) {
                    $Nombre_Estadio = ($_POST['Nombre_Estadio']);
                    $Ubicacion = $_POST['Ubicacion'];
                    $Capacidad = $_POST['Capacidad'];
                    $Nombre_Equipo = rawurldecode($_POST['Nombre_Equipo']);

                    $estadio = new Estadio();
                    
                    $estadio->setNombre_Estadio($Nombre_Estadio);
                    $estadio->setUbicacion($Ubicacion);
                    $estadio->setCapacidad($Capacidad);
                    $estadio->setNombre_Equipo($Nombre_Equipo);

                    echo $estadio->actualizarEstadio();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->EquiposSinEstadio2($estadio ? $estadio->getNombre_Equipo() : null);

                ?>
                <div class="container-fluid">
                    <form id="editarEstadioForm" action="editarEstadio.php" method="post">
                        <div class="form-group">
                            <label>Nombre<?php foreach($listadoEquipos as $equipo){ $estadio->getNombre_Equipo();}?></label>
                            <input type="text" class="form-control" name="Nombre_Estadio" value="<?php echo $estadio->getNombre_Estadio(); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Ubicacion</label>
                            <input type="text" class="form-control" name="Ubicacion" value="<?php echo $estadio->getUbicacion(); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Capacidad</label>
                            <input type="number" class="form-control" name="Capacidad" value="<?php echo $estadio->getCapacidad(); ?>" required>
                        </div>

                        <?php
                        echo "<div class='form-group'>";
                        echo "<label>Equipo</label><br>";
                        if (count($listadoEquipos) > 0) { 
                            echo "<select class='form-control' name='Nombre_Equipo' required>";
                            foreach($listadoEquipos as $equipo){
                                echo "<option value=" . rawurlencode($equipo->getNombre_Equipo());
                            if(isset($estadio) && $equipo->getNombre_Equipo() == $estadio->getNombre_Equipo()){
                                echo " selected='selected'";
                            }
                                echo ">" . $equipo->getNombre_Equipo() . "</option>";
                            }
                            echo "</select>";
                            echo "<button type='submit' class='btn btn-primary'>Editar estadio</button>";
                        }else{
                            echo "<p>No hay equipos sin estadio.</p>";
                        }
                        echo "</div>"
                    ?>

                    </form>
                    <a href="indexEstadios.php"><button>Volver al listado</button></a>
                </div>
            </div>
    </body>
</html>