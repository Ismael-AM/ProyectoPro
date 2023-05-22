<!DOCTYPE html>
<html>

<?php
include "componentes/head.php";
require "modelo/directiva.php";
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

                if (isset($_GET['dni']) && !empty($_GET['dni'])) {
                    $dni = $_GET['dni'];
                    $directivas = new Directiva();
                    $directivas->setDNI_Presidente($dni);
                    $directiva = $directivas->obtenerDirectiva();             
                }

                if (
                    isset($_POST['DNI_Presidente'])
                    && isset($_POST['Nombre_Presidente'])
                    && isset($_POST['Apellidos_Presidente'])
                    && isset($_POST['Nombre_Equipo'])
                ) {
                    $DNI_Presidente = ($_POST['DNI_Presidente']);
                    $Nombre_Presidente = $_POST['Nombre_Presidente'];
                    $Apellidos_Presidente = $_POST['Apellidos_Presidente'];
                    $Nombre_Equipo = rawurldecode($_POST['Nombre_Equipo']);

                    $directiva = new Directiva();
                    
                    $directiva->setDNI_Presidente($DNI_Presidente);
                    $directiva->setNombre_Presidente($Nombre_Presidente);
                    $directiva->setApellidos_Presidente($Apellidos_Presidente);
                    $directiva->setNombre_Equipo($Nombre_Equipo);

                    echo $directiva->actualizarDirectiva();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->EquiposSinDirectiva2($directiva ? $directiva->getNombre_Equipo() : null);

                ?>
                <div class="container-fluid">
                    <form id="editarDirectivaForm" action="editarDirectiva.php" method="post">

                        <div class="form-group">
                            <label>DNI presidente</label>
                            <input type="text" class="form-control" name="DNI_Presidente" value="<?php echo $directiva->getDNI_Presidente(); ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nombre presidente</label>
                            <input type="text" class="form-control" name="Nombre_Presidente" value="<?php echo $directiva->getNombre_Presidente(); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Apellidos presidente</label>
                            <input type="text" class="form-control" name="Apellidos_Presidente" value="<?php echo $directiva->getApellidos_Presidente(); ?>" required>
                        </div>

                        <?php
                        echo "<div class='form-group'>";
                        echo "<label>Equipo</label><br>";
                        echo "<select class='form-control' name='Nombre_Equipo' required>";

                        foreach($listadoEquipos as $equipo){
                            echo "<option value=" . rawurlencode($equipo->getNombre_Equipo());
                            if(isset($directiva) && $equipo->getNombre_Equipo() == $directiva->getNombre_Equipo()){
                                echo " selected='selected'";
                            }
                            echo ">" . $equipo->getNombre_Equipo() . "</option>";
                        }
                        echo "</select>";
                        echo "</div>"
                    ?>

                        <button type="submit" class="btn btn-primary">Editar directiva</button>
                    </form>
                    <br>
                    <a href="indexDirectivas.php"><button>Volver al listado</button></a>
                </div>
            </div>
    </body>
</html>