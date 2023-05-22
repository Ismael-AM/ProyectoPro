CREATE PROCEDURE sp_ActualizarEquipo(
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Abreviatura VARCHAR(255),
    IN var_Escudo VARCHAR(255),
    IN var_Palmares VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al actualizar los datos del equipo' AS mensaje;
    END;

    START TRANSACTION;

    UPDATE equipo SET
        Nombre_Equipo = var_Nombre_Equipo,
        Abreviatura = var_Abreviatura,
        Escudo = var_Escudo,
        Palmares = var_Palmares
    WHERE
        Nombre_Equipo = var_Nombre_Equipo;

    IF ROW_COUNT() > 0 THEN
        COMMIT;
        SELECT 'Se actualizaron correctamente los datos del equipo' AS mensaje;
    ELSE
        ROLLBACK;
        SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
    END IF;
END //

DELIMITER ;