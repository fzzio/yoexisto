-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 01:54:24
-- Versión del servidor: 5.5.31
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yoexisto_db`
--
CREATE DATABASE IF NOT EXISTS `yoexisto_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yoexisto_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Area 1', 'Area descripcion'),
(2, 'Area 2', 'Area que sigue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donde_id` int(11) DEFAULT NULL,
  `que_id` int(11) DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `estado` int(11) NOT NULL,
  `positivos` int(11) NOT NULL,
  `negativos` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EDDB2C4B87C9E990` (`donde_id`),
  KEY `IDX_EDDB2C4BD5760B6B` (`que_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id`, `donde_id`, `que_id`, `usuario`, `descripcion`, `estado`, `positivos`, `negativos`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'fzzio', NULL, 1, 0, 0, '2014-12-05 22:24:05', '2014-12-05 22:36:55'),
(4, 2, 2, 'fzzio', NULL, 1, 0, 0, '2014-12-06 00:02:33', '2014-12-06 00:03:22'),
(5, 4, 4, 'fzzio', NULL, 1, 0, 0, '2014-12-06 00:07:14', '2014-12-06 01:13:59'),
(6, 3, 3, 'algunuser', NULL, 1, 0, 0, '2014-12-06 00:29:08', '2014-12-06 00:30:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donde`
--

CREATE TABLE IF NOT EXISTS `donde` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `municipio_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B7D51C9B58BC1BE0` (`municipio_id`),
  KEY `IDX_B7D51C9BBD0F409C` (`area_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `donde`
--

INSERT INTO `donde` (`id`, `nombre`, `latitud`, `longitud`, `descripcion`, `municipio_id`, `area_id`) VALUES
(1, '', '', '', 'colombia', 1, 2),
(2, '', '-0.1806532', '0', 'quito', 2, 2),
(3, '', '-2.1709978999999997', '0', 'ahi fue', 2, 2),
(4, '', '-33.616667', '0', 'puente alto', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Municipio Uno', 'Este municipio'),
(2, 'Municipio Dos', 'El otro municipio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_que`
--

CREATE TABLE IF NOT EXISTS `tbl_que` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `archivo` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_que`
--

INSERT INTO `tbl_que` (`id`, `titulo`, `descripcion`, `archivo`) VALUES
(1, 'control titulado', 'esto es asi', 'artesano-social.jpg'),
(2, 'Error', 'Es una anomalia', 'Metegol.jpg'),
(3, 'Problema en la via', 'lorep ipsum problema en la via', 'IMG_20130409_012947.jpg'),
(4, 'El titulo', 'texto descriptivo de la anomalia o reporte', 'bx_loco.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05D92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2265B05DA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `cedula`, `activacion`) VALUES
(1, 'otrouser', 'otrouser', 'mail@mail.com', 'mail@mail.com', 1, '2lbfo07qouck8gwsko0ggwokos80wk4', 'Ud8kAaZkmZFm4qDkBs4ijMMplMhyT4UdrOEhMGyQxyE6OKIepRfnaWhZawopJdZj6gc50rfNzIrZJt0Imnvy2Q==', '2014-12-05 10:49:55', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '07777777', NULL),
(2, 'home', 'home', 'home@algunmail.com', 'home@algunmail.com', 1, 'mx5w4x700y8cok88cocso44g80ok8ww', 'IqF+JTsYbQ3zfupAFk1OrCgU0qou9O66srVPPf8NB0zsM0RqlnAxzr2l6EZJpwumr3pSvoQHG+OSSb3tWlZLSg==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0987654321', NULL),
(3, 'mawa', 'mawa', 'mawa@mail.com', 'mawa@mail.com', 1, 'tai6bs1mtf4sscwggs0wk8k4gkowcgk', 'LhyX9/ENzSOG3F9kNkOl1KloMXyN6TiCYxF54ikDYj5iHxj1CQh1mRzrwTmj8S+7MC+7WRGQkOrKxyb31xfOaw==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '09876543200', NULL),
(4, 'fzzio', 'fzzio', 'fabricio_fdop_007@hotmail.com', 'fabricio_fdop_007@hotmail.com', 1, 'lzxsbcn8ag0k8cg44kg4w0kcc0oc0sc', 'rbtH4B/1hwUOP6cwfU9mWMZWpYKpvZJN2qeMG9RwAj36VOg3DGwi4pEv3p1cXXbns8XLqf43TZ8LSw7yfz+Gjw==', '2014-12-06 01:09:51', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0922', NULL),
(6, 'adminuser', 'adminuser', 'fzzio007@gmail.com', 'fzzio007@gmail.com', 1, 'f8vl9u6vsvksw84w0k0w4ggwk0c0wsk', 'k8c5basy58p/VruWHdn5E8IDWDHxfl33/oHIN0ZU/oUMdHNMUzkXW4dR37p0f5jR+ktfUGQbdM2LgJFLr5M90Q==', '2014-12-06 01:02:12', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL, NULL),
(7, 'algunuser', 'algunuser', 'ALGUNUSER@mail.com', 'algunuser@mail.com', 1, 'cn7gp4rey9s000gwk0w0k04www0ckgo', 'caelykiPk8MHMEOBeig5Oi8Lt9WloUQK2PHA49klEovFS9tUnB60XU2d/HaNcV8w7n7Hs34hWTKFHWLdcQcP6A==', '2014-12-06 00:29:02', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '3021654789', NULL),
(8, 'usuariofinal', 'usuariofinal', 'estemail@mail.com', 'estemail@mail.com', 1, 'hdkrfvzoysgkksw80c04kocsocg0c4c', 'SK6o4QZmgoDZwJVRo5gmQ3nvFAZqtuUxNl0HTif9jSfGWdf+MMhL/OIlTleBtGx8XaZgADTDvrlrFZvSNQ/YPg==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '1478963250', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

CREATE TABLE IF NOT EXISTS `voto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos_control`
--

CREATE TABLE IF NOT EXISTS `votos_control` (
  `votos_id` int(11) NOT NULL,
  `control_id` int(11) NOT NULL,
  PRIMARY KEY (`votos_id`,`control_id`),
  UNIQUE KEY `UNIQ_142B856132BEC70E` (`control_id`),
  KEY `IDX_142B856119B8C769` (`votos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `FK_EDDB2C4B87C9E990` FOREIGN KEY (`donde_id`) REFERENCES `donde` (`id`),
  ADD CONSTRAINT `FK_EDDB2C4BD5760B6B` FOREIGN KEY (`que_id`) REFERENCES `tbl_que` (`id`);

--
-- Filtros para la tabla `donde`
--
ALTER TABLE `donde`
  ADD CONSTRAINT `FK_B7D51C9BBD0F409C` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  ADD CONSTRAINT `FK_B7D51C9B58BC1BE0` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`);

--
-- Filtros para la tabla `votos_control`
--
ALTER TABLE `votos_control`
  ADD CONSTRAINT `FK_142B856132BEC70E` FOREIGN KEY (`control_id`) REFERENCES `voto` (`id`),
  ADD CONSTRAINT `FK_142B856119B8C769` FOREIGN KEY (`votos_id`) REFERENCES `control` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
