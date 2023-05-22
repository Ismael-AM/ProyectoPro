DELIMITER //

CREATE PROCEDURE sp_ActualizarJugador(
    IN var_DNI_Jugador VARCHAR(9),
    IN var_Nombre_Jugador VARCHAR(255),
    IN var_Apellidos_Jugador VARCHAR(255),
    IN var_Alias VARCHAR(255),
    IN var_Posicion VARCHAR(255),
    IN var_Valor_Mercado INT,
    IN var_Num_Camiseta INT(2),
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Imagen VARCHAR(255)
)
BEGIN
    BEGIN
        UPDATE jugador
        SET Nombre_Jugador = var_Nombre_Jugador,
            Apellidos_Jugador = var_Apellidos_Jugador,
            Alias = var_Alias,
            Posicion = var_Posicion,
            Valor_Mercado = var_Valor_Mercado,
            Num_Camiseta = var_Num_Camiseta,
            Nombre_Equipo = var_Nombre_Equipo,
            Imagen = var_Imagen
        WHERE DNI_Jugador = var_DNI_Jugador;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Se actualizaron correctamente los datos del jugador';
        ELSE
            SELECT 'Ocurrió un error inesperado al actualizar el jugador';
        END IF;
    END;
    
END //

DELIMITER ;