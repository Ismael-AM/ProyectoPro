DELIMITER //

CREATE PROCEDURE sp_ActualizarDirectiva (
    IN var_DNI_Presidente VARCHAR(9),
    IN var_Nombre_Presidente VARCHAR(255),
    IN var_Apellidos_Presidente VARCHAR(255),
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    UPDATE directiva
    SET Nombre_Presidente = var_Nombre_Presidente,
        Apellidos_Presidente = var_Apellidos_Presidente,
        Nombre_Equipo = var_Nombre_Equipo WHERE DNI_Presidente = var_DNI_Presidente;
END //

DELIMITER ;
