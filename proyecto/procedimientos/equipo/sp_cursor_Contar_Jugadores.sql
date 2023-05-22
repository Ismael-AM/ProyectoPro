DELIMITER //

CREATE PROCEDURE cursor_Contar_Jugadores(IN var_Nombre_Equipo VARCHAR(255))
BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE total INT DEFAULT 0;
    DECLARE dni VARCHAR(9);

    DECLARE cur CURSOR FOR SELECT DNI_JUGADOR FROM JUGADOR WHERE Nombre_Equipo = var_Nombre_Equipo;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN CUR;

    read_loop: LOOP
        FETCH cur INTO dni;

        IF done THEN
            LEAVE read_loop;
        END IF;

        SET total = total + 1;
    END LOOP;

    CLOSE cur;

    SELECT total AS total_jugadores;
END //

DELIMITER ;