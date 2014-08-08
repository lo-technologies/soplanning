--
-- PostgreSQL database dump
--
SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;

--
-- Name: planning_ferie; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_ferie (
    date_ferie date NOT NULL,
    libelle character varying(20)
);
ALTER TABLE public.planning_ferie OWNER TO soplanning;

--
-- Name: planning_groupe; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_groupe (
    groupe_id integer NOT NULL,
    nom character varying(30) NOT NULL,
    ordre integer
);
ALTER TABLE public.planning_groupe OWNER TO soplanning;

--
-- Name: planning_periode; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_periode (
    periode_id integer NOT NULL,
    projet_id character varying(5) NOT NULL,
    user_id character(3) NOT NULL,
    date_debut date NOT NULL,
    date_fin date,
    duree integer,
    notes text,
    lien text
);
ALTER TABLE public.planning_periode OWNER TO soplanning;

--
-- Name: planning_periode_periode_id_seq; Type: SEQUENCE; Schema: public; Owner: soplanning
--
CREATE SEQUENCE planning_periode_periode_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;
ALTER TABLE public.planning_periode_periode_id_seq OWNER TO soplanning;

--
-- Name: planning_periode_periode_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: soplanning
--
ALTER SEQUENCE planning_periode_periode_id_seq OWNED BY planning_periode.periode_id;

--
-- Name: planning_periode_periode_id_seq; Type: SEQUENCE SET; Schema: public; Owner: soplanning
--
SELECT pg_catalog.setval('planning_periode_periode_id_seq', 1, false);

--
-- Name: planning_projet; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_projet (
    projet_id character varying(5) NOT NULL,
    nom character varying(30) NOT NULL,
    iteration character varying(30),
    couleur character varying(6) NOT NULL,
    charge double precision,
    livraison date,
    groupe_id integer,
    statut character varying NOT NULL
);
ALTER TABLE public.planning_projet OWNER TO soplanning;

--
-- Name: planning_user; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_user (
    nom character varying(50) NOT NULL,
    user_id character varying(3) NOT NULL,
    login character varying(20),
    password character varying(20),
    droit_planification character(3) NOT NULL,
    visible_planning character(3) NOT NULL,
    couleur character(6)
);
ALTER TABLE public.planning_user OWNER TO soplanning;

--
-- Name: planning_options; Type: TABLE; Schema: public; Owner: soplanning; Tablespace: 
--
CREATE TABLE planning_options (
	TODO
);
ALTER TABLE public.planning_options OWNER TO soplanning;

--
-- Name: periode_id; Type: DEFAULT; Schema: public; Owner: soplanning
--
ALTER TABLE planning_periode ALTER COLUMN periode_id SET DEFAULT nextval('planning_periode_periode_id_seq'::regclass);

--
-- Name: planning_ferie_pkey; Type: CONSTRAINT; Schema: public; Owner: soplanning; Tablespace: 
--
ALTER TABLE ONLY planning_ferie ADD CONSTRAINT planning_ferie_pkey PRIMARY KEY (date_ferie);

--
-- Name: planning_groupe_pkey; Type: CONSTRAINT; Schema: public; Owner: soplanning; Tablespace: 
--

ALTER TABLE ONLY planning_groupe ADD CONSTRAINT planning_groupe_pkey PRIMARY KEY (groupe_id);

--
-- Name: planning_periode_pkey; Type: CONSTRAINT; Schema: public; Owner: soplanning; Tablespace: 
--
ALTER TABLE ONLY planning_periode ADD CONSTRAINT planning_periode_pkey PRIMARY KEY (periode_id);

--
-- Name: planning_projet_pkey; Type: CONSTRAINT; Schema: public; Owner: soplanning; Tablespace: 
--
ALTER TABLE ONLY planning_projet ADD CONSTRAINT planning_projet_pkey PRIMARY KEY (projet_id);

--
-- Name: planning_user_pkey; Type: CONSTRAINT; Schema: public; Owner: soplanning; Tablespace: 
--
ALTER TABLE ONLY planning_user ADD CONSTRAINT planning_user_pkey PRIMARY KEY (user_id);

--
-- Name: planning_periode_projet_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: soplanning
--
ALTER TABLE ONLY planning_periode ADD CONSTRAINT planning_periode_projet_id_fkey FOREIGN KEY (projet_id) REFERENCES planning_projet(projet_id) ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Name: planning_periode_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: soplanning
--
ALTER TABLE ONLY planning_periode ADD CONSTRAINT planning_periode_user_id_fkey FOREIGN KEY (user_id) REFERENCES planning_user(user_id) ON UPDATE CASCADE ON DELETE CASCADE;

--
-- Name: planning_projet_groupe_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: soplanning
--
ALTER TABLE ONLY planning_projet ADD CONSTRAINT planning_projet_groupe_id_fkey FOREIGN KEY (groupe_id) REFERENCES planning_groupe(groupe_id) ON UPDATE CASCADE ON DELETE SET NULL;

--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--
REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;

--
-- PostgreSQL database dump complete
--
INSERT INTO planning_user VALUES ('admin', 'ADM', 'admin', 'admin', 'oui', 'oui', 'black');