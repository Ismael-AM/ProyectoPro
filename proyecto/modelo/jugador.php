<?php

require_once "bd.php";

class Jugador
{
    private $db;
    private $DNI_Jugador;
    private $Nombre_Jugador;
    private $Apellidos_Jugador;
    private $Alias;
    private $Posicion;
    private $Valor_Mercado;
    private $Num_Camiseta;
    private $Nombre_Equipo;
    private $Imagen;

    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

    function obtenerListadoJugadores()
    {
        try {

            $querySelect = "CALL sp_ListadoJugadores";
            $listaJugadores = $this->db->prepare($querySelect);
            
            $listaJugadores->execute();

            if ($listaJugadores) {
                return $listaJugadores->fetchAll(PDO::FETCH_CLASS, "Jugador");
            } else {
                echo "Ocurrió un error inesperado al obtener el listado de jugadores";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function insertarJugador()
    {
        try {
            $queryInsertar = "CALL sp_InsertarJugador(:DNI_Jugador, :Nombre_Jugador, :Apellidos_Jugador, :Alias, :Posicion, :Valor_Mercado, :Num_Camiseta, :Nombre_Equipo, :Imagen)";
            $instanciaDB = $this->db->prepare($queryInsertar);

            $instanciaDB->bindParam(":DNI_Jugador", $this->DNI_Jugador);
            $instanciaDB->bindParam(":Nombre_Jugador", $this->Nombre_Jugador);
            $instanciaDB->bindParam(":Apellidos_Jugador", $this->Apellidos_Jugador);
            $instanciaDB->bindParam(":Alias", $this->Alias);
            $instanciaDB->bindParam(":Posicion", $this->Posicion);
            $instanciaDB->bindParam(":Valor_Mercado", $this->Valor_Mercado);
            $instanciaDB->bindParam(":Num_Camiseta", $this->Num_Camiseta);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);
            $instanciaDB->bindParam(":Imagen", $this->Imagen);

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
                echo "Error: Ya existe un jugador con el DNI especificado en la base de datos.";
            } else {
                echo "Ocurrió un error: " . $ex->getMessage();
            }
            return null;
        }        
    }

    function eliminarJugador()
    {
        try {
            $queryBorrar = "CALL sp_EliminarJugador(:DNI_Jugador)";
            $instanciaDB = $this->db->prepare($queryBorrar);

            $instanciaDB->bindParam(":DNI_Jugador", $this->DNI_Jugador);

            $respuestaBorrar = $instanciaDB->execute();

            if ($respuestaBorrar) {
                echo "Jugador eliminado correctamente";
                header("Location:indexjugadores.php");
            } else {
                echo "Ocurrió un error inesperado al eliminar el jugador";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function obtenerJugador()
    {
        try {
            $querySelect = "CALL sp_ObtenerJugador(:DNI_Jugador)";
            
            $instanciaDB = $this->db->prepare($querySelect);

            $instanciaDB->bindParam(":DNI_Jugador", $this->DNI_Jugador);

            $instanciaDB->execute();

            if ($instanciaDB) {
                return $instanciaDB->fetchAll(PDO::FETCH_CLASS, "Jugador")[0];
            } else {
                echo "Ocurrió un error inesperado al recuperar el jugador seleccionado";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarJugador()
    {
        try {
            $queryUpdate = "CALL sp_ActualizarJugador(:DNI_Jugador, :Nombre_Jugador, :Apellidos_Jugador, :Alias, :Posicion, :Valor_Mercado, :Num_Camiseta, :Nombre_Equipo, :Imagen)";

            $instanciaDB = $this->db->prepare($queryUpdate);

            $instanciaDB->bindParam(":DNI_Jugador", $this->DNI_Jugador);
            $instanciaDB->bindParam(":Nombre_Jugador", $this->Nombre_Jugador);
            $instanciaDB->bindParam(":Apellidos_Jugador", $this->Apellidos_Jugador);
            $instanciaDB->bindParam(":Alias", $this->Alias);
            $instanciaDB->bindParam(":Posicion", $this->Posicion);
            $instanciaDB->bindParam(":Valor_Mercado", $this->Valor_Mercado);
            $instanciaDB->bindParam(":Num_Camiseta", $this->Num_Camiseta);
            $instanciaDB->bindParam(":Nombre_Equipo", $this->Nombre_Equipo);
            $instanciaDB->bindParam(":Imagen", $this->Imagen);

            $instanciaDB->execute();

            if ($instanciaDB) {
                echo "Se actualizaron correctamente los datos del jugador";
                header("Location:indexJugadores.php");
            } else {
                echo "Ocurrió un error inesperado al recuperar el jugador";
            }
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getDNI_Jugador()
    {
        return $this->DNI_Jugador;
    }

    /**
     * @return mixed
     */
    public function getNombre_Jugador()
    {
        return $this->Nombre_Jugador;
    }

    /**
     * @return mixed
     */
    public function getApellidos_Jugador()
    {
        return $this->Apellidos_Jugador;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->Alias;
    }

    /**
     * @return mixed
     */
    public function getPosicion()
    {
        return $this->Posicion;
    }

    /**
     * @return mixed
     */
    public function getValor_Mercado()
    {
        return $this->Valor_Mercado;
    }

    public function getNum_Camiseta()
    {
        return $this->Num_Camiseta;
    }

    public function getNombre_Equipo()
    {
        return $this->Nombre_Equipo;
    }

    public function getImagen()
    {
        return $this->Imagen;
    }

    public function setDNI_Jugador($dni)
    {
        $this->DNI_Jugador = $dni;
        return $this;
    }

    public function setNombre_Jugador($nombre)
    {
        $this->Nombre_Jugador = $nombre;
        return $this;
    }

    public function setApellidos_Jugador($apellidos): self
    {
        $this->Apellidos_Jugador = $apellidos;
        return $this;
    }

    public function setAlias($alias): self
    {
        $this->Alias = $alias;
        return $this;
    }

    public function setPosicion($posicion): self
    {
        $this->Posicion = $posicion;
        return $this;
    }

    public function setValor_Mercado($Valor_Mercado): self
    {
        $this->Valor_Mercado = $Valor_Mercado;
        return $this;
    }
    
    public function setNum_Camiseta($dorsal): self
    {
        $this->Num_Camiseta = $dorsal;
        return $this;
    }
    public function setNombre_Equipo($equipo): self
    {
        $this->Nombre_Equipo = $equipo;
        return $this;
    }
    public function setImagen($imagen): self
    {
        $this->Imagen = $imagen;
        return $this;
    }
}