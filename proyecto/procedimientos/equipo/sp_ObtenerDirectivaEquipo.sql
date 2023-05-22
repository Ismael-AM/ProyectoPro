DELIMITER //

CREATE PROCEDURE sp_ObtenerDirectivaEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener la directiva de este equipo' AS mensaje;
    END;

    SELECT directiva.* FROM directiva WHERE Nombre_Equipo = var_Nombre;
END //

DELIMITER ;