-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2021 a las 02:04:23
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `traveler-airlines_v3`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `vuelos_disponibles` (IN `ciudadOrigen` INT(100), IN `ciudadDestino` INT(100), IN `fechaSalida` DATE, IN `cantidadPasajeros` INT)  BEGIN
SELECT v.Codigo_Vuelo as cod_vuelo,
	   a1.Ciudad as origen,
       a1.Codigo_IATA as cod_origen,
       a2.Ciudad as destino,
       a2.Codigo_IATA as cod_destino,
       DATE_FORMAT(v.Fecha_Salida,"%Y-%m-%d") as fecha_salida,
       DATE_FORMAT(v.Fecha_Salida,"%H:%i") as hora_salida,
       DATE_FORMAT(v.Fecha_Llegada,"%Y-%m-%d") as fecha_llegada,
       DATE_FORMAT(v.Fecha_Llegada,"%H:%i") as hora_llegada,
       r.Duracion_Aprox duracion,
       ev.Descripcion as estado,
       ROUND(v.Costo, 2) as costo,
       air.Capacidad - (SELECT COUNT(*) FROM asientosreservados WHERE asientosreservados.Codigo_Vuelo_AR = v.Codigo_Vuelo) as asientos_disponibles
       FROM vuelos v inner join rutas r on v.Codigo_Ruta_V = r.Codigo_Ruta
                     inner join aeropuertos a1 on r.Origen = a1.ID_Aeropuerto
                     inner join aeropuertos a2 on r.Destino = a2.ID_Aeropuerto
                     inner join estado_vuelo ev on v.Estado_V = ev.ID_Estado
                     inner join aviones air on air.Codigo_Avion = v.Codigo_Avion_V
       WHERE a1.ID_Aeropuerto = ciudadOrigen and
             a2.ID_Aeropuerto = ciudadDestino and
             DATE_FORMAT(v.Fecha_Salida,"%Y-%m-%d") = fechaSalida and 
             (air.Capacidad - (SELECT COUNT(*) FROM asientosreservados WHERE asientosreservados.Codigo_Vuelo_AR = v.Codigo_Vuelo)) >= cantidadPasajeros;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeropuertos`
--

CREATE TABLE `aeropuertos` (
  `ID_Aeropuerto` int(11) NOT NULL,
  `Nombre_Aeropuerto` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Estado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Ciudad` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Codigo_IATA` varchar(5) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `aeropuertos`
--

INSERT INTO `aeropuertos` (`ID_Aeropuerto`, `Nombre_Aeropuerto`, `Estado`, `Ciudad`, `Codigo_IATA`) VALUES
(1, 'Aeropuerto General Roberto Fierro Villalobos', 'Chihuahua', 'Chihuahua', 'CUU'),
(2, 'Aeropuerto General Mariano Escobedo', 'Nuevo León', 'Monterrey', 'MTY'),
(3, 'Aeropuerto Ponciano Arriaga', 'San Luis Potosí', 'San Luis Potosí', 'SLP'),
(4, 'Aeropuerto Licenciado Jesús Terán Peredo', 'Aguascalientes', 'Aguascalientes', 'AGU'),
(5, 'Aeropuerto Benito Juárez', 'Ciudad de México', 'Ciudad de México', 'MEX'),
(6, 'Aeropuerto del Bajío', 'Guanajuato', 'Zona metropolitana de León', 'BJX'),
(7, 'Aeropuerto Licenciado Adolfo López Mateos', 'México', 'Toluca', 'TLC'),
(8, 'Aeropuerto de Querétaro', 'Querétaro', 'Querétaro', 'QRO'),
(9, 'Aeropuerto Manuel Márquez de León', 'Baja California Sur', 'La Paz', 'LAP'),
(10, 'Aeropuerto General Rodolfo Sánchez Taboada', 'Baja California', 'Mexicali', 'MXL'),
(11, 'Aeropuerto Miguel Hidalgo y Costilla', 'Jalisco', 'Guadalajara', 'GDL'),
(12, 'Aeropuerto Federal de Culiacán', 'Sinaloa', 'Culiacán', 'CUL'),
(13, 'Aeropuerto General Ignacio Pesqueira García', 'Sonora', 'Hermosillo', 'HMO'),
(14, 'Aeropuerto Ángel Albino Corzo', 'Chiapas', 'Tuxtla Gutíerrez', 'TGZ'),
(15, 'Aeropuerto Xoxocotlán', 'Oaxaca', 'Oaxaca', ''),
(16, 'Aeropuerto de Cancún', 'Quintana Roo', 'Cancún', 'OAX'),
(17, 'Aeropuerto Carlos Rovirosa Pérez', 'Tabasco', 'Villahermosa', 'VSA'),
(18, 'Aeropuerto General Heriberto Jara', 'Veracruz', 'Veracruz', 'VER'),
(19, 'Aeropuerto Manuel Cresencio Rejón', 'Yucatán', 'Mérida', 'MID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientos`
--

CREATE TABLE `asientos` (
  `Numero_Asiento` int(11) NOT NULL,
  `Fila` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ID_Clase_As` int(11) NOT NULL,
  `Codigo_Avion_As` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asientos`
--

INSERT INTO `asientos` (`Numero_Asiento`, `Fila`, `ID_Clase_As`, `Codigo_Avion_As`) VALUES
(1, 'A', 2, 1),
(1, 'B', 2, 1),
(1, 'C', 1, 1),
(1, 'D', 1, 1),
(1, 'E', 1, 1),
(1, 'F', 1, 1),
(2, 'A', 2, 1),
(2, 'B', 2, 1),
(2, 'C', 1, 1),
(2, 'D', 1, 1),
(2, 'E', 1, 1),
(2, 'F', 1, 1),
(3, 'A', 2, 1),
(3, 'B', 2, 1),
(3, 'C', 1, 1),
(3, 'D', 1, 1),
(3, 'E', 1, 1),
(3, 'F', 1, 1),
(4, 'A', 2, 1),
(4, 'B', 2, 1),
(4, 'C', 1, 1),
(4, 'D', 1, 1),
(4, 'E', 1, 1),
(5, 'A', 2, 1),
(5, 'B', 2, 1),
(5, 'C', 1, 1),
(5, 'D', 1, 1),
(5, 'E', 1, 1),
(6, 'A', 2, 1),
(6, 'B', 2, 1),
(6, 'C', 1, 1),
(6, 'D', 1, 1),
(6, 'E', 1, 1),
(7, 'A', 2, 1),
(7, 'C', 1, 1),
(7, 'D', 1, 1),
(7, 'E', 1, 1),
(8, 'A', 2, 1),
(8, 'C', 1, 1),
(8, 'D', 1, 1),
(8, 'E', 1, 1),
(9, 'A', 2, 1),
(9, 'C', 1, 1),
(9, 'D', 1, 1),
(9, 'E', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asientosreservados`
--

CREATE TABLE `asientosreservados` (
  `Numero_Reservacion_AR` int(11) NOT NULL,
  `Codigo_Vuelo_AR` int(11) NOT NULL,
  `Numero_Asiento_AR` int(11) NOT NULL,
  `Fila_AR` varchar(2) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asientosreservados`
--

INSERT INTO `asientosreservados` (`Numero_Reservacion_AR`, `Codigo_Vuelo_AR`, `Numero_Asiento_AR`, `Fila_AR`) VALUES
(1, 1, 3, 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviones`
--

CREATE TABLE `aviones` (
  `Codigo_Avion` int(11) NOT NULL,
  `Modelo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Descripcion` varchar(500) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Capacidad` int(11) NOT NULL DEFAULT 45,
  `Estado` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'LIBRE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `aviones`
--

INSERT INTO `aviones` (`Codigo_Avion`, `Modelo`, `Descripcion`, `Capacidad`, `Estado`) VALUES
(1, 'Boeing 747', 'El avión Boeing 747 es un jet comercial de fuselaje ancho, para pasajeros y carga, muchas veces se utiliza su apodo original “Jumbo Jet” o “Reina de los cielos”, es de los aviones más reconocibles del mundo y fue el primer avión de fuselaje ancho que se haya producido.', 45, 'LIBRE'),
(2, 'Boeing 747', 'El avión Boeing 747 es un jet comercial de fuselaje ancho, para pasajeros y carga, muchas veces se utiliza su apodo original “Jumbo Jet” o “Reina de los cielos”, es de los aviones más reconocibles del mundo y fue el primer avión de fuselaje ancho que se haya producido.', 45, 'LIBRE'),
(3, 'Boeing 747', 'El avión Boeing 747 es un jet comercial de fuselaje ancho, para pasajeros y carga, muchas veces se utiliza su apodo original “Jumbo Jet” o “Reina de los cielos”, es de los aviones más reconocibles del mundo y fue el primer avión de fuselaje ancho que se haya producido.', 45, 'LIBRE'),
(4, 'Boeing 747', 'El avión Boeing 747 es un jet comercial de fuselaje ancho, para pasajeros y carga, muchas veces se utiliza su apodo original “Jumbo Jet” o “Reina de los cielos”, es de los aviones más reconocibles del mundo y fue el primer avión de fuselaje ancho que se haya producido.', 45, 'LIBRE'),
(5, 'Boeing 747', 'El avión Boeing 747 es un jet comercial de fuselaje ancho, para pasajeros y carga, muchas veces se utiliza su apodo original “Jumbo Jet” o “Reina de los cielos”, es de los aviones más reconocibles del mundo y fue el primer avión de fuselaje ancho que se haya producido.', 45, 'LIBRE'),
(6, 'Boeing 777', 'Entre sus características distintivas está que posee el motor turbofan de diámetro más grande de cualquier avión, seis ruedas en cada tren de aterrizaje principal, tiene un fuselaje de corte transversal circular y una cola en forma de cuchilla.', 45, 'LIBRE'),
(7, 'Boeing 777', 'Entre sus características distintivas está que posee el motor turbofan de diámetro más grande de cualquier avión, seis ruedas en cada tren de aterrizaje principal, tiene un fuselaje de corte transversal circular y una cola en forma de cuchilla.', 45, 'LIBRE'),
(8, 'Boeing 777', 'Entre sus características distintivas está que posee el motor turbofan de diámetro más grande de cualquier avión, seis ruedas en cada tren de aterrizaje principal, tiene un fuselaje de corte transversal circular y una cola en forma de cuchilla.', 45, 'LIBRE'),
(9, 'Boeing 777', 'Entre sus características distintivas está que posee el motor turbofan de diámetro más grande de cualquier avión, seis ruedas en cada tren de aterrizaje principal, tiene un fuselaje de corte transversal circular y una cola en forma de cuchilla.', 45, 'LIBRE'),
(10, 'McDonnell Douglas MD-80', 'El McDonnell Douglas MD-80 es una familia de jets comerciales de tamaño mediano, de corto y mediano alcance, de un solo pasillo. La serie es un DC-9 alargado y actualizado. Puede transportar entre 130 y 172 pasajeros en variadas disposiciones de asientos y dependiendo de la variante de MD-80 que se trata.', 45, 'LIBRE'),
(11, 'McDonnell Douglas MD-80', 'El McDonnell Douglas MD-80 es una familia de jets comerciales de tamaño mediano, de corto y mediano alcance, de un solo pasillo. La serie es un DC-9 alargado y actualizado. Puede transportar entre 130 y 172 pasajeros en variadas disposiciones de asientos y dependiendo de la variante de MD-80 que se trata.', 45, 'LIBRE'),
(12, 'McDonnell Douglas MD-80', 'El McDonnell Douglas MD-80 es una familia de jets comerciales de tamaño mediano, de corto y mediano alcance, de un solo pasillo. La serie es un DC-9 alargado y actualizado. Puede transportar entre 130 y 172 pasajeros en variadas disposiciones de asientos y dependiendo de la variante de MD-80 que se trata.', 45, 'LIBRE'),
(13, 'Embraer 170', 'El Embraer (Empresa Brasileira de Aeronáutica) ofrece la familia E-Jet que es una de jets de fuselaje estrecho de mediano alcance. Entraron en producción en el año 2002 y ha sido un éxito de ventas.', 45, 'LIBRE'),
(14, 'Embraer 170', 'El Embraer (Empresa Brasileira de Aeronáutica) ofrece la familia E-Jet que es una de jets de fuselaje estrecho de mediano alcance. Entraron en producción en el año 2002 y ha sido un éxito de ventas.', 45, 'LIBRE'),
(15, 'Embraer 170', 'El Embraer (Empresa Brasileira de Aeronáutica) ofrece la familia E-Jet que es una de jets de fuselaje estrecho de mediano alcance. Entraron en producción en el año 2002 y ha sido un éxito de ventas.', 45, 'LIBRE'),
(16, 'Embraer 170', 'El Embraer (Empresa Brasileira de Aeronáutica) ofrece la familia E-Jet que es una de jets de fuselaje estrecho de mediano alcance. Entraron en producción en el año 2002 y ha sido un éxito de ventas.', 45, 'LIBRE'),
(17, 'Airbus A320', 'Es una familia de jets comerciales de alcance corto a mediano. Los aviones son de fuselaje estrecho para transporte de pasajeros construidos por la compañía multinacional Airbus.', 45, 'LIBRE'),
(18, 'Airbus A320', 'Es una familia de jets comerciales de alcance corto a mediano. Los aviones son de fuselaje estrecho para transporte de pasajeros construidos por la compañía multinacional Airbus.', 45, 'LIBRE'),
(19, 'Boeing 757', 'El Boeing 757 es un avión jet de fuselaje estrecho de dos motores contruido por la compañía Boeing Commercial Airplanes (BCA) con cuarteles generales en Renton, Washington, EE.UU. Es el avión más grande de fuselaje estrecho de la compañía.', 45, 'LIBRE'),
(20, 'Boeing 757', 'El Boeing 757 es un avión jet de fuselaje estrecho de dos motores contruido por la compañía Boeing Commercial Airplanes (BCA) con cuarteles generales en Renton, Washington, EE.UU. Es el avión más grande de fuselaje estrecho de la compañía.', 45, 'LIBRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `ID_Clase` int(11) NOT NULL,
  `Nombre_Clase` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Descripcion` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Costo` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`ID_Clase`, `Nombre_Clase`, `Descripcion`, `Costo`) VALUES
(1, 'Turista', 'Es una clase en la que tanto el valor del billete es el más bajo, ya que los niveles de confort son más bajos que en otras clases.', '0.0000'),
(2, 'Ejecutiva', 'Ofrece más comodidades al viajero que las clases inferiores.', '0.4000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_contactos`
--

CREATE TABLE `detalle_contactos` (
  `ID_Detalle` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Numero_Pasajero_DC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_contactos`
--

INSERT INTO `detalle_contactos` (`ID_Detalle`, `Nombre`, `Apellido`, `Correo`, `Telefono`, `Numero_Pasajero_DC`) VALUES
(1, 'Ruben', 'Gomez Ulloa', 'r.gomez18@info.uas.edu.mx', '(667) 229-7855', 1),
(2, 'Alden Kevin', 'Garcia Quintero', 'ak.garcia18@info.uas.edu.mx', '(667) 659-3205', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `Numero_Empleado` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Sexo` char(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Puesto` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Vigencia` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`Numero_Empleado`, `Nombre`, `Apellido`, `Fecha_Nacimiento`, `Sexo`, `Correo`, `Telefono`, `Puesto`, `Vigencia`) VALUES
(1, 'Osiris Alejandro', 'Meza Hernandez', '2000-09-11', 'M', 'o.meza18@info.uas.edu.mx', '(667) 429-9196', 'VENTAS', 'ACTIVO'),
(2, 'Ernesto Adrian', 'Lopez Figueroa', '1998-05-31', 'M', 'ea.lopez18@info.uas.edu.mx', '(667) 159-4587', 'VENTAS', 'ACTIVO'),
(3, 'Martha Angelica', 'Martinez Piñera', '1990-08-27', 'F', 'ma.martinez19@info.uas.edu.mx', '(667) 751-9266', 'ADMINISTRADOR', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipaje`
--

CREATE TABLE `equipaje` (
  `ID_Equipaje` int(11) NOT NULL,
  `Peso` decimal(5,2) NOT NULL,
  `Tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'MANO',
  `Importe_Extra` decimal(16,4) NOT NULL DEFAULT 0.0000,
  `Numero_Reservacion_Eq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_vuelo`
--

CREATE TABLE `estado_vuelo` (
  `ID_Estado` int(11) NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estado_vuelo`
--

INSERT INTO `estado_vuelo` (`ID_Estado`, `Descripcion`) VALUES
(1, 'DISPONIBLE'),
(2, 'EN CURSO'),
(3, 'FINALIZADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajeros`
--

CREATE TABLE `pasajeros` (
  `Numero_Pasajero` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Sexo` char(1) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pasajeros`
--

INSERT INTO `pasajeros` (`Numero_Pasajero`, `Nombre`, `Apellido`, `Fecha_Nacimiento`, `Sexo`) VALUES
(1, 'Ruben', 'Gomez Ulloa', '1999-03-30', 'M'),
(2, 'Alden Kevin', 'Garcia Quintero', '2000-01-25', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `Numero_Reservacion` int(11) NOT NULL,
  `Numero_Pasajero_Re` int(11) NOT NULL,
  `Codigo_Vuelo_Re` int(11) NOT NULL,
  `Numero_Empleado_Re` int(11) NOT NULL,
  `Fecha_Reservacion` datetime NOT NULL,
  `Asistencia` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'PENDIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`Numero_Reservacion`, `Numero_Pasajero_Re`, `Codigo_Vuelo_Re`, `Numero_Empleado_Re`, `Fecha_Reservacion`, `Asistencia`) VALUES
(1, 1, 3, 1, '2021-01-02 00:00:00', 'PENDIENTE'),
(2, 2, 1, 1, '2021-01-02 00:00:00', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `Codigo_Ruta` int(11) NOT NULL,
  `Origen` int(11) NOT NULL,
  `Destino` int(11) NOT NULL,
  `Duracion_Aprox` int(11) NOT NULL COMMENT 'Duración en Minutos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`Codigo_Ruta`, `Origen`, `Destino`, `Duracion_Aprox`) VALUES
(1, 12, 5, 70),
(2, 12, 11, 45),
(3, 12, 10, 50),
(4, 5, 12, 70),
(5, 5, 16, 60),
(6, 5, 11, 50),
(7, 5, 2, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_Usuario` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Contraseña` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Link_Foto` varchar(1000) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'foto.jpg',
  `Numero_Empleado_U` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre_Usuario`, `Contraseña`, `Link_Foto`, `Numero_Empleado_U`) VALUES
(1, 'Osiris_MH', 'contra', 'https://1.bp.blogspot.com/-swg8C41eG00/X1VbvxXQX7I/AAAAAAAAXl0/RyMA1LnxTZwB14vqrdSpbFQiyadlUalSQCPcBGAYYCw/s320/Vegetta777_Aries.jpg', 1),
(2, 'Adrian_LF', 'PasameAJean', 'https://memegenerator.net/img/images/11816978.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `Codigo_Vuelo` int(11) NOT NULL,
  `Fecha_Salida` datetime NOT NULL,
  `Fecha_Llegada` datetime NOT NULL,
  `Estado_V` int(11) NOT NULL DEFAULT 1,
  `Codigo_Avion_V` int(11) NOT NULL,
  `Codigo_Ruta_V` int(11) NOT NULL,
  `Costo` decimal(19,4) NOT NULL DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`Codigo_Vuelo`, `Fecha_Salida`, `Fecha_Llegada`, `Estado_V`, `Codigo_Avion_V`, `Codigo_Ruta_V`, `Costo`) VALUES
(1, '2021-01-10 06:00:00', '2021-01-10 07:00:00', 1, 1, 7, '300.0000'),
(2, '2021-01-11 10:00:00', '2021-01-11 11:00:00', 1, 2, 2, '500.0000'),
(3, '2021-01-15 20:00:00', '2021-01-15 21:30:00', 1, 1, 1, '1000.0000'),
(4, '2021-01-20 16:00:00', '2021-01-20 17:00:00', 1, 4, 3, '700.0000'),
(5, '2021-01-28 06:00:00', '2021-01-28 07:00:00', 1, 1, 1, '400.0000'),
(6, '2021-01-10 06:00:00', '2021-01-10 07:00:00', 1, 10, 1, '500.0000'),
(7, '2021-01-10 12:00:00', '2021-01-10 13:00:00', 1, 14, 1, '350.0000'),
(8, '2021-01-10 10:00:00', '2021-01-10 11:00:00', 1, 5, 7, '320.0000');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aeropuertos`
--
ALTER TABLE `aeropuertos`
  ADD PRIMARY KEY (`ID_Aeropuerto`);

--
-- Indices de la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD PRIMARY KEY (`Numero_Asiento`,`Fila`),
  ADD KEY `ID_Clase_As` (`ID_Clase_As`),
  ADD KEY `Codigo_Avion_As` (`Codigo_Avion_As`);

--
-- Indices de la tabla `asientosreservados`
--
ALTER TABLE `asientosreservados`
  ADD UNIQUE KEY `Numero_Reservacion_AR` (`Numero_Reservacion_AR`),
  ADD KEY `Numero_Asiento_AR` (`Numero_Asiento_AR`,`Fila_AR`),
  ADD KEY `Codigo_Vuelo_AR` (`Codigo_Vuelo_AR`);

--
-- Indices de la tabla `aviones`
--
ALTER TABLE `aviones`
  ADD PRIMARY KEY (`Codigo_Avion`) USING BTREE;

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`ID_Clase`);

--
-- Indices de la tabla `detalle_contactos`
--
ALTER TABLE `detalle_contactos`
  ADD PRIMARY KEY (`ID_Detalle`),
  ADD KEY `Numero_Pasajero_DC` (`Numero_Pasajero_DC`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`Numero_Empleado`);

--
-- Indices de la tabla `equipaje`
--
ALTER TABLE `equipaje`
  ADD PRIMARY KEY (`ID_Equipaje`),
  ADD KEY `Numero_Reservacion_Eq` (`Numero_Reservacion_Eq`);

--
-- Indices de la tabla `estado_vuelo`
--
ALTER TABLE `estado_vuelo`
  ADD PRIMARY KEY (`ID_Estado`);

--
-- Indices de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  ADD PRIMARY KEY (`Numero_Pasajero`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`Numero_Reservacion`) USING BTREE,
  ADD KEY `Numero_Pasajero_Re` (`Numero_Pasajero_Re`),
  ADD KEY `Codigo_Vuelo_Re` (`Codigo_Vuelo_Re`),
  ADD KEY `Numero_Empleado_Re` (`Numero_Empleado_Re`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`Codigo_Ruta`),
  ADD KEY `Origen` (`Origen`),
  ADD KEY `Destino` (`Destino`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `Numero_Empleado_U` (`Numero_Empleado_U`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`Codigo_Vuelo`),
  ADD KEY `Estado_V` (`Estado_V`),
  ADD KEY `Codigo_Avion_V` (`Codigo_Avion_V`),
  ADD KEY `Codigo_Ruta_V` (`Codigo_Ruta_V`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aeropuertos`
--
ALTER TABLE `aeropuertos`
  MODIFY `ID_Aeropuerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `aviones`
--
ALTER TABLE `aviones`
  MODIFY `Codigo_Avion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalle_contactos`
--
ALTER TABLE `detalle_contactos`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `Numero_Empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `equipaje`
--
ALTER TABLE `equipaje`
  MODIFY `ID_Equipaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  MODIFY `Numero_Pasajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `Numero_Reservacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `Codigo_Ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `Codigo_Vuelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asientos`
--
ALTER TABLE `asientos`
  ADD CONSTRAINT `asientos_ibfk_1` FOREIGN KEY (`Codigo_Avion_As`) REFERENCES `aviones` (`Codigo_Avion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asientos_ibfk_2` FOREIGN KEY (`ID_Clase_As`) REFERENCES `clases` (`ID_Clase`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asientosreservados`
--
ALTER TABLE `asientosreservados`
  ADD CONSTRAINT `asientosreservados_ibfk_1` FOREIGN KEY (`Numero_Asiento_AR`,`Fila_AR`) REFERENCES `asientos` (`Numero_Asiento`, `Fila`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asientosreservados_ibfk_2` FOREIGN KEY (`Numero_Reservacion_AR`) REFERENCES `reservaciones` (`Numero_Reservacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asientosreservados_ibfk_3` FOREIGN KEY (`Codigo_Vuelo_AR`) REFERENCES `vuelos` (`Codigo_Vuelo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_contactos`
--
ALTER TABLE `detalle_contactos`
  ADD CONSTRAINT `detalle_contactos_ibfk_1` FOREIGN KEY (`Numero_Pasajero_DC`) REFERENCES `pasajeros` (`Numero_Pasajero`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipaje`
--
ALTER TABLE `equipaje`
  ADD CONSTRAINT `equipaje_ibfk_1` FOREIGN KEY (`Numero_Reservacion_Eq`) REFERENCES `reservaciones` (`Numero_Reservacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_1` FOREIGN KEY (`Codigo_Vuelo_Re`) REFERENCES `vuelos` (`Codigo_Vuelo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`Numero_Empleado_Re`) REFERENCES `empleados` (`Numero_Empleado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservaciones_ibfk_3` FOREIGN KEY (`Numero_Pasajero_Re`) REFERENCES `pasajeros` (`Numero_Pasajero`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`Origen`) REFERENCES `aeropuertos` (`ID_Aeropuerto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rutas_ibfk_2` FOREIGN KEY (`Destino`) REFERENCES `aeropuertos` (`ID_Aeropuerto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Numero_Empleado_U`) REFERENCES `empleados` (`Numero_Empleado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `vuelos_ibfk_1` FOREIGN KEY (`Codigo_Avion_V`) REFERENCES `aviones` (`Codigo_Avion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vuelos_ibfk_2` FOREIGN KEY (`Estado_V`) REFERENCES `estado_vuelo` (`ID_Estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vuelos_ibfk_3` FOREIGN KEY (`Codigo_Ruta_V`) REFERENCES `rutas` (`Codigo_Ruta`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
