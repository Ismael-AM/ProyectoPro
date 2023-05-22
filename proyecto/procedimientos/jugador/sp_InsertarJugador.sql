DELIMITER //

CREATE PROCEDURE sp_InsertarJugador(
    IN var_DNI_Jugador VARCHAR(9),
    IN var_Nombre_Jugador VARCHAR(255),
    IN var_Apellidos_Jugador VARCHAR(255),
    IN var_Alias VARCHAR(255),
    IN var_Posicion VARCHAR(255),
    IN var_Valor_Mercado INT(9),
    IN var_Num_Camiseta INT(2),
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Imagen VARCHAR(255),
    OUT var_Mensaje VARCHAR(255)
)
BEGIN
    DECLARE dniExistente INT DEFAULT 0;
    
    SELECT COUNT(*) INTO dniExistente FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;
    
    IF dniExistente >= 1 THEN
        SET var_Mensaje = 'Error: Ya existe un jugador con el DNI especificado en la base de datos.';
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "Error: Ya existe un jugador con el DNI especificado en la base de datos.";
    ELSE
        BEGIN
            DECLARE CONTINUE HANDLER FOR 1062
            BEGIN
                SELECT 'Error: Ya existe un jugador con el DNI especificado en la base de datos.' AS mensaje;
            END;
            START TRANSACTION;

            IF NOT var_DNI_Jugador REGEXP '^[0-9]{8}[A-Za-z]$' THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = "DNI no válido";
                SET var_Mensaje = 'Error: El DNI no es válido. Debe contener 8 números iniciales y una letra final';
                ROLLBACK;
            ELSE
                INSERT INTO jugador (
                    DNI_Jugador,
                    Nombre_Jugador,
                    Apellidos_Jugador,
                    Alias,
                    Posicion,
                    Valor_Mercado,
                    Num_Camiseta,
                    Nombre_Equipo,
                    Imagen
                )
                VALUES (
                    var_DNI_Jugador,
                    var_Nombre_Jugador,
                    var_Apellidos_Jugador,
                    var_Alias,
                    var_Posicion,
                    var_Valor_Mercado,
                    var_Num_Camiseta,
                    var_Nombre_Equipo,
                    var_Imagen
                );
                
                COMMIT;
                SET var_Mensaje = 'Jugador añadido correctamente';
            END IF;
        END;
    END IF;
END //

DELIMITER ;