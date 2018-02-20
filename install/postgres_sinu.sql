
CREATE TABLE laboratorio (
	id SERIAL,
	lugar CHAR(10) NOT NULL DEFAULT '',
	telefono CHAR(9) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


INSERT INTO laboratorio (lugar, telefono) VALUES ('40B01','8745');

CREATE TABLE maquina (
	id SERIAL,
	id_lab INT4 REFERENCES laboratorio,
	serial varchar(100) NOT NULL DEFAULT '',	
	nombre varchar(60) NOT NULL DEFAULT '',
	tipo char(30) NOT NULL CHECK (tipo = 'PC') DEFAULT 'PC',
	PRIMARY KEY (id)
);

INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('1','IP2','Una');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('1','IP1','Dos');



CREATE TABLE estado_inci (
	id_estado_in SERIAL,
	descripcion varchar(20) NOT NULL DEFAULT '',
	PRIMARY KEY (id_estado_in)
);


INSERT INTO estado_inci (descripcion) VALUES ('RESUELTA');
INSERT INTO estado_inci (descripcion) VALUES ('INTERRUMPIDA'); 
INSERT INTO estado_inci (descripcion) VALUES ('EN CURSO');
INSERT INTO estado_inci (descripcion) VALUES ('DESESTIMADA');


CREATE TABLE tipo_hard (
	id SERIAL,
	descripcion varchar(20) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);

INSERT INTO tipo_hard (descripcion) VALUES ('TECLADO');
INSERT INTO tipo_hard (descripcion) VALUES ('RATON');
INSERT INTO tipo_hard (descripcion) VALUES ('MONITOR');
INSERT INTO tipo_hard (descripcion) VALUES ('CDROM');
INSERT INTO tipo_hard (descripcion) VALUES ('VENTILADOR');
INSERT INTO tipo_hard (descripcion) VALUES ('CPU');
INSERT INTO tipo_hard (descripcion) VALUES ('DISQUETERA');
INSERT INTO tipo_hard (descripcion) VALUES ('OTRO');
INSERT INTO tipo_hard (descripcion) VALUES ('ANTIGUAS');


                                                                                                                                                           
CREATE TABLE tipo_soft (
        id SERIAL,
        descripcion varchar(20) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);

INSERT INTO tipo_soft (descripcion) VALUES ('SISTEMA OPERATIVO');
INSERT INTO tipo_soft (descripcion) VALUES ('INSTALACION');
INSERT INTO tipo_soft (descripcion) VALUES ('DESINSTALACION');
INSERT INTO tipo_soft (descripcion) VALUES ('MAL FUNCIONAMIENTO');
INSERT INTO tipo_soft (descripcion) VALUES ('OTRO');
INSERT INTO tipo_soft (descripcion) VALUES ('ANTIGUAS');



CREATE TABLE tipo_incidencia (
	id SERIAL,
	descripcion varchar(30) NOT NULL DEFAULT '',
	tabla varchar (40) NOT NULL DEFAULT 'inci_soft',
	PRIMARY KEY (id)
);

INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('HARDWARE','inci_hard');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('SOFTWARE', 'inci_soft');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('ALTAS','inci_altas');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('BAJAS','inci-bajas');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('LLAVES','inci_llaves');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('CAMBIO DE TONER','inci_toner');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('TRASLADO DE MAQUINA','inci_traslado');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('OTRAS','inci_otras');
 

CREATE TABLE incidencia (
        id SERIAL,
        id_estado INT4 references estado_inci DEFAULT 4,
        fecha_llegada  TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
        fecha_resolucion TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
        tipo INT4 REFERENCES tipo_incidencia,
	id_usuario INT4,
	desc_breve VARCHAR(300) NOT NULL DEFAULT '',
	desc_larga TEXT NOT NULL DEFAULT '',
        PRIMARY KEY (id)
);


CREATE TABLE anotacion (
	id SERIAL,
	id_incidencia INT4 REFERENCES incidencia,
	id_usuario INT4,
	fecha TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
	texto TEXT NOT NULL DEFAULT '',	
	PRIMARY KEY (id)
);



CREATE TABLE mensaje (
	id SERIAL,
	id_incidencia INT4 REFERENCES incidencia,
	de INT4,
	a INT4,
	fecha TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
	texto TEXT NOT NULL DEFAULT '',	
	PRIMARY KEY (id)
);



CREATE TABLE inci_hard (
	id INT4 REFERENCES incidencia,
	tipo INT4 REFERENCES tipo_hard,
	id_equipo INT4 REFERENCES maquina,
	PRIMARY KEY (id)
);
	

CREATE TABLE inci_soft (
	id INT4 REFERENCES incidencia,
	id_equipo INT4 REFERENCES maquina,
	tipo INT4 REFERENCES tipo_soft,
	PRIMARY KEY (id)
);


CREATE TABLE inci_altas (
	id INT4 REFERENCES incidencia,
	login_s char(30) NOT NULL DEFAULT '',
	correo_con char (30) NOT NULL DEFAULT '',
	passwd char (12) NOT NULL DEFAULT '',
	rol char (15) NOT NULL DEFAULT '',
	id_usr CHAR (8) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


CREATE TABLE inci_bajas (
	id INT4 REFERENCES incidencia,
	login char (30) NOT NULL DEFAULT '',
	id_usr CHAR (8) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


CREATE TABLE inci_llaves (
	id INT4 REFERENCES incidencia,
	id_lab INT4 REFERENCES maquina,
	devuelta CHAR(2) NOT NULL DEFAULT 'NO',
	PRIMARY KEY (id)
);

CREATE TABLE inci_otras (
	id INT4 REFERENCES incidencia,
	descripcion TEXT NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);



CREATE TABLE frase (
	id SERIAL,
	autor CHAR(100) NOT NULL DEFAULT '',
	frase VARCHAR(400) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


DROP TABLE sisifo;
CREATE TABLE sisifo (
	id SERIAL,
	template TEXT NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


INSERT INTO sisifo (template) VALUES ('
<div class="date">\r\nIncidencia :--id-- de tipo --tipo--<br></div>\r<div class="newsItems">\r\<H3><img src="Documentos/Imagenes/lock.gif" border=
"0" width="27" height="27" alt="">  --descbreve--</H3>\r\n--desclarga--\r\n<br> <br>\r\n<font size=2 face="helvetica,arial,sans-serif">[ <a href="--mensajes--">Mensajes</a> | <a href="--detalles--">Detalles ]</a>
<b>Fecha de envio:</b> --dateini--. <b>Fecha actualización:</b> --dateact--</font>\r\n\r\n</div>\r\n\n
'
);

