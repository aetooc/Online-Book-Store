DROP DATABASE IF EXISTS book_store;
CREATE DATABASE book_store;
USE book_store;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(15) NOT NULL,
    email VARCHAR(35) NOT NULL,
    password VARCHAR(50) NOT NULL,
    user_type varchar(20) NOT NULL DEFAULT 'user'
);

CREATE TABLE cart(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    quantity INT NOT NULL,
    image VARCHAR(100) NOT NULL,
    CONSTRAINT FK_cart_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE message(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    number INT NOT NULL,
    message VARCHAR(500) NOT NULL,
    CONSTRAINT FK_message_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE orders(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(50) NOT NULL,
    number INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    method VARCHAR(50) NOT NULL,
    address VARCHAR(100) NOT NULL,
    total_products varchar(1000) NOT NULL,
    total_price INT NOT NULL,
    placed_on DATE NOT NULL,
    payment_status VARCHAR(50) NOT NULL DEFAULT 'Pending',
    CONSTRAINT FK_orders_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE products(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(100) NOT NULL

);





