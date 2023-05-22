DELIMITER //

CREATE PROCEDURE sp_InsertarEstadio(
    IN var_Nombre_Estadio VARCHAR(255),
    IN var_Ubicacion VARCHAR(255),
    IN var_Capacidad INT,
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al añadir el estadio';
        ROLLBACK;
    END;

    START TRANSACTION;

    BEGIN
        INSERT INTO estadio (Nombre_Estadio, Ubicacion, Capacidad, Nombre_Equipo)
        VALUES (var_Nombre_Estadio, var_Ubicacion, var_Capacidad, var_Nombre_Equipo);

        IF ROW_COUNT() > 0 THEN
            SELECT 'Estadio añadido correctamente';
            COMMIT;
        ELSE
            SELECT 'Ocurrió un error inesperado al añadir el estadio';
            ROLLBACK;
        END IF;
    END;
    
END //

DELIMITER ;