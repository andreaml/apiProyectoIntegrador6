/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : volkswagen

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-17 09:28:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `categorias`
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `idCategoria` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(25) NOT NULL,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('2', 'Autos deportivos');
INSERT INTO `categorias` VALUES ('1', 'Autos familiares');
INSERT INTO `categorias` VALUES ('4', 'Autos para negocios');
INSERT INTO `categorias` VALUES ('3', 'Camionetas');

-- ----------------------------
-- Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `curp` varchar(18) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidoPaterno` varchar(30) NOT NULL,
  `apellidoMaterno` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codigo_postal` int(5) DEFAULT NULL,
  `RFC` varchar(13) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `prueba_manejo` int(1) NOT NULL,
  `idUsuarioCreador` int(11) DEFAULT NULL,
  PRIMARY KEY (`curp`),
  KEY `fk_clientes_usuarios` (`idUsuarioCreador`),
  CONSTRAINT `fk_clientes_usuarios` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`idTrabajador`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('MXLA960927MCSXYN02', 'Alejandra', 'Peralta', 'Escamilla', 'Avenida de la Paz #40-201 Colonia Santa Bárbara ', '27051', '23J3H5LÑ3N52M', 'Femenino', '3121027158', '3121027158', 'aperalta0@ucol.mx', 'colima', 'collima', '1', '1');
INSERT INTO `clientes` VALUES ('MXLA960927MCSXYN12', 'Alejandra', 'Peralta', 'Escamilla', 'Avenida de la Paz #40-123 Colonia Santa Bárbara ', '27051', '23J3H5LÑ3N52M', 'Masculino', '3121027158', '3121027158', 'aperalta0@ucol.mx', 'colima', 'collima', '1', '1');

-- ----------------------------
-- Table structure for `colores`
-- ----------------------------
DROP TABLE IF EXISTS `colores`;
CREATE TABLE `colores` (
  `idColor` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`idColor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of colores
-- ----------------------------
INSERT INTO `colores` VALUES ('1', 'Blanco');
INSERT INTO `colores` VALUES ('2', 'Negro');
INSERT INTO `colores` VALUES ('3', 'Arena');
INSERT INTO `colores` VALUES ('4', 'Plata');
INSERT INTO `colores` VALUES ('5', 'Rojo');
INSERT INTO `colores` VALUES ('6', '');

-- ----------------------------
-- Table structure for `envios`
-- ----------------------------
DROP TABLE IF EXISTS `envios`;
CREATE TABLE `envios` (
  `idEnvio` int(11) NOT NULL AUTO_INCREMENT,
  `fechaEnvio` date DEFAULT NULL,
  `horaEnvio` time(6) DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `horaRecepcion` time(6) DEFAULT NULL,
  `estado` varchar(9) DEFAULT NULL,
  `idSolicitud` int(11) NOT NULL,
  PRIMARY KEY (`idEnvio`),
  KEY `fk_envios_solicitudes1_idx` (`idSolicitud`),
  CONSTRAINT `fk_envios_solicitudes1` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitudes` (`idSolicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of envios
-- ----------------------------
INSERT INTO `envios` VALUES ('1', '2018-03-20', '08:24:00.000000', null, null, 'Enviado', '1');
INSERT INTO `envios` VALUES ('2', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('3', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('4', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('5', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('6', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('7', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('8', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('9', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('10', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('11', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');
INSERT INTO `envios` VALUES ('12', '2018-06-09', '10:21:00.000000', '2018-06-10', '10:00:00.000000', 'Enviado', '1');

-- ----------------------------
-- Table structure for `envio_informacion`
-- ----------------------------
DROP TABLE IF EXISTS `envio_informacion`;
CREATE TABLE `envio_informacion` (
  `idEnvioInformacion` int(11) NOT NULL AUTO_INCREMENT,
  `idRelProspectoVendedor` int(11) DEFAULT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEnvioInformacion`),
  KEY `fk_envio_informacion_rel_clientes_vendedor1_idx` (`idRelProspectoVendedor`),
  KEY `fk_envio_informacion_vehiculos1_idx` (`idVehiculo`) USING BTREE,
  CONSTRAINT `fk_envio_informacion_rel_clientes_vendedor1` FOREIGN KEY (`idRelProspectoVendedor`) REFERENCES `rel_prospectos_vendedor` (`idRelacion`),
  CONSTRAINT `fk_envio_informacion_vehiculos1_idx` FOREIGN KEY (`idVehiculo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of envio_informacion
-- ----------------------------
INSERT INTO `envio_informacion` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for `imagenes`
-- ----------------------------
DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `idImagen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idModeloVehiculo` int(11) NOT NULL,
  `idColor` int(10) unsigned NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`idImagen`),
  KEY `fk_idModeloVehiculo` (`idModeloVehiculo`),
  KEY `fk_idColor` (`idColor`),
  CONSTRAINT `fk_idColor` FOREIGN KEY (`idColor`) REFERENCES `colores` (`idColor`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idModeloVehiculo` FOREIGN KEY (`idModeloVehiculo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of imagenes
-- ----------------------------
INSERT INTO `imagenes` VALUES ('7', '1', '1', 'uploads/mod_1_color_11.png');
INSERT INTO `imagenes` VALUES ('9', '1', '1', 'uploads/mod_1_color_11.jpg');
INSERT INTO `imagenes` VALUES ('10', '1', '1', 'uploads/mod_1_color_12.jpg');
INSERT INTO `imagenes` VALUES ('12', '1', '1', 'uploads/mod_1_color_14.jpg');
INSERT INTO `imagenes` VALUES ('13', '1', '3', 'uploads/mod_1_color_3.jpg');
INSERT INTO `imagenes` VALUES ('14', '1', '1', 'uploads/mod_1_color_15.jpg');
INSERT INTO `imagenes` VALUES ('15', '1', '1', 'uploads/mod_1_color_16.jpg');
INSERT INTO `imagenes` VALUES ('17', '1', '3', 'uploads/mod_1_color_32.jpg');
INSERT INTO `imagenes` VALUES ('18', '1', '3', 'uploads/mod_1_color_33.jpg');
INSERT INTO `imagenes` VALUES ('19', '1', '3', 'uploads/mod_1_color_34.jpg');
INSERT INTO `imagenes` VALUES ('20', '1', '3', 'uploads/mod_1_color_35.jpg');
INSERT INTO `imagenes` VALUES ('24', '1', '1', 'uploads/mod_1_color_17.jpg');
INSERT INTO `imagenes` VALUES ('25', '1', '3', 'uploads/mod_1_color_36.jpg');
INSERT INTO `imagenes` VALUES ('28', '2', '3', 'uploads/mod_2_color_31.jpg');
INSERT INTO `imagenes` VALUES ('33', '2', '1', 'uploads/mod_2_color_1.jpg');
INSERT INTO `imagenes` VALUES ('34', '1', '3', 'uploads/mod_1_color_37.jpg');
INSERT INTO `imagenes` VALUES ('35', '1', '3', 'uploads/mod_1_color_38.jpg');
INSERT INTO `imagenes` VALUES ('37', '1', '4', 'uploads/mod_1_color_4.jpg');
INSERT INTO `imagenes` VALUES ('39', '1', '2', 'uploads/mod_1_color_21.jpg');
INSERT INTO `imagenes` VALUES ('40', '5', '3', 'uploads/mod_5_color_3.jpg');
INSERT INTO `imagenes` VALUES ('41', '5', '3', 'uploads/mod_5_color_31.jpg');

-- ----------------------------
-- Table structure for `modelos_vehiculos`
-- ----------------------------
DROP TABLE IF EXISTS `modelos_vehiculos`;
CREATE TABLE `modelos_vehiculos` (
  `idModeloVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(1) unsigned DEFAULT NULL,
  `modelo` varchar(20) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `version` varchar(4) NOT NULL,
  `tipoTransmision` varchar(12) DEFAULT NULL,
  `aireAcondicionado` int(1) DEFAULT NULL,
  `bolsasAire` int(1) DEFAULT NULL,
  `tipoFreno` varchar(10) DEFAULT NULL,
  `cilindrada` int(1) DEFAULT NULL,
  `equipamiento` varchar(30) DEFAULT NULL,
  `disponibilidad` varchar(10) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `numPuertas` int(1) DEFAULT NULL,
  `numPasajeros` int(1) DEFAULT NULL,
  `tipoCombustible` varchar(7) DEFAULT NULL,
  `potencia` varchar(8) DEFAULT NULL,
  `categoria` varchar(13) DEFAULT NULL,
  `idUsuarioCreador` int(11) DEFAULT NULL,
  PRIMARY KEY (`idModeloVehiculo`),
  KEY `fk_vehiculos_usuarios1_idx` (`idUsuarioCreador`),
  KEY `fk_modelo_categoria` (`idCategoria`),
  CONSTRAINT `fk_modelo_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  CONSTRAINT `fk_vehiculos_usuarios1` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`idTrabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modelos_vehiculos
-- ----------------------------
INSERT INTO `modelos_vehiculos` VALUES ('1', '1', 'Vento', '2018', 'GLI', 'Manual', '1', '1', 'Disco', '4', 'Radio, CD, Bluetooth, Aux-in', 'Disponible', '209990', '5', '5', 'Magna', '105/5250', 'Auto familiar', '1');
INSERT INTO `modelos_vehiculos` VALUES ('2', '1', 'Vento', '2017', 'GLI', 'Manual', '1', '1', 'Disco', '4', 'Radio', 'Disponible', '179990', '5', '5', 'Magna', '105/5250', 'Auto familiar', '2');
INSERT INTO `modelos_vehiculos` VALUES ('5', '1', 'Polo', '2019', 'GLI', 'Manual', '0', '5', 'Disco', '8', 'Radio FM, Bluethoot, Aux', null, '259990', '5', '5', 'Magna', '115/5250', null, '1');

-- ----------------------------
-- Table structure for `prospectos`
-- ----------------------------
DROP TABLE IF EXISTS `prospectos`;
CREATE TABLE `prospectos` (
  `curp` varchar(18) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidoPaterno` varchar(20) NOT NULL,
  `apellidoMaterno` varchar(20) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `idUsuarioCreador` int(11) DEFAULT NULL,
  `activo` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`curp`),
  KEY `fk_clientes_usuarios1_idx` (`idUsuarioCreador`),
  CONSTRAINT `fk_clientes_usuarios1` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`idTrabajador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prospectos
-- ----------------------------
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN01', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '1');
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN02', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '1');
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN03', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '0');
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN04', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '0');
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN05', 'Ale', 'Muñoz', 'Liy', '3121027158', 'aliy7@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '1');
INSERT INTO `prospectos` VALUES ('MXLA960927MCSXYN06', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1', '0');
INSERT INTO `prospectos` VALUES ('PEEL970215MJCRSR00', 'Lorena', 'Peralta', 'Escamilla', '3121053708', 'lperalta@ucol.mx', 'Juan Álvarez #571. Col. Guadalajarita', '2', '0');

-- ----------------------------
-- Table structure for `recordatorios`
-- ----------------------------
DROP TABLE IF EXISTS `recordatorios`;
CREATE TABLE `recordatorios` (
  `idRecordatorio` int(11) NOT NULL AUTO_INCREMENT,
  `idRelProspectoVendedor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time(6) DEFAULT NULL,
  `idSeguimiento` int(11) DEFAULT NULL,
  `estado` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`idRecordatorio`),
  KEY `fk_recordatorios_rel_clientes_vendedor1_idx` (`idRelProspectoVendedor`),
  KEY `fk_recordatorios_seguimientos1_idx` (`idSeguimiento`),
  CONSTRAINT `fk_recordatorios_rel_clientes_vendedor1` FOREIGN KEY (`idRelProspectoVendedor`) REFERENCES `rel_prospectos_vendedor` (`idRelacion`),
  CONSTRAINT `fk_recordatorios_seguimientos1` FOREIGN KEY (`idSeguimiento`) REFERENCES `seguimientos` (`idSeguimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recordatorios
-- ----------------------------
INSERT INTO `recordatorios` VALUES ('1', '1', '2018-03-17', '09:30:00.000000', '0', 'Por notificar');
INSERT INTO `recordatorios` VALUES ('2', '1', '2018-03-18', '14:40:00.000000', '0', 'Por notificar');

-- ----------------------------
-- Table structure for `rel_modelo_color`
-- ----------------------------
DROP TABLE IF EXISTS `rel_modelo_color`;
CREATE TABLE `rel_modelo_color` (
  `idRelModeloColor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idModeloVehiculo` int(11) NOT NULL,
  `idColor` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idRelModeloColor`),
  KEY `fk_modelo` (`idModeloVehiculo`),
  KEY `fk_color` (`idColor`),
  CONSTRAINT `fk_color` FOREIGN KEY (`idColor`) REFERENCES `colores` (`idColor`) ON UPDATE CASCADE,
  CONSTRAINT `fk_modelo` FOREIGN KEY (`idModeloVehiculo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rel_modelo_color
-- ----------------------------
INSERT INTO `rel_modelo_color` VALUES ('2', '1', '2');
INSERT INTO `rel_modelo_color` VALUES ('4', '2', '1');
INSERT INTO `rel_modelo_color` VALUES ('6', '1', '3');
INSERT INTO `rel_modelo_color` VALUES ('8', '2', '3');
INSERT INTO `rel_modelo_color` VALUES ('9', '1', '1');
INSERT INTO `rel_modelo_color` VALUES ('10', '1', '4');
INSERT INTO `rel_modelo_color` VALUES ('13', '5', '3');

-- ----------------------------
-- Table structure for `rel_prospectos_vendedor`
-- ----------------------------
DROP TABLE IF EXISTS `rel_prospectos_vendedor`;
CREATE TABLE `rel_prospectos_vendedor` (
  `idRelacion` int(11) NOT NULL AUTO_INCREMENT,
  `idProspecto` varchar(18) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idRelacion`),
  KEY `fk_rel_clientes_vendedor_clientes1_idx` (`idProspecto`),
  KEY `fk_rel_clientes_vendedor_usuarios1_idx` (`idUsuario`),
  CONSTRAINT `fk_rel_clientes_vendedor_clientes1` FOREIGN KEY (`idProspecto`) REFERENCES `prospectos` (`curp`),
  CONSTRAINT `fk_rel_clientes_vendedor_usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idTrabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rel_prospectos_vendedor
-- ----------------------------
INSERT INTO `rel_prospectos_vendedor` VALUES ('1', 'PEEL970215MJCRSR00', '2');
INSERT INTO `rel_prospectos_vendedor` VALUES ('2', 'PEEL970215MJCRSR00', '4');
INSERT INTO `rel_prospectos_vendedor` VALUES ('3', 'MXLA960927MCSXYN01', '1');
INSERT INTO `rel_prospectos_vendedor` VALUES ('4', 'MXLA960927MCSXYN02', '1');
INSERT INTO `rel_prospectos_vendedor` VALUES ('5', 'MXLA960927MCSXYN03', '1');
INSERT INTO `rel_prospectos_vendedor` VALUES ('6', 'MXLA960927MCSXYN04', '1');
INSERT INTO `rel_prospectos_vendedor` VALUES ('7', 'MXLA960927MCSXYN05', '1');
INSERT INTO `rel_prospectos_vendedor` VALUES ('8', 'MXLA960927MCSXYN06', '1');

-- ----------------------------
-- Table structure for `rel_usuarios_sucursal`
-- ----------------------------
DROP TABLE IF EXISTS `rel_usuarios_sucursal`;
CREATE TABLE `rel_usuarios_sucursal` (
  `idRelacion` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`idRelacion`),
  KEY `fk_rel_usuarios_sucursal_sucursales_idx` (`idSucursal`),
  KEY `fk_rel_usuarios_sucursal_roles1_idx` (`idRol`),
  KEY `fk_rel_usuarios_sucursal_usuarios1_idx` (`idUsuario`),
  CONSTRAINT `fk_rel_usuarios_sucursal_roles1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_rel_usuarios_sucursal_sucursales` FOREIGN KEY (`idSucursal`) REFERENCES `sucursales` (`idSucursal`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_rel_usuarios_sucursal_usuarios1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idTrabajador`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rel_usuarios_sucursal
-- ----------------------------
INSERT INTO `rel_usuarios_sucursal` VALUES ('1', '2', '2', '2');
INSERT INTO `rel_usuarios_sucursal` VALUES ('2', '4', '1', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('3', '11', '19', '1');
INSERT INTO `rel_usuarios_sucursal` VALUES ('4', '12', '1', '2');
INSERT INTO `rel_usuarios_sucursal` VALUES ('5', '13', '1', '1');
INSERT INTO `rel_usuarios_sucursal` VALUES ('17', '38', '1', '1');
INSERT INTO `rel_usuarios_sucursal` VALUES ('18', '39', '1', '1');
INSERT INTO `rel_usuarios_sucursal` VALUES ('19', '40', '1', '2');
INSERT INTO `rel_usuarios_sucursal` VALUES ('20', '41', '1', '1');
INSERT INTO `rel_usuarios_sucursal` VALUES ('21', '42', '17', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('22', '43', '4', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('23', '44', '19', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('24', '45', '7', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('25', '46', '17', '3');
INSERT INTO `rel_usuarios_sucursal` VALUES ('26', '57', '1', '1');

-- ----------------------------
-- Table structure for `rel_vehiculos_stock`
-- ----------------------------
DROP TABLE IF EXISTS `rel_vehiculos_stock`;
CREATE TABLE `rel_vehiculos_stock` (
  `idRelacion` int(11) NOT NULL AUTO_INCREMENT,
  `idStock` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRelacion`),
  KEY `fk_rel_vehiculos_stock_stock1_idx` (`idStock`),
  KEY `fk_rel_vehiculos_stock_vehiculos1_idx` (`idVehiculo`),
  CONSTRAINT `fk_rel_vehiculos_stock_stock1` FOREIGN KEY (`idStock`) REFERENCES `stock` (`idStock`),
  CONSTRAINT `fk_rel_vehiculos_stock_vehiculos1` FOREIGN KEY (`idVehiculo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rel_vehiculos_stock
-- ----------------------------
INSERT INTO `rel_vehiculos_stock` VALUES ('1', '1', '1', '1');

-- ----------------------------
-- Table structure for `reportes`
-- ----------------------------
DROP TABLE IF EXISTS `reportes`;
CREATE TABLE `reportes` (
  `idReporte` int(11) NOT NULL AUTO_INCREMENT,
  `ventas` int(11) DEFAULT NULL,
  `solicitudes` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `envios` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `hora` time(6) DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idReporte`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reportes
-- ----------------------------
INSERT INTO `reportes` VALUES ('1', null, null, null, null, null, null, null);
INSERT INTO `reportes` VALUES ('2', '2', null, null, null, null, null, null);
INSERT INTO `reportes` VALUES ('3', '2', null, null, null, null, null, null);
INSERT INTO `reportes` VALUES ('4', '2', null, null, null, null, null, null);
INSERT INTO `reportes` VALUES ('5', '1', null, null, null, null, null, null);
INSERT INTO `reportes` VALUES ('6', '1', '1', '2', '1', '2018-03-09', '14:00:00.000000', '2018-04-09');

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) NOT NULL,
  `descripcion` varchar(70) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idRol`),
  UNIQUE KEY `index_rol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Gerente global', 'Gerente master DIOS, rey, papÃ¡, SUPREMO LIDER, peÃ±aLord, tlatoani, B', '1');
INSERT INTO `roles` VALUES ('2', 'Gerente de agencia', 'Persona encargada de una sucursal', '1');
INSERT INTO `roles` VALUES ('3', 'Vendedor', 'Persona encargada de vender carros y hacer tratos con clientes', '1');
INSERT INTO `roles` VALUES ('4', 'Asistente ejecutivo', 'Asistente provisional para cubrir faltas', '0');
INSERT INTO `roles` VALUES ('5', 'Asistente', 'Asistente provisional para cubrir faltas', '0');

-- ----------------------------
-- Table structure for `seguimientos`
-- ----------------------------
DROP TABLE IF EXISTS `seguimientos`;
CREATE TABLE `seguimientos` (
  `idSeguimiento` int(11) NOT NULL,
  `idRelProspectoVendedor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time(6) DEFAULT NULL,
  `horaFin` time(6) DEFAULT NULL,
  `tipoSeguimiento` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`idSeguimiento`),
  KEY `fk_seguimientos_rel_clientes_vendedor1_idx` (`idRelProspectoVendedor`),
  CONSTRAINT `fk_seguimientos_rel_clientes_vendedor1` FOREIGN KEY (`idRelProspectoVendedor`) REFERENCES `rel_prospectos_vendedor` (`idRelacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of seguimientos
-- ----------------------------
INSERT INTO `seguimientos` VALUES ('0', '1', '2018-03-15', '11:00:00.000000', '13:00:00.000000', 'Cita');

-- ----------------------------
-- Table structure for `solicitudes`
-- ----------------------------
DROP TABLE IF EXISTS `solicitudes`;
CREATE TABLE `solicitudes` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `idSucursalSolicitante` int(11) DEFAULT NULL,
  `idSucursalSolicitada` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time(6) DEFAULT NULL,
  `comentarios` varchar(255) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `fk_solicitudes_vehiculos1_idx` (`idVehiculo`),
  KEY `fk_solicitudes_sucursales1_idx` (`idSucursalSolicitante`),
  KEY `fk_solicitudes_sucursales2_idx` (`idSucursalSolicitada`),
  CONSTRAINT `fk_solicitudes_sucursales1` FOREIGN KEY (`idSucursalSolicitante`) REFERENCES `sucursales` (`idSucursal`),
  CONSTRAINT `fk_solicitudes_sucursales2` FOREIGN KEY (`idSucursalSolicitada`) REFERENCES `sucursales` (`idSucursal`),
  CONSTRAINT `fk_solicitudes_vehiculos1` FOREIGN KEY (`idVehiculo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of solicitudes
-- ----------------------------
INSERT INTO `solicitudes` VALUES ('1', '1', '2', '2018-03-02', '14:00:00.000000', null, 'Enviado', '1');
INSERT INTO `solicitudes` VALUES ('2', '4', '5', '2018-06-09', '11:29:00.000000', '', 'Aprobado', '1');

-- ----------------------------
-- Table structure for `stock`
-- ----------------------------
DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(10) NOT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idStock`),
  KEY `fk_stock_sucursales1_idx` (`idSucursal`),
  KEY `fk_stock_vehiculo` (`idVehiculo`),
  CONSTRAINT `fk_stock_sucursales1` FOREIGN KEY (`idSucursal`) REFERENCES `sucursales` (`idSucursal`) ON UPDATE CASCADE,
  CONSTRAINT `fk_stock_vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stock
-- ----------------------------
INSERT INTO `stock` VALUES ('1', 'Enviado', '1', '1');
INSERT INTO `stock` VALUES ('3', 'Enviado', '1', '3');
INSERT INTO `stock` VALUES ('4', 'Enviado', '1', '4');
INSERT INTO `stock` VALUES ('5', 'Enviado', '1', '5');
INSERT INTO `stock` VALUES ('6', 'Enviado', '1', '6');
INSERT INTO `stock` VALUES ('7', 'Enviado', '1', '7');
INSERT INTO `stock` VALUES ('8', 'Enviado', '1', '8');
INSERT INTO `stock` VALUES ('9', 'Enviado', '1', '9');
INSERT INTO `stock` VALUES ('10', 'Enviado', '1', '10');
INSERT INTO `stock` VALUES ('11', 'Enviado', '1', '12');
INSERT INTO `stock` VALUES ('12', 'Enviado', '1', '14');
INSERT INTO `stock` VALUES ('13', 'Enviado', '1', '15');
INSERT INTO `stock` VALUES ('14', 'Enviado', '1', '16');
INSERT INTO `stock` VALUES ('15', 'Enviado', '1', '17');
INSERT INTO `stock` VALUES ('16', 'Enviado', '1', '18');
INSERT INTO `stock` VALUES ('17', 'Enviado', '1', '19');
INSERT INTO `stock` VALUES ('18', 'Enviado', '1', '20');
INSERT INTO `stock` VALUES ('19', 'Enviado', '1', '21');
INSERT INTO `stock` VALUES ('20', 'Enviado', '1', '22');
INSERT INTO `stock` VALUES ('21', 'Enviado', '1', '23');
INSERT INTO `stock` VALUES ('22', 'Recibido', '1', '24');

-- ----------------------------
-- Table structure for `sucursales`
-- ----------------------------
DROP TABLE IF EXISTS `sucursales`;
CREATE TABLE `sucursales` (
  `idSucursal` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `tipo` int(1) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `idSucursalPadre` int(11) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idSucursal`),
  UNIQUE KEY `index_telefono` (`telefono`),
  UNIQUE KEY `index_sucursal` (`sucursal`),
  KEY `fk_sucursales_sucursales1_idx` (`idSucursalPadre`),
  KEY `idSucursal` (`idSucursal`),
  CONSTRAINT `fk_sucursales_sucursales1` FOREIGN KEY (`idSucursalPadre`) REFERENCES `sucursales` (`idSucursal`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sucursales
-- ----------------------------
INSERT INTO `sucursales` VALUES ('1', 'Colima', '3121027157', 'Lic. Carlos de La Madrid 888, Costeño, 280', '1', 'Colima', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('2', 'Tenacatita ', '3121525439', 'Bahía de Tenacatita #202', '1', 'Colima', 'Colima', '1', '0');
INSERT INTO `sucursales` VALUES ('4', 'La Paz', '3121027158', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Co', '1', 'Villa de Álvarez', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('5', 'Acumualpan', '3121232233', 'Av. Universidad de Colima #432', '1', 'Colima', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('7', 'Sucursal nueva 2', '3121232235', 'Av. Universidad de Colima #432', '1', 'Colima', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('14', 'Nueva1', '3121234466', 'Avenida Dirección #123', '1', 'Manzanillo', 'Colima', '1', '0');
INSERT INTO `sucursales` VALUES ('17', 'Nueva2', '3121234461', 'Avenida Dirección #123', '1', 'Manzanillo', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('19', 'Nueva3', '3121234462', 'Avenida Dirección #123', '1', 'Manzanillo', 'Colima', '1', '1');
INSERT INTO `sucursales` VALUES ('22', 'Colimán', '3120006644', 'Av. Universidad #333 Col. Las Viboras.', '1', 'Colima', 'Colima', '1', '0');
INSERT INTO `sucursales` VALUES ('23', 'Tecomán', '3158886521', 'Avenida Tecomán #456 Colonia Girasoles', '1', 'Tecomán', 'Colima', '1', '0');

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idTrabajador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `apellidoPaterno` varchar(20) NOT NULL,
  `apellidoMaterno` varchar(20) DEFAULT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `contrasenia` varchar(15) NOT NULL,
  `idUsuarioCreador` int(11) DEFAULT NULL,
  `activo` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idTrabajador`),
  UNIQUE KEY `index_correo` (`correo`),
  KEY `fk_usuarios_usuarios1_idx` (`idUsuarioCreador`),
  CONSTRAINT `fk_usuarios_usuarios1` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`idTrabajador`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Mario Eduardo', 'Chagollan', 'Acevedo', '3141466016', 'mchagollan0@ucol.mx', 'Guillermo Anguiano #932 Col. Infonavit', '123tamarindo', null, '1');
INSERT INTO `usuarios` VALUES ('2', 'Andre', 'Muñoz', 'Liy', '3121027157', 'aliy@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '1234', '1', '0');
INSERT INTO `usuarios` VALUES ('3', 'Alejandra', 'Peralta', 'Escamilla', '3121107501', 'aperalta0@ucol.mx', 'Nigromante #22. Col. Centro', '123tamarindo', '1', '0');
INSERT INTO `usuarios` VALUES ('4', 'Mildred Nataly', 'Silva', 'Méndez', '3121233232', 'msilva@ucol.mx', 'Av. Universidad #333. Col. Las víboras', '123tamarindo', '1', '0');
INSERT INTO `usuarios` VALUES ('5', 'Andrea', 'Muñoz', 'Liy', '3121027157', 'aliy6@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('7', 'Andrea', 'Muñoz', 'Liy', '3121027159', 'aliy9@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('8', 'Andrea', 'Muñoz', 'Liy', '3121027159', 'aliy90@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('11', 'Marta', 'Juárez', 'López', '3121027159', 'aliy92@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '7496', '1', '1');
INSERT INTO `usuarios` VALUES ('12', 'Ana', 'Pérez', 'Saucedo', '3121027159', 'anaps@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('13', 'Andrea', 'Muñoz', 'Liy', '3121027159', 'aliy94@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('26', 'Andrea', 'Muñoz', 'Ley', '3120005588', 'aliy95@ucol.mx', 'fdskfjskl', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('38', 'Andrea', 'Muñoz', 'Liy', '3121027159', 'aliy96@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', 'tamarindo987', '1', '1');
INSERT INTO `usuarios` VALUES ('39', 'Persona', 'Persona', 'Persona', '3124567788', 'aliy97@ucol.mx', 'Av Faisanes #44 Colonia Linda Vista', '', '1', '1');
INSERT INTO `usuarios` VALUES ('40', 'Persona', 'Persona', 'Persona', '3124567788', 'aliy98@ucol.mx', 'Av Faisanes #44 Colonia Linda Vista', '', '1', '1');
INSERT INTO `usuarios` VALUES ('41', 'Persona', 'Persona', 'Persona', '3124567788', 'aliy99@ucol.mx', 'Av Faisanes #44 Colonia Linda Vista', '', '1', '1');
INSERT INTO `usuarios` VALUES ('42', 'Persona', 'Persona', 'Persona', '3120048596', 'aliy01@ucol.mx', 'Avenida Universidad 999', '', '1', '1');
INSERT INTO `usuarios` VALUES ('43', 'Personita', 'Personita', 'Personita', '3124567894', 'aliy02@ucol.mx', 'Dirección #02 \r\nColonia Personita', '', '1', '1');
INSERT INTO `usuarios` VALUES ('44', 'a', 'a', 'a', '3120000000', 'a@a', 'aaaaaaaaaaaaaaaa', '', '1', '0');
INSERT INTO `usuarios` VALUES ('45', 'Personita', 'Personita', 'Personita', '3124324323', 'a@3', 'jfsklda jfkdlsa;jfdklas f', '', '1', '1');
INSERT INTO `usuarios` VALUES ('46', 'Personita', 'Personita', 'Personita', '1234567894', '23@32', 'lfk;sja fjsdaklf jsdklf', '', '1', '1');
INSERT INTO `usuarios` VALUES ('57', 'Andrea', 'Muñoz', 'Liy', '3121027159', 'aliy93@ucol.mx', 'Avenida de la Paz #40-201 Colonia Santa Bárbara Colima, Colima', '', '1', '1');

-- ----------------------------
-- Table structure for `vehiculos`
-- ----------------------------
DROP TABLE IF EXISTS `vehiculos`;
CREATE TABLE `vehiculos` (
  `idVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `idModelo` int(11) NOT NULL,
  `numeroSerie` varchar(10) NOT NULL,
  `idColor` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idVehiculo`),
  UNIQUE KEY `numSerie` (`numeroSerie`),
  KEY `fk_vehiculos_modelos` (`idModelo`),
  KEY `fk_vehiculos_colores` (`idColor`),
  KEY `idVehiculo` (`idVehiculo`),
  CONSTRAINT `fk_vehiculos_colores` FOREIGN KEY (`idColor`) REFERENCES `colores` (`idColor`) ON UPDATE CASCADE,
  CONSTRAINT `fk_vehiculos_modelos` FOREIGN KEY (`idModelo`) REFERENCES `modelos_vehiculos` (`idModeloVehiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vehiculos
-- ----------------------------
INSERT INTO `vehiculos` VALUES ('1', '1', 'ftf776', '2');
INSERT INTO `vehiculos` VALUES ('2', '2', 'ftf775', '1');
INSERT INTO `vehiculos` VALUES ('3', '1', 'asd123457', '3');
INSERT INTO `vehiculos` VALUES ('4', '1', 'asd123456', '3');
INSERT INTO `vehiculos` VALUES ('5', '1', '5555aaa7', '2');
INSERT INTO `vehiculos` VALUES ('6', '1', '5555aaaa', '2');
INSERT INTO `vehiculos` VALUES ('7', '1', '5555aae3', '2');
INSERT INTO `vehiculos` VALUES ('8', '1', '5555aae', '2');
INSERT INTO `vehiculos` VALUES ('9', '1', 'fsadf2342', '2');
INSERT INTO `vehiculos` VALUES ('10', '1', 'fsadf2341', '2');
INSERT INTO `vehiculos` VALUES ('12', '1', 'fsadf2343', '2');
INSERT INTO `vehiculos` VALUES ('14', '1', '123', '2');
INSERT INTO `vehiculos` VALUES ('15', '1', '1234', '2');
INSERT INTO `vehiculos` VALUES ('16', '1', 'dfas', '2');
INSERT INTO `vehiculos` VALUES ('17', '1', 'fds', '2');
INSERT INTO `vehiculos` VALUES ('18', '1', 'fdsa', '2');
INSERT INTO `vehiculos` VALUES ('19', '1', 'asdqwe', '2');
INSERT INTO `vehiculos` VALUES ('20', '1', '1111111111', '2');
INSERT INTO `vehiculos` VALUES ('21', '1', 'asd', '2');
INSERT INTO `vehiculos` VALUES ('22', '1', 'asd343', '2');
INSERT INTO `vehiculos` VALUES ('23', '1', 'asdf343', '1');
INSERT INTO `vehiculos` VALUES ('24', '2', 'fasdf', '1');

-- ----------------------------
-- Table structure for `ventas`
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `idVehiculo` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time(6) DEFAULT NULL,
  `iva` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `idVendedor` int(11) DEFAULT NULL,
  `idCliente` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`idVenta`),
  KEY `fk_ventas_vehiculos1_idx` (`idVehiculo`),
  KEY `fk_ventas_usuarios` (`idVendedor`),
  KEY `fk_ventas_clientes` (`idCliente`),
  CONSTRAINT `fk_ventas_clientes` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`curp`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ventas_usuarios` FOREIGN KEY (`idVendedor`) REFERENCES `usuarios` (`idTrabajador`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ventas_vehiculos` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES ('0', '1', '2018-03-19', '17:19:00.000000', '33598', '243588', 'Vendido', null, null);
INSERT INTO `ventas` VALUES ('1', '1', '2018-06-12', '22:19:33.000000', '21382', '1232134', 'Vendido', '1', 'MXLA960927MCSXYN12');
INSERT INTO `ventas` VALUES ('2', '2', '2018-05-30', '22:29:12.000000', '23431', '189231', 'Vendido', '3', 'MXLA960927MCSXYN02');
DELIMITER ;;
CREATE TRIGGER `clientes_AFTER_INSERT` AFTER INSERT ON `prospectos` FOR EACH ROW BEGIN
	INSERT INTO rel_clientes_vendedor(idCliente,idUsuario) values(NEW.curp, NEW.idUsuarioCreador);
END
;;
DELIMITER ;
DELIMITER ;;
CREATE TRIGGER `tgr_1` AFTER INSERT ON `ventas` FOR EACH ROW BEGIN
  DELETE FROM stock where idVehiculo = NEW.idVehiculo;
END
;;
DELIMITER ;
