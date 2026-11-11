-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-05-2026 a las 19:13:39
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
-- Estructura de tabla para la tabla `Angelyn_products`
--

CREATE TABLE `Angelyn_products` (
  `item_id` int(11) NOT NULL,
  `category` enum('bebes','nina','nino') NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `item_colour` varchar(50) NOT NULL,
  `item_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `Angelyn_products`
--

INSERT INTO `Angelyn_products` (`item_id`, `category`, `item_img`, `item_name`, `item_description`, `item_colour`, `item_price`) VALUES
(1, 'bebes', 'vestido-estampado-flores.jpg', 'Vestido estampado flores', 'Vestido estampado de flores para bebe con detalle rojo.', 'rosa', 25.99),
(2, 'bebes', 'vestido-lazos-laterales.jpg', 'Vestido lazos laterales', 'Vestido rosa con lazos a los laterales para bebe', 'rosa', 29.99),
(3, 'bebes', 'blusa-a-cuadros.jpg', 'Blusa a cuadros bebé', 'Blusa de tela a cuadros para bebe de 0-12 meses. Material: 100% algodón', 'rosa, blanco', 9.99),
(4, 'bebes', 'blusa-de-volantes.jpg', 'Blusa de volantes', 'Blusa de volantes para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rosa, blanco', 9.99),
(5, 'bebes', 'camisa-estampado.jpg', 'Camisa estampado', 'Camisa para bebe con estampado de fresa. Todas las tallas desde 0-12 meses. Material: 100% algodón', 'rojo, verde', 9.99),
(6, 'bebes', 'camisa-panadera.jpg', 'Camisa Panadera', 'Camisa estilo Panadera para bebe. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'blanco', 9.99),
(7, 'bebes', 'culetin-a-cuadros.jpg', 'Culetin a cuadros', 'Culetín elástico estampado a cuadros para bebe. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rosa, marrón', 8.99),
(8, 'bebes', 'culetin-de-flores.jpg', 'Culetin de flores', 'Culetín elástico con estampado de flores para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rojo, verde', 8.99),
(9, 'bebes', 'culetin-gris.jpg', 'Culetin Gris', 'Culetin elástico de color gris para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'gris', 8.99),
(10, 'bebes', 'culetin-rojo.jpg', 'Culetin Rojo', 'Culetín elástico de color rojo para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rojo', 8.99),
(11, 'bebes', 'culetin-rosa.jpg', 'Culetin Rosa', 'Culetín elástico de color rosa para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rosa', 8.99),
(12, 'bebes', 'faldon-bautizo-rosa.jpg', 'Faldón Bautizo', 'Faldón de bautizo para bebé de color rosa con lazos en los laterelas. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'rosa', 19.99),
(13, 'bebes', 'faldon-bautizo-azul.jpg', 'Faldón Bautizo', 'Faldón para Bautizo de color azul para bebé. Tenemos todas las tallas desde 0-12 meses. Material: 100% algodón.', 'azul', 19.99),
(14, 'nina', 'chaleco-unisex-a-rayas.jpg', 'Chaleco a rayas unisex', 'Chaleco de color rosa para niña o niño con estampado a rayas. Temporada otoño.', 'multi', 23.99),
(15, 'nina', 'abrigo-corto-rosa.jpg', 'Abrigo rosa niña', 'Abrigo de color rosa para niña temporada otono/invierno. ', 'rosa', 39.99),
(16, 'nina', 'abrigo-largo-a-cuadros.jpg', 'Abrigo a cuadros', 'Abrigo a cuadros largo para niña. Tenemos todas las tallas desde 1 año a 12 años.', 'rosa, morado', 49.99),
(17, 'nina', 'abrigo-largo-beige.jpg', 'Abrigo liso', 'Abrigo liso de color beige para niña. Tenemos todas las tallas desde 1 año a 12 años.', 'marrón', 49.99),
(18, 'nina', 'blusa-azul.jpg', 'Blusa con estampado', 'Blusa estampado de flores con detalle en pecho para niña. Tenemos todas las tallas desde 1 año a 12 años.', 'morado', 15.49),
(19, 'nina', 'blusa-estampado-de-flores.jpg', 'Blusa estamapado hojas', 'Blusa de tela estampada de hojas otoñales para niña. Tenemos todas las tallas desde 1 año a 12 años.', 'rojo, verde', 16.45),
(20, 'nina', 'falda-a-cuadros.jpg', 'Falda a cuadros', 'Falda con estamapado de cuadros tartán para niña. Tenemos todas las tallas desde 1 año a 12 años.', 'rojo, verde', 12.79),
(21, 'nina', 'falda-de-pana.jpg', 'Falda de pana', 'Falda de pana color marrón para niña. Tenemos todas la tallas de niña entre 3 años a 12 años.', 'marron', 14.49),
(22, 'nina', 'falda-estampado-azul.jpg', 'Falda estampado flores', 'Falda con estampado de flores color azul para niña. Tenemos todas la tallas de niña entre 3 años a 12 años.', 'azul', 14.45),
(23, 'nina', 'vestido-camison.jpg', 'Vestido liso blanco', 'Vestido 100% algodón liso de color blanco para niña. Tenemos todas la tallas de niña entre 6 años a 12 años.', 'blanco', 12.99),
(24, 'nina', 'vestido-campestre.jpg', 'Vestido Campestre', 'Vestido estilo campestre de estampado con detalle en el pecho para niña. Tenemos todas la tallas de niña entre 3 años a 12 años.', 'marron', 15.79),
(25, 'nina', 'vestido-de-pana.jpg', 'Vestido de pana', 'Vestido de pana de color marron con volantes en detalle para niña. Tenemos todas la tallas de niña entre 3 años a 12 años.', 'marron', 15.79),
(26, 'nino', 'abrigo-corto-gris.jpg', 'Abrigo Corto Gris', 'Abrigo corto de color gris para niño. Tenemos todas las tallas desde 1 año a 12 años. ', 'gris', 49.99),
(27, 'nino', 'bermudas-de-tirantes-a-cuadros.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes con estampado a cuadros para niño. Tenemos todas las tallas desde 1 año a 12 años. ', 'beige, marrón', 15.99),
(28, 'nino', 'bermudas-de-tirantes-azul.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes de color azul para niño. Tenemos todas las tallas desde 1 año a 12 años. ', 'azul', 15.99),
(29, 'nino', 'bermudas-de-tirantes-dots.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes con estampado de puntos, estilo dots, para niños. Tenemos todas las tallas desde 1 año a 12 años. ', 'beige, rojo', 15.99),
(30, 'nino', 'bermudas-de-tirantes-gris.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes de color gris para niño. Tenemos todas las tallas desde 1 año a 12 años.', 'gris', 15.99),
(31, 'nino', 'bermudas-de-tirantes-marron.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes de color marrón. Tenemos todas las tallas desde 1 año a 12 años. ', 'marron', 15.99),
(32, 'nino', 'bermudas-de-tirantes-negro.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes de color negro para niño. Tenemos todas las tallas desde 1 año a 12 años. ', 'negro', 15.99),
(33, 'nino', 'bermudas-de-tirantes-niño.jpg', 'Bermudas de tirantes', 'Bermudas de tirantes de color marron claro para niño. Tenemos todas las tallas desde 1 año a 12 años.', 'marron', 15.99),
(34, 'nino', 'blusa-unisex.jpg', 'Blusa unisex', 'Blusa unisex de color blanco para niño o niña. Tenemos todas las tallas desde 1 año a 12 años.', 'blanco', 9.99),
(35, 'nino', 'camisa-a-rayas.jpg', 'Conjunto Camisa a rayas', 'Conjunto Camisa a rayasConjunto de niño. Camisa con estamapado a rayas para niño. Tenemos todas las tallas desde 1 año a 12 años.', 'blanco', 12.99),
(36, 'nino', 'camisa-volante.jpg', 'Camisa con volantes', 'Camisa con volantes en detalle en cuello y mangas. Tenemos todas las tallas desde 1 año a 12 años. Material 100% algodón.', 'blanco', 8.99),
(37, 'nino', 'pantalon-a-rayas.jpg', 'Conjunto Pantalon a rayas', 'Conjunto para niño. Pantalon con estampado a rayas para niño. Tenemos todas las tallas desde 1 año a 12 años.', 'blanco', 11.59);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Angelyn_products`
--
ALTER TABLE `Angelyn_products`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Angelyn_products`
--
ALTER TABLE `Angelyn_products`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
