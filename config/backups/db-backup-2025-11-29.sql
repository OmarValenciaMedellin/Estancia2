

DROP TABLE IF EXISTS `catalogo`;


CREATE TABLE `catalogo` (
  `id_Catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `id_Material` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_Catalogo`),
  KEY `id_Material` (`id_Material`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

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
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Subtotal` decimal(10,2) NOT NULL,
  `Descuento` decimal(10,2) NOT NULL,
  `Mano_obra` decimal(10,2) NOT NULL,
  `Impuestos` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Notas` text NOT NULL,
  PRIMARY KEY (`id_cotizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

INSERT INTO cotizacion VALUES("7","3","0000-00-00","21902.00","2190.20","800.00","4102.36","24614.16","Perfecto");
INSERT INTO cotizacion VALUES("17","28","0000-00-00","5000.00","0.00","0.00","800.00","5800.00","");
INSERT INTO cotizacion VALUES("20","6","0000-00-00","1116.00","0.00","1000.00","338.56","2454.56","");
INSERT INTO cotizacion VALUES("22","28","0000-00-00","200.00","0.00","100.00","48.00","348.00","");
INSERT INTO cotizacion VALUES("23","28","0000-00-00","250.00","0.00","150.00","64.00","464.00","");
INSERT INTO cotizacion VALUES("24","7","0000-00-00","200.00","0.00","120.00","51.20","371.20","");
INSERT INTO cotizacion VALUES("26","28","2025-11-26","250.00","0.00","150.00","64.00","464.00","");
INSERT INTO cotizacion VALUES("27","6","2025-11-26","400.00","0.00","200.00","96.00","696.00","");
INSERT INTO cotizacion VALUES("30","28","2025-11-26","3000.00","0.00","450.00","552.00","4002.00","");
INSERT INTO cotizacion VALUES("31","3","2025-11-26","2000.00","0.00","500.00","400.00","2900.00","TUo asdasasd");
INSERT INTO cotizacion VALUES("32","4","2025-11-26","7200.00","0.00","123.00","1171.68","8494.68","dsplfpkvopijijdfjopsakjoksk´fksódks");
INSERT INTO cotizacion VALUES("33","2","2025-11-26","5600.00","0.00","150.00","920.00","6670.00","");
INSERT INTO cotizacion VALUES("34","34","2025-11-27","1600.00","0.00","1000.00","416.00","3016.00","nos puede atender despues de las 12 del dia");





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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

INSERT INTO cotizacion_detalle VALUES("7","7","17","45.00","12.00","47","466.00","21902.00");
INSERT INTO cotizacion_detalle VALUES("16","17","19","0.00","0.00","20","250.00","5000.00");
INSERT INTO cotizacion_detalle VALUES("19","20","25","100.00","150.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("20","20","19","120.00","200.00","1","250.00","250.00");
INSERT INTO cotizacion_detalle VALUES("21","20","17","200.00","140.00","1","466.00","466.00");
INSERT INTO cotizacion_detalle VALUES("23","22","25","100.00","200.00","1","200.00","200.00");
INSERT INTO cotizacion_detalle VALUES("24","23","19","100.00","150.00","1","250.00","250.00");
INSERT INTO cotizacion_detalle VALUES("25","24","25","100.00","105.00","1","200.00","200.00");
INSERT INTO cotizacion_detalle VALUES("27","26","19","100.00","150.00","1","250.00","250.00");
INSERT INTO cotizacion_detalle VALUES("28","27","25","100.00","150.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("29","30","25","12.00","213.00","15","200.00","3000.00");
INSERT INTO cotizacion_detalle VALUES("30","31","16","12.00","12.00","10","200.00","2000.00");
INSERT INTO cotizacion_detalle VALUES("31","32","25","12.00","2.00","21","200.00","4200.00");
INSERT INTO cotizacion_detalle VALUES("32","32","19","12.00","12.00","12","250.00","3000.00");
INSERT INTO cotizacion_detalle VALUES("33","33","25","5.00","8.00","3","200.00","600.00");
INSERT INTO cotizacion_detalle VALUES("34","33","19","45.00","20.00","20","250.00","5000.00");
INSERT INTO cotizacion_detalle VALUES("35","34","16","150.00","100.00","2","200.00","400.00");
INSERT INTO cotizacion_detalle VALUES("36","34","26","100.00","150.00","2","600.00","1200.00");





DROP TABLE IF EXISTS `inventario`;


CREATE TABLE `inventario` (
  `id_Inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_Material` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Inventario`),
  KEY `id_Material` (`id_Material`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

INSERT INTO registro_cliente VALUES("1","Luis","Fernández","777891223","Luiz123@gmail.com");
INSERT INTO registro_cliente VALUES("2","Sofía","Martínez","7772345678","sofiama@mail.com");
INSERT INTO registro_cliente VALUES("3","David","Santos","7773456789","davids@mail.com");
INSERT INTO registro_cliente VALUES("4","maria","Ramírez","7774567890","luciar@mail.com");
INSERT INTO registro_cliente VALUES("5","gabriel","García","7775678906","gaby@mail.com");
INSERT INTO registro_cliente VALUES("6","Marta","Vargas","7776789012","martav@mail.com");
INSERT INTO registro_cliente VALUES("7","Omar","Valencia","7776175210","vamoo@1232");
INSERT INTO registro_cliente VALUES("28","Fatima","Guzman","7776175210","glfo@gmail.com");
INSERT INTO registro_cliente VALUES("36","Prueba3","Garcia","777 882 9565","Prueba@gmail.com");





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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

INSERT INTO registro_material VALUES("16","marco aluminio ","Perfil de aluminio","Metro lineal","200","16","Tubo de aluminio  color blanco");
INSERT INTO registro_material VALUES("19","Perfil Galvanizado...","Seleccionar categoría","Seleccionar unidad","250","11","Resistente a la oxidación y el desgaste por impacto. Utilizado en exteriores.\n                     ");
INSERT INTO registro_material VALUES("25","vidrio color rojo","Vidrio templado","Metro lineal","200","19","vidrio pars arco          \n          \n                            \n          \n                ");
INSERT INTO registro_material VALUES("26","vidrio vitral","Vidrio templado","Metro lineal","600","58","vidrio con bordes");
INSERT INTO registro_material VALUES("27","vidrio verde","Vidrio templado","Metro lineal","350","15","vidrio para vitral");
INSERT INTO registro_material VALUES("28","Silicon Negro","Seleccionar categoría","Seleccionar unidad","188","45","Silicon Marca Trupper");





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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

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
INSERT INTO vendedor VALUES("20","Tadeo","Gutierrez","tade1231","vendedor","tede@gmial.com","123");
INSERT INTO vendedor VALUES("21","daniela","salgado","dani123","vendedor","dani@gmail.com","77789");
INSERT INTO vendedor VALUES("22","hugo","garcia","hugo34","vendedor","hugo@gmail.com","777");
INSERT INTO vendedor VALUES("23","Luis","Garcia","luis123","vendedor","lu123@gmail.com","12345");



