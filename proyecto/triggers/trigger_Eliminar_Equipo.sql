DELIMITER //

CREATE TRIGGER trigger_Eliminar_Equipo AFTER DELETE ON equipo FOR EACH ROW
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM historico_equipo
        WHERE Nombre_Equipo = OLD.Nombre_Equipo
    ) THEN
        INSERT INTO historico_equipo (
            Nombre_Equipo, 
            Abreviatura,
            Escudo,
            Palmares
        ) VALUES (
            OLD.Nombre_Equipo, 
            OLD.Abreviatura,
            OLD.Escudo,
            OLD.Palmares
        );
    END IF;
END //

DELIMITER ;