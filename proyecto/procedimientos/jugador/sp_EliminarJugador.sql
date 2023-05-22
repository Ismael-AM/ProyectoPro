DELIMITER //

CREATE PROCEDURE sp_EliminarJugador(IN var_DNI_Jugador VARCHAR(9))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar el jugador' AS mensaje;
    END;

    DELETE FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;

    IF ROW_COUNT() > 0 THEN
        SELECT 'Jugador eliminado correctamente' AS mensaje;
    ELSE
        SELECT 'El jugador no existe' AS mensaje;
    END IF;
END //

DELIMITER ;