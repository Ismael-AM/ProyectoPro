DELIMITER //

CREATE PROCEDURE sp_ObtenerEstadio(
    IN var_Nombre_Estadio VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recuperar el estadio seleccionado';
    END;

    BEGIN
        SELECT * FROM estadio WHERE Nombre_Estadio = var_Nombre_Estadio;
    END;
    
END //

DELIMITER ;