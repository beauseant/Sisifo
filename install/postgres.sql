
BEGIN;

CREATE TABLE maquina (
	id SERIAL,
	serial varchar (100) NOT NULL DEFAULT '0.0.0.0',	
	nombre varchar (60) NOT NULL DEFAULT '',
	id_lab varchar (20) NOT NULL DEFAULT '',
	tipo char(30) NOT NULL CHECK (tipo = 'PC') DEFAULT 'PC',
	PRIMARY KEY (id)
);

INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.35','alcaudon');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.77','archaeopterix');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.53','gallomimis');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.210','turul');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.209','moa');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42D11','163.117.145.44','cluster');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42A03','163.117.145.37','condor');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42A01','163.117.145.43','cernicalo');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('42C03','163.117.145.38','ansar');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('43B03','163.117.145.39','grevol');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('43A03','163.117.145.24','loca');
INSERT INTO maquina ( id_lab, serial, nombre ) VALUES ('43A03','163.117.145.29','reina');

CREATE TABLE usuario (
	id SERIAL,
	login char (16) NOT NULL DEFAULT '',
	email char (36) NOT NULL DEFAULT '',
	ldapid char (5) NOT NULL DEFAULT '',
	esadmin char(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (id)	
);


CREATE TABLE estado_inci (
	id_estado_in SERIAL,
	descripcion varchar(20) NOT NULL DEFAULT 'EN CURSO',
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
INSERT INTO tipo_hard (descripcion) VALUES ('IMPRESORA');



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




CREATE TABLE tipo_incidencia (
	id SERIAL,
	descripcion varchar(30) NOT NULL DEFAULT '',
	tabla varchar (40) NOT NULL DEFAULT 'inci_soft',
	PRIMARY KEY (id)
);

INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('HARDWARE','inci_hard');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('SOFTWARE', 'inci_soft');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('ALTAS USUARIO','inci_altas');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('BAJAS USUARIO','inci_bajas');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('LLAVES','inci_llaves');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('CAMBIO ROL','inci_cambiorol');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('OTRAS','inci_otras');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('ALTA MAQUINA','inci_alta_maq');
INSERT INTO tipo_incidencia (descripcion, tabla) VALUES ('CABLES','inci_cables');



CREATE TABLE incidencia (
        id SERIAL,
        id_estado INT4 references estado_inci DEFAULT 3,
        fecha_llegada  TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
        fecha_resolucion TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
        tipo INT4 REFERENCES tipo_incidencia,
	id_usuario INT4 NOT NULL,
	desc_breve VARCHAR(200) NOT NULL DEFAULT '',
	desc_larga TEXT NOT NULL DEFAULT '',
        PRIMARY KEY (id)
);


CREATE TABLE anotacion (
	id SERIAL,
	id_incidencia INT4 REFERENCES incidencia,
	id_usuario INT4 NOT NULL,
	fecha TIMESTAMP NOT NULL DEFAULT '0001-01-01 00:00:00',
	texto TEXT NOT NULL DEFAULT '',	
	PRIMARY KEY (id)
);



CREATE TABLE mensaje (
	id SERIAL,
	id_incidencia INT4 REFERENCES incidencia,
	de INT4 NOT NULL,
	a INT4 NOT NULL,
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

CREATE TABLE rol (

	id SERIAL,
	rolact char(20) NOT NULL DEFAULT 'proyectando',
	PRIMARY KEY (id)
);

INSERT INTO rol ( rolact ) VALUES ( 'proyectando' );
INSERT INTO rol ( rolact ) VALUES ( 'doctorando' );
INSERT INTO rol ( rolact ) VALUES ( 'profesor' );
INSERT INTO rol ( rolact ) VALUES ( 'becario' );
INSERT INTO rol ( rolact ) VALUES ( 'otro' );

CREATE TABLE inci_altas (
	id INT4 REFERENCES incidencia,
	nombre char (30) NOT NULL,
	apellido char (30) NOT NULL,
	login_s char(30) NOT NULL DEFAULT '',
	correo_con char (30) NOT NULL DEFAULT '',
	passwd char (12) NOT NULL DEFAULT '',
	rol INT4 REFERENCES rol,
	id_usr CHAR (8) NOT NULL,
	PRIMARY KEY (id)
);


CREATE TABLE inci_bajas (
	id INT4 REFERENCES incidencia,
	nombre char (30) NOT NULL,
	apellido char (30) NOT NULL,		
	login char (30) NOT NULL,
	id_usr CHAR (8) NOT NULL DEFAULT '',
	correo_con char (30) NOT NULL DEFAULT '',
	rol INT4 REFERENCES rol NOT NULL,
	PRIMARY KEY (id)
);


CREATE TABLE inci_llaves (
	id INT4 REFERENCES incidencia,
	laboratorio CHAR(15) NOT NULL DEFAULT '',
	devuelta CHAR(2) NOT NULL DEFAULT 'NO',
	tipo char (15) CHECK (tipo = 'devolucion' OR tipo = 'peticion') DEFAULT 'peticion',
	PRIMARY KEY (id)
);

CREATE TABLE inci_cambiorol (
	id INT4 REFERENCES incidencia,
	nombre char (30) NOT NULL,
	apellido char (30) NOT NULL,
	login char (30) NOT NULL,
	rol_ant INT4 REFERENCES rol NOT NULL,
	rol_nuevo INT4 REFERENCES rol NOT NULL,
	PRIMARY KEY (id)
);



CREATE TABLE inci_otras (
	id INT4 REFERENCES incidencia,
	descripcion TEXT NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


CREATE TABLE inci_alta_maq (
	id INT4 REFERENCES incidencia,
	nombre char(30) NOT NULL,
	laboratorio char (20) NOT NULL,
	PRIMARY KEY (id)

);

CREATE TABLE frase (
	id INT4,
	texto VARCHAR(400) NOT NULL DEFAULT '',
	autor CHAR(100) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);

INSERT INTO frase VALUES (1, 'Las religiones, como las luciérnagas, necesitan de oscuridad para brillar.', 'Arthur Schopenhauer');
INSERT INTO frase VALUES (2, 'La mejor forma de librarse de una tentación es caer en ella.', 'Oscar Wilde');
INSERT INTO frase VALUES (3, 'Es mejor estar callado y parecer tonto, que hablar y despejar las dudas definitivamente.', 'Groucho Marx');
INSERT INTO frase VALUES (4, 'Disculpen si les llamo caballeros, pero es que no les conozco muy bien.', 'Groucho Marx');
INSERT INTO frase VALUES (5, 'Nunca olvido una cara, pero contigo haré una excepción.', 'Groucho Marx');
INSERT INTO frase VALUES (6, 'La historia es la mentira encuadernada.', ' Jardiel Poncela');
INSERT INTO frase VALUES (7, 'Si dios existe, le voy a pedir cuentas de lo absurdo de la vida, del dolor, de la muerte,de haber dado a unos la razón y a otros la estupidez... y de tantas otras cosas.', ' Leonardo Sciascia');
INSERT INTO frase VALUES (8, 'Estos son mis principios. Si a usted no le gustan, tengo otros.', 'Groucho Marx');
INSERT INTO frase VALUES (9, 'La justicia militar es a la justicia lo que la música militar es a la música.', 'Groucho Marxk');
INSERT INTO frase VALUES (10, 'Recordad que estamos luchando por el honor de esa mujer, lo que probablemente es más de lo que ella hizo jamás. ', 'Groucho Marx');
INSERT INTO frase VALUES (11, '¿Que por qué estaba yo con esa mujer? Porque me recuerda a ti. De hecho, me recuerda a ti más que tú.', 'Groucho Marx');
INSERT INTO frase VALUES (12, 'La experiencia no tiene valor ético alguno, es simplemente el nombre que damos a nuestros errores', 'Oscar Wilde');
INSERT INTO frase VALUES (13, 'Un pesimista es un optimista bien informado.', 'Jean Paul Sartre');
INSERT INTO frase VALUES (14, '¿Es sucio el sexo? Únicamente si se hace bien.', ' Woody Allen');
INSERT INTO frase VALUES (15, 'La última vez que estuve dentro de una mujer fue cuando visité la estatua de la Libertad.', ' Woody Allen');
INSERT INTO frase VALUES (16, ' No piense mal de mí, señorita, mi interés por usted es puramente sexual.', 'Groucho Marx');
INSERT INTO frase VALUES (17, 'El secreto de la vida es la honestidad y el juego limpio, si puedes olvidarte de ellas, lo has conseguido.', 'Groucho Marx');
INSERT INTO frase VALUES (18, 'El que no quiere razonar es un fanático; el que no sabe razonar es un necio; el que no se atreve a razonar es un esclavo.', 'William Drumond');
INSERT INTO frase VALUES (19, 'El hombre puede creer lo imposible, pero jamás creerá lo improbable.', 'Oscar Wilde');
INSERT INTO frase VALUES (20, 'El valor de una idea no tiene nada que ver con la sinceridad del hombre que la expone.', 'Oscar Wilde');
INSERT INTO frase VALUES (21, ' En cuestión de religión, la verdad es simplemente la opinión que ha sobrevivido.', 'Oscar Wilde');
INSERT INTO frase VALUES (22, 'La libertad existe tan solo en la tierra de los sueños.', 'Schiller');
INSERT INTO frase VALUES (23, 'La mejor manera de vivir es darle importancia a todo lo que uno haga y encarar cada tarea, grande o chica, dispuesto a ganar una batalla más.', 'Quino-Mafalda');
INSERT INTO frase VALUES (24, 'Cuando uno no sabe qué decir no sabe cómo decir que no sabe qué decir.', 'Quino-Mafalda');
INSERT INTO frase VALUES (25, '¿Uno va llevando su vida adelante, o la vida se lo lleva por delante a uno?', 'Quino-Mafalda');
INSERT INTO frase VALUES (26, 'Comienza tu día con una sonrisa, verás lo divertido que es ir por ahí desentonando con todo el mundo.', 'Quino-Mafalda');
INSERT INTO frase VALUES (27, '¿Y si antes de empezar lo que hay que hacer empezamos lo que tendríamos que haber hecho?', 'Quino-Mafalda');
INSERT INTO frase VALUES (28, 'Dejaré de amarte, pero no dejaré de amar los momentos en que te amé', '-');
INSERT INTO frase VALUES (29, 'A quién va usted a creer, ¿A mí, o a sus propios ojos?', 'Groucho Marx');
INSERT INTO frase VALUES (30, 'El puede parecer un idiota y actuar como un idiota. Pero no se deje engañar. Es realmente un idiota.', 'Groucho Marx');
INSERT INTO frase VALUES (31, 'Claro que lo entiendo. Incluso un niño de cinco años podría entenderlo. ¡Que me traigan un niño de cinco años!', 'Groucho Marx');
INSERT INTO frase VALUES (32, 'Una mañana me desperté y maté a un elefante en pijama. Me pregunto como pudo ponerse mi pijama.', 'Groucho Marx');
INSERT INTO frase VALUES (33, 'He pasado una noche estupenda. Pero no ha sido esta.', 'Groucho Marx');
INSERT INTO frase VALUES (34, 'O usted se ha muerto o mi reloj se ha parado.', 'Groucho Marx');
INSERT INTO frase VALUES (35, 'El matrimonio es una gran institución. Por supuesto, si te gusta vivir en una institución.', 'Groucho Marx');
INSERT INTO frase VALUES (36, 'La política es el arte de buscar problemas, encontrarlos, hacer un diagnóstico falso y aplicar después los remedios equivocados.', 'Groucho Marx');
INSERT INTO frase VALUES (37, 'Bebo para hacer interesantes a las demás personas.', 'Groucho Marx');
INSERT INTO frase VALUES (38, '¿Servicio de habitaciones? Mándenme una habitación más grande.', 'Groucho Marx');
INSERT INTO frase VALUES (39, 'Consultaré con mi abogado y, si acepta el caso, contrataré a otro.', 'Groucho Marx');
INSERT INTO frase VALUES (40, 'Yo no me vendo barato. Gratis, puede ser. Pero barato nunca.', 'Groucho Marx');
INSERT INTO frase VALUES (41, 'Se necesitan dos años para aprender a hablar y sesenta para callar.', 'Hemingway');
INSERT INTO frase VALUES (42, 'La memoria es un perro estúpido, le tiras un palo y te trae cualquier cosa.', 'Ray Loriga');
INSERT INTO frase VALUES (43, 'La memoria es un perro estúpido, le tiras un palo y te trae cualquier cosa.', 'Ray Loriga');
INSERT INTO frase VALUES (44, 'Matar a un hombre es asesinato. Exterminar un pueblo, un asunto a discutir.', '-');
INSERT INTO frase VALUES (45, 'Si recibe el débil es daño colateral, si recibe el fuerte es terrorismo brutal.', 'Maniatica');
INSERT INTO frase VALUES (46, 'A veces pienso que Dios creando al hombre sobreestimó un poco su habilidad', 'Oscar Wilde');
INSERT INTO frase VALUES (47, 'En el mundo común de los hechos, los malos no son castigados y los buenos recompensados. El éxito se lo llevan los f\r\nuertes y el fracaso los débiles', 'Oscar Wilde');
INSERT INTO frase VALUES (48, 'La experiencia no tiene valor ético alguno, es simplemente el nombre que damos a nuestros errores', 'Oscar Wilde');
INSERT INTO frase VALUES (49, 'Para ti soy un ateo, pero para Dios soy un miembro de la oposición', 'Woody Allen');
INSERT INTO frase VALUES (50, 'Nunca te fies de una mujer que te quiere tal y como eres, es señal de que se conforma con poco', '-');
INSERT INTO frase VALUES (51, 'Modestamente, la televisión no es culpable de nada. Es un espejo en el que nos miramos todos, y al mirarnos nos reflejamos', 'Jaime de Arminín');
INSERT INTO frase VALUES (52, 'No tienes lo que mereces, tienes lo que no puedes esquivar.', 'Ray Loriga');
INSERT INTO frase VALUES (53, 'No tienes lo que mereces, tienes lo que no puedes esquivar.', 'Ray Loriga');
INSERT INTO frase VALUES (54, 'Besos que vienen riendo, luego llorando se van, y en ellos se va\r\nla vida, que nunca más volverá', 'Miguel de Unamuno');
INSERT INTO frase VALUES (55, 'Somos dueños de nuestros silencios y esclavos de nuestras palabras', '-');
INSERT INTO frase VALUES (56, 'Sólo a los árboles que dan frutas les tiran piedras.', '-');
INSERT INTO frase VALUES (57, 'De la independencia de los individuos, depende la grandeza de los pueblos.', 'José Martí\r\n	');
INSERT INTO frase VALUES (58, 'Los hombres ofenden antes al que aman que al que temen.', 'Maquiavelo');
INSERT INTO frase VALUES (59, 'Peores son los odios ocultos que los descubiertos.', 'Séneca');
INSERT INTO frase VALUES (60, 'Sería muy simpático que existiera dios, que hubiese creado el mundo y fuese una benevolente Providencia; que existieran un orden moral en el universo y una vida futura; pero es un hecho muy sorprendente el que todo esto sea exactamente lo que nosotros nos sentimos obligados a desear que exista.', 'Sigmund Freud');
INSERT INTO frase VALUES (61, 'Que Dios me conceda la serenidad para aceptar las cosas que no puedo cambiar, el valor para cambiar las cosas que si puedo y la sabiduría para distinguirlas.', 'Reinhold Niebuhr');
INSERT INTO frase VALUES (62, 'Iglesia, secta, secta, iglesia. Es aburrirse lo mismo pero en sitios diferentes!', 'Bart Simpson');
INSERT INTO frase VALUES (63, 'A veces uno cree que todo va bien, y en realidad le está dando una calada a un cigarro mojado.', 'Almu (Antes muerta que sencilla)');
INSERT INTO frase VALUES (64, 'Cuando el sabio señala la luna el tonto mira al dedo.', '-');
INSERT INTO frase VALUES (65, 'Cada vez iré sintiendo menos y recordando más; pero que es el recuerdo sino el idioma de los sentimientos.', 'Cortázar. Rayela');
INSERT INTO frase VALUES (66, 'No saben que la cacería no tiene fin y no acaba siquiera con la muerte de ese hombre.', 'Morelli');
INSERT INTO frase VALUES (67, 'Supongo que es gente que no ha conseguido desprenderse de sus sueño ni ha conseguido desprenderse de ellos.', 'Ray Loriga');
INSERT INTO frase VALUES (68, 'Si así fue, así pudo ser, si así fuera, así podría ser, pero como no, no es. Eso es lógica', 'Lewis Carrol');
INSERT INTO frase VALUES (69, 'Es más fácil militalirizar un civil que civilizar a un militar.', '-');
INSERT INTO frase VALUES (70, 'El nuevo integrismo no reza otro dios que no sea el color del dinero.', 'H.C');
INSERT INTO frase VALUES (71, 'Las grandes naciones hacen lo que quieren, mientras que las pequeñas hacen lo que deben.', 'Tuclídes');
INSERT INTO frase VALUES (72, 'No critiques a tus enemigos, que a lo mejor aprenden', 'Juan Goytisolo');
INSERT INTO frase VALUES (73, 'El honor no se gana: basta con no perderlo', 'Schopenhauer');
INSERT INTO frase VALUES (74, '- !Lo juro por mi vida ¡ / - Lo juras por bien poco', 'Miguel Bardem (Incautos)');
INSERT INTO frase VALUES (75, '- No sabes una cosa / - Si a mi edad no la he aprendido es que no es importante', 'Miguel Bardem (Incautos)');
INSERT INTO frase VALUES (76, 'El que reclama igualdad de oportunidades acaba exigiendo que se penalice al bien dotado', 'Nicolás Gomez Dávila');
INSERT INTO frase VALUES (77, 'Desconozco si dios existe, pero sería mejor para su reputación que no\r\nexistiera', 'Jules Renard');
INSERT INTO frase VALUES (78, 'las masas las inventó la burguesía para poder ametrallarlas', 'Antonio Machado');
INSERT INTO frase VALUES (79, 'Voy a actuar como si lo que hago sirviera para algo', ' William ¿...?');
INSERT INTO frase VALUES (79, 'No basta saber, se debe también aplicar. No es suficiente querer, se debe también hacer', ' Goethe');


--DROP TABLE template;
CREATE TABLE template (
	id SERIAL,
	descripcion CHAR(100),
	template TEXT NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);


INSERT INTO template (descripcion, template) VALUES ('general', '
<div class="date">
\r\nIncidencia :--id-- de tipo --tipo--. Estado:  <font color="#960">--estado--</font> <br>
</div>\r
<div class="newsItems">\r\<H3><img src="Documentos/Imagenes/lock.gif" border="0" width="27" height="27" alt="">  --descbreve--</H3>\r\n--desclarga--\r\n
<br> <br>\r\n[  <a href="--mensajes--"><img alt="mensajes" title="mensajes" src="Documentos/Imagenes/anotacion.gif" border=0></img>  (--numMens-- mensajes) </a> |  <a href="--detalles--">
<img alt="detalles" title="detalles" src="Documentos/Imagenes/comentario.gif" border=0></img> detalles </a>  ]
<b>Enviada:</b> --dateini--. <b>Actualizada:</b> --dateact--\r\n\r\n</div>\r\n\n
'
);

INSERT INTO template (descripcion, template) VALUES ('correoinci', 
'La incidencia:
 
 --desclarga--.
  
  Ha sido recibida por el sistema, y ha se ha archivado con el identificador --idinci--. Guarde dicho identificador para futuras reclamaciones o consultas. Muchas gracias por su colaboración.
  
 --
 
 La memoria es un perro estúpido, le tiras un palo y te trae cualquier cosa. Ray Loriga.
   
  ');


CREATE TABLE ayuda (
	id INT4,
	descripcion TEXT NOT NULL DEFAULT '',
	PRIMARY KEY (id)
);

INSERT INTO ayuda ( id, descripcion ) VALUES ( 200,'Enviar una incidencia relacionada con el hardware de su equipo habitual, o bien alguno del que sea usuario -impresora, escaner... -' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 201,'Enviar una incidenica relacionada con el software
de su equipo habitual, o bien alguno del que sea usuario.');

INSERT INTO ayuda ( id, descripcion ) VALUES ( 202,'Dar de alta un nuevo usuario que se encuentra a su cargo, por ejemplo un alumno de un proyecto fin de carrera.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 203,'Dar de baja a un usuario existente en el sistema,
y que ya no se encuentra en el departamento, por ejemplo un alumno de proyecto fin de carrera que haya terminado.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 204,'Cambiar el status de un usuario en el sistema. 
Por ejemplo si ha acabado el proyecto, y ha pasado a ser doctorando del departamento.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 205,'Incidencias relacionadas con las llaves, en concreto pedir una copia, o bien devolver la copia de dicha llave.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 206,'Use esta opcion para cualquier incidencia que no pueda ser incluida en alguna de las anteriores.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 207,'El sistema tiene un apartado de archivo, en el 
cual se puden ver todas las incidencias enviadas al sistema. Para ello pude navegar por el 
calendario pulsando sobre los meses. El dia actual aparece en color gris, y los dias con incidencias
enviadas aparecen en naranja. Si pulsa sobre ellos aparece un listado de las incidencias de ese 
dia.' );

INSERT INTO ayuda ( id, descripcion ) VALUES ( 208,'El sistema tiene un filtro de incidencias para
permitirle ver sólo aquellas incidencias que le interesen. Las incidencias pueden estar resueltas, es decir, ya se ha acabado de trabajar en ellas. Interrumpidas, la incidencia no se puede realizar por falta de medios, o de algún dato, en cuyo caso el administrador le habrá enviado algún mensaje al respecto. En curso, es el estado por defecto, la incidencia ha sido recibida y procesada por el sistema, y en breve cambiará de estado.');


INSERT INTO ayuda ( id, descripcion ) VALUES ( 209,'Puede usar PGP para garantizar que la informacion intercambiada con el sistema de incidencias no ha sido manipulada en el camino por una tercera persona. De esta forma puede tener la tranquilidad de que si alguien le pide algún dato personal -contraseñas, direcciones...-, ese alguien es una persona autorizada. Para lograrlo se usa un sistema de clave pública, el que usted debe colaborar usando un gestor de correo que tenga soporte para PGP. Una vez instalado hay que añadir la clave pública al mismo, y el resto se hace de forma automática.');

INSERT INTO ayuda ( id, descripcion ) VALUES ( 210,'Dar de alta una nueva maquina en el departamento, como por ejemplo un portatil de uso personal, que necesite acceso a los datos de la red propia del departamento');

CREATE TABLE tipocable (
        id SERIAL,
        descripcion char(20) NOT NULL DEFAULT 'red',
        PRIMARY KEY (id)
);

INSERT INTO tipocable ( descripcion ) VALUES ( 'red' );
INSERT INTO tipocable ( descripcion ) VALUES ( 'alargador' );
INSERT INTO tipocable ( descripcion ) VALUES ( 'otros' );

CREATE TABLE inci_cables (
        id INT4 REFERENCES incidencia,
        cantidad char (4) NOT NULL,
        tipo INT4 REFERENCES tipocable,
        PRIMARY KEY (id)
);

CREATE TABLE upload (
	id serial,
	name VARCHAR(30) NOT NULL,
	type VARCHAR(100) ,
	size VARCHAR(10) NOT NULL,
	content OID NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE inci_upload (
	id_inci INT4 REFERENCES incidencia,
	id_upload INT4 REFERENCES incidencia,
	PRIMARY KEY (id_inci,id_upload)
);


COMMIT;



