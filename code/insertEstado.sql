insert into sc.estado (nombest) values
('Amazonas'),
('Anzoátegui'),
('Apure'),
('Aragua'),
('Barinas'),
('Bolívar'),
('Carabobo'),
('Cojedes'),
('Delta Amacuro'),
('Distrito Capital'),
('Falcón'),
('Guárico'),
('Lara'),
('Mérida'),
('Miranda'),
('Monagas'),
('Nueva Esparta'),
('Portuguesa'),
('Sucre'),
('Táchira'),
('Trujillo'),
('Vargas'),
('Yaracuy'),
('Zulia')

--Reiniciar la tabla y con ello el auto incremental / sequence ELIMINANDO LOS REGISTROS
TRUNCATE TABLE ciat.estado RESTART IDENTITY CASCADE

-- forzar tipo de dato
ALTER TABLE sc.equipo
ALTER COLUMN entregado
TYPE integer USING CAST(entregado AS character varying);

--Reiniciar auto incremental / sequence sin eliminar la tabla
ALTER SEQUENCE campo_id_seq RESTART WITH 1

-- LLAVES PRIMARIAS
ALTER TABLE ONLY ciat.auditoria
ADD CONSTRAINT idaudi
PRIMARY KEY(idaudi);

-- LLAVES FORANEAS
ALTER TABLE ONLY ciat.insteduc
ADD CONSTRAINT idrgesta
FOREIGN KEY (idrgesta) REFERENCES ciat.regestado(idrgesta);

-- AÑADIR COLUMNA
ALTER TABLE ciat.estudiante
ADD COLUMN iduser integer;
