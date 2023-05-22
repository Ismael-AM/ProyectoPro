DELIMITER //

CREATE PROCEDURE sp_Asignar_EstadioyDirectiva(IN nombreEquipo VARCHAR(50), IN nombreEstadio VARCHAR(100), IN dniPresidente VARCHAR(9))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Error: La transacción no pudo completarse.' AS Message;
    END;
    
    START TRANSACTION;
    
    -- Actualizar el estadio del equipo en la tabla ESTADIO
    UPDATE ESTADIO
    SET Nombre_Equipo = nombreEquipo
    WHERE Nombre_Estadio = nombreEstadio;
    
    -- Insertar un nuevo miembro de la directiva en la tabla DIRECTIVA
    INSERT INTO DIRECTIVA (DNI_Presidente, Nombre_Presidente, Apellidos_Presidente, Nombre_Equipo)
    VALUES (dniPresidente, 'Nombre del Presidente', 'Apellidos del Presidente', nombreEquipo);
    
    COMMIT;
    
    SELECT 'Transacción completada exitosamente.' AS Message;
END //

DELIMITER ;






