-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2024 a las 09:19:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `egresados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auxiliar`
--

CREATE TABLE `auxiliar` (
  `id` varchar(300) DEFAULT NULL,
  `MES` varchar(300) DEFAULT NULL,
  `NOMBRES` varchar(300) DEFAULT NULL,
  `TipoDocumentoID` varchar(300) DEFAULT NULL,
  `NumeroDocumento` varchar(300) DEFAULT NULL,
  `LugarResidenciaID` varchar(300) DEFAULT NULL,
  `DireccionResidencia` varchar(300) DEFAULT NULL,
  `CorreoElectronico` varchar(300) DEFAULT NULL,
  `TelefonoCelular` varchar(300) DEFAULT NULL,
  `OcupacionActual` varchar(300) DEFAULT NULL,
  `VinculacionPatrocinio` varchar(300) DEFAULT NULL,
  `CentroFormacion` varchar(300) DEFAULT NULL,
  `Ficha` varchar(300) DEFAULT NULL,
  `FechaCertificacion` varchar(300) DEFAULT NULL,
  `EstudiosAdicionales` varchar(300) DEFAULT NULL,
  `FechaUltimaLlamada` varchar(300) DEFAULT NULL,
  `NumeroFijo` varchar(300) DEFAULT NULL,
  `Genero` varchar(300) DEFAULT NULL,
  `OtroTelefonoContacto` varchar(300) DEFAULT NULL,
  `ProgramaFormacionSENAID` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresados`
--

CREATE TABLE `egresados` (
  `id` int(11) NOT NULL,
  `MES` varchar(255) DEFAULT NULL,
  `NOMBRES` varchar(255) NOT NULL,
  `TipoDocumentoID` enum('CC','TI','PASAPORTE') DEFAULT NULL,
  `NumeroDocumento` varchar(20) DEFAULT NULL,
  `LugarResidenciaID` int(11) DEFAULT NULL,
  `DireccionResidencia` varchar(255) DEFAULT NULL,
  `CorreoElectronico` varchar(255) DEFAULT NULL,
  `TelefonoCelular` varchar(20) DEFAULT NULL,
  `OcupacionActual` enum('Trabaja','Estudia','Otro') DEFAULT NULL,
  `VinculacionPatrocinio` enum('Si','No') DEFAULT NULL,
  `CentroFormacion` varchar(255) DEFAULT NULL,
  `Ficha` varchar(10) DEFAULT NULL,
  `FechaCertificacion` date DEFAULT NULL,
  `EstudiosAdicionales` varchar(255) DEFAULT NULL,
  `FechaUltimaLlamada` date DEFAULT NULL,
  `NumeroFijo` varchar(20) DEFAULT NULL,
  `Genero` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `OtroTelefonoContacto` varchar(20) DEFAULT NULL,
  `ProgramaFormacionSENAID` int(11) DEFAULT NULL,
  `cod_centro` enum('1010','9405','101011','9209','9210','9212','9214','9215','9211','9216','9217','9406','9403','9404','9508','9303','9213') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egresados`
--

INSERT INTO `egresados` (`id`, `MES`, `NOMBRES`, `TipoDocumentoID`, `NumeroDocumento`, `LugarResidenciaID`, `DireccionResidencia`, `CorreoElectronico`, `TelefonoCelular`, `OcupacionActual`, `VinculacionPatrocinio`, `CentroFormacion`, `Ficha`, `FechaCertificacion`, `EstudiosAdicionales`, `FechaUltimaLlamada`, `NumeroFijo`, `Genero`, `OtroTelefonoContacto`, `ProgramaFormacionSENAID`, `cod_centro`) VALUES
(1, 'Julio', 'Javier López', 'CC', '999000111', 10, 'Carrera 234', 'javier@example.com', '3136543210', 'Trabaja', 'Si', 'Centro 10', '54321', '2022-12-20', 'Psicología', '2023-04-25', '987234567', 'Masculino', '222333666', NULL, NULL),
(2, 'Agosto', 'Isabel Ramírez', 'TI', '888999000', 11, 'Avenida 567', 'isabel@example.com', '3129876543', 'Estudia', 'No', 'Centro 11', '98765', '2022-11-15', 'Ingeniería Industrial', '2023-03-10', '987765432', 'Femenino', '333444555', NULL, NULL),
(3, 'Septiembre', 'Miguel González', 'TI', '555444333', 12, 'Calle 890', 'miguel@example.com', '3151234567', 'Trabaja', 'No', 'Centro 12', '45678', '2022-10-10', 'Administración de Negocios', '2023-02-15', '987098765', 'Masculino', '222555666', NULL, NULL),
(4, 'Octubre', 'Luisa Martínez', 'PASAPORTE', '444555666', 13, 'Carrera 123', 'luisa@example.com', '3166543210', 'Otro', 'Si', 'Centro 13', '34567', '2022-09-05', 'Derecho', '2023-01-20', '987234567', 'Femenino', '333666777', NULL, NULL),
(5, 'Noviembre', 'Carlos Gómez', 'PASAPORTE', '333444555', 14, 'Avenida 456', 'carlos@example.com', '3109876543', 'Estudia', 'Si', 'Centro 14', '23456', '2022-08-01', 'Medicina', '2022-12-05', '987765432', 'Masculino', '222444555', NULL, NULL),
(6, 'Diciembre', 'Ana Pérez', 'TI', '222333444', 15, 'Calle 789', 'ana@example.com', '3181234567', 'Trabaja', 'No', 'Centro 15', '12345', '2022-07-10', 'Contabilidad', '2022-11-15', '987098765', 'Femenino', '333777888', NULL, NULL),
(7, 'Enero', 'Sofía Vargas', 'PASAPORTE', '111222333', 16, 'Carrera 345', 'sofia@example.com', '3206543210', 'Estudia', 'Si', 'Centro 16', '87654', '2022-06-15', 'Diseño Industrial', '2022-10-20', '987765432', 'Femenino', '222333444', NULL, NULL),
(8, 'Febrero', 'Pedro González', 'TI', '000111222', 17, 'Calle 456', 'pedro@example.com', '3131234567', 'Otro', 'Si', 'Centro 17', '76543', '2022-05-20', 'Ingeniería Química', '2022-09-25', '987234567', 'Masculino', '222444666', NULL, NULL),
(9, 'Marzo', 'Luisa Martínez', 'CC', '777888999', 18, 'Avenida 567', 'luisa@example.com', '3156543210', 'Trabaja', 'No', 'Centro 18', '65432', '2022-04-15', 'Comunicación Social', '2022-08-30', '987098765', 'Femenino', '333777000', NULL, NULL),
(10, NULL, 'Juan Perez', 'PASAPORTE', '123456789', 1, 'Calle 123', 'juan@example.com', '1234567890', 'Trabaja', 'Si', 'Centro 1', '12345', '2023-10-30', 'Estudios 1', '2023-10-30', '987654321', 'Masculino', '9876543210', NULL, NULL),
(12, NULL, 'Carlos Gonzalez', 'TI', '456789123', 3, 'Plaza 789', 'carlos@example.com', '7891234560', 'Otro', 'Si', 'Centro 3', '67890', '2023-10-28', 'Estudios 3', '2023-10-28', '234567891', 'Masculino', '2345678910', NULL, NULL),
(43, 'Diciembre', 'Luisa Martínez', 'PASAPORTE', '555666777', 3, 'Calle de la Esperanza 789', 'luisa@email.com', '5556667770', 'Otro', 'Si', 'Centro C', 'F789', '2023-03-25', 'Arquitectura', '2023-08-12', '333444555', 'Femenino', '456789012', 3, NULL),
(44, 'Enero', 'Carlos Rodríguez', 'CC', '987654321', 1, 'Av. Libertad 101', 'carlos@email.com', '9876543201', 'Trabaja', 'No', 'Centro A', 'F101', '2023-04-30', 'Diseño Gráfico', '2023-07-05', '789012345', 'Masculino', '567890123', 1, NULL),
(45, 'Febrero', 'Laura González', 'CC', '2468101214', 2, 'Carrera 15 #25-30', 'laura@email.com', '3141592653', 'Estudia', 'No', 'Centro B', 'F314', '2023-05-10', 'Marketing', '2023-06-20', '1618033988', 'Femenino', '1123581321', 2, NULL),
(46, 'Marzo', 'Gabriel Pérez', 'TI', '1357911131', 3, 'Avenida Principal 789', 'gabriel@email.com', '2718281828', 'Trabaja', 'Si', 'Centro C', 'F271', '2023-06-18', 'Ingeniería Civil', '2023-05-15', '1414213562', 'Masculino', '2357111317', 3, NULL),
(47, 'Abril', 'María Sánchez', 'CC', '1012141618', 1, 'Calle 50 #60-70', 'maria@email.com', '1234876495', 'Estudia', 'No', 'Centro A', 'F1234', '2023-07-22', 'Biología', '2023-04-12', '9876543210', 'Femenino', '987654321', 1, NULL),
(48, 'Mayo', 'Andrés Ramírez', 'PASAPORTE', '1614121816', 2, 'Carrera 30 #40-50', 'andres@email.com', '9876543210', 'Otro', 'Si', 'Centro B', 'F987', '2023-08-05', 'Comunicación Social', '2023-03-30', '8765432109', 'Masculino', '876543210', 2, NULL),
(49, 'Junio', 'Sofía Hernández', 'CC', '1928374655', 3, 'Calle 80 #90-100', 'sofia@email.com', '5678901234', 'Trabaja', 'Si', 'Centro C', 'F567', '2023-09-10', 'Psicología', '2023-02-28', '7654321098', 'Femenino', '6543210987', 3, NULL),
(50, 'Julio', 'Diego Gómez', 'TI', '2837465566', 1, 'Avenida 10 #15-20', 'diego@email.com', '8765432109', 'Estudia', 'No', 'Centro A', 'F890', '2023-10-15', 'Medicina', '2023-01-25', '6543210987', 'Masculino', '5432109876', 1, NULL),
(51, 'Agosto', 'Valentina Castro', 'CC', '3746558899', 2, 'Carrera 25 #30-40', 'valentina@email.com', '9876543210', 'Otro', 'Si', 'Centro B', 'F901', '2023-11-20', 'Economía', '2022-12-20', '5432109876', 'Femenino', '4321098765', 2, NULL),
(52, 'Septiembre', 'Mateo Vargas', 'PASAPORTE', '4865533344', 3, 'Calle 70 #80-90', 'mateo@email.com', '6543210987', 'Trabaja', 'No', 'Centro C', 'F234', '2023-12-05', 'Derecho', '2022-11-15', '4321098765', 'Masculino', '3210987654', 3, NULL),
(54, 'Diciembre', 'Martín Herrera', 'PASAPORTE', '4321098765', 3, 'Avenida 20 #30-40', 'martin@email.com', '1234567890', 'Otro', 'Si', 'Centro C', 'F4321', '2023-12-18', 'Ingeniería Eléctrica', '2023-02-15', '9876543210', 'Masculino', '3456789012', 3, NULL),
(60, 'Agosto', 'Diego Ramírez', 'CC', '6789012345', 3, 'Carrera 654', 'diego@email.com', '6789012345', 'Otro', 'No', 'Centro C', 'F678', '2023-08-08', 'Marketing', '2023-03-10', '432109876', 'Masculino', '123456789', 3, NULL),
(61, 'Septiembre', 'Isabel Gutiérrez', 'TI', '7890123456', 1, 'Calle 456', 'isabel@email.com', '7890123456', 'Estudia', 'Si', 'Centro A', 'F789', '2023-09-09', 'Ingeniería Industrial', '2023-02-28', '321098765', 'Femenino', '234567890', 1, NULL),
(62, 'Octubre', 'Andrés Hernández', 'CC', '8901234567', 2, 'Avenida 123', 'andres@email.com', '8901234567', 'Trabaja', 'No', 'Centro B', 'F890', '2023-10-10', 'Administración de Empresas', '2023-01-25', '210987654', 'Masculino', '345678901', 2, NULL),
(63, 'Noviembre', 'Daniela Díaz', 'CC', '9012345678', 3, 'Carrera 321', 'daniela@email.com', '9012345678', 'Otro', 'Si', 'Centro C', 'F901', '2023-11-11', 'Medicina', '2023-07-15', '109876543', 'Femenino', '456789012', 3, NULL),
(64, 'Marzo', 'Sofía Navarro', 'CC', '3456789012', 1, 'Calle 123', 'sofia@email.com', '3456789012', 'Trabaja', 'No', 'Centro A', 'F3456', '2024-03-03', 'Biología', '2023-12-20', '765432109', 'Femenino', '890123456', 1, NULL),
(65, 'Abril', 'Eduardo Medina', 'TI', '4567890123', 2, 'Avenida 456', 'eduardo@email.com', '4567890123', 'Estudia', 'Si', 'Centro B', 'F4567', '2024-04-04', 'Ingeniería Civil', '2023-11-15', '654321098', 'Masculino', '901234567', 2, NULL),
(66, 'Mayo', 'Carla Soto', 'CC', '5678901234', 3, 'Carrera 789', 'carla@email.com', '5678901234', 'Otro', 'Si', 'Centro C', 'F5678', '2024-05-05', 'Marketing', '2023-10-12', '543210987', 'Femenino', '012345678', 3, NULL),
(67, 'Diciembre', 'Roberto Silva', 'CC', '9123456789', 1, 'Calle 789', 'roberto@email.com', '9123456789', 'Trabaja', 'Si', 'Centro A', 'F912', '2023-12-12', 'Derecho', '2023-06-30', '098765432', 'Masculino', '567890123', 1, NULL),
(68, 'Enero', 'Laura Castro', 'PASAPORTE', '1234567890', 2, 'Avenida 456', 'laura@email.com', '1234567890', 'Estudia', 'No', 'Centro B', 'F1234', '2024-01-01', 'Psicología', '2023-08-05', '987654321', 'Femenino', '678901234', 2, NULL),
(69, 'Febrero', 'Ricardo Morales', 'CC', '2345678901', 3, 'Carrera 321', 'ricardo@email.com', '2345678901', 'Otro', 'Si', 'Centro C', 'F2345', '2024-02-02', 'Comunicación Social', '2023-10-10', '876543210', 'Masculino', '789012345', 3, NULL),
(70, 'MARZO', 'ricardo pinzon', 'CC', '1151254', NULL, NULL, 'WILLIAM_Saavedra@yahoo.com', '3002763892', NULL, NULL, 'CDM', '2104595', '0000-00-00', 'si', '0000-00-00', 'NO', NULL, NULL, NULL, NULL),
(71, 'MARZO', 'Rita moros', 'CC', '1010424', NULL, NULL, 'forte94@gmail.com', '3204735719', NULL, NULL, 'CDM', '1616910', '0000-00-00', 'NO', '0000-00-00', 'NO', NULL, NULL, NULL, NULL),
(72, 'FEBRERO', 'DIEGO', 'CC', '10245675442', NULL, NULL, 'ospina@gmial.com', '33151851', NULL, NULL, 'IDM', '1505151', '0000-00-00', 'NO', '0000-00-00', 'no', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `ID` int(11) NOT NULL,
  `HoraInicio` datetime DEFAULT NULL,
  `HoraFinalizacion` datetime DEFAULT NULL,
  `CorreoElectronico` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `HoraUltimaModificacion` datetime DEFAULT NULL,
  `AutorizacionDatosPersonales` varchar(255) DEFAULT NULL,
  `NombresApellidosCompletos` varchar(255) DEFAULT NULL,
  `TipoIdentificacion` varchar(50) DEFAULT NULL,
  `NumeroDocumentoIdentificacion` varchar(20) DEFAULT NULL,
  `CorreoElectronicoPersonal` varchar(255) DEFAULT NULL,
  `NumeroCelular` varchar(20) DEFAULT NULL,
  `NumeroFijo` varchar(20) DEFAULT NULL,
  `Genero` varchar(20) DEFAULT NULL,
  `AnioCertificacion` int(11) DEFAULT NULL,
  `UltimoNivelFormacionSenacursado` varchar(255) DEFAULT NULL,
  `ProgramaFormacionCentroDiseño` varchar(255) DEFAULT NULL,
  `AlternativaEtapaProductiva` varchar(255) DEFAULT NULL,
  `NombreEmpresaEtapaProductiva` varchar(255) DEFAULT NULL,
  `ContinuaLaborandoEmpresaEtapaProductiva` varchar(3) DEFAULT NULL,
  `ReconocimientoFormacionAcademica` varchar(3) DEFAULT NULL,
  `ContinuacionFormacionComplementariaSenacursado` varchar(3) DEFAULT NULL,
  `NivelFormacionActual` varchar(255) DEFAULT NULL,
  `SeEncuentraActualmenteEstudiando` varchar(3) DEFAULT NULL,
  `UniversidadProgramaEstudia` varchar(255) DEFAULT NULL,
  `TituloSenaoportunidades` varchar(3) DEFAULT NULL,
  `PertinenciaProgramaFormacionCampoLaboral` varchar(255) DEFAULT NULL,
  `ValorAspectosProgramaFormacion` varchar(255) DEFAULT NULL,
  `MejorasProgramaFormacionSenacursado` varchar(255) DEFAULT NULL,
  `OcupacionActual` varchar(255) DEFAULT NULL,
  `SalarioMensual` varchar(255) DEFAULT NULL,
  `CanalBusquedaEmpleo` varchar(255) DEFAULT NULL,
  `CargoEmpresaTrabajo` varchar(255) DEFAULT NULL,
  `NombreEmpresaTrabajo` varchar(255) DEFAULT NULL,
  `ExperienciaLaboral` varchar(255) DEFAULT NULL,
  `ConocimientoServiciosPortafolioSenacursado` varchar(255) DEFAULT NULL,
  `ExpectativasOfrecimientoCentroDiseño` varchar(255) DEFAULT NULL,
  `ParticipacionActividadesSenadespuesCertificar` varchar(3) DEFAULT NULL,
  `ServiciosDeseaRecibirInformacion` varchar(255) DEFAULT NULL,
  `ComentariosSugerencias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `MES` varchar(255) DEFAULT NULL,
  `NOMBRES` varchar(255) NOT NULL,
  `TipoDocumentoID` enum('CC','TI','PASAPORTE') DEFAULT NULL,
  `NumeroDocumento` varchar(20) DEFAULT NULL,
  `LugarResidenciaID` int(11) DEFAULT NULL,
  `DireccionResidencia` varchar(255) DEFAULT NULL,
  `CorreoElectronico` varchar(255) DEFAULT NULL,
  `TelefonoCelular` varchar(20) DEFAULT NULL,
  `OcupacionActual` enum('Trabaja','Estudia','Otro') DEFAULT NULL,
  `VinculacionPatrocinio` enum('Si','No') DEFAULT NULL,
  `CentroFormacion` varchar(255) DEFAULT NULL,
  `Ficha` varchar(10) DEFAULT NULL,
  `FechaCertificacion` date DEFAULT NULL,
  `EstudiosAdicionales` varchar(255) DEFAULT NULL,
  `FechaUltimaLlamada` date DEFAULT NULL,
  `NumeroFijo` varchar(20) DEFAULT NULL,
  `Genero` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `OtroTelefonoContacto` varchar(20) DEFAULT NULL,
  `ProgramaFormacionSENAID` int(11) DEFAULT NULL,
  `FechaRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_sofia`
--

CREATE TABLE `info_sofia` (
  `Ficha` int(11) DEFAULT NULL,
  `DenominacionPrograma` varchar(255) DEFAULT NULL,
  `ConvenioMediaTecnica` varchar(3) DEFAULT NULL,
  `EntidadCertifica` varchar(255) DEFAULT NULL,
  `RegistroAcademico` varchar(20) DEFAULT NULL,
  `FechaCertificacion` date DEFAULT NULL,
  `EstadoCertificado` varchar(255) DEFAULT NULL,
  `TipoDocumento` varchar(10) DEFAULT NULL,
  `NumeroDocumento` varchar(20) DEFAULT NULL,
  `NombreAprendiz` varchar(255) DEFAULT NULL,
  `LugarResidencia` varchar(255) DEFAULT NULL,
  `CorreoElectronico` varchar(255) DEFAULT NULL,
  `TelPrincipal` varchar(20) DEFAULT NULL,
  `TelAlterno` varchar(20) DEFAULT NULL,
  `TelCelular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `info_sofia`
--

INSERT INTO `info_sofia` (`Ficha`, `DenominacionPrograma`, `ConvenioMediaTecnica`, `EntidadCertifica`, `RegistroAcademico`, `FechaCertificacion`, `EstadoCertificado`, `TipoDocumento`, `NumeroDocumento`, `NombreAprendiz`, `LugarResidencia`, `CorreoElectronico`, `TelPrincipal`, `TelAlterno`, `TelCelular`) VALUES
(1907299, 'DESARROLLO Y ADAPTACIÓN DE PROTESIS Y ORTESIS', 'NO', 'SENA', '61814000', '2023-09-05', 'Certificado en SOFIA Plus', 'CC', '109878690', 'LUIS FERNANDO RODRIGUEZ BARRAGAN', 'BOGOTÁ', 'luiskennyvolcom@gmail.com', '577175551', NULL, '3208680822');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugarresidencia`
--

CREATE TABLE `lugarresidencia` (
  `id` int(11) NOT NULL,
  `Ciudad` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lugarresidencia`
--

INSERT INTO `lugarresidencia` (`id`, `Ciudad`) VALUES
(1, 'Bogotá'),
(2, 'Medellín'),
(3, 'Cali'),
(4, 'Barranquilla'),
(5, 'Cartagena'),
(6, 'Bucaramanga'),
(7, 'Pereira'),
(8, 'Manizales'),
(9, 'Santa Marta'),
(10, 'Villavicencio'),
(11, 'Cúcuta'),
(12, 'Ibagué'),
(13, 'Pasto'),
(14, 'Neiva'),
(15, 'Valledupar'),
(16, 'Montería'),
(17, 'Popayán'),
(18, 'Armenia'),
(19, 'Tunja'),
(20, 'Sincelejo'),
(21, 'Palmira'),
(22, 'Buenaventura'),
(23, 'Soacha'),
(24, 'Itagüí'),
(25, 'Florencia'),
(26, 'Girardot'),
(27, 'Zipaquirá'),
(28, 'Rionegro'),
(29, 'Envigado'),
(30, 'Fusagasugá'),
(31, 'Tuluá'),
(32, 'Buga'),
(33, 'Tumaco'),
(34, 'Soledad'),
(35, 'Malambo'),
(36, 'Floridablanca'),
(37, 'Palmira'),
(38, 'Montería'),
(39, 'Santa Marta'),
(40, 'Valledupar'),
(41, 'Giron'),
(42, 'Caucasia'),
(43, 'Chía'),
(44, 'Pitalito'),
(45, 'La Dorada'),
(46, 'Turbo'),
(47, 'Magangué'),
(48, 'Quibdó'),
(49, 'Riohacha'),
(50, 'Ipiales'),
(51, 'Yopal'),
(52, 'Maicao'),
(53, 'Arauca'),
(54, 'Quindío (Departamento)'),
(55, 'Guaviare (Departamento)'),
(56, 'Guainía (Departamento)'),
(57, 'Vaupés (Departamento)'),
(58, 'Amazonas (Departamento)'),
(59, 'Vichada (Departamento)'),
(60, 'Guajira (Departamento)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaformacionsena`
--

CREATE TABLE `programaformacionsena` (
  `id` int(11) NOT NULL,
  `NombrePrograma` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programaformacionsena`
--

INSERT INTO `programaformacionsena` (`id`, `NombrePrograma`) VALUES
(1, 'Tecnología en Diseño de Productos Industriales'),
(2, 'Tecnología en Desarrollo Creativo de Productos para la Industria'),
(3, 'Tecnología en Diseño de Sistemas Mecánicos'),
(4, 'Tecnología en Diseño de Moldes para transformación de Plásticos'),
(5, 'Tecnología en Diseño de Troqueles'),
(6, 'Tecnología Diseño e Integración de Automatismos Mecatrónicos'),
(7, 'Tecnología  Análisis y Desarrollo de Sistemas de Información - Ahora - Tecnología  Análisis y Desarrollo de Software'),
(8, 'Tecnología  en Desarrollo y Adaptación de Prótesis y Ortesis'),
(9, 'Tecnología en Aseguramiento Metrológico Industrial'),
(10, 'Técnico en Sistemas'),
(11, 'Técnico en Programación de Software'),
(12, 'Técnico en Mantenimiento de Automatismos Industriales'),
(13, 'Técnico en Dibujo Mecánico'),
(14, 'Técnico en Control de la Seguridad Digital'),
(15, 'Técnico en Modelado Digital de Productos para la Industria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `Id_usuario` int(11) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Clave` varchar(255) DEFAULT NULL,
  `Rol` enum('Administrador','Instructor','Encargado') NOT NULL,
  `Especialidad` varchar(100) DEFAULT NULL,
  `Estado_Usuario` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`Id_usuario`, `Nombres`, `Apellidos`, `Correo`, `Clave`, `Rol`, `Especialidad`, `Estado_Usuario`) VALUES
(1, 'ALVARO', 'BUSTOS JEREZ', 'abustosj@sena.edu.co', '4720', 'Instructor', NULL, 1),
(2, 'CARLOS ANDRES', 'INFANTE NIÑO', 'cinfante@sena.edu.co', '8877', 'Instructor', NULL, 1),
(3, 'DEIVYS GUILLERMO', 'MORALES URIBE', 'dmorales@sena.edu.co', '3652', 'Instructor', NULL, 1),
(4, 'EDGAR AURELIO', 'GELVES ALBARRACIN', 'egelvesa@sena.edu.co', '2017', 'Administrador', NULL, 1),
(5, 'EDGAR', 'MORALES CORTES', 'emoralesc@sena.edu.co', '1901', 'Administrador', NULL, 1),
(6, 'EDGAR', 'RAMOS PERILLA', 'edramosp@sena.edu.co', '9064', 'Instructor', NULL, 1),
(7, 'FRAN EDWARD', 'PEREZ ORTIZ', 'frperezo@sena.edu.co', '7670', 'Instructor', NULL, 1),
(8, 'GABRIEL RAMIRO', 'DELGADO CAVIATIVA', 'delgadoc@sena.edu.co', '8406', 'Instructor', NULL, 1),
(9, 'GLORIA STELLA', 'MORA GUTIERREZ', 'gmora@sena.edu.co', '7153', 'Instructor', NULL, 1),
(10, 'HUGO ALEXANDER', 'MEDINA ULLOA', 'hmedinau@sena.edu.co', '3346', 'Instructor', NULL, 1),
(11, 'IVAN', 'MARTINEZ MORA', 'imartinezm@sena.edu.co', '1399', 'Instructor', NULL, 1),
(12, 'IVAN RAMIRO', 'RODRIGUEZ CAMACHO', 'irrodriguez@sena.edu.co', '2758', 'Instructor', NULL, 1),
(13, 'JHON JAIRO', 'RODRIGUEZ TORRES', 'jjrodriguezt@sena.edu.co', '8950', 'Instructor', NULL, 1),
(14, 'JOSÉ MANUEL', 'PERILLA', 'jperillar@sena.edu.co', '9192', 'Instructor', NULL, 1),
(15, 'JULIAN CAMILO', 'CELIS FISCAL', 'jccelis@sena.edu.co', '3165', 'Instructor', NULL, 1),
(16, 'JULIO GREGORIO', 'BLANCO BELTRAN', 'jublancob@sena.edu.co', '9505', 'Instructor', NULL, 1),
(17, 'LINA MARCELA', 'FLOREZ BOTERO', 'lflorezb@sena.edu.co', '2958', 'Instructor', NULL, 1),
(18, 'LUIS ANTONIO', 'MORENO', 'lamorenom@sena.edu.co', '8078', 'Instructor', NULL, 1),
(19, 'LUIS HERNANDO', 'PRIETO OLIVARES', 'lhprieto@sena.edu.co', '1659', 'Instructor', NULL, 1),
(20, 'MARIA CAROLINA', 'MARTINEZ REYES', 'mcmartinezr@sena.edu.co', '6440', 'Instructor', NULL, 1),
(21, 'MIGUEL ANTONIO', 'MORALES HIGUERA', 'mamoralesh@sena.edu.co', '5994', 'Instructor', NULL, 1),
(22, 'NANCY CONSTANZA', 'ROMERO', 'ncromero@sena.edu.co', '4048', 'Instructor', NULL, 1),
(23, 'NELSON IGNACIO', 'CORREA DIAZ', 'ncorread@sena.edu.co', '7616', 'Instructor', NULL, 1),
(24, 'ORLANDO IGNACIO', 'MORALES MORALES', 'oimoralesm@sena.edu.co', '5668', 'Instructor', NULL, 1),
(25, 'OSCAR RICARDO', 'RIVEROS AGUIRRE', 'oriverosa@sena.edu.co', '3723', 'Instructor', NULL, 1),
(26, 'OSWALDO ENRIQUE', 'VERGARA PEREZ', 'oevergarap@sena.edu.co', '4633', 'Instructor', NULL, 1),
(27, 'PEDRO ELADIO', 'GARCIA BENAVIDES', 'pegarcia@sena.edu.co', '9103', 'Instructor', NULL, 1),
(28, 'SANDRA VIANEY', 'VEGA VEGA', 'svegav@sena.edu.co', '9288', 'Instructor', NULL, 1),
(29, 'SANDRA YANNETH', 'RODRIGUEZ RODRIGUEZ', 'syrodriguezr@sena.edu.co', '9096', 'Instructor', NULL, 1),
(30, 'SAÚL', 'SANTAMARÍA GUTIÉRREZ', 'ssantamariag@sena.edu.co', '9196', 'Instructor', NULL, 1),
(31, 'WILLIAM DAVID', 'VARGAS', 'wvargasp@sena.edu.co', '3569', 'Instructor', NULL, 1),
(35, 'ALEX ALBERTO', 'ALZATE JAIMES', 'aalzatej@sena.edu.co', '8702', 'Instructor', NULL, 1),
(36, 'AMILCAR', 'PALACIO MOSQUERA', 'apalacios@sena.edu.co', '9462', 'Instructor', NULL, 1),
(37, 'ANDRÉS EDUARDO', 'CHÁVEZ GUARDO', 'aechavez@sena.edu.co', '2000', 'Instructor', NULL, 1),
(38, 'ANGÉLICA MARÍA', 'TRIANA GUARNIZO', 'atrianag@sena.edu.co', '1598', 'Instructor', NULL, 1),
(39, 'ASTRID', 'SEGURA', 'astrid.segura@sena.edu.co', '4092', 'Instructor', NULL, 1),
(40, 'BLANCA ESTRELLA', 'MENDIETA BAUTISTA', 'blmendietaes@sena.edu.co', '5052', 'Instructor', NULL, 1),
(41, 'CARLOS ANDRES', 'ECHE LOPEZ', 'cechel@sena.edu.co', '8617', 'Instructor', NULL, 1),
(42, 'CARLOS HUMBERTO', 'OLIVELLA ZULETA', 'cholivella@sena.edu.co', '3244', 'Instructor', NULL, 1),
(43, 'CAROLINA', 'MENDOZA VIVAS', 'cmendozav@sena.edu.co', '6210', 'Instructor', NULL, 1),
(44, 'CESAR AUGUSTO', 'PEÑA MATEUS', 'capena@sena.edu.co', '4542', 'Instructor', NULL, 1),
(45, 'CESAR AUGUSTO', 'SUAREZ BUITRAGO', 'casuarezb@sena.edu.co', '3574', 'Instructor', NULL, 1),
(46, 'CLAUDIA', 'CLAUDIA BELTRAN RODRIGUEZ', 'clbeltran@sena.edu.co', '9094', 'Instructor', NULL, 1),
(47, 'CLAUDIA CATHERINE', 'GARZÓN ORJUELA', 'ccgarzon@sena.edu.co', '5799', 'Instructor', NULL, 1),
(48, 'DANIEL ALFONSO', 'ORJUELA DIAZ', 'dorjuela@sena.edu.co', '1469', 'Instructor', NULL, 1),
(49, 'DEIVID ENRIQUE', 'TRIVIÑO', 'dtrivinolo@sena.edu.co', '6052', 'Instructor', NULL, 1),
(50, 'DIANA ROCIO', 'DELGADO QUINTERO', 'drdelgado@sena.edu.co', '6243', 'Instructor', NULL, 1),
(51, 'DOMINIQUE DIDYME', 'DOME FUENTES', 'dddome@sena.edu.co', '7115', 'Instructor', NULL, 1),
(52, 'EDWIN ALEXANDER', 'DURAN GARCIA', 'eaduran@sena.edu.co', '1011', 'Instructor', NULL, 1),
(53, 'FABIAN RICARDO', 'MESTRE SOCARRAS', 'frmestre@sena.edu.co', '6697', 'Instructor', NULL, 1),
(54, 'FABIO HERNAN', 'ESPEJO COBOS', 'fespejoc@sena.edu.co', '2587', 'Instructor', NULL, 1),
(55, 'FERNANDO ANDRES', 'SALGUERO CRUZ', 'fsalgueroc@sena.edu.co', '4888', 'Instructor', NULL, 1),
(56, 'FERNELLY', 'ROJAS CHIA', 'frojasch@sena.edu.co', '5825', 'Instructor', NULL, 1),
(57, 'GEORGE ANTONY', 'SUARIQUE ARENAS', 'gasuarique@sena.edu.co', '3878', 'Instructor', NULL, 1),
(58, 'GERMAN DARIO', 'ROJAS FRANCO', 'grojas@sena.edu.co', '5966', 'Instructor', NULL, 1),
(59, 'GIOVANNI ESTEBAN', 'OSPINA ROJAS', 'geospinar@sena.edu.co', '6865', 'Instructor', NULL, 1),
(60, 'GUILLERMO', 'SANCHEZ ISAZA', 'gsanchezis@sena.edu.co', '9160', 'Instructor', NULL, 1),
(61, 'ISAI ANDRES', 'DOCTOR', 'itorresd@sena.edu.co', '5283', 'Instructor', NULL, 1),
(62, 'JAIME', 'MOGOLLON RODRIGUEZ', 'jamogollon@sena.edu.co', '4057', 'Instructor', NULL, 1),
(63, 'JAIME ALEJANDRO', 'GAMBA REYES', 'jagamba@sena.edu.co', '7641', 'Instructor', NULL, 1),
(64, 'JAIME HERNANDO', 'TORRES VASQUEZ', 'jtorresva@sena.edu.co', '3878', 'Instructor', NULL, 1),
(65, 'JAIRO ALBERTO', 'ROMERO GUTIERREZ', 'jromerog@sena.edu.co', '6286', 'Instructor', NULL, 1),
(66, 'JANNEZ MILSON', 'URREGO', 'jurregoq@sena.edu.co', '2210', 'Instructor', NULL, 1),
(67, 'JAVIER LEONARDO', 'CHAPARRO PESCA', 'jchaparrop@sena.edu.co', '7411', 'Instructor', NULL, 1),
(68, 'JAVIER ORLANDO', 'RODRIGUEZ RODRIGUEZ', 'javrodriguez@sena.edu.co', '1515', 'Instructor', NULL, 1),
(69, 'JESÚS ANTONIO', 'MORENO HERRERA', 'jmorenoh@sena.edu.co', '2384', 'Instructor', NULL, 1),
(70, 'JHON ALBERTO', 'ALTAMAR RENDON', 'jaaltamar@sena.edu.co', '4827', 'Instructor', NULL, 1),
(71, 'JOHN HAROLD', 'PEREZ CALDERON', 'jharoldperez@sena.edu.co', '7017', 'Instructor', NULL, 1),
(72, 'JOHN JAIME', 'RUIZ GUZMAN', 'jjruizg@sena.edu.co', '9735', 'Instructor', NULL, 1),
(73, 'JORGE LUIS', 'URIBE PARRA', 'joluribep@sena.edu.co', '1725', 'Instructor', NULL, 1),
(74, 'JOSE ANDRES', 'ZAMBRANO DIAZ', 'jazambrano@sena.edu.co', '3844', 'Instructor', NULL, 1),
(75, 'JOSE MIGUEL', 'GOMEZ HURTADO', 'jmgomezh@sena.edu.co', '3126', 'Instructor', NULL, 1),
(76, 'JUAN CARLOS', 'HERNÁNDEZ PRIETO', 'jchernandezp@sena.edu.co', '1651', 'Instructor', NULL, 1),
(77, 'JUAN JOSÉ', 'BOTELLO CASTELLANOS', 'jbotelloc@sena.edu.co', '2850', 'Instructor', NULL, 1),
(78, 'JULIO ROBERTO', 'GALVIS CARDOZO', 'jgalvisc@sena.edu.co', '3527', 'Instructor', NULL, 1),
(79, 'LEIDY MARCELA', 'MANRIQUE OBREGON', 'lmmanriqueo@sena.edu.co', '9833', 'Instructor', NULL, 1),
(80, 'LEONARDO', 'LASTRA SALGUERO', 'llastras@sena.edu.co', '5971', 'Instructor', NULL, 1),
(81, 'LIBARDO', 'GÓMEZ DÍAZ', 'lgomezd@sena.edu.co', '8851', 'Instructor', NULL, 1),
(82, 'LUIS ENRIQUE', 'ARIAS CHAVARRO', 'learias@sena.edu.co', '2807', 'Instructor', NULL, 1),
(83, 'LUIS FELIPE', 'RESTREPO  ARGUELLO', 'lfrestrepo@sena.edu.co', '9578', 'Instructor', NULL, 1),
(84, 'LUIS GABRIEL', 'NOREÑA TRIGOS', 'lgnorena@sena.edu.co', '4291', 'Instructor', NULL, 1),
(85, 'LUISA FERNANDA', 'ROSAS CARDENAS', 'lfrosas@sena.edu.co', '2863', 'Instructor', NULL, 1),
(86, 'LUZ MIRIAM', 'GARCIA QUIVANO', 'lmgarciaq@sena.edu.co', '8308', 'Instructor', NULL, 1),
(87, 'LYDA PATRICIA', 'CAICEDO MONROY', 'lpcaicedo@sena.edu.co', '5420', 'Instructor', NULL, 1),
(88, 'MAURICIO ANDRES', 'UMBARILA FIGUEROA', 'mumbarilaf@sena.edu.co', '2207', 'Instructor', NULL, 1),
(89, 'MILCON', 'MONTENEGRO GAMBA', 'mmontenegrog@sena.edu.co', '2819', 'Instructor', NULL, 1),
(90, 'NESTOR GUILLERMO', 'MONTAÑO GOMEZ', 'ngmontano@sena.edu.co', '9418', 'Instructor', NULL, 1),
(91, 'OMAR OSWALDO', 'ZAMBRANO AREVALO', 'oozambrano@sena.edu.co', '7790', 'Instructor', NULL, 1),
(92, 'OSCAR HELI', 'BEJARANO', 'obejarano@sena.edu.co', '7119', 'Instructor', NULL, 1),
(93, 'RAMON EMILIO', 'GONZALEZ RODRIGUEZ', 'regonzalezr@sena.edu.co', '9380', 'Instructor', NULL, 1),
(94, 'ROBINSON LEONARDO', 'PIMIENTO', 'rpimiento@sena.edu.co', '2866', 'Instructor', NULL, 1),
(95, 'SANDRA AYDEE', 'LOPEZ CONTOR', 'slopezc@sena.edu.co', '1887', 'Instructor', NULL, 1),
(96, 'VICTOR DANIEL', 'LOPEZ MUÑOZ', 'vdlpez@sena.edu.co', '2298', 'Instructor', NULL, 1),
(97, 'VICTOR JULIO', 'RODRIGUEZ PRADA', 'vrodriguezp@sena.edu.co', '1419', 'Instructor', NULL, 1),
(98, 'WASHINGTON', 'NIETO ARCE', 'wnieto@sena.edu.co', '6091', 'Instructor', NULL, 1),
(99, 'WILLIAM', 'MAYORGA GARZON', 'wmayorgag@sena.edu.co', '4862', 'Instructor', NULL, 1),
(100, 'YUDI', 'TIMANA CELIS', 'ytimanace@sena.edu.co', '6930', 'Instructor', NULL, 1),
(101, 'YULIETH FERNANDA', 'GUTIÉRREZ LEÓN', 'yfgutierrez@sena.edu.co', '8278', 'Instructor', NULL, 1),
(102, 'ALFONSO', 'VARGAS', NULL, '1799', 'Instructor', NULL, 1),
(103, 'JUAN DAVID', 'VASQUEZ VILLALBA', NULL, '6432', 'Instructor', NULL, 1),
(104, 'William', 'Saavedra', 'william_saavedra@yahoo.com', '9901', 'Administrador', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `egresados`
--
ALTER TABLE `egresados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ProgramaFormacionSENAID` (`ProgramaFormacionSENAID`),
  ADD KEY `LugarResidenciaID` (`LugarResidenciaID`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugarresidencia`
--
ALTER TABLE `lugarresidencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programaformacionsena`
--
ALTER TABLE `programaformacionsena`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `egresados`
--
ALTER TABLE `egresados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugarresidencia`
--
ALTER TABLE `lugarresidencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `programaformacionsena`
--
ALTER TABLE `programaformacionsena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `egresados`
--
ALTER TABLE `egresados`
  ADD CONSTRAINT `egresados_ibfk_1` FOREIGN KEY (`ProgramaFormacionSENAID`) REFERENCES `programaformacionsena` (`id`),
  ADD CONSTRAINT `egresados_ibfk_4` FOREIGN KEY (`LugarResidenciaID`) REFERENCES `lugarresidencia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
