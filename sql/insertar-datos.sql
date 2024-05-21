INSERT INTO persona (nombre_artistico, nombre_real, sexo, ano_nacimiento, pagina_web, ano_inicio_carrera, anos_trabajando, estado, ruta_imagen)
VALUES
('Tom Hanks', 'Thomas Jeffrey Hanks', 'M', 1956, 'http://tomhanks.com', 1980, 42, 'activo', 'tom-hanks.png'),
('Meryl Streep', 'Mary Louise Streep', 'F', 1949, 'http://merylstreep.com', 1971, 51, 'activo', 'meryl-streep.png'),
('Leonardo DiCaprio', 'Leonardo Wilhelm DiCaprio', 'M', 1974, 'http://leonardodicaprio.com', 1989, 33, 'activo', 'leonardo-dicaprio.png'),
('Scarlett Johansson', 'Scarlett Ingrid Johansson', 'F', 1984, 'http://scarlettjohansson.com', 1994, 28, 'activo', 'scarlett-johansson.png'),
('Denzel Washington', 'Denzel Hayes Washington Jr.', 'M', 1954, NULL, 1975, 47, 'activo', 'denzel-washington.png');

INSERT INTO pelicula (titulo_original, titulo_espanol, ano_produccion, nacionalidad, idioma_original, genero, lugar_estreno, sala_exposicion, recaudacion_primer_ano, recaudacion_total, ruta_imagen)
VALUES
('Forrest Gump', 'Forrest Gump', 1994, 'USA', 'Inglés', 'Drama', 'Los Angeles', 'AMC', 330000000, 678200000, 'forrest-gump.jpg'),
('The Post', 'Los archivos del Pentágono', 2017, 'USA', 'Inglés', 'Drama', 'Nueva York', 'Regal', 80000000, 179800000, 'the-post.jpg'),
('Inception', 'El origen', 2010, 'USA', 'Inglés', 'Ciencia ficción', 'Los Angeles', 'Cinemark', 292600000, 836800000, 'inception.jpg'),
('Lost in Translation', 'Perdidos en Tokio', 2003, 'USA', 'Inglés', 'Drama', 'Nueva York', 'Landmark', 44500000, 119700000, 'lost-in-translation.jpg'),
('Fences', 'Fences', 2016, 'USA', 'Inglés', 'Drama', 'Los Angeles', 'Pacific', 57600000, 64400000, 'fences.jpg');

INSERT INTO gala (nombre_gala, tipo, nacionalidad, ano_comienzo)
VALUES
('Golden Globes', 'Academia', 'USA', 1944),
('BAFTA', 'Academia', 'UK', 1947),
('Screen Actors Guild Awards', 'Academia', 'USA', 1995),
('Cannes Film Festival', 'Festival', 'Francia', 1946),
('Berlin International Film Festival', 'Festival', 'Alemania', 1951);

INSERT INTO edicion_gala (id_gala, ano, lugar_celebracion, fecha_celebracion, numero_jurado)
VALUES
(1, 2022, 'Beverly Hills', '2022-01-09', 5),
(2, 2022, 'London', '2022-02-13', 7),
(3, 2022, 'Los Angeles', '2022-03-27', 9),
(4, 2022, 'Cannes', '2022-05-17', 8),
(5, 2022, 'Berlin', '2022-02-10', 6);

INSERT INTO premio (id_edicion, nombre_premio, tipo_premio)
VALUES
(1, 'Best Motion Picture - Drama', 'Mejor Película - Drama'),
(2, 'Best Actor in a Leading Role', 'Mejor Actor Principal'),
(3, 'Outstanding Performance by a Male Actor in a Leading Role', 'Mejor Actuación Masculina en Rol Principal'),
(4, 'Palme d Or', 'Palma de Oro'),
(5, 'Golden Bear', 'Oso de Oro');

INSERT INTO nominacion (id_premio, id_pelicula, id_persona, resultado)
VALUES
(1, 1, 1, 'ganador'),
(2, 3, 3, 'ganador'),
(3, 3, 3, 'ganador'),
(4, 4, 4, 'nominado'),
(5, 5, 5, 'nominado');

INSERT INTO participacion (id_pelicula, id_persona, rol)
VALUES
(1, 1, 'Actor Principal'),
(2, 2, 'Actriz Principal'),
(3, 3, 'Actor Principal'),
(4, 4, 'Actriz Principal'),
(5, 5, 'Director');

INSERT INTO jurado (id_edicion, id_persona)
VALUES
(1, 5),
(2, 4),
(3, 3),
(4, 2),
(5, 1);
