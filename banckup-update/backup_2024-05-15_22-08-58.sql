-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: fresas
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id_cargo` int NOT NULL,
  `nombre_cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleventa`
--

DROP TABLE IF EXISTS `detalleventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleventa` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `cantidad_productos` int NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleventa`
--

LOCK TABLES `detalleventa` WRITE;
/*!40000 ALTER TABLE `detalleventa` DISABLE KEYS */;
INSERT INTO `detalleventa` VALUES (65,'Nicolas Avella','3102252858',2,20000000.00,'2024-04-17 23:05:04'),(66,'Nicolas Avella','3103654156',2,1000000.00,'2024-04-17 23:25:11'),(67,'Nicolas Avella','3102252858',1,25000.00,'2024-04-17 23:38:13'),(68,'Nicolas Avella','3102252858',1,660000.00,'2024-04-17 23:39:08'),(69,'Nicolas Avella','3102252858',1,1140000.00,'2024-04-17 23:40:00'),(70,'Nicolas Avella','3102252858',1,500000.00,'2024-04-22 19:36:54'),(71,'Nicolas Avella','3102252858',1,66000.00,'2024-04-22 20:14:39'),(72,'Nicolas Avella','3102252858',1,50000.00,'2024-04-29 20:15:29'),(73,'Nicolas Avella','3102252858',1,25000.00,'2024-04-29 20:28:32'),(74,'Nicolas Avella','3102252858',2,83000.00,'2024-05-01 17:15:29'),(75,'Nicolas Avella','3102252858',1,25000.00,'2024-05-01 19:36:22');
/*!40000 ALTER TABLE `detalleventa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_precios`
--

DROP TABLE IF EXISTS `historial_precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_precios` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `precio_anterior` decimal(10,2) DEFAULT NULL,
  `precio_nuevo` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historial`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `historial_precios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_precios`
--

LOCK TABLES `historial_precios` WRITE;
/*!40000 ALTER TABLE `historial_precios` DISABLE KEYS */;
INSERT INTO `historial_precios` VALUES (1,1,85000.00,95000.00,'2024-03-04 15:14:52'),(2,2,50000.00,60000.00,'2024-03-04 15:22:03'),(3,1,95000.00,85000.00,'2024-03-05 04:11:17'),(4,4,25000.00,30000.00,'2024-03-05 17:48:11'),(5,1,85000.00,95000.00,'2024-03-07 19:29:39'),(6,1,95000.00,105000.00,'2024-03-13 15:47:21'),(7,1,105000.00,115000.00,'2024-03-14 20:34:46'),(8,4,30000.00,40000.00,'2024-03-30 04:35:15'),(9,1,115000.00,12000.00,'2024-04-02 12:30:27'),(10,1,12000.00,120000.00,'2024-04-02 12:30:51'),(11,3,30000.00,45000.00,'2024-04-04 12:33:57'),(12,1,120000.00,130000.00,'2024-04-04 16:37:23'),(13,1,130000.00,6000.00,'2024-04-09 18:36:30'),(14,1,6000.00,50000.00,'2024-04-09 18:37:30'),(15,2,60000.00,40000.00,'2024-04-09 18:37:42'),(16,3,45000.00,33000.00,'2024-04-09 18:37:49'),(17,4,40000.00,25000.00,'2024-04-09 18:37:57');
/*!40000 ALTER TABLE `historial_precios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insumos`
--

DROP TABLE IF EXISTS `insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insumos` (
  `Id_insumo` int NOT NULL AUTO_INCREMENT,
  `Id_proveedor` int DEFAULT NULL,
  `Id_recurso` int DEFAULT NULL,
  `Categoria` varchar(50) DEFAULT NULL,
  `Nombre_insumo` varchar(255) DEFAULT NULL,
  `Costo_producto` decimal(10,2) NOT NULL,
  `Fecha_ingreso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_insumo`),
  KEY `Id_recurso` (`Id_recurso`),
  KEY `fk_proveedor_insumos` (`Id_proveedor`),
  CONSTRAINT `fk_proveedor_insumos` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`) ON DELETE CASCADE,
  CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`),
  CONSTRAINT `insumos_ibfk_2` FOREIGN KEY (`Id_recurso`) REFERENCES `recursos` (`Id_Recursos`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insumos`
--

LOCK TABLES `insumos` WRITE;
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` VALUES (15,33,15,'Abono','Vitamina Feliz',55000.00,'2024-03-15 01:52:51'),(17,35,17,'Fertilizantes','Estiercol',125000.00,'2024-04-01 16:23:28'),(18,36,18,'Fertilizantes','Corela H2',256000.00,'2024-04-04 13:12:48'),(19,37,19,'Pesticidas','Anti marmotas',85000.00,'2024-04-04 16:38:05'),(20,38,20,'Abono','Composta FELIZ',250000.00,'2024-04-05 20:38:18');
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lotes` (
  `id_lote` int NOT NULL AUTO_INCREMENT,
  `fecha_recogida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_producto` int DEFAULT NULL,
  `cantidad_recogida_extra` int DEFAULT '0',
  `cantidad_recogida_primera` int DEFAULT '0',
  `cantidad_recogida_segunda` int DEFAULT '0',
  `cantidad_recogida_riche` int DEFAULT '0',
  PRIMARY KEY (`id_lote`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,'2024-04-14 15:26:41',1,10,0,0,0),(2,'2024-04-14 15:43:19',1,10,0,0,0),(3,'2024-04-14 15:43:19',2,0,10,0,0),(4,'2024-04-14 15:43:19',3,0,0,12,0),(5,'2024-04-14 15:43:19',4,0,0,0,20),(6,'2024-04-15 22:41:33',1,5,0,0,0),(7,'2024-04-15 22:41:33',2,0,5,0,0),(8,'2024-04-15 22:41:33',3,0,0,10,0),(9,'2024-04-15 22:41:33',4,0,0,0,5);
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `actualizar_stock_despues_insertar` AFTER INSERT ON `lotes` FOR EACH ROW BEGIN     UPDATE productos     SET stock = stock +         NEW.cantidad_recogida_extra +         NEW.cantidad_recogida_primera +         NEW.cantidad_recogida_segunda +         NEW.cantidad_recogida_riche     WHERE id_producto = NEW.id_producto; END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `categoria_producto` enum('Extra','Primera','Segunda','Riche') DEFAULT NULL,
  `precio_producto` decimal(10,0) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `Stock` int NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Fresas','Extra',55000,'../../../FRESAS_ARTURO/model/uploads/FRESA_EXTRA.jpeg',10),(2,'Fresas','Primera',45000,'../../../FRESAS_ARTURO/model/uploads/FRESA_PRIMERA.jpeg',10),(3,'Fresas','Segunda',30000,'../../../FRESAS_ARTURO/model/uploads/FRESA_SEGUNDA.jpeg',10),(4,'Fresas','Riche',20000,'../../../FRESAS_ARTURO/model/uploads/FRESA_RICHE.jpeg',10);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `Id_proveedor` int NOT NULL AUTO_INCREMENT,
  `Nombre_proveedor` varchar(255) NOT NULL,
  `Telefono_proveedor` bigint DEFAULT NULL,
  PRIMARY KEY (`Id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (33,'Ale Morales',3259874561),(35,'Juan',3285963214),(36,'Camilo',3204561238),(37,'Daniel',365655614561),(38,'Vale',656316161),(42,'Hollman',316451123102);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recursos`
--

DROP TABLE IF EXISTS `recursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recursos` (
  `Id_Recursos` int NOT NULL AUTO_INCREMENT,
  `Tipo` enum('Abono','Fertilizantes','Pesticidas') NOT NULL,
  `Stock` int NOT NULL,
  `Id_proveedor` int DEFAULT NULL,
  PRIMARY KEY (`Id_Recursos`),
  KEY `fk_proveedor_recursos` (`Id_proveedor`),
  CONSTRAINT `fk_proveedor` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`),
  CONSTRAINT `fk_proveedor_recursos` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recursos`
--

LOCK TABLES `recursos` WRITE;
/*!40000 ALTER TABLE `recursos` DISABLE KEYS */;
INSERT INTO `recursos` VALUES (15,'Abono',30,33),(17,'Fertilizantes',25,35),(18,'Fertilizantes',25,36),(19,'Pesticidas',25,37),(20,'Abono',25,38),(24,'Fertilizantes',15,42);
/*!40000 ALTER TABLE `recursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'Maria','user@gmail.com','9900258789','12345','2022-06-11 23:30:47',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `Id_cliente` int NOT NULL AUTO_INCREMENT,
  `Cedula` int NOT NULL,
  `Nombre` char(30) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `Rol` enum('Mayorista','Minorista') NOT NULL,
  `cargos` int DEFAULT '2',
  `token` varchar(60) DEFAULT NULL,
  `fecha_expiracion` varchar(10) DEFAULT NULL,
  `Estado` char(10) DEFAULT 'ACTIVO',
  PRIMARY KEY (`Id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (23,123456,'Admin','admin@gmail.com','$2y$10$oDNuA25uDZixJNrrJKg/d.0F7ES/vqZtQU3ell6A2tpWdVv9hO8Q2','Mayorista',1,NULL,NULL,'ACTIVO'),(26,9516975,'Nicolasitooo','avellaprietonicolas@gmail.com','$2y$10$bBLGZ.v8IF59mXyuB59WhuagjF2iF6NmjkWb.EBBj3VqzdJdf9Eqm','Minorista',2,NULL,NULL,'INACTIVO'),(27,123456789,'Juan Pérez','juan@example.com','$2y$10$2dqHbcIoc8erC6TnVmZ7UucOoPS0yJSJkYBzYzVpGedK8LuDasLCG','Minorista',2,NULL,NULL,'ACTIVO'),(29,1002740932,'Nicolas Avella','nicoandresavella09@gmail.com','$2y$10$yROEUMs0VMtraMolrIM9IuA5pwPlFGMxS4ooeuax1TRw9mIAWepg.','Mayorista',2,NULL,NULL,'ACTIVO'),(35,4638556,'Pepe','pepe@gmail.com','pepe2040','Mayorista',2,NULL,NULL,'ACTIVO'),(38,333,'Juliana Ariza','juliz.fut1712@gmail.com','$2y$10$S0hwg/mpO2YiRVGi0b42F.fLspeymaEnV4/NwBl/eoniBpP7Yh0KW','Mayorista',2,'e7756429c4205eda5a8919acadce290b','1713653953','ACTIVO'),(39,666,'nose','666@gmail.com','$2y$10$upFf7v4eZkPLJkCrhK/kaOBnN4PDZh15TqR1DBQDnOUSAbmD0cqre','Mayorista',2,NULL,NULL,'ACTIVO'),(45,5616516,'Francisco Paipilla','fran2024@gmail.com','$2y$10$lZwHRdQa0.jYw7epcNUWn.0O8S7uS6JTDEkBGENprsTdzvAqVudTS','Minorista',2,NULL,NULL,'ACTIVO'),(46,6222306,'Diana Prieto','dian258@gmail.com','$2y$10$UWgtXYkxdwihZnYdCDfeHuB8qq8QPhxPjN.Ecfc9q4iJ2hVk3/p6u','Minorista',2,NULL,NULL,'ACTIVO'),(47,56987412,'Pedro Pascal','pascal@hotmail.com','$2y$10$S/lXG/RHQhYTcwxHwC6JMeL6yns1lOrJugssUpuMIjwmS5tjxSvU.','Minorista',2,NULL,NULL,'ACTIVO'),(48,3000000,'Robert Downey','ironman@gmail.com','$2y$10$UT1g.MBj2ljfN0yGSnz0XOaq.tfIVLbsLivTsjl86o58d6Rd6eGX.','Minorista',2,NULL,NULL,'ACTIVO');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-15 17:08:58
