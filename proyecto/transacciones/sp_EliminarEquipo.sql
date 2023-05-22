DELIMITER //

CREATE PROCEDURE sp_EliminarEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE jugadoresEquipo INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al eliminar el equipo' AS mensaje;
    END;

    START TRANSACTION;
    
    SELECT COUNT(*) INTO jugadoresEquipo FROM equipo WHERE Nombre_Equipo = var_Nombre;

    IF jugadoresEquipo > 0 THEN
        
        UPDATE jugador SET Nombre_Equipo = NULL WHERE Nombre_Equipo = var_Nombre;

        UPDATE estadio SET Nombre_Equipo = NULL WHERE Nombre_Equipo = var_Nombre;

        DELETE FROM equipo WHERE Nombre_Equipo = var_Nombre;

        IF ROW_COUNT() > 0 THEN
            COMMIT;
            SELECT 'Equipo eliminado correctamente' AS mensaje;
        ELSE
            ROLLBACK;
            SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
        END IF;
    ELSE
        ROLLBACK;
        SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
    END IF;
END //

DELIMITER ;