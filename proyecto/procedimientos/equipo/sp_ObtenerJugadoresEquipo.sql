DELIMITER //

CREATE PROCEDURE sp_ObtenerJugadoresEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de jugadores de este equipo' AS mensaje;
    END;

    SELECT jugador.* FROM jugador
    INNER JOIN equipo ON jugador.Nombre_Equipo = equipo.Nombre_Equipo
    WHERE equipo.Nombre_Equipo = var_Nombre
    ORDER BY FIELD(jugador.Posicion, 'Portero', 'Defensa','Centrocampista','Delantero'),jugador.Num_Camiseta;
END //

DELIMITER ;