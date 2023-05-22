DELIMITER //

CREATE PROCEDURE sp_ObtenerEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recuperar el equipo seleccionado' AS mensaje;
    END;

    SELECT * FROM equipo WHERE Nombre_Equipo = var_Nombre;
END //

DELIMITER ;