--
-- PostgreSQL database dump
--

-- Dumped from database version 10.2
-- Dumped by pg_dump version 10.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'SQL_ASCII';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = true;

--
-- Name: anotacion; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE anotacion (
    id integer DEFAULT nextval(('"anotacion_id_seq"'::text)::regclass) NOT NULL,
    id_incidencia integer,
    id_usuario integer NOT NULL,
    fecha timestamp with time zone DEFAULT '0001-12-31 23:45:16-00:14:44 BC'::timestamp with time zone NOT NULL,
    texto text DEFAULT ''::text NOT NULL
);


ALTER TABLE anotacion OWNER TO sisifo;

--
-- Name: anotacion_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE anotacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE anotacion_id_seq OWNER TO sisifo;

--
-- Name: ayuda; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE ayuda (
    id integer NOT NULL,
    descripcion text DEFAULT ''::text NOT NULL
);


ALTER TABLE ayuda OWNER TO sisifo;

--
-- Name: estado_inci; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE estado_inci (
    id_estado_in integer DEFAULT nextval(('"estado_inci_id_estado_in_seq"'::text)::regclass) NOT NULL,
    descripcion character varying(20) DEFAULT 'EN CURSO'::character varying NOT NULL
);


ALTER TABLE estado_inci OWNER TO sisifo;

--
-- Name: estado_inci_id_estado_in_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE estado_inci_id_estado_in_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE estado_inci_id_estado_in_seq OWNER TO sisifo;

--
-- Name: frase; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE frase (
    id integer NOT NULL,
    texto character varying(400) DEFAULT ''::character varying NOT NULL,
    autor character(100) DEFAULT ''::bpchar NOT NULL
);


ALTER TABLE frase OWNER TO sisifo;

--
-- Name: inci_alta_maq; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_alta_maq (
    id integer NOT NULL,
    nombre character(30) NOT NULL,
    laboratorio character(20) NOT NULL
);


ALTER TABLE inci_alta_maq OWNER TO sisifo;

--
-- Name: inci_altas; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_altas (
    id integer NOT NULL,
    nombre character(30) NOT NULL,
    apellido character(30) NOT NULL,
    login_s character(30) DEFAULT ''::bpchar NOT NULL,
    correo_con character varying(150) DEFAULT ''::bpchar NOT NULL,
    passwd character(12) DEFAULT ''::bpchar NOT NULL,
    rol integer,
    id_usr character(8) NOT NULL
);


ALTER TABLE inci_altas OWNER TO sisifo;

SET default_with_oids = false;

--
-- Name: inci_audio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE inci_audio (
    id integer NOT NULL,
    descripcion text DEFAULT ''::text NOT NULL
);


ALTER TABLE inci_audio OWNER TO postgres;

SET default_with_oids = true;

--
-- Name: inci_bajas; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_bajas (
    id integer NOT NULL,
    nombre character(30) NOT NULL,
    apellido character(30) NOT NULL,
    login character(30) NOT NULL,
    id_usr character(8) DEFAULT ''::bpchar NOT NULL,
    correo_con character(30) DEFAULT ''::bpchar NOT NULL,
    rol integer NOT NULL
);


ALTER TABLE inci_bajas OWNER TO sisifo;

--
-- Name: inci_cables; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_cables (
    id integer NOT NULL,
    cantidad character(4) NOT NULL,
    tipo integer
);


ALTER TABLE inci_cables OWNER TO sisifo;

--
-- Name: inci_cambiorol; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_cambiorol (
    id integer NOT NULL,
    nombre character(30) NOT NULL,
    apellido character(30) NOT NULL,
    login character(30) NOT NULL,
    rol_ant integer NOT NULL,
    rol_nuevo integer NOT NULL
);


ALTER TABLE inci_cambiorol OWNER TO sisifo;

--
-- Name: inci_cluster; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_cluster (
    id integer NOT NULL,
    descripcion text DEFAULT ''::text NOT NULL
);


ALTER TABLE inci_cluster OWNER TO sisifo;

--
-- Name: inci_hard; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_hard (
    id integer NOT NULL,
    tipo integer,
    id_equipo integer
);


ALTER TABLE inci_hard OWNER TO sisifo;

--
-- Name: inci_llaves; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_llaves (
    id integer NOT NULL,
    laboratorio character(15) DEFAULT ''::bpchar NOT NULL,
    devuelta character(2) DEFAULT 'NO'::bpchar NOT NULL,
    tipo character(15) DEFAULT 'peticion'::bpchar,
    CONSTRAINT inci_llaves_tipo CHECK (((tipo = 'devolucion'::bpchar) OR (tipo = 'peticion'::bpchar)))
);


ALTER TABLE inci_llaves OWNER TO sisifo;

--
-- Name: inci_otras; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_otras (
    id integer NOT NULL,
    descripcion text DEFAULT ''::text NOT NULL
);


ALTER TABLE inci_otras OWNER TO sisifo;

SET default_with_oids = false;

--
-- Name: inci_rf_doc; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE inci_rf_doc (
    id integer NOT NULL,
    tipotrabajo character(17) NOT NULL,
    alumnos text DEFAULT ''::text NOT NULL,
    CONSTRAINT inci_rf_doc_tipotrabajo_check CHECK (((tipotrabajo = 'ASIGNATURA'::bpchar) OR (tipotrabajo = 'PFC'::bpchar) OR (tipotrabajo = 'TESIS DOCTORAL'::bpchar) OR (tipotrabajo = 'TRABAJO DIRIGIDO'::bpchar) OR (tipotrabajo = 'OTROS'::bpchar)))
);


ALTER TABLE inci_rf_doc OWNER TO postgres;

--
-- Name: inci_rf_inves; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE inci_rf_inves (
    id integer NOT NULL,
    tipoinvestigacion character(10) NOT NULL,
    nombreproyecto character varying(100),
    referenciaotr character varying(50),
    directorproyecto character varying(50) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT inci_rf_inves_tipoinvestigacion_check CHECK (((tipoinvestigacion = 'OFICIAL'::bpchar) OR (tipoinvestigacion = 'NO OFICIAL'::bpchar)))
);


ALTER TABLE inci_rf_inves OWNER TO postgres;

SET default_with_oids = true;

--
-- Name: inci_soft; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_soft (
    id integer NOT NULL,
    id_equipo integer,
    tipo integer
);


ALTER TABLE inci_soft OWNER TO sisifo;

SET default_with_oids = false;

--
-- Name: inci_upload; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE inci_upload (
    id_inci integer NOT NULL,
    id_upload integer NOT NULL
);


ALTER TABLE inci_upload OWNER TO sisifo;

SET default_with_oids = true;

--
-- Name: incidencia; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE incidencia (
    id integer DEFAULT nextval(('"incidencia_id_seq"'::text)::regclass) NOT NULL,
    id_estado integer DEFAULT 3,
    fecha_llegada timestamp with time zone DEFAULT '0001-12-31 23:45:16-00:14:44 BC'::timestamp with time zone NOT NULL,
    fecha_resolucion timestamp with time zone DEFAULT '0001-12-31 23:45:16-00:14:44 BC'::timestamp with time zone NOT NULL,
    tipo integer,
    id_usuario integer NOT NULL,
    desc_breve character varying(200) DEFAULT ''::character varying NOT NULL,
    desc_larga text DEFAULT ''::text NOT NULL,
    cc character varying(150)
);


ALTER TABLE incidencia OWNER TO sisifo;

--
-- Name: incidencia_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE incidencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE incidencia_id_seq OWNER TO sisifo;

--
-- Name: list_by_year; Type: VIEW; Schema: public; Owner: dbadmin
--

CREATE VIEW list_by_year AS
 SELECT incidencia.id,
    date_part('year'::text, incidencia.fecha_llegada) AS fecha
   FROM incidencia;


ALTER TABLE list_by_year OWNER TO dbadmin;

--
-- Name: maquina; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE maquina (
    id integer DEFAULT nextval(('"maquina_id_seq"'::text)::regclass) NOT NULL,
    serial character varying(100) DEFAULT '0.0.0.0'::character varying NOT NULL,
    nombre character varying(60) DEFAULT ''::character varying NOT NULL,
    id_lab character varying(20) DEFAULT ''::character varying NOT NULL,
    tipo character(30) DEFAULT 'PC'::bpchar NOT NULL,
    CONSTRAINT maquina_tipo CHECK ((tipo = 'PC'::bpchar))
);


ALTER TABLE maquina OWNER TO sisifo;

--
-- Name: maquina_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE maquina_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE maquina_id_seq OWNER TO sisifo;

--
-- Name: mensaje; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE mensaje (
    id integer DEFAULT nextval(('"mensaje_id_seq"'::text)::regclass) NOT NULL,
    id_incidencia integer,
    de integer NOT NULL,
    a integer NOT NULL,
    fecha timestamp with time zone DEFAULT '0001-12-31 23:45:16-00:14:44 BC'::timestamp with time zone NOT NULL,
    texto text DEFAULT ''::text NOT NULL
);


ALTER TABLE mensaje OWNER TO sisifo;

--
-- Name: mensaje_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE mensaje_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE mensaje_id_seq OWNER TO sisifo;

--
-- Name: min_resolucion; Type: VIEW; Schema: public; Owner: dbadmin
--

CREATE VIEW min_resolucion AS
 SELECT incidencia.id,
    date_part('epoch'::text, ((incidencia.fecha_resolucion - incidencia.fecha_llegada) / (60)::double precision)) AS date_part
   FROM incidencia
  WHERE (incidencia.id_estado = 1);


ALTER TABLE min_resolucion OWNER TO dbadmin;

--
-- Name: rol; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE rol (
    id integer DEFAULT nextval(('"rol_id_seq"'::text)::regclass) NOT NULL,
    rolact character(20) DEFAULT 'proyectando'::bpchar NOT NULL
);


ALTER TABLE rol OWNER TO sisifo;

--
-- Name: rol_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rol_id_seq OWNER TO sisifo;

--
-- Name: template; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE template (
    id integer DEFAULT nextval(('"template_id_seq"'::text)::regclass) NOT NULL,
    descripcion character(100),
    template text DEFAULT ''::text NOT NULL
);


ALTER TABLE template OWNER TO sisifo;

--
-- Name: template_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE template_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE template_id_seq OWNER TO sisifo;

--
-- Name: tipo_hard; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE tipo_hard (
    id integer DEFAULT nextval(('"tipo_hard_id_seq"'::text)::regclass) NOT NULL,
    descripcion character varying(20) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE tipo_hard OWNER TO sisifo;

--
-- Name: tipo_hard_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE tipo_hard_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_hard_id_seq OWNER TO sisifo;

--
-- Name: tipo_incidencia; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE tipo_incidencia (
    id integer DEFAULT nextval(('"tipo_incidencia_id_seq"'::text)::regclass) NOT NULL,
    descripcion character varying(30) DEFAULT ''::character varying NOT NULL,
    tabla character varying(40) DEFAULT 'inci_soft'::character varying NOT NULL
);


ALTER TABLE tipo_incidencia OWNER TO sisifo;

--
-- Name: tipo_incidencia_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE tipo_incidencia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_incidencia_id_seq OWNER TO sisifo;

--
-- Name: tipo_soft; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE tipo_soft (
    id integer DEFAULT nextval(('"tipo_soft_id_seq"'::text)::regclass) NOT NULL,
    descripcion character varying(20) DEFAULT ''::character varying NOT NULL
);


ALTER TABLE tipo_soft OWNER TO sisifo;

--
-- Name: tipo_soft_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE tipo_soft_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipo_soft_id_seq OWNER TO sisifo;

--
-- Name: tipocable; Type: TABLE; Schema: public; Owner: sisifo
--

CREATE TABLE tipocable (
    id integer NOT NULL,
    descripcion character(20) DEFAULT 'red'::bpchar NOT NULL
);


ALTER TABLE tipocable OWNER TO sisifo;

--
-- Name: tipocable_id_seq; Type: SEQUENCE; Schema: public; Owner: sisifo
--

CREATE SEQUENCE tipocable_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tipocable_id_seq OWNER TO sisifo;

--
-- Name: tipocable_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sisifo
--

ALTER SEQUENCE tipocable_id_seq OWNED BY tipocable.id;


SET default_with_oids = false;

--
-- Name: upload; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE upload (
    id integer NOT NULL,
    name character varying(150) NOT NULL,
    type character varying(150),
    size character varying(10) NOT NULL,
    content oid NOT NULL
);


ALTER TABLE upload OWNER TO postgres;

--
-- Name: upload_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE upload_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE upload_id_seq OWNER TO postgres;

--
-- Name: upload_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE upload_id_seq OWNED BY upload.id;


--
-- Name: tipocable id; Type: DEFAULT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY tipocable ALTER COLUMN id SET DEFAULT nextval('tipocable_id_seq'::regclass);


--
-- Name: upload id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY upload ALTER COLUMN id SET DEFAULT nextval('upload_id_seq'::regclass);


--
-- Name: anotacion anotacion_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY anotacion
    ADD CONSTRAINT anotacion_pkey PRIMARY KEY (id);


--
-- Name: ayuda ayuda_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY ayuda
    ADD CONSTRAINT ayuda_pkey PRIMARY KEY (id);


--
-- Name: estado_inci estado_inci_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY estado_inci
    ADD CONSTRAINT estado_inci_pkey PRIMARY KEY (id_estado_in);


--
-- Name: frase frase_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY frase
    ADD CONSTRAINT frase_pkey PRIMARY KEY (id);


--
-- Name: inci_alta_maq inci_alta_maq_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_alta_maq
    ADD CONSTRAINT inci_alta_maq_pkey PRIMARY KEY (id);


--
-- Name: inci_altas inci_altas_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_altas
    ADD CONSTRAINT inci_altas_pkey PRIMARY KEY (id);


--
-- Name: inci_audio inci_audio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_audio
    ADD CONSTRAINT inci_audio_pkey PRIMARY KEY (id);


--
-- Name: inci_bajas inci_bajas_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_bajas
    ADD CONSTRAINT inci_bajas_pkey PRIMARY KEY (id);


--
-- Name: inci_cables inci_cables_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cables
    ADD CONSTRAINT inci_cables_pkey PRIMARY KEY (id);


--
-- Name: inci_cambiorol inci_cambiorol_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cambiorol
    ADD CONSTRAINT inci_cambiorol_pkey PRIMARY KEY (id);


--
-- Name: inci_cluster inci_cluster_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cluster
    ADD CONSTRAINT inci_cluster_pkey PRIMARY KEY (id);


--
-- Name: inci_hard inci_hard_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_hard
    ADD CONSTRAINT inci_hard_pkey PRIMARY KEY (id);


--
-- Name: inci_llaves inci_llaves_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_llaves
    ADD CONSTRAINT inci_llaves_pkey PRIMARY KEY (id);


--
-- Name: inci_otras inci_otras_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_otras
    ADD CONSTRAINT inci_otras_pkey PRIMARY KEY (id);


--
-- Name: inci_rf_doc inci_rf_doc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_rf_doc
    ADD CONSTRAINT inci_rf_doc_pkey PRIMARY KEY (id);


--
-- Name: inci_rf_inves inci_rf_inves_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_rf_inves
    ADD CONSTRAINT inci_rf_inves_pkey PRIMARY KEY (id);


--
-- Name: inci_soft inci_soft_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_soft
    ADD CONSTRAINT inci_soft_pkey PRIMARY KEY (id);


--
-- Name: inci_upload inci_upload_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_upload
    ADD CONSTRAINT inci_upload_pkey PRIMARY KEY (id_inci, id_upload);


--
-- Name: incidencia incidencia_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY incidencia
    ADD CONSTRAINT incidencia_pkey PRIMARY KEY (id);


--
-- Name: maquina maquina_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY maquina
    ADD CONSTRAINT maquina_pkey PRIMARY KEY (id);


--
-- Name: mensaje mensaje_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY mensaje
    ADD CONSTRAINT mensaje_pkey PRIMARY KEY (id);


--
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id);


--
-- Name: template template_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY template
    ADD CONSTRAINT template_pkey PRIMARY KEY (id);


--
-- Name: tipo_hard tipo_hard_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY tipo_hard
    ADD CONSTRAINT tipo_hard_pkey PRIMARY KEY (id);


--
-- Name: tipo_incidencia tipo_incidencia_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY tipo_incidencia
    ADD CONSTRAINT tipo_incidencia_pkey PRIMARY KEY (id);


--
-- Name: tipo_soft tipo_soft_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY tipo_soft
    ADD CONSTRAINT tipo_soft_pkey PRIMARY KEY (id);


--
-- Name: tipocable tipocable_pkey; Type: CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY tipocable
    ADD CONSTRAINT tipocable_pkey PRIMARY KEY (id);


--
-- Name: upload upload_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY upload
    ADD CONSTRAINT upload_pkey PRIMARY KEY (id);


--
-- Name: anotacion anotacion_id_incidencia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY anotacion
    ADD CONSTRAINT anotacion_id_incidencia_fkey FOREIGN KEY (id_incidencia) REFERENCES incidencia(id);


--
-- Name: inci_alta_maq inci_alta_maq_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_alta_maq
    ADD CONSTRAINT inci_alta_maq_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_altas inci_altas_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_altas
    ADD CONSTRAINT inci_altas_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_altas inci_altas_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_altas
    ADD CONSTRAINT inci_altas_rol_fkey FOREIGN KEY (rol) REFERENCES rol(id);


--
-- Name: inci_audio inci_audio_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_audio
    ADD CONSTRAINT inci_audio_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_bajas inci_bajas_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_bajas
    ADD CONSTRAINT inci_bajas_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_bajas inci_bajas_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_bajas
    ADD CONSTRAINT inci_bajas_rol_fkey FOREIGN KEY (rol) REFERENCES rol(id);


--
-- Name: inci_cables inci_cables_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cables
    ADD CONSTRAINT inci_cables_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_cables inci_cables_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cables
    ADD CONSTRAINT inci_cables_tipo_fkey FOREIGN KEY (tipo) REFERENCES tipocable(id);


--
-- Name: inci_cambiorol inci_cambiorol_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cambiorol
    ADD CONSTRAINT inci_cambiorol_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_cambiorol inci_cambiorol_rol_ant_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cambiorol
    ADD CONSTRAINT inci_cambiorol_rol_ant_fkey FOREIGN KEY (rol_ant) REFERENCES rol(id);


--
-- Name: inci_cambiorol inci_cambiorol_rol_nuevo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cambiorol
    ADD CONSTRAINT inci_cambiorol_rol_nuevo_fkey FOREIGN KEY (rol_nuevo) REFERENCES rol(id);


--
-- Name: inci_cluster inci_cluster_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_cluster
    ADD CONSTRAINT inci_cluster_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_hard inci_hard_id_equipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_hard
    ADD CONSTRAINT inci_hard_id_equipo_fkey FOREIGN KEY (id_equipo) REFERENCES maquina(id);


--
-- Name: inci_hard inci_hard_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_hard
    ADD CONSTRAINT inci_hard_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_hard inci_hard_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_hard
    ADD CONSTRAINT inci_hard_tipo_fkey FOREIGN KEY (tipo) REFERENCES tipo_hard(id);


--
-- Name: inci_llaves inci_llaves_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_llaves
    ADD CONSTRAINT inci_llaves_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_otras inci_otras_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_otras
    ADD CONSTRAINT inci_otras_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_rf_doc inci_rf_doc_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_rf_doc
    ADD CONSTRAINT inci_rf_doc_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_rf_inves inci_rf_inves_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY inci_rf_inves
    ADD CONSTRAINT inci_rf_inves_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_soft inci_soft_id_equipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_soft
    ADD CONSTRAINT inci_soft_id_equipo_fkey FOREIGN KEY (id_equipo) REFERENCES maquina(id);


--
-- Name: inci_soft inci_soft_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_soft
    ADD CONSTRAINT inci_soft_id_fkey FOREIGN KEY (id) REFERENCES incidencia(id);


--
-- Name: inci_soft inci_soft_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_soft
    ADD CONSTRAINT inci_soft_tipo_fkey FOREIGN KEY (tipo) REFERENCES tipo_soft(id);


--
-- Name: inci_upload inci_upload_id_inci_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_upload
    ADD CONSTRAINT inci_upload_id_inci_fkey FOREIGN KEY (id_inci) REFERENCES incidencia(id);


--
-- Name: inci_upload inci_upload_id_upload_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY inci_upload
    ADD CONSTRAINT inci_upload_id_upload_fkey FOREIGN KEY (id_upload) REFERENCES incidencia(id);


--
-- Name: incidencia incidencia_id_estado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY incidencia
    ADD CONSTRAINT incidencia_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES estado_inci(id_estado_in);


--
-- Name: incidencia incidencia_tipo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY incidencia
    ADD CONSTRAINT incidencia_tipo_fkey FOREIGN KEY (tipo) REFERENCES tipo_incidencia(id);


--
-- Name: mensaje mensaje_id_incidencia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sisifo
--

ALTER TABLE ONLY mensaje
    ADD CONSTRAINT mensaje_id_incidencia_fkey FOREIGN KEY (id_incidencia) REFERENCES incidencia(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO sisifo;


--
-- PostgreSQL database dump complete
--

