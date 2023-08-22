CREATE DATABASE cadastro_pessoas_db;

USE cadastro_pessoas_db;

CREATE TABLE pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    idade INT,
    cidade VARCHAR(100),
    estado VARCHAR(50),
    numero_de_telefone VARCHAR(20),
    profissao VARCHAR(100)
);
