--
-- PostgreSQL database dump
--

-- Dumped from database version 17.1 (Ubuntu 17.1-1.pgdg22.04+1)
-- Dumped by pg_dump version 17.1 (Ubuntu 17.1-1.pgdg22.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: log_data; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.log_data (
    id bigint NOT NULL,
    id_sensor integer,
    value numeric,
    "time" timestamp without time zone
);


ALTER TABLE public.log_data OWNER TO gsi_admin;

--
-- Name: log_data_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.log_data_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.log_data_id_seq OWNER TO gsi_admin;

--
-- Name: log_data_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.log_data_id_seq OWNED BY public.log_data.id;


--
-- Name: lokasi; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.lokasi (
    id bigint NOT NULL,
    id_vendor integer NOT NULL,
    nama_lokasi character varying(255),
    slug character varying(255),
    foto character varying(255) DEFAULT 'default.jpg'::character varying,
    long character varying(255),
    lat character varying(255),
    "isDeleted" integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.lokasi OWNER TO gsi_admin;

--
-- Name: lokasi_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.lokasi_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lokasi_id_seq OWNER TO gsi_admin;

--
-- Name: lokasi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.lokasi_id_seq OWNED BY public.lokasi.id;


--
-- Name: nat_freq; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.nat_freq (
    id bigint NOT NULL,
    station_id character varying(255),
    value numeric,
    "time" timestamp without time zone
);


ALTER TABLE public.nat_freq OWNER TO gsi_admin;

--
-- Name: nat_freq_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.nat_freq_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.nat_freq_id_seq OWNER TO gsi_admin;

--
-- Name: nat_freq_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.nat_freq_id_seq OWNED BY public.nat_freq.id;


--
-- Name: parameter; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.parameter (
    id bigint NOT NULL,
    nama_parameter character varying(255),
    batas_bawah character varying(255),
    batas_atas character varying(255),
    satuan character varying(255),
    "isDeleted" integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.parameter OWNER TO gsi_admin;

--
-- Name: parameter_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.parameter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.parameter_id_seq OWNER TO gsi_admin;

--
-- Name: parameter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.parameter_id_seq OWNED BY public.parameter.id;


--
-- Name: processed_messages; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.processed_messages (
    message_id text NOT NULL
);


ALTER TABLE public.processed_messages OWNER TO gsi_admin;

--
-- Name: rawdata_sensor; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.rawdata_sensor (
    id integer NOT NULL,
    version character varying(20),
    send_time timestamp without time zone,
    station_id character varying(20),
    dynamic_data jsonb
);


ALTER TABLE public.rawdata_sensor OWNER TO gsi_admin;

--
-- Name: rawdata_sensor_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.rawdata_sensor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.rawdata_sensor_id_seq OWNER TO gsi_admin;

--
-- Name: rawdata_sensor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.rawdata_sensor_id_seq OWNED BY public.rawdata_sensor.id;


--
-- Name: sensor; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.sensor (
    id bigint NOT NULL,
    id_span integer,
    id_parameter integer,
    satuan character varying(255),
    batas_bawah character varying(255),
    batas_atas character varying(255),
    "isDeleted" integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    nama_sensor character varying(255)
);


ALTER TABLE public.sensor OWNER TO gsi_admin;

--
-- Name: sensor_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.sensor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sensor_id_seq OWNER TO gsi_admin;

--
-- Name: sensor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.sensor_id_seq OWNED BY public.sensor.id;


--
-- Name: span; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.span (
    id bigint NOT NULL,
    id_lokasi integer,
    nama_span character varying(255),
    foto character varying(255) DEFAULT 'default.jpg'::character varying,
    "isDeleted" integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone,
    "stationId" character varying(255),
    x_position character varying(255),
    y_position character varying(255)
);


ALTER TABLE public.span OWNER TO gsi_admin;

--
-- Name: span_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.span_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.span_id_seq OWNER TO gsi_admin;

--
-- Name: span_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.span_id_seq OWNED BY public.span.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp without time zone,
    password character varying(255) NOT NULL,
    id_vendor integer,
    role character varying(255) NOT NULL,
    "isDeleted" integer DEFAULT 0 NOT NULL,
    remember_token character varying,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.users OWNER TO gsi_admin;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO gsi_admin;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: vendor; Type: TABLE; Schema: public; Owner: gsi_admin
--

CREATE TABLE public.vendor (
    id bigint NOT NULL,
    nama_vendor character varying(255),
    slug character varying(255),
    foto character varying(255) DEFAULT 'default.jpeg'::character varying,
    "isDeleted" integer DEFAULT 0 NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public.vendor OWNER TO gsi_admin;

--
-- Name: vendor_id_seq; Type: SEQUENCE; Schema: public; Owner: gsi_admin
--

CREATE SEQUENCE public.vendor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vendor_id_seq OWNER TO gsi_admin;

--
-- Name: vendor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: gsi_admin
--

ALTER SEQUENCE public.vendor_id_seq OWNED BY public.vendor.id;


--
-- Name: log_data id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.log_data ALTER COLUMN id SET DEFAULT nextval('public.log_data_id_seq'::regclass);


--
-- Name: lokasi id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.lokasi ALTER COLUMN id SET DEFAULT nextval('public.lokasi_id_seq'::regclass);


--
-- Name: nat_freq id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.nat_freq ALTER COLUMN id SET DEFAULT nextval('public.nat_freq_id_seq'::regclass);


--
-- Name: parameter id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.parameter ALTER COLUMN id SET DEFAULT nextval('public.parameter_id_seq'::regclass);


--
-- Name: rawdata_sensor id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.rawdata_sensor ALTER COLUMN id SET DEFAULT nextval('public.rawdata_sensor_id_seq'::regclass);


--
-- Name: sensor id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.sensor ALTER COLUMN id SET DEFAULT nextval('public.sensor_id_seq'::regclass);


--
-- Name: span id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.span ALTER COLUMN id SET DEFAULT nextval('public.span_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: vendor id; Type: DEFAULT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.vendor ALTER COLUMN id SET DEFAULT nextval('public.vendor_id_seq'::regclass);


--
-- Name: log_data log_data_pkey; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.log_data
    ADD CONSTRAINT log_data_pkey PRIMARY KEY (id);


--
-- Name: processed_messages processed_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.processed_messages
    ADD CONSTRAINT processed_messages_pkey PRIMARY KEY (message_id);


--
-- Name: rawdata_sensor rawdata_sensor_pkey; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.rawdata_sensor
    ADD CONSTRAINT rawdata_sensor_pkey PRIMARY KEY (id);


--
-- Name: lokasi unique_lokasi_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.lokasi
    ADD CONSTRAINT unique_lokasi_id PRIMARY KEY (id);


--
-- Name: nat_freq unique_nat_freq_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.nat_freq
    ADD CONSTRAINT unique_nat_freq_id PRIMARY KEY (id);


--
-- Name: parameter unique_parameter_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.parameter
    ADD CONSTRAINT unique_parameter_id PRIMARY KEY (id);


--
-- Name: sensor unique_sensor_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.sensor
    ADD CONSTRAINT unique_sensor_id PRIMARY KEY (id);


--
-- Name: span unique_span_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.span
    ADD CONSTRAINT unique_span_id PRIMARY KEY (id);


--
-- Name: users unique_users_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT unique_users_id PRIMARY KEY (id);


--
-- Name: vendor unique_vendor_id; Type: CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.vendor
    ADD CONSTRAINT unique_vendor_id PRIMARY KEY (id);


--
-- Name: fki_fk_idspan; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX fki_fk_idspan ON public.sensor USING btree (id_span);


--
-- Name: index_email; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX index_email ON public.users USING btree (email);


--
-- Name: log_data_time_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX log_data_time_idx ON public.log_data USING btree ("time");


--
-- Name: lokasi_id_vendor_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX lokasi_id_vendor_idx ON public.lokasi USING btree (id_vendor);


--
-- Name: lokasi_slug_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX lokasi_slug_idx ON public.lokasi USING btree (slug);


--
-- Name: sensor_isDeleted_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX "sensor_isDeleted_idx" ON public.sensor USING btree ("isDeleted");


--
-- Name: sensor_nama_sensor_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX sensor_nama_sensor_idx ON public.sensor USING btree (nama_sensor);


--
-- Name: span_stationId_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX "span_stationId_idx" ON public.span USING btree ("stationId");


--
-- Name: vendor_slug_idx; Type: INDEX; Schema: public; Owner: gsi_admin
--

CREATE INDEX vendor_slug_idx ON public.vendor USING btree (slug);


--
-- Name: sensor fk_idspan; Type: FK CONSTRAINT; Schema: public; Owner: gsi_admin
--

ALTER TABLE ONLY public.sensor
    ADD CONSTRAINT fk_idspan FOREIGN KEY (id_span) REFERENCES public.span(id) MATCH FULL DEFERRABLE INITIALLY DEFERRED;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

GRANT USAGE ON SCHEMA public TO readonly;


--
-- Name: TABLE log_data; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.log_data TO readonly;


--
-- Name: SEQUENCE log_data_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.log_data_id_seq TO readonly;


--
-- Name: TABLE lokasi; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.lokasi TO readonly;


--
-- Name: SEQUENCE lokasi_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.lokasi_id_seq TO readonly;


--
-- Name: TABLE nat_freq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.nat_freq TO readonly;


--
-- Name: SEQUENCE nat_freq_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.nat_freq_id_seq TO readonly;


--
-- Name: TABLE parameter; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.parameter TO readonly;


--
-- Name: SEQUENCE parameter_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.parameter_id_seq TO readonly;


--
-- Name: TABLE processed_messages; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.processed_messages TO readonly;


--
-- Name: TABLE rawdata_sensor; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.rawdata_sensor TO readonly;


--
-- Name: SEQUENCE rawdata_sensor_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.rawdata_sensor_id_seq TO readonly;


--
-- Name: TABLE sensor; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.sensor TO readonly;


--
-- Name: SEQUENCE sensor_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.sensor_id_seq TO readonly;


--
-- Name: TABLE span; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.span TO readonly;


--
-- Name: SEQUENCE span_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.span_id_seq TO readonly;


--
-- Name: TABLE users; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.users TO readonly;


--
-- Name: SEQUENCE users_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.users_id_seq TO readonly;


--
-- Name: TABLE vendor; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON TABLE public.vendor TO readonly;


--
-- Name: SEQUENCE vendor_id_seq; Type: ACL; Schema: public; Owner: gsi_admin
--

GRANT ALL ON SEQUENCE public.vendor_id_seq TO readonly;


--
-- Name: DEFAULT PRIVILEGES FOR SEQUENCES; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT SELECT,USAGE ON SEQUENCES TO gsi_admin;
ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT SELECT ON SEQUENCES TO readonly;


--
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT SELECT,INSERT,DELETE,UPDATE ON TABLES TO gsi_admin;
ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT SELECT ON TABLES TO readonly;


--
-- PostgreSQL database dump complete
--

-- Partial data dump (100 rows per table)
id,id_sensor,value,time
668,2,-0.030446,2023-12-26 02:24:11.857
669,1,0.000577,2023-12-26 02:24:11.857
670,2,-0.062575,2023-12-26 02:24:12.856
671,1,0.000488,2023-12-26 02:24:12.856
672,2,-0.049578,2023-12-26 02:24:13.855
673,1,-0.000440,2023-12-26 02:24:13.855
674,2,-0.067579,2023-12-26 02:24:14.856
675,1,0.000463,2023-12-26 02:24:14.856
676,2,-0.091965,2023-12-26 02:24:15.856
677,1,-0.000459,2023-12-26 02:24:15.856
678,2,0.079091,2023-12-26 02:24:16.855
679,1,-0.000440,2023-12-26 02:24:16.855
680,2,-0.085798,2023-12-26 02:24:17.856
681,1,-0.000383,2023-12-26 02:24:17.856
682,2,0.058357,2023-12-26 02:24:18.856
683,1,-0.000440,2023-12-26 02:24:18.856
684,2,-0.042343,2023-12-26 02:24:19.855
685,1,0.000495,2023-12-26 02:24:19.855
686,2,-0.044804,2023-12-26 02:24:20.856
687,1,-0.000389,2023-12-26 02:24:20.856
688,2,0.044553,2023-12-26 02:24:21.856
689,1,-0.000389,2023-12-26 02:24:21.856
690,2,0.056247,2023-12-26 02:24:22.855
691,1,-0.000376,2023-12-26 02:24:22.855
692,2,0.058039,2023-12-26 02:24:23.856
693,1,-0.000478,2023-12-26 02:24:23.856
694,2,0.059381,2023-12-26 02:24:24.856
695,1,0.000590,2023-12-26 02:24:24.856
696,2,-0.047390,2023-12-26 02:24:25.855
697,1,-0.000427,2023-12-26 02:24:25.855
698,2,0.047483,2023-12-26 02:24:26.856
699,1,-0.000561,2023-12-26 02:24:26.856
700,2,-0.033471,2023-12-26 02:24:27.856
701,1,-0.000523,2023-12-26 02:24:27.856
702,2,-0.035673,2023-12-26 02:24:28.855
703,1,-0.000332,2023-12-26 02:24:28.855
704,2,-0.045879,2023-12-26 02:24:29.856
705,1,-0.000535,2023-12-26 02:24:29.856
706,2,0.060713,2023-12-26 02:24:30.856
707,1,-0.000504,2023-12-26 02:24:30.856
708,2,0.050638,2023-12-26 02:24:31.855
709,1,-0.000504,2023-12-26 02:24:31.855
710,2,0.036803,2023-12-26 02:24:32.856
711,1,0.000507,2023-12-26 02:24:32.856
712,2,-0.045818,2023-12-26 02:24:33.856
713,1,-0.000389,2023-12-26 02:24:33.856
714,2,0.035979,2023-12-26 02:24:34.855
715,1,-0.000351,2023-12-26 02:24:34.855
716,2,-0.035154,2023-12-26 02:24:35.856
717,1,-0.000484,2023-12-26 02:24:35.856
718,2,0.043540,2023-12-26 02:24:36.856
719,1,-0.000465,2023-12-26 02:24:36.856
720,2,-0.037871,2023-12-26 02:24:37.855
721,1,-0.000440,2023-12-26 02:24:37.855
722,2,0.027732,2023-12-26 02:24:38.856
723,1,-0.000465,2023-12-26 02:24:38.856
724,2,0.032598,2023-12-26 02:24:39.856
725,1,-0.000459,2023-12-26 02:24:39.856
726,2,-0.037702,2023-12-26 02:24:40.855
727,1,-0.000446,2023-12-26 02:24:40.855
728,2,0.037666,2023-12-26 02:24:41.856
729,1,-0.000421,2023-12-26 02:24:41.856
730,2,-0.039894,2023-12-26 02:24:42.856
731,1,-0.000446,2023-12-26 02:24:42.856
732,2,-0.034602,2023-12-26 02:24:43.855
733,1,-0.000408,2023-12-26 02:24:43.855
734,2,0.034637,2023-12-26 02:24:44.856
735,1,0.000431,2023-12-26 02:24:44.856
736,2,0.044440,2023-12-26 02:24:45.856
737,1,-0.000529,2023-12-26 02:24:45.856
738,2,0.039641,2023-12-26 02:24:46.855
739,1,0.000457,2023-12-26 02:24:46.855
740,2,-0.053680,2023-12-26 02:24:47.856
741,1,-0.000465,2023-12-26 02:24:47.856
742,2,-0.039408,2023-12-26 02:24:48.857
743,1,0.000476,2023-12-26 02:24:48.857
744,2,-0.069825,2023-12-26 02:24:49.855
745,1,-0.000491,2023-12-26 02:24:49.855
746,2,0.034419,2023-12-26 02:24:50.856
747,1,-0.000440,2023-12-26 02:24:50.856
748,2,0.033528,2023-12-26 02:24:51.856
749,1,-0.000510,2023-12-26 02:24:51.856
750,2,-0.038917,2023-12-26 02:24:52.855
751,1,-0.000453,2023-12-26 02:24:52.855
752,2,-0.038542,2023-12-26 02:24:53.856
753,1,0.000399,2023-12-26 02:24:53.856
754,2,0.033773,2023-12-26 02:24:54.856
755,1,-0.000440,2023-12-26 02:24:54.856
756,2,-0.055336,2023-12-26 02:24:55.855
757,1,-0.000395,2023-12-26 02:24:55.855
758,2,-0.039749,2023-12-26 02:24:56.856
759,1,-0.000491,2023-12-26 02:24:56.856
760,2,0.048341,2023-12-26 02:24:57.856
761,1,0.000558,2023-12-26 02:24:57.856
762,2,-0.051646,2023-12-26 02:24:58.855
763,1,-0.000529,2023-12-26 02:24:58.855
764,2,-0.037778,2023-12-26 02:24:59.856
765,1,0.000514,2023-12-26 02:24:59.856
766,2,0.037217,2023-12-26 02:25:00.856
767,1,-0.000440,2023-12-26 02:25:00.856
id,station_id,value,time
1,S40000,2.102,2023-12-26 10:00:00
1506,S40000,4.4921875,2024-10-27 03:00:00
1507,S40000,5.3710938,2024-10-27 04:00:00
1508,S40000,4.3457031,2024-10-27 05:00:00
1509,S40000,2.1972656,2024-10-27 06:00:00
1510,S40000,4.6875000,2024-10-27 07:00:00
1511,S40000,5.9082031,2024-10-27 08:00:00
1512,S40000,3.2714844,2024-10-27 09:00:00
1513,S40000,4.3945312,2024-10-27 10:00:00
2,S40000,3.132,2023-12-26 11:00:00
3,S40000,2.501,2023-12-26 12:00:00
4,S40000,4.107,2023-12-26 13:00:00
5,S40000,3.872,2023-12-26 14:00:00
6,S40000,2.842,2023-12-26 15:00:00
7,S40000,3.211,2023-12-26 16:00:00
8,S40000,2.121,2023-11-01 02:00:00
9,S40000,2.121,2023-11-01 01:00:00
10,S40000,2.121,2023-11-01 00:00:00
11,S40000,2.121,2023-10-31 23:00:00
12,S40000,2.121,2023-10-31 22:00:00
13,S40000,2.121,2023-10-31 21:00:00
14,S40000,2.121,2023-10-31 20:00:00
15,S40000,2.121,2023-10-31 19:00:00
16,S40000,2.121,2023-10-31 18:00:00
17,S40000,2.121,2023-10-31 17:00:00
18,S40000,2.121,2023-10-31 16:00:00
19,S40000,2.121,2023-10-31 15:00:00
20,S40000,2.121,2023-11-01 02:00:00
21,S40000,2.121,2023-11-01 01:00:00
22,S40000,2.121,2023-11-01 00:00:00
23,S40000,2.121,2023-10-31 23:00:00
24,S40000,2.121,2023-10-31 22:00:00
25,S40000,2.121,2023-10-31 21:00:00
26,S40000,2.121,2023-10-31 20:00:00
27,S40000,2.121,2023-10-31 19:00:00
28,S40000,2.121,2023-10-31 18:00:00
29,S40000,2.121,2023-10-31 17:00:00
30,S40000,2.121,2023-10-31 16:00:00
31,S40000,2.121,2023-10-31 15:00:00
32,S40000,2.121,2024-08-03 02:00:00
33,S40000,2.121,2024-08-03 01:00:00
34,S40000,2.121,2024-08-03 00:00:00
35,S40000,2.121,2024-08-02 23:00:00
36,S40000,2.121,2024-08-02 22:00:00
37,S40000,2.121,2024-08-02 21:00:00
38,S40000,2.121,2024-08-02 20:00:00
39,S40000,2.121,2024-08-02 19:00:00
40,S40000,2.121,2024-08-02 18:00:00
41,S40000,2.121,2024-08-02 17:00:00
42,S40000,2.121,2024-08-02 15:00:00
43,S40000,2.121,2024-08-03 02:00:00
44,S40000,2.121,2024-08-03 01:00:00
45,S40000,2.121,2024-08-03 00:00:00
46,S40000,2.121,2024-08-02 23:00:00
47,S40000,2.121,2024-08-02 22:00:00
48,S40000,2.121,2024-08-02 21:00:00
49,S40000,2.121,2024-08-02 20:00:00
50,S40000,2.121,2024-08-02 19:00:00
51,S40000,2.121,2024-08-02 18:00:00
52,S40000,2.121,2024-08-02 17:00:00
53,S40000,2.121,2024-08-02 15:00:00
54,S40000,2.4902344,2024-08-12 15:00:00
55,S40000,5.5664062,2024-08-12 16:00:00
56,S40000,2.5390625,2024-08-12 17:00:00
57,S40000,2.5878906,2024-08-12 18:00:00
58,S40000,3.1738281,2024-08-12 19:00:00
59,S40000,2.3437500,2024-08-12 20:00:00
60,S40000,2.0507812,2024-08-12 21:00:00
61,S40000,4.8828125,2024-08-12 22:00:00
62,S40000,4.4921875,2024-08-12 23:00:00
63,S40000,5.3222656,2024-08-13 00:00:00
64,S40000,4.0039062,2024-08-13 01:00:00
65,S40000,2.0507812,2024-08-13 02:00:00
66,S40000,5.1269531,2024-08-16 03:00:00
67,S40000,4.0527344,2024-08-16 04:00:00
68,S40000,4.9316406,2024-08-16 05:00:00
69,S40000,4.8828125,2024-08-16 06:00:00
70,S40000,3.7109375,2024-08-16 07:00:00
71,S40000,4.7363281,2024-08-16 08:00:00
72,S40000,5.8593750,2024-08-16 09:00:00
73,S40000,4.2968750,2024-08-16 10:00:00
74,S40000,3.1250000,2024-08-16 11:00:00
75,S40000,3.1738281,2024-08-16 12:00:00
76,S40000,5.5175781,2024-08-16 13:00:00
77,S40000,5.8593750,2024-08-16 14:00:00
78,S40000,5.5175781,2024-08-19 03:00:00
79,S40000,5.3222656,2024-08-19 04:00:00
80,S40000,5.3222656,2024-08-19 05:00:00
81,S40000,5.2246094,2024-08-19 06:00:00
82,S40000,5.3710938,2024-08-19 07:00:00
83,S40000,0.8300781,2024-08-19 08:00:00
84,S40000,5.8593750,2024-08-19 09:00:00
85,S40000,5.9570312,2024-08-19 10:00:00
86,S40000,5.8593750,2024-08-19 11:00:00
87,S40000,5.8105469,2024-08-19 12:00:00
88,S40000,5.8105469,2024-08-19 13:00:00
89,S40000,5.2246094,2024-08-19 14:00:00
90,S40000,4.0527344,2024-08-20 03:00:00
91,S40000,3.7597656,2024-08-20 04:00:00
92,S40000,2.2460938,2024-08-20 05:00:00
id,nama_parameter,batas_bawah,batas_atas,satuan,isDeleted,created_at,updated_at
2,Accelerometer,45,55,Gal,0,2023-12-24 15:24:11,2024-02-28 14:10:27
3,Strain Gauge,45,55,Microstrain,0,2023-12-24 15:24:11,2024-02-28 14:10:36
1,Tiltmeter,45,55,Degree,0,2023-12-24 15:24:11,2024-03-14 12:52:01
id,version,send_time,station_id,dynamic_data
1,1.0.0,2023-12-02 12:20:47.769,S40000,"{""Tiltmeter_01"": ""8.686649"", ""Tiltmeter_02"": ""6.767366"", ""Full_Bridge_01"": ""-407.872955"", ""Full_Bridge_02"": ""-274.763275"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.375752"", ""Accl_AA222_01_N"": ""-0.329489"", ""Accl_AA222_01_U"": ""0.373624"", ""Accl_AA222_02_E"": ""-0.313270"", ""Accl_AA222_02_N"": ""0.686254"", ""Accl_AA222_02_U"": ""0.219063"", ""Disp_AA222_01_E"": ""-0.001818"", ""Disp_AA222_01_N"": ""0.001048"", ""Disp_AA222_01_U"": ""-0.000469"", ""Disp_AA222_02_E"": ""-0.000380"", ""Disp_AA222_02_N"": ""-0.000536"", ""Disp_AA222_02_U"": ""0.000237"", ""Thermocouple_02"": ""23.456789""}"
2,1.0.0,2023-12-02 12:39:36.769,S40000,"{""Tiltmeter_01"": ""8.691656"", ""Tiltmeter_02"": ""6.775497"", ""Full_Bridge_01"": ""-407.946869"", ""Full_Bridge_02"": ""-274.900970"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.387988"", ""Accl_AA222_01_N"": ""0.458602"", ""Accl_AA222_01_U"": ""-0.360366"", ""Accl_AA222_02_E"": ""-0.365261"", ""Accl_AA222_02_N"": ""-0.646625"", ""Accl_AA222_02_U"": ""0.314535"", ""Disp_AA222_01_E"": ""0.001033"", ""Disp_AA222_01_N"": ""0.000836"", ""Disp_AA222_01_U"": ""-0.000937"", ""Disp_AA222_02_E"": ""0.000527"", ""Disp_AA222_02_N"": ""-0.000477"", ""Disp_AA222_02_U"": ""0.000261"", ""Thermocouple_01"": ""22.744955""}"
3,1.0.0,2023-12-02 12:39:37.769,S40000,"{""Tiltmeter_01"": ""8.691502"", ""Tiltmeter_02"": ""6.772522"", ""Full_Bridge_01"": ""-408.040771"", ""Full_Bridge_02"": ""-274.995331"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.516948"", ""Accl_AA222_01_N"": ""-0.358507"", ""Accl_AA222_01_U"": ""-0.684378"", ""Accl_AA222_02_E"": ""0.254120"", ""Accl_AA222_02_N"": ""-0.655746"", ""Accl_AA222_02_U"": ""-0.365381"", ""Disp_AA222_01_E"": ""0.001054"", ""Disp_AA222_01_N"": ""-0.000860"", ""Disp_AA222_01_U"": ""-0.001412"", ""Disp_AA222_02_E"": ""0.000482"", ""Disp_AA222_02_N"": ""0.000571"", ""Disp_AA222_02_U"": ""-0.000167"", ""Thermocouple_01"": ""22.735641""}"
4,1.0.0,2023-12-02 12:39:38.769,S40000,"{""Tiltmeter_01"": ""8.683622"", ""Tiltmeter_02"": ""6.776505"", ""Full_Bridge_01"": ""-408.040771"", ""Full_Bridge_02"": ""-274.945831"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.431781"", ""Accl_AA222_01_N"": ""0.486207"", ""Accl_AA222_01_U"": ""-0.407248"", ""Accl_AA222_02_E"": ""0.290929"", ""Accl_AA222_02_N"": ""-0.732931"", ""Accl_AA222_02_U"": ""0.331744"", ""Disp_AA222_01_E"": ""-0.001073"", ""Disp_AA222_01_N"": ""0.000921"", ""Disp_AA222_01_U"": ""0.001596"", ""Disp_AA222_02_E"": ""0.000666"", ""Disp_AA222_02_N"": ""0.000358"", ""Disp_AA222_02_U"": ""0.000163"", ""Thermocouple_01"": ""22.730610""}"
5,1.0.0,2023-12-02 12:39:39.769,S40000,"{""Tiltmeter_01"": ""8.686523"", ""Tiltmeter_02"": ""6.777094"", ""Full_Bridge_01"": ""-408.013062"", ""Full_Bridge_02"": ""-274.948914"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.440489"", ""Accl_AA222_01_N"": ""0.642929"", ""Accl_AA222_01_U"": ""-0.534468"", ""Accl_AA222_02_E"": ""-0.386916"", ""Accl_AA222_02_N"": ""0.779807"", ""Accl_AA222_02_U"": ""0.275554"", ""Disp_AA222_01_E"": ""0.000871"", ""Disp_AA222_01_N"": ""0.001002"", ""Disp_AA222_01_U"": ""-0.001590"", ""Disp_AA222_02_E"": ""-0.000539"", ""Disp_AA222_02_N"": ""-0.000272"", ""Disp_AA222_02_U"": ""-0.000198"", ""Thermocouple_01"": ""22.730610""}"
6,1.0.0,2023-12-02 12:39:40.769,S40000,"{""Tiltmeter_01"": ""8.687222"", ""Tiltmeter_02"": ""6.775314"", ""Full_Bridge_01"": ""-407.973022"", ""Full_Bridge_02"": ""-274.897858"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.479646"", ""Accl_AA222_01_N"": ""-0.525202"", ""Accl_AA222_01_U"": ""-0.494502"", ""Accl_AA222_02_E"": ""-0.381271"", ""Accl_AA222_02_N"": ""-0.661482"", ""Accl_AA222_02_U"": ""-0.184379"", ""Disp_AA222_01_E"": ""-0.001035"", ""Disp_AA222_01_N"": ""0.001021"", ""Disp_AA222_01_U"": ""0.001043"", ""Disp_AA222_02_E"": ""-0.000372"", ""Disp_AA222_02_N"": ""-0.000246"", ""Disp_AA222_02_U"": ""0.000168"", ""Thermocouple_01"": ""22.711611""}"
7,1.0.0,2023-12-02 12:39:41.769,S40000,"{""Tiltmeter_01"": ""8.688372"", ""Tiltmeter_02"": ""6.777666"", ""Full_Bridge_01"": ""-407.973022"", ""Full_Bridge_02"": ""-274.897858"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.448984"", ""Accl_AA222_01_N"": ""-0.477754"", ""Accl_AA222_01_U"": ""-0.368260"", ""Accl_AA222_02_E"": ""-0.285277"", ""Accl_AA222_02_N"": ""-0.750166"", ""Accl_AA222_02_U"": ""-0.174845"", ""Disp_AA222_01_E"": ""0.002024"", ""Disp_AA222_01_N"": ""-0.001504"", ""Disp_AA222_01_U"": ""-0.000549"", ""Disp_AA222_02_E"": ""0.000649"", ""Disp_AA222_02_N"": ""-0.000311"", ""Disp_AA222_02_U"": ""-0.000201"", ""Thermocouple_01"": ""22.698389""}"
8,1.0.0,2023-12-02 12:39:42.769,S40000,"{""Tiltmeter_01"": ""8.689075"", ""Tiltmeter_02"": ""6.773529"", ""Full_Bridge_01"": ""-407.948395"", ""Full_Bridge_02"": ""-274.933441"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.410575"", ""Accl_AA222_01_N"": ""-0.521316"", ""Accl_AA222_01_U"": ""0.357697"", ""Accl_AA222_02_E"": ""-0.294828"", ""Accl_AA222_02_N"": ""0.681585"", ""Accl_AA222_02_U"": ""-0.173718"", ""Disp_AA222_01_E"": ""0.001760"", ""Disp_AA222_01_N"": ""-0.000940"", ""Disp_AA222_01_U"": ""0.000994"", ""Disp_AA222_02_E"": ""0.000307"", ""Disp_AA222_02_N"": ""-0.000336"", ""Disp_AA222_02_U"": ""0.000174"", ""Thermocouple_01"": ""22.694290""}"
9,1.0.0,2023-12-02 12:39:43.769,S40000,"{""Tiltmeter_01"": ""8.687136"", ""Tiltmeter_02"": ""6.775669"", ""Full_Bridge_01"": ""-407.960724"", ""Full_Bridge_02"": ""-274.951996"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.448780"", ""Accl_AA222_01_N"": ""-0.500464"", ""Accl_AA222_01_U"": ""-0.568380"", ""Accl_AA222_02_E"": ""0.345696"", ""Accl_AA222_02_N"": ""-0.627884"", ""Accl_AA222_02_U"": ""-0.294113"", ""Disp_AA222_01_E"": ""0.001498"", ""Disp_AA222_01_N"": ""0.001445"", ""Disp_AA222_01_U"": ""-0.000460"", ""Disp_AA222_02_E"": ""-0.000514"", ""Disp_AA222_02_N"": ""-0.000292"", ""Disp_AA222_02_U"": ""-0.000139"", ""Thermocouple_01"": ""22.682938""}"
10,1.0.0,2023-12-02 12:39:44.769,S40000,"{""Tiltmeter_01"": ""8.688623"", ""Tiltmeter_02"": ""6.772945"", ""Full_Bridge_01"": ""-407.966858"", ""Full_Bridge_02"": ""-274.951996"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.494415"", ""Accl_AA222_01_N"": ""0.600210"", ""Accl_AA222_01_U"": ""0.982874"", ""Accl_AA222_02_E"": ""-0.361755"", ""Accl_AA222_02_N"": ""-0.730730"", ""Accl_AA222_02_U"": ""0.306638"", ""Disp_AA222_01_E"": ""-0.001667"", ""Disp_AA222_01_N"": ""0.001870"", ""Disp_AA222_01_U"": ""-0.000434"", ""Disp_AA222_02_E"": ""-0.000800"", ""Disp_AA222_02_N"": ""0.000225"", ""Disp_AA222_02_U"": ""0.000163"", ""Thermocouple_01"": ""22.685350""}"
11,1.0.0,2023-12-02 12:39:45.769,S40000,"{""Tiltmeter_01"": ""8.686712"", ""Tiltmeter_02"": ""6.776882"", ""Full_Bridge_01"": ""-407.963776"", ""Full_Bridge_02"": ""-274.936554"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.518846"", ""Accl_AA222_01_N"": ""-0.542479"", ""Accl_AA222_01_U"": ""-0.654106"", ""Accl_AA222_02_E"": ""0.395535"", ""Accl_AA222_02_N"": ""-0.664293"", ""Accl_AA222_02_U"": ""-0.255144"", ""Disp_AA222_01_E"": ""-0.001828"", ""Disp_AA222_01_N"": ""0.001909"", ""Disp_AA222_01_U"": ""-0.000788"", ""Disp_AA222_02_E"": ""-0.000792"", ""Disp_AA222_02_N"": ""-0.000249"", ""Disp_AA222_02_U"": ""-0.000263"", ""Thermocouple_01"": ""22.680319""}"
12,1.0.0,2023-12-02 12:39:46.769,S40000,"{""Tiltmeter_01"": ""8.685951"", ""Tiltmeter_02"": ""6.771778"", ""Full_Bridge_01"": ""-407.939148"", ""Full_Bridge_02"": ""-274.900970"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.491019"", ""Accl_AA222_01_N"": ""0.482652"", ""Accl_AA222_01_U"": ""-0.326777"", ""Accl_AA222_02_E"": ""-0.386269"", ""Accl_AA222_02_N"": ""-0.636630"", ""Accl_AA222_02_U"": ""0.250305"", ""Disp_AA222_01_E"": ""-0.001701"", ""Disp_AA222_01_N"": ""0.001184"", ""Disp_AA222_01_U"": ""0.001022"", ""Disp_AA222_02_E"": ""-0.000426"", ""Disp_AA222_02_N"": ""-0.000482"", ""Disp_AA222_02_U"": ""0.000216"", ""Thermocouple_01"": ""22.676783""}"
13,1.0.0,2023-12-02 12:39:47.769,S40000,"{""Tiltmeter_01"": ""8.686998"", ""Tiltmeter_02"": ""6.775915"", ""Full_Bridge_01"": ""-408.003815"", ""Full_Bridge_02"": ""-275.009247"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.428729"", ""Accl_AA222_01_N"": ""-0.606992"", ""Accl_AA222_01_U"": ""-0.435078"", ""Accl_AA222_02_E"": ""-0.474263"", ""Accl_AA222_02_N"": ""0.648112"", ""Accl_AA222_02_U"": ""0.280318"", ""Disp_AA222_01_E"": ""0.001607"", ""Disp_AA222_01_N"": ""-0.000556"", ""Disp_AA222_01_U"": ""-0.000709"", ""Disp_AA222_02_E"": ""-0.000341"", ""Disp_AA222_02_N"": ""0.000462"", ""Disp_AA222_02_U"": ""0.000328"", ""Thermocouple_01"": ""22.672495""}"
14,1.0.0,2023-12-02 12:39:48.769,S40000,"{""Tiltmeter_01"": ""8.695621"", ""Tiltmeter_02"": ""6.771727"", ""Full_Bridge_01"": ""-407.956085"", ""Full_Bridge_02"": ""-274.866913"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.546873"", ""Accl_AA222_01_N"": ""-0.523364"", ""Accl_AA222_01_U"": ""-0.378569"", ""Accl_AA222_02_E"": ""-0.369367"", ""Accl_AA222_02_N"": ""-0.725137"", ""Accl_AA222_02_U"": ""-0.149397"", ""Disp_AA222_01_E"": ""-0.001637"", ""Disp_AA222_01_N"": ""0.000798"", ""Disp_AA222_01_U"": ""0.000762"", ""Disp_AA222_02_E"": ""0.000388"", ""Disp_AA222_02_N"": ""-0.000409"", ""Disp_AA222_02_U"": ""-0.000299"", ""Thermocouple_01"": ""22.659645""}"
15,1.0.0,2023-12-02 12:39:49.769,S40000,"{""Tiltmeter_01"": ""8.685236"", ""Tiltmeter_02"": ""6.772928"", ""Full_Bridge_01"": ""-408.037689"", ""Full_Bridge_02"": ""-274.933441"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.509121"", ""Accl_AA222_01_N"": ""-0.447372"", ""Accl_AA222_01_U"": ""0.432836"", ""Accl_AA222_02_E"": ""-0.384339"", ""Accl_AA222_02_N"": ""0.652923"", ""Accl_AA222_02_U"": ""-0.242325"", ""Disp_AA222_01_E"": ""-0.001629"", ""Disp_AA222_01_N"": ""-0.000568"", ""Disp_AA222_01_U"": ""-0.000732"", ""Disp_AA222_02_E"": ""0.000222"", ""Disp_AA222_02_N"": ""-0.000352"", ""Disp_AA222_02_U"": ""0.000225"", ""Thermocouple_01"": ""22.651823""}"
16,1.0.0,2023-12-02 12:39:50.769,S40000,"{""Tiltmeter_01"": ""8.682541"", ""Tiltmeter_02"": ""6.777843"", ""Full_Bridge_01"": ""-408.037689"", ""Full_Bridge_02"": ""-274.896332"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.556628"", ""Accl_AA222_01_N"": ""-0.513445"", ""Accl_AA222_01_U"": ""-0.495294"", ""Accl_AA222_02_E"": ""0.267636"", ""Accl_AA222_02_N"": ""-0.722171"", ""Accl_AA222_02_U"": ""-0.239991"", ""Disp_AA222_01_E"": ""0.001276"", ""Disp_AA222_01_N"": ""-0.000275"", ""Disp_AA222_01_U"": ""0.000964"", ""Disp_AA222_02_E"": ""-0.000208"", ""Disp_AA222_02_N"": ""-0.000406"", ""Disp_AA222_02_U"": ""-0.000211"", ""Thermocouple_01"": ""22.646235""}"
17,1.0.0,2023-12-02 12:39:51.769,S40000,"{""Tiltmeter_01"": ""8.692881"", ""Tiltmeter_02"": ""6.777689"", ""Full_Bridge_01"": ""-408.009979"", ""Full_Bridge_02"": ""-274.916443"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.587285"", ""Accl_AA222_01_N"": ""-0.488188"", ""Accl_AA222_01_U"": ""-0.546524"", ""Accl_AA222_02_E"": ""0.458958"", ""Accl_AA222_02_N"": ""0.694472"", ""Accl_AA222_02_U"": ""-0.296795"", ""Disp_AA222_01_E"": ""-0.001032"", ""Disp_AA222_01_N"": ""0.000699"", ""Disp_AA222_01_U"": ""-0.000953"", ""Disp_AA222_02_E"": ""-0.000377"", ""Disp_AA222_02_N"": ""0.000388"", ""Disp_AA222_02_U"": ""0.000263"", ""Thermocouple_01"": ""22.646235""}"
18,1.0.0,2023-12-02 12:39:52.769,S40000,"{""Tiltmeter_01"": ""8.692263"", ""Tiltmeter_02"": ""6.777357"", ""Full_Bridge_01"": ""-407.956085"", ""Full_Bridge_02"": ""-274.902496"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.495116"", ""Accl_AA222_01_N"": ""-0.489893"", ""Accl_AA222_01_U"": ""-0.469038"", ""Accl_AA222_02_E"": ""0.351970"", ""Accl_AA222_02_N"": ""-0.655168"", ""Accl_AA222_02_U"": ""0.358476"", ""Disp_AA222_01_E"": ""0.001344"", ""Disp_AA222_01_N"": ""-0.000883"", ""Disp_AA222_01_U"": ""-0.000437"", ""Disp_AA222_02_E"": ""0.000404"", ""Disp_AA222_02_N"": ""-0.000252"", ""Disp_AA222_02_U"": ""-0.000252"", ""Thermocouple_01"": ""22.632078""}"
19,1.0.0,2023-12-02 12:39:53.769,S40000,"{""Tiltmeter_01"": ""8.692034"", ""Tiltmeter_02"": ""6.776052"", ""Full_Bridge_01"": ""-407.956085"", ""Full_Bridge_02"": ""-274.934998"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.498935"", ""Accl_AA222_01_N"": ""0.461222"", ""Accl_AA222_01_U"": ""-0.388933"", ""Accl_AA222_02_E"": ""0.269642"", ""Accl_AA222_02_N"": ""0.677377"", ""Accl_AA222_02_U"": ""-0.327829"", ""Disp_AA222_01_E"": ""0.001321"", ""Disp_AA222_01_N"": ""-0.000552"", ""Disp_AA222_01_U"": ""-0.000736"", ""Disp_AA222_02_E"": ""0.000383"", ""Disp_AA222_02_N"": ""-0.000287"", ""Disp_AA222_02_U"": ""0.000266"", ""Thermocouple_01"": ""22.625000""}"
20,1.0.0,2023-12-02 12:39:54.769,S40000,"{""Tiltmeter_01"": ""8.690008"", ""Tiltmeter_02"": ""6.773540"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.936554"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.459772"", ""Accl_AA222_01_N"": ""-0.520724"", ""Accl_AA222_01_U"": ""0.387389"", ""Accl_AA222_02_E"": ""-0.261604"", ""Accl_AA222_02_N"": ""-0.640711"", ""Accl_AA222_02_U"": ""-0.285750"", ""Disp_AA222_01_E"": ""0.002027"", ""Disp_AA222_01_N"": ""-0.000751"", ""Disp_AA222_01_U"": ""-0.000803"", ""Disp_AA222_02_E"": ""0.000260"", ""Disp_AA222_02_N"": ""-0.000308"", ""Disp_AA222_02_U"": ""-0.000363"", ""Thermocouple_01"": ""22.613453""}"
21,1.0.0,2023-12-02 12:39:55.769,S40000,"{""Tiltmeter_01"": ""8.694860"", ""Tiltmeter_02"": ""6.777054"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.936554"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.458337"", ""Accl_AA222_01_N"": ""0.487952"", ""Accl_AA222_01_U"": ""-0.589020"", ""Accl_AA222_02_E"": ""0.345132"", ""Accl_AA222_02_N"": ""0.676264"", ""Accl_AA222_02_U"": ""0.352427"", ""Disp_AA222_01_E"": ""-0.001292"", ""Disp_AA222_01_N"": ""0.000853"", ""Disp_AA222_01_U"": ""-0.000670"", ""Disp_AA222_02_E"": ""-0.000344"", ""Disp_AA222_02_N"": ""0.000262"", ""Disp_AA222_02_U"": ""-0.000315"", ""Thermocouple_01"": ""22.607687""}"
22,1.0.0,2023-12-02 12:39:56.769,S40000,"{""Tiltmeter_01"": ""8.689339"", ""Tiltmeter_02"": ""6.775240"", ""Full_Bridge_01"": ""-407.968414"", ""Full_Bridge_02"": ""-274.967468"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.452330"", ""Accl_AA222_01_N"": ""-0.521453"", ""Accl_AA222_01_U"": ""0.602715"", ""Accl_AA222_02_E"": ""0.425899"", ""Accl_AA222_02_N"": ""-0.681088"", ""Accl_AA222_02_U"": ""0.507379"", ""Disp_AA222_01_E"": ""0.000954"", ""Disp_AA222_01_N"": ""-0.000871"", ""Disp_AA222_01_U"": ""-0.000817"", ""Disp_AA222_02_E"": ""0.000532"", ""Disp_AA222_02_N"": ""0.000324"", ""Disp_AA222_02_U"": ""0.000316"", ""Thermocouple_01"": ""22.600414""}"
23,1.0.0,2023-12-02 12:39:57.769,S40000,"{""Tiltmeter_01"": ""8.685270"", ""Tiltmeter_02"": ""6.774559"", ""Full_Bridge_01"": ""-407.962250"", ""Full_Bridge_02"": ""-274.868469"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.431202"", ""Accl_AA222_01_N"": ""0.495019"", ""Accl_AA222_01_U"": ""-0.665094"", ""Accl_AA222_02_E"": ""-0.360453"", ""Accl_AA222_02_N"": ""0.700076"", ""Accl_AA222_02_U"": ""-0.519253"", ""Disp_AA222_01_E"": ""-0.001349"", ""Disp_AA222_01_N"": ""0.000782"", ""Disp_AA222_01_U"": ""-0.000644"", ""Disp_AA222_02_E"": ""-0.000377"", ""Disp_AA222_02_N"": ""-0.000403"", ""Disp_AA222_02_U"": ""-0.000382"", ""Thermocouple_01"": ""22.593903""}"
24,1.0.0,2023-12-02 12:39:58.769,S40000,"{""Tiltmeter_01"": ""8.689636"", ""Tiltmeter_02"": ""6.769215"", ""Full_Bridge_01"": ""-407.951477"", ""Full_Bridge_02"": ""-274.897858"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.573346"", ""Accl_AA222_01_N"": ""0.655067"", ""Accl_AA222_01_U"": ""-1.694646"", ""Accl_AA222_02_E"": ""-0.837498"", ""Accl_AA222_02_N"": ""-0.726654"", ""Accl_AA222_02_U"": ""-1.088944"", ""Disp_AA222_01_E"": ""0.001233"", ""Disp_AA222_01_N"": ""-0.000929"", ""Disp_AA222_01_U"": ""0.000900"", ""Disp_AA222_02_E"": ""0.000306"", ""Disp_AA222_02_N"": ""0.000250"", ""Disp_AA222_02_U"": ""0.000501"", ""Thermocouple_01"": ""22.585335""}"
25,1.0.0,2023-12-02 12:39:59.769,S40000,"{""Tiltmeter_01"": ""8.683125"", ""Tiltmeter_02"": ""6.778656"", ""Full_Bridge_01"": ""-407.971497"", ""Full_Bridge_02"": ""-274.897858"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.666368"", ""Accl_AA222_01_N"": ""-0.606161"", ""Accl_AA222_01_U"": ""-1.837200"", ""Accl_AA222_02_E"": ""0.833091"", ""Accl_AA222_02_N"": ""0.793748"", ""Accl_AA222_02_U"": ""-1.110592"", ""Disp_AA222_01_E"": ""-0.001619"", ""Disp_AA222_01_N"": ""0.001397"", ""Disp_AA222_01_U"": ""-0.001059"", ""Disp_AA222_02_E"": ""0.000610"", ""Disp_AA222_02_N"": ""-0.000283"", ""Disp_AA222_02_U"": ""0.000405"", ""Thermocouple_01"": ""22.582159""}"
26,1.0.0,2023-12-02 12:40:00.769,S40000,"{""Tiltmeter_01"": ""8.685825"", ""Tiltmeter_02"": ""6.772848"", ""Full_Bridge_01"": ""-407.971497"", ""Full_Bridge_02"": ""-274.936554"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.774992"", ""Accl_AA222_01_N"": ""-0.538097"", ""Accl_AA222_01_U"": ""-2.371258"", ""Accl_AA222_02_E"": ""-1.177499"", ""Accl_AA222_02_N"": ""1.076637"", ""Accl_AA222_02_U"": ""-1.075068"", ""Disp_AA222_01_E"": ""0.001619"", ""Disp_AA222_01_N"": ""-0.000765"", ""Disp_AA222_01_U"": ""-0.001259"", ""Disp_AA222_02_E"": ""0.000312"", ""Disp_AA222_02_N"": ""0.000352"", ""Disp_AA222_02_U"": ""-0.000388"", ""Thermocouple_01"": ""22.585140""}"
27,1.0.0,2023-12-02 12:40:01.769,S40000,"{""Tiltmeter_01"": ""8.684950"", ""Tiltmeter_02"": ""6.770948"", ""Full_Bridge_01"": ""-407.920685"", ""Full_Bridge_02"": ""-274.919525"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.511961"", ""Accl_AA222_01_N"": ""-0.438798"", ""Accl_AA222_01_U"": ""-0.875321"", ""Accl_AA222_02_E"": ""-0.498267"", ""Accl_AA222_02_N"": ""0.842213"", ""Accl_AA222_02_U"": ""0.631827"", ""Disp_AA222_01_E"": ""-0.001331"", ""Disp_AA222_01_N"": ""0.000694"", ""Disp_AA222_01_U"": ""0.000760"", ""Disp_AA222_02_E"": ""0.000572"", ""Disp_AA222_02_N"": ""0.000307"", ""Disp_AA222_02_U"": ""0.000187"", ""Thermocouple_01"": ""22.581053""}"
28,1.0.0,2023-12-02 12:40:02.769,S40000,"{""Tiltmeter_01"": ""8.687393"", ""Tiltmeter_02"": ""6.774073"", ""Full_Bridge_01"": ""-407.942230"", ""Full_Bridge_02"": ""-274.913330"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.572227"", ""Accl_AA222_01_N"": ""-0.548365"", ""Accl_AA222_01_U"": ""-0.680146"", ""Accl_AA222_02_E"": ""0.403682"", ""Accl_AA222_02_N"": ""0.737439"", ""Accl_AA222_02_U"": ""-0.358429"", ""Disp_AA222_01_E"": ""0.001317"", ""Disp_AA222_01_N"": ""0.000436"", ""Disp_AA222_01_U"": ""-0.000776"", ""Disp_AA222_02_E"": ""-0.000646"", ""Disp_AA222_02_N"": ""0.000480"", ""Disp_AA222_02_U"": ""0.000187"", ""Thermocouple_01"": ""22.581053""}"
29,1.0.0,2023-12-02 12:40:03.769,S40000,"{""Tiltmeter_01"": ""8.688372"", ""Tiltmeter_02"": ""6.769146"", ""Full_Bridge_01"": ""-407.943787"", ""Full_Bridge_02"": ""-274.899414"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.478980"", ""Accl_AA222_01_N"": ""0.455815"", ""Accl_AA222_01_U"": ""-0.472489"", ""Accl_AA222_02_E"": ""-0.315796"", ""Accl_AA222_02_N"": ""0.699244"", ""Accl_AA222_02_U"": ""0.200606"", ""Disp_AA222_01_E"": ""0.001712"", ""Disp_AA222_01_N"": ""-0.000901"", ""Disp_AA222_01_U"": ""-0.000439"", ""Disp_AA222_02_E"": ""0.000337"", ""Disp_AA222_02_N"": ""-0.000334"", ""Disp_AA222_02_U"": ""-0.000095"", ""Thermocouple_01"": ""22.575092""}"
30,1.0.0,2023-12-02 12:40:04.769,S40000,"{""Tiltmeter_01"": ""8.692245"", ""Tiltmeter_02"": ""6.770176"", ""Full_Bridge_01"": ""-407.962250"", ""Full_Bridge_02"": ""-274.908691"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.454470"", ""Accl_AA222_01_N"": ""-0.579324"", ""Accl_AA222_01_U"": ""0.407338"", ""Accl_AA222_02_E"": ""-0.327075"", ""Accl_AA222_02_N"": ""0.640344"", ""Accl_AA222_02_U"": ""-0.245888"", ""Disp_AA222_01_E"": ""0.001758"", ""Disp_AA222_01_N"": ""0.000998"", ""Disp_AA222_01_U"": ""-0.000655"", ""Disp_AA222_02_E"": ""-0.000400"", ""Disp_AA222_02_N"": ""-0.000261"", ""Disp_AA222_02_U"": ""0.000142"", ""Thermocouple_01"": ""22.573219""}"
31,1.0.0,2023-12-02 12:40:05.769,S40000,"{""Tiltmeter_01"": ""8.688160"", ""Tiltmeter_02"": ""6.770714"", ""Full_Bridge_01"": ""-407.962250"", ""Full_Bridge_02"": ""-274.859192"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.426532"", ""Accl_AA222_01_N"": ""0.449530"", ""Accl_AA222_01_U"": ""0.328320"", ""Accl_AA222_02_E"": ""-0.297456"", ""Accl_AA222_02_N"": ""-0.661263"", ""Accl_AA222_02_U"": ""0.216343"", ""Disp_AA222_01_E"": ""0.001452"", ""Disp_AA222_01_N"": ""-0.001155"", ""Disp_AA222_01_U"": ""0.000691"", ""Disp_AA222_02_E"": ""0.000745"", ""Disp_AA222_02_N"": ""-0.000269"", ""Disp_AA222_02_U"": ""-0.000132"", ""Thermocouple_01"": ""22.611217""}"
32,1.0.0,2023-12-02 12:40:06.769,S40000,"{""Tiltmeter_01"": ""8.690689"", ""Tiltmeter_02"": ""6.774044"", ""Full_Bridge_01"": ""-407.999207"", ""Full_Bridge_02"": ""-274.862274"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.407270"", ""Accl_AA222_01_N"": ""-0.552755"", ""Accl_AA222_01_U"": ""0.427454"", ""Accl_AA222_02_E"": ""-0.313975"", ""Accl_AA222_02_N"": ""-0.701137"", ""Accl_AA222_02_U"": ""-0.192570"", ""Disp_AA222_01_E"": ""-0.001468"", ""Disp_AA222_01_N"": ""0.000960"", ""Disp_AA222_01_U"": ""-0.000250"", ""Disp_AA222_02_E"": ""-0.000595"", ""Disp_AA222_02_N"": ""-0.000371"", ""Disp_AA222_02_U"": ""0.000183"", ""Thermocouple_01"": ""22.611217""}"
33,1.0.0,2023-12-02 12:40:07.769,S40000,"{""Tiltmeter_01"": ""8.687634"", ""Tiltmeter_02"": ""6.775549"", ""Full_Bridge_01"": ""-407.966858"", ""Full_Bridge_02"": ""-274.990692"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.476642"", ""Accl_AA222_01_N"": ""-0.577058"", ""Accl_AA222_01_U"": ""-0.329290"", ""Accl_AA222_02_E"": ""0.291023"", ""Accl_AA222_02_N"": ""-0.704575"", ""Accl_AA222_02_U"": ""-0.157450"", ""Disp_AA222_01_E"": ""0.001623"", ""Disp_AA222_01_N"": ""-0.000938"", ""Disp_AA222_01_U"": ""0.000702"", ""Disp_AA222_02_E"": ""0.000213"", ""Disp_AA222_02_N"": ""-0.000318"", ""Disp_AA222_02_U"": ""0.000277"", ""Thermocouple_01"": ""22.591101""}"
34,1.0.0,2023-12-02 12:40:08.769,S40000,"{""Tiltmeter_01"": ""8.689322"", ""Tiltmeter_02"": ""6.772362"", ""Full_Bridge_01"": ""-407.931458"", ""Full_Bridge_02"": ""-274.866913"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.391447"", ""Accl_AA222_01_N"": ""0.586198"", ""Accl_AA222_01_U"": ""0.439226"", ""Accl_AA222_02_E"": ""0.315859"", ""Accl_AA222_02_N"": ""-0.704007"", ""Accl_AA222_02_U"": ""-0.315648"", ""Disp_AA222_01_E"": ""-0.001331"", ""Disp_AA222_01_N"": ""0.001220"", ""Disp_AA222_01_U"": ""0.000716"", ""Disp_AA222_02_E"": ""0.000623"", ""Disp_AA222_02_N"": ""-0.000278"", ""Disp_AA222_02_U"": ""-0.000211"", ""Thermocouple_01"": ""22.582159""}"
35,1.0.0,2023-12-02 12:40:09.769,S40000,"{""Tiltmeter_01"": ""8.681940"", ""Tiltmeter_02"": ""6.771360"", ""Full_Bridge_01"": ""-407.933014"", ""Full_Bridge_02"": ""-274.969025"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.418187"", ""Accl_AA222_01_N"": ""0.489057"", ""Accl_AA222_01_U"": ""0.638090"", ""Accl_AA222_02_E"": ""-0.409286"", ""Accl_AA222_02_N"": ""-0.714149"", ""Accl_AA222_02_U"": ""-0.311417"", ""Disp_AA222_01_E"": ""-0.001760"", ""Disp_AA222_01_N"": ""-0.001004"", ""Disp_AA222_01_U"": ""-0.000443"", ""Disp_AA222_02_E"": ""0.000459"", ""Disp_AA222_02_N"": ""0.000286"", ""Disp_AA222_02_U"": ""0.000194"", ""Thermocouple_01"": ""22.570984""}"
36,1.0.0,2023-12-02 12:40:10.769,S40000,"{""Tiltmeter_01"": ""8.689562"", ""Tiltmeter_02"": ""6.771086"", ""Full_Bridge_01"": ""-407.933014"", ""Full_Bridge_02"": ""-274.939636"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.416515"", ""Accl_AA222_01_N"": ""-0.517403"", ""Accl_AA222_01_U"": ""0.582366"", ""Accl_AA222_02_E"": ""0.353567"", ""Accl_AA222_02_N"": ""0.724490"", ""Accl_AA222_02_U"": ""-0.409582"", ""Disp_AA222_01_E"": ""0.001608"", ""Disp_AA222_01_N"": ""0.000863"", ""Disp_AA222_01_U"": ""0.000970"", ""Disp_AA222_02_E"": ""-0.000408"", ""Disp_AA222_02_N"": ""-0.000388"", ""Disp_AA222_02_U"": ""0.000209"", ""Thermocouple_01"": ""22.565218""}"
37,1.0.0,2023-12-02 12:40:11.769,S40000,"{""Tiltmeter_01"": ""8.688383"", ""Tiltmeter_02"": ""6.770725"", ""Full_Bridge_01"": ""-407.920685"", ""Full_Bridge_02"": ""-274.939636"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.466653"", ""Accl_AA222_01_N"": ""0.534388"", ""Accl_AA222_01_U"": ""-0.367176"", ""Accl_AA222_02_E"": ""0.282284"", ""Accl_AA222_02_N"": ""0.642645"", ""Accl_AA222_02_U"": ""-0.242308"", ""Disp_AA222_01_E"": ""0.001959"", ""Disp_AA222_01_N"": ""-0.000603"", ""Disp_AA222_01_U"": ""-0.000658"", ""Disp_AA222_02_E"": ""0.000408"", ""Disp_AA222_02_N"": ""-0.000153"", ""Disp_AA222_02_U"": ""0.000128"", ""Thermocouple_01"": ""22.565395""}"
38,1.0.0,2023-12-02 12:40:12.769,S40000,"{""Tiltmeter_01"": ""8.686346"", ""Tiltmeter_02"": ""6.774015"", ""Full_Bridge_01"": ""-408.016144"", ""Full_Bridge_02"": ""-274.934998"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.420927"", ""Accl_AA222_01_N"": ""-0.462991"", ""Accl_AA222_01_U"": ""-0.354312"", ""Accl_AA222_02_E"": ""0.363162"", ""Accl_AA222_02_N"": ""0.644273"", ""Accl_AA222_02_U"": ""-0.286973"", ""Disp_AA222_01_E"": ""-0.001937"", ""Disp_AA222_01_N"": ""0.000788"", ""Disp_AA222_01_U"": ""0.000778"", ""Disp_AA222_02_E"": ""0.000221"", ""Disp_AA222_02_N"": ""-0.000151"", ""Disp_AA222_02_U"": ""0.000230"", ""Thermocouple_01"": ""22.565395""}"
39,1.0.0,2023-12-02 12:40:13.769,S40000,"{""Tiltmeter_01"": ""8.694637"", ""Tiltmeter_02"": ""6.768425"", ""Full_Bridge_01"": ""-407.937622"", ""Full_Bridge_02"": ""-274.934998"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.542858"", ""Accl_AA222_01_N"": ""0.465083"", ""Accl_AA222_01_U"": ""0.414044"", ""Accl_AA222_02_E"": ""-0.280374"", ""Accl_AA222_02_N"": ""-0.694895"", ""Accl_AA222_02_U"": ""-0.316433"", ""Disp_AA222_01_E"": ""-0.001069"", ""Disp_AA222_01_N"": ""0.000847"", ""Disp_AA222_01_U"": ""0.000781"", ""Disp_AA222_02_E"": ""-0.000377"", ""Disp_AA222_02_N"": ""-0.000200"", ""Disp_AA222_02_U"": ""-0.000238"", ""Thermocouple_01"": ""22.541182""}"
40,1.0.0,2023-12-02 12:40:14.769,S40000,"{""Tiltmeter_01"": ""8.693539"", ""Tiltmeter_02"": ""6.772196"", ""Full_Bridge_01"": ""-407.994568"", ""Full_Bridge_02"": ""-274.927246"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.486614"", ""Accl_AA222_01_N"": ""0.515280"", ""Accl_AA222_01_U"": ""0.385214"", ""Accl_AA222_02_E"": ""-0.280795"", ""Accl_AA222_02_N"": ""0.718680"", ""Accl_AA222_02_U"": ""0.307469"", ""Disp_AA222_01_E"": ""0.001709"", ""Disp_AA222_01_N"": ""0.001174"", ""Disp_AA222_01_U"": ""0.001095"", ""Disp_AA222_02_E"": ""0.000551"", ""Disp_AA222_02_N"": ""-0.000273"", ""Disp_AA222_02_U"": ""-0.000280"", ""Thermocouple_01"": ""22.537083""}"
41,1.0.0,2023-12-02 12:40:15.769,S40000,"{""Tiltmeter_01"": ""8.691593"", ""Tiltmeter_02"": ""6.768442"", ""Full_Bridge_01"": ""-407.991486"", ""Full_Bridge_02"": ""-274.887024"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.535916"", ""Accl_AA222_01_N"": ""0.574007"", ""Accl_AA222_01_U"": ""0.406430"", ""Accl_AA222_02_E"": ""-0.310094"", ""Accl_AA222_02_N"": ""0.653869"", ""Accl_AA222_02_U"": ""-0.339474"", ""Disp_AA222_01_E"": ""0.001126"", ""Disp_AA222_01_N"": ""0.001305"", ""Disp_AA222_01_U"": ""-0.000907"", ""Disp_AA222_02_E"": ""-0.000555"", ""Disp_AA222_02_N"": ""-0.000519"", ""Disp_AA222_02_U"": ""0.000361"", ""Thermocouple_01"": ""22.537083""}"
42,1.0.0,2023-12-02 12:40:16.769,S40000,"{""Tiltmeter_01"": ""8.693132"", ""Tiltmeter_02"": ""6.771132"", ""Full_Bridge_01"": ""-407.991486"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.430688"", ""Accl_AA222_01_N"": ""-0.465543"", ""Accl_AA222_01_U"": ""0.396995"", ""Accl_AA222_02_E"": ""0.307231"", ""Accl_AA222_02_N"": ""-0.683831"", ""Accl_AA222_02_U"": ""0.371291"", ""Disp_AA222_01_E"": ""-0.001709"", ""Disp_AA222_01_N"": ""0.001663"", ""Disp_AA222_01_U"": ""0.000873"", ""Disp_AA222_02_E"": ""-0.000576"", ""Disp_AA222_02_N"": ""0.000718"", ""Disp_AA222_02_U"": ""-0.000333"", ""Thermocouple_01"": ""22.533180""}"
43,1.0.0,2023-12-02 12:40:17.77,S40000,"{""Tiltmeter_01"": ""8.690866"", ""Tiltmeter_02"": ""6.778507"", ""Full_Bridge_01"": ""-407.948395"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.463439"", ""Accl_AA222_01_N"": ""0.435576"", ""Accl_AA222_01_U"": ""-0.414428"", ""Accl_AA222_02_E"": ""0.279016"", ""Accl_AA222_02_N"": ""-0.660238"", ""Accl_AA222_02_U"": ""0.264503"", ""Disp_AA222_01_E"": ""0.001598"", ""Disp_AA222_01_N"": ""-0.001023"", ""Disp_AA222_01_U"": ""-0.000393"", ""Disp_AA222_02_E"": ""-0.000363"", ""Disp_AA222_02_N"": ""0.000494"", ""Disp_AA222_02_U"": ""-0.000229"", ""Thermocouple_01"": ""22.525908""}"
44,1.0.0,2023-12-02 12:40:18.769,S40000,"{""Tiltmeter_01"": ""8.694586"", ""Tiltmeter_02"": ""6.769386"", ""Full_Bridge_01"": ""-407.945312"", ""Full_Bridge_02"": ""-274.917969"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.483865"", ""Accl_AA222_01_N"": ""-0.590398"", ""Accl_AA222_01_U"": ""0.548545"", ""Accl_AA222_02_E"": ""-0.540739"", ""Accl_AA222_02_N"": ""0.689044"", ""Accl_AA222_02_U"": ""0.340200"", ""Disp_AA222_01_E"": ""0.001598"", ""Disp_AA222_01_N"": ""-0.001073"", ""Disp_AA222_01_U"": ""-0.000708"", ""Disp_AA222_02_E"": ""-0.000300"", ""Disp_AA222_02_N"": ""0.000508"", ""Disp_AA222_02_U"": ""-0.000227"", ""Thermocouple_01"": ""22.537083""}"
45,1.0.0,2023-12-02 12:40:19.769,S40000,"{""Tiltmeter_01"": ""8.686735"", ""Tiltmeter_02"": ""6.774221"", ""Full_Bridge_01"": ""-407.943787"", ""Full_Bridge_02"": ""-274.917969"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.467516"", ""Accl_AA222_01_N"": ""-0.502765"", ""Accl_AA222_01_U"": ""0.557368"", ""Accl_AA222_02_E"": ""-0.359244"", ""Accl_AA222_02_N"": ""0.691434"", ""Accl_AA222_02_U"": ""-0.225798"", ""Disp_AA222_01_E"": ""-0.001801"", ""Disp_AA222_01_N"": ""0.000808"", ""Disp_AA222_01_U"": ""0.000831"", ""Disp_AA222_02_E"": ""-0.000342"", ""Disp_AA222_02_N"": ""-0.000628"", ""Disp_AA222_02_U"": ""0.000130"", ""Thermocouple_01"": ""22.531868""}"
46,1.0.0,2023-12-02 12:40:20.769,S40000,"{""Tiltmeter_01"": ""8.689367"", ""Tiltmeter_02"": ""6.771572"", ""Full_Bridge_01"": ""-407.909912"", ""Full_Bridge_02"": ""-274.939636"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.411066"", ""Accl_AA222_01_N"": ""0.492488"", ""Accl_AA222_01_U"": ""0.609116"", ""Accl_AA222_02_E"": ""0.313944"", ""Accl_AA222_02_N"": ""0.659378"", ""Accl_AA222_02_U"": ""-0.288362"", ""Disp_AA222_01_E"": ""0.001219"", ""Disp_AA222_01_N"": ""0.000534"", ""Disp_AA222_01_U"": ""-0.000611"", ""Disp_AA222_02_E"": ""-0.000471"", ""Disp_AA222_02_N"": ""0.000827"", ""Disp_AA222_02_U"": ""-0.000160"", ""Thermocouple_01"": ""22.515299""}"
47,1.0.0,2023-12-02 12:40:21.769,S40000,"{""Tiltmeter_01"": ""8.686380"", ""Tiltmeter_02"": ""6.777437"", ""Full_Bridge_01"": ""-407.906830"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.471996"", ""Accl_AA222_01_N"": ""0.439920"", ""Accl_AA222_01_U"": ""0.482357"", ""Accl_AA222_02_E"": ""-0.286325"", ""Accl_AA222_02_N"": ""-0.661034"", ""Accl_AA222_02_U"": ""-0.326962"", ""Disp_AA222_01_E"": ""0.000820"", ""Disp_AA222_01_N"": ""0.000347"", ""Disp_AA222_01_U"": ""-0.000458"", ""Disp_AA222_02_E"": ""-0.000468"", ""Disp_AA222_02_N"": ""0.000469"", ""Disp_AA222_02_U"": ""-0.000220"", ""Thermocouple_01"": ""22.529633""}"
48,1.0.0,2023-12-02 12:40:22.769,S40000,"{""Tiltmeter_01"": ""8.679451"", ""Tiltmeter_02"": ""6.773712"", ""Full_Bridge_01"": ""-407.965332"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.474869"", ""Accl_AA222_01_N"": ""-0.465317"", ""Accl_AA222_01_U"": ""0.394755"", ""Accl_AA222_02_E"": ""-0.309767"", ""Accl_AA222_02_N"": ""0.663744"", ""Accl_AA222_02_U"": ""-0.257527"", ""Disp_AA222_01_E"": ""0.000989"", ""Disp_AA222_01_N"": ""-0.000924"", ""Disp_AA222_01_U"": ""0.000327"", ""Disp_AA222_02_E"": ""0.000333"", ""Disp_AA222_02_N"": ""0.000422"", ""Disp_AA222_02_U"": ""0.000283"", ""Thermocouple_01"": ""22.545279""}"
49,1.0.0,2023-12-02 12:40:23.769,S40000,"{""Tiltmeter_01"": ""8.685986"", ""Tiltmeter_02"": ""6.774153"", ""Full_Bridge_01"": ""-407.969940"", ""Full_Bridge_02"": ""-274.916443"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.521802"", ""Accl_AA222_01_N"": ""-0.538607"", ""Accl_AA222_01_U"": ""-0.446500"", ""Accl_AA222_02_E"": ""0.255674"", ""Accl_AA222_02_N"": ""-0.678291"", ""Accl_AA222_02_U"": ""0.221978"", ""Disp_AA222_01_E"": ""-0.001370"", ""Disp_AA222_01_N"": ""0.001229"", ""Disp_AA222_01_U"": ""0.000749"", ""Disp_AA222_02_E"": ""0.000908"", ""Disp_AA222_02_N"": ""0.000427"", ""Disp_AA222_02_U"": ""-0.000219"", ""Thermocouple_01"": ""22.566885""}"
50,1.0.0,2023-12-02 12:40:24.769,S40000,"{""Tiltmeter_01"": ""8.685539"", ""Tiltmeter_02"": ""6.772087"", ""Full_Bridge_01"": ""-407.969940"", ""Full_Bridge_02"": ""-274.964386"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.480202"", ""Accl_AA222_01_N"": ""0.594730"", ""Accl_AA222_01_U"": ""0.445048"", ""Accl_AA222_02_E"": ""0.322173"", ""Accl_AA222_02_N"": ""-0.700030"", ""Accl_AA222_02_U"": ""0.263325"", ""Disp_AA222_01_E"": ""0.000926"", ""Disp_AA222_01_N"": ""-0.000764"", ""Disp_AA222_01_U"": ""0.000696"", ""Disp_AA222_02_E"": ""0.000925"", ""Disp_AA222_02_N"": ""-0.000496"", ""Disp_AA222_02_U"": ""0.000176"", ""Thermocouple_01"": ""22.614943""}"
51,1.0.0,2023-12-02 12:40:25.769,S40000,"{""Tiltmeter_01"": ""8.689808"", ""Tiltmeter_02"": ""6.777197"", ""Full_Bridge_01"": ""-407.977631"", ""Full_Bridge_02"": ""-275.001526"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.422850"", ""Accl_AA222_01_N"": ""-0.419034"", ""Accl_AA222_01_U"": ""-0.392278"", ""Accl_AA222_02_E"": ""-0.387416"", ""Accl_AA222_02_N"": ""0.685328"", ""Accl_AA222_02_U"": ""0.348224"", ""Disp_AA222_01_E"": ""0.001963"", ""Disp_AA222_01_N"": ""0.000888"", ""Disp_AA222_01_U"": ""0.000589"", ""Disp_AA222_02_E"": ""0.000518"", ""Disp_AA222_02_N"": ""0.000547"", ""Disp_AA222_02_U"": ""-0.000167"", ""Thermocouple_01"": ""22.688704""}"
52,1.0.0,2023-12-02 12:40:26.768,S40000,"{""Tiltmeter_01"": ""8.690231"", ""Tiltmeter_02"": ""6.775623"", ""Full_Bridge_01"": ""-407.977631"", ""Full_Bridge_02"": ""-275.001526"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.486449"", ""Accl_AA222_01_N"": ""0.621438"", ""Accl_AA222_01_U"": ""-0.481888"", ""Accl_AA222_02_E"": ""0.284759"", ""Accl_AA222_02_N"": ""-0.671961"", ""Accl_AA222_02_U"": ""-0.293320"", ""Disp_AA222_01_E"": ""0.001450"", ""Disp_AA222_01_N"": ""0.001185"", ""Disp_AA222_01_U"": ""-0.000728"", ""Disp_AA222_02_E"": ""-0.000648"", ""Disp_AA222_02_N"": ""-0.000723"", ""Disp_AA222_02_U"": ""0.000309"", ""Thermocouple_01"": ""22.716642""}"
53,1.0.0,2023-12-02 12:40:27.769,S40000,"{""Tiltmeter_01"": ""8.689259"", ""Tiltmeter_02"": ""6.775131"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.913330"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.464136"", ""Accl_AA222_01_N"": ""-0.513771"", ""Accl_AA222_01_U"": ""-0.497401"", ""Accl_AA222_02_E"": ""0.303478"", ""Accl_AA222_02_N"": ""0.680812"", ""Accl_AA222_02_U"": ""0.159940"", ""Disp_AA222_01_E"": ""-0.000995"", ""Disp_AA222_01_N"": ""-0.001253"", ""Disp_AA222_01_U"": ""0.000321"", ""Disp_AA222_02_E"": ""0.000718"", ""Disp_AA222_02_N"": ""0.000360"", ""Disp_AA222_02_U"": ""-0.000229"", ""Thermocouple_01"": ""22.789286""}"
54,1.0.0,2023-12-02 12:40:28.769,S40000,"{""Tiltmeter_01"": ""8.690844"", ""Tiltmeter_02"": ""6.779772"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.931885"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.437107"", ""Accl_AA222_01_N"": ""-0.540006"", ""Accl_AA222_01_U"": ""-0.497179"", ""Accl_AA222_02_E"": ""-0.213305"", ""Accl_AA222_02_N"": ""0.771508"", ""Accl_AA222_02_U"": ""0.168487"", ""Disp_AA222_01_E"": ""-0.001026"", ""Disp_AA222_01_N"": ""0.000627"", ""Disp_AA222_01_U"": ""-0.000535"", ""Disp_AA222_02_E"": ""-0.000356"", ""Disp_AA222_02_N"": ""-0.000276"", ""Disp_AA222_02_U"": ""-0.000187"", ""Thermocouple_01"": ""22.848890""}"
55,1.0.0,2023-12-02 12:40:29.768,S40000,"{""Tiltmeter_01"": ""8.691628"", ""Tiltmeter_02"": ""6.772505"", ""Full_Bridge_01"": ""-407.986877"", ""Full_Bridge_02"": ""-274.961304"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.633256"", ""Accl_AA222_01_N"": ""-0.407756"", ""Accl_AA222_01_U"": ""0.515620"", ""Accl_AA222_02_E"": ""-0.278255"", ""Accl_AA222_02_N"": ""0.651776"", ""Accl_AA222_02_U"": ""-0.225000"", ""Disp_AA222_01_E"": ""-0.001538"", ""Disp_AA222_01_N"": ""0.000804"", ""Disp_AA222_01_U"": ""-0.000400"", ""Disp_AA222_02_E"": ""0.000545"", ""Disp_AA222_02_N"": ""-0.000273"", ""Disp_AA222_02_U"": ""0.000131"", ""Thermocouple_01"": ""22.879810""}"
56,1.0.0,2023-12-02 12:40:30.769,S40000,"{""Tiltmeter_01"": ""8.687685"", ""Tiltmeter_02"": ""6.775990"", ""Full_Bridge_01"": ""-407.917603"", ""Full_Bridge_02"": ""-274.959747"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.474415"", ""Accl_AA222_01_N"": ""-0.498932"", ""Accl_AA222_01_U"": ""-0.385268"", ""Accl_AA222_02_E"": ""-0.332423"", ""Accl_AA222_02_N"": ""-0.690991"", ""Accl_AA222_02_U"": ""0.247477"", ""Disp_AA222_01_E"": ""0.002649"", ""Disp_AA222_01_N"": ""-0.001875"", ""Disp_AA222_01_U"": ""-0.000797"", ""Disp_AA222_02_E"": ""0.000522"", ""Disp_AA222_02_N"": ""0.000318"", ""Disp_AA222_02_U"": ""0.000163"", ""Thermocouple_01"": ""22.921162""}"
57,1.0.0,2023-12-02 12:40:31.769,S40000,"{""Tiltmeter_01"": ""8.686129"", ""Tiltmeter_02"": ""6.771704"", ""Full_Bridge_01"": ""-407.974579"", ""Full_Bridge_02"": ""-274.956665"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.487519"", ""Accl_AA222_01_N"": ""0.572890"", ""Accl_AA222_01_U"": ""0.375053"", ""Accl_AA222_02_E"": ""-0.309138"", ""Accl_AA222_02_N"": ""-0.715136"", ""Accl_AA222_02_U"": ""-0.287185"", ""Disp_AA222_01_E"": ""-0.001498"", ""Disp_AA222_01_N"": ""-0.001249"", ""Disp_AA222_01_U"": ""-0.000798"", ""Disp_AA222_02_E"": ""0.000480"", ""Disp_AA222_02_N"": ""-0.000451"", ""Disp_AA222_02_U"": ""0.000098"", ""Thermocouple_01"": ""22.927494""}"
58,1.0.0,2023-12-02 12:40:32.769,S40000,"{""Tiltmeter_01"": ""8.684338"", ""Tiltmeter_02"": ""6.770245"", ""Full_Bridge_01"": ""-407.983795"", ""Full_Bridge_02"": ""-274.970581"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.393701"", ""Accl_AA222_01_N"": ""-0.419413"", ""Accl_AA222_01_U"": ""-0.366096"", ""Accl_AA222_02_E"": ""-0.337015"", ""Accl_AA222_02_N"": ""-0.682804"", ""Accl_AA222_02_U"": ""-0.236349"", ""Disp_AA222_01_E"": ""0.001473"", ""Disp_AA222_01_N"": ""-0.000622"", ""Disp_AA222_01_U"": ""-0.000393"", ""Disp_AA222_02_E"": ""-0.000437"", ""Disp_AA222_02_N"": ""-0.000645"", ""Disp_AA222_02_U"": ""0.000351"", ""Thermocouple_01"": ""22.911671""}"
59,1.0.0,2023-12-02 12:40:33.769,S40000,"{""Tiltmeter_01"": ""8.690426"", ""Tiltmeter_02"": ""6.771584"", ""Full_Bridge_01"": ""-407.951477"", ""Full_Bridge_02"": ""-275.051025"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.521185"", ""Accl_AA222_01_N"": ""-0.426460"", ""Accl_AA222_01_U"": ""0.469082"", ""Accl_AA222_02_E"": ""-0.388763"", ""Accl_AA222_02_N"": ""-0.704070"", ""Accl_AA222_02_U"": ""-0.230852"", ""Disp_AA222_01_E"": ""-0.001639"", ""Disp_AA222_01_N"": ""0.001241"", ""Disp_AA222_01_U"": ""-0.000530"", ""Disp_AA222_02_E"": ""-0.000458"", ""Disp_AA222_02_N"": ""-0.000666"", ""Disp_AA222_02_U"": ""0.000370"", ""Thermocouple_01"": ""22.910730""}"
60,1.0.0,2023-12-02 12:40:34.769,S40000,"{""Tiltmeter_01"": ""8.691942"", ""Tiltmeter_02"": ""6.775709"", ""Full_Bridge_01"": ""-407.949951"", ""Full_Bridge_02"": ""-274.961304"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.550451"", ""Accl_AA222_01_N"": ""-0.572299"", ""Accl_AA222_01_U"": ""0.374144"", ""Accl_AA222_02_E"": ""-0.331352"", ""Accl_AA222_02_N"": ""0.706699"", ""Accl_AA222_02_U"": ""0.240452"", ""Disp_AA222_01_E"": ""0.000976"", ""Disp_AA222_01_N"": ""-0.001482"", ""Disp_AA222_01_U"": ""-0.000799"", ""Disp_AA222_02_E"": ""-0.000645"", ""Disp_AA222_02_N"": ""-0.000249"", ""Disp_AA222_02_U"": ""0.000536"", ""Thermocouple_01"": ""22.882046""}"
61,1.0.0,2023-12-02 12:40:35.769,S40000,"{""Tiltmeter_01"": ""8.690746"", ""Tiltmeter_02"": ""6.771990"", ""Full_Bridge_01"": ""-407.949951"", ""Full_Bridge_02"": ""-274.914886"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.438654"", ""Accl_AA222_01_N"": ""-0.469823"", ""Accl_AA222_01_U"": ""-0.511555"", ""Accl_AA222_02_E"": ""0.271435"", ""Accl_AA222_02_N"": ""-0.693604"", ""Accl_AA222_02_U"": ""0.253752"", ""Disp_AA222_01_E"": ""-0.000969"", ""Disp_AA222_01_N"": ""0.000587"", ""Disp_AA222_01_U"": ""-0.000884"", ""Disp_AA222_02_E"": ""0.000463"", ""Disp_AA222_02_N"": ""-0.000236"", ""Disp_AA222_02_U"": ""-0.000499"", ""Thermocouple_01"": ""22.878693""}"
62,1.0.0,2023-12-02 12:40:36.769,S40000,"{""Tiltmeter_01"": ""8.688778"", ""Tiltmeter_02"": ""6.772058"", ""Full_Bridge_01"": ""-407.973022"", ""Full_Bridge_02"": ""-274.978302"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.427073"", ""Accl_AA222_01_N"": ""-0.453604"", ""Accl_AA222_01_U"": ""0.441279"", ""Accl_AA222_02_E"": ""0.409564"", ""Accl_AA222_02_N"": ""-0.676660"", ""Accl_AA222_02_U"": ""-0.228559"", ""Disp_AA222_01_E"": ""0.000816"", ""Disp_AA222_01_N"": ""0.000766"", ""Disp_AA222_01_U"": ""0.001200"", ""Disp_AA222_02_E"": ""-0.000295"", ""Disp_AA222_02_N"": ""0.000499"", ""Disp_AA222_02_U"": ""0.000360"", ""Thermocouple_01"": ""22.871243""}"
63,1.0.0,2023-12-02 12:40:37.769,S40000,"{""Tiltmeter_01"": ""8.687656"", ""Tiltmeter_02"": ""6.772408"", ""Full_Bridge_01"": ""-407.954559"", ""Full_Bridge_02"": ""-274.916443"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.556289"", ""Accl_AA222_01_N"": ""-0.571558"", ""Accl_AA222_01_U"": ""-0.697733"", ""Accl_AA222_02_E"": ""0.365422"", ""Accl_AA222_02_N"": ""0.724897"", ""Accl_AA222_02_U"": ""-0.487049"", ""Disp_AA222_01_E"": ""-0.001207"", ""Disp_AA222_01_N"": ""-0.000889"", ""Disp_AA222_01_U"": ""-0.000625"", ""Disp_AA222_02_E"": ""0.000550"", ""Disp_AA222_02_N"": ""-0.000536"", ""Disp_AA222_02_U"": ""0.000400"", ""Thermocouple_01"": ""22.846106""}"
64,1.0.0,2023-12-02 12:40:38.769,S40000,"{""Tiltmeter_01"": ""8.685665"", ""Tiltmeter_02"": ""6.771412"", ""Full_Bridge_01"": ""-408.045380"", ""Full_Bridge_02"": ""-275.009247"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.447470"", ""Accl_AA222_01_N"": ""0.447837"", ""Accl_AA222_01_U"": ""-0.523081"", ""Accl_AA222_02_E"": ""-0.339553"", ""Accl_AA222_02_N"": ""0.705635"", ""Accl_AA222_02_U"": ""-0.322354"", ""Disp_AA222_01_E"": ""0.001334"", ""Disp_AA222_01_N"": ""0.000677"", ""Disp_AA222_01_U"": ""0.001125"", ""Disp_AA222_02_E"": ""0.000641"", ""Disp_AA222_02_N"": ""0.000413"", ""Disp_AA222_02_U"": ""0.000310"", ""Thermocouple_01"": ""22.819283""}"
65,1.0.0,2023-12-02 12:40:39.769,S40000,"{""Tiltmeter_01"": ""8.688200"", ""Tiltmeter_02"": ""6.773901"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-275.007690"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.460607"", ""Accl_AA222_01_N"": ""-0.562113"", ""Accl_AA222_01_U"": ""-0.358116"", ""Accl_AA222_02_E"": ""0.380346"", ""Accl_AA222_02_N"": ""0.693171"", ""Accl_AA222_02_U"": ""0.251676"", ""Disp_AA222_01_E"": ""0.001116"", ""Disp_AA222_01_N"": ""-0.000668"", ""Disp_AA222_01_U"": ""-0.000807"", ""Disp_AA222_02_E"": ""-0.000622"", ""Disp_AA222_02_N"": ""-0.000328"", ""Disp_AA222_02_U"": ""0.000191"", ""Thermocouple_01"": ""22.793205""}"
66,1.0.0,2023-12-02 12:40:40.769,S40000,"{""Tiltmeter_01"": ""8.691582"", ""Tiltmeter_02"": ""6.770285"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.931885"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.429710"", ""Accl_AA222_01_N"": ""-0.416457"", ""Accl_AA222_01_U"": ""-0.301620"", ""Accl_AA222_02_E"": ""0.403271"", ""Accl_AA222_02_N"": ""-0.718159"", ""Accl_AA222_02_U"": ""0.227807"", ""Disp_AA222_01_E"": ""0.001466"", ""Disp_AA222_01_N"": ""-0.000678"", ""Disp_AA222_01_U"": ""0.000895"", ""Disp_AA222_02_E"": ""0.000699"", ""Disp_AA222_02_N"": ""-0.000516"", ""Disp_AA222_02_U"": ""0.000146"", ""Thermocouple_01"": ""22.783894""}"
67,1.0.0,2023-12-02 12:40:41.769,S40000,"{""Tiltmeter_01"": ""8.684961"", ""Tiltmeter_02"": ""6.773684"", ""Full_Bridge_01"": ""-408.019196"", ""Full_Bridge_02"": ""-275.027802"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.383155"", ""Accl_AA222_01_N"": ""-0.362170"", ""Accl_AA222_01_U"": ""0.496925"", ""Accl_AA222_02_E"": ""-0.234829"", ""Accl_AA222_02_N"": ""-0.647916"", ""Accl_AA222_02_U"": ""0.194345"", ""Disp_AA222_01_E"": ""0.000584"", ""Disp_AA222_01_N"": ""0.000967"", ""Disp_AA222_01_U"": ""-0.000895"", ""Disp_AA222_02_E"": ""-0.000518"", ""Disp_AA222_02_N"": ""0.000448"", ""Disp_AA222_02_U"": ""-0.000226"", ""Thermocouple_01"": ""22.767862""}"
68,1.0.0,2023-12-02 12:40:42.769,S40000,"{""Tiltmeter_01"": ""8.693155"", ""Tiltmeter_02"": ""6.774010"", ""Full_Bridge_01"": ""-408.019196"", ""Full_Bridge_02"": ""-275.027802"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.458764"", ""Accl_AA222_01_N"": ""-0.578349"", ""Accl_AA222_01_U"": ""-0.515289"", ""Accl_AA222_02_E"": ""0.294289"", ""Accl_AA222_02_N"": ""0.686436"", ""Accl_AA222_02_U"": ""0.263203"", ""Disp_AA222_01_E"": ""-0.001156"", ""Disp_AA222_01_N"": ""-0.001028"", ""Disp_AA222_01_U"": ""-0.000371"", ""Disp_AA222_02_E"": ""0.000400"", ""Disp_AA222_02_N"": ""-0.000401"", ""Disp_AA222_02_U"": ""0.000175"", ""Thermocouple_01"": ""22.747934""}"
69,1.0.0,2023-12-02 12:40:43.769,S40000,"{""Tiltmeter_01"": ""8.684080"", ""Tiltmeter_02"": ""6.774376"", ""Full_Bridge_01"": ""-407.966858"", ""Full_Bridge_02"": ""-274.975220"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.428356"", ""Accl_AA222_01_N"": ""-0.473932"", ""Accl_AA222_01_U"": ""0.295257"", ""Accl_AA222_02_E"": ""-0.336224"", ""Accl_AA222_02_N"": ""-0.683381"", ""Accl_AA222_02_U"": ""-0.176329"", ""Disp_AA222_01_E"": ""0.001056"", ""Disp_AA222_01_N"": ""-0.000594"", ""Disp_AA222_01_U"": ""0.000710"", ""Disp_AA222_02_E"": ""-0.000350"", ""Disp_AA222_02_N"": ""-0.000433"", ""Disp_AA222_02_U"": ""-0.000244"", ""Thermocouple_01"": ""22.754091""}"
70,1.0.0,2023-12-02 12:40:44.769,S40000,"{""Tiltmeter_01"": ""8.688034"", ""Tiltmeter_02"": ""6.771549"", ""Full_Bridge_01"": ""-407.966858"", ""Full_Bridge_02"": ""-274.975220"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.522441"", ""Accl_AA222_01_N"": ""0.551856"", ""Accl_AA222_01_U"": ""-0.463810"", ""Accl_AA222_02_E"": ""-0.250808"", ""Accl_AA222_02_N"": ""-0.629559"", ""Accl_AA222_02_U"": ""0.235834"", ""Disp_AA222_01_E"": ""-0.001254"", ""Disp_AA222_01_N"": ""0.001450"", ""Disp_AA222_01_U"": ""0.000683"", ""Disp_AA222_02_E"": ""-0.000580"", ""Disp_AA222_02_N"": ""0.000330"", ""Disp_AA222_02_U"": ""0.000187"", ""Thermocouple_01"": ""22.756504""}"
71,1.0.0,2023-12-02 12:40:45.769,S40000,"{""Tiltmeter_01"": ""8.687616"", ""Tiltmeter_02"": ""6.775354"", ""Full_Bridge_01"": ""-407.993042"", ""Full_Bridge_02"": ""-274.944275"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.569147"", ""Accl_AA222_01_N"": ""0.589273"", ""Accl_AA222_01_U"": ""0.427231"", ""Accl_AA222_02_E"": ""-0.296645"", ""Accl_AA222_02_N"": ""-0.681746"", ""Accl_AA222_02_U"": ""-0.167945"", ""Disp_AA222_01_E"": ""0.001351"", ""Disp_AA222_01_N"": ""0.001796"", ""Disp_AA222_01_U"": ""0.000560"", ""Disp_AA222_02_E"": ""-0.000545"", ""Disp_AA222_02_N"": ""0.000480"", ""Disp_AA222_02_U"": ""-0.000179"", ""Thermocouple_01"": ""22.756504""}"
72,1.0.0,2023-12-02 12:40:46.769,S40000,"{""Tiltmeter_01"": ""8.684566"", ""Tiltmeter_02"": ""6.779966"", ""Full_Bridge_01"": ""-407.976105"", ""Full_Bridge_02"": ""-274.950470"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.427093"", ""Accl_AA222_01_N"": ""0.519828"", ""Accl_AA222_01_U"": ""0.437264"", ""Accl_AA222_02_E"": ""-0.310106"", ""Accl_AA222_02_N"": ""0.638021"", ""Accl_AA222_02_U"": ""-0.179719"", ""Disp_AA222_01_E"": ""-0.001441"", ""Disp_AA222_01_N"": ""0.001785"", ""Disp_AA222_01_U"": ""0.000861"", ""Disp_AA222_02_E"": ""-0.000526"", ""Disp_AA222_02_N"": ""-0.000448"", ""Disp_AA222_02_U"": ""-0.000248"", ""Thermocouple_01"": ""22.736210""}"
73,1.0.0,2023-12-02 12:40:47.769,S40000,"{""Tiltmeter_01"": ""8.686529"", ""Tiltmeter_02"": ""6.779102"", ""Full_Bridge_01"": ""-407.980713"", ""Full_Bridge_02"": ""-274.927246"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.442917"", ""Accl_AA222_01_N"": ""0.502062"", ""Accl_AA222_01_U"": ""-0.423175"", ""Accl_AA222_02_E"": ""0.234816"", ""Accl_AA222_02_N"": ""0.668722"", ""Accl_AA222_02_U"": ""-0.199794"", ""Disp_AA222_01_E"": ""-0.000914"", ""Disp_AA222_01_N"": ""0.001123"", ""Disp_AA222_01_U"": ""0.000965"", ""Disp_AA222_02_E"": ""-0.000324"", ""Disp_AA222_02_N"": ""-0.000562"", ""Disp_AA222_02_U"": ""0.000166"", ""Thermocouple_01"": ""22.712172""}"
74,1.0.0,2023-12-02 12:40:48.769,S40000,"{""Tiltmeter_01"": ""8.690546"", ""Tiltmeter_02"": ""6.772287"", ""Full_Bridge_01"": ""-407.989960"", ""Full_Bridge_02"": ""-274.967468"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.453139"", ""Accl_AA222_01_N"": ""0.427700"", ""Accl_AA222_01_U"": ""0.379805"", ""Accl_AA222_02_E"": ""0.250019"", ""Accl_AA222_02_N"": ""0.670775"", ""Accl_AA222_02_U"": ""-0.364476"", ""Disp_AA222_01_E"": ""0.001268"", ""Disp_AA222_01_N"": ""-0.000557"", ""Disp_AA222_01_U"": ""-0.001104"", ""Disp_AA222_02_E"": ""-0.000146"", ""Disp_AA222_02_N"": ""0.000544"", ""Disp_AA222_02_U"": ""0.000206"", ""Thermocouple_01"": ""22.705650""}"
75,1.0.0,2023-12-02 12:40:49.769,S40000,"{""Tiltmeter_01"": ""8.687073"", ""Tiltmeter_02"": ""6.771996"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.967468"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.422250"", ""Accl_AA222_01_N"": ""0.407148"", ""Accl_AA222_01_U"": ""-0.356110"", ""Accl_AA222_02_E"": ""-0.190401"", ""Accl_AA222_02_N"": ""0.690169"", ""Accl_AA222_02_U"": ""0.201231"", ""Disp_AA222_01_E"": ""-0.002104"", ""Disp_AA222_01_N"": ""0.001178"", ""Disp_AA222_01_U"": ""0.000932"", ""Disp_AA222_02_E"": ""0.000180"", ""Disp_AA222_02_N"": ""0.000483"", ""Disp_AA222_02_U"": ""0.000269"", ""Thermocouple_01"": ""22.708447""}"
76,1.0.0,2023-12-02 12:40:50.769,S40000,"{""Tiltmeter_01"": ""8.686695"", ""Tiltmeter_02"": ""6.769283"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.436671"", ""Accl_AA222_01_N"": ""0.427926"", ""Accl_AA222_01_U"": ""-0.398690"", ""Accl_AA222_02_E"": ""-0.287567"", ""Accl_AA222_02_N"": ""-0.663984"", ""Accl_AA222_02_U"": ""-0.183191"", ""Disp_AA222_01_E"": ""0.001235"", ""Disp_AA222_01_N"": ""0.000610"", ""Disp_AA222_01_U"": ""-0.000653"", ""Disp_AA222_02_E"": ""-0.000366"", ""Disp_AA222_02_N"": ""0.000207"", ""Disp_AA222_02_U"": ""0.000164"", ""Thermocouple_01"": ""22.703054""}"
77,1.0.0,2023-12-02 12:40:51.769,S40000,"{""Tiltmeter_01"": ""8.681946"", ""Tiltmeter_02"": ""6.772305"", ""Full_Bridge_01"": ""-407.982269"", ""Full_Bridge_02"": ""-274.973663"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.418472"", ""Accl_AA222_01_N"": ""0.574644"", ""Accl_AA222_01_U"": ""-0.441135"", ""Accl_AA222_02_E"": ""-0.286802"", ""Accl_AA222_02_N"": ""0.697134"", ""Accl_AA222_02_U"": ""-0.187954"", ""Disp_AA222_01_E"": ""-0.001503"", ""Disp_AA222_01_N"": ""-0.001179"", ""Disp_AA222_01_U"": ""0.000598"", ""Disp_AA222_02_E"": ""0.000473"", ""Disp_AA222_02_N"": ""0.000337"", ""Disp_AA222_02_U"": ""-0.000207"", ""Thermocouple_01"": ""22.692623""}"
78,1.0.0,2023-12-02 12:40:52.769,S40000,"{""Tiltmeter_01"": ""8.695278"", ""Tiltmeter_02"": ""6.772505"", ""Full_Bridge_01"": ""-407.977631"", ""Full_Bridge_02"": ""-274.950470"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.428333"", ""Accl_AA222_01_N"": ""0.439887"", ""Accl_AA222_01_U"": ""-0.364504"", ""Accl_AA222_02_E"": ""0.445304"", ""Accl_AA222_02_N"": ""0.681783"", ""Accl_AA222_02_U"": ""-0.207206"", ""Disp_AA222_01_E"": ""0.001242"", ""Disp_AA222_01_N"": ""0.001422"", ""Disp_AA222_01_U"": ""-0.000430"", ""Disp_AA222_02_E"": ""-0.000431"", ""Disp_AA222_02_N"": ""0.000200"", ""Disp_AA222_02_U"": ""0.000271"", ""Thermocouple_01"": ""22.685722""}"
79,1.0.0,2023-12-02 12:40:53.769,S40000,"{""Tiltmeter_01"": ""8.691793"", ""Tiltmeter_02"": ""6.776436"", ""Full_Bridge_01"": ""-407.994568"", ""Full_Bridge_02"": ""-274.950470"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.423073"", ""Accl_AA222_01_N"": ""0.587315"", ""Accl_AA222_01_U"": ""-0.450390"", ""Accl_AA222_02_E"": ""-0.311584"", ""Accl_AA222_02_N"": ""-0.748762"", ""Accl_AA222_02_U"": ""-0.167948"", ""Disp_AA222_01_E"": ""0.000782"", ""Disp_AA222_01_N"": ""-0.000868"", ""Disp_AA222_01_U"": ""-0.000617"", ""Disp_AA222_02_E"": ""-0.000496"", ""Disp_AA222_02_N"": ""-0.000156"", ""Disp_AA222_02_U"": ""-0.000308"", ""Thermocouple_01"": ""22.690004""}"
80,1.0.0,2023-12-02 12:40:54.769,S40000,"{""Tiltmeter_01"": ""8.686964"", ""Tiltmeter_02"": ""6.775143"", ""Full_Bridge_01"": ""-407.991486"", ""Full_Bridge_02"": ""-274.978302"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.424770"", ""Accl_AA222_01_N"": ""0.529023"", ""Accl_AA222_01_U"": ""0.403838"", ""Accl_AA222_02_E"": ""-0.274174"", ""Accl_AA222_02_N"": ""-0.710463"", ""Accl_AA222_02_U"": ""0.181145"", ""Disp_AA222_01_E"": ""-0.001048"", ""Disp_AA222_01_N"": ""0.000842"", ""Disp_AA222_01_U"": ""-0.000613"", ""Disp_AA222_02_E"": ""-0.000519"", ""Disp_AA222_02_N"": ""0.000249"", ""Disp_AA222_02_U"": ""0.000303"", ""Thermocouple_01"": ""22.690004""}"
81,1.0.0,2023-12-02 12:40:55.769,S40000,"{""Tiltmeter_01"": ""8.689831"", ""Tiltmeter_02"": ""6.769724"", ""Full_Bridge_01"": ""-407.968414"", ""Full_Bridge_02"": ""-274.999969"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.375552"", ""Accl_AA222_01_N"": ""-0.392415"", ""Accl_AA222_01_U"": ""-0.369909"", ""Accl_AA222_02_E"": ""0.289985"", ""Accl_AA222_02_N"": ""0.738177"", ""Accl_AA222_02_U"": ""0.215048"", ""Disp_AA222_01_E"": ""0.001164"", ""Disp_AA222_01_N"": ""0.001124"", ""Disp_AA222_01_U"": ""-0.000951"", ""Disp_AA222_02_E"": ""-0.000291"", ""Disp_AA222_02_N"": ""0.000317"", ""Disp_AA222_02_U"": ""-0.000381"", ""Thermocouple_01"": ""22.670271""}"
82,1.0.0,2023-12-02 12:40:56.769,S40000,"{""Tiltmeter_01"": ""8.685659"", ""Tiltmeter_02"": ""6.767275"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-275.027802"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.487557"", ""Accl_AA222_01_N"": ""0.430367"", ""Accl_AA222_01_U"": ""-0.588808"", ""Accl_AA222_02_E"": ""-0.321757"", ""Accl_AA222_02_N"": ""0.716363"", ""Accl_AA222_02_U"": ""0.427847"", ""Disp_AA222_01_E"": ""-0.000836"", ""Disp_AA222_01_N"": ""-0.000997"", ""Disp_AA222_01_U"": ""-0.000984"", ""Disp_AA222_02_E"": ""0.000395"", ""Disp_AA222_02_N"": ""-0.000470"", ""Disp_AA222_02_U"": ""-0.000393"", ""Thermocouple_01"": ""22.662626""}"
83,1.0.0,2023-12-02 12:40:57.77,S40000,"{""Tiltmeter_01"": ""8.682850"", ""Tiltmeter_02"": ""6.770021"", ""Full_Bridge_01"": ""-407.996124"", ""Full_Bridge_02"": ""-275.027802"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.485230"", ""Accl_AA222_01_N"": ""-0.548251"", ""Accl_AA222_01_U"": ""-0.738158"", ""Accl_AA222_02_E"": ""0.348900"", ""Accl_AA222_02_N"": ""-0.697747"", ""Accl_AA222_02_U"": ""0.275431"", ""Disp_AA222_01_E"": ""-0.000865"", ""Disp_AA222_01_N"": ""0.000703"", ""Disp_AA222_01_U"": ""0.000742"", ""Disp_AA222_02_E"": ""-0.000478"", ""Disp_AA222_02_N"": ""-0.000394"", ""Disp_AA222_02_U"": ""-0.000186"", ""Thermocouple_01"": ""22.657232""}"
84,1.0.0,2023-12-02 12:40:58.769,S40000,"{""Tiltmeter_01"": ""8.683714"", ""Tiltmeter_02"": ""6.776911"", ""Full_Bridge_01"": ""-407.988434"", ""Full_Bridge_02"": ""-274.933441"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.484199"", ""Accl_AA222_01_N"": ""-0.473024"", ""Accl_AA222_01_U"": ""-0.851424"", ""Accl_AA222_02_E"": ""-0.624855"", ""Accl_AA222_02_N"": ""-0.716808"", ""Accl_AA222_02_U"": ""0.494820"", ""Disp_AA222_01_E"": ""0.000890"", ""Disp_AA222_01_N"": ""0.000717"", ""Disp_AA222_01_U"": ""0.000528"", ""Disp_AA222_02_E"": ""0.000257"", ""Disp_AA222_02_N"": ""0.000362"", ""Disp_AA222_02_U"": ""-0.000341"", ""Thermocouple_01"": ""22.657232""}"
85,1.0.0,2023-12-02 12:40:59.769,S40000,"{""Tiltmeter_01"": ""8.694231"", ""Tiltmeter_02"": ""6.772928"", ""Full_Bridge_01"": ""-407.959167"", ""Full_Bridge_02"": ""-274.969025"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.415001"", ""Accl_AA222_01_N"": ""0.445487"", ""Accl_AA222_01_U"": ""0.709357"", ""Accl_AA222_02_E"": ""0.515928"", ""Accl_AA222_02_N"": ""-0.712823"", ""Accl_AA222_02_U"": ""-0.380977"", ""Disp_AA222_01_E"": ""-0.000610"", ""Disp_AA222_01_N"": ""0.000729"", ""Disp_AA222_01_U"": ""0.000455"", ""Disp_AA222_02_E"": ""-0.000387"", ""Disp_AA222_02_N"": ""0.000657"", ""Disp_AA222_02_U"": ""-0.000223"", ""Thermocouple_01"": ""22.648293""}"
86,1.0.0,2023-12-02 12:41:00.77,S40000,"{""Tiltmeter_01"": ""8.683537"", ""Tiltmeter_02"": ""6.773437"", ""Full_Bridge_01"": ""-407.956085"", ""Full_Bridge_02"": ""-274.969025"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.407485"", ""Accl_AA222_01_N"": ""-0.580252"", ""Accl_AA222_01_U"": ""0.711777"", ""Accl_AA222_02_E"": ""0.464350"", ""Accl_AA222_02_N"": ""0.650404"", ""Accl_AA222_02_U"": ""-0.614294"", ""Disp_AA222_01_E"": ""-0.000382"", ""Disp_AA222_01_N"": ""-0.000743"", ""Disp_AA222_01_U"": ""-0.000632"", ""Disp_AA222_02_E"": ""0.000328"", ""Disp_AA222_02_N"": ""-0.000637"", ""Disp_AA222_02_U"": ""-0.000267"", ""Thermocouple_01"": ""22.633196""}"
87,1.0.0,2023-12-02 12:41:01.769,S40000,"{""Tiltmeter_01"": ""8.685625"", ""Tiltmeter_02"": ""6.771086"", ""Full_Bridge_01"": ""-407.951477"", ""Full_Bridge_02"": ""-274.981415"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.430785"", ""Accl_AA222_01_N"": ""-0.479202"", ""Accl_AA222_01_U"": ""-0.949919"", ""Accl_AA222_02_E"": ""-0.432746"", ""Accl_AA222_02_N"": ""-0.722930"", ""Accl_AA222_02_U"": ""-0.414265"", ""Disp_AA222_01_E"": ""-0.000441"", ""Disp_AA222_01_N"": ""0.000812"", ""Disp_AA222_01_U"": ""0.000618"", ""Disp_AA222_02_E"": ""0.000458"", ""Disp_AA222_02_N"": ""0.000506"", ""Disp_AA222_02_U"": ""0.000203"", ""Thermocouple_01"": ""22.644745""}"
88,1.0.0,2023-12-02 12:41:02.769,S40000,"{""Tiltmeter_01"": ""8.691891"", ""Tiltmeter_02"": ""6.769524"", ""Full_Bridge_01"": ""-407.962250"", ""Full_Bridge_02"": ""-274.938080"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.417958"", ""Accl_AA222_01_N"": ""-0.626126"", ""Accl_AA222_01_U"": ""-0.573865"", ""Accl_AA222_02_E"": ""0.347600"", ""Accl_AA222_02_N"": ""-0.734314"", ""Accl_AA222_02_U"": ""-0.294724"", ""Disp_AA222_01_E"": ""0.001172"", ""Disp_AA222_01_N"": ""0.000669"", ""Disp_AA222_01_U"": ""-0.001140"", ""Disp_AA222_02_E"": ""-0.000322"", ""Disp_AA222_02_N"": ""-0.000402"", ""Disp_AA222_02_U"": ""-0.000123"", ""Thermocouple_01"": ""22.688704""}"
89,1.0.0,2023-12-02 12:41:03.769,S40000,"{""Tiltmeter_01"": ""8.686918"", ""Tiltmeter_02"": ""6.771618"", ""Full_Bridge_01"": ""-407.986877"", ""Full_Bridge_02"": ""-274.972137"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.429929"", ""Accl_AA222_01_N"": ""-0.475629"", ""Accl_AA222_01_U"": ""0.525934"", ""Accl_AA222_02_E"": ""-0.349060"", ""Accl_AA222_02_N"": ""0.773833"", ""Accl_AA222_02_U"": ""-0.310623"", ""Disp_AA222_01_E"": ""-0.001933"", ""Disp_AA222_01_N"": ""0.001123"", ""Disp_AA222_01_U"": ""0.001006"", ""Disp_AA222_02_E"": ""0.000280"", ""Disp_AA222_02_N"": ""0.000538"", ""Disp_AA222_02_U"": ""-0.000126"", ""Thermocouple_01"": ""22.725779""}"
90,1.0.0,2023-12-02 12:41:04.769,S40000,"{""Tiltmeter_01"": ""8.688658"", ""Tiltmeter_02"": ""6.774536"", ""Full_Bridge_01"": ""-408.005341"", ""Full_Bridge_02"": ""-274.972137"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.505146"", ""Accl_AA222_01_N"": ""0.450275"", ""Accl_AA222_01_U"": ""-0.454436"", ""Accl_AA222_02_E"": ""-0.319699"", ""Accl_AA222_02_N"": ""-0.693959"", ""Accl_AA222_02_U"": ""0.252008"", ""Disp_AA222_01_E"": ""0.001839"", ""Disp_AA222_01_N"": ""-0.000905"", ""Disp_AA222_01_U"": ""-0.000577"", ""Disp_AA222_02_E"": ""0.000494"", ""Disp_AA222_02_N"": ""-0.000429"", ""Disp_AA222_02_U"": ""0.000152"", ""Thermocouple_01"": ""22.816853""}"
91,1.0.0,2023-12-02 12:41:05.769,S40000,"{""Tiltmeter_01"": ""8.691473"", ""Tiltmeter_02"": ""6.774588"", ""Full_Bridge_01"": ""-407.968414"", ""Full_Bridge_02"": ""-274.998413"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.465348"", ""Accl_AA222_01_N"": ""0.552763"", ""Accl_AA222_01_U"": ""-0.408750"", ""Accl_AA222_02_E"": ""0.270218"", ""Accl_AA222_02_N"": ""0.687440"", ""Accl_AA222_02_U"": ""0.232012"", ""Disp_AA222_01_E"": ""0.001445"", ""Disp_AA222_01_N"": ""-0.000912"", ""Disp_AA222_01_U"": ""0.000316"", ""Disp_AA222_02_E"": ""0.000496"", ""Disp_AA222_02_N"": ""-0.000530"", ""Disp_AA222_02_U"": ""0.000172"", ""Thermocouple_01"": ""22.886711""}"
92,1.0.0,2023-12-02 12:41:06.769,S40000,"{""Tiltmeter_01"": ""8.692995"", ""Tiltmeter_02"": ""6.778032"", ""Full_Bridge_01"": ""-407.954559"", ""Full_Bridge_02"": ""-274.976776"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.471435"", ""Accl_AA222_01_N"": ""-0.587709"", ""Accl_AA222_01_U"": ""-0.605257"", ""Accl_AA222_02_E"": ""0.306483"", ""Accl_AA222_02_N"": ""0.687421"", ""Accl_AA222_02_U"": ""0.284495"", ""Disp_AA222_01_E"": ""0.000827"", ""Disp_AA222_01_N"": ""0.000737"", ""Disp_AA222_01_U"": ""-0.000514"", ""Disp_AA222_02_E"": ""-0.000593"", ""Disp_AA222_02_N"": ""0.000610"", ""Disp_AA222_02_U"": ""0.000267"", ""Thermocouple_01"": ""22.917257""}"
93,1.0.0,2023-12-02 12:41:07.769,S40000,"{""Tiltmeter_01"": ""8.692881"", ""Tiltmeter_02"": ""6.780081"", ""Full_Bridge_01"": ""-407.960724"", ""Full_Bridge_02"": ""-274.956665"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.445629"", ""Accl_AA222_01_N"": ""-0.534142"", ""Accl_AA222_01_U"": ""-0.447324"", ""Accl_AA222_02_E"": ""0.247584"", ""Accl_AA222_02_N"": ""-0.675730"", ""Accl_AA222_02_U"": ""0.206135"", ""Disp_AA222_01_E"": ""-0.001608"", ""Disp_AA222_01_N"": ""0.001483"", ""Disp_AA222_01_U"": ""0.000800"", ""Disp_AA222_02_E"": ""0.000419"", ""Disp_AA222_02_N"": ""-0.000653"", ""Disp_AA222_02_U"": ""0.000239"", ""Thermocouple_01"": ""22.951530""}"
94,1.0.0,2023-12-02 12:41:08.769,S40000,"{""Tiltmeter_01"": ""8.694706"", ""Tiltmeter_02"": ""6.772968"", ""Full_Bridge_01"": ""-408.014587"", ""Full_Bridge_02"": ""-274.987579"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.400042"", ""Accl_AA222_01_N"": ""-0.581065"", ""Accl_AA222_01_U"": ""0.508095"", ""Accl_AA222_02_E"": ""-0.260214"", ""Accl_AA222_02_N"": ""-0.738096"", ""Accl_AA222_02_U"": ""0.242951"", ""Disp_AA222_01_E"": ""0.002020"", ""Disp_AA222_01_N"": ""-0.001191"", ""Disp_AA222_01_U"": ""-0.000947"", ""Disp_AA222_02_E"": ""-0.000306"", ""Disp_AA222_02_N"": ""0.000296"", ""Disp_AA222_02_U"": ""0.000150"", ""Thermocouple_01"": ""22.993614""}"
95,1.0.0,2023-12-02 12:41:09.769,S40000,"{""Tiltmeter_01"": ""8.689705"", ""Tiltmeter_02"": ""6.772430"", ""Full_Bridge_01"": ""-407.903748"", ""Full_Bridge_02"": ""-274.950470"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.414254"", ""Accl_AA222_01_N"": ""0.582974"", ""Accl_AA222_01_U"": ""0.508051"", ""Accl_AA222_02_E"": ""-0.330455"", ""Accl_AA222_02_N"": ""0.731387"", ""Accl_AA222_02_U"": ""0.201794"", ""Disp_AA222_01_E"": ""-0.001777"", ""Disp_AA222_01_N"": ""0.000471"", ""Disp_AA222_01_U"": ""0.000667"", ""Disp_AA222_02_E"": ""-0.000653"", ""Disp_AA222_02_N"": ""-0.000414"", ""Disp_AA222_02_U"": ""-0.000197"", ""Thermocouple_01"": ""23.023949""}"
96,1.0.0,2023-12-02 12:41:10.769,S40000,"{""Tiltmeter_01"": ""8.692383"", ""Tiltmeter_02"": ""6.778908"", ""Full_Bridge_01"": ""-407.957642"", ""Full_Bridge_02"": ""-274.904053"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.492762"", ""Accl_AA222_01_N"": ""-0.530948"", ""Accl_AA222_01_U"": ""-0.453827"", ""Accl_AA222_02_E"": ""-0.222076"", ""Accl_AA222_02_N"": ""-0.709304"", ""Accl_AA222_02_U"": ""-0.252023"", ""Disp_AA222_01_E"": ""0.001122"", ""Disp_AA222_01_N"": ""-0.001151"", ""Disp_AA222_01_U"": ""-0.000681"", ""Disp_AA222_02_E"": ""0.000743"", ""Disp_AA222_02_N"": ""-0.000353"", ""Disp_AA222_02_U"": ""-0.000237"", ""Thermocouple_01"": ""23.038122""}"
97,1.0.0,2023-12-02 12:41:11.769,S40000,"{""Tiltmeter_01"": ""8.688028"", ""Tiltmeter_02"": ""6.778662"", ""Full_Bridge_01"": ""-407.920685"", ""Full_Bridge_02"": ""-274.945831"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.521059"", ""Accl_AA222_01_N"": ""0.489667"", ""Accl_AA222_01_U"": ""0.443171"", ""Accl_AA222_02_E"": ""0.313083"", ""Accl_AA222_02_N"": ""0.665370"", ""Accl_AA222_02_U"": ""-0.424720"", ""Disp_AA222_01_E"": ""-0.000939"", ""Disp_AA222_01_N"": ""-0.000596"", ""Disp_AA222_01_U"": ""0.000845"", ""Disp_AA222_02_E"": ""-0.000244"", ""Disp_AA222_02_N"": ""-0.000677"", ""Disp_AA222_02_U"": ""0.000332"", ""Thermocouple_01"": ""23.013218""}"
98,1.0.0,2023-12-02 12:41:12.769,S40000,"{""Tiltmeter_01"": ""8.685024"", ""Tiltmeter_02"": ""6.772985"", ""Full_Bridge_01"": ""-407.880676"", ""Full_Bridge_02"": ""-274.953552"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.517918"", ""Accl_AA222_01_N"": ""0.590316"", ""Accl_AA222_01_U"": ""0.348268"", ""Accl_AA222_02_E"": ""-0.270630"", ""Accl_AA222_02_N"": ""0.606483"", ""Accl_AA222_02_U"": ""0.293928"", ""Disp_AA222_01_E"": ""0.001100"", ""Disp_AA222_01_N"": ""-0.000986"", ""Disp_AA222_01_U"": ""0.000754"", ""Disp_AA222_02_E"": ""0.000358"", ""Disp_AA222_02_N"": ""0.000578"", ""Disp_AA222_02_U"": ""-0.000419"", ""Thermocouple_01"": ""22.993059""}"
99,1.0.0,2023-12-02 12:41:13.769,S40000,"{""Tiltmeter_01"": ""8.690992"", ""Tiltmeter_02"": ""6.780155"", ""Full_Bridge_01"": ""-407.960724"", ""Full_Bridge_02"": ""-274.953552"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""0.510328"", ""Accl_AA222_01_N"": ""-0.469135"", ""Accl_AA222_01_U"": ""-0.340750"", ""Accl_AA222_02_E"": ""0.293026"", ""Accl_AA222_02_N"": ""-0.701056"", ""Accl_AA222_02_U"": ""0.288002"", ""Disp_AA222_01_E"": ""-0.001451"", ""Disp_AA222_01_N"": ""0.001304"", ""Disp_AA222_01_U"": ""0.000807"", ""Disp_AA222_02_E"": ""0.000474"", ""Disp_AA222_02_N"": ""-0.000375"", ""Disp_AA222_02_U"": ""-0.000366"", ""Thermocouple_01"": ""22.961767""}"
100,1.0.0,2023-12-02 12:41:14.769,S40000,"{""Tiltmeter_01"": ""8.684372"", ""Tiltmeter_02"": ""6.769638"", ""Full_Bridge_01"": ""-407.986877"", ""Full_Bridge_02"": ""-275.010803"", ""Full_Bridge_03"": ""-0.000000"", ""Accl_AA222_01_E"": ""-0.408127"", ""Accl_AA222_01_N"": ""-0.410629"", ""Accl_AA222_01_U"": ""0.492056"", ""Accl_AA222_02_E"": ""0.230076"", ""Accl_AA222_02_N"": ""-0.651000"", ""Accl_AA222_02_U"": ""-0.244163"", ""Disp_AA222_01_E"": ""0.000751"", ""Disp_AA222_01_N"": ""-0.001192"", ""Disp_AA222_01_U"": ""-0.000920"", ""Disp_AA222_02_E"": ""0.000591"", ""Disp_AA222_02_N"": ""0.000333"", ""Disp_AA222_02_U"": ""0.000381"", ""Thermocouple_01"": ""22.942022""}"
id,name,email,email_verified_at,password,id_vendor,role,isDeleted,remember_token,created_at,updated_at
2,Admin GSI,admin@gsi.co.id,,$2y$10$pQ69BqMwPxZXCXOd71/wqewYkZKstyXePEzbleYAZ4Xp4Xmd/GK8O,,Admin GSI,0,,2023-12-24 15:24:11,2023-12-25 07:22:24
10,Rofi,rofi@gmail.com,,$2y$10$YMVx7E9hC/1V90QLjJbCL.mDCGUkFbAm2lBFtcr.Thfd2kHhAuFhu,7,Admin Vendor,1,,2024-02-28 15:19:08,2024-02-28 15:20:15
12,wahyu tri,wahyusandi@protonmail.com,,$2y$10$1/NTog6GBbzE93xLGGRMvOc732EguZwHPB97tS6IKeSQ5xiAQ5aYu,7,Admin Vendor,0,,2024-02-29 14:34:11,2024-02-29 14:37:59
13,Riko,riko@lms.com,,$2y$10$wnvIKuvAK6kkRD/AayKhUeq.ytmFM9jGPRDPpuzwNQcW8iV1YvIii,7,Admin Vendor,1,,2024-02-29 14:52:13,2024-03-14 12:34:52
14,Admin LINTAS MARGA SEDAYA,adminlsm@gmail.com,,$2y$10$vuMYdomRl6inrPW1XbPs7.cJUa0RykcGuNujfTLFvmUyf/DznGFFe,10,Admin Vendor,0,,2024-05-24 10:34:32,2024-05-24 10:34:32
15,Wahyu Tri,Wahyusandi004@gmail.com,,$2y$10$vG6.jFilqpghJm1aMNjnyuPkqrlXwLuqAY/BJexjwudSJCa79xFlm,11,Admin Vendor,0,,2024-06-06 11:18:05,2024-06-06 11:18:05
1,Administrator,administrator@gmail.com,,$2y$10$P8KHVe79XCANtgJ0voYYRuHvHsFjLOELwLg5fInBV/VhhSlMwElrK,,Super Admin,0,,2023-12-24 15:24:11,2024-09-02 10:09:42
id,nama_vendor,slug,foto,isDeleted,created_at,updated_at
8,PT. LINTAS MARGA SEDAYA-CIPALI,pt-lintas-marga-sedaya-cipali,default.jpeg,1,2024-03-14 12:37:58,2024-05-27 10:17:22
11,PT. LINTAS MARGA SEDAYA,pt-lintas-marga-sedaya,202406061717648467_DJI_0527.JPG.JPG,0,2024-05-27 10:18:38,2024-06-06 11:34:27
9,PT. LINTAS MARGA SEDAYA ( CIPALI ),pt-lintas-marga-sedaya-cipali,202403141710394682_DJI_0527.JPG.JPG,1,2024-03-14 12:38:02,2024-03-14 12:38:07
7,PT. LINTAS MARGA SEDAYA,pt-lintas-marga-sedaya,202402261708917747_DJI_0527.JPG.JPG,1,2024-02-26 10:22:27,2024-03-14 12:36:08
12,R,r,default.jpeg,1,2024-11-26 14:29:24,2024-11-26 15:16:12
13,tr,tr,default.jpeg,1,2024-11-28 09:13:08,2024-11-28 09:13:37
id,id_lokasi,nama_span,foto,isDeleted,created_at,updated_at,stationId,x_position,y_position
15,12,SPAN 5,default.jpg,0,2024-03-06 08:45:58,2024-03-06 08:46:04,21212,1717.1875,175.46875
13,12,3,default.jpg,0,2024-03-05 09:37:57,2024-03-06 08:46:11,432423,957.65625,350.46875
12,12,2,default.jpg,0,2024-03-05 09:37:44,2024-03-06 08:58:03,121,747,400.46875
20,16,aaa,default.jpg,1,2024-08-01 16:58:58,2024-08-09 08:34:03,span 2,735,292.046875
16,12,7,default.jpg,0,2024-03-06 09:03:59,2024-03-06 09:04:07,hggj,1520.359375,195.46875
11,12,SPAN_3,202402291709190876_DJI_0524.JPG.JPG,0,2024-02-26 10:29:06,2024-03-12 22:31:13,S40000,1144.96533203125,301.23959732055664
14,12,,default.jpg,0,2024-03-05 09:38:10,2024-03-14 12:35:20,,1228.5,263.46875
22,16,dfsdf,default.jpg,1,2024-08-09 10:21:29,2024-08-09 10:22:50,fsdfsd,914,289.375
23,16,sdfsd,default.jpg,1,2024-08-09 10:22:22,2024-08-09 10:22:55,4,1039.5,277.375
21,16,dfsdf,default.jpg,1,2024-08-09 10:21:28,2024-08-09 10:23:03,fsdfsd,747,292.375
17,16,Span-1,202403141710395210_DJI_0667.JPG.JPG,0,2024-03-14 12:45:42,2024-12-06 12:10:59,S40000,934.8125,197.10418701171875
id,id_span,id_parameter,satuan,batas_bawah,batas_atas,isDeleted,created_at,updated_at,nama_sensor
47,17,2,Gal,45,55,1,2024-03-15 13:14:37,2024-05-27 10:12:05,Disp_AA222_02_N
48,17,2,Gal,45,55,1,2024-03-15 13:14:47,2024-05-27 10:12:10,Disp_AA222_02_E
49,17,2,Gal,45,55,1,2024-03-15 13:14:55,2024-05-27 10:12:17,Disp_AA222_02_U
50,17,1,Degree,45,55,1,2024-03-15 13:15:37,2024-05-27 10:12:20,Tiltmeter_01
51,17,1,Degree,45,55,1,2024-03-15 13:16:03,2024-05-27 10:12:23,Tiltmeter_02
52,17,3,Microstrain,45,55,1,2024-03-15 13:16:30,2024-05-27 10:12:26,Full_Bridge_01
53,17,3,Microstrain,45,55,1,2024-03-15 13:16:39,2024-05-27 10:12:28,Full_Bridge_02
56,17,2,Gal,45,55,0,2024-05-27 17:05:30,2024-05-27 17:05:30,Accl_AA222_01_U
57,17,2,Gal,45,55,0,2024-05-29 20:41:53,2024-05-29 20:41:53,Accl_AA222_02_N
58,17,2,Gal,45,55,0,2024-05-29 20:42:17,2024-05-29 20:42:17,Accl_AA222_02_E
16,11,2,Gal,45,55,1,2024-02-26 10:33:48,2024-02-28 16:06:59,Accl_AA222_01_N
17,11,2,Gal,30,55,1,2024-02-26 10:36:30,2024-02-29 14:32:11,Accl_AA222_01_E
59,17,2,Gal,45,55,0,2024-05-29 20:42:36,2024-05-29 20:42:36,Accl_AA222_02_U
18,11,2,Gal,40,55,1,2024-02-26 10:37:08,2024-02-29 14:13:24,Accl_AA222_01_U
19,11,2,Gal,30,55,1,2024-02-26 10:38:43,2024-02-29 14:32:17,Disp_AA222_01_N
60,17,3,Microstrain,45,55,0,2024-07-05 11:24:40,2024-07-05 11:24:40,Full_Bridge_01
20,11,2,Gal,30,55,1,2024-02-26 10:38:55,2024-02-29 14:32:24,Disp_AA222_01_E
21,11,2,Gal,45,55,1,2024-02-26 10:39:06,2024-02-26 13:15:29,Disp_AA222_01_U
22,11,2,Gal,45,55,1,2024-02-26 10:39:39,2024-02-28 16:07:06,Accl_AA222_02_N
23,11,2,Gal,45,55,1,2024-02-26 10:39:49,2024-02-27 16:59:07,Accl_AA222_02_E
61,17,3,Microstrain,45,55,0,2024-07-05 11:25:02,2024-07-05 11:25:02,Full_Bridge_02
62,17,1,Degree,45,55,0,2024-07-05 11:25:39,2024-07-05 11:25:39,Tiltmeter_01
31,11,1,Gal,45,55,1,2024-02-26 10:42:22,2024-02-27 17:00:13,Tiltmeter_02
30,11,1,Gal,45,55,1,2024-02-26 10:42:13,2024-02-27 17:00:05,Tiltmeter_01
29,11,3,Microstrain,30,55,1,2024-02-26 10:42:03,2024-02-29 14:31:59,Full_Bridge_02
28,11,3,Microstrain,30,55,1,2024-02-26 10:41:52,2024-02-29 14:32:30,Full_Bridge_01
27,11,2,Gal,45,55,1,2024-02-26 10:40:38,2024-02-27 16:59:58,Disp_AA222_02_U
26,11,2,Gal,45,55,1,2024-02-26 10:40:26,2024-02-27 16:59:13,Disp_AA222_02_E
25,11,2,Gal,45,55,1,2024-02-26 10:40:16,2024-02-27 16:59:37,Disp_AA222_02_N
63,17,1,Degree,45,55,0,2024-07-05 11:25:55,2024-07-05 11:25:55,Tiltmeter_02
54,17,2,Gal,10,30,0,2024-05-27 10:13:47,2024-08-09 10:58:30,Accl_AA222_01_N
24,11,2,Gal,45,55,1,2024-02-26 10:40:01,2024-02-27 16:50:55,Accl_AA222_02_U
55,17,2,Gal,45,55,0,2024-05-27 10:15:19,2024-08-09 13:58:24,Accl_AA222_01_E
38,17,2,Gal,45,55,1,2024-03-14 21:56:32,2024-05-27 10:11:22,Accl_AA222_01_U
39,17,2,Gal,45,55,1,2024-03-14 21:59:37,2024-05-27 10:11:25,Accl_AA222_01_N
40,17,2,Gal,45,55,1,2024-03-14 22:00:48,2024-05-27 10:11:28,Accl_AA222_01_E
41,17,2,Gal,45,55,1,2024-03-15 13:08:17,2024-05-27 10:11:33,Accl_AA222_02_N
42,17,2,Gal,45,55,1,2024-03-15 13:08:49,2024-05-27 10:11:37,Accl_AA222_02_U
43,17,2,Gal,45,55,1,2024-03-15 13:09:12,2024-05-27 10:11:44,Accl_AA222_02_E
44,17,2,Gal,45,55,1,2024-03-15 13:12:45,2024-05-27 10:11:56,Disp_AA222_01_N
45,17,2,Gal,45,55,1,2024-03-15 13:13:55,2024-05-27 10:11:59,Disp_AA222_01_E
46,17,2,Gal,45,55,1,2024-03-15 13:14:20,2024-05-27 10:12:02,Disp_AA222_01_U
id,id_vendor,nama_lokasi,slug,foto,long,lat,isDeleted,created_at,updated_at
12,7,Jembatan Cimanuk Tol Cipali,jembatan-cimanuk-tol-cipali,202402261708917995_DJI_0527.JPG.JPG,-6.7026624,108.1976359,1,2024-02-26 10:25:55,2024-02-26 10:26:35
16,11,JEMBATAN CIMANUK,jembatan-cimanuk,202406061717648551_DJI_0527.JPG.JPG,-6.7024254,108.1992381,0,2024-05-27 10:19:17,2024-06-06 11:35:51
13,8,JEMBATAN CIMANUK,jembatan-cimanuk,202403141710394744_DJI_0527.JPG.JPG,-6.7012175,108.1967876,1,2024-03-14 12:39:04,2024-03-14 12:39:47
17,12,e,e,default.jpg,e,e,0,2024-11-26 15:14:08,2024-11-26 15:14:08
18,13,tr,tr,default.jpg,tr,tr,0,2024-11-28 09:13:15,2024-11-28 09:13:15
message_id
1140feaf3524d52baa20a7671991eaff
d3085df65b4951cf5d8cb500220f455d
53a7bba1c22bbc79b5897d89caef0976
661d94c87727d049e43849e63f4472b4
219cc294c76c9bfddc29c39de9b7b90d
735cb63833d7b2242140b7341ca7a517
ee5ce0c12652d9b964a100bddc196673
b10187d625823a54d8f959cc5af6d4b4
dcdeda1457fee0747c78d8b809776d68
2c3d1338c86fb1390f104af58b7d0945
00174610d648238f31a36bd281b3a22e
76806deaf0826e5de1d0418db042e3b1
077cbaac64ea8a926caa12c29dec2354
08be7f9a54948c696b195d55b99a22eb
e86c7b778defdd78a1ff468bffe28e94
5db00e2ab9fd1a9d944efdf5c3048f13
a92eacf513a8057b0b8e3784f2e21af9
dfe1c9e874ef3cd4ad5d8f7c2e26c3c6
a5d38b914561d0b93b70c6e5fdb9cdd8
66898eb750fb2fe3af756cc66ef665cf
934e5021a3cbbe63dfae8282a9394709
47abbd7f050ed394c12475030511f21b
0caf969bc899a76a1e7b5d7446056bd8
f507e4e5aa431c8178d4d02d1a4b552c
afe14fb00cd9ec0eb4d1bc969b400299
1cc7a4586a1abb227e45a2e439c36e2e
dd50ee6f6a5d955bd1ae147a55b674b4
98bca488269e3e7b0fa90c4b0cba0847
268cc7b1925818b9610ccecffd71786a
0d394d369b7504ffadc2a9eda7622531
d164e66073fc5f236d8161b1a7edda5f
10036679a02733fae858abee450e2d2e
f94a95d9e6d24741d462922517bf51e0
9b193f55143d9a0546948e1834840a78
be1f1d4593f68a8729de5dad433d8440
9508c45d6912c125d0a19999b47f4c46
6272c28db0232413fe86d7e01005c6ee
1ca57965c5b75bf2296cbba2ca66c948
c9968a79bf242c767d8c573935744e0b
94becc1f390ca409ab46636798610314
c673198d033650fec97f5dec70a2770e
003d74110cd44a6344c7357fdca5e5fb
8f65539e70d3a7053d5de2ecd03b3d18
4f2939d880b10e5550f6694ca4209af4
a7b808713266dd5d5d24b26a35122e25
9911cf882684227e7f6e9b187e367654
8bb91b7ffad7806afe63f9d7523f5d60
6113e81fdd4d6975bf65d9c4c8d91cd7
876b914b49016e62f376efd180cb28d5
208a87a91bab69b009d833c4273b02ef
e78052bb2e5859271ee4829dacbae788
d3c7807469e62238d5de25e2df96b4e1
b44389b27f67e03750908393116b1b15
65718b4f1e316fa7573ec842b677689b
277771da9b0fa737e3505a599d0b74df
8277d1da1d7ea18e23ff88c81eea5e12
d9a0d7a548dcf811bb9bdfd6af29e717
1b183fd04ee98e9d5527882eab5b0819
713478bb2ca819aee4401fb14596b1c1
5aa4c45142bbea28d4b0eb8c0b02d0f7
9bc654103205e98580f6ed934ac849d1
f1c3106581ac5be2f6af441a6f23936a
b71139d4f6a06ebba8f096c033d16f22
5364d69481bc94a298e23ea2c2dbf42e
dfabe60bd146440b30d6cc7b51b3b8fb
47ad5876a4fec38e7ae91f1d1c1f1509
9e8089a5119a4b5668b1ab0c537d846e
aab62e0288827f2afb7fe06367f923ab
6372aa01d100ea85e2c65edff4f96af5
bae9fa440610d0c4f6cc33696a1bc379
08c76aa994fd550172309da4fe991927
ba2321861c1183a541a12b21a7a3a7e9
fac679ddd28147e37d4c3dd4c69fc2d3
85ad390789f018d1c84675063ce69f1f
b61e80494aeb7d7c7e96d2f395067a1f
7214bd76569890b95987ea3e56183f5b
e8b8566093b1089708f108f8a90d5b0d
d554e196565fce6cf3ede5659f181acf
9ae2bb0373c3866559e7d55a84edbd81
26e89ac7ed8b6e7280fab5dfe4cdf6b5
156d843dd201dcd7f1af2b4c5f78f344
756d6ed488e3741b9b97cf941fc3688b
c69b435fc7306597c7b5f2cdb9942b91
97e61a4fa4875fcb186fbd76e3217920
154cdd0def999e5bbe342127274905df
2228a30b80296a6a7d13501946c41934
7236f9f18d8122498c6e28d97ddd4a26
19b8521c5f567d449583fb29502ac43e
bbafe2d9bf9493421331eedb93ae9eb9
64ee2a7aa65631f031c548db64144436
15ab3549b94dc7b898908baba214cf4c
d6bf58b4f1933147dd97058eaf0a10c0
61bf06e6878bd6499016054350ef74e6
0ab1bc44ea01d1b41847c0d40ef1a519
9f01cf70d110875f2f0a39edfbec00e8
8b8c61e469deb3788a4cfeb09b1045ee
ca99a4f8ca211f134db3352aed0c652b
e926be2e5799f62258b4c0aaa3637056
73fdc04178862a9e824681835bf5a409
f47610c57b1bfaf249ca3af0c7d91b76
