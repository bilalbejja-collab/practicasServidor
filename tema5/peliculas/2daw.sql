-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2019 a las 12:28:54
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `2daw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

CREATE TABLE `actores` (
  `id_actor` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(3) NOT NULL,
  `nacionalidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `actores`
--

INSERT INTO `actores` (`id_actor`, `nombre`, `apellidos`, `edad`, `nacionalidad`) VALUES
(1, 'Robert', 'De Niro', 76, 'estadounidense'),
(2, 'Brad', 'Pitt', 55, 'es'),
(3, 'Marlon', 'Brando', -1, 'estadounidense'),
(4, 'Leonardo', 'DiCaprio', 45, 'canadiense'),
(5, 'Al', 'Pacino', 72, 'estadounidense'),
(6, 'Harrison', 'Ford', 77, 'estadounidense'),
(7, 'Ryan', 'Gosling', 39, 'canadiense'),
(8, 'Tom', 'Hardy', 42, 'Inglés'),
(9, 'Charlize', 'Theron', 44, 'sudafricana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actorespeliculas`
--

CREATE TABLE `actorespeliculas` (
  `id_actor` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `actorespeliculas`
--

INSERT INTO `actorespeliculas` (`id_actor`, `id_pelicula`) VALUES
(2, 22),
(3, 1),
(4, 22),
(5, 1),
(6, 23),
(6, 24),
(7, 23),
(8, 25),
(9, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criticas`
--

CREATE TABLE `criticas` (
  `id_critica` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `autor` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `texto` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nota` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `criticas`
--

INSERT INTO `criticas` (`id_critica`, `id_pelicula`, `autor`, `texto`, `nota`) VALUES
(11, 22, 'El Mundo', 'Una obra maestra (...) Es el propio cine el que es invocado en su totalidad, en su plenitud, en su rareza y en su desesperación (...) Una película descomunal y monumental que deja sin aliento la posibilidad de nada más.', 4),
(12, 22, 'Filmaffinity', 'El mayor logro que se puede adjudicar aquí Tarantino es potenciar (...) el espectacular carisma de Brad Pitt y Leonardo DiCaprio. Ellos dos sostienen la película, y esa traca final con la que siempre se puede contar, la justifica. Un balance más que positivo, pero por debajo de la media a la que nos tenía acostumbrados el maestro.', 3),
(13, 22, 'El Periódico', 'Todo Tarantino es excelente, o como mínimo muy bueno. Érase una vez en… Hollywood es el opus de su carrera, la mirada mítico-poética a una época crucial de la cultura popular estadounidense', 5),
(14, 1, 'El Mundo', 'El padrino son palabras mayores. Las dos primeras partes están entre las 10 mejores películas de la historia del cine', 5),
(15, 1, 'El País', 'Coppola inventa una nueva mirada para el cine y amplía los horizontes de una industria que pedía a gritos savia nueva', 5),
(16, 24, 'El País', 'Un castillo de fuegos artificiales de primer nivel. Claro que el guión acumula baches, y en el fondo, estas aventuras de Indiana Jones en la India son de lo más livianas, pero eso es lo de menos. Spielberg llena el filme de nervio e intensidad.', 4),
(17, 23, 'ABC', 'Más que una secuela, menos que el original. Habría que evitar algo inevitable: comparar esta película de Denis Villeneuve con la original (...) Es una magnífica película, pero de este año y, a lo sumo, del próximo.', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `director` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` int(4) NOT NULL,
  `sinopsis` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cartel` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `genero`, `director`, `fecha`, `sinopsis`, `cartel`) VALUES
(1, 'El Padrino', 'Drama', 'Francis Ford Coppola', 1972, 'América, años 40. Don Vito Corleone (Marlon Brando) es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York. Tiene cuatro hijos: Connie (Talia Shire), el impulsivo Sonny (James Caan), el pusilánime Fredo (John Cazale) y Michael (Al Pacino), que no quiere saber nada de los negocios de su padre. Cuando Corleone, en contra de los consejos de \'Il consigliere\' Tom Hagen (Robert Duvall), se niega a participar en el negocio de las drogas, el jefe de otra banda ordena su asesinato', 'https://i.ebayimg.com/images/g/JUAAAOxy0zhTPAT2/s-l300.jpg'),
(22, 'Erase una vez en Hollywood', 'Drama', 'Tarantino', 2019, 'Hollywood, años 60. La estrella de un western televisivo, Rick Dalton (DiCaprio), intenta amoldarse a los cambios del medio al mismo tiempo que su doble (Pitt). La vida de Dalton está ligada completamente a Hollywood, y es vecino de la joven y prometedora actriz y modelo Sharon Tate (Robbie) que acaba de casarse con el prestigioso director Roman Polanski.', 'http://es.web.img2.acsta.net/r_1920_1080/pictures/19/06/13/12/35/3349389.jpg'),
(23, 'Blade Runner 2049', 'Ciencia Ficción', 'Denis Villeneuve', 2017, 'Treinta años después de los eventos del primer film, un nuevo blade runner, K (Ryan Gosling) descubre un secreto profundamente oculto que podría acabar con el caos que impera en la sociedad. El descubrimiento de K le lleva a iniciar la búsqueda de Rick Deckard (Harrison Ford), un blade runner al que se le perdió la pista hace 30 años.', 'http://es.web.img3.acsta.net/pictures/17/08/25/11/58/463146.jpg'),
(24, 'Indiana Jones y el templo maldito', 'Aventuras', 'Steven Spielberg', 1984, '1935. Shanghai. El intrépido arqueólogo Indiana Jones, tras meterse en jaleos en un local nocturno, consigue escapar junto a una bella cantante y su joven acompañante. Tras un accidentado vuelo, los tres acaban en la India, donde intentarán ayudar a los habitantes de un pequeño poblado, cuyos niños han sido raptados. ', 'http://es.web.img3.acsta.net/medias/nmedia/18/78/65/06/20250063.jpg'),
(25, 'Mad Max: furia en la carretera', 'Ciencia Ficción', 'George Miller', 2015, 'Perseguido por su turbulento pasado, Mad Max cree que la mejor forma de sobrevivir es ir solo por el mundo. Sin embargo, se ve arrastrado a formar parte de un grupo que huye a través del desierto en un War Rig conducido por una Emperatriz de élite: Furiosa. Escapan de una Ciudadela tiranizada por Immortan Joe, a quien han arrebatado algo irreemplazable. Enfurecido, el Señor de la Guerra moviliza a todas sus bandas y persigue implacablemente a los rebeldes en una \"guerra de la carretera\" de altas revoluciones... Cuarta entrega de la saga post-apocalíptica que resucita la trilogía que a principios de los ochenta protagonizó Mel Gibson.', 'https://i.blogs.es/621e6f/mad-max/450_1000.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actores`
--
ALTER TABLE `actores`
  ADD PRIMARY KEY (`id_actor`);

--
-- Indices de la tabla `actorespeliculas`
--
ALTER TABLE `actorespeliculas`
  ADD PRIMARY KEY (`id_actor`,`id_pelicula`);

--
-- Indices de la tabla `criticas`
--
ALTER TABLE `criticas`
  ADD PRIMARY KEY (`id_critica`),
  ADD KEY `pelicula` (`id_pelicula`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actores`
--
ALTER TABLE `actores`
  MODIFY `id_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `criticas`
--
ALTER TABLE `criticas`
  MODIFY `id_critica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actorespeliculas`
--
ALTER TABLE `actorespeliculas`
  ADD CONSTRAINT `actores_bfk` FOREIGN KEY (`id_actor`) REFERENCES `actores` (`id_actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peliculas_bfk` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `criticas`
--
ALTER TABLE `criticas`
  ADD CONSTRAINT `pelicula` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
