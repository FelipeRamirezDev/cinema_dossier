--Para ejecutar el script ingresa: SOURCE name_script.sql;
DROP DATABASE IF EXISTS cinema_dossier;
CREATE DATABASE cinema_dossier;

CREATE TABLE persona(
	id_persona INT AUTO_INCREMENT PRIMARY KEY,
	nombre_artistico VARCHAR(100),
	nombre_real VARCHAR(100) NOT NULL,
	sexo CHAR(1) NOT NULL,
	ano_nacimiento INT NOT NULL,
	pagina_web VARCHAR(100),
	ano_inicio_carrera INT NOT NULL,
	anos_trabajando INT NOT NULL,
	estado VARCHAR(10) NOT NULL,
	ruta_imagen VARCHAR(100),

	CHECK (sexo IN ('F', 'M')),
	CHECK (estado IN ('activo', 'retirado', 'fallecido'))
);

CREATE TABLE pelicula(
	id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
	titulo_original VARCHAR(100) NOT NULL,
	titulo_espanol VARCHAR(100) NOT NULL,
	ano_produccion INT NOT NULL,
	nacionalidad VARCHAR(100) NOT NULL,
	idioma_original VARCHAR(100) NOT NULL,
	genero VARCHAR(100) NOT NULL,
	lugar_estreno VARCHAR(100) NOT NULL,
	sala_exposicion VARCHAR(100) NOT NULL,
	recaudacion_primer_ano BIGINT NOT NULL,
	recaudacion_total BIGINT NOT NULL,
    ruta_imagen VARCHAR(100)
);

CREATE TABLE gala(
	id_gala INT AUTO_INCREMENT PRIMARY KEY,
	nombre_gala VARCHAR(100) NOT NULL,
	tipo VARCHAR(100) NOT NULL,
	nacionalidad VARCHAR(100) NOT NULL,
	ano_comienzo INT
);

CREATE TABLE edicion_gala(
	id_edicion INT AUTO_INCREMENT PRIMARY KEY,
	id_gala INT NOT NULL,
	ano INT NOT NULL,
	lugar_celebracion VARCHAR(100) NOT NULL,
	fecha_celebracion DATE NOT NULL,
	numero_jurado INT NOT NULL,
	FOREIGN KEY (id_gala) REFERENCES gala (id_gala)
);

CREATE TABLE premio(
	id_premio INT AUTO_INCREMENT PRIMARY KEY,
	id_edicion INT NOT NULL,
	nombre_premio VARCHAR(100) NOT NULL,
	tipo_premio VARCHAR(100) NOT NULL,
	FOREIGN KEY (id_edicion) REFERENCES edicion_gala (id_edicion)
);

CREATE TABLE nominacion(
	id_nominacion INT AUTO_INCREMENT PRIMARY KEY,
	id_premio INT NOT NULL,
	id_pelicula INT NOT NULL,
	id_persona INT NOT NULL,
	resultado VARCHAR(10) NOT NULL,
	CHECK (resultado IN ('nominado', 'ganador'))
);

CREATE TABLE participacion(
	id_pelicula INT,
	id_persona INT,
	rol VARCHAR(100) NOT NULL,
	PRIMARY KEY (id_pelicula, id_persona, rol),
	FOREIGN KEY (id_pelicula) REFERENCES pelicula (id_pelicula),
	FOREIGN KEY (id_persona) REFERENCES persona (id_persona)
);

CREATE TABLE jurado(
	id_edicion INT,
	id_persona INT,
	PRIMARY KEY (id_edicion, id_persona),
	FOREIGN KEY (id_edicion) REFERENCES edicion_gala (id_edicion),
	FOREIGN KEY (id_persona) REFERENCES persona (id_persona)
);

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE favoritos_peliculas (
    id_favorito_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_pelicula INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user),
    FOREIGN KEY (id_pelicula) REFERENCES pelicula (id_pelicula),
    UNIQUE KEY unique_favorito_pelicula (id_user, id_pelicula)
);

CREATE TABLE favoritos_personas (
    id_favorito_persona INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_persona INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user),
    FOREIGN KEY (id_persona) REFERENCES persona (id_persona),
    UNIQUE KEY unique_favorito_persona (id_user, id_persona)
);

