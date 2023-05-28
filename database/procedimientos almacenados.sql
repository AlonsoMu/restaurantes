
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

CALL spu_mozos_registrar(4,'Sopa de Casa','Bisteck con papas fritas','Bien frito',13);

-- ELIMINAR PEDIDO DE MOZO

DELIMITER $$
CREATE PROCEDURE spu_mozos_eliminar(
	IN _idmozo 	INT
)
BEGIN
	DELETE FROM mozos WHERE idmozo = _idmozo;
END $$

CALL spu_mozos_eliminar(4);


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

CALL spu_mozos_actualizar(1,1,'Sopa de Casa','Arroz con Pollo','Sin papa',15);

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

CALL spu_recepcionistas_registrar('Gabi','Sopa de Casa','Seco de Res','Sin Yuca',13);

-- ELIMINAR PEDIDO DE RECEPCIONISTA

DELIMITER $$
CREATE PROCEDURE spu_recepcionistas_eliminar(
	IN _idrecepcionista 	INT
)
BEGIN
	DELETE FROM recepcionistas WHERE idrecepcionista = _idrecepcionista;
END $$

CALL spu_recepcionistas_eliminar(4);


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

CALL spu_recepcionistas_actualizar(2,'Tatiana','Causa','Estofado de pollo','Poco arroz',11);


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

CALL spu_usuarios_login('AlonsoMu');

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
CALL spu_usuarios_registrar('Harold Efrain','Quispe Napa','Sol caliente','gustitos');

-- ELIMINAR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN idusuario_ INT)
BEGIN
	UPDATE usuarios SET estado = '0' 
	WHERE idusuario = idusuario_;
END $$
CALL spu_usuarios_eliminar(3);


-- RECUPERAR USUARIOS ELIMINADOS

DELIMITER $$
CREATE PROCEDURE spu_usuarios_recuperar_id(IN idusuario_ INT)
BEGIN
	SELECT * FROM usuarios WHERE idusuario = idusuario_;
END $$
CALL spu_usuarios_recuperar_id(3);

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

CALL spu_usuarios_actualizar(4,'Harold Efrain Valo','Quispe Napa','Sol caliente','gustitos');









