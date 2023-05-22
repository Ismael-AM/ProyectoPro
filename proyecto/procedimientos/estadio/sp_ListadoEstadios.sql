DELIMITER //

CREATE PROCEDURE sp_ListadoEstadios()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de estadios';
    END;

    BEGIN
        SELECT DISTINCT * FROM estadio ORDER BY Nombre_Estadio;
    END;
    
END //

DELIMITER ;