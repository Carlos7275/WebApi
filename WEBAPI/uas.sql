-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 05:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--
CREATE DATABASE IF NOT EXISTS `uas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `uas`;

-- --------------------------------------------------------

--
-- Table structure for table `datos_usuario`
--

CREATE TABLE `datos_usuario` (
  `NumCuenta` int(11) NOT NULL,
  `Nombres` varchar(255) NOT NULL,
  `ApellidoPaterno` varchar(255) NOT NULL,
  `ApellidoMaterno` varchar(255) NOT NULL,
  `Domicilio` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Telefono` varchar(13) NOT NULL,
  `CodigoPostal` varchar(5) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `Discapacidad` tinyint(1) NOT NULL,
  `AfiliacionIMSS` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datos_usuario`
--

INSERT INTO `datos_usuario` (`NumCuenta`, `Nombres`, `ApellidoPaterno`, `ApellidoMaterno`, `Domicilio`, `Correo`, `Telefono`, `CodigoPostal`, `CURP`, `Discapacidad`, `AfiliacionIMSS`) VALUES
(19104863, 'Carlos Fernando', 'Sandoval', 'Lizárraga', 'Colonia Popular 75 Calle Ahome #2487 Entre Marina Nacional y Ejercito Nacional', 'sandovallizarragacarlos@gmail.com', '6682566496', '81234', 'SALC010214HSLNZRA3', 0, '123123123123123123123'),
(19104861, 'Luisito ', 'Perez', 'Peluche', 'Vice City', 'Correo@gmail.com', '6681234568', '81234', 'MEPI980101HSLNZRA2', 0, 'ASDSA '),
(19104811, 'Filomeno', 'Meno', 'Menas', 'Wall Street', 'Correo@gmail.com', '6681234568', '81234', 'MEPI980101HSLNZRA1', 0, 'ASDSA '),
(191045811, 'Pancho Lopez', 'Meno', 'Menas', 'Wall Street', 'Correo@gmail.com', '6681234568', '81234', 'MEPI980101HSLNZRA2', 0, 'ASDSA '),
(1910458141, 'Filomenos', 'Meno', 'Menas', 'Wall Street', 'Correo@gmail.com', '6681234568', '81234', 'MEPI980101HSLNZRA1', 0, 'ASDSA ');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `Descripcion`) VALUES
(1, 'Administrador'),
(2, 'Estudiante');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `NumCuenta` int(11) NOT NULL COMMENT 'Numero de Cuenta de la Uas',
  `Password` varchar(255) NOT NULL,
  `ID_Rol` int(11) NOT NULL,
  `Estatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`NumCuenta`, `Password`, `ID_Rol`, `Estatus`) VALUES
(19104811, '767dfc361d24fd08f8e59d77e6da8dfa96a9d2d8e070bc01cd1238cdef2622f26beb4275f6c9277465cb4788590318e2846235858a6cd78539cd98c9c6c0014f', 2, 'ACTIVO'),
(19104861, '62c2d33b76fa134822f56d0c677885d8', 2, 'BAJA'),
(19104863, '767dfc361d24fd08f8e59d77e6da8dfa96a9d2d8e070bc01cd1238cdef2622f26beb4275f6c9277465cb4788590318e2846235858a6cd78539cd98c9c6c0014f', 2, 'ACTIVO'),
(191045811, '767dfc361d24fd08f8e59d77e6da8dfa96a9d2d8e070bc01cd1238cdef2622f26beb4275f6c9277465cb4788590318e2846235858a6cd78539cd98c9c6c0014f', 2, 'ACTIVO'),
(1910458141, '767dfc361d24fd08f8e59d77e6da8dfa96a9d2d8e070bc01cd1238cdef2622f26beb4275f6c9277465cb4788590318e2846235858a6cd78539cd98c9c6c0014f', 1, 'ACTIVO');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_token`
--

CREATE TABLE `usuarios_token` (
  `NumCuenta` int(11) NOT NULL,
  `Token` varchar(1000) NOT NULL,
  `Estatus` varchar(255) NOT NULL,
  `Fecha_Creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios_token`
--

INSERT INTO `usuarios_token` (`NumCuenta`, `Token`, `Estatus`, `Fecha_Creado`) VALUES
(19104811, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJOdW1DdWVudGEiOjE5MTA0ODExLCJOb21icmVzIjoiRmlsb21lbm8iLCJBcGVsbGlkb1BhdGVybm8iOiJNZW5vIiwiQXBlbGxpZG9NYXRlcm5vIjoiTWVuYXMiLCJDb3JyZW8iOi', 'ACTIVO', '2022-08-11 02:32:29'),
(19104863, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJOdW1DdWVudGEiOjE5MTA0ODYzLCJOb21icmVzIjoiQ2FybG9zIEZlcm5hbmRvIiwiQXBlbGxpZG9QYXRlcm5vIjoiU2FuZG92YWwiLCJBcGVsbGlkb01hdGVybm8iOiJMaXpcdTAwZTFycmFnYSIsIkNvcnJlbyI6InNhbmRvdmFsbGl6YXJyYWdhY2FybG9zQGdtYWlsLmNvbSIsIlRlbGVmb25vIjoiNjY4MjU2NjQ5NiIsIkRvbWljaWxpbyI6IkNvbG9uaWEgUG9wdWxhciA3NSBDYWxsZSBBaG9tZSAjMjQ4NyBFbnRyZSBNYXJpbmEgTmFjaW9uYWwgeSBFamVyY2l0byBOYWNpb25hbCIsIkNvZGlnb1Bvc3RhbCI6IjgxMjM0IiwiQWZpbGlhY2lvbkltc3MiOiIxMjMxMjMxMjMxMjMxMjMxMjMxMjMiLCJEaXNjYXBhY2lkYWQiOjAsIklEX1JPTCI6MiwiRXN0YXR1cyI6IkFDVElWTyJ9fQ.esfhLmLq7ESWcrZySy7dX4uXXu_FzrvH9vBGdwqbvPA', 'ACTIVO', '2022-08-11 15:02:28'),
(191045811, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXNzYWdlIjoiXHUwMGExT3BlcmFjaW9uIGNvbiBFeGl0byEiLCJzdGF0dXMiOjIwMCwiZGF0YSI6eyJOdW1DdWVudGEiOjE5MTA0NTgxMSwiTm9tYnJlcyI6IlBhbmNobyBMb3BleiIsIkFwZWxsaWRvUGF0ZXJubyI6Ik1lbm8iLCJBcGVsbGlkb01hdGVybm8iOiJNZW5hcyIsIkNvcn', 'ACTIVO', '2022-08-11 02:31:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datos_usuario`
--
ALTER TABLE `datos_usuario`
  ADD KEY `fk_NumUsuario` (`NumCuenta`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`NumCuenta`),
  ADD KEY `FK_Roles_Roles` (`ID_Rol`);

--
-- Indexes for table `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD PRIMARY KEY (`NumCuenta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `NumCuenta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Numero de Cuenta de la Uas', AUTO_INCREMENT=1910458142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `datos_usuario`
--
ALTER TABLE `datos_usuario`
  ADD CONSTRAINT `fk_NumUsuario` FOREIGN KEY (`NumCuenta`) REFERENCES `usuarios` (`NumCuenta`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_Roles_Roles` FOREIGN KEY (`ID_Rol`) REFERENCES `roles` (`id_rol`);

--
-- Constraints for table `usuarios_token`
--
ALTER TABLE `usuarios_token`
  ADD CONSTRAINT `usuarios_token_ibfk_1` FOREIGN KEY (`NumCuenta`) REFERENCES `usuarios` (`NumCuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
