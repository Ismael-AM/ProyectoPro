<?php

require_once "bd.php";

class Directiva
{
    private $db;
    private $DNI_Presidente;
    private $Nombre_Presidente;
    private $Apellidos_Presidente;
    private $Nombre_Equipo;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoDirectivas()
    {
        try {

            $querySelect = "CALL sp_ListadoDirectivas";
            $listaDirectivas = $this->db->prepare($querySelect);
            
            $listaDirectivas->execute();

            if ($listaDirectivas) {
                return $listaDirectivas->fetchAll(PDO::FETCH_CLASS, "Directiva");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de directivas";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarDirectiva()
    {
        try {

            $queryInsertar = "CALL sp_InsertarDirectiva(:DNI_Presidente, :Nombre_Presidente, :Apellidos_Presidente, :Nombre_Equipo)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":DNI_Presidente", $this->DNI_Presidente);
            $instanciaDB->bindParam(":Nombre_Presidente", $this->Nombre_Presidente);
            $instanciaDB->bindParam(":Apellidos_Presidente", $this->Apellidos_Presidente);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);

            $instanciaDB->execute();

            $data = $instanciaDB->fetch(PDO::FETCH_ASSOC);
            $mensaje = $data['mensaje'];    

            if ($mensaje === 'Jugador añadido correctamente') {
                echo $mensaje;
                header("Location:indexJugadores.php");
            } else {
                echo $mensaje;
            }
        } catch (PDOException $ex) {
            if ($ex->errorInfo[1] === 1062) {
                echo "Error: Ya existe un presidente con el DNI especificado en la base de datos.";
            } else {
                echo "Ocurrió un error: " . $ex->getMessage();
            }
            return null;
        }      
    }

    function eliminarDirectiva()
    {
        try {
            $queryBorrar = "CALL sp_EliminarDirectiva(:DNI_Presidente)";
            $instanciaDB = $this->db->prepare($queryBorrar);

            $instanciaDB->bindParam(":DNI_Presidente", $this->DNI_Presidente);

            $respuestaBorrar = $instanciaDB->execute();

            if ($respuestaBorrar) {
                echo "Directiva eliminada correctamente";
                header("Location:indexDirectivas.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar la directiva";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerDirectiva()
    {
        try {
            $querySelect = "CALL sp_ObtenerDirectiva(:DNI_Presidente)";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":DNI_Presidente", $this->DNI_Presidente);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Directiva")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar la directiva seleccionada";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarDirectiva()
    {
        try {
            $queryUpdate = "CALL sp_ActualizarDirectiva(:DNI_Presidente, :Nombre_Presidente, :Apellidos_Presidente, :Nombre_Equipo)";

            $instanciaDB = $this->db->prepare($queryUpdate);

            $instanciaDB->bindParam(":DNI_Presidente", $this->DNI_Presidente);
            $instanciaDB->bindParam(":Nombre_Presidente", $this->Nombre_Presidente);
            $instanciaDB->bindParam(":Apellidos_Presidente", $this->Apellidos_Presidente);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);

            $instanciaDB->execute();

            if ($instanciaDB) {
                echo "Se actualizaron correctamente los datos de la directiva";
                header("Location:indexDirectivas.php");
            } else {
                echo "Ocurrió un error inesperado al recuperar la directiva";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getDNI_Presidente()
    {
        return $this->DNI_Presidente;
    }

    /**
     * @return mixed
     */
    public function getNombre_Presidente()
    {
        return $this->Nombre_Presidente;
    }

    /**
     * @return mixed
     */
    public function getApellidos_Presidente()
    {
        return $this->Apellidos_Presidente;
    }

    /**
     * @return mixed
     */
    public function getNombre_Equipo()
    {
        return $this->Nombre_Equipo;
    }

    public function setDNI_Presidente($dni)
    {
        $this->DNI_Presidente = $dni;
        return $this;
    }

    public function setNombre_Presidente($nombre)
    {
        $this->Nombre_Presidente = $nombre;
        return $this;
    }

    public function setApellidos_Presidente($apellidos): self
    {
        $this->Apellidos_Presidente = $apellidos;
        return $this;
    }

    public function setNombre_Equipo($equipo)
    {
        $this->Nombre_Equipo = $equipo;
        return $this;
    }
}