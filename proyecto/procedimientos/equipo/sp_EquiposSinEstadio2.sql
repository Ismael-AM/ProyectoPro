DELIMITER //

CREATE PROCEDURE sp_EquiposSinEstadio2(IN var_Nombre VARCHAR(255))
BEGIN
    IF var_Nombre IS NULL THEN
        SELECT * FROM equipo 
        WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM estadio WHERE Nombre_Equipo IS NOT NULL)
        ORDER BY Nombre_Equipo;
    ELSE
        SELECT * FROM equipo 
        WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM estadio WHERE Nombre_Equipo IS NOT NULL)
        OR Nombre_Equipo = var_Nombre
        ORDER BY Nombre_Equipo;
    END IF;
END //

DELIMITER ;