/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.5.24 : Database - flanelasys
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `fla_clientes` */

DROP TABLE IF EXISTS `fla_clientes`;

CREATE TABLE `fla_clientes` (
  `cod_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_cliente` varchar(100) DEFAULT NULL,
  `cpf_cnpj_cliente` varchar(14) NOT NULL DEFAULT '0',
  `insc_municipal_cliente` varchar(14) NOT NULL DEFAULT '0',
  `insc_estadual_cliente` varchar(14) NOT NULL DEFAULT '0',
  `email_cliente` varchar(150) NOT NULL,
  `cep_cliente` varchar(9) NOT NULL DEFAULT '00000-000',
  `tip_rua_cliente` varchar(15) NOT NULL DEFAULT 'Rua',
  `des_end_cliente` varchar(200) NOT NULL,
  `num_end_cliente` int(6) NOT NULL DEFAULT '0',
  `com_end_cliente` varchar(150) NOT NULL,
  `bairro_end_cliente` varchar(150) NOT NULL,
  `estado_cliente` varchar(2) NOT NULL DEFAULT 'SC',
  `cidade_cliente` varchar(200) NOT NULL DEFAULT 'Blumenau',
  `tipo_cliente` varchar(1) NOT NULL DEFAULT 'R',
  `des_cor` int(6) DEFAULT NULL,
  `des_placa` varchar(8) NOT NULL,
  `cod_modelo` int(6) DEFAULT NULL,
  `cod_marca` int(6) DEFAULT NULL,
  `num_telefone` bigint(15) NOT NULL,
  `num_celular` bigint(15) NOT NULL,
  `ind_ativo` int(1) NOT NULL DEFAULT '1',
  `des_observacao` text NOT NULL,
  `tip_mensalidade` int(6) NOT NULL DEFAULT '0',
  `dat_contratacao` date NOT NULL,
  `dia_vencimento` int(2) NOT NULL,
  PRIMARY KEY (`cod_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_clientes` */

LOCK TABLES `fla_clientes` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_cores` */

DROP TABLE IF EXISTS `fla_cores`;

CREATE TABLE `fla_cores` (
  `cod_cor` int(6) NOT NULL,
  `des_cor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_cor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_cores` */

LOCK TABLES `fla_cores` WRITE;

insert  into `fla_cores`(`cod_cor`,`des_cor`) values (1,'Amarela');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (2,'Azul');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (3,'Bege');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (4,'Bordo');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (5,'Branca');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (6,'Champagne');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (7,'Cinza');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (8,'Dourada');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (9,'Grafite');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (17,'Laranja');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (10,'Marrom');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (11,'Ouro');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (12,'Prata');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (13,'Preta');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (18,'Rosa');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (14,'Roxa');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (15,'Verde');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (16,'Vermelha');
insert  into `fla_cores`(`cod_cor`,`des_cor`) values (0,'Rosa Choque');

UNLOCK TABLES;

/*Table structure for table `fla_descontos` */

DROP TABLE IF EXISTS `fla_descontos`;

CREATE TABLE `fla_descontos` (
  `cod_desconto` int(6) NOT NULL AUTO_INCREMENT,
  `des_desconto` varchar(50) NOT NULL,
  `val_desconto` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`cod_desconto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_descontos` */

LOCK TABLES `fla_descontos` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_empresas` */

DROP TABLE IF EXISTS `fla_empresas`;

CREATE TABLE `fla_empresas` (
  `cod_empresa` int(6) NOT NULL AUTO_INCREMENT,
  `nom_fantasia` varchar(400) NOT NULL,
  `raz_social` varchar(400) NOT NULL,
  `num_cnpj` bigint(14) NOT NULL,
  `num_ie` int(9) NOT NULL,
  `num_insc_municipal` int(15) DEFAULT NULL,
  `cep_empresa` int(8) NOT NULL,
  `des_endereco` varchar(250) NOT NULL,
  `des_bairro` varchar(250) NOT NULL,
  `des_estado` varchar(2) NOT NULL,
  `des_cidade` varchar(250) NOT NULL,
  `num_telefone` bigint(15) NOT NULL,
  `num_celular` bigint(15) NOT NULL,
  `tip_empresa` varchar(1) NOT NULL DEFAULT 'M',
  `ind_disponivel` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `fla_empresas` */

LOCK TABLES `fla_empresas` WRITE;

insert  into `fla_empresas`(`cod_empresa`,`nom_fantasia`,`raz_social`,`num_cnpj`,`num_ie`,`num_insc_municipal`,`cep_empresa`,`des_endereco`,`des_bairro`,`des_estado`,`des_cidade`,`num_telefone`,`num_celular`,`tip_empresa`,`ind_disponivel`) values (4,'Hermann\'s Park Estacionamento','Hermann\'s Park Estacionamento Ltda ME',81606949000131,0,74237,89010320,'Rua Eng Rodolfo Ferraz, 293','Centro','SC','Blumenau',4730352703,4799691810,'M',1);

UNLOCK TABLES;

/*Table structure for table `fla_marcas` */

DROP TABLE IF EXISTS `fla_marcas`;

CREATE TABLE `fla_marcas` (
  `cod_marca` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_marca` varchar(50) DEFAULT NULL,
  `ind_disponivel` int(1) DEFAULT '1',
  `ind_popular` int(1) DEFAULT '0',
  PRIMARY KEY (`cod_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

/*Data for the table `fla_marcas` */

LOCK TABLES `fla_marcas` WRITE;

insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (3,'Alfa Romeo',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (4,'AM Gen',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (5,'Asia Motors',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (6,'Audi',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (7,'BMW',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (8,'BRM',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (9,'Buggy',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (12,'Chrysler',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (13,'Citroën',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (14,'Cross Lander',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (15,'Daewoo',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (16,'Daihatsu',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (17,'Dodge',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (18,'Engesa',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (19,'Envemo',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (20,'Ferrari',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (21,'Fiat',1,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (22,'Ford',1,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (23,'Chevrolet',1,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (24,'Gurgel',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (25,'Honda ',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (26,'Hyundai',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (27,'Isuzu',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (28,'Jaguar',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (29,'Jeep',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (31,'Kia Motors',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (32,'Lada',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (33,'Land Rover',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (34,'Lexus',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (36,'Maserati',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (37,'Matra',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (38,'Mazda',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (39,'Mercedes-Benz',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (41,'Mitsubishi',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (43,'Nissan',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (44,'Peugeot',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (47,'Porsche',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (48,'Renault',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (52,'Seat',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (54,'Subaru',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (55,'Suzuki',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (56,'Toyota',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (57,'Troller',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (58,'Volvo',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (59,'VolksWagen',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (120,'Walk',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (123,'Bugre',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (125,'SSANGYONG',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (127,'LOBINI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (136,'CHANA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (140,'Mahindra',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (147,'EFFA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (149,'Fibravan',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (152,'HAFEI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (153,'GREAT WALL',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (154,'JINBEI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (60,'ADLY',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (61,'AGRALE',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (62,'APRILIA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (63,'ATALA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (64,'BAJAJ',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (65,'BETA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (66,'BIMOTA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (67,'BMW',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (68,'BRANDY',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (69,'byCristo',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (70,'CAGIVA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (71,'CALOI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (72,'DAELIM',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (73,'DERBI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (74,'DUCATI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (75,'EMME',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (76,'GAS GAS',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (77,'HARLEY-DAVIDSON',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (78,'HARTFORD',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (79,'HERO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (80,'HONDA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (81,'HUSABERG',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (82,'HUSQVARNA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (85,'KAWASAKI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (86,'KIMCO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (87,'KTM',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (88,'L\'AQUILA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (89,'LAVRALE',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (90,'MOTO GUZZI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (91,'MV AGUSTA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (92,'MVK',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (93,'ORCA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (94,'PEUGEOT',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (95,'PIAGGIO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (96,'SANYANG',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (97,'SIAMOTO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (98,'SUNDOWN',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (99,'SUZUKI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (100,'TRIUMPH',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (101,'YAMAHA',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (117,'BUELL',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (118,'KASINSKI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (119,'TRAXX',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (126,'MIZA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (128,'FYM',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (129,'KAHENA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (130,'BRAVA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (131,'AMAZONAS',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (132,'FOX',0,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (133,'GREEN',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (134,'SHINERAY',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (135,'WUYANG',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (137,'DAYANG',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (138,'HAOBAO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (139,'LERIVO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (141,'JIAPENG VOLCANO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (142,'DAYUN',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (143,'GARINNI',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (145,'DAFRA',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (146,'Malaguti',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (148,'Lon-V',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (150,'BRP',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (151,'JONNY',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (102,'Agrale.',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (103,'Chevrolet Caminhões',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (104,'FIAT',0,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (105,'FORD',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (106,'GMC',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (108,'MARCOPOLO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (109,'MERCEDES-BENZ',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (110,'NAVISTAR',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (111,'NEOBUS',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (112,'PUMA-ALFA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (113,'SAAB-SCANIA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (114,'SCANIA',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (115,'VOLKSWAGEN (Caminhão)',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (116,'VOLVO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (121,'CICCOBUS',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (122,'IVECO',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (144,'WALKBUS',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (0,'Não informado',0,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (156,'Sundown',1,1);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (157,'Cherry',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (158,'Jac Motors',1,0);
insert  into `fla_marcas`(`cod_marca`,`des_marca`,`ind_disponivel`,`ind_popular`) values (159,'Mini',1,0);

UNLOCK TABLES;

/*Table structure for table `fla_mensalidade` */

DROP TABLE IF EXISTS `fla_mensalidade`;

CREATE TABLE `fla_mensalidade` (
  `cod_mensalidade` int(6) NOT NULL AUTO_INCREMENT,
  `des_mensalidade` varchar(200) NOT NULL,
  `val_mensalidade` float(5,2) NOT NULL,
  `ind_ativo` int(1) NOT NULL DEFAULT '1',
  `dat_criacao` date NOT NULL,
  PRIMARY KEY (`cod_mensalidade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_mensalidade` */

LOCK TABLES `fla_mensalidade` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_mensalidade_usuario` */

DROP TABLE IF EXISTS `fla_mensalidade_usuario`;

CREATE TABLE `fla_mensalidade_usuario` (
  `cod_mensalidade_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `valor_pago` float(5,2) NOT NULL,
  `periodo_inicial` date NOT NULL,
  `periodo_final` date NOT NULL,
  `data_pagamento` date NOT NULL,
  `des_justificativa` varchar(200) NOT NULL,
  `cod_cliente` int(6) NOT NULL,
  `cod_mensalidade` int(6) NOT NULL,
  PRIMARY KEY (`cod_mensalidade_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_mensalidade_usuario` */

LOCK TABLES `fla_mensalidade_usuario` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_modelos` */

DROP TABLE IF EXISTS `fla_modelos`;

CREATE TABLE `fla_modelos` (
  `cod_modelo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_modelo` varchar(50) NOT NULL,
  `cod_marca` int(10) NOT NULL,
  `ind_disponivel` int(1) DEFAULT '1',
  `ind_popular` int(1) DEFAULT '0',
  PRIMARY KEY (`cod_modelo`)
) ENGINE=MyISAM AUTO_INCREMENT=1503 DEFAULT CHARSET=latin1;

/*Data for the table `fla_modelos` */

LOCK TABLES `fla_modelos` WRITE;

insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1,'100',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (2,'106',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (3,'1098',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (4,'11-130',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (5,'11-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (6,'11000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (7,'1114',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (8,'1125R',117,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (9,'12-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (10,'12-170',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (11,'12-170',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (12,'12-180',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (13,'12000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (14,'120i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (15,'120iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (16,'1214',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (17,'1215',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (18,'1218',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (19,'125',129,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (20,'13-130',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (21,'13-150',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (22,'13-170/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (23,'13-180',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (24,'13-180/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (25,'13-190',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (26,'13000',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (27,'13000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (28,'130i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (29,'130iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (30,'1318',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (31,'14-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (32,'14-150',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (33,'14-170',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (34,'14-180',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (35,'14-190',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (36,'14-200',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (37,'14-210',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (38,'14-220',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (39,'14000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (40,'1414',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (41,'1418',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (42,'1420',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (43,'145',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (44,'147',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (45,'147',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (46,'15-170/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (47,'15-180',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (48,'15-180/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (49,'15-190',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (50,'15-190',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (51,'150T-3',132,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (52,'155',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (53,'156',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (54,'16-170',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (55,'16-200',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (56,'16-210',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (57,'16-220',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (58,'16-220',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (59,'16-300',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (60,'1600',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (61,'164',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (62,'166',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (63,'17-180',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (64,'17-210',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (65,'17-220/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (66,'17-250',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (67,'17-300',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (68,'17-310',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (69,'1714',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (70,'1718',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (71,'1718-A',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (72,'1718-K',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (73,'1718-M',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (74,'1720',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (75,'1720-A',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (76,'1720-K',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (77,'1721/',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (78,'1723',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (79,'1723-S',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (80,'1728',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (81,'18-310',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (82,'180-D',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (83,'1800',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (85,'19-320',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (86,'19-370',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (87,'190',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (88,'190-E',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (89,'19000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (90,'1938-S',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (91,'1944-S',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (92,'2038',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (93,'205',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (94,'206',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (95,'207',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (97,'21000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (98,'22-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (99,'22-160',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (100,'22-210',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (101,'22000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (102,'23-210',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (103,'23-220',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (104,'23-250',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (105,'23-310',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (106,'230-E',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (107,'2300',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (108,'24-220/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (109,'24-250',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (110,'24-250/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (111,'2418',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (112,'2423',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (113,'2428',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (114,'25-320',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (115,'25-370',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (116,'250',129,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (117,'250T-10',132,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (118,'26-220',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (119,'26-260',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (120,'26-260/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (121,'26-300',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (122,'26-310',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (123,'260-E',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (124,'2638',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (125,'2726',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (126,'300',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (127,'300-D',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (128,'300-E',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (129,'300-SE',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (130,'300-SL',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (131,'300-TE',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (132,'3000',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (133,'306',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (134,'307',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (135,'31-260',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (136,'31-260/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (137,'31-310',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (138,'31-320',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (139,'31-370',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (140,'316',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (141,'318i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (142,'318i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (143,'318iS/ISA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (144,'318Ti',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (145,'318Ti/TiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (146,'3200',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (147,'320i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (148,'320iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (149,'323',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (150,'323Ci',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (151,'323CiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (152,'323i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (153,'323i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (154,'323iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (155,'323Ti',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (156,'323TiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (157,'325i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (158,'325i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (159,'325iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (160,'328i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (161,'328i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (162,'328iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (163,'330Ci',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (164,'330CiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (165,'330i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (166,'330iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (167,'335iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (168,'35-300',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (169,'3500',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (170,'350Z',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (171,'355',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (172,'360',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (173,'40-300',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (174,'405',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (175,'406',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (176,'407',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (177,'440',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (178,'4500',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (179,'456',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (180,'460',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (181,'5-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (182,'5-90',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (183,'500-E',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (184,'500-SEL',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (185,'5000',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (186,'504',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (187,'505',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (188,'520i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (189,'525i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (190,'528i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (191,'528IA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (192,'530i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (193,'535i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (194,'540i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (195,'540i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (196,'540iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (197,'540iTA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (198,'545iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (199,'550',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (200,'550iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (201,'560-SEL',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (202,'575M',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (203,'6-100',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (204,'6-150',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (205,'6-80',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (206,'6-90',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (207,'6000',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (208,'6000',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (209,'605',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (210,'607',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (211,'608',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (212,'612',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (213,'626',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (214,'645Ci',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (215,'645iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (216,'650Ci',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (217,'650iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (218,'7-100',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (219,'7-110',106,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (220,'7-110',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (221,'7-90',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (222,'7000',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (223,'708',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (224,'709',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (225,'710/',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (226,'712',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (227,'730i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (228,'730iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (229,'735i/iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (230,'740i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (231,'740iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (232,'740iL/iLA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (233,'740iLA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (234,'745iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (235,'749',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (236,'750',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (237,'7500',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (238,'750i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (239,'750iA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (240,'750iL',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (241,'760iL',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (242,'7900',112,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (243,'8-100',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (244,'8-120/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (245,'8-140',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (246,'8-150',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (247,'8-150/',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (248,'80',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (249,'8000',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (250,'806',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (251,'807',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (252,'840Ci',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (253,'840CiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (254,'850',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (255,'8500',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (256,'850Ci/CiA',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (257,'850CSi',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (258,'850i',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (259,'9-150',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (260,'9000',112,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (261,'911',47,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (262,'912',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (263,'914',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (264,'914',112,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (265,'914-C',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (266,'9200',102,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (267,'928',47,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (268,'929',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (269,'940',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (270,'960',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (271,'968',47,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (272,'996',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (273,'998',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (274,'999',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (275,'999R',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (276,'A-10',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (277,'A-20',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (278,'A3',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (279,'A4',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (280,'A5',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (281,'A6',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (282,'A8',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (283,'Accelo',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (284,'Accent',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (285,'Accord',25,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (286,'ACTYON',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (287,'ADDRESS/AE',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (288,'ADDRESS/AG',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (289,'ADVENTURE',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (290,'ADVENTURER',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (291,'Aerostar',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (292,'Airtrek',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (293,'AKROS',88,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (294,'AKROS',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (295,'Alleanza',121,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (296,'Allroad',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (297,'Altima',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (298,'ALTINO',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (299,'AM-825',5,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (300,'AME-110',131,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (301,'AME-150',131,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (302,'AME-250',131,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (303,'AME-LX',131,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (304,'AMERICA',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (305,'Amigo',27,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (306,'AN',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (307,'ANKUR',79,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (308,'Apolo',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (309,'Applause',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (310,'AREA-51',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (311,'Aspire',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (312,'Astra',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (313,'Atego',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (314,'ATILIS',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (315,'ATLANTIC',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (316,'ATLANTIS',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (317,'Atos',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (318,'RT',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (319,'AVAJET',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (320,'Avalon',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (321,'Avant',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (322,'Avenger',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (323,'AX',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (324,'AX',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (325,'AX',93,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (326,'AXIS',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (327,'Axor',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (328,'AZERA',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (329,'B-2500',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (330,'B2200',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (331,'Baleno',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (332,'Band.',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (333,'Band.Jipe',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (334,'Band.Picape',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (335,'BANDIT',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (336,'Belina',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (337,'Berlingo',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (338,'Besta',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (339,'BEVERLY',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (340,'BIZ',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (341,'BLACK',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (342,'Blazer',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (343,'Bonanza',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (344,'Bongo',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (345,'BONNEVILLE',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (346,'Bora',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (347,'BOULEVARD',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (348,'Boxer',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (349,'Boxster',47,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (350,'BR-800',24,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (351,'Brasinca',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (352,'Brava',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (353,'Bravo',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (354,'BRUTALE',91,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (355,'Buggy',8,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (356,'Buggy',9,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (357,'Buggy',120,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (358,'Buggy',123,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (359,'Buggy',149,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (360,'BURGMAN',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (361,'BUXY',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (362,'BW\'S',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (363,'BX',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (364,'C',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (365,'C-10',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (366,'C-180',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (367,'C-20',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (368,'C-200',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (369,'C-220',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (370,'C-230',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (371,'C-240',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (372,'C-280',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (373,'C-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (374,'C-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (375,'C-36',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (376,'C-43',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (377,'C-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (378,'C-60',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (379,'C-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (380,'C3',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (381,'C30',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (382,'C4',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (383,'C5',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (384,'C6',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (385,'C70',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (386,'C8',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (387,'Calibra',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (388,'CALIFFONE',63,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (389,'CALIFORNIA',90,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (390,'Camper',19,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (391,'Camry',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (392,'can-am',150,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (393,'CANYON',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (394,'Caprice',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (395,'CAPTIVA',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (396,'Carajas',24,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (397,'Carajas/',24,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (398,'Caravan',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (399,'Caravan',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (400,'Caravelle',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (401,'Carens',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (402,'CARGO',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (403,'Cargo',136,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (404,'Carnival',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (405,'Cavalier',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (407,'Cayman',47,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (408,'CB',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (409,'CB1300',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (410,'CBR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (411,'CBX',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (412,'Celica',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (413,'Celta',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (414,'Cerato',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (415,'Ceres',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (416,'CG',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (417,'CH',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (418,'Chairman',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (419,'Classic',65,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (420,'Charade',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (421,'Cherokee',29,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (422,'Chevette',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (423,'Chevy',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (424,'Cheynne',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (425,'CIAK',146,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (426,'Cinquecento',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (427,'Cirrus',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (428,'CITY',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (429,'CityClass',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (430,'Civic',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (431,'CJ',119,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (432,'CL-244',14,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (433,'CL-330',14,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (434,'CL-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (435,'CL-600',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (436,'CL-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (437,'Clarus',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (438,'Classe',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (439,'Classic',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (440,'CLASSIC',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (441,'Classic',64,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (442,'Clio',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (443,'CLK-230',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (444,'CLK-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (445,'CLK-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (446,'CLK-430',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (447,'CLK-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (448,'CLK-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (449,'CLS-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (450,'CLS-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (451,'CLS-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (452,'CLS-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (453,'Club',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (454,'Colt',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (455,'Comet',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (456,'Commander',29,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (457,'CONCOURS14',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (458,'Contour',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (459,'Corcel II',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (460,'Cordoba',52,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (461,'Corola',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (462,'Corolla',56,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (463,'Corona',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (464,'Corrado',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (465,'Corsa',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (466,'Corvette',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (467,'Coupe',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (468,'Coupê',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (469,'Coupé',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (470,'Courier',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (471,'CR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (472,'CR',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (473,'CR-V',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (474,'CRF',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (475,'CROSSFOX',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (476,'Crown',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (477,'CRUISE',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (478,'CRYPTON',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (479,'Cuore',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (480,'Cupê',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (481,'D-10',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (482,'D-20',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (483,'D-21',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (484,'D-40',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (485,'D-60',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (486,'D-70',103,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (487,'DAILY',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (488,'Daimler',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (489,'DAKAR',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (490,'Dakota',17,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (491,'DAYTONA',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (492,'DB4',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (493,'DB5R',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (494,'DB6',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (495,'DB6R',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (496,'Defender',33,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (497,'Del',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (498,'DEUCE',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (499,'Diamant',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (500,'Discovery',33,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (501,'Discovery3',33,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (502,'DJW',86,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (503,'DL',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (504,'Doblo',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (505,'DOMINATOR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (506,'DR',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (507,'DR-Z400E',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (508,'DRAGO',126,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (509,'DT',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (510,'DUAL',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (511,'Ducato',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (512,'Ducato-10',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (513,'Ducato-15',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (514,'Ducato-8',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (515,'DUKE',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (516,'Duna',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (517,'DY100-31',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (518,'DY110-20',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (519,'DY110-6',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (520,'DY125-18',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (521,'DY125-37',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (522,'DY125-52',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (523,'DY125-8',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (524,'DY125T-10',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (525,'DY150-12',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (526,'DY150-7',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (527,'DY150-9',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (528,'DY150GY',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (529,'DY150ZH',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (530,'DY200',137,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (531,'DY250-2',142,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (532,'DYNA',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (533,'E-190',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (534,'E-200',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (535,'E-220',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (536,'E-230',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (537,'E-240',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (538,'E-280',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (539,'E-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (540,'E-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (541,'E-420',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (542,'E-430',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (543,'E-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (544,'E-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (545,'E-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (546,'EASY',126,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (547,'EASY',133,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (548,'EC',76,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (549,'Eclipse',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (550,'EcoSport',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (551,'EDGE',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (552,'EG',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (553,'Elantra',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (554,'Elba',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (555,'ELECTRA',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (556,'ELEFANT',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (557,'ELEFANT',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (558,'ELEFANTRE',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (559,'ELEGANT',68,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (560,'ELYSEO',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (561,'EN',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (562,'Engesa',18,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (563,'ENJOY',96,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (564,'ER-5',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (565,'ERGON',88,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (566,'ERGON',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (567,'ERO',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (568,'ES-300',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (569,'ES-330',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (570,'ES-350',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (571,'Escort',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (572,'Espero',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (573,'EUROCARGO',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (574,'EUROTECH',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (575,'EUROTRAKKER',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (576,'Eurovan',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (577,'Evasion',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (578,'EXC',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (579,'Excel',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (580,'Expedition',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (581,'Explorer',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (582,'Expo',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (583,'Express',48,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (584,'F',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (585,'F-100',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (586,'F-1000',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (587,'F-11000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (588,'F-12000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (589,'F-13000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (590,'F-14000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (591,'F-150',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (592,'F-16000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (593,'F-19000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (594,'F-2000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (595,'F-21000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (596,'F-22000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (597,'F-250',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (598,'F-350',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (599,'F-4000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (600,'F-7000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (601,'F4',91,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (602,'F4-',91,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (603,'F4-1000',91,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (604,'F430',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (605,'F599',20,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (606,'Family',136,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (607,'FAST',126,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (608,'FAT',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (609,'FAZER',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (610,'FE',81,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (611,'FENIX',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (612,'Feroza',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (613,'FH',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (614,'FH-12',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (615,'Fiesta',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (616,'FIFTY',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (617,'Fiorino',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (618,'FIREBOLT',117,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (619,'Fit',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (620,'FLASH',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (621,'FLHTCU',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (622,'FLHTCUI',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (623,'FM',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (624,'FM-10',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (625,'FM-12',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (626,'Focus',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (627,'FORCE',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (628,'Forester',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (629,'Formigão',139,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (630,'FOSTI',68,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (631,'Fox',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (632,'FOX',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (633,'Freelander',33,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (634,'FREEWIND',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (635,'Frontier',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (636,'FÚRIA',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (637,'Fusca',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (638,'Fusion',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (639,'Future',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (640,'FY100-10A',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (641,'FY125-19',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (642,'FY125-20',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (643,'FY125EY-2',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (644,'FY125Y-3',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (645,'FY150-3',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (646,'FY150T-18',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (647,'FY250',128,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (648,'FZ6',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (649,'FZR',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (650,'G',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (651,'G-380',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (652,'G-420',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (653,'G-440',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (654,'G-470',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (655,'Galant',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (656,'Galloper',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (657,'GF',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (658,'GL-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (659,'GLK',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (660,'GO',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (661,'Gol',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (662,'GOLD',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (663,'Golf',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (664,'GPR',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (665,'GR08T4',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (666,'GR125ST',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (667,'GR125T3',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (668,'GR125U',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (669,'GR125Z',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (670,'GR150P/',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (671,'GR150ST',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (672,'GR150T3/',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (673,'GR150U',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (674,'GR250T3',143,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (675,'Gran',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (676,'Gran',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (677,'GRAN',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (678,'Grand',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (679,'Grand',29,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (680,'Grand',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (681,'Grand',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (682,'GRANDIS',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (683,'GranSport',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (684,'GranTurismo',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (685,'GS',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (686,'GS',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (687,'GSX',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (688,'GSX-R',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (689,'GV',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (690,'H1',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (691,'H1',127,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (692,'H100',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (693,'HALLEY',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (694,'HB110-3',138,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (695,'HB125-9',138,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (696,'HB150',138,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (697,'HB150-T',138,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (698,'HERITAGE',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (699,'Hi-Topic',5,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (700,'Hilux',56,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (701,'Hombre',27,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (702,'HOVER',153,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (703,'HR',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (704,'Hummer',4,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (705,'HUNTER',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (706,'HUSKY',96,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (707,'HUSQY',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (708,'HYPE',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (709,'Ibiza',52,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (710,'Idea',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (711,'Ignis',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (712,'Impreza',54,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (713,'Inca',52,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (714,'Infinit',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (715,'INTERNACIONAL',110,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (716,'INTERNATIONAL',110,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (717,'INTRUDER',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (718,'Ipanema',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (719,'Istana',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (720,'RT',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (721,'JC',93,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (722,'Jetta',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (723,'JH',119,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (724,'Jimny',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (725,'Jipe',5,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (726,'JL',119,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (727,'JOG',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (728,'JONNY',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (729,'JOURNEY',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (730,'JP',141,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (731,'Jumper',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (732,'JUNIOR',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (733,'K',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (734,'KA',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (735,'Kadett',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (736,'Kangoo',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (737,'Kansas',145,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (738,'KATANA',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (739,'King-Cab',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (740,'KLX',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (741,'Kombi',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (742,'Korando',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (743,'KX',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (744,'Kyron',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (745,'KZ',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (746,'L-111',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (747,'L-1113',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (748,'L-1114',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (749,'L-1117',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (750,'L-1118',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (751,'L-1214',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (752,'L-1218',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (753,'L-1313',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (754,'L-1314',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (755,'L-1316',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (756,'L-1317',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (757,'L-1318',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (758,'L-1319',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (759,'L-141',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (760,'L-1414',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (761,'L-1418',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (762,'L-1513',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (763,'L-1514',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (764,'L-1516',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (765,'L-1517',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (766,'L-1518',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (767,'L-1519',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (768,'L-1520',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (769,'L-1614',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (770,'L-1618',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (771,'L-1620',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (772,'L-1621',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (773,'L-1622',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (774,'L-1625',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (775,'L-1630',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (776,'L-2013',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (777,'L-2014',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (778,'L-2017',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (779,'L-2213',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (780,'L-2214',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (781,'L-2215',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (782,'L-2216',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (783,'L-2217',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (784,'L-2219',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (785,'L-2220',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (786,'L-2225',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (787,'L-2314',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (788,'L-2318',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (789,'L-2325',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (790,'L-2635',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (791,'L-2638',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (792,'L-80',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (793,'L200',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (794,'L300',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (795,'Laguna',48,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (796,'Laika',32,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (797,'Lancer',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (798,'Land',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (799,'Lanos',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (800,'LASER',145,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (801,'LC4',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (802,'LE',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (803,'Legacy',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (804,'Leganza',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (805,'LEGEND',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (806,'LEGION',78,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (807,'LEONARDO',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (808,'Lets',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (809,'Liberty',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (810,'LIGHTNING',117,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (811,'LINEA',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (812,'LK-1618',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (813,'LK-1620',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (814,'LK-2635',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (815,'LK-2638',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (816,'LOGAN',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (817,'Logus',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (818,'LS',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (819,'LS-1313',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (820,'LS-1519',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (821,'LS-1520',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (822,'LS-1524',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (823,'LS-1525',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (824,'LS-1625',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (825,'LS-1630',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (826,'LS-1632',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (827,'LS-1634',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (828,'LS-1924',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (829,'LS-1929',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (830,'LS-1932',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (831,'LS-1933',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (832,'LS-1934',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (833,'LS-1935',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (834,'LS-1938',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (835,'LS-1941',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (836,'LS-2635',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (837,'LS-2638',109,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (838,'LT',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (839,'Lumina',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (840,'LY',148,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (841,'M',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (842,'M-100',147,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (843,'M3',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (844,'M5',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (845,'M6',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (846,'MA',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (847,'MA/',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (848,'Magentis',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (849,'MAGIK',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (850,'MAGNA',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (851,'MAJESTY',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (852,'MANTRA',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (853,'Marajo',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (854,'MARAUDER',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (855,'Marea',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (856,'MARRUÁ',2,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (857,'Master',19,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (858,'Master',48,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (859,'MASTER',63,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (860,'Matrix',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (861,'MAX',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (862,'MAXI',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (863,'Maxima',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (864,'MC',76,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (865,'Megane',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (866,'Meriva',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (867,'MESSAGE',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (868,'Micra',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (869,'MIDAS',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (870,'Millenia',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (871,'Mirage',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (872,'MIRAGE',75,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (873,'Mirage',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (874,'MITO',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (875,'ML-230',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (876,'ML-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (877,'ML-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (878,'ML-430',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (879,'ML-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (880,'ML-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (881,'ML-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (882,'MOBILETE',71,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (883,'Mondeo',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (884,'MONDO',71,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (885,'MONSTER',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (886,'MONTANA',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (887,'Montero',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (888,'Monza',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (889,'MOTO',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (890,'MOTOKAR',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (891,'Move',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (892,'MP3',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (893,'MPV',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (894,'MR-2',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (895,'MT-01',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (896,'MT-03',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (897,'MultiStrada',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (898,'MultStrada',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (899,'MURANO',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (900,'Musso',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (901,'Mustang',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (902,'MX-3',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (903,'MX-5',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (904,'MX-50',65,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (905,'M´BOY',86,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (906,'N-10',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (907,'N-12',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (908,'Navajo',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (909,'NAVIGATOR',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (910,'NEO',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (911,'Neon',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (912,'New',33,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (913,'New',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (914,'NH-12',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (915,'NIGHT',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (916,'NINJA',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (917,'Niva',32,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (918,'NIX',88,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (919,'NL-10',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (920,'NL-12',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (921,'NRG',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (922,'Nubira',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (923,'NX',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (924,'NX',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (925,'NX-4',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (926,'NXR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (927,'Odyssey',25,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (928,'Oggi',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (929,'Omega',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (930,'ONE',75,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (931,'Opala',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (932,'Opirus',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (933,'Orbit',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (934,'Outback',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (935,'OUTLANDER',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (936,'P-114',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (937,'P-124',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (938,'P-270',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (939,'P-310',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (940,'P-340',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (941,'P-420',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (942,'P-93',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (943,'P-94',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (944,'Pajero',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (945,'Palio',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (946,'PALIO',88,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (947,'PALIO',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (948,'Pampa',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (949,'PAMPERA',76,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (950,'Panorama',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (951,'PANTANAL',57,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (952,'Parati',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (953,'Partner',44,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (954,'Paseo',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (955,'Passat',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (956,'PASSING',96,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (957,'Passport',25,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (958,'Pathfinder',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (959,'PEGASO',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (960,'PEGASUS',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (961,'PEOPLE',86,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (962,'PGO',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (963,'Phanter',144,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (964,'Picanto',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (965,'Pick-Up',37,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (966,'Pick-Up',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (967,'PISTA',68,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (968,'PLANET',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (969,'Pointer',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (970,'Polo',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (971,'POP',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (972,'Porter',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (973,'POWERSTAR',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (974,'PREDATOR',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (975,'Prelude',25,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (976,'Premio',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (977,'Previa',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (978,'PRIMA',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (979,'Primera',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (980,'Prince',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (981,'PRISMA',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (982,'Probe',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (983,'Protegé',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (984,'PT',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (985,'PUCH',79,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (986,'Punto',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (987,'Q7',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (988,'QM',93,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (989,'Quantum',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (990,'QUATTOR',89,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (991,'Quattroporte',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (992,'Quest',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (993,'QUOTA',90,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (994,'R',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (995,'R-112',113,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (996,'R-113',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (997,'R-114',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (998,'R-124',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (999,'R-142',113,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1000,'R-143',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1001,'R-164',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1002,'R-420',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1003,'R-440',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1004,'R-470',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1005,'R-500',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1006,'Racer',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1007,'RALLY',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1008,'Ram',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1009,'Range',33,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1010,'Ranger',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1011,'RAV4',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1012,'RD',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1013,'RDZ',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1014,'RED',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1015,'REPLICAS',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1016,'Rexton',125,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1017,'RF',57,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1018,'RF',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1019,'RM',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1020,'RMX',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1021,'ROAD',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1022,'ROADSTER',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1023,'ROCKET',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1024,'Rodeo',27,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1025,'ROYAL',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1026,'Royale',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1027,'RS',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1028,'RS4',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1029,'RS6',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1030,'RSV',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1031,'RT',60,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1032,'RUNNER',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1033,'RUNNER',133,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1034,'RX',34,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1035,'RX',38,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1036,'RX',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1037,'RX',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1038,'S-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1039,'S-420',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1040,'S-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1041,'S-500L',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1042,'S-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1043,'S-600',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1044,'S-600/',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1045,'S-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1046,'S-65',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1047,'S-Type',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1048,'S10',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1049,'S3',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1050,'S4',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1051,'S40',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1052,'S6',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1053,'S60',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1054,'S70',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1055,'S8',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1056,'S80',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1057,'SAFARI',133,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1058,'Safrane',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1059,'Samurai',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1060,'SANDERO',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1061,'Santa Fe',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1062,'Santana',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1063,'Saturn',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1064,'SAVAGE',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1065,'Saveiro',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1066,'SBR8',66,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1067,'SC',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1068,'SCARABEO',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1069,'Scenic',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1070,'SCOOT\'ELEC',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1071,'SCORPIO',140,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1072,'Scoupe',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1073,'SCRAMBLER',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1074,'SCROSS',97,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1075,'SE-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1076,'Sebring',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1077,'SENDA',73,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1078,'Sentra',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1079,'Sephia',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1080,'SETA',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1081,'SHADOW',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1082,'Shamal',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1083,'Shuma',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1084,'Sidekick',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1085,'Siena',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1086,'Sierra',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1087,'Silverado',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1088,'SKEGIA',63,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1089,'Skema',126,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1090,'SL-280',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1091,'SL-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1092,'SL-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1093,'SL-500',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1094,'SL-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1095,'SL-600',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1096,'SL-63',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1097,'SL-65',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1098,'SLK-200',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1099,'SLK-230',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1100,'SLK-320',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1101,'SLK-350',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1102,'SLK-55',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1103,'SM',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1104,'SMR',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1105,'SOFTAIL',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1106,'Sonata',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1107,'SONIC',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1108,'Sorento',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1109,'Space',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1110,'SPACEFOX',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1111,'SpaceVan',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1112,'SPEED',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1113,'SPEED',145,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1114,'SPEEDAKE',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1115,'SPEEDFIGHT',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1116,'Spider',3,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1117,'Spider',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1118,'SPIDER',146,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1119,'SPORT',133,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1120,'Sportage',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1121,'SportClassic',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1122,'SPORTSTER',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1123,'SPRINGER',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1124,'SPRINT',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1125,'Sprinter',39,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1126,'Spyder',36,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1127,'SPYDER',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1128,'SQUAB',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1129,'SR',62,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1130,'SS',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1131,'SS10',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1132,'SST',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1133,'ST-2',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1134,'ST-4',74,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1135,'Stanza',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1136,'Stealth',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1137,'Stilo',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1138,'Strada',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1139,'Strada/',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1140,'STRALIS',122,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1141,'Stratus',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1142,'STREAM',79,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1143,'STREET',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1144,'STREET',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1145,'STX',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1146,'Suburban',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1147,'Super',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1148,'Super',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1149,'SUPER',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1150,'SUPER',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1151,'SUPER',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1152,'SUPER',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1153,'SUPER',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1154,'SUPER',145,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1155,'SUPERDUKE',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1156,'SUPERMOTO',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1157,'Supra',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1158,'Suprema',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1159,'SVX',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1160,'Swift',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1161,'SX',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1162,'SX',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1163,'SXC',87,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1164,'SXT',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1165,'Syclone',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1166,'T-100',56,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1167,'T-112',113,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1168,'T-112',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1169,'T-113',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1170,'T-114',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1171,'T-124',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1172,'T-142',113,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1173,'T-143',114,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1174,'T-4',57,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1175,'T.BOY/',111,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1176,'Taurus',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1177,'TC',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1178,'TCHAU',61,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1179,'TDM',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1180,'TDR',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1181,'TE',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1182,'Tempra',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1183,'Terios',16,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1184,'Terracan',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1185,'Terrano',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1186,'THRUXTON',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1187,'THUNDER',111,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1188,'Thunderbird',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1189,'THUNDERBIRD',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1190,'Tico',15,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1191,'TIGER',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1192,'Tigra',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1193,'TIIDA',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1194,'Tipo',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1195,'TL',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1196,'TN',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1197,'Topic',5,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1198,'TOUAREG',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1199,'TOWN',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1200,'Towner',5,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1201,'Towner',152,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1202,'TR',151,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1203,'Tracker',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1204,'Trafic',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1205,'Trafic',48,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1206,'Trajet',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1207,'TREKKER',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1208,'TRIBECA',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1209,'Triciclo',69,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1210,'TRIDENT',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1211,'TROPHY',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1212,'TRX',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1213,'TRX',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1214,'TT',6,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1215,'TT',100,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1216,'TT-R',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1217,'Tucson',26,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1218,'TURBO',68,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1219,'Twingo',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1220,'TX',76,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1221,'TXT',76,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1222,'ULC',147,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1223,'ULYSSES',117,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1224,'Uno',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1225,'Utility',136,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1226,'V-MAX',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1227,'V-RAPTOR',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1228,'V-ROD',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1229,'V11',90,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1230,'V40',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1231,'V50',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1232,'V70',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1233,'VALKYRIE',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1234,'Van',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1235,'Vblade',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1236,'VC',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1237,'Vectra',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1238,'VERACRUZ',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1239,'Veraneio',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1240,'Verona',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1241,'Versailles',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1242,'VESPA',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1243,'VF',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1244,'Vision',12,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1245,'Vitara',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1246,'VITE',126,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1247,'VIVACITY',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1248,'Vivio',54,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1249,'VM',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1250,'VM-17',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1251,'VM-23',116,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1252,'VOLARE',108,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1253,'Voyage',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1254,'VOYAGER',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1255,'VS',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1256,'VT',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1257,'VT',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1258,'VTX',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1259,'VULCAN',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1260,'VX',72,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1261,'VX',99,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1262,'W-16',70,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1263,'Wagon',55,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1264,'WAY',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1265,'Web',98,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1266,'WIN',118,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1267,'Windstar',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1268,'WR',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1269,'WR',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1270,'Wrangler',29,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1271,'WRE',82,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1272,'WY',135,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1273,'X-TRAIL',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1274,'X-Type',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1275,'X3',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1276,'X5',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1277,'X6',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1278,'Xantia',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1279,'XC',58,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1280,'XF',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1281,'XJ',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1282,'XJ',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1283,'XJ-12',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1284,'XJ-6',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1285,'XJ-8',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1286,'XJR',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1287,'XJR',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1288,'XJS',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1289,'XJS-C',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1290,'XK-8',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1291,'XKR',28,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1292,'XL',77,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1293,'XL',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1294,'XLR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1295,'XLX',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1296,'XM',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1297,'XR',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1298,'XRT',92,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1299,'Xsara',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1300,'XT',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1301,'XTerra',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1302,'XTZ',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1303,'XV',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1304,'XVS',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1305,'XY',134,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1306,'YB',130,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1307,'YBR',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1308,'YFM',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1309,'YFS',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1310,'YFZ',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1311,'YS',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1312,'YZ',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1313,'YZF',101,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1314,'Z',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1315,'Z3',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1316,'Z4',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1317,'Z8',7,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1318,'Zafira',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1319,'ZANELLA',68,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1320,'ZENITH',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1321,'ZING',86,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1322,'ZIP',95,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1323,'ZX',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1324,'ZX',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1325,'ZX-14',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1326,'ZZR',85,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (0,'Não informado',0,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1328,'TL 1975',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1329,'Brasilia',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1330,'Corcel I',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1331,'face',157,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1371,'500 FIAT',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1370,'500 FIAT',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1369,'Amarok',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1368,'Amarok',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1332,'Tornado',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1333,'Bross',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1334,'CG ',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1335,'Biz',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1336,'F 1000',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1337,'TIGUAN',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1338,'TIGUAN',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1339,'TIGUAN',115,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1340,'Paio Wellken',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1341,'TIGUAN',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1342,'Pálio Welken',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1343,'Pálio Welken',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1344,'Palio Weekend',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1345,'Palio Weekend',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1346,'Outlander',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1347,'Qutlander',41,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1348,'WEB',156,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1349,'WEB',156,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1350,'Agile',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1351,'City',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1352,'Cruze',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1353,'ECO',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1354,'ECO',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1355,'ECO',22,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1359,'Fluence',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1360,'XRE 300',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1361,'XRE 300',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1362,'TIGGO',157,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1363,'TIGGO',157,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1364,'TIGGO',157,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1365,'QQ',157,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1366,'CBX 250',80,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1367,'C 4',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1372,'500 FIAT',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1373,'Sonata',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1374,'AIRCROSS',13,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1375,'AIRCROSS',13,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1376,'BMW',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1377,'BMW',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1378,'BMW',67,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1379,'Symbol',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1380,'Sorento',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1381,'Sorento',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1382,'Sorento',31,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1383,'I 30',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1384,'CBX250',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1385,'XRE300',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1386,'Cobalt',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1387,'Cobalt',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1388,'Livina',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1389,'XC60',116,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1390,'Classe A',39,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1391,'Versa',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1392,'Pajero',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1393,'C 200',39,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1394,'Tucson',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1395,'Palio Weekend',21,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1396,'Pálio Weekend',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1397,'500',104,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1400,'Tiguan',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1401,'Amarok',59,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1402,'408',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1403,'Sportage',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1404,'Soul',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1405,'318',67,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1406,'318',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1407,'Duster',48,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1408,'Q 5',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1409,'Jorney',17,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1410,'Jorney',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1411,'Jorney',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1412,'Jorney',17,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1413,'Freelander',33,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1414,'Picanto',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1415,'Tiida',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1416,'Tiida',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1417,'308',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1418,'Lander',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1419,'SRV',56,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1420,'Falcon',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1421,'A1',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1422,'A3',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1423,'A4',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1424,'A5',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1425,'Frontier',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1426,'Frontier',43,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1427,'Wrangler',29,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1428,'L200',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1429,'YBR ',25,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1430,'ASX',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1431,'IX 35',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1432,'Discovery 4',33,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1433,'Cerato',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1434,'C 180',39,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1435,'320',67,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1436,'320',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1437,'X1',67,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1438,'X5',67,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1439,'X1',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1440,'X5',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1441,'Ibiza',52,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1442,'Ibiza',52,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1443,'CB 300',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1444,'Sentra',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1445,'Montana',59,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1446,'Edge',105,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1447,'307 SW',94,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1448,'Spin',23,0,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1449,'NC 700',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1450,'Onix',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1451,'X Terra',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1452,'YBR',101,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1453,'Zig',145,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1454,'Range Rover',33,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1455,'Jac',158,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1456,'Jac J5',158,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1457,'Cooper',159,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1458,'Compass',29,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1459,'Dt 180',101,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1460,'Q 3',6,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1461,'Shadow',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1462,'Legacy',54,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1463,'Cordoba',52,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1464,'TR 4',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1465,'Vitara',55,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1466,'Sonic',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1467,'Veloster',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1468,'Cadenza',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1469,'Lead',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1470,'Delrey',105,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1471,'Delrey',22,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1472,'Max',156,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1473,'K 2500',31,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1474,'Fielder',56,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1475,'SX4',55,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1476,'Airtrek',41,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1477,'Etios',56,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1478,'XLX350',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1479,'XR 200',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1480,'March',43,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1481,'XTZ 250',101,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1482,'G 650',67,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1483,'G 650',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1484,'Spin',23,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1485,'Partner',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1486,'XTZ 125',101,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1487,'HB 20',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1488,'B170',109,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1489,'B170',39,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1490,'CB 500',80,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1491,'CB 500',25,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1492,'Accord',26,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1493,'CRD',140,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1498,'Celer',157,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1494,'208',94,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1495,'208',44,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1496,'Country',12,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1497,'Cayenne',47,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1499,'X 6',7,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1500,'Freemont',104,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1501,'Freemont',21,1,0);
insert  into `fla_modelos`(`cod_modelo`,`des_modelo`,`cod_marca`,`ind_disponivel`,`ind_popular`) values (1502,'Durango',17,1,0);

UNLOCK TABLES;

/*Table structure for table `fla_nfes` */

DROP TABLE IF EXISTS `fla_nfes`;

CREATE TABLE `fla_nfes` (
  `cod_nfe` int(11) NOT NULL AUTO_INCREMENT,
  `cod_rotatividade` int(11) NOT NULL,
  `dat_criacao` datetime DEFAULT NULL,
  `dat_enviado` datetime DEFAULT NULL,
  `ind_enviado` int(11) NOT NULL DEFAULT '0',
  `cod_cliente` int(6) NOT NULL,
  `cod_mensalidade_usuario` int(6) NOT NULL,
  `nom_arquivo` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_nfe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_nfes` */

LOCK TABLES `fla_nfes` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_precos` */

DROP TABLE IF EXISTS `fla_precos`;

CREATE TABLE `fla_precos` (
  `cod_preco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_preco` varchar(50) NOT NULL,
  `val_minimo` decimal(5,2) NOT NULL,
  `tip_cobranca` char(1) NOT NULL,
  `val_hora` decimal(5,2) DEFAULT NULL,
  `val_fracao` decimal(5,2) DEFAULT NULL,
  `tem_tolerancia` int(2) NOT NULL DEFAULT '10',
  `val_diaria` decimal(5,2) DEFAULT NULL,
  `tem_diaria` int(2) DEFAULT '8',
  `tem_minimo` int(2) DEFAULT '30',
  PRIMARY KEY (`cod_preco`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `fla_precos` */

LOCK TABLES `fla_precos` WRITE;

insert  into `fla_precos`(`cod_preco`,`des_preco`,`val_minimo`,`tip_cobranca`,`val_hora`,`val_fracao`,`tem_tolerancia`,`val_diaria`,`tem_diaria`,`tem_minimo`) values (1,'Rotativo','3.00','H','3.00','2.50',5,'20.00',8,5);

UNLOCK TABLES;

/*Table structure for table `fla_rotatividade` */

DROP TABLE IF EXISTS `fla_rotatividade`;

CREATE TABLE `fla_rotatividade` (
  `cod_rotatividade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_placa` varchar(10) DEFAULT NULL,
  `hor_entrada` time DEFAULT NULL,
  `hor_saida` time DEFAULT NULL,
  `dat_cadastro` date DEFAULT NULL,
  `dat_saida` date DEFAULT NULL,
  `cod_preco` int(1) DEFAULT NULL,
  `val_total` decimal(5,2) DEFAULT NULL,
  `val_cobrado` decimal(5,2) DEFAULT NULL,
  `des_justificativa` varchar(200) DEFAULT NULL,
  `des_situacao` char(1) DEFAULT NULL,
  `cod_cartao` int(6) NOT NULL,
  `tem_permanencia` varchar(5) DEFAULT NULL,
  `val_desconto` decimal(5,2) DEFAULT '0.00',
  `cod_desconto` int(6) DEFAULT NULL,
  PRIMARY KEY (`cod_rotatividade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fla_rotatividade` */

LOCK TABLES `fla_rotatividade` WRITE;

UNLOCK TABLES;

/*Table structure for table `fla_usuarios` */

DROP TABLE IF EXISTS `fla_usuarios`;

CREATE TABLE `fla_usuarios` (
  `cod_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(100) DEFAULT NULL,
  `des_login` varchar(100) DEFAULT NULL,
  `des_senha` varchar(100) DEFAULT NULL,
  `cod_tipo` int(1) NOT NULL DEFAULT '1',
  `ind_ativo` int(1) DEFAULT '1',
  PRIMARY KEY (`cod_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `fla_usuarios` */

LOCK TABLES `fla_usuarios` WRITE;

insert  into `fla_usuarios`(`cod_usuario`,`nom_usuario`,`des_login`,`des_senha`,`cod_tipo`,`ind_ativo`) values (1,'Proprietário','dono','dono',2,1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;