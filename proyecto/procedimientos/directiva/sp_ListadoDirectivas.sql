DELIMITER //

CREATE PROCEDURE sp_ListadoDirectivas()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de directivas';
    END;

    BEGIN
        SELECT DISTINCT * FROM directiva ORDER BY Nombre_Presidente;
    END;
    
END //

DELIMITER ;