-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-05-2026 a las 19:13:54
-- Versión del servidor: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `HNDWEBMR18`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Angelyn_users`
--

CREATE TABLE `Angelyn_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Angelyn_users`
--

INSERT INTO `Angelyn_users` (`user_id`, `username`, `password`, `DOB`) VALUES
(1, 'kar1', 'kar1', '1995-03-05'),
(3, 'fran2', 'fran2', '1992-06-13'),
(7, 'jim2', 'jim2', '1996-05-10'),
(8, 'riki1', 'riki1', '2003-07-17'),
(9, 'admin', 'admin123', '1990-05-19'),
(10, 'Lewis_Lowrie!', 'Lewis2', '1993-02-23'),
(11, 'fabri', 'fabri12', '1990-02-14'),
(12, 'aye1', 'aye123', '1997-11-18'),
(14, 'AnitaLoveChess', 'pokerdeases1', '1986-10-15'),
(15, 'AnitaLoveChess1', 'Pokerdeases123', '1992-07-25'),
(16, 'keko', 'keko1', '1963-11-17'),
(17, 'lara', 'lara1', '1967-10-15'),
(18, 'lowriell', 'lowriell', '1993-02-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Angelyn_users`
--
ALTER TABLE `Angelyn_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Angelyn_users`
--
ALTER TABLE `Angelyn_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
