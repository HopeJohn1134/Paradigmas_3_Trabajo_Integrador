USE resena_bd;

INSERT INTO
    categorias (nombre)
VALUES ('Libros'),
    ('Peliculas'),
    ('Podcast'),
    ('Series'),
    ('Videojuegos');

INSERT INTO
    generos (nombre)
VALUES
    ('Drama'),
    ('Terror'),
    ('Acción'),
    ('Aventura'),
    ('Comedia'),
    ('Ciencia Ficción'),
    ('Fantasía'),
    ('Suspenso'),
    ('Romance'),
    ('Misterio'),
    ('Crimen'),
    ('Documental'),
    ('Biografía'),
    ('Histórico'),
    ('Musical'),
    ('Familiar'),
    ('Western'),
    ('Bélico'),
    ('Sátira'),
    ('RPG'),
    ('Estrategia'),
    ('Shooter'),
    ('Deportes'),
    ('Simulación'),
    ('Plataformas'),
    ('Puzzle'),
    ('Lucha'),
    ('Survival Horror'),
    ('Mundo Abierto'),
    ('MOBA'),
    ('Battle Royale'),
    ('Roguelike'),
    ('Hack and Slash'),
    ('Indie'),
    ('Arcade'),
    ('Carreras'),
    ('Autoayuda'),
    ('Ensayo'),
    ('Poesía'),
    ('Novela Gráfica'),
    ('Manga'),
    ('Cómic'),
    ('Filosofía'),
    ('Negocios'),
    ('Psicología'),
    ('Viajes'),
    ('Gastronomía'),
    ('True Crime'),
    ('Entrevistas'),
    ('Educación'),
    ('Tecnología'),
    ('Noticias / Actualidad'),
    ('Salud y Bienestar'),
    ('Espiritualidad'),
    ('Historia Real'),
    ('Ciencia'),
    ('Política'),
    ('Arte y Diseño'),
    ('Cyberpunk'),
    ('Steampunk'),
    ('Post-apocalíptico'),
    ('Noir'),
    ('Superhéroes'),
    ('Isekai'),
    ('Mecha');

USE resena_bd;

INSERT INTO articulos (titulo, descripcion, id_categoria, id_genero, activo) VALUES
-- LIBROS (Categoría 1)
('Cien años de soledad', 
 'La saga de la familia Buendía en el pueblo ficticio de Macondo. Obra maestra del realismo mágico.', 
 1, (SELECT id_genero FROM generos WHERE nombre = 'Fantasía' LIMIT 1), 1),

('1984', 
 'Novela distópica sobre un régimen totalitario que vigila cada movimiento de sus ciudadanos bajo el Gran Hermano.', 
 1, (SELECT id_genero FROM generos WHERE nombre = 'Ciencia Ficción' LIMIT 1), 1),

('El Principito', 
 'Historia poética y filosófica sobre un niño que viaja de planeta en planeta aprendiendo sobre la naturaleza humana.', 
 1, (SELECT id_genero FROM generos WHERE nombre = 'Familiar / Infantil' LIMIT 1), 1),

-- PELÍCULAS (Categoría 2)
('Interestelar', 
 'Un equipo de exploradores viaja a través de un agujero de gusano en el espacio para asegurar la supervivencia de la humanidad.', 
 2, (SELECT id_genero FROM generos WHERE nombre = 'Ciencia Ficción' LIMIT 1), 1),

('El Padrino', 
 'El patriarca de una dinastía del crimen organizado transfiere el control de su imperio clandestino a su hijo reacio.', 
 2, (SELECT id_genero FROM generos WHERE nombre = 'Crimen / Policial' LIMIT 1), 1),

('Pulp Fiction', 
 'Las vidas de dos asesinos a sueldo, un boxeador y una pareja de bandidos se entrelazan en historias de violencia y redención.', 
 2, (SELECT id_genero FROM generos WHERE nombre = 'Crimen / Policial' LIMIT 1), 1),

-- PODCAST (Categoría 3)
('The Wild Project', 
 'Tertulias, actualidad, deportes, ciencia y misterio con invitados variados dirigido por Jordi Wild.', 
 3, (SELECT id_genero FROM generos WHERE nombre = 'Entrevistas' LIMIT 1), 1),

('Entiende tu Mente', 
 'Podcast de psicología que nos ayuda a entender cómo funciona nuestra mente en situaciones cotidianas.', 
 3, (SELECT id_genero FROM generos WHERE nombre = 'Psicología' LIMIT 1), 1),

('TED en Español', 
 'Difusión de ideas provocadoras e historias inspiradoras en español, cubriendo todo tipo de temáticas.', 
 3, (SELECT id_genero FROM generos WHERE nombre = 'Educación' LIMIT 1), 1),

-- SERIES (Categoría 4)
('Breaking Bad', 
 'Un profesor de química con cáncer se asocia con un exalumno para fabricar y vender metanfetamina.', 
 4, (SELECT id_genero FROM generos WHERE nombre = 'Drama' LIMIT 1), 1),

('Game of Thrones', 
 'Nueve familias nobles luchan por el control de las tierras de Westeros, mientras un antiguo enemigo regresa.', 
 4, (SELECT id_genero FROM generos WHERE nombre = 'Fantasía' LIMIT 1), 1),

('Stranger Things', 
 'La desaparición de un niño revela un misterio que involucra experimentos secretos, fuerzas sobrenaturales y una niña extraña.', 
 4, (SELECT id_genero FROM generos WHERE nombre = 'Ciencia Ficción' LIMIT 1), 1),

-- VIDEOJUEGOS (Categoría 5)
('Elden Ring', 
 'Juego de rol de acción ambientado en las Tierras Intermedias, creado por Hidetaka Miyazaki y George R. R. Martin.', 
 5, (SELECT id_genero FROM generos WHERE nombre = 'RPG (Rol)' LIMIT 1), 1),

('The Last of Us', 
 'Un contrabandista y una adolescente recorren un Estados Unidos post-apocalíptico plagado de infectados y supervivientes hostiles.', 
 5, (SELECT id_genero FROM generos WHERE nombre = 'Aventura' LIMIT 1), 1),

('Minecraft', 
 'Juego de mundo abierto donde los jugadores pueden construir, minar y explorar un mundo generado proceduralmente.', 
 5, (SELECT id_genero FROM generos WHERE nombre = 'Mundo Abierto' LIMIT 1), 1);