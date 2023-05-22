DROP DATABASE IF EXISTS BBDD_FEDERACION;
CREATE DATABASE BBDD_FEDERACION;
USE BBDD_FEDERACION;

CREATE TABLE ORGANIZACIONES_FUTBOL (
    CIF INT NOT NULL,
    Localizacion VARCHAR(200) NOT NULL,
    CONSTRAINT PK_Organizaciones_Futbol PRIMARY KEY (CIF))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE COMPETICION (
  Nombre_Comp VARCHAR(100) NOT NULL,
  CIF_RFEF INT NOT NULL,
  Premios VARCHAR(200) NOT NULL,
  CONSTRAINT PK_COMPETICION
    PRIMARY KEY (Nombre_Comp),
  CONSTRAINT FK_COMPETICION
    FOREIGN KEY (CIF_RFEF)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE COMPETICION_EUROPEA (
  Nombre_CompE VARCHAR(100) NOT NULL,
  Requisitos VARCHAR(200) NOT NULL,
  CIF_UEFA INT NOT NULL,
  CONSTRAINT PK_COMP_EUROPEA
    PRIMARY KEY (Nombre_CompE),
  CONSTRAINT FK_COMP_EUROPEA
    FOREIGN KEY (CIF_UEFA)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE REGLAMENTO (
  Nombre_Reglam VARCHAR(100) NOT NULL,
  Num_Leyes INT NULL,
  CIF_RFEF INT NOT NULL,
  CONSTRAINT PK_REGLAMENTO
    PRIMARY KEY (Nombre_Reglam),
  CONSTRAINT FK_REGLAMENTO
    FOREIGN KEY (CIF_RFEF)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE TROFEO (
  Material VARCHAR(50) NOT NULL,
  Nombre_Comp VARCHAR(100) NOT NULL,
  CONSTRAINT PK_TROFEO
    PRIMARY KEY (Nombre_Comp),
  CONSTRAINT FK_TROFEO
    FOREIGN KEY (Nombre_Comp)
    REFERENCES COMPETICION (Nombre_Comp)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE CALENDARIO (
  Año INT NOT NULL,
  Nombre_Comp VARCHAR(100) NOT NULL,
  CONSTRAINT PK_CALENDARIO
    PRIMARY KEY (Nombre_Comp),
  CONSTRAINT FK_CALENDARIO
    FOREIGN KEY (Nombre_Comp)
    REFERENCES COMPETICION (Nombre_Comp)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE DERECHOS (
  Tipo VARCHAR(100) NOT NULL,
  Precio INT NOT NULL,
  CIF_RFEF INT NOT NULL,
  CONSTRAINT PK_DERECHOS
    PRIMARY KEY (Tipo),
  CONSTRAINT FK_DERECHOS
    FOREIGN KEY (CIF_RFEF)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE CANAL_TV (
  Nombre_Canal VARCHAR(25) NOT NULL,
  Programa VARCHAR(50) NULL,
  CONSTRAINT PK_CANALTV
    PRIMARY KEY (Nombre_Canal))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Arbitro (
  DNI_Arbitro VARCHAR(9) NOT NULL,
  Nombre_Arbitro VARCHAR(50) NOT NULL,
  Apellidos_Arbitro VARCHAR(100) NOT NULL,
  Funcion_Arbitro VARCHAR(50) NOT NULL,
  CIF_RFEF INT NOT NULL,
  Nombre_Reglam VARCHAR(100) NOT NULL,
  CONSTRAINT PK_ARBITRO
    PRIMARY KEY (DNI_Arbitro),
  CONSTRAINT FK_ARBITRO1
    FOREIGN KEY (CIF_RFEF)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_ARBITRO2
    FOREIGN KEY (Nombre_Reglam)
    REFERENCES REGLAMENTO (Nombre_Reglam)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE EMPLEADO (
  DNI_Empleado VARCHAR(9) NOT NULL,
  Nombre_Empleado VARCHAR(50) NOT NULL,
  Apellidos_Empleado VARCHAR(100) NOT NULL,
  Funcion_Empleado VARCHAR(50) NOT NULL,
  CIF_RFEF INT NOT NULL,
  CONSTRAINT PK_EMPLEADO
    PRIMARY KEY (DNI_Empleado),
  CONSTRAINT FK_EMPLEADO
    FOREIGN KEY (CIF_RFEF)
    REFERENCES ORGANIZACIONES_FUTBOL (CIF)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE EQUIPO (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Abreviatura VARCHAR(3) NOT NULL,
  Escudo VARCHAR(255) NOT NULL,
  Palmares VARCHAR(255) NULL,
  CONSTRAINT PK_EQUIPO
    PRIMARY KEY (Nombre_Equipo)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `equipo` (Nombre_Equipo, Abreviatura, Escudo, Palmares) VALUES
("FC BARCELONA", "FCB", "imagenes/equipos/fcbarcelona.png", "26x LaLiga"),
("REAL MADRID CF", "RMA","imagenes/equipos/realmadrid.png", "35x LaLiga"),
("UD LAS PALMAS", "LPA","imagenes/equipos/udlaspalmas.png", "N/A");

CREATE TABLE HISTORICO_EQUIPO (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Abreviatura VARCHAR(3) NOT NULL,
  Escudo VARCHAR(255) NOT NULL,
  Palmares VARCHAR(255) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE JUGADOR (
  DNI_Jugador VARCHAR(9) NOT NULL,
  Nombre_Jugador VARCHAR(50) NOT NULL,
  Apellidos_Jugador VARCHAR(100) NOT NULL,
  Alias VARCHAR(50) NOT NULL,
  Posicion VARCHAR(25) NOT NULL,
  Valor_Mercado INT(9) NOT NULL,
  Num_Camiseta INT(2) NOT NULL,
  Nombre_Equipo VARCHAR(50) NULL,
  Imagen VARCHAR(255),
  CONSTRAINT PK_JUGADOR
    PRIMARY KEY (DNI_Jugador),
  CONSTRAINT FK_JUGADOR
    FOREIGN KEY (Nombre_Equipo) REFERENCES EQUIPO (Nombre_Equipo) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `jugador` (DNI_Jugador, Nombre_Jugador, Apellidos_Jugador, Alias, Posicion, Valor_Mercado, Num_Camiseta, Nombre_Equipo, Imagen) VALUES
("12345678A", "Pedro", "González López", "Pedri", "Centrocampista", "100000000", 8, "FC BARCELONA", "imagenes/jugadores/pedrig.png"),
("23456789B", "Thibaut", "Courtois", "Courtois", "Portero", "60000000", 1, "REAL MADRID CF", "imagenes/jugadores/courtois.png"),
("34567890C", "Alberto", "Moleiro González", "Moleiro", "Centrocampista", "3000000", 10, "UD LAS PALMAS", "imagenes/jugadores/moleiro.png");

CREATE TABLE HISTORICO_JUGADOR (
  DNI_Jugador VARCHAR(9) NOT NULL,
  Nombre_Jugador VARCHAR(50) NOT NULL,
  Apellidos_Jugador VARCHAR(100) NOT NULL,
  Alias VARCHAR(50) NOT NULL,
  Posicion VARCHAR(25) NOT NULL,
  Valor_Mercado INT(9) NOT NULL,
  Num_Camiseta INT(2) NOT NULL,
  Nombre_Equipo VARCHAR(50) NULL,
  Imagen VARCHAR(255)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE ESTADIO (
  Nombre_Estadio VARCHAR(100) NOT NULL,
  Ubicacion VARCHAR(200) NOT NULL,
  Capacidad INT(6) NOT NULL,
  Nombre_Equipo VARCHAR(45) NULL,
  CONSTRAINT PK_ESTADIO
    PRIMARY KEY (Nombre_Estadio),
  CONSTRAINT FK_ESTADIO
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `estadio` (Nombre_Estadio, Ubicacion, Capacidad, Nombre_Equipo) VALUES
("ESTADIO DE GRAN CANARIA", "C. FONDOS DE SEGURA, S/N, 35019 LAS PALMAS DE GRAN CANARIA, LAS PALMAS", 32400, "UD LAS PALMAS"),
("SANTIAGO BERNABEU", "AV. DE CONCHA ESPINA, 1, 28036 MADRID", 81044, "REAL MADRID CF"),
("SPOTIFY CAMP NOU", "C. D'ARÍSTIDES MAILLOL, 12, 08028 BARCELONA", 99354, "FC BARCELONA");

CREATE TABLE SPONSOR (
  Nombre_Sponsor VARCHAR(100) NOT NULL,
  Telefono INT(9) NOT NULL,
  CONSTRAINT PK_SPONSOR
    PRIMARY KEY (Nombre_Sponsor))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE FICHAJE (
  ID_Fichaje INT NOT NULL,
  Equipo_Procedencia VARCHAR(50) NOT NULL,
  Importe_Fichaje INT(9) NOT NULL,
  Equipo_Incorpora VARCHAR(50) NOT NULL,
  CONSTRAINT PK_FICHAJE
    PRIMARY KEY (ID_Fichaje),
  CONSTRAINT FK_FICHAJE
    FOREIGN KEY (Equipo_Incorpora)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE TRASPASO (
  ID_Traspaso INT NOT NULL,
  Equipo_Incorpora VARCHAR(50) NOT NULL,
  Importe_Traspaso INT(9) NOT NULL,
  Equipo_Procedencia VARCHAR(50) NOT NULL,
  CONSTRAINT PK_TRASPASO 
    PRIMARY KEY (ID_Traspaso),
  CONSTRAINT FK_TRASPASO
    FOREIGN KEY (Equipo_Procedencia)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE DIRECTIVA (
  DNI_Presidente VARCHAR(9) NOT NULL,
  Nombre_Presidente VARCHAR(50) NOT NULL,
  Apellidos_Presidente VARCHAR(100) NOT NULL,
  Nombre_Equipo VARCHAR(50) NOT NULL,
  CONSTRAINT PK_DIRECTICA
    PRIMARY KEY (DNI_Presidente),
  CONSTRAINT FK_DIRECTIVA
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `directiva` (DNI_Presidente, Nombre_Presidente, Apellidos_Presidente, Nombre_Equipo) VALUES
("11335577K", "JOAN", "LAPORTA", "FC BARCELONA"),
("22446688P", "FLORENTINO", "PÉREZ", "REAL MADRID CF"),
("33557799O", "MIGUEL ÁNGEL", "RAMÍREZ", "UD LAS PALMAS");

CREATE TABLE MERCHANDISING (
  ID_Articulo INT NOT NULL,
  Precio_Articulo DECIMAL NOT NULL,
  CONSTRAINT PK_MERCHANDISING
    PRIMARY KEY (ID_Articulo))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE INGRESO (
  ID_Ingreso INT NOT NULL,
  Valor_Ingreso INT NOT NULL,
  CONSTRAINT PK_INGRESO
    PRIMARY KEY (ID_Ingreso))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE SOCIO (
  Num_Socio INT NOT NULL,
  Nombre_Socio VARCHAR(50) NOT NULL,
  Apellidos_Socio VARCHAR(100) NOT NULL,
  CONSTRAINT PK_SOCIO
    PRIMARY KEY (Num_Socio))ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE STAFF (
  DNI_Staff VARCHAR(9) NOT NULL,
  Nombre_Staff VARCHAR(50) NOT NULL,
  Apellidos_Staff VARCHAR(100) NOT NULL,
  Nombre_Equipo VARCHAR(50) NOT NULL,
  CONSTRAINT PK_STAFF
    PRIMARY KEY (DNI_Staff),
  CONSTRAINT FK_STAFF
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Equipo_Sponsor (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Nombre_Sponsor VARCHAR(50) NOT NULL,
  CONSTRAINT PK_Equipo_Sponsor
    PRIMARY KEY (Nombre_Equipo, Nombre_Sponsor),
  CONSTRAINT FK_Equipo_Sponsor1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_Sponsor2
    FOREIGN KEY (Nombre_Sponsor)
    REFERENCES SPONSOR (Nombre_Sponsor)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Equipo_Ingreso (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  ID_Ingreso INT NOT NULL,
  CONSTRAINT PK_Equipo_Ingreso
    PRIMARY KEY (Nombre_Equipo, ID_Ingreso),
  CONSTRAINT FK_Equipo_Ingreso1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_Ingreso2
    FOREIGN KEY (ID_Ingreso)
    REFERENCES INGRESO (ID_Ingreso)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Equipo_Merch (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  ID_Articulo INT NOT NULL,
  CONSTRAINT PK_Equipo_Merch
    PRIMARY KEY (Nombre_Equipo, ID_Articulo),
  CONSTRAINT FK_Equipo_Merch1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_Merch2
    FOREIGN KEY (ID_Articulo)
    REFERENCES MERCHANDISING (ID_Articulo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Equipo_Socio (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Num_Socio INT NOT NULL,
  CONSTRAINT PK_Equipo_Socio
    PRIMARY KEY (Nombre_Equipo, Num_Socio),
  CONSTRAINT FK_Equipo_Socio1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_Socio2
    FOREIGN KEY (Num_Socio)
    REFERENCES SOCIO (Num_Socio)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Merch_Ingreso (
  ID_Articulo INT NOT NULL,
  ID_Ingreso INT NOT NULL,
  CONSTRAINT PK_Merch_Ingreso
    PRIMARY KEY (ID_Articulo, ID_Ingreso),
  CONSTRAINT FK_Merch_Ingreso1
    FOREIGN KEY (ID_Articulo)
    REFERENCES MERCHANDISING (ID_Articulo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Merch_Ingreso2
    FOREIGN KEY (ID_Ingreso)
    REFERENCES INGRESO (ID_Ingreso)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Equipo_Comp (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Nombre_Comp VARCHAR(100) NOT NULL,
  CONSTRAINT PK_Equipo_Comp
    PRIMARY KEY (Nombre_Equipo, Nombre_Comp),
  CONSTRAINT FK_Equipo_Comp1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_Comp2
    FOREIGN KEY (Nombre_Comp)
    REFERENCES COMPETICION (Nombre_Comp)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Canal_Derechos (
  Nombre_Canal VARCHAR(25) NOT NULL,
  Tipo_Derecho VARCHAR(100) NOT NULL,
  CONSTRAINT PK_Canal_Derechos
    PRIMARY KEY (Nombre_Canal, Tipo_Derecho),
  CONSTRAINT FK_Canal_Derechos1
    FOREIGN KEY (Nombre_Canal)
    REFERENCES CANAL_TV (Nombre_Canal)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Canal_Derechos2
    FOREIGN KEY (Tipo_Derecho)
    REFERENCES DERECHOS (Tipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE Equipo_CompE (
  Nombre_Equipo VARCHAR(50) NOT NULL,
  Nombre_CompE VARCHAR(100) NOT NULL,
  CONSTRAINT PK_Equipo_CompE
    PRIMARY KEY (Nombre_Equipo, Nombre_CompE),
  CONSTRAINT FK_Equipo_CompE1
    FOREIGN KEY (Nombre_Equipo)
    REFERENCES EQUIPO (Nombre_Equipo)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Equipo_CompE2
    FOREIGN KEY (Nombre_CompE)
    REFERENCES COMPETICION_EUROPEA (Nombre_CompE)
    ON DELETE CASCADE
    ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DELIMITER //

CREATE PROCEDURE sp_ListadoEquipos()
BEGIN
	SELECT * FROM equipo ORDER BY Nombre_Equipo;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_InsertarEquipo(
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Abreviatura VARCHAR(3),
    IN var_Escudo VARCHAR(255),
    IN var_Palmares VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al añadir el equipo' AS ErrorMessage;
    END;

    START TRANSACTION;

    INSERT INTO equipo (Nombre_Equipo, Abreviatura, Escudo, Palmares)
    VALUES (var_Nombre_Equipo, var_Abreviatura, var_Escudo, var_Palmares);

    IF ROW_COUNT() > 0 THEN
        COMMIT;
        SELECT 'Equipo añadido correctamente' AS SuccessMessage;
    ELSE
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al añadir el equipo' AS ErrorMessage;
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EliminarEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE jugadoresEquipo INT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al eliminar el equipo' AS mensaje;
    END;

    START TRANSACTION;
    
    SELECT COUNT(*) INTO jugadoresEquipo FROM equipo WHERE Nombre_Equipo = var_Nombre;

    IF jugadoresEquipo > 0 THEN
        
        UPDATE jugador SET Nombre_Equipo = NULL WHERE Nombre_Equipo = var_Nombre;

        UPDATE estadio SET Nombre_Equipo = NULL WHERE Nombre_Equipo = var_Nombre;

        DELETE FROM equipo WHERE Nombre_Equipo = var_Nombre;

        IF ROW_COUNT() > 0 THEN
            COMMIT;
            SELECT 'Equipo eliminado correctamente' AS mensaje;
        ELSE
            ROLLBACK;
            SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
        END IF;
    ELSE
        ROLLBACK;
        SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
    END IF;
END //

DELIMITER ;

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

DELIMITER //

CREATE PROCEDURE sp_ActualizarEquipo(
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Abreviatura VARCHAR(3),
    IN var_Escudo VARCHAR(255),
    IN var_Palmares VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 'Ocurrió un error inesperado al actualizar los datos del equipo' AS mensaje;
    END;

    START TRANSACTION;

    UPDATE equipo SET
        Nombre_Equipo = var_Nombre_Equipo,
        Abreviatura = var_Abreviatura,
        Escudo = var_Escudo,
        Palmares = var_Palmares
    WHERE
        Nombre_Equipo = var_Nombre_Equipo;

    IF ROW_COUNT() > 0 THEN
        COMMIT;
        SELECT 'Se actualizaron correctamente los datos del equipo' AS mensaje;
    ELSE
        ROLLBACK;
        SELECT 'No se encontró ningún equipo con el nombre especificado' AS mensaje;
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_NumeroJugadores(IN var_Nombre_Equipo VARCHAR(255), OUT var_NumJugadores INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recoger el número de jugadores' AS mensaje;
    END;

    SELECT COUNT(*) INTO var_NumJugadores FROM JUGADOR WHERE Nombre_Equipo = var_Nombre_Equipo;
END //

DELIMITER ;

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

DELIMITER //

CREATE PROCEDURE sp_ObtenerJugadoresEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de jugadores de este equipo' AS mensaje;
    END;

    SELECT jugador.* FROM jugador
    INNER JOIN equipo ON jugador.Nombre_Equipo = equipo.Nombre_Equipo
    WHERE equipo.Nombre_Equipo = var_Nombre
    ORDER BY FIELD(jugador.Posicion, 'Portero', 'Defensa','Centrocampista','Delantero'),jugador.Num_Camiseta;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ObtenerEstadioEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el estadio de este equipo' AS mensaje;
    END;

    SELECT estadio.* FROM estadio WHERE Nombre_Equipo = var_Nombre;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EquiposSinEstadio()
BEGIN
	SELECT * FROM equipo 
    WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM estadio WHERE Nombre_Equipo IS NOT NULL) 
    ORDER BY Nombre_Equipo;
END //
DELIMITER ;

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

DELIMITER //

CREATE PROCEDURE sp_ObtenerDirectivaEquipo(IN var_Nombre VARCHAR(255))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener la directiva de este equipo' AS mensaje;
    END;

    SELECT directiva.* FROM directiva WHERE Nombre_Equipo = var_Nombre;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EquiposSinDirectiva()
BEGIN
	SELECT * FROM equipo 
    WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM directiva WHERE Nombre_Equipo IS NOT NULL) 
    ORDER BY Nombre_Equipo;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EquiposSinDirectiva2(IN var_Nombre VARCHAR(255))
BEGIN
    IF var_Nombre IS NULL THEN
        SELECT * FROM equipo 
        WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM directiva WHERE Nombre_Equipo IS NOT NULL)
        ORDER BY Nombre_Equipo;
    ELSE
        SELECT * FROM equipo 
        WHERE Nombre_Equipo NOT IN (SELECT DISTINCT Nombre_Equipo FROM directiva WHERE Nombre_Equipo IS NOT NULL)
        OR Nombre_Equipo = var_Nombre
        ORDER BY Nombre_Equipo;
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ListadoJugadores()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de jugadores' AS mensaje;
    END;

    SELECT DISTINCT DNI_Jugador, Nombre_Jugador, Apellidos_Jugador, Alias, Posicion, Valor_Mercado, Num_Camiseta, Nombre_Equipo, Imagen
    FROM jugador
    ORDER BY FIELD(Posicion, 'Portero', 'Defensa', 'Centrocampista', 'Delantero'), Nombre_Jugador;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_InsertarJugador(
    IN var_DNI_Jugador VARCHAR(9),
    IN var_Nombre_Jugador VARCHAR(255),
    IN var_Apellidos_Jugador VARCHAR(255),
    IN var_Alias VARCHAR(255),
    IN var_Posicion VARCHAR(255),
    IN var_Valor_Mercado INT(9),
    IN var_Num_Camiseta INT(2),
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Imagen VARCHAR(255)
)
BEGIN
    DECLARE dniExistente INT DEFAULT 0;
    DECLARE mensaje VARCHAR(255);
    
    SELECT COUNT(*) INTO dniExistente FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;
    
    IF dniExistente >= 1 THEN
        SET mensaje = 'Error: Ya existe un jugador con el DNI especificado en la base de datos.';
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "Error: Ya existe un jugador con el DNI especificado en la base de datos.";
    ELSE
        BEGIN
            DECLARE CONTINUE HANDLER FOR 1062
            BEGIN
                SELECT 'Error: Ya existe un jugador con el DNI especificado en la base de datos.' AS mensaje;
            END;
            START TRANSACTION;

            IF NOT var_DNI_Jugador REGEXP '^[0-9]{8}[A-Za-z]$' THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = "DNI no válido";
                SET mensaje = 'Error: El DNI no es válido. Debe contener 8 números iniciales y una letra final';
                ROLLBACK;
            ELSE
                INSERT INTO jugador (
                    DNI_Jugador,
                    Nombre_Jugador,
                    Apellidos_Jugador,
                    Alias,
                    Posicion,
                    Valor_Mercado,
                    Num_Camiseta,
                    Nombre_Equipo,
                    Imagen
                )
                VALUES (
                    var_DNI_Jugador,
                    var_Nombre_Jugador,
                    var_Apellidos_Jugador,
                    var_Alias,
                    var_Posicion,
                    var_Valor_Mercado,
                    var_Num_Camiseta,
                    var_Nombre_Equipo,
                    var_Imagen
                );
                
                COMMIT;
                SET mensaje = 'Jugador añadido correctamente';
            END IF;
        END;
    END IF;
    SELECT mensaje;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EliminarJugador(IN var_DNI_Jugador VARCHAR(9))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar el jugador' AS mensaje;
    END;

    DELETE FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;

    IF ROW_COUNT() > 0 THEN
        SELECT 'Jugador eliminado correctamente' AS mensaje;
    ELSE
        SELECT 'El jugador no existe' AS mensaje;
    END IF;
END //

DELIMITER ;

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

DELIMITER //

CREATE PROCEDURE sp_ObtenerJugador(IN var_DNI_Jugador VARCHAR(9))
BEGIN
    IF NOT var_DNI_Jugador REGEXP '^[0-9]{8}[A-Za-z]$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "DNI no válido";
    END IF;

    IF var_DNI_Jugador NOT IN (SELECT DNI_JUGADOR FROM jugador WHERE DNI_Jugador = var_DNI_Jugador) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "No se ha encontrado ningún jugador con ese DNI";
    END IF;
    
    SELECT * FROM jugador WHERE DNI_Jugador = var_DNI_Jugador;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ActualizarJugador(
    IN var_DNI_Jugador VARCHAR(9),
    IN var_Nombre_Jugador VARCHAR(255),
    IN var_Apellidos_Jugador VARCHAR(255),
    IN var_Alias VARCHAR(255),
    IN var_Posicion VARCHAR(255),
    IN var_Valor_Mercado INT,
    IN var_Num_Camiseta INT(2),
    IN var_Nombre_Equipo VARCHAR(255),
    IN var_Imagen VARCHAR(255)
)
BEGIN
    BEGIN
        UPDATE jugador
        SET Nombre_Jugador = var_Nombre_Jugador,
            Apellidos_Jugador = var_Apellidos_Jugador,
            Alias = var_Alias,
            Posicion = var_Posicion,
            Valor_Mercado = var_Valor_Mercado,
            Num_Camiseta = var_Num_Camiseta,
            Nombre_Equipo = var_Nombre_Equipo,
            Imagen = var_Imagen
        WHERE DNI_Jugador = var_DNI_Jugador;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Se actualizaron correctamente los datos del jugador';
        ELSE
            SELECT 'Ocurrió un error inesperado al recuperar el jugador';
        END IF;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ListadoEstadios()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de estadios';
    END;

    BEGIN
        SELECT DISTINCT * FROM estadio;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_InsertarEstadio(
    IN var_Nombre_Estadio VARCHAR(255),
    IN var_Ubicacion VARCHAR(255),
    IN var_Capacidad INT,
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al añadir el estadio';
        ROLLBACK;
    END;

    START TRANSACTION;

    BEGIN
        INSERT INTO estadio (Nombre_Estadio, Ubicacion, Capacidad, Nombre_Equipo)
        VALUES (var_Nombre_Estadio, var_Ubicacion, var_Capacidad, var_Nombre_Equipo);

        IF ROW_COUNT() > 0 THEN
            SELECT 'Estadio añadido correctamente';
            COMMIT;
        ELSE
            SELECT 'Ocurrió un error inesperado al añadir el estadio';
            ROLLBACK;
        END IF;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EliminarEstadio(
    IN var_Nombre_Estadio VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar el estadio';
    END;

    BEGIN
        START TRANSACTION;

        DELETE FROM estadio WHERE Nombre_Estadio = var_Nombre_Estadio;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Estadio eliminado correctamente';
            COMMIT;
        ELSE
            SELECT 'Ocurrió un error inesperado al eliminar el estadio';
            ROLLBACK;
        END IF;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ObtenerEstadio(
    IN var_Nombre_Estadio VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recuperar el estadio seleccionado';
    END;

    BEGIN
        SELECT * FROM estadio WHERE Nombre_Estadio = var_Nombre_Estadio;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ActualizarEstadio(
    IN var_Nombre_Estadio VARCHAR(255),
    IN var_Ubicacion VARCHAR(255),
    IN var_Capacidad INT,
    IN var_Nombre_Equipo VARCHAR(255),
    OUT result VARCHAR(255)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SET result = 'Ocurrió un error inesperado al actualizar los datos del estadio';
    END;

    BEGIN
        DECLARE rows_affected INT;
        
        UPDATE estadio 
        SET Nombre_Estadio = var_Nombre_Estadio, 
            Ubicacion = var_Ubicacion,
            Capacidad = var_Capacidad,
            Nombre_Equipo = var_Nombre_Equipo 
        WHERE Nombre_Estadio = var_Nombre_Estadio;

        SET rows_affected = ROW_COUNT();
        
        IF rows_affected > 0 THEN
            SET result = 'Se actualizaron correctamente los datos del estadio';
        ELSE
            SET result = 'No se encontró ningún estadio con ese nombre o no se realizaron cambios';
        END IF;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ListadoDirectivas()
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al obtener el listado de directivas';
    END;

    BEGIN
        SELECT DISTINCT * FROM directiva ORDER BY Nombre_Presidente;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_InsertarDirectiva(
    IN var_DNI_Presidente VARCHAR(255),
    IN var_Nombre_Presidente VARCHAR(255),
    IN var_Apellidos_Presidente VARCHAR(255),
    IN var_Nombre_Equipo VARCHAR(255)
)
BEGIN
    DECLARE dniExistente INT DEFAULT 0;
    DECLARE mensaje VARCHAR(255);
    
    SELECT COUNT(*) INTO dniExistente FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;
    
    IF dniExistente >= 1 THEN
        SET mensaje = 'Ya existe un presidente en la base de datos con el DNI especificado.';
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = "Ya existe un presidente en la base de datos con el DNI especificado.";
    ELSE
        BEGIN
            DECLARE CONTINUE HANDLER FOR 1062
            BEGIN
                SELECT 'Error: Ya existe un presidente en la base de datos con el DNI especificado.' AS mensaje;
            END;
            START TRANSACTION;

            IF NOT var_DNI_Presidente REGEXP '^[0-9]{8}[A-Za-z]$' THEN
                SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = "DNI no válido";
                SET mensaje = 'Error: El DNI no es válido. Debe contener 8 números iniciales y una letra final';
                ROLLBACK;
            ELSE
                INSERT INTO directiva (DNI_Presidente, Nombre_Presidente, Apellidos_Presidente, Nombre_Equipo)
                VALUES (var_DNI_Presidente, var_Nombre_Presidente, var_Apellidos_Presidente, var_Nombre_Equipo);

                COMMIT;
                SET mensaje = 'Directiva añadida correctamente';
            END IF;
        END;
    END IF;

    SELECT mensaje;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_EliminarDirectiva(
    IN var_DNI_Presidente VARCHAR(9)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al eliminar la directiva';
    END;

    BEGIN
        DELETE FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;

        IF ROW_COUNT() > 0 THEN
            SELECT 'Directiva eliminada correctamente';
        ELSE
            SELECT 'Ocurrió un error inesperado al eliminar la directiva';
        END IF;
    END;
    
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_ObtenerDirectiva(
    IN var_DNI_Presidente VARCHAR(9)
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 'Ocurrió un error inesperado al recuperar la directiva seleccionada';
    END;

    BEGIN
        SELECT * FROM directiva WHERE DNI_Presidente = var_DNI_Presidente;
    END;
    
END //

DELIMITER ;

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