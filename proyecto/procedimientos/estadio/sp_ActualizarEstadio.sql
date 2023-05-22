DELIMITER //

CREATE PROCEDURE sp_ActualizarEstadio(
    IN var_Nombre_Estadio VARCHAR(255),
    IN var_Ubicacion VARCHAR(255),
    IN var_Capacidad INT,
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al actualizar los datos del estadio';
    END;

    BEGIN
        UPDATE estadio SET 
                          Ubicacion = var_Ubicacion,
                          Capacidad = var_Capacidad,
                          Nombre_Equipo = var_Nombre_Equipo 
        WHERE Nombre_Estadio = var_Nombre_Estadio;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Se actualizaron correctamente los datos del estadio';
        ELSE
            SELECT 'Ocurrió un error inesperado al actualizar los datos del estadio';
        END IF;
    END;
    
END //

DELIMITER ;