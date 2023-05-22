<?php

require_once "bd.php";
require_once "modelo/jugador.php";
require_once "modelo/equipo.php";

class Equipo
{
    private $db;
    private $Nombre_Equipo;
    private $Abreviatura;
    private $Escudo;
    private $Palmares;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoEquipos()
    {
        try {

            $querySelect = "CALL sp_ListadoEquipos";
            $listaEquipos = $this->db->prepare($querySelect);
            
            $listaEquipos->execute();

            if ($listaEquipos) {
                return $listaEquipos->fetchAll(PDO::FETCH_CLASS, "Equipo");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de equipos";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarEquipo()
    {
        try {
            $queryInsertar = "CALL sp_InsertarEquipo(:Nombre_Equipo, :Abreviatura, :Escudo, :Palmares)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);
            $instanciaDB->bindParam(":Abreviatura", $this->Abreviatura);
            $instanciaDB->bindParam(":Escudo", $this->Escudo);
            $instanciaDB->bindParam(":Palmares", $this->Palmares);

            $respuestaInsertar = $instanciaDB->execute();

            if ($respuestaInsertar) {
                echo "Equipo añadido correctamente";
                header("Location:indexEquipos.php");
            } else {
                echo "Ocurrió un error inesperado al añadir el equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    function eliminarEquipo()
    {
        try {
            $queryBorrar = "CALL sp_EliminarEquipo(:Nombre)";
            $instanciaDB = $this->db->prepare($queryBorrar);

            $instanciaDB->bindParam(":Nombre", $this->Nombre_Equipo);

            $respuestaBorrar = $instanciaDB->execute();

            if ($respuestaBorrar) {
                echo "Equipo eliminado correctamente";
                header("Location:indexEquipos.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar el equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerEquipo()
    {
        try {
            $querySelect = "CALL sp_ObtenerEquipo(:Nombre)";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":Nombre", $this->Nombre_Equipo);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Equipo")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar el equipo seleccionado";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarEquipo()
    {
        try {
            $queryUpdate = "CALL sp_ActualizarEquipo(:Nombre_Equipo, :Abreviatura, :Escudo, :Palmares)";

            $instanciaDB = $this->db->prepare($queryUpdate);

            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);
            $instanciaDB->bindParam(":Abreviatura", $this->Abreviatura);
            $instanciaDB->bindParam(":Escudo", $this->Escudo);
            $instanciaDB->bindParam(":Palmares", $this->Palmares);

            $instanciaDB->execute();

            if ($instanciaDB) {
                echo "Se actualizaron correctamente los datos del equipo";
                header("Location:indexEquipos.php");
            } else {
                echo "Ocurrió un error inesperado al recuperar los datos del equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function getNumeroJugadores($equipo)
    {
        $queryContar = "CALL cursor_Contar_Jugadores(:Nombre_Equipo)";
        $instanciaDB = $this->db->prepare($queryContar);
        
        $instanciaDB->bindParam(":Nombre_Equipo", $equipo);

        $instanciaDB->execute();

        $data = $instanciaDB->fetch(PDO::FETCH_ASSOC);
        $cantidad = $data['total_jugadores'];

        if($instanciaDB){
            return $cantidad;
        } else {
            echo "Ocurrió un error inesperado al recoger el nº de jugadores";
        }
        return null;
    }

    function obtenerJugadoresEquipo($equipo)
    {
        try {
            
            $querySelect = "CALL sp_ObtenerJugadoresEquipo(:Nombre)";
            $listaJugadoresEquipo = $this->db->prepare($querySelect);

            $listaJugadoresEquipo->bindParam(":Nombre", $equipo);

            $listaJugadoresEquipo->execute();

            if ($listaJugadoresEquipo) {
                return $listaJugadoresEquipo->fetchAll(PDO::FETCH_CLASS, "Jugador");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de jugadores de este equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerEstadioEquipo($equipo)
    {
        try {
            $querySelect = "CALL sp_ObtenerEstadioEquipo(:Nombre)";
            $EstadioEquipo = $this->db->prepare($querySelect);
    
            $EstadioEquipo->bindParam(":Nombre", $equipo);
    
            $EstadioEquipo->execute();
    
            if ($EstadioEquipo) {
                $resultado = $EstadioEquipo->fetchAll(PDO::FETCH_CLASS, "Estadio");
                if (isset($resultado[0])) {
                    return $resultado[0];
                } else {
                }
            } else {
                echo "Ocurrió un error inesperado al obtener el estadio de este equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function EquiposSinEstadio()
    {
        try {

            $querySelect = "CALL sp_EquiposSinEstadio";
            $listaEquipos = $this->db->prepare($querySelect);
            
            $listaEquipos->execute();

            if ($listaEquipos) {
                return $listaEquipos->fetchAll(PDO::FETCH_CLASS, "Equipo");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de equipos sin estadio";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function EquiposSinEstadio2($equipo)
    {
        try {

            $querySelect = "CALL sp_EquiposSinEstadio2(:Nombre)";
            $listaEquipos = $this->db->prepare($querySelect);

            $listaEquipos->bindParam(":Nombre", $equipo);
            
            $listaEquipos->execute();

            if ($listaEquipos) {
                return $listaEquipos->fetchAll(PDO::FETCH_CLASS, "Equipo");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de equipos sin estadio";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerDirectivaEquipo($equipo)
    {
        try {
            
            $querySelect = "CALL sp_ObtenerDirectivaEquipo(:Nombre)";
            $DirectivaEquipo = $this->db->prepare($querySelect);

            $DirectivaEquipo->bindParam(":Nombre", $equipo);

            $DirectivaEquipo->execute();

            if ($DirectivaEquipo) {
                $resultado = $DirectivaEquipo->fetchAll(PDO::FETCH_CLASS, "Directiva");
                if (isset($resultado[0])) {
                    return $resultado[0];
                } else {
                }
            } else {
                echo "Ocurrió un error inesperado al obtener la directiva de este equipo";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function EquiposSinDirectiva()
    {
        try {

            $querySelect = "CALL sp_EquiposSinDirectiva";
            $listaEquipos = $this->db->prepare($querySelect);
            
            $listaEquipos->execute();

            if ($listaEquipos) {
                return $listaEquipos->fetchAll(PDO::FETCH_CLASS, "Equipo");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de equipos sin directiva";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function EquiposSinDirectiva2($equipo)
    {
        try {

            $querySelect = "CALL sp_EquiposSinDirectiva2(:Nombre)";
            $listaEquipos = $this->db->prepare($querySelect);

            $listaEquipos->bindParam(":Nombre", $equipo);
            
            $listaEquipos->execute();

            if ($listaEquipos) {
                return $listaEquipos->fetchAll(PDO::FETCH_CLASS, "Equipo");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de equipos sin directiva";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    public function getNombre_Equipo()
    {
        return $this->Nombre_Equipo;
    }

    public function getAbreviatura()
    {
        return $this->Abreviatura;
    }

    public function getEscudo()
    {
        return $this->Escudo;
    }

    public function getPalmares()
    {
        return $this->Palmares;
    }

    public function setNombre_Equipo($nombre): self
    {
        $this->Nombre_Equipo = $nombre;
        return $this;
    }

    public function setAbreviatura($Abreviatura): self
    {
        $this->Abreviatura = $Abreviatura;
        return $this;
    }

    public function setEscudo($imagen): self
    {
        $this->Escudo = $imagen;
        return $this;
    }

    public function setPalmares($palmares): self
    {
        $this->Palmares = $palmares;
        return $this;
    }
}