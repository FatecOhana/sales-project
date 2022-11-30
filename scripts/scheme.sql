DROP DATABASE IF EXISTS sales_project;

CREATE DATABASE IF NOT EXISTS sales_project;
USE sales_project;

CREATE TABLE IF NOT EXISTS city(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS skill(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS product(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(500),
    description VARCHAR(500),
    stock INT,
    salePrice FLOAT,
    unit varchar(150)
);

CREATE TABLE IF NOT EXISTS sale(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date VARCHAR(15),
    total INT,
    obs VARCHAR(250),
    id_customer INT,

    FOREIGN KEY (id_customer) REFERENCES customer(id)
);

CREATE TABLE IF NOT EXISTS saleitem(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    amount INT,
    discount FLOAT,
    totalValue FLOAT,
    id_product INT,

    FOREIGN KEY (id_product) REFERENCES product(id)
);

CREATE TABLE IF NOT EXISTS saleitemsale(
   id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
   id_sale_item INT NOT NULL,
   id_sale INT NOT NULL,

   FOREIGN KEY (id_sale_item) REFERENCES saleitem(id),
   FOREIGN KEY (id_sale) REFERENCES sale(id)
);

CREATE TABLE IF NOT EXISTS customer(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(250),
    address VARCHAR(500),
    phone VARCHAR(32),
    birthday VARCHAR(20),
    status VARCHAR(150),
    email VARCHAR(250),
    gender VARCHAR(10),
    id_city INT,

    FOREIGN KEY (id_city) REFERENCES city(id)
);

CREATE TABLE IF NOT EXISTS customer_skill(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_customer INT NOT NULL,
    id_skill INT NOT NULL,

    FOREIGN KEY (id_customer) REFERENCES customer(id),
    FOREIGN KEY (id_skill) REFERENCES skill(id)
);