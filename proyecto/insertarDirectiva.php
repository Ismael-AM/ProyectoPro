<!DOCTYPE html>
<html>

<head>
<title>Añadir estadio - RFEF</title>
</head>

<?php
include "componentes/head.php";
require "modelo/directiva.php";
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
                    <h2><b>Añadir directiva</b></h2>
                </div>
                <br>

                <?php

                if (
                    isset($_POST['DNI_Presidente'])
                    && isset($_POST['Nombre_Presidente'])
                    && isset($_POST['Apellidos_Presidente'])
                    && isset($_POST['Nombre_Equipo'])
                ) {
                    $DNI_Presidente = $_POST['DNI_Presidente'];
                    $Nombre_Presidente = $_POST['Nombre_Presidente'];
                    $Apellidos_Presidente = $_POST['Apellidos_Presidente'];
                    $Nombre_Equipo = rawurldecode($_POST['Nombre_Equipo']);
                    
                    $directiva = new Directiva();
                        
                    $directiva->setDNI_Presidente($DNI_Presidente);
                    $directiva->setNombre_Presidente($Nombre_Presidente);
                    $directiva->setApellidos_Presidente($Apellidos_Presidente);
                    $directiva->setNombre_Equipo($Nombre_Equipo);

                    echo $directiva->insertarDirectiva();
                }

                $equipos = new Equipo();
                $listadoEquipos = $equipos->EquiposSinDirectiva();

                ?>
                    <div class="container-fluid">
                        <form id="insertarDirectivaForm" action="insertarDirectiva.php" method="post">

                            <div class="form-group">
                                <label>DNI presidente</label>
                                <input type="text" class="form-control" name="DNI_Presidente" required>
                            </div>

                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="Nombre_Presidente" required>
                            </div>

                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="int" class="form-control" name="Apellidos_Presidente" required>
                            </div>
                            
                            <?php
                            echo"<div class='form-group'>";
                            echo"    <label>Equipo</label>";
                                if (count($listadoEquipos) > 0) { 
                                    echo "<select class='form-control' name='Nombre_Equipo' required>";
                                        foreach ($listadoEquipos as $equipo) { 
                                            echo "<option value=" . rawurlencode($equipo->getNombre_Equipo()) . ">" . $equipo->getNombre_Equipo() . "</option>";
                                        } 
                                    echo "</select>";
                                    echo "<br><button type='submit' class='btn btn-primary'>Añadir directiva</button>";
                                } else {
                                    echo "<p>No hay equipos sin directiva.</p>";
                                }
                            echo "</div>";
                            ?>
                        </form>
                        <a href="indexDirectivas.php"><button>Volver al listado</button></a>
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