DELIMITER //

CREATE PROCEDURE sp_ObtenerJugador(IN var_DNI_Jugador VARCHAR(9))
BEGIN
    IF NOT var_DNI_Jugador REGEXP '^[0-9]{8}[A-Za-z]$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "DNI no válido";
    END IF;

    IF var_DNI_Jugador NOT IN (SELECT DNI_JUGADOR FROM jugador WHERE DNI_Jugador = var_DNI_Jugador) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "No se ha encontrado ningún jugador con ese DNI";
    END IF;
    
    SELECT * FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;
END //

DELIMITER ;