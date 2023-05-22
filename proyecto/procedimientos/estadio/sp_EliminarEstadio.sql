DELIMITER //

CREATE PROCEDURE sp_EliminarEstadio(
    IN var_Nombre_Estadio VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar el estadio';
    END;

    BEGIN
        START TRANSACTION;

        DELETE FROM estadio WHERE Nombre_Estadio = var_Nombre_Estadio;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Estadio eliminado correctamente';
            COMMIT;
        ELSE
            SELECT 'Ocurrió un error inesperado al eliminar el estadio';
            ROLLBACK;
        END IF;
    END;
    
END //

DELIMITER ;
