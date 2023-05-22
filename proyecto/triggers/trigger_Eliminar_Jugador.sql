DELIMITER //

CREATE TRIGGER trigger_Eliminar_Jugador AFTER DELETE ON jugador FOR EACH ROW
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM historico_jugador
        WHERE DNI_Jugador = OLD.DNI_Jugador
    ) THEN
        INSERT INTO historico_jugador (
            DNI_Jugador, 
            Nombre_Jugador,
            Apellidos_Jugador,
            Alias,
            Posicion,
            Valor_Mercado,
            Num_Camiseta,
            Nombre_Equipo,
            Imagen
        ) VALUES (
            OLD.DNI_Jugador, 
            OLD.Nombre_Jugador,
            OLD.Apellidos_Jugador,
            OLD.Alias,
            OLD.Posicion,
            OLD.Valor_Mercado,
            OLD.Num_Camiseta,
            OLD.Nombre_Equipo,
            OLD.Imagen
        );
    END IF;
END //

DELIMITER ;