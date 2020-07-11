/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : facilrest_laravel_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-07-11 03:32:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acceso_modulo`
-- ----------------------------
DROP TABLE IF EXISTS `acceso_modulo`;
CREATE TABLE `acceso_modulo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `acceso_modulo_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `acceso_modulo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acceso_modulo
-- ----------------------------

-- ----------------------------
-- Table structure for `acceso_perfil_menu`
-- ----------------------------
DROP TABLE IF EXISTS `acceso_perfil_menu`;
CREATE TABLE `acceso_perfil_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  `acceso` enum('1','0') DEFAULT '1',
  `mantenimiento` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_id` (`perfil_id`),
  KEY `menu_id` (`menu_id`) USING BTREE,
  CONSTRAINT `acceso_perfil_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `acceso_perfil_menu_ibfk_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acceso_perfil_menu
-- ----------------------------
INSERT INTO `acceso_perfil_menu` VALUES ('1', '2', '2', '1', 'add,edit,delete', '2020-05-15 03:20:00', '2020-05-15 03:20:00', null);
INSERT INTO `acceso_perfil_menu` VALUES ('2', '3', '2', '1', 'add,edit,delete', '2020-05-15 03:26:58', '2020-06-19 00:57:47', null);
INSERT INTO `acceso_perfil_menu` VALUES ('3', '6', '2', '1', 'add,edit,delete', '2020-05-21 22:02:02', '2020-05-21 22:02:02', null);
INSERT INTO `acceso_perfil_menu` VALUES ('4', '7', '2', '1', 'add,edit,delete', '2020-05-21 22:02:36', '2020-05-21 22:02:36', null);
INSERT INTO `acceso_perfil_menu` VALUES ('5', '13', '2', '1', 'add,edit,delete', '2020-05-21 23:27:05', '2020-05-21 23:27:05', null);
INSERT INTO `acceso_perfil_menu` VALUES ('6', '14', '2', '1', 'add,edit,delete', '2020-05-21 23:27:10', '2020-05-21 23:27:16', null);
INSERT INTO `acceso_perfil_menu` VALUES ('7', '16', '2', '1', 'add,edit,delete', '2020-06-03 03:32:28', '2020-06-19 00:57:49', null);
INSERT INTO `acceso_perfil_menu` VALUES ('8', '8', '2', '1', 'add,edit,delete', '2020-06-03 20:26:02', '2020-06-19 00:57:51', null);
INSERT INTO `acceso_perfil_menu` VALUES ('9', '20', '2', '1', 'add,edit,delete', '2020-06-03 20:32:53', '2020-06-19 00:57:52', null);
INSERT INTO `acceso_perfil_menu` VALUES ('10', '5', '2', '1', 'add,edit,delete', '2020-06-12 03:18:48', '2020-06-19 00:57:54', null);
INSERT INTO `acceso_perfil_menu` VALUES ('11', '21', '2', '1', 'add,edit,delete', '2020-06-12 03:18:53', '2020-06-19 00:57:57', null);
INSERT INTO `acceso_perfil_menu` VALUES ('12', '30', '2', '1', 'add,delete,edit', '2020-06-12 04:33:32', '2020-06-22 02:47:57', null);
INSERT INTO `acceso_perfil_menu` VALUES ('13', '9', '2', '1', null, '2020-06-24 05:34:14', '2020-06-24 05:34:14', null);
INSERT INTO `acceso_perfil_menu` VALUES ('14', '31', '2', '1', 'add,edit,delete', '2020-06-24 05:42:54', '2020-06-24 05:42:54', null);

-- ----------------------------
-- Table structure for `categoria_producto`
-- ----------------------------
DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE `categoria_producto` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categoria_producto
-- ----------------------------
INSERT INTO `categoria_producto` VALUES ('1', 'Entrada', '2020-02-24 14:08:13', '2020-02-24 14:08:13', null, '2');

-- ----------------------------
-- Table structure for `dfilejs_menu`
-- ----------------------------
DROP TABLE IF EXISTS `dfilejs_menu`;
CREATE TABLE `dfilejs_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `dfilejs_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dfilejs_menu_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `filejs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dfilejs_menu
-- ----------------------------
INSERT INTO `dfilejs_menu` VALUES ('1', '21', '1', '2020-02-22 11:34:40', '2020-03-09 19:12:30', null);
INSERT INTO `dfilejs_menu` VALUES ('2', '30', '6', '2020-06-13 01:38:15', '2020-06-13 01:38:15', null);
INSERT INTO `dfilejs_menu` VALUES ('3', '31', '7', '2020-06-24 06:10:43', '2020-06-24 06:10:43', null);

-- ----------------------------
-- Table structure for `filejs`
-- ----------------------------
DROP TABLE IF EXISTS `filejs`;
CREATE TABLE `filejs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of filejs
-- ----------------------------
INSERT INTO `filejs` VALUES ('1', 'catProducto.js', '2020-02-21 18:40:32', '2020-02-21 18:40:32', null);
INSERT INTO `filejs` VALUES ('2', 'catIngrediente.js', '2020-02-21 18:41:13', '2020-02-21 18:41:13', null);
INSERT INTO `filejs` VALUES ('3', 'ingrediente.js', '2020-02-21 18:41:27', '2020-02-21 18:41:27', null);
INSERT INTO `filejs` VALUES ('4', 'producto.js', '2020-02-21 18:41:44', '2020-02-21 18:41:44', null);
INSERT INTO `filejs` VALUES ('5', 'gastos.js', '2020-02-21 18:41:54', '2020-02-21 18:41:54', null);
INSERT INTO `filejs` VALUES ('6', 'usuarios.js', '2020-06-13 01:37:45', '2020-06-13 01:37:45', null);
INSERT INTO `filejs` VALUES ('7', 'perfiles.js', '2020-06-24 06:10:26', '2020-06-24 06:10:26', null);

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `nombre_largo` varchar(255) DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `vista_blade` varchar(255) DEFAULT NULL,
  `padre` int(11) DEFAULT 0,
  `order` int(1) DEFAULT 0,
  `state` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visible` int(11) DEFAULT 1,
  `default` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('2', 'PDV', null, 'la la-cutlery', 'pdv', 'pdv.pdv', '0', '1', '1', '2020-01-30 02:28:26', '2020-05-21 15:51:49', null, '1', '0');
INSERT INTO `menu` VALUES ('3', 'Ventas', null, 'la la-money', '', null, '0', '2', '1', '2020-01-30 02:33:47', '2020-03-07 19:08:53', null, '1', '0');
INSERT INTO `menu` VALUES ('4', 'Gastos', null, 'la la-calculator', '', null, '0', '3', '1', '2020-01-30 02:43:03', '2020-03-07 19:08:47', null, '1', '0');
INSERT INTO `menu` VALUES ('5', 'Productos', null, 'la la-cubes', '', null, '0', '4', '1', '2020-01-30 02:55:01', '2020-03-07 19:08:19', null, '1', '0');
INSERT INTO `menu` VALUES ('6', 'Clientes', null, 'la la-user', 'clientes', 'clientes.clientes', '0', '5', '1', '2020-01-30 02:55:47', '2020-06-08 07:37:41', null, '1', '0');
INSERT INTO `menu` VALUES ('7', 'Proveedores', null, 'la la-truck', 'proveedores', 'proveedores.proveedores', '0', '6', '1', '2020-01-30 05:21:50', '2020-06-30 19:48:21', null, '1', '0');
INSERT INTO `menu` VALUES ('8', 'Reportes', null, 'la la-file-text', '', null, '0', '7', '1', '2020-01-30 05:22:18', '2020-03-07 23:25:16', null, '1', '0');
INSERT INTO `menu` VALUES ('9', 'Administracion', null, 'la la-gear', '', null, '0', '9', '1', '2020-01-30 05:23:04', '2020-06-12 04:33:11', null, '1', '0');
INSERT INTO `menu` VALUES ('13', 'Registro de Ventas', null, null, 'registro_de_ventas', 'ventas.registro_de_ventas', '3', '1', '1', '2020-02-03 03:45:27', '2020-03-07 19:03:03', null, '1', '0');
INSERT INTO `menu` VALUES ('14', 'Movimiento de Caja', null, null, 'movimiento_de_caja', 'ventas.movimiento_de_caja', '3', '2', '1', '2020-02-03 03:46:00', '2020-03-07 19:03:10', null, '1', '0');
INSERT INTO `menu` VALUES ('15', 'Arqueos de Caja', null, null, 'arqueo_de_caja', 'ventas.arqueo_de_caja', '3', '3', '1', '2020-02-03 03:46:17', '2020-03-07 19:03:16', null, '1', '0');
INSERT INTO `menu` VALUES ('16', 'Propinas', null, null, 'propinas', 'ventas.propinas', '3', '4', '1', '2020-02-03 03:46:32', '2020-03-07 19:03:20', null, '1', '0');
INSERT INTO `menu` VALUES ('17', 'Registro de Gastos', null, null, 'registro_de_gastos', 'gastos.registro_de_gastos', '4', '1', '1', '2020-02-03 04:21:09', '2020-03-07 19:03:26', null, '1', '0');
INSERT INTO `menu` VALUES ('18', 'Cat. de Gastos', 'Categoria de Gastos', null, 'categoria_de_gastos', 'gastos.categoria_de_gastos', '4', '2', '1', '2020-02-03 04:22:01', '2020-03-07 19:03:32', null, '1', '0');
INSERT INTO `menu` VALUES ('19', 'Registro de Productos', null, null, 'registro_de_productos', 'productos.registro_de_productos', '5', '1', '1', '2020-02-03 04:24:43', '2020-03-07 19:03:38', null, '1', '0');
INSERT INTO `menu` VALUES ('20', 'Ingredientes', null, null, 'ingredientes', 'productos.ingredientes', '5', '2', '1', '2020-02-03 04:25:37', '2020-03-07 19:03:42', null, '1', '0');
INSERT INTO `menu` VALUES ('21', 'Cat. de Productos', 'Categorias de Productos', null, 'categoria_de_productos', 'productos.categoria_de_productos', '5', '3', '1', '2020-02-03 04:26:22', '2020-05-15 03:21:03', null, '1', '1');
INSERT INTO `menu` VALUES ('22', 'Cat. de Ingredientes', 'Categorias de Ingredientes', null, 'categoria_de_ingredientes', 'productos.categoria_de_ingredientes', '5', '4', '1', '2020-02-03 04:26:36', '2020-03-07 19:04:01', null, '1', '0');
INSERT INTO `menu` VALUES ('23', 'Control de Stock', null, null, 'control_de_stock', 'productos.control_de_stock', '5', '5', '1', '2020-02-03 04:27:42', '2020-03-07 19:04:07', null, '1', '0');
INSERT INTO `menu` VALUES ('24', 'Kardex', null, null, 'kardex', 'productos.kardex', '5', '6', '1', '2020-02-03 04:27:57', '2020-03-07 19:04:10', null, '1', '0');
INSERT INTO `menu` VALUES ('28', 'Configuracion General', null, null, 'configuracion_general', 'administracion.configuracion_general', '9', '1', '1', '2020-02-03 05:10:40', '2020-03-07 19:11:08', null, '1', '0');
INSERT INTO `menu` VALUES ('29', 'Salas y Mesas', null, null, 'salas_y_mesas', 'administracion.salas_y_mesas', '9', '2', '1', '2020-02-03 05:11:12', '2020-03-07 19:11:32', null, '1', '0');
INSERT INTO `menu` VALUES ('30', 'Usuarios', null, 'la la-users', 'usuarios', 'usuarios.usuarios', '0', '8', '1', '2020-06-12 04:32:57', '2020-06-12 04:33:58', null, '1', '0');
INSERT INTO `menu` VALUES ('31', 'Perfiles de Usuario', null, null, 'perfiles_de_usuario', 'administracion.perfiles_de_usuario', '9', '1', '1', '2020-06-24 05:42:34', '2020-06-24 05:55:49', null, '1', '0');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for `perfil`
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `page_default` varchar(100) DEFAULT '',
  `sucursal_id` bigint(20) DEFAULT NULL,
  `is_root` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Admin', '1', 'pdv.pdv', null, '0', '2020-06-15 06:25:19', '2020-06-15 06:25:19', null);
INSERT INTO `perfil` VALUES ('2', 'Root', '1', 'usuarios.usuarios', null, '1', '2020-06-18 02:52:43', '2020-06-18 02:52:43', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ref_id` bigint(20) DEFAULT NULL,
  `sucursal_id` bigint(20) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_id` (`perfil_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'Heyller Reyes Aranda', '2', 'heyller.ra@gmail.com', null, '$2y$10$4kUwXOblgxFIh3x4mCCrFOUMhmtzsrxP/D59ewzNEME4oOCAF6wBC', null, null, '', '2019-11-24 16:18:57', '2020-06-24 11:32:32', null);
INSERT INTO `users` VALUES ('3', 'Usuario', '1', 'usuario@gmail.com', null, '$2y$07$6JI262/2JA73J2K74J5J4uY2g1uZ4W/L66ZESY0AEQInCw90KOyvq', null, null, '', '2020-06-15 05:05:04', '2020-06-22 10:47:44', '2020-06-22 10:47:44');
INSERT INTO `users` VALUES ('4', 'test2222', '1', 'test@test.com', null, '$2y$07$6JI262/2JA73J2K74J5J4uY2g1uZ4W/L66ZESY0AEQInCw90KOyvq', null, null, '', '2020-06-17 02:56:06', '2020-06-22 10:46:51', '2020-06-22 10:46:51');
INSERT INTO `users` VALUES ('5', 'super', '1', 'super@super.com', null, '$2y$07$6JI262/2JA73J2K74J5J4uY2g1uZ4W/L66ZESY0AEQInCw90KOyvq', null, null, '', '2020-06-17 02:57:13', '2020-06-22 10:49:26', '2020-06-22 10:49:26');
INSERT INTO `users` VALUES ('6', 'test 25', '1', 'test25@gmail.com', null, '$2y$10$Ao8jKzaUQueljpg48g7ACOLdABPiaDgEGEQGdwFVLa0.aU0150d8q', null, null, '', '2020-06-22 10:14:56', '2020-06-22 10:48:33', '2020-06-22 10:48:33');
INSERT INTO `users` VALUES ('7', 'aaaaaaaaaaaaaaa', '1', 'a@faa.com', null, '$2y$10$AOhHH6Jwp/VzdjiNQfTCf.MgfKvAnq2FOdNwQMK5k6VGxvxKn8rU6', null, null, '', '2020-06-22 10:52:28', '2020-06-22 10:52:36', '2020-06-22 10:52:36');
INSERT INTO `users` VALUES ('8', 'Usuario', '1', 'usuario@gmail.com', null, '$2y$10$QvCuGCTwummY3z/exO6dAOv2d4lyFY8poQrGPrZwEcohj7YKhM.l2', null, null, '', '2020-06-22 10:59:42', '2020-06-24 11:33:29', '2020-06-24 11:33:29');
INSERT INTO `users` VALUES ('9', 'aaaaa', '1', 'test25@gmail.com', null, '$2y$10$xYwh7XBpz3BLMKCzmLGvfOZOYE2GkB9BvPlhQjLPxRuJ97mF6VNxy', null, null, '', '2020-06-22 11:00:22', '2020-06-24 08:39:42', '2020-06-24 08:39:42');
INSERT INTO `users` VALUES ('10', 'assssssssssss', '1', 'super@super.com', null, '$2y$10$YxVHqyS2rJsDkWYG4AEKieQqXm9cVpOOWf6FZd2EXdzPvlvffX8rq', null, null, '', '2020-06-22 11:01:21', '2020-06-22 11:01:28', '2020-06-22 11:01:28');
INSERT INTO `users` VALUES ('11', 'aaaaaaa', '1', 'aaaaaa@aaaaa.com', null, '$2y$10$YC9EV0gmxX66.CegMM1XPeLbLGag649eClVxp2WGPtURzf62r2Xxa', null, null, '', '2020-06-24 09:20:30', '2020-06-24 10:30:05', '2020-06-24 10:30:05');
