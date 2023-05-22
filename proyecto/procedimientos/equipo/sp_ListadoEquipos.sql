DELIMITER //

CREATE PROCEDURE sp_ListadoEquipos()
BEGIN
	SELECT * FROM equipo ORDER BY Nombre_Equipo;
END //

DELIMITER ;