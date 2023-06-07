
-- LISTAR PEDIDOS DE MOZOS

DELIMITER $$
CREATE PROCEDURE spu_mozos_listar()
BEGIN
	SELECT idmozo,
		mesa,	
		entrada, 
		menu, 	
		descripcion, 
		total
	FROM mozos
	WHERE estado = '1'
	ORDER BY idmozo DESC; 
END $$

CALL spu_mozos_listar();

-- REGISTRAR PEDIDOS DE MOZO


DELIMITER $$
CREATE PROCEDURE spu_mozos_registrar
(
	IN _mesa	INT,
	IN _entrada 	VARCHAR(50),
	IN _menu	VARCHAR(100),
	IN _descripcion	VARCHAR(100),
	IN _total	DECIMAL(7,2)
)
BEGIN
	INSERT INTO mozos
	(mesa,entrada,menu,descripcion,total) VALUES
	(_mesa,_entrada,_menu,_descripcion,_total);
END $$

CALL spu_mozos_registrar();

-- ELIMINAR PEDIDO DE MOZO

DELIMITER $$
CREATE PROCEDURE spu_mozos_eliminar(
	IN _idmozo 	INT
)
BEGIN
	DELETE FROM mozos WHERE idmozo = _idmozo;
END $$

CALL spu_mozos_eliminar();


-- ACTUALIZAR PEDIDO DE MOZO

DELIMITER $$
CREATE PROCEDURE spu_mozos_actualizar
(
	IN _idmozo	INT,
	IN _mesa	INT,
	IN _entrada	VARCHAR(50),
	IN _menu	VARCHAR(100),
	IN _descripcion VARCHAR(100),
	IN _total	DECIMAL(7,2)
)
BEGIN 
	UPDATE mozos SET
	mesa = _mesa,
	entrada = _entrada,
	menu = _menu,
	descripcion = _descripcion,
	total = _total,
	fecha_modificacion = NOW()
	WHERE idmozo = _idmozo;
END $$

CALL spu_mozos_actualizar();

-- RECUPERAR IDS
DELIMITER $$
CREATE PROCEDURE spu_mozos_recuperar_ids(IN _idmozo INT)
BEGIN
	SELECT * FROM mozos WHERE idmozo =  _idmozo;
END $$

-- LISTAR PEDIDOS DE RECEPCIONISTA

DELIMITER $$
CREATE PROCEDURE spu_recepcionista_listar()
BEGIN
	SELECT idrecepcionista,
		nombre,	
		entrada, 
		menu, 	
		descripcion, 
		total
	FROM recepcionistas
	WHERE estado = '1'
	ORDER BY idrecepcionista DESC; 
END $$

CALL spu_recepcionista_listar();

-- REGISTRAR PEDIDOS DE RECEPCIONISTA


DELIMITER $$
CREATE PROCEDURE spu_recepcionistas_registrar
(
	IN _nombre	VARCHAR(50),
	IN _entrada 	VARCHAR(50),
	IN _menu	VARCHAR(100),
	IN _descripcion	VARCHAR(100),
	IN _total	DECIMAL(7,2)
)
BEGIN
	INSERT INTO recepcionistas
	(nombre,entrada,menu,descripcion,total) VALUES
	(_nombre,_entrada,_menu,_descripcion,_total);
END $$

CALL spu_recepcionistas_registrar();

-- ELIMINAR PEDIDO DE RECEPCIONISTA

DELIMITER $$
CREATE PROCEDURE spu_recepcionistas_eliminar(
	IN _idrecepcionista 	INT
)
BEGIN
	DELETE FROM recepcionistas WHERE idrecepcionista = _idrecepcionista;
END $$

CALL spu_recepcionistas_eliminar();


-- ACTUALIZAR PEDIDO DE RECEPCIONISTA

DELIMITER $$
CREATE PROCEDURE spu_recepcionistas_actualizar
(
	IN _idrecepcionista	INT,
	IN _nombre	VARCHAR(50),
	IN _entrada	VARCHAR(50),
	IN _menu	VARCHAR(100),
	IN _descripcion VARCHAR(100),
	IN _total	DECIMAL(7,2)
)
BEGIN 
	UPDATE recepcionistas SET
	nombre = _nombre,
	entrada = _entrada,
	menu = _menu,
	descripcion = _descripcion,
	total = _total,
	fecha_modificacion = NOW()
	WHERE idrecepcionista = _idrecepcionista;
END $$

CALL spu_recepcionistas_actualizar();


-- RECUPERAR IDS
DELIMITER $$
CREATE PROCEDURE spu_recepcionistas_recuperar_ids(IN _idrecepcionista INT)
BEGIN
	SELECT * FROM recepcionistas WHERE idrecepcionista =  _idrecepcionista;
END $$



-- LOGIN
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN nombreusuario_ VARCHAR(50))
BEGIN
	SELECT 	idusuario, nombreusuario, claveacceso
	FROM usuarios
	WHERE nombreusuario = nombreusuario_ AND estado = '1'; 
END $$

CALL spu_usuarios_login();

-- LISTAR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
    SELECT 	idusuario,
				nombreusuario,
				apellidos,
				nombres,
				fecha_registro
	FROM usuarios
	WHERE estado = '1'
	ORDER BY idusuario DESC;
END $$
CALL spu_usuarios_listar();

-- REGISTRAR USUARIO

DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar(
	IN nombres_		VARCHAR(30),
	IN apellidos_ 		VARCHAR(30),
	IN nombreusuario_	VARCHAR(50),
	IN claveacceso_		VARCHAR(100)

)
BEGIN
	INSERT INTO usuarios(nombres,apellidos,nombreusuario, claveacceso) 
	VALUES (nombres_,apellidos_,nombreusuario_, claveacceso_);
END $$
CALL spu_usuarios_registrar();

-- ELIMINAR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN idusuario_ INT)
BEGIN
	UPDATE usuarios SET estado = '0' 
	WHERE idusuario = idusuario_;
END $$
CALL spu_usuarios_eliminar();


-- RECUPERAR USUARIOS ELIMINADOS

DELIMITER $$
CREATE PROCEDURE spu_usuarios_recuperar_id(IN idusuario_ INT)
BEGIN
	SELECT * FROM usuarios WHERE idusuario = idusuario_;
END $$
CALL spu_usuarios_recuperar_id();

-- ACTUALIZAR USUARIOS 
DELIMITER $$
CREATE PROCEDURE spu_usuarios_actualizar(
	IN idusuario_			INT,
	IN nombres_			VARCHAR(30),
	IN apellidos_			VARCHAR(30),
	IN nombreusuario_ 		VARCHAR(50),
	IN claveacceso_			VARCHAR(100)
)
BEGIN
	UPDATE usuarios SET
	nombres 			= nombres_,
	apellidos			= apellidos_,
	nombreusuario			= nombreusuario_,
	claveacceso 			= claveacceso_,
	fecha_modificacion		= NOW()
	WHERE idusuario			= idusuario_;
END $$

CALL spu_usuarios_actualizar();

-- TRAER LOS PEDIDOS POR FECHA Y MES

DELIMITER $$
CREATE PROCEDURE spu_suma_obtenerPedidosPorFecha(IN anio INT, IN mes INT, IN dia INT)
BEGIN
    SELECT DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia), '%Y-%m-%d') AS fecha_registro,
        IFNULL((SELECT SUM(total) FROM mozos WHERE DATE(fecha_registro) = DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia), '%Y-%m-%d')), 0.00) AS total_mozos,
        IFNULL((SELECT SUM(total) FROM recepcionistas WHERE DATE(fecha_registro) = DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia), '%Y-%m-%d')), 0.00) AS total_recepcionistas,
        IFNULL((SELECT SUM(total) FROM mozos WHERE DATE(fecha_registro) = DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia), '%Y-%m-%d')), 0.00) +
        IFNULL((SELECT SUM(total) FROM recepcionistas WHERE DATE(fecha_registro) = DATE_FORMAT(CONCAT(anio, '-', mes, '-', dia), '%Y-%m-%d')), 0.00) AS total_general;
END $$

CALL spu_suma_obtenerPedidosPorFecha();

DELIMITER $$
CREATE PROCEDURE spu_tiempo_obtenerPedidosPorFecha(IN anio INT, IN mes INT)
BEGIN
    DECLARE total_mozos DECIMAL(10, 2);
    DECLARE total_recepcionistas DECIMAL(10, 2);
    DECLARE total_general DECIMAL(10, 2);

    -- Obtener la suma total del mes para la tabla de mozos
    SELECT COALESCE(SUM(total), 0.00) INTO total_mozos
    FROM mozos
    WHERE YEAR(fecha_registro) = anio
    AND MONTH(fecha_registro) = mes;

    -- Obtener la suma total del mes para la tabla de recepcionistas
    SELECT COALESCE(SUM(total), 0.00) INTO total_recepcionistas
    FROM recepcionistas
    WHERE YEAR(fecha_registro) = anio
    AND MONTH(fecha_registro) = mes;

    -- Calcular el total general sumando las sumas de mozos y recepcionistas
    SET total_general = total_mozos + total_recepcionistas;

    -- Retornar los resultados
    SELECT total_mozos, total_recepcionistas, total_general;
END $$

CALL spu_tiempo_obtenerPedidosPorFecha();


-- GRAFICOS ESTADISTICOS
DELIMITER $$
CREATE PROCEDURE spu_estadistico_mozos(IN fecha DATE, OUT total_pedidos INT)
BEGIN
    SELECT COUNT(*) INTO total_pedidos
    FROM mozos
    WHERE DATE(fecha_registro) = fecha;
END $$

CALL spu_estadistico_mozos('2023-05-28', @total_pedidos_mozos);
SELECT @total_pedidos_mozos;


DELIMITER $$
CREATE PROCEDURE spu_estadistico_recepcionistas(IN fecha DATE, OUT total_pedidos INT)
BEGIN
    SELECT COUNT(*) INTO total_pedidos
    FROM recepcionistas
    WHERE DATE(fecha_registro) = fecha;
END $$

CALL spu_estadistico_recepcionistas('2023-05-19', @total_pedidos_recepcionistas);
SELECT @total_pedidos_recepcionistas;






