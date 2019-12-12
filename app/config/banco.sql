DROP DATABASE IF EXISTS vikings;

CREATE DATABASE vikings;

use vikings;


DROP TABLE IF EXISTS  cartorios;

CREATE TABLE cartorios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    tabeliao VARCHAR(200) NOT NULL,
    email VARCHAR(100),
    documento VARCHAR(14) UNIQUE NOT NULL,
    tipo_documento char(1) NOT NULL,
    telefone varchar (15),
    razao VARCHAR (200) NOT NULL,
    status boolean NOT NULL default 1
);

DROP TABLE IF EXISTS enderecos;

CREATE TABLE enderecos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    uf CHAR(2) NOT NULL,
    bairro VARCHAR (100) NOT NULL,
    cidade VARCHAR (100) NOT NULL,
    cartorio_id INT UNSIGNED NOT NULL
);

ALTER TABLE enderecos ADD CONSTRAINT fk_cartorios FOREIGN KEY (cartorio_id) REFERENCES cartorios (id) ON DELETE CASCADE;