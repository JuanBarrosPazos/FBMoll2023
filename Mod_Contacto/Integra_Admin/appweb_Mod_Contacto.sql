-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-03-2022 a las 09:49:18
-- Versión del servidor: 8.0.27
-- Versión de PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

	/************** CREAMOS LA TABLA CONTACTO ***************/

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(4) NOT NULL auto_increment,
  `nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `apellido` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `mail` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `telf`varchar(9) NOT NULL default '0',
  `interes` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `nComen` varchar(2) collate utf8_spanish2_ci NOT NULL,
  `nMesas` varchar(2) collate utf8_spanish2_ci NOT NULL,
  `fecha` varchar(12) collate utf8_spanish2_ci NOT NULL,
  `hora` varchar(12) collate utf8_spanish2_ci NOT NULL,
  `coment` varchar(150) collate utf8_spanish2_ci NOT NULL,
  `leido` varchar(2) collate utf8_spanish2_ci NOT NULL default 'n',
  `confirmado` varchar(4) collate utf8_spanish2_ci NOT NULL default 'n',
  `leeme` text(500) collate utf8_spanish2_ci NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1;

	/************* CREAMOS LA TABLA FEEDBACK CONTACTO ****************/

DROP TABLE IF EXISTS `contactofeed`;
CREATE TABLE IF NOT EXISTS `contactofeed` (
  `id` int(4) NOT NULL auto_increment,
  `nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `apellido` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `mail` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `telf`varchar(9) NOT NULL default '0',
  `interes` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `nComen` varchar(2) collate utf8_spanish2_ci NOT NULL,
  `nMesas` varchar(2) collate utf8_spanish2_ci NOT NULL,
  `fecha` varchar(12) collate utf8_spanish2_ci NOT NULL,
  `hora` varchar(12) collate utf8_spanish2_ci NOT NULL,
  `coment` varchar(250) collate utf8_spanish2_ci NOT NULL,
  `leido` varchar(2) collate utf8_spanish2_ci NOT NULL default 'n',
  `confirmado` varchar(4) collate utf8_spanish2_ci NOT NULL default 'n',
  `leeme` text(500) collate utf8_spanish2_ci NULL,
  `borrado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1;
