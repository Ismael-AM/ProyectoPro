DELIMITER //

CREATE PROCEDURE sp_InsertarDirectiva(
    IN var_DNI_Presidente VARCHAR(255),
    IN var_Nombre_Presidente VARCHAR(255),
    IN var_Apellidos_Presidente VARCHAR(255),
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    DECLARE dniExistente INT DEFAULT 0;
    DECLARE mensaje VARCHAR(255);
    
    SELECT COUNT(*) INTO dniExistente FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;
    
    IF dniExistente >= 1 THEN
        SET mensaje = 'Ya existe un presidente en la base de datos con el DNI especificado.';
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "Ya existe un presidente en la base de datos con el DNI especificado.";
    ELSE
        BEGIN
            DECLARE CONTINUE HANDLER FOR 1062
            BEGIN
                SELECT 'Error: Ya existe un presidente en la base de datos con el DNI especificado.' AS mensaje;
            END;
            START TRANSACTION;

            IF NOT var_DNI_Presidente REGEXP '^[0-9]{8}[A-Za-z]$' THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = "DNI no válido";
                SET mensaje = 'Error: El DNI no es válido. Debe contener 8 números iniciales y una letra final';
                ROLLBACK;
            ELSE
                INSERT INTO directiva (DNI_Presidente, Nombre_Presidente, Apellidos_Presidente, Nombre_Equipo)
                VALUES (var_DNI_Presidente, var_Nombre_Presidente, var_Apellidos_Presidente, var_Nombre_Equipo);

                COMMIT;
                SET mensaje = 'Directiva añadida correctamente';
            END IF;
        END;
    END IF;

    SELECT mensaje;
END //

DELIMITER ;