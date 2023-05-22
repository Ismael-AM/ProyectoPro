DELIMITER //

CREATE PROCEDURE sp_InsertarEquipo(
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Abreviatura VARCHAR(255),
    IN var_Escudo VARCHAR(255),
    IN var_Palmares VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al añadir el equipo' AS ErrorMessage;
    END;

    START TRANSACTION;

    INSERT INTO equipo (Nombre_Equipo, Abreviatura, Escudo, Palmares)
    VALUES (var_Nombre_Equipo, var_Abreviatura, var_Escudo, var_Palmares);

    IF ROW_COUNT() > 0 THEN
        COMMIT;
        SELECT 'Equipo añadido correctamente' AS SuccessMessage;
    ELSE
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al añadir el equipo' AS ErrorMessage;
    END IF;
END //

DELIMITER ;