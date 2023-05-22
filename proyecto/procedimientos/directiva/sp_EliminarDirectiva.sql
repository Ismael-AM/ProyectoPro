DELIMITER //

CREATE PROCEDURE sp_EliminarDirectiva(
    IN var_DNI_Presidente VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar la directiva';
    END;

    BEGIN
        DELETE FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Directiva eliminada correctamente';
        ELSE
            SELECT 'Ocurrió un error inesperado al eliminar la directiva';
        END IF;
    END;
    
END //

DELIMITER ;