-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `Compras`;
CREATE TABLE `Compras` (
  `IDProducto` int(11) NOT NULL AUTO_INCREMENT,
  `Producto` varchar(255) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Valor` integer(30) DEFAULT NULL,
  PRIMARY KEY (`IDProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

