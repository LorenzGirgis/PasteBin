DROP DATABASE IF EXISTS `la bello`;

CREATE DATABASE `la bello`;

USE `la bello`;

CREATE TABLE `eten` (
    id VARCHAR(100) NOT NULL PRIMARY KEY,
    content LONGTEXT NOT NULL,
    syntax VARCHAR(100) NOT NULL
);