
CREATE DATABASE videojuegos;


USE videojuegos;


CREATE TABLE usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nombre_usuario VARCHAR(50),
    email VARCHAR(50),
    contrasena VARCHAR(50),
    fecha_registro DATE,
    img_usuario VARCHAR(30),
    PRIMARY KEY (id_usuario)
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
drop table usuarios;

CREATE TABLE generos (
    id_genero INT NOT NULL AUTO_INCREMENT,
    nombre_genero VARCHAR(50),
    img_genero VARCHAR(30),
    PRIMARY KEY (id_genero)
);


CREATE TABLE videojuegos (
    id_videojuego INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(50),
    genero INT,
    fecha_lanzamiento DATE,
    desarrollador VARCHAR(50),
    img_videojuego VARCHAR(30),
    PRIMARY KEY (id_videojuego),
    FOREIGN KEY (genero) REFERENCES generos(id_genero)
);

CREATE TABLE favoritos (
    id_favorito INT NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    id_videojuego INT,
    PRIMARY KEY (id_favorito),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);

CREATE TABLE resenas (
    id_resena INT NOT NULL AUTO_INCREMENT,
    id_usuario INT,
    id_videojuego INT,
    calificacion TINYINT,
    comentario TEXT,
    fecha_publicacion DATE,
    PRIMARY KEY (id_resena),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego)
);

CREATE TABLE comentarios (
    id_comentario INT NOT NULL AUTO_INCREMENT,
    id_resena INT,
    id_usuario INT,
    texto_comentario TEXT,
    fecha_comentario DATE,
    PRIMARY KEY (id_comentario),
    FOREIGN KEY (id_resena) REFERENCES resenas(id_resena),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

INSERT INTO usuarios (nombre_usuario, email, contrasena, fecha_registro, img_usuario)
VALUES ('Javier Morales', 'test@gmail.com', '12345678', CURDATE(), 'img001.png');
INSERT INTO generos (nombre_genero, img_genero)
VALUES 
    ('Acción', 'accion.jpg'),
    ('Aventura', 'aventura.jpg'),
    ('Rol', 'rol.jpg'),
    ('Estrategia', 'estrategia.jpg'),
    ('Deportes', 'deportes.jpg'),
    ('Simulación', 'simulacion.jpg');
   ALTER TABLE resenas DROP FOREIGN KEY resenas_ibfk_1;


ALTER TABLE resenas CHANGE id_usuario id INT;
PRIMARY KEY (id_resena),
    FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_videojuego) REFERENCES videojuegos(id_videojuego) ON DELETE CASCADE ON UPDATE CASCADE
DESCRIBE resenas;
ALTER TABLE resenas
ADD COLUMN id_usuario INT,
ADD CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
SELECT * FROM resenas;
