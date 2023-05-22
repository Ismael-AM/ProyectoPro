DELIMITER //

CREATE PROCEDURE sp_ListadoJugadores()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de jugadores' AS mensaje;
    END;

    SELECT DISTINCT DNI_Jugador, Nombre_Jugador, Apellidos_Jugador, Alias, Posicion, Valor_Mercado, Num_Camiseta, Nombre_Equipo, Imagen
    FROM jugador
    ORDER BY FIELD(Posicion, 'Portero', 'Defensa', 'Centrocampista', 'Delantero'), Nombre_Jugador;
END //

DELIMITER ;