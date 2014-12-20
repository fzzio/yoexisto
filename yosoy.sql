-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-12-2014 a las 13:45:44
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yosoy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci,
  `municipio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D7943D6858BC1BE0` (`municipio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `nombre`, `descripcion`, `municipio_id`) VALUES
(1, 'Area 1', 'Area descripcion', 1),
(2, 'Area 2', 'Area que sigue', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`id`, `donde_id`, `que_id`, `usuario`, `descripcion`, `estado`, `positivos`, `negativos`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'fzzio', NULL, 1, 0, 0, '2014-12-05 22:24:05', '2014-12-05 22:36:55'),
(4, 2, 2, 'fzzio', NULL, 1, 0, 0, '2014-12-06 00:02:33', '2014-12-06 00:03:22'),
(5, 4, 4, 'fzzio', NULL, 1, 0, 0, '2014-12-06 00:07:14', '2014-12-06 01:13:59'),
(6, 3, 3, 'algunuser', NULL, 1, 0, 0, '2014-12-06 00:29:08', '2014-12-06 00:30:06'),
(7, 5, 5, 'fzzio', NULL, 1, 0, 0, '2014-12-06 19:26:26', '2014-12-07 08:22:56'),
(8, 6, 6, 'fzzio', NULL, 1, 0, 0, '2014-12-07 08:38:22', '2014-12-07 09:11:31'),
(9, 7, 7, 'fzzio', NULL, 1, 0, 0, '2014-12-07 09:11:53', '2014-12-07 09:12:24'),
(10, 8, NULL, 'fzzio', NULL, 0, 0, 0, '2014-12-09 18:58:22', '2014-12-16 15:13:55');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `donde`
--

INSERT INTO `donde` (`id`, `nombre`, `latitud`, `longitud`, `descripcion`, `municipio_id`, `area_id`) VALUES
(1, '', '', '', 'colombia', 1, 2),
(2, '', '-0.1806532', '0', 'quito', 2, 2),
(3, '', '-2.1709978999999997', '0', 'ahi fue', 2, 2),
(4, '', '-33.616667', '0', 'puente alto', 1, 2),
(5, '', '-1.831239', '0', 'ecuador', 2, 1),
(6, '', '53.3532974', '0', 'wer', 1, 1),
(7, '', '36.6561539', '0', 'www', 1, 1),
(8, '', '0', '0', 'salinas', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbl_que`
--

INSERT INTO `tbl_que` (`id`, `titulo`, `descripcion`, `archivo`) VALUES
(1, 'control titulado', 'esto es asi', 'artesano-social.jpg'),
(2, 'Error', 'Es una anomalia', 'Metegol.jpg'),
(3, 'Problema en la via', 'lorep ipsum problema en la via', 'IMG_20130409_012947.jpg'),
(4, 'El titulo', 'texto descriptivo de la anomalia o reporte', 'bx_loco.png'),
(5, 'otra prueba', 'esta es otra prueba', 'app2.png'),
(6, 'we', 'wer', 'spotify.png'),
(7, 'asd', 'ad', 'processing-curso.png');

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
  `foto` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05D92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2265B05DA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `cedula`, `activacion`, `foto`) VALUES
(1, 'otrouser', 'otrouser', 'mail@mail.com', 'mail@mail.com', 1, '2lbfo07qouck8gwsko0ggwokos80wk4', 'Ud8kAaZkmZFm4qDkBs4ijMMplMhyT4UdrOEhMGyQxyE6OKIepRfnaWhZawopJdZj6gc50rfNzIrZJt0Imnvy2Q==', '2014-12-05 10:49:55', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '07777777', NULL, NULL),
(2, 'home', 'home', 'home@algunmail.com', 'home@algunmail.com', 1, 'mx5w4x700y8cok88cocso44g80ok8ww', 'IqF+JTsYbQ3zfupAFk1OrCgU0qou9O66srVPPf8NB0zsM0RqlnAxzr2l6EZJpwumr3pSvoQHG+OSSb3tWlZLSg==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0987654321', NULL, NULL),
(3, 'mawa', 'mawa', 'mawa@mail.com', 'mawa@mail.com', 1, 'tai6bs1mtf4sscwggs0wk8k4gkowcgk', 'LhyX9/ENzSOG3F9kNkOl1KloMXyN6TiCYxF54ikDYj5iHxj1CQh1mRzrwTmj8S+7MC+7WRGQkOrKxyb31xfOaw==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '09876543200', NULL, NULL),
(4, 'fzzio', 'fzzio', 'fabricio_fdop_007@hotmail.com', 'fabricio_fdop_007@hotmail.com', 1, 'lzxsbcn8ag0k8cg44kg4w0kcc0oc0sc', 'rbtH4B/1hwUOP6cwfU9mWMZWpYKpvZJN2qeMG9RwAj36VOg3DGwi4pEv3p1cXXbns8XLqf43TZ8LSw7yfz+Gjw==', '2014-12-15 19:47:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0922', NULL, NULL),
(6, 'adminuser', 'adminuser', 'fzzio007@gmail.com', 'fzzio007@gmail.com', 1, 'f8vl9u6vsvksw84w0k0w4ggwk0c0wsk', 'k8c5basy58p/VruWHdn5E8IDWDHxfl33/oHIN0ZU/oUMdHNMUzkXW4dR37p0f5jR+ktfUGQbdM2LgJFLr5M90Q==', '2014-12-06 01:02:12', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL, NULL, NULL),
(7, 'algunuser', 'algunuser', 'ALGUNUSER@mail.com', 'algunuser@mail.com', 1, 'cn7gp4rey9s000gwk0w0k04www0ckgo', 'caelykiPk8MHMEOBeig5Oi8Lt9WloUQK2PHA49klEovFS9tUnB60XU2d/HaNcV8w7n7Hs34hWTKFHWLdcQcP6A==', '2014-12-06 00:29:02', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '3021654789', NULL, NULL),
(8, 'usuariofinal', 'usuariofinal', 'estemail@mail.com', 'estemail@mail.com', 1, 'hdkrfvzoysgkksw80c04kocsocg0c4c', 'SK6o4QZmgoDZwJVRo5gmQ3nvFAZqtuUxNl0HTif9jSfGWdf+MMhL/OIlTleBtGx8XaZgADTDvrlrFZvSNQ/YPg==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '1478963250', NULL, NULL),
(9, 'otrofzzio', 'otrofzzio', 'f@mail.com', 'f@mail.com', 1, 'ini1g7rm1yosgo0swsggcssoswo0cog', 'boF7iZZbJEYvP/7FccEr8nNTYVFY5eFAu2+tflrPeFCqnuMWIB5z0WwtyUBToUFa6jhfm4745WqoBQvo4dSEDQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0111111111', NULL, NULL),
(10, 'eluser2', 'eluser2', 'ELUSER2@mail.com', 'eluser2@mail.com', 1, 'nj7bcsszdyos888oc0080k0sskkcsg4', 'HaJ4XFPfw/CZ4ibzSg2uUAijh+gzCHojskYKwKzZImIobN0ZJXZ2ktFJ3Suoh0UcMaX8pSrXIc32pGFXFsEnHA==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0999999999', NULL, NULL),
(11, 'qwerty', 'qwerty', 'qwerty@mail.com', 'qwerty@mail.com', 1, '2e0ljgq1b6dc0kkc48gkc4sc0k8go8g', 'Ypv3fG0I5AhI1zD+2Ak1+O3K6kBH56+qktr2wVjU9G+U/YiI6CY4Neepy5KdzphNMH7oy2Ofi06b8B4GbjWkbQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0222222222', NULL, NULL),
(12, 'elsiete', 'elsiete', 'ELSIETE@mail.com', 'elsiete@mail.com', 1, 'jg9qgfesexsgcckwc8kw8g8ko80ckgg', 'HABvvqt/Yvv5AU5XRrLBYT3azTO+GEQuotM8EPkMY77/XH5rr2rc8ZInIR+3o3cH9iDAtVaBzeFcGkjDRx/9Ew==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0100000000', NULL, NULL),
(13, 'eljue', 'eljue', 'ELJUE@mail.com', 'eljue@mail.com', 1, 'xkdgsgiun3kskokwkskk0cgk80gwcs', 'V3O01SSrfGwVHv6dB3PTK1J5ld3Y64w+utvQIghZyFKAQaLfHXD3b9NCMjMbjecVSYqnrmVNHgm95nAh4QH+Bw==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0009996666', NULL, '7546913947613935773.jpg'),
(14, 'eljuan', 'eljuan', 'ELJUAN@mail.com', 'eljuan@mail.com', 1, 'ppb7ksj8zy80sgoo4sssco4ko04wwcs', 'UmwIc8g2iGCwv5oBayqVgxy6Z6311ZZ5z6XyXEShjGpJCpVnuYLfuyio2fmb9ObwSKTj0UTgUJcHunDNGjRa1Q==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0000000444', NULL, '20130727_222352.jpg'),
(15, 'esefue', 'esefue', 'ESEFUE@mail.com', 'esefue@mail.com', 1, 'dym0sajl86go8g48cw8okck40gow0w8', 'lPt9xWIrcn0OaLl1XB6mng3Uvq6X4HHhKhBklo3vzM1redgeAR8ToAJXDiyH75oGaDHMdRnWLCHCFbmU86Q+RQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '1122222222', NULL, '7546913947613935773.jpg'),
(17, 'prueba', 'prueba', 'halvarado2401@gmail.com', 'halvarado2401@gmail.com', 1, '3kx7tul7avi8k08cskkck4ckw80g04s', 'p6V0O8jwq3N8hwTr9Vjjjcn0hACEeIfhriiOJydx291x+JRgsgqyLPyZ1uIWqz0hghWgFcjd+mbJ1voGlYJS8Q==', '2014-12-20 12:23:27', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0926178385', NULL, 'logo.png');

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
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `FK_D7943D6858BC1BE0` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`);

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
  ADD CONSTRAINT `FK_B7D51C9B58BC1BE0` FOREIGN KEY (`municipio_id`) REFERENCES `municipio` (`id`),
  ADD CONSTRAINT `FK_B7D51C9BBD0F409C` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `votos_control`
--
ALTER TABLE `votos_control`
  ADD CONSTRAINT `FK_142B856119B8C769` FOREIGN KEY (`votos_id`) REFERENCES `control` (`id`),
  ADD CONSTRAINT `FK_142B856132BEC70E` FOREIGN KEY (`control_id`) REFERENCES `voto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
