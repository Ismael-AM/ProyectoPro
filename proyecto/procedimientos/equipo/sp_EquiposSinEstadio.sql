DELIMITER //

CREATE PROCEDURE sp_EquiposSinEstadio()
BEGIN
	SELECT * FROM equipo 
    WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM estadio WHERE Nombre_Equipo IS NOT NULL) 
    ORDER BY Nombre_Equipo;
END //

DELIMITER ;