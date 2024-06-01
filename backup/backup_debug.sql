
-- Database Backup --
-- Ver. : 1.0.1
-- Host : 127.0.0.1
-- Generating Time : Jun 01, 2024 at 01:01:09:AM



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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO usuarios VALUES
("23","123456","Admin","admin@gmail.com","$2y$10$oDNuA25uDZixJNrrJKg/d.0F7ES/vqZtQU3ell6A2tpWdVv9hO8Q2","Mayorista","1",NULL,NULL,"ACTIVO"),
("26","9516975","Nicolasitooo","avellaprietonicolas@gmail.com","$2y$10$bBLGZ.v8IF59mXyuB59WhuagjF2iF6NmjkWb.EBBj3VqzdJdf9Eqm","Minorista","2",NULL,NULL,"INACTIVO"),
("27","123456789","Juan Peerecito","juan@example.com","","Minorista","2",NULL,NULL,"INACTIVO"),
("29","1002740932","Nicolas Avella","nicoandresavella09@gmail.com","$2y$10$yROEUMs0VMtraMolrIM9IuA5pwPlFGMxS4ooeuax1TRw9mIAWepg.","Minorista","2","126b31d9992aadb3192f795f607746d2","1715460321","INACTIVO"),
("35","4638556","Pepe","pepe@gmail.com","pepe2040","Mayorista","2",NULL,NULL,"INACTIVO"),
("38","333","Juliana Ariza","juliz.fut1712@gmail.com","$2y$10$S0hwg/mpO2YiRVGi0b42F.fLspeymaEnV4/NwBl/eoniBpP7Yh0KW","Mayorista","2","e7756429c4205eda5a8919acadce290b","1713653953","ACTIVO"),
("39","666","nose","666@gmail.com","$2y$10$upFf7v4eZkPLJkCrhK/kaOBnN4PDZh15TqR1DBQDnOUSAbmD0cqre","Mayorista","2",NULL,NULL,"ACTIVO"),
("45","5616516","Francisco Paipilla","fran2024@gmail.com","$2y$10$lZwHRdQa0.jYw7epcNUWn.0O8S7uS6JTDEkBGENprsTdzvAqVudTS","Minorista","2",NULL,NULL,"ACTIVO"),
("46","6222306","Diana Prieto","dian258@gmail.com","$2y$10$UWgtXYkxdwihZnYdCDfeHuB8qq8QPhxPjN.Ecfc9q4iJ2hVk3/p6u","Minorista","2",NULL,NULL,"ACTIVO"),
("47","56987412","Pedro Pascal","pascal@hotmail.com","$2y$10$S/lXG/RHQhYTcwxHwC6JMeL6yns1lOrJugssUpuMIjwmS5tjxSvU.","Minorista","2",NULL,NULL,"ACTIVO"),
("48","3000000","Robert Downey","ironman@gmail.com","$2y$10$UT1g.MBj2ljfN0yGSnz0XOaq.tfIVLbsLivTsjl86o58d6Rd6eGX.","Minorista","2",NULL,NULL,"ACTIVO"),
("49","564123654","Marcela","almamarcela@hotmail.com","$2y$10$y8BU1bPDLrEmvPcj.7uvsOiTZpmdxsn11622pQVnRa.pHXxI/J6By","Mayorista","2",NULL,NULL,"ACTIVO"),
("50","54698713","Juliana","julijuli@gmail.com","$2y$10$NwGgplcrJaboVzdgwi49wOUCU1c573QxfiK9QNI3P6wiuBA0vaY2i","Minorista","2",NULL,NULL,"ACTIVO");




CREATE TABLE `cargos` (
  `id_cargo` int NOT NULL,
  `nombre_cargo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO cargos VALUES
("1","Administrador"),
("2","Usuario");




CREATE TABLE `proveedores` (
  `Id_proveedor` int NOT NULL AUTO_INCREMENT,
  `Nombre_proveedor` varchar(255) NOT NULL,
  `Telefono_proveedor` bigint DEFAULT NULL,
  `Estado` varchar(20) DEFAULT 'ACTIVO',
  PRIMARY KEY (`Id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO proveedores VALUES
("33","Ale Morale","3259874561","ACTIVO"),
("35","Juan","3285963214","ACTIVO"),
("36","Camilo","3204561238","ACTIVO"),
("37","Daniel","365655614561","ACTIVO"),
("38","Vale","656316161","ACTIVO"),
("42","Hollman","316451123102","ACTIVO"),
("44","Nicki Nicole","3147895621","ACTIVO");




CREATE TABLE `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(40) NOT NULL,
  `precio_producto` decimal(10,0) DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  `Stock` int NOT NULL,
  `categoria_producto` enum('EXTRA','PRIMERA','SEGUNDA','RICHE') DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO productos VALUES
("1","FRESA","60000","../../../FRESAS_ARTURO/model/uploads/FRESA_EXTRA665a258f2aa83.jpeg","27","EXTRA"),
("2","FRESA","40000","../../../FRESAS_ARTURO/model/uploads/FRESA_PRIMERA665a71d1786ad.jpeg","10","PRIMERA"),
("3","FRESA","30000","../../../FRESAS_ARTURO/model/uploads/FRESA_SEGUNDA.jpeg","29","SEGUNDA"),
("4","FRESA","20000","../../../FRESAS_ARTURO/model/uploads/FRESA_RICHE.jpeg","29","RICHE");




CREATE TABLE `recursos` (
  `Id_Recursos` int NOT NULL AUTO_INCREMENT,
  `Tipo` enum('Abono','Fertilizantes','Pesticidas') NOT NULL,
  `Stock` int NOT NULL,
  `Id_proveedor` int DEFAULT NULL,
  PRIMARY KEY (`Id_Recursos`),
  KEY `fk_proveedor_recursos` (`Id_proveedor`),
  CONSTRAINT `fk_proveedor` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`),
  CONSTRAINT `fk_proveedor_recursos` FOREIGN KEY (`Id_proveedor`) REFERENCES `proveedores` (`Id_proveedor`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO recursos VALUES
("15","Abono","30","33"),
("17","Fertilizantes","25","35"),
("18","Fertilizantes","25","36"),
("19","Pesticidas","25","37"),
("20","Abono","25","38"),
("24","Fertilizantes","15","42"),
("26","Abono","40","44");




CREATE TABLE `ventas` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `estado` varchar(10) DEFAULT 'activo',
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`Id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO ventas VALUES
("3","2024-05-26 19:35:16","29","260000","activo"),
("4","2024-05-26 20:52:19","29","225000","activo"),
("5","2024-05-28 14:54:19","29","550000","activo"),
("8","2024-05-29 19:41:58","29","120000","activo"),
("9","2024-05-29 19:43:20","29","75000","activo"),
("10","2024-05-30 17:30:22","29","90000","activo"),
("12","2024-05-31 09:24:09","38","120000","activo"),
("13","2024-05-31 15:05:34","38","400000","activo"),
("14","2024-05-31 16:31:34","38","140000","activo");




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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO insumos VALUES
("15","33","15","Abono","Vitamina Feliz","55000.00","2024-03-14 20:52:51"),
("17","35","17","Fertilizantes","Estiercol","125000.00","2024-04-01 11:23:28"),
("18","36","18","Fertilizantes","Corela H2","256000.00","2024-04-04 08:12:48"),
("19","37","19","Pesticidas","Anti marmotas","85000.00","2024-04-04 11:38:05"),
("20","38","20","Abono","Composta FELIZ","250000.00","2024-04-05 15:38:18"),
("25","44","26","Abono","Enzimas ","125000.00","2024-05-27 21:42:19");




CREATE TABLE `lotes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad_extra` int DEFAULT NULL,
  `cantidad_primera` int DEFAULT NULL,
  `cantidad_segunda` int DEFAULT NULL,
  `cantidad_riche` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO lotes VALUES
("3","2024-05-12 00:00:00","20","20","20","20"),
("6","2024-05-14 15:05:05","40","30","50","35"),
("7","2024-05-26 15:59:19","1","4","5","2"),
("11","2024-05-26 17:01:10","4","9","6","5"),
("12","2024-05-29 19:41:17","9","10","10","10"),
("13","2024-05-31 15:03:55","10","10","10","10"),
("14","2024-05-31 16:28:32","5","10","10","10");




CREATE TABLE `perdidas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cosecha` int NOT NULL,
  `categoria_fresa` enum('extra','primera','segunda','riche') NOT NULL,
  `cantidad_perdida` int NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_cosecha` (`id_cosecha`),
  CONSTRAINT `perdidas_ibfk_1` FOREIGN KEY (`id_cosecha`) REFERENCES `lotes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO perdidas VALUES
("1","6","extra","40","2024-05-26 15:30:14"),
("2","6","primera","100","2024-05-26 15:35:41"),
("3","6","segunda","150","2024-05-26 15:41:58"),
("4","6","riche","40","2024-05-26 15:48:43"),
("5","6","primera","10","2024-05-26 15:58:11"),
("6","6","primera","10","2024-05-26 15:58:27"),
("7","7","extra","1","2024-05-26 16:00:59"),
("8","7","primera","1","2024-05-26 16:01:23"),
("9","7","extra","2","2024-05-26 16:01:55"),
("17","11","extra","5","2024-05-26 17:03:20"),
("18","11","segunda","5","2024-05-26 17:03:57"),
("19","11","riche","5","2024-05-27 20:36:41"),
("20","11","extra","6","2024-05-28 14:33:19"),
("21","11","segunda","4","2024-05-28 14:51:06"),
("22","11","riche","5","2024-05-28 14:59:16"),
("23","11","primera","4","2024-05-28 14:59:47"),
("24","11","primera","2","2024-05-29 10:46:05"),
("25","12","primera","10","2024-05-31 07:53:35"),
("26","7","extra","1","2024-05-31 08:26:39"),
("27","12","extra","1","2024-05-31 08:32:19"),
("28","14","extra","5","2024-05-31 16:39:12");




CREATE TABLE `detalle_venta` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_factura` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_factura` (`id_factura`),
  CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `ventas` (`id_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO detalle_venta VALUES
("5","3","2","2","45000","90000"),
("8","4","2","5","45000","225000"),
("9","5","1","10","55000","550000"),
("12","8","3","2","30000","60000"),
("13","8","4","3","20000","60000"),
("14","9","2","1","45000","45000"),
("15","9","3","1","30000","30000"),
("16","10","2","2","45000","90000"),
("18","12","3","4","30000","120000"),
("19","13","2","10","40000","400000"),
("20","14","3","2","30000","60000"),
("21","14","4","4","20000","80000");




CREATE TABLE `historial_precios` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `precio_anterior` decimal(10,2) DEFAULT NULL,
  `precio_nuevo` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historial`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `historial_precios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO historial_precios VALUES
("1","1","85000.00","95000.00","2024-03-04 10:14:52"),
("2","2","50000.00","60000.00","2024-03-04 10:22:03"),
("3","1","95000.00","85000.00","2024-03-04 23:11:17"),
("4","4","25000.00","30000.00","2024-03-05 12:48:11"),
("5","1","85000.00","95000.00","2024-03-07 14:29:39"),
("6","1","95000.00","105000.00","2024-03-13 10:47:21"),
("7","1","105000.00","115000.00","2024-03-14 15:34:46"),
("8","4","30000.00","40000.00","2024-03-29 23:35:15"),
("9","1","115000.00","12000.00","2024-04-02 07:30:27"),
("10","1","12000.00","120000.00","2024-04-02 07:30:51"),
("11","3","30000.00","45000.00","2024-04-04 07:33:57"),
("12","1","120000.00","130000.00","2024-04-04 11:37:23"),
("13","1","130000.00","6000.00","2024-04-09 13:36:30"),
("14","1","6000.00","50000.00","2024-04-09 13:37:30"),
("15","2","60000.00","40000.00","2024-04-09 13:37:42"),
("16","3","45000.00","33000.00","2024-04-09 13:37:49"),
("17","4","40000.00","25000.00","2024-04-09 13:37:57"),
("18","2","45000.00","50000.00","2024-05-31 10:19:10"),
("19","2","50000.00","45000.00","2024-05-31 10:24:39");


