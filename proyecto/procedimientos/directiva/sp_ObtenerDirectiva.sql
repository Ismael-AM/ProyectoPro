DELIMITER //

CREATE PROCEDURE sp_ObtenerDirectiva(
    IN var_DNI_Presidente VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recuperar la directiva seleccionada';
    END;

    BEGIN
        SELECT * FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;
    END;
    
END //

DELIMITER ;