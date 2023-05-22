DELIMITER //

CREATE PROCEDURE sp_ObtenerEstadioEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el estadio de este equipo' AS mensaje;
    END;

    SELECT estadio.* FROM estadio WHERE Nombre_Equipo = var_Nombre;
END //

DELIMITER ;