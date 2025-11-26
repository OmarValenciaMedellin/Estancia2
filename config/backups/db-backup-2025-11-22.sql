

DROP TABLE IF EXISTS `catalogo`;


CREATE TABLE `catalogo` (
  `id_Catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `id_Material` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_Catalogo`),
  KEY `id_Material` (`id_Material`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO catalogo VALUES("1","1","35.50");
INSERT INTO catalogo VALUES("2","2","250.00");
INSERT INTO catalogo VALUES("3","3","120.00");
INSERT INTO catalogo VALUES("4","4","5.75");
INSERT INTO catalogo VALUES("5","5","12.30");
INSERT INTO catalogo VALUES("6","6","1.50");





DROP TABLE IF EXISTS `cotizacion`;


CREATE TABLE `cotizacion` (
  `id_cotizacion` int(100) NOT NULL AUTO_INCREMENT,
  `id_Cliente` int(100) NOT NULL,
  `Fecha` date NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `Descuento` decimal(10,2) NOT NULL,
  `Mano_obra` decimal(10,2) NOT NULL,
  `Impuestos` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Notas` text NOT NULL,
  PRIMARY KEY (`id_cotizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cotizacion VALUES("5","28","0000-00-00","400.00","48.00","411.00","122.08","885.08","sadsadsa");
INSERT INTO cotizacion VALUES("6","7","0000-00-00","3000.00","420.00","700.00","524.80","3804.80","muy bien");
INSERT INTO cotizacion VALUES("7","3","0000-00-00","21902.00","2190.20","800.00","4102.36","24614.16","Perfecto");
INSERT INTO cotizacion VALUES("17","28","0000-00-00","5000.00","0.00","0.00","800.00","5800.00","");
INSERT INTO cotizacion VALUES("20","6","0000-00-00","1116.00","0.00","1000.00","338.56","2454.56","");
INSERT INTO cotizacion VALUES("21","15","0000-00-00","400.00","0.00","10000.00","1664.00","12064.00","");
INSERT INTO cotizacion VALUES("22","28","0000-00-00","200.00","0.00","100.00","48.00","348.00","");





DROP TABLE IF EXISTS `cotizacion_detalle`;


CREATE TABLE `cotizacion_detalle` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_cotizacion` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `ancho_cm` decimal(10,2) NOT NULL,
  `alto_cm` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_cotizacion` (`id_cotizacion`),
  KEY `id_material` (`id_material`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cotizacion_detalle VALUES("5","5","25","12.00","21.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("6","6","25","123.00","123.00","15","200.00","3000.00");
INSERT INTO cotizacion_detalle VALUES("7","7","17","45.00","12.00","47","466.00","21902.00");
INSERT INTO cotizacion_detalle VALUES("16","17","19","0.00","0.00","20","250.00","5000.00");
INSERT INTO cotizacion_detalle VALUES("19","20","25","100.00","150.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("20","20","19","120.00","200.00","1","250.00","250.00");
INSERT INTO cotizacion_detalle VALUES("21","20","17","200.00","140.00","1","466.00","466.00");
INSERT INTO cotizacion_detalle VALUES("22","21","16","100.00","150.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("23","22","25","100.00","200.00","1","200.00","200.00");





DROP TABLE IF EXISTS `inventario`;


CREATE TABLE `inventario` (
  `id_Inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_Material` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Inventario`),
  KEY `id_Material` (`id_Material`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO inventario VALUES("1","1","50");
INSERT INTO inventario VALUES("2","2","200");
INSERT INTO inventario VALUES("3","3","150");
INSERT INTO inventario VALUES("4","4","500");
INSERT INTO inventario VALUES("5","5","300");
INSERT INTO inventario VALUES("6","6","1000");





DROP TABLE IF EXISTS `registro_cliente`;


CREATE TABLE `registro_cliente` (
  `id_Cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_Cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO registro_cliente VALUES("1","Luis","Fernándeza","777891223","Luiza123@gmail.com");
INSERT INTO registro_cliente VALUES("2","Sofía","Martínez","7772345678","sofiama@mail.com");
INSERT INTO registro_cliente VALUES("3","David","Santos","7773456789","davids@mail.com");
INSERT INTO registro_cliente VALUES("4","Lucía","Ramírez","7774567890","luciar@mail.com");
INSERT INTO registro_cliente VALUES("5","gabriel","García","7775678906","gaby@mail.com");
INSERT INTO registro_cliente VALUES("6","Marta","Vargas","7776789012","martav@mail.com");
INSERT INTO registro_cliente VALUES("7","Omar","Valencia","7776175210","vamoo@1232");
INSERT INTO registro_cliente VALUES("15","Fatima","Lara","7776175210","glfo@gmail.com");
INSERT INTO registro_cliente VALUES("28","Fatima","Guzman","7776175210","glfo@gmail.com");





DROP TABLE IF EXISTS `registro_material`;


CREATE TABLE `registro_material` (
  `id_material` int(150) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `UnidadMedida` varchar(50) NOT NULL,
  `Costo` float NOT NULL,
  `Cantidad` int(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_material`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO registro_material VALUES("15","Silicon ","Silicona","Unidad","20","40","Silicon Blanco");
INSERT INTO registro_material VALUES("16","Tubo PVC","Perfil de aluminio","m²","200","13","Tubo PVC 13\" color blanco");
INSERT INTO registro_material VALUES("17","Vidrio templado..","Seleccionar categoría","Seleccionar unidad","466","90","                    Vidrio de seguridad templado incoloro de 6mm de espesor. Ideal para puertas, ven");
INSERT INTO registro_material VALUES("19","Perfil Galvanizado...","Seleccionar categoría","Seleccionar unidad","250","42","Resistente a la oxidación y el desgaste por impacto. Utilizado en exteriores.\n                     ");
INSERT INTO registro_material VALUES("25","hola","Seleccionar categoría","Seleccionar unidad","200","44","  sadsada            \n          \n                            \n          \n                ");





DROP TABLE IF EXISTS `vendedor`;


CREATE TABLE `vendedor` (
  `id_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Matricula` varchar(45) DEFAULT NULL,
  `Cargo` varchar(45) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO vendedor VALUES("1","juan","Pérez","MAT001","Vendedor","carlos.perez@bonanza.com","pass123");
INSERT INTO vendedor VALUES("2","Ana","Gómez","MAT002","Administrador","ana.gomez@bonanza.com","admin123");
INSERT INTO vendedor VALUES("3","Luis","Ruiz","MAT003","Técnico","luis.ruiz@bonanza.com","tec123");
INSERT INTO vendedor VALUES("4","María","López","MAT004","Vendedor","maria.lopez@bonanza.com","vta123");
INSERT INTO vendedor VALUES("5","Jorge","Ramírez","MAT005","Soporte","jorge.ramirez@bonanza.com","sup123");
INSERT INTO vendedor VALUES("6","Sofía","Hernández","MAT006","Vendedor","sofia.hernandez@bonanza.com","venta123");
INSERT INTO vendedor VALUES("7","Omar","Valencia","VMOO230439","Jefe","vamoo@1232","$2y$10$acVV8SzPhUYjKhtEpLB0Bu4huI9Cn1LKYWp7LyFrOgGQn8hux1ZNq");
INSERT INTO vendedor VALUES("11","Maribel","Medellin","msdfds","Jefa","Mari@gmail.com","Peluchina1");
INSERT INTO vendedor VALUES("12","Joel","Valencia","JAV2213","Jefe","jovavi@uotlook.com","Villajoel1");
INSERT INTO vendedor VALUES("14","Omar","Valencia","JAV2213","vendedor","dasas@gmail.com","5454894");
INSERT INTO vendedor VALUES("18","Fatima","Guzman","GLFO231183","vendedor","glfo@gmail.com","777Bigotes");



