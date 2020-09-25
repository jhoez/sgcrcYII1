CREATE TABLE sc.cruge_system
(
  idsystem serial NOT NULL,
  name character varying(45),
  largename character varying(45),
  sessionmaxdurationmins integer DEFAULT 30,
  sessionmaxsameipconnections integer DEFAULT 10,
  sessionreusesessions integer DEFAULT 1,
  sessionmaxsessionsperday integer DEFAULT '-1'::integer,
  sessionmaxsessionsperuser integer DEFAULT '-1'::integer,
  systemnonewsessions integer DEFAULT 0,
  systemdown integer DEFAULT 0,
  registerusingcaptcha integer DEFAULT 0,
  registerusingterms integer DEFAULT 0,
  terms character varying(4096),
  registerusingactivation integer DEFAULT 1,
  defaultroleforregistration character varying(64),
  registerusingtermslabel character varying(100),
  registrationonlogin integer DEFAULT 1,
  CONSTRAINT cruge_system_pkey PRIMARY KEY (idsystem)
);

INSERT INTO sc.cruge_system (idsystem,name,largename,sessionmaxdurationmins,sessionmaxsameipconnections,sessionreusesessions,sessionmaxsessionsperday,sessionmaxsessionsperuser,systemnonewsessions,systemdown,registerusingcaptcha,registerusingterms,terms,registerusingactivation,defaultroleforregistration,registerusingtermslabel,registrationonlogin)
VALUES
(1,'default',NULL,30,10,1,-1,-1,0,0,0,0,'',0,'','',1);

CREATE TABLE sc.cruge_session
(
  idsession serial NOT NULL,
  iduser integer NOT NULL,
  created bigint,
  expire bigint,
  status integer DEFAULT 0,
  ipaddress character varying(45),
  usagecount integer DEFAULT 0,
  lastusage bigint,
  logoutdate bigint,
  ipaddressout character varying(45),
  CONSTRAINT cruge_session_pkey PRIMARY KEY (idsession)
);

CREATE TABLE sc.cruge_user
(
  iduser serial NOT NULL,
  regdate bigint,
  actdate bigint,
  logondate bigint,
  username character varying(64),
  email character varying(45),
  cedula character varying(10),
  cbit character varying(255),
  password character varying(64),
  authkey character varying(100),
  state integer DEFAULT 0,
  totalsessioncounter integer DEFAULT 0,
  currentsessioncounter integer DEFAULT 0,
  CONSTRAINT cruge_user_pkey PRIMARY KEY (iduser)
);

insert into sc.cruge_user(username, email, password, state)
values
('jhon', 'jhon@gmail.com','123456',1),
('invitado', 'invitado@gmail.com','123456',1),
('administrador', 'administrador@gmail.com','123456',1),
('tutor', 'tutor@gmail.com','123456',1);

CREATE TABLE sc.cruge_field
(
  idfield serial NOT NULL,
  fieldname character varying(20) NOT NULL,
  longname character varying(50),
  "position" integer DEFAULT 0,
  required integer DEFAULT 0,
  fieldtype integer DEFAULT 0,
  fieldsize integer DEFAULT 20,
  maxlength integer DEFAULT 45,
  showinreports integer DEFAULT 0,
  useregexp character varying(512),
  useregexpmsg character varying(512),
  predetvalue character varying(4096),
  CONSTRAINT cruge_field_pkey PRIMARY KEY (idfield)
);

CREATE TABLE sc.cruge_fieldvalue
(
  idfieldvalue serial NOT NULL,
  iduser integer NOT NULL,
  idfield integer NOT NULL,
  value character varying(4096),
  CONSTRAINT cruge_fieldvalue_pkey PRIMARY KEY (idfieldvalue),
  CONSTRAINT fk_cruge_fieldvalue_cruge_field1 FOREIGN KEY (idfield)
      REFERENCES sc.cruge_field (idfield) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE,
  CONSTRAINT fk_cruge_fieldvalue_cruge_user1 FOREIGN KEY (iduser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
);

CREATE TABLE sc.cruge_authitem
(
  name character varying(64) NOT NULL,
  type integer NOT NULL,
  description text,
  bizrule text,
  data text,
  CONSTRAINT cruge_authitem_pkey PRIMARY KEY (name)
);

CREATE TABLE sc.cruge_authassignment
(
  userid integer NOT NULL,
  bizrule text,
  data text,
  itemname character varying(64) NOT NULL,
  CONSTRAINT cruge_authassignment_pkey PRIMARY KEY (userid, itemname),
  CONSTRAINT fk_cruge_authassignment_cruge_authitem1 FOREIGN KEY (itemname)
      REFERENCES sc.cruge_authitem (name) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_cruge_authassignment_user FOREIGN KEY (userid)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
);

CREATE TABLE sc.cruge_authitemchild
(
  parent character varying(64) NOT NULL,
  child character varying(64) NOT NULL,
  CONSTRAINT cruge_authitemchild_pkey PRIMARY KEY (parent, child),
  CONSTRAINT crugeauthitemchild_ibfk_1 FOREIGN KEY (parent)
      REFERENCES sc.cruge_authitem (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT crugeauthitemchild_ibfk_2 FOREIGN KEY (child)
      REFERENCES sc.cruge_authitem (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE sc.estado
(
  idesta serial NOT NULL,
  nombest character varying(30),
  CONSTRAINT idesta PRIMARY KEY (idesta)
);

CREATE TABLE sc.municipio
(
  idmunc serial NOT NULL,
  municipio character varying(255),
  idesta integer,
  CONSTRAINT idmunc PRIMARY KEY (idmunc),
  CONSTRAINT idesta FOREIGN KEY (idesta)
      REFERENCES sc.estado (idesta) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.parroquia
(
  idpar serial NOT NULL,
  parroquia character varying(255),
  idmunc integer,
  CONSTRAINT idpar PRIMARY KEY (idpar),
  CONSTRAINT idmunc FOREIGN KEY (idmunc)
      REFERENCES sc.municipio (idmunc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.insteduc
(
  idinst serial NOT NULL,
  nombinst character varying(255),
  CONSTRAINT idinst PRIMARY KEY (idinst)
);

CREATE TABLE sc.sedeciat
(
  idciat serial NOT NULL,
  sede character varying(255),
  CONSTRAINT idciat PRIMARY KEY (idciat)
);

CREATE TABLE sc.representante
(
  idrep serial NOT NULL,
  cedula character varying(8),
  nombre character varying(50),
  telf character varying(12),
  docente character varying(1) DEFAULT 0,
  idciat integer,
  idinst integer,
  fkuser integer,
  CONSTRAINT idrep PRIMARY KEY (idrep),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idciat FOREIGN KEY (idciat)
      REFERENCES sc.sedeciat (idciat) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idinst FOREIGN KEY (idinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.estudiante
(
  idestu serial NOT NULL,
  nombestu character varying(255),
  idrep integer,
  idinst integer,
  CONSTRAINT idestu PRIMARY KEY (idestu),
  CONSTRAINT idinst FOREIGN KEY (idinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idrep FOREIGN KEY (idrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.niveleduc
(
  idniv serial NOT NULL,
  nivel character varying(20),
  graduado character varying(1) DEFAULT 0,
  idestu integer,
  CONSTRAINT idniv PRIMARY KEY (idniv),
  CONSTRAINT idestu FOREIGN KEY (idestu)
      REFERENCES sc.estudiante (idestu) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.direcuser
(
  iddiruser serial NOT NULL,
  idfkesta integer,
  idfkmunc integer,
  idfkpar integer,
  idfkciat integer,
  idfkinst integer,
  idfkrep integer,
  CONSTRAINT iddiruser PRIMARY KEY (iddiruser),
  CONSTRAINT idfkesta FOREIGN KEY (idfkesta)
      REFERENCES sc.estado (idesta) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkmunc FOREIGN KEY (idfkmunc)
      REFERENCES sc.municipio (idmunc) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkpar FOREIGN KEY (idfkpar)
      REFERENCES sc.parroquia (idpar) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkciat FOREIGN KEY (idfkciat)
      REFERENCES sc.sedeciat (idciat) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkinst FOREIGN KEY (idfkinst)
      REFERENCES sc.insteduc (idinst) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT idfkrep FOREIGN KEY (idfkrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.equipo
(
  ideq serial NOT NULL,
  eqserial character varying(125),
  frecepcion date,
  fentrega date,
  eqversion character varying(6),
  eqstatus character varying(11),
  idrep integer,
  diagnostico character varying(500),
  observacion character varying(500),
  status character varying(1) DEFAULT 0,
  CONSTRAINT ideq PRIMARY KEY (ideq),
  CONSTRAINT idrep FOREIGN KEY (idrep)
      REFERENCES sc.representante (idrep) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fcarga
(
  idcarg serial NOT NULL,
  fcarg character varying(255),
  ideq integer,
  CONSTRAINT idcarg PRIMARY KEY (idcarg),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fgeneral
(
  idgen serial NOT NULL,
  fgen character varying(255),
  ideq integer,
  CONSTRAINT idgen PRIMARY KEY (idgen),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fpantalla
(
  idpant serial NOT NULL,
  fpant character varying(255),
  ideq integer,
  CONSTRAINT idpant PRIMARY KEY (idpant),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fsoftware
(
  idsoft serial NOT NULL,
  fsoft character varying(255),
  ideq integer,
  CONSTRAINT idsoft PRIMARY KEY (idsoft),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.ftarjetamadre
(
  idtarj serial NOT NULL,
  ftarj character varying(255),
  ideq integer,
  CONSTRAINT idtarj PRIMARY KEY (idtarj),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.fteclado
(
  idtec serial NOT NULL,
  ftec character varying(255),
  ideq integer,
  CONSTRAINT idtec PRIMARY KEY (idtec),
  CONSTRAINT ideq FOREIGN KEY (ideq)
      REFERENCES sc.equipo (ideq) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.imagen
(
  idimag serial NOT NULL,
  nombimg character varying(50) DEFAULT 'vacio'::character varying,
  extension character varying(5) DEFAULT 'vacio'::character varying,
  ruta character varying(255) DEFAULT 'vacio'::character varying,
  tamanio character varying(50) DEFAULT 0,
  tipoimg character varying(7),
  fkuser integer,
  CONSTRAINT idimag PRIMARY KEY (idimag),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.libros
(
  idlib serial NOT NULL,
  nomblib character varying(255),
  extension character varying(5),
  ruta character varying(255),
  coleccion character varying(255),
  nivel character varying(11),
  tamanio character varying(50),
  idfkimag integer,
  CONSTRAINT idlib PRIMARY KEY (idlib),
  CONSTRAINT idfkimag FOREIGN KEY (idfkimag)
      REFERENCES sc.imagen (idimag) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.formato
(
  idf serial NOT NULL,
  opcion character varying(255),
  nombf character varying(255),
  extens character varying(5),
  ruta character varying(255),
  tamanio character varying(50),
  status character varying(1),
  create_at date,
  update_at integer,
  fkuser integer,
  CONSTRAINT idf PRIMARY KEY (idf),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.proyecto
(
  idpro serial NOT NULL,
  nombpro character varying(255),
  creador character varying(50),
  colaboracion character varying(255),
  descripcion character varying(500),
  create_at date,
  update_at date,
  fkuser integer,
  CONSTRAINT idpro PRIMARY KEY (idpro),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.multimedia
(
  idmult serial NOT NULL,
  nombmult character varying(255),
  extension character varying(5),
  tipomult character varying(5),
  tamanio character varying(20),
  ruta character varying(255),
  fkidpro integer,
  CONSTRAINT idmult PRIMARY KEY (idmult),
  CONSTRAINT fkidpro FOREIGN KEY (fkidpro)
      REFERENCES sc.proyecto (idpro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.realaum
(
  idra serial NOT NULL,
  nra character varying(255),
  exten character varying(5),
  ruta character varying(255),
  fk_pro integer,
  fkimag integer,
  CONSTRAINT idra PRIMARY KEY (idra),
  CONSTRAINT fk_pro FOREIGN KEY (fk_pro)
      REFERENCES sc.proyecto (idpro) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fkimag FOREIGN KEY (fkimag)
      REFERENCES sc.imagen (idimag) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE sc.asistencia
(
  idasis serial NOT NULL,
  fkuser integer,
  fecha date,
  horain time without time zone,
  horaout time without time zone,
  observacion text,
  CONSTRAINT idasis PRIMARY KEY (idasis),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES sc.cruge_user (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
