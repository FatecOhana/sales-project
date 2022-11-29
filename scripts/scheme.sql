CREATE DATABASE vendas;

USE vendas;

CREATE TABLE customer(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(150),
    endereco VARCHAR(50),
    telefone INT(10),
    data_nasc varchar(6),
    sstatus VARCHAR(20),
	email VARCHAR(150),
    sexo VARCHAR(30)
);

CREATE TABLE product(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    descricao VARCHAR(500),
    estoque FLOAT,
    valor FLOAT,
    unidade varchar(150)
);

