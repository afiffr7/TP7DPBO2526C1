CREATE DATABASE IF NOT EXISTS db_TP7DPBO;
USE db_TP7DPBO;

CREATE TABLE customer(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    membership VARCHAR(255) NOT NULL
);

CREATE TABLE product(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);

CREATE TABLE transactions(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price INT NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customer(id),
    FOREIGN KEY (product_id) REFERENCES product(id)
);

INSERT INTO customer (name, membership) VALUES
    ('Andi Pratama', 'Gold'),
    ('Budi Santoso', 'Silver'),
    ('Citra Lestari', 'Gold'),
    ('Dewi Anggraini', 'Bronze'),
    ('Eko Saputra', 'Silver');

INSERT INTO product (name, price) VALUES
    ('Kopi Arabika', 45000),
    ('Teh Hijau', 30000),
    ('Cokelat Bubuk', 55000),
    ('Susu Almond', 40000),
    ('Madu Hutan', 75000);

INSERT INTO transactions (customer_id, product_id, quantity, total_price) VALUES
    (1, 1, 2, 90000),
    (2, 2, 1, 30000),
    (3, 3, 3, 165000),
    (4, 4, 2, 80000),
    (5, 5, 1, 75000);