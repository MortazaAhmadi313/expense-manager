CREATE DATABASE IF NOT EXISTS expense_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE expense_db;

CREATE TABLE expenses (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) DEFAULT NULL,
    amount DECIMAL(10,2) DEFAULT NULL,
    expense_date DATE DEFAULT NULL,
    archived TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE incomes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) DEFAULT NULL,
    amount DECIMAL(10,2) DEFAULT NULL,
    income_date DATE DEFAULT NULL,
    archived TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE loans (
    id INT(11) NOT NULL AUTO_INCREMENT,
    person_name VARCHAR(255) DEFAULT NULL,
    type ENUM('borrowed','lent') DEFAULT NULL,
    amount DECIMAL(10,2) DEFAULT NULL,
    note TEXT DEFAULT NULL,
    loan_date DATE DEFAULT NULL,
    status ENUM('unpaid','paid') DEFAULT 'unpaid',
    archived TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;