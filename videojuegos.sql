-- Tabla de Usuarios
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(60) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL -- Recuerda usar hash para las contraseñas
);

-- Tabla de Géneros
CREATE TABLE genre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT
);

-- Tabla de Modelos de Consola
CREATE TABLE console_model (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);

-- Tabla de Consolas
CREATE TABLE console (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT,
    id_model INT NOT NULL,
    release_date DATE NOT NULL,
    FOREIGN KEY (id_model) REFERENCES console_model(id)
);

-- Tabla de Videojuegos
CREATE TABLE videogame (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Tabla de Videojuego-Consola (Relación Muchos a Muchos)
CREATE TABLE videogame_console (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_videogame INT NOT NULL,
    id_console INT NOT NULL,
    release_date DATE NOT NULL,
    FOREIGN KEY (id_videogame) REFERENCES videogame(id),
    FOREIGN KEY (id_console) REFERENCES console(id)
);

-- Tabla de Videojuego-Género (Relación Muchos a Muchos)
CREATE TABLE videogame_genre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_videogame INT NOT NULL,
    id_genre INT NOT NULL,
    FOREIGN KEY (id_videogame) REFERENCES videogame(id),
    FOREIGN KEY (id_genre) REFERENCES genre(id)
);

-- Indices para mejorar el rendimiento
CREATE INDEX idx_user_name ON user (user_name);
CREATE INDEX idx_email ON user (email);
CREATE INDEX idx_genre_name ON genre (name);
CREATE INDEX idx_console_name ON console (name);
CREATE INDEX idx_videogame_name ON videogame (name);