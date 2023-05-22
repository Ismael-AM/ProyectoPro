<?php

require_once "bd.php";

class Estadio
{
    private $db;
    private $Nombre_Estadio;
    private $Ubicacion;
    private $Capacidad;
    private $Nombre_Equipo;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoEstadios()
    {
        try {

            $querySelect = "CALL sp_ListadoEstadios";
            $listaEstadios = $this->db->prepare($querySelect);
            
            $listaEstadios->execute();

            if ($listaEstadios) {
                return $listaEstadios->fetchAll(PDO::FETCH_CLASS, "Estadio");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de estadios";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarEstadio()
    {
        try {
            $queryInsertar = "CALL sp_InsertarEstadio(:Nombre_Estadio, :Ubicacion, :Capacidad, :Nombre_Equipo)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":Nombre_Estadio", $this->Nombre_Estadio);
            $instanciaDB->bindParam(":Ubicacion", $this->Ubicacion);
            $instanciaDB->bindParam(":Capacidad", $this->Capacidad);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);

            $respuestaInsertar = $instanciaDB->execute();

            if ($respuestaInsertar) {
                echo "Estadio añadido correctamente";
                header("Location:indexEstadios.php");
            } else {
                echo "Ocurrió un error inesperado al añadir el estadio";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function eliminarEstadio()
    {
        try {
            $queryBorrar = "CALL sp_EliminarEstadio(:Nombre_Estadio)";
            $instanciaDB = $this->db->prepare($queryBorrar);

            $instanciaDB->bindParam(":Nombre_Estadio", $this->Nombre_Estadio);

            $respuestaBorrar = $instanciaDB->execute();

            if ($respuestaBorrar) {
                echo "Equipo eliminado correctamente";
                header("Location:indexEstadios.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar el estadio";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerEstadio()
    {
        try {
            $querySelect = "CALL sp_ObtenerEstadio(:Nombre_Estadio)";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":Nombre_Estadio", $this->Nombre_Estadio);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Estadio")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar el estadio seleccionado";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarEstadio()
    {
        try {
            $queryUpdate = "CALL sp_ActualizarEstadio(:Nombre_Estadio, :Ubicacion, :Capacidad, :Nombre_Equipo, @result)";
    
            $instanciaDB = $this->db->prepare($queryUpdate);
    
            $instanciaDB->bindParam(":Nombre_Estadio", $this->Nombre_Estadio);
            $instanciaDB->bindParam(":Ubicacion", $this->Ubicacion);
            $instanciaDB->bindParam(":Capacidad", $this->Capacidad);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);
    
            $instanciaDB->execute();
    
            $result = $this->db->query("SELECT @result")->fetchColumn();
    
            if ($result === 'Se actualizaron correctamente los datos del estadio') {
                echo $result;
                header("Location:indexEstadios.php");
            } else {
                echo $result;
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    public function getNombre_Estadio()
    {
        return $this->Nombre_Estadio;
    }

    public function getUbicacion()
    {
        return $this->Ubicacion;
    }

    public function getCapacidad()
    {
        return $this->Capacidad;
    }

    public function getNombre_Equipo()
    {
        return $this->Nombre_Equipo;
    }

    public function setNombre_Estadio($estadio): self
    {
        $this->Nombre_Estadio = $estadio;
        return $this;
    }

    public function setUbicacion($ubicacion): self
    {
        $this->Ubicacion = $ubicacion;
        return $this;
    }

    public function setCapacidad($capacidad): self
    {
        $this->Capacidad = $capacidad;
        return $this;
    }

    public function setNombre_Equipo($equipo): self
    {
        $this->Nombre_Equipo = $equipo;
        return $this;
    }
}