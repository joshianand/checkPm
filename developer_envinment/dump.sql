# SQL Manager 2007 for MySQL 4.5.0.4
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : portal_developer


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `g_cities`;

CREATE TABLE `g_cities` (
  `city_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `country_id` int(11) DEFAULT NULL COMMENT 'Country reference',
  `city_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'City name',
  `city_symbol` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'City symbol',
  `latitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='City lists';

#
# Structure for the `g_countries` table : 
#

DROP TABLE IF EXISTS `g_countries`;

CREATE TABLE `g_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification value',
  `name` varchar(50) DEFAULT NULL COMMENT 'Name of the country',
  `formal_name` varchar(100) DEFAULT NULL COMMENT 'Formal name of the country',
  `type` varchar(50) DEFAULT NULL COMMENT 'Country Type',
  `sub_type` varchar(50) DEFAULT NULL COMMENT 'Sub type of country',
  `sovereignty` varchar(50) DEFAULT NULL COMMENT 'Sovereignty',
  `capital` varchar(100) DEFAULT NULL COMMENT 'Capital name of the country',
  `currency_code` varchar(20) DEFAULT NULL COMMENT 'Currency code of the country',
  `currency_name` varchar(20) DEFAULT NULL COMMENT 'Currency name of the country',
  `telephone_code` varchar(20) DEFAULT NULL COMMENT 'Telephone code of the country',
  `letter_code_2` varchar(10) DEFAULT NULL COMMENT '2 dizit letter code (iso)',
  `letter_code_3` varchar(10) DEFAULT NULL COMMENT '3 digit letter code of country (iso)',
  `number` varchar(10) DEFAULT NULL COMMENT 'Country number',
  `tld` varchar(10) DEFAULT NULL COMMENT 'TLD name of the country',
  `is_active` enum('yes','no') DEFAULT 'yes' COMMENT 'Active status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8 COMMENT='Country details';

#
# Structure for the `g_currencies` table : 
#

DROP TABLE IF EXISTS `g_currencies`;

CREATE TABLE `g_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification value',
  `currency_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Currency code',
  `currency_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Currency name',
  `currency_symbol` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Currency symbol',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Currency details';

#
# Structure for the `g_group_tasks` table : 
#

DROP TABLE IF EXISTS `g_group_tasks`;

CREATE TABLE `g_group_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `group_id` int(11) DEFAULT NULL COMMENT 'Group reference',
  `task_id` int(11) DEFAULT NULL COMMENT 'Task reference',
  `modified_date` bigint(20) DEFAULT NULL COMMENT 'Modified date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Structure for the `g_logins` table : 
#

DROP TABLE IF EXISTS `g_logins`;

CREATE TABLE `g_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `group_id` int(11) DEFAULT NULL COMMENT 'Group reference',
  `user_first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user first name',
  `user_last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User last name',
  `login_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'login name',
  `login_pass` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'login password',
  `image_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'image name',
  `is_active` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Login list';

#
# Structure for the `g_security_questions` table : 
#

DROP TABLE IF EXISTS `g_security_questions`;

CREATE TABLE `g_security_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `question` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Question',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# Structure for the `g_sessions` table : 
#

DROP TABLE IF EXISTS `g_sessions`;

CREATE TABLE `g_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0' COMMENT 'Primary identification key',
  `ip_address` varchar(50) NOT NULL DEFAULT '0' COMMENT 'ip address of user',
  `user_agent` varchar(120) DEFAULT NULL COMMENT 'user agent of user',
  `last_activity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'last activity of user',
  `user_data` text COMMENT 'details of user data',
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Describes session information';

#
# Structure for the `g_system_tasks` table : 
#

DROP TABLE IF EXISTS `g_system_tasks`;

CREATE TABLE `g_system_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primay identification key',
  `task_name` varchar(100) DEFAULT NULL COMMENT 'Task name',
  `parent_task_id` int(11) DEFAULT NULL COMMENT 'Parent task id',
  `controller_name` varchar(100) DEFAULT NULL COMMENT 'Controller name',
  `function_name` varchar(100) DEFAULT NULL COMMENT 'Function name',
  `sorting_order` int(11) DEFAULT NULL COMMENT 'Sorting order',
  `category` enum('Menu','Action') DEFAULT 'Menu' COMMENT 'Category',
  `is_active` enum('yes','no') DEFAULT 'yes' COMMENT 'Active status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Structure for the `g_user_contacts` table : 
#

DROP TABLE IF EXISTS `g_user_contacts`;

CREATE TABLE `g_user_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `login_id` int(11) DEFAULT NULL COMMENT 'Login reference',
  `address` varchar(500) DEFAULT NULL COMMENT 'Address',
  `city` varchar(100) DEFAULT NULL COMMENT 'City',
  `state` varchar(100) DEFAULT NULL COMMENT 'State',
  `zip` varchar(50) DEFAULT NULL COMMENT 'Zip code',
  `country` varchar(100) DEFAULT NULL COMMENT 'Country',
  `email` varchar(100) DEFAULT NULL COMMENT 'Email',
  `phone` varchar(100) DEFAULT NULL COMMENT 'Phone',
  `mobile` varchar(100) DEFAULT NULL COMMENT 'Mobile',
  `is_active` enum('yes','no') DEFAULT 'yes' COMMENT 'Active status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `g_user_groups` table : 
#

DROP TABLE IF EXISTS `g_user_groups`;

CREATE TABLE `g_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `group_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Group name',
  `is_active` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'yes' COMMENT 'Active status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User groups';

#
# Data for the `g_cities` table  (LIMIT 0,500)
#

INSERT INTO `g_cities` (`city_id`, `country_id`, `city_name`, `city_symbol`, `latitude`, `longitude`) VALUES 
  (1,NULL,'New york','NY','40.7143528','-74.0059731'),
  (2,NULL,'Los Angeles','CA','34.0522342','-118.2436849'),
  (3,NULL,'Chicago','IL','41.8781136','-87.6297982'),
  (4,NULL,'Houston','TX','29.7601927','-95.3693896'),
  (5,NULL,'Phoenix','AZ','33.4483771','-112.0740373'),
  (6,NULL,'Philadelphia','PA','39.952335','-75.163789'),
  (7,NULL,'San Antonio','TX','29.4241219','-98.4936282'),
  (8,NULL,'San Diego','CA','32.7153292','-117.1572551'),
  (9,NULL,'Dallas','TX','32.7801399','-96.8004511'),
  (10,NULL,'San Jose','CA','37.3393857','-121.8949555'),
  (11,NULL,'Detroit','MI','42.331427','-83.0457538'),
  (12,NULL,'San Francisco','CA','37.7749295','-122.4194155'),
  (13,NULL,'Jacksonville','FL','30.3321838','-81.655651'),
  (14,NULL,'Indianapolis','IN','39.768403','-86.158068'),
  (15,NULL,'Austin','TX','30.267153','-97.7430608'),
  (16,NULL,'Columbus','OH','39.9611755','-82.9987942'),
  (17,NULL,'Fort Worth','TX','32.725409','-97.3208496'),
  (18,NULL,'Charlotte','NC','35.2270869','-80.8431267'),
  (19,NULL,'Memphis','TN','35.1495343','-90.0489801'),
  (20,NULL,'Boston','MA','42.3584308','-71.0597732'),
  (21,NULL,'Baltimore','MD','39.2903848','-76.6121893'),
  (22,NULL,'El Paso','TX','31.7587198','-106.4869314'),
  (23,NULL,'Seattle','WA','47.6062095','-122.3320708'),
  (24,NULL,'Denver','CO','39.737567','-104.9847179'),
  (25,NULL,'Nashville','TN','36.1666667','-86.7833333'),
  (26,NULL,'Milwaukee','WI','43.0389025','-87.9064736'),
  (27,NULL,'Washington','DC','38.9072309','-77.0364641'),
  (28,NULL,'Las Vegas','NV','36.114646','-115.172816'),
  (29,NULL,'Louisville','KY','38.2526647','-85.7584557'),
  (30,NULL,'Portland','OR','45.5234515','-122.6762071'),
  (31,NULL,'Oklahoma City','OK','35.4675602','-97.5164276'),
  (32,NULL,'Tucson','AZ','32.2217429','-110.926479'),
  (33,NULL,'Atlanta','GA','33.7489954','-84.3879824'),
  (34,NULL,'Albuquerque','NM','35.110703','-106.609991'),
  (35,NULL,'Kansas City','MO','39.0997265','-94.5785667'),
  (36,NULL,'Fresno','CA','36.7468422','-119.7725868'),
  (37,NULL,'Mesa','AZ','33.4151843','-111.8314724'),
  (38,NULL,'Sacramento','CA','38.5815719','-121.4943996'),
  (39,NULL,'Long Beach','CA','33.768321','-118.1956168'),
  (40,NULL,'Omaha','NE','41.2523634','-95.9979883'),
  (41,NULL,'Virginia Beach','VA','36.8529263','-75.977985'),
  (42,NULL,'Miami','FL','25.7889689','-80.2264393'),
  (43,NULL,'Cleveland','OH','41.4994954','-81.6954088'),
  (44,NULL,'Oakland','CA','37.8043637','-122.2711137'),
  (45,NULL,'Raleigh','NC','35.7795897','-78.6381787'),
  (46,NULL,'Colorado Springs','CO','38.8338816','-104.8213634'),
  (47,NULL,'Tulsa','OK','36.1539816','-95.992775'),
  (48,NULL,'Minneapolis','MN','44.983334','-93.26667'),
  (49,NULL,'Arlington','TX','38.8799697','-77.1067698'),
  (50,NULL,'Honolulu','HI','21.3069444','-157.8583333'),
  (51,NULL,'Wichita','KS','37.6888889','-97.3361111'),
  (52,NULL,'Saint Louis','MO','38.6270025','-90.1994042'),
  (53,NULL,'New Orleans','LA','29.9510658','-90.0715323'),
  (54,NULL,'Tampa','FL','27.950575','-82.4571776'),
  (55,NULL,'Santa Ana','CA','33.7455731','-117.8678338'),
  (56,NULL,'Anaheim','CA','33.8352932','-117.9145036'),
  (57,NULL,'Cincinnati','OH','39.1031182','-84.5120196'),
  (58,NULL,'Bakersfield','CA','35.3732921','-119.0187125'),
  (59,NULL,'Aurora','CO','39.7294319','-104.8319195'),
  (60,NULL,'Toledo','OH','41.6639383','-83.555212'),
  (61,NULL,'Pittsburgh','PA','40.4406248','-79.9958864'),
  (62,NULL,'Riverside','CA','33.9533487','-117.3961564'),
  (63,NULL,'Lexington','KY','38.0405837','-84.5037164'),
  (64,NULL,'Stockton','CA','37.9577016','-121.2907796'),
  (65,NULL,'Corpus Christi','TX','27.8005828','-97.396381'),
  (66,NULL,'Anchorage','AK','61.2180556','-149.9002778'),
  (67,NULL,'Saint Paul','MN','44.9537029','-93.0899578'),
  (68,NULL,'Newark','NJ','40.735657','-74.1723667'),
  (69,NULL,'Plano','TX','33.0198431','-96.6988856'),
  (70,NULL,'Henderson','NV','36.0395247','-114.9817213'),
  (71,NULL,'Fort Wayne','IN','41.079273','-85.1393513'),
  (72,NULL,'Greensboro','NC','36.0726354','-79.7919754'),
  (73,NULL,'Lincoln','NE','40.806862','-96.681679'),
  (74,NULL,'Glendale','AZ','34.1425078','-118.255075'),
  (75,NULL,'Chandler','AZ','33.3061605','-111.8412502'),
  (76,NULL,'Saint Petersburg','FL','27.7730556','-82.64'),
  (77,NULL,'Jersey City','NJ','40.7281575','-74.0776417'),
  (78,NULL,'Scottsdale','AZ','33.4941704','-111.9260519'),
  (79,NULL,'Orlando','FL','28.5383355','-81.3792365'),
  (80,NULL,'Madison','WI','43.0730517','-89.4012302'),
  (81,NULL,'Norfolk','VA','36.8507689','-76.2858726'),
  (82,NULL,'Birmingham','AL','33.5206608','-86.80249'),
  (83,NULL,'Winston-Salem','NC','36.0998596','-80.244216'),
  (84,NULL,'Durham','NC','35.9940329','-78.898619'),
  (85,NULL,'Laredo','TX','27.506407','-99.5075421'),
  (86,NULL,'Lubbock','TX','33.5778631','-101.8551665'),
  (87,NULL,'Baton Rouge','LA','30.4582829','-91.1403196'),
  (88,NULL,'North Las Vegas','NV','36.1988592','-115.1175013'),
  (89,NULL,'Chula Vista','CA','32.6400541','-117.0841955'),
  (90,NULL,'Chesapeake','VA','36.7682088','-76.2874927'),
  (91,NULL,'Gilbert','AZ','33.3528264','-111.789027'),
  (92,NULL,'Garland','TX','32.912624','-96.6388833'),
  (93,NULL,'Reno','NV','39.5296329','-119.8138027'),
  (94,NULL,'Hialeah','FL','25.8575963','-80.2781057'),
  (95,NULL,'Arlington','VA','38.8799697','-77.1067698'),
  (96,NULL,'Irvine','CA','33.6839473','-117.7946942'),
  (97,NULL,'Rochester','NY','43.16103','-77.6109219'),
  (98,NULL,'Akron','OH','41.0814447','-81.5190053'),
  (99,NULL,'Boise','ID','43.6187102','-116.2146068'),
  (100,NULL,'Buffalo','NY','42.8864468','-78.8783689');
COMMIT;

#
# Data for the `g_countries` table  (LIMIT 0,500)
#

INSERT INTO `g_countries` (`id`, `name`, `formal_name`, `type`, `sub_type`, `sovereignty`, `capital`, `currency_code`, `currency_name`, `telephone_code`, `letter_code_2`, `letter_code_3`, `number`, `tld`, `is_active`) VALUES 
  (1,'Afghanistan','Islamic State of Afghanistan','Independent State',NULL,NULL,'Kabul','AFN','Afghani','+93','AF','AFG','004','.af ','yes'),
  (2,'Albania','Republic of Albania ','Independent State',NULL,NULL,'Tirana ','ALL ','Lek ','+355 ','AL ','ALB','008 ','.al ','yes'),
  (3,'Algeria ','People''s Democratic Republic of Algeria ','Independent State ',NULL,NULL,'Algiers ','DZD ','Dinar','+213 ','DZ','DZA','012 ','.dz ','yes'),
  (4,'Andorra','Principality of Andorra ','Independent State ',NULL,NULL,'Andorra la Vella ','EUR ','Euro ','+376 ','AD','AND','020 ','.ad ','yes'),
  (5,'Angola','Republic of Angola ','Independent State ',NULL,NULL,'Luanda ','AOA ','Kwanza','+244 ','AO ','AGO','024','.ao','yes'),
  (6,'Antigua and Barbuda ','Antigua and Barbuda ','Independent State ',NULL,NULL,'Saint John''s ','XCD ','Dollar','+1-268 ','AG ','ATG','028 ','.ag ','yes'),
  (7,'Argentina ','Argentine Republic','Independent State',NULL,NULL,'Buenos Aires ','ARS ','Peso ','+54 ','AR','ARG','032 ','.ar ','yes'),
  (8,'Armenia ','Republic of Armenia ','Independent State ',NULL,NULL,'Yerevan ','AMD ','Dram ','+374','AM ','ARM ','051 ','.am ','yes'),
  (9,'Australia ','Commonwealth of Australia ','Independent State ',NULL,NULL,'Canberra ','AUD ','Dollar','+61 ','AU ','AUS','036 ','.au ','yes'),
  (10,'Austria ','Republic of Austria ','Independent State ',NULL,NULL,'Vienna ','EUR ','Euro','+43 ','AT ','AUT ','040 ','.at ','yes'),
  (11,'Azerbaijan ','Republic of Azerbaijan ','Independent State ',NULL,NULL,'Baku ','AZN ','Manat ','+994 ','AZ ','AZE ','031','.az ','yes'),
  (12,'Bahamas, The ','Commonwealth of The Bahamas ','Independent State ',NULL,NULL,'Nassau ','BSD ','Dollar ','+1-242 ','BS ','BHS ','044 ','\t.bs','yes'),
  (13,'Bahrain','Kingdom of Bahrain ','Independent State ',NULL,NULL,'Manama ','BHD ','Dinar ','+973 ','BH ','BHR','048 ','.bh ','yes'),
  (14,'Bangladesh ','People''s Republic of Bangladesh','Independent State ',NULL,NULL,'Dhaka ','BDT ','Taka ','+880 ','BD ','BGD','050 ','.bd ','yes'),
  (15,'Barbados ','','Independent State ',NULL,NULL,'Bridgetown ','BBD ','Dollar','+1-246 ','BB ','BRB ','052 ','.bb ','yes'),
  (16,'Belarus ','Republic of Belarus ','Independent State ',NULL,NULL,'Minsk ','BYR ','Ruble ','+375 ','BY ','BLR ','112 ','.by ','yes'),
  (17,'Belgium ','Kingdom of Belgium ','Independent State ',NULL,NULL,'Brussels ','EUR ','Euro ','+32 ','BE ','BEL','056 ','.be ','yes'),
  (18,'Belize ','','Independent State ',NULL,NULL,'Belmopan ','BZD ','Dollar','+501 ','BZ ','BLZ ','084 ','.bz ','yes'),
  (19,'Benin ','Republic of Benin ','Independent State ',NULL,NULL,'Porto-Novo ','XOF','Franc ','+229 ','BJ','BEN','204 ','.bj ','yes'),
  (20,'Bhutan ','Kingdom of Bhutan ','Independent State ',NULL,NULL,'Thimphu ','BTN ','Ngultrum','+975 ','BT','BTN ','064 ','.bt ','yes'),
  (21,'Bolivia ','Republic of Bolivia ','Independent State ',NULL,NULL,'La Paz (administrative/legislative) and Sucre (judical) ','BOB ','Boliviano ','+591 ','BO ','BOL ','068 ','.bo ','yes'),
  (22,'Bosnia and Herzegovina',NULL,'Independent State ',NULL,NULL,'Sarajevo ','BAM ','Marka','+387 ','BA ','BIH ','070 ','.ba ','yes'),
  (23,'Botswana ','Republic of Botswana ','Independent State ',NULL,NULL,'Gaborone ','BWP ','Pula ','+267 ','BW ','BWA ','072 ','.bw ','yes'),
  (24,'Brazil','Federative Republic of Brazil ','Independent State ',NULL,NULL,'Brasilia ','BRL ','Real ','+55 ','BR ','BRA','076 ','.br ','yes'),
  (25,'Brunei ','Negara Brunei Darussalam ','Independent State ',NULL,NULL,'Bandar Seri Begawan ','BND ','Dollar','+673 ','BN ','BRN ','096 ','.bn ','yes'),
  (26,'Bulgaria ','Republic of Bulgaria ','Independent State ',NULL,NULL,'Sofia ','BGN ','Lev ','+359 ','BG ','BGR ','100 ','.bg ','yes'),
  (27,'Burkina Faso ',NULL,'Independent State ',NULL,NULL,'Ouagadougou ','XOF ','Franc','+226 ','BF ','BFA ','854 ','.bf ','yes'),
  (28,'Burundi ','Republic of Burundi ','Independent State ',NULL,NULL,'Bujumbura ','BIF ','Franc ','+257 ','BI ','BDI ','108 ','.bi ','yes'),
  (29,'Cambodia ','Kingdom of Cambodia ','Independent State ',NULL,NULL,'Phnom Penh ','KHR ','Riels ','+855 ','KH ','KHM ','116 ','.kh ','yes'),
  (30,'Cameroon','Republic of Cameroon ','Independent State ',NULL,NULL,'Yaounde ','XAF','Franc','+237 ','CM ','CMR ','120 ','.cm ','yes'),
  (31,'Canada ','Independent State ','Independent State ',NULL,NULL,'Ottawa ','CAD ','Dollar ','+1 ','CA ','CAN','124 ','.ca ','yes'),
  (32,'Cape Verde ','Republic of Cape Verde ','Independent State ',NULL,NULL,'Praia ','CVE ','Escudo ','+238 ','CV ','CPV ','132 ','.cv ','yes'),
  (33,'Central African Republic ',NULL,'Independent State ',NULL,NULL,'Bangui ','XAF ','Franc ','+236 ','CF ','CAF ','140 ','.cf ','yes'),
  (34,'Chad ','Republic of Chad ','Independent State ',NULL,NULL,'N''Djamena ','XAF ','Franc ','+235 ','TD ','TCD ','148 ','.td ','yes'),
  (35,'Chile ','Republic of Chile ','Independent State ',NULL,NULL,'Santiago (administrative/judical) and Valparaiso (legislative) ','CLP ','Peso ','+56 ','CL ','CHL ','152 ','.cl ','yes'),
  (36,'China, People''s Republic of','People''s Republic of China ','Independent State ',NULL,NULL,'Beijing','CNY','Yuan Renminbi ','+86 ','CN ','CHN ','156 ','.cn ','yes'),
  (37,'Colombia ','Republic of Colombia ','Independent State ',NULL,NULL,'Bogota ','COP ','Peso ','+57 ','CO ','COL ','170 ','.co ','yes'),
  (38,'Comoros ','Union of Comoros','Independent State ',NULL,NULL,'Moroni ','KMF ','Franc ','+269','KM ','COM ','174 ','.km ','yes'),
  (39,'Congo, Democratic Republic of the (Congo ? Kinshas','Democratic Republic of the Congo ','Independent State ',NULL,NULL,'Kinshasa ','CDF ','Franc ','+243 ','CD ','COD','180 ','.cd ','yes'),
  (40,'Congo, Republic of the (Congo ? Brazzaville) ','Republic of the Congo ','Independent State ',NULL,NULL,'Brazzaville ','XAF ','Franc','+242 ','CG ','COG','178 ','.cg ','yes'),
  (41,'Costa Rica','Republic of Costa Rica ','Independent State ',NULL,NULL,'San Jose ','CRC ','Colon ','+506 ','CR','CRI','188 ','.cr ','yes'),
  (42,'Cote d''Ivoire (Ivory Coast) ','Republic of Cote d''Ivoire ','Independent State ',NULL,NULL,'Yamoussoukro','XOF ','Franc ','+225 ','CI ','CIV ','384 ','.ci ','yes'),
  (43,'Croatia ','Republic of Croatia ','Independent State ',NULL,NULL,'Zagreb ','HRK ','Kuna ','+385 ','HR ','HRV','191 ','.hr ','yes'),
  (44,'Cuba ','Republic of Cuba ','Independent State ',NULL,NULL,'Havana ','CUP ','Peso ','+53 ','CU','CUB ','192 ','.cu ','yes'),
  (45,'Cyprus ','Republic of Cyprus ','Independent State ',NULL,NULL,'Nicosia ','CYP ','Pound','+357 ','CY ','CYP ','196 ','.cy ','yes'),
  (46,'Czech Republic ',NULL,'Independent State ',NULL,NULL,'Prague ','CZK ','Koruna','+420 ','CZ','CZE ','203 ','.cz ','yes'),
  (47,'Denmark ','Kingdom of Denmark','Independent State ',NULL,NULL,'Copenhagen ','DKK ','Krone ','+45 ','DK ','DNK ','208 ','.dk ','yes'),
  (48,'Djibouti','Republic of Djibouti ','Independent State ',NULL,NULL,'Djibouti ','DJF ','Franc ','+253 ','DJ ','DJI ','262 ','.dj ','yes'),
  (49,'Dominica ','Commonwealth of Dominica ','Independent State ',NULL,NULL,'Roseau ','XCD ','Dollar','+1-767 ','DM ','DMA','212 ','.dm ','yes'),
  (50,'Dominican Republic ',NULL,'Independent State ',NULL,NULL,'Santo Domingo ','DOP ','Peso ','+1-809 and 1-829','DO','DOM ','214 ','.do ','yes'),
  (51,'Ecuador ','Republic of Ecuador ','Independent State ',NULL,NULL,'Quito ','USD ','Dollar ','+593 ','EC','ECU ','218 ','.ec ','yes'),
  (52,'Egypt ','Arab Republic of Egypt ','Independent State ',NULL,NULL,'Cairo ','EGP ','Pound ','+20 ','EG ','EGY ','818 ','.eg ','yes'),
  (53,'El Salvador ','Republic of El Salvador ','Independent State ',NULL,NULL,'San Salvador','USD ','Dollar ','+503 ','SV ','SLV ','222 ','.sv ','yes'),
  (54,'Equatorial Guinea ','Republic of Equatorial Guinea ','Independent State ',NULL,NULL,'Malabo ','XAF ','Franc ','+240 ','GQ ','GNQ ','226 ','.gq ','yes'),
  (55,'Eritrea ','State of Eritrea','Independent State ',NULL,NULL,'Asmara ','ERN ','Nakfa ','+291 ','ER ','ERI ','232 ','.er ','yes'),
  (56,'Estonia ','Republic of Estonia ','Independent State ',NULL,NULL,'Tallinn ','EEK ','Kroon ','+372 ','EE ','EST ','233 ','.ee ','yes'),
  (57,'Ethiopia ','Federal Democratic Republic of Ethiopia ','Independent State ',NULL,NULL,'Addis Ababa ','ETB ','Birr ','+251 ','ET ','ETH ','231 ','.et ','yes'),
  (58,'Fiji ','Republic of the Fiji Islands ','Independent State ',NULL,NULL,'Suva ','FJD ','Dollar ','+679 ','FJ ','FJI ','242 ','.fj ','yes'),
  (59,'Finland ','Republic of Finland ','Independent State ',NULL,NULL,'Helsinki ','EUR ','Euro','+358 ','FI ','FIN','246 ','.fi ','yes'),
  (60,'France ','French Republic ','Independent State ',NULL,NULL,'Paris ','EUR ','Euro ','+33 ','FR ','FRA ','250 ','.fr ','yes'),
  (61,'Gabon ','Gabonese Republic ','Independent State ',NULL,NULL,'Libreville ','XAF ','Franc','+241 ','GA ','GAB ','266 ','.ga ','yes'),
  (62,'Gambia, The ','Republic of The Gambia ','Independent State ',NULL,NULL,'Banjul ','GMD ','Dalasi ','+220 ','GM ','GMB ','270 ','.gm ','yes'),
  (63,'Georgia','Republic of Georgia ','Independent State ',NULL,NULL,'Tbilisi ','GEL','Lari ','+995 ','GE ','GEO ','268 ','.ge ','yes'),
  (64,'Germany ','Federal Republic of Germany ','Independent State ',NULL,NULL,'Berlin ','EUR ','Euro','+49 ','DE ','DEU ','276','.de ','yes'),
  (65,'Ghana ','Republic of Ghana ','Independent State ',NULL,NULL,'Accra ','GHS ','Cedi ','+233 ','GH ','GHA ','288','.gh ','yes'),
  (66,'Greece ','Hellenic Republic ','Independent State ',NULL,NULL,'Athens ','EUR ','Euro ','+30 ','GR ','GRC ','300 ','.gr ','yes'),
  (67,'Grenada ',NULL,'Independent State ',NULL,NULL,'Saint George''s ','XCD ','Dollar ','Dollar ','GD ','GRD ','308 ','.gd ','yes'),
  (68,'Guatemala ','Republic of Guatemala ','Independent State ',NULL,NULL,'Guatemala ','GTQ ','Quetzal ','+502 ','GT ','GTM ','320 ','.gt ','yes'),
  (69,'Guinea','Republic of Guinea ','Independent State ','','','Conakry ','GNF ','Franc ','+224','GN ','GIN ','324 ','.gn ','yes'),
  (70,'Guinea-Bissau ','Republic of Guinea-Bissau ','Independent State ',NULL,NULL,'Bissau ','XOF ','Franc ','+245 ','GW','GNB ','624 ','.gw ','yes'),
  (71,'Guyana ','Co-operative Republic of Guyana ','Independent State ',NULL,NULL,'Georgetown ','GYD ','Dollar ','+592 ','GY ','GUY','328 ','.gy ','yes'),
  (72,'Haiti ','Republic of Haiti ','Independent State ',NULL,NULL,'Port-au-Prince ','HTG ','Gourde ','+509 ','HT ','HTI ','332 ','.ht ','yes'),
  (73,'Honduras ','Republic of Honduras ','Independent State ',NULL,NULL,'Tegucigalpa ','HNL ','Lempira ','+504 ','HN ','HND ','340 ','.hn ','yes'),
  (74,'Hungary ','Republic of Hungary ','Independent State ',NULL,NULL,'Budapest ','HUF ','Forint','+36 ','HU ','HUN ','348 ','.hu ','yes'),
  (75,'Iceland ','Republic of Iceland ','Independent State ',NULL,NULL,'Reykjavik ','ISK ','Krona ','+354 ','IS ','ISL ','352 ','.is ','yes'),
  (76,'India ','Republic of India ','Independent State ',NULL,NULL,'New Delhi ','INR ','Rupee ','+91 ','IN ','IND ','356 ','.in ','yes'),
  (77,'Indonesia ','Republic of Indonesia ','Independent State ',NULL,NULL,'Jakarta ','IDR ','Rupiah ','+62 ','ID ','IDN ','360 ','.id ','yes'),
  (78,'Iran ','Islamic Republic of Iran ','Independent State ',NULL,NULL,'Tehran ','IRR ','Rial ','+98 ','IR ','IRN ','364 ','.ir ','yes'),
  (79,'Iraq ','Republic of Iraq ','Independent State ',NULL,NULL,'Baghdad ','IQD ','Dinar ','+964 ','IQ ','IRQ ','368 ','.iq ','yes'),
  (80,'Ireland ',NULL,'Independent State ',NULL,NULL,'Dublin ','EUR ','Euro ','+353 ','IE ','IRL ','372 ','.ie ','yes'),
  (81,'Israel ','State of Israel ','Independent State \t',NULL,NULL,'Jerusalem ','ILS ','Shekel ','+972 ','IL ','ISR ','376 ','.il ','yes'),
  (82,'Italy ','Italian Republic ','Independent State ',NULL,NULL,'Rome ','EUR ','Euro ','+39 ','IT ','ITA ','380 ','.it ','yes'),
  (83,'Jamaica ',NULL,'Independent State ',NULL,NULL,'Kingston ','JMD ','Dollar','+1-876 ','JM ','JAM ','388 ','.jm ','yes'),
  (84,'Japan ',NULL,'Independent State ',NULL,NULL,'Tokyo ','JPY ','Yen ','+81 ','JP ','JPN ','392 ','.jp ','yes'),
  (85,'Jordan ','Hashemite Kingdom of Jordan ','Independent State \t',NULL,NULL,'Amman ','JOD ','Dinar ','+962 ','JO \t','JOR ','400 ','.jo ','yes'),
  (86,'Kazakhstan ','Republic of Kazakhstan ','Independent State ',NULL,NULL,'Astana ','KZT ','Tenge ','+7 ','KZ ','KAZ \t','398 \t','.kz ','yes'),
  (87,'Kenya ','Republic of Kenya ','Independent State ',NULL,NULL,'Nairobi ','KES ','Shilling ','+254 ','KE ','KEN ','404 ','.ke ','yes'),
  (88,'Kiribati ','Republic of Kiribati ','Independent State ',NULL,NULL,'Tarawa ','AUD ','Dollar ','+686 ','KI ','KIR ','296 ','.ki ','yes'),
  (89,'Korea, Democratic People''s Republic of (North Kore','Democratic People''s Republic of Korea ','Independent State ',NULL,NULL,'Pyongyang ','KPW ','Won ','+850 \t','KP ','PRK ','408 ','.kp ','yes'),
  (90,'Korea, Republic of (South Korea) ','Republic of Korea ','Independent State ',NULL,NULL,'Seoul ','KRW ','Won ','+82 ','KR','KOR ','410 ','.kr ','yes'),
  (92,'Kuwait ','State of Kuwait','Independent State ',NULL,NULL,'Kuwait ','KWD ','Dinar ','+965 ','KW ','KWT ','414 ','.kw ','yes'),
  (93,'Kyrgyzstan ','Kyrgyz Republic ','Independent State ',NULL,NULL,'Bishkek ','KGS ','Som ','+996 ','KG ','KGZ ','417 ','.kg ','yes'),
  (94,'Laos','Lao People''s Democratic Republic ','Independent State ',NULL,NULL,'Vientiane','LAK ','Kip ','+856 ','LA ','LAO ','418 ','.la ','yes'),
  (95,'Latvia ','Republic of Latvia ','Independent State ',NULL,NULL,'Riga ','LVL ','Lat ','+371 ','LV ','LVA ','428 ','.lv ','yes'),
  (96,'Lebanon ','Lebanese Republic ','Independent State ',NULL,NULL,'Beirut ','LBP','Pound ','+961 ','LB','LBN','422 ','.lb ','yes'),
  (97,'Lesotho ','Kingdom of Lesotho ','Independent State ',NULL,NULL,'Maseru ','LSL ','Loti ','+266 ','LS ','LSO ','426 ','.ls ','yes'),
  (98,'Liberia ','Republic of Liberia ','Independent State ',NULL,NULL,'Monrovia ','LRD ','Dollar ','+231 ','LR ','LBR ','430 ','.lr ','yes'),
  (99,'Libya','Great Socialist People''s Libyan Arab Jamahiriya ','Independent State ',NULL,NULL,'Tripoli ','LYD','Dinar ','+218 ','LY ','LBY ','434','.ly ','yes'),
  (100,'Liechtenstein ','Principality of Liechtenstein ','Independent State ',NULL,NULL,'Vaduz ','CHF ','Franc ','+423 ','LI ','LIE ','438 ','.li ','yes'),
  (101,'Lithuania ','Republic of Lithuania ','Independent State ',NULL,NULL,'Vilnius ','LTL ','Litas ','+370','LT ','LTU ','440 ','.lt ','yes'),
  (102,'Luxembourg ','Grand Duchy of Luxembourg ','Independent State ',NULL,NULL,'Luxembourg ','EUR ','Euro ','+352 ','LU ','LUX \t','442 ','.lu ','yes'),
  (103,'Macedonia ','Republic of Macedonia ','Independent State ',NULL,NULL,'Skopje ','MKD ','Denar ','389 ','MK ','MKD','807 ','.mk ','yes'),
  (104,'Madagascar ','Republic of Madagascar ','Independent State ',NULL,NULL,'Antananarivo ','MGA','Ariary ','+261 ','MG ','MDG ','450 ','.mg ','yes'),
  (105,'Malawi ','Republic of Malawi ','Independent State ',NULL,NULL,'Lilongwe ','MWK','Kwacha ','+265 ','MW ','MWI \t','454 ','.mw ','yes'),
  (106,'Malaysia ',NULL,'Independent State ',NULL,NULL,'Kuala Lumpur (legislative/judical) and Putrajaya (administrative)','MYR ','Ringgit \t','+60 ','MY ','MYS \t','458 ','.my ','yes'),
  (107,'Maldives ','Republic of Maldives ','Independent State ',NULL,NULL,'Male ','MVR ','Rufiyaa ','+960 ','MV','MDV ','462 ','.mv ','yes'),
  (108,'Mali ','Republic of Mali ','Independent State ',NULL,NULL,'Bamako ','XOF ','Franc ','+223 ','ML ','MLI ','466 ','.ml ','yes'),
  (109,'Malta ','Republic of Malta ','Independent State ',NULL,NULL,'Valletta ','MTL ','Lira ','+356 ','MT ','MLT \t','470 ','.mt ','yes'),
  (110,'Marshall Islands ','Republic of the Marshall Islands ','Independent State ',NULL,NULL,'Majuro ','USD ','Dollar ','+692 ','MH ','MHL ','584 ','.mh ','yes'),
  (111,'Mauritania ','Islamic Republic of Mauritania ','Independent State ',NULL,NULL,'Nouakchott ','MRO ','Ouguiya ','+222 ','MR \t','MRT \t','478 ','.mr ','yes'),
  (112,'Mauritius ','Republic of Mauritius ','Independent State ',NULL,NULL,'Port Louis ','MUR ','Rupee ','+230 ','MU ','MUS ','480 ','.mu ','yes'),
  (113,'Mexico ','United Mexican States ','Independent State ',NULL,NULL,'Mexico ','MXN ','Peso ','+52 ','MX ','MEX ','484 ','.mx ','yes'),
  (114,'Micronesia ','Federated States of Micronesia ','Independent State ',NULL,NULL,'Palikir ','USD ','Dollar ','+691 ','FM ','FSM ','583 ','.fm ','yes'),
  (115,'Moldova ','Republic of Moldova ','Independent State ',NULL,NULL,'Chisinau ','MDL ','Leu ','+373 ','MD ','MDA ','498 ','.md ','yes'),
  (116,'Monaco ','Principality of Monaco ','Independent State ',NULL,NULL,'Monaco ','EUR ','Euro ','+377 ','MC ','MCO ','492 ','.mc ','yes'),
  (121,'Mongolia ',NULL,'Independent State ',NULL,NULL,'Ulaanbaatar ','MNT ','Tugrik ','+976 ','MN ','MNG ','496 ','.mn ','yes'),
  (122,'Montenegro','Republic of Montenegro ','Independent State ',NULL,NULL,'Podgorica ','EUR ','Euro ','+382 ','ME ','MNE ','499 ','.me and .y','yes'),
  (123,'Morocco ','Kingdom of Morocco ','Independent State ',NULL,NULL,'Rabat ','MAD ','Dirham ','+212 ','MA ','MAR ','504 ','.ma ','yes'),
  (124,'Mozambique ','Republic of Mozambique ','Independent State ',NULL,NULL,'Maputo ','MZM ','Meticail ','+258 ','MZ ','MOZ ','508 ','.mz ','yes'),
  (125,'Myanmar (Burma) ','Union of Myanmar ','Independent State ',NULL,NULL,'Naypyidaw ','MMK ','Kyat ','+95 ','MM ','MMR','104 ','.mm ','yes'),
  (126,'Namibia','Republic of Namibia ','Independent State ',NULL,NULL,'Windhoek ','NAD ','Dollar ','+264 ','NA ','NAM ','516 ','.na ','yes'),
  (127,'Nauru ','Republic of Nauru ','Independent State ',NULL,NULL,'Yaren ','AUD ','Dollar ','+674 ','NR ','NRU ','520 ','.nr ','yes'),
  (128,'Nepal ','','Independent State ',NULL,NULL,'Kathmandu ','NPR ','Rupee ','+977 ','NP ','NPL ','524 ','.np ','yes'),
  (129,'Netherlands ','Kingdom of the Netherlands ','Independent State ',NULL,NULL,'Amsterdam (administrative) and The Hague (legislative/judical) ','EUR ','Euro ','+31 ','NL ','NLD ','528 ','.nl ','yes'),
  (130,'New Zealand',NULL,'Independent State ',NULL,NULL,'Wellington ','NZD ','Dollar ','+64 ','NZ ','NZL \t','554 ','.nz ','yes'),
  (131,'Nicaragua ','Republic of Nicaragua ','Independent State ',NULL,NULL,'Managua ','NIO ','Cordoba ','+505 ','NI ','NIC ','558 ','.ni ','yes'),
  (132,'Niger ','Republic of Niger ','Independent State ',NULL,NULL,'Niamey ','XOF ','Franc ','+227 ','NE ','NER ','562 ','.ne ','yes'),
  (133,'Nigeria ','Federal Republic of Nigeria ','Independent State ',NULL,NULL,'Abuja ','NGN ','Naira ','+234 ','NG ','NGA ','566 ','.ng ','yes'),
  (134,'Norway ','Kingdom of Norway ','Independent State ',NULL,NULL,'Oslo ','NOK ','Krone ','+47 ','NO ','NOR','578 ','.no ','yes'),
  (135,'Oman ','Sultanate of Oman ','Independent State ',NULL,NULL,'Muscat ','OMR ','Rial ','+968 ','OM ','OMN','512 ','.om ','yes'),
  (136,'Pakistan ','Islamic Republic of Pakistan ','Independent State ',NULL,NULL,'Islamabad ','PKR ','Rupee ','+92 ','PK ','PAK','586 ','.pk ','yes'),
  (137,'Palau','Republic of Palau ','Independent State ',NULL,NULL,'Melekeok','USD ','Dollar','+680 ','PW ','PLW ','585 ','.pw ','yes'),
  (138,'Panama ','Republic of Panama ','Independent State ',NULL,NULL,'Panama ','PAB ','Balboa ','+507 ','PA \t','PAN ','591 ','.pa ','yes'),
  (139,'Papua New Guinea ','Independent State of Papua New Guinea ','Independent State ',NULL,NULL,'Port Moresby ','PGK ','Kina ','+675 ','PG ','PNG','598 ','.pg ','yes'),
  (140,'Paraguay ','Republic of Paraguay ','Independent State ',NULL,NULL,'Asuncion ','PYG ','Guarani ','+595 ','PY ','PRY ','600 ','.py ','yes'),
  (141,'Peru ','Republic of Peru ','Independent State ',NULL,NULL,'Lima ','PEN ','Sol ','+51 ','PE ','PER \t','604 ','.pe ','yes'),
  (142,'Philippines ','Republic of the Philippines ','Independent State ',NULL,NULL,'Manila ','PHP ','Peso ','+63','PH ','PHL ','608 ','.ph ','yes'),
  (143,'Poland ','Republic of Poland ','Independent State ',NULL,NULL,'Warsaw ','PLN ','Zloty ','+48 ','PL ','POL ','616 ','.pl ','yes'),
  (144,'Portugal ','Portuguese Republic ','Independent State ',NULL,NULL,'Lisbon ','EUR ','Euro ','+351 ','PT','PRT ','620 ','.pt ','yes'),
  (145,'Qatar','State of Qatar','Independent State ',NULL,NULL,'Doha ','QAR ','Rial ','+974 ','QA ','QAT ','634 ','.qa ','yes'),
  (146,'Romania ',NULL,'Independent State ',NULL,NULL,'Bucharest ','RON ','Leu ','+40 ','RO ','ROU','642 ','.ro ','yes'),
  (147,'Russia ','Russian Federation ','Independent State ',NULL,NULL,'Moscow ','RUB ','Ruble ','+7 ','RU ','RUS ','643 ','.ru and .s','yes'),
  (148,'Rwanda','Republic of Rwanda ','Independent State ',NULL,NULL,'Kigali ','RWF ','Franc ','+250 ','RW ','RWA ','646 ','.rw ','yes'),
  (149,'Saint Kitts and Nevis ','Federation of Saint Kitts and Nevis ','Independent State ',NULL,NULL,'Basseterre ','XCD ','Dollar ','+1-869 ','KN ','KNA','659 ','.kn ','yes'),
  (150,'Saint Lucia ','','Independent State ',NULL,NULL,'Castries ','XCD ','Dollar ','+1-758 ','LC ','LCA ','662 ','.lc ','yes'),
  (151,'Saint Vincent and the Grenadines ',NULL,'Independent State ',NULL,NULL,'Kingstown ','XCD','Dollar ','+1-784 ','VC ','VCT ','670 ','.vc ','yes'),
  (152,'Samoa ','Independent State of Samoa ','Independent State ',NULL,NULL,'Apia ','WST ','Tala ','+685 ','WS ','WSM ','882 ','.ws ','yes'),
  (153,'San Marino','Republic of San Marino ','Independent State ',NULL,NULL,'San Marino ','EUR ','Euro ','+378 ','SM ','SMR ','674 ','.sm ','yes'),
  (154,'Sao Tome and Principe','Democratic Republic of Sao Tome and Principe ','Independent State ',NULL,NULL,'Sao Tome ','STD ','Dobra ','+239 ','ST ','STP ','678 ','.st ','yes'),
  (155,'Saudi Arabia ','Kingdom of Saudi Arabia ','Independent State ',NULL,NULL,'Riyadh ','SAR ','Rial ','+966 ','SA ','SAU ','682 ','.sa ','yes'),
  (156,'Senegal ','Republic of Senegal ','Independent State ',NULL,NULL,'Dakar ','XOF ','Franc ','+221 ','SN ','SEN ','686 ','.sn ','yes'),
  (157,'Serbia ','Republic of Serbia ','Independent State ',NULL,NULL,'Belgrade ','RSD ','Dinar','+381 ','RS ','SRB ','688 ','.rs and .y','yes'),
  (158,'Seychelles ','Republic of Seychelles ','Independent State ',NULL,NULL,'Victoria ','SCR ','Rupee','+248 ','SC ','SYC','690 ','.sc ','yes'),
  (159,'Sierra Leone ','Republic of Sierra Leone ','Independent State ',NULL,NULL,'Freetown ','SLL ','Leone ','+232 ','SL ','SLE ','694 ','.sl ','yes'),
  (160,'Singapore ','Republic of Singapore ','Independent State ',NULL,NULL,'Singapore ','SGD','Dollar','+65 ','SG ','SGP ','702 ','.sg ','yes'),
  (161,'Slovakia ','Slovak Republic ','Independent State ',NULL,NULL,'Bratislava ','SKK ','Koruna ','+421 ','SK ','SVK ','703 ','.sk ','yes'),
  (162,'Slovenia','Republic of Slovenia ','Independent State ',NULL,NULL,'Ljubljana ','EUR ','Euro','+386 ','SI ','SVN ','705 ','.si ','yes'),
  (163,'Solomon Islands ',NULL,'Independent State ',NULL,NULL,'Honiara ','SBD ','Dollar ','+677 ','SB ','SLB ','090 ','.sb ','yes'),
  (164,'Somalia ',NULL,'Independent State ',NULL,NULL,'Mogadishu ','SOS ','Shilling','+252 ','SO ','SOM ','706 ','.so ','yes'),
  (165,'South Africa ','Republic of South Africa ','Independent State ',NULL,NULL,'Pretoria (administrative), Cape Town (legislative), and Bloemfontein (judical) ','ZAR ','Rand ','+27 ','ZA ','ZAF ','710 ','.za ','yes'),
  (166,'Spain ','Kingdom of Spain ','Independent State ',NULL,NULL,'Madrid ','EUR ','Euro ','+34 ','ES ','ESP ','724 ','.es ','yes'),
  (167,'Sri Lanka ','Democratic Socialist Republic of Sri Lanka','Independent State ',NULL,NULL,'Colombo (administrative/judical) and Sri Jayewardenepura Kotte (legislative) ','LKR ','Rupee ','+94 ','LK ','LKA','144 ','.lk ','yes'),
  (168,'Sudan ','Republic of the Sudan ','Independent State ',NULL,NULL,'Khartoum ','SDG ','Pound ','+249 ','SD ','SDN ','736 ','.sd ','yes'),
  (169,'Suriname ','Republic of Suriname ','Independent State ',NULL,NULL,'Paramaribo ','SRD ','Dollar ','+597 ','SR ','SUR ','740 ','.sr ','yes'),
  (170,'Swaziland ','Kingdom of Swaziland ','Independent State ',NULL,NULL,'Mbabane (administrative) and Lobamba (legislative) \t','SZL ','Lilangeni \t','+268 ','SZ ','SWZ ','748','.sz ','yes'),
  (171,'Syria ','Syrian Arab Republic ','Independent State ',NULL,NULL,'Damascus ','SYP ','Pound ','+963 ','SY ','SYR ','760 ','.sy ','yes'),
  (172,'Tajikistan','Republic of Tajikistan ','Independent State ',NULL,NULL,'Dushanbe ','TJS ','Somoni ','+992 ','TJ ','TJK ','762 ','.tj ','yes'),
  (173,'Tanzania ','United Republic of Tanzania ','Independent State ',NULL,NULL,'Dar es Salaam (administrative/judical) and Dodoma (legislative)','TZS ','Shilling ','+255 ','TZ ','TZA ','834 ','.tz ','yes'),
  (174,'Thailand ','Kingdom of Thailand ','Independent State \t',NULL,NULL,'Bangkok ','THB ','Baht ','+66 ','TH ','THA ','764 ','.th ','yes'),
  (175,'Timor-Leste (East Timor)','Democratic Republic of Timor-Leste ','Independent State ',NULL,NULL,'Dili ','USD ','Dollar ','+670 ','TL ','TLS ','626 ','.tp and .t','yes'),
  (176,'Togo ','Togolese Republic ','Independent State ',NULL,NULL,'Lome ','XOF ','Franc ','+228 ','TG ','TGO ','768 ','.tg ','yes'),
  (177,'Tonga ','Kingdom of Tonga ','Independent State ',NULL,NULL,'Nuku''alofa ','TOP ','Pa''anga ','+676 ','TO ','TON ','776 ','.to ','yes'),
  (178,'Trinidad and Tobago ','Republic of Trinidad and Tobago ','Independent State ',NULL,NULL,'Port-of-Spain ','TTD ','Dollar','+1-868 ','TT ','TTO ','780 ','.tt ','yes'),
  (179,'Tunisia ','Tunisian Republic ','Independent State ',NULL,NULL,'Tunis ','TND ','Dinar ','+216 ','TN ','TUN ','788 ','.tn ','yes'),
  (180,'Turkey ','Republic of Turkey ','Independent State ',NULL,NULL,'Ankara ','TRY ','Lira ','+90 ','TR ','TUR','792 ','.tr ','yes'),
  (181,'Turkmenistan',NULL,'Independent State ',NULL,NULL,'Ashgabat ','TMM ','Manat ','+993','TM ','TKM ','795 ','.tm ','yes'),
  (182,'Tuvalu ',NULL,'Independent State ',NULL,NULL,'Funafuti ','AUD ','Dollar ','+688','TV','TUV \t','798 ','.tv ','yes'),
  (183,'Uganda ','Republic of Uganda ','Independent State ',NULL,NULL,'Kampala ','UGX ','Shilling ','+256 ','UG','UGA ','800 ','.ug ','yes'),
  (184,'Ukraine ','','Independent State ',NULL,NULL,'Kiev ','UAH ','Hryvnia ','+380 ','UA ','UKR ','804 ','.ua ','yes'),
  (185,'United Arab Emirates ','United Arab Emirates ','Independent State ',NULL,NULL,'Abu Dhabi ','AED','Dirham ','+971 ','AE ','ARE ','784 ','.ae ','yes'),
  (186,'United Kingdom ','United Kingdom of Great Britain and Northern Ireland ','Independent State ',NULL,NULL,'London ','GBP ','Pound ','+44 ','GB ','GBR ','826 ','.uk ','yes'),
  (187,'United States ','United States of America ','Independent State ',NULL,NULL,'Washington ','USD ','Dollar \t','+1 ','US ','USA ','840','.us ','yes'),
  (188,'Uruguay ','Oriental Republic of Uruguay ','Independent State ',NULL,NULL,'Montevideo ','UYU ','Peso ','+598 ','UY ','URY ','858 ','.uy ','yes'),
  (189,'Uzbekistan ','Republic of Uzbekistan ','Independent State ',NULL,NULL,'Tashkent ','UZS ','Som ','+998 ','UZ ','UZB','860 ','.uz ','yes'),
  (190,'Vanuatu ','Republic of Vanuatu ','Independent State ',NULL,NULL,'Port-Vila ','VUV ','Vatu ','+678 ','VU ','VUT ','548 ','.vu ','yes'),
  (191,'Vatican City','State of the Vatican City ','Independent State ',NULL,NULL,'Vatican City ','EUR ','Euro ','+379 ','VA ','VAT ','336 ','.va ','yes'),
  (192,'Venezuela ','Bolivarian Republic of Venezuela ','Independent State ',NULL,NULL,'Caracas ','VEB ','Bolivar ','+58 ','VE ','VEN ','862 ','.ve ','yes'),
  (193,'Vietnam ','Socialist Republic of Vietnam ','Independent State ',NULL,NULL,'Hanoi ','VND ','Dong ','+84 ','VN ','VNM','704 ','.vn ','yes'),
  (194,'Yemen ','Republic of Yemen ','Independent State ',NULL,NULL,'Sanaa ','YER ','Rial ','+967 ','YE ','YEM ','887 ','.ye ','yes'),
  (195,'Zambia ','Republic of Zambia ','Independent State ',NULL,NULL,'Lusaka ','ZMK ','Kwacha','+260 ','ZM','ZMB ','894','.zm ','yes'),
  (196,'Zimbabwe','Republic of Zimbabwe ','Independent State ',NULL,NULL,'Harare ','ZWD ','Dollar','+263 ','ZW ','ZWE ','716 ','.zw','yes'),
  (197,'Abkhazia','Republic of Abkhazia ','Proto Independent State ',NULL,NULL,'Sokhumi ','RUB','Ruble ','+995 ','GE ','GEO ','268 ','.ge ','yes'),
  (198,'China, Republic of (Taiwan) ','Republic of China ','Proto Independent State ',NULL,NULL,'Taipei ','TWD \t','Dollar ','+886 ','TW ','TWN ','158 ','.tw ','yes'),
  (199,'Nagorno-Karabakh ','Nagorno-Karabakh Republic ','Proto Independent State ',NULL,NULL,'Stepanakert ','AMD ','Dram','+374-97 \t','AZ \t','AZE','031 ','.az ','yes'),
  (200,'Northern Cyprus ','Turkish Republic of Northern Cyprus ','Proto Independent State ',NULL,NULL,'Nicosia ','TRY ','Lira ','+90-392 ','CY ','CYP ','196 ','.nc.tr ','yes'),
  (201,'Pridnestrovie (Transnistria) ','Pridnestrovian Moldavian Republic ','Proto Independent State ',NULL,NULL,'Tiraspol ',NULL,'Ruple ','+373-533','MD ','MDA ','498 ','.md ','yes'),
  (202,'Somaliland ','Republic of Somaliland ','Proto Independent State ',NULL,NULL,'Hargeisa ','','Shilling ','+252 ','SO ','SOM ','706 ','.so ','yes'),
  (203,'South Ossetia ','Republic of South Ossetia ','Proto Independent State ',NULL,NULL,'Tskhinvali ','RUB and GEL ','Ruble and Lari ','+995 ','GE ','GEO ','268 ','.ge ','yes'),
  (204,'Ashmore and Cartier Islands ','Territory of Ashmore and Cartier Islands','Dependency \t','External Territory ','Australia ',NULL,NULL,NULL,NULL,'AU ','AUS ','036 ','.au ','yes'),
  (205,'Christmas Island ','Territory of Christmas Island ','Dependency ','External Territory ','Australia ','The Settlement (Flying Fish Cove) ','AUD ','Dollar ','+61 ','CX ','CXR ','162 ','.cx ','yes'),
  (206,'Cocos (Keeling) Islands ','Territory of Cocos (Keeling) Islands ','Dependency ','External Territory ','Australia ','West Island ','AUD ','Dollar ','+61 ','CC ','CCK ','166 ','.cc ','yes'),
  (207,'Coral Sea Islands ','Coral Sea Islands Territory ','Dependency ','External Territory ','Australia ',NULL,NULL,NULL,NULL,'AU \t','AUS ','036 ','.au ','yes'),
  (208,'Heard Island and McDonald Islands ','Territory of Heard Island and McDonald Islands ','Dependency ','External Territory ','Australia ',NULL,NULL,NULL,NULL,'HM ','HMD ','334 ','.hm ','yes'),
  (209,'Norfolk Island ','Territory of Norfolk Island ','Dependency','External Territory ','Australia ','Kingston ','AUD ','Dollar ','+672 ','NF ','NFK \t','574','.nf ','yes'),
  (210,'New Caledonia ',NULL,'Dependency','Sui generis Collectivity ','France ','Noumea ','XPF ','Franc ','+687 ','NC ','NCL ','540 ','.nc ','yes'),
  (211,'French Polynesia','Overseas Country of French Polynesia ','Dependency','Overseas Collectivity ','France ','Papeete ','XPF ','Franc','+689 ','PF ','PYF ','258 ','.pf ','yes'),
  (212,'Mayotte ','Departmental Collectivity of Mayotte ','Dependency','Overseas Collectivity ','France ','Mamoudzou ','EUR ','Euro ','+262 ','YT ','MYT','175 ','.yt ','yes'),
  (213,'Saint Barthelemy ','Collectivity of Saint Barthelemy ','Dependency ','Overseas Collectivity ','France ','Gustavia ','EUR ','Euro ','+590 ','GP ','GLP ','GLP ','.gp ','yes'),
  (214,'Saint Martin ','Collectivity of Saint Martin ','Dependency','Overseas Collectivity ','France','Marigot ','EUR ','Euro','+590 ','GP ','GLP ','312 ','.gp ','yes'),
  (215,'Saint Pierre and Miquelon','Territorial Collectivity of Saint Pierre and Miquelon ','Dependency','Overseas Collectivity ','France ','Saint-Pierre ','EUR ','Euro','+508 ','PM ','SPM ','666 ','.pm ','yes'),
  (216,'Wallis and Futuna ','Collectivity of the Wallis and Futuna Islands \t','Dependency ','Overseas Collectivity ','France ','Mata''utu ','XPF ','Franc ','+681 ','WF ','WLF \t','876 ','.wf ','yes'),
  (217,'French Southern and Antarctic Lands ','Territory of the French Southern and Antarctic Lands ','Dependency ','Overseas Territory ','France ','Martin-de-Vivi�s ',NULL,NULL,NULL,'TF ','ATF ','260 ','.tf ','yes'),
  (218,'Clipperton Island ',NULL,'Dependency \t','Possession ','France ',NULL,NULL,NULL,NULL,'PF ','PYF ','258 ','.pf ','yes'),
  (219,'Bouvet Island','','Dependency ','Territory ','Norway ',NULL,NULL,NULL,NULL,'BV ','BVT ','074 ','.bv ','yes'),
  (220,'Cook Islands ',NULL,'Dependency \t','Self-Governing in Free Association ','New Zealand','Avarua ','NZD ','Dollar ','+682 ','CK ','COK ','184 ','.ck ','yes'),
  (221,'Niue ','','Dependency','Self-Governing in Free Association ','New Zealand ','Alofi ','NZD ','Dollar ','+683 ','NU ','NIU ','570 ','.nu ','yes'),
  (222,'Tokelau ',NULL,'Dependency','Territory ','New Zealand ',NULL,'NZD ','Dollar ','+690','TK ','TKL ','772 ','.tk ','yes'),
  (223,'Guernsey ','Bailiwick of Guernsey ','Dependency','Crown Dependency ','United Kingdom ','Saint Peter Port ','GGP ','Pound','+44 ','GG ','GGY','831 ','.gg ','yes'),
  (224,'Isle of Man ',NULL,'Dependency \t','Crown Dependency ','United Kingdom ','Douglas ','IMP ','Pound ','+44 ','IM ','IMN ','833 ','.im ','yes'),
  (225,'Jersey ','Bailiwick of Jersey ','Dependency \t','Crown Dependency ','United Kingdom ','Saint Helier ','JEP ','Pound ','+44 ','JE ','JEY ','832 ','.je ','yes'),
  (226,'Anguilla ','','Dependency','Overseas Territory ','Overseas Territory ','The Valley ','XCD ','Dollar','+1-264 ','AI','AIA ','660 ','.ai ','yes'),
  (227,'Bermuda ','','Dependency','Overseas Territory ','United Kingdom ','Hamilton ','BMD ','Dollar ','+1-441 ','BM ','BMU','060 ','.bm ','yes'),
  (228,'British Indian Ocean Territory ',NULL,'Dependency','Overseas Territory ','United Kingdom ',NULL,NULL,NULL,'+246 ','IO ','IOT ','086 ','.io ','yes'),
  (229,'British Sovereign Base Areas ',NULL,'Dependency','Overseas Territory ','United Kingdom ','Episkopi ','CYP ','Pound ','+357 ',NULL,NULL,NULL,NULL,'yes'),
  (230,'British Virgin Islands ','','Dependency','Overseas Territory ','United Kingdom ','Road Town ','USD ','Dollar ','+1-284 ','VG ','VGB','092 ','.vg ','yes'),
  (231,'Cayman Islands ',NULL,'Dependency ','Overseas Territory ','United Kingdom','George Town ','KYD ','Dollar ','+1-345 ','KY ','CYM ','136 ','.ky ','yes'),
  (232,'Falkland Islands (Islas Malvinas) ',NULL,'Dependency \t','Overseas Territory ','United Kingdom ','Stanley ','FKP ','Pound ','+500 ','FK ','FLK','238 ','.fk ','yes'),
  (233,'Gibraltar ',NULL,'Dependency \t','Overseas Territory ','United Kingdom ','Gibraltar ','GIP ','Pound ','+350 ','GI \t','GIB ','292 ','.gi ','yes'),
  (234,'Montserrat ',NULL,'Dependency ','Overseas Territory ','United Kingdom','Plymouth ','XCD ','Dollar ','+1-664 ','MS','MSR','500 ','.ms ','yes'),
  (235,'Pitcairn Islands ',NULL,'Dependency ','Overseas Territory ','United Kingdom ','Adamstown ','NZD ','Dollar ',NULL,'PN ','PCN ','612 ','.pn ','yes'),
  (236,'Saint Helena',NULL,'Dependency \t','Overseas Territory ','United Kingdom ','Jamestown ','SHP ','Pound ','+290 ','SH ','SHN ','654 ','.sh ','yes'),
  (237,'South Georgia and the South Sandwich Islands ',NULL,'Dependency ','Overseas Territory ','United Kingdom ',NULL,NULL,NULL,NULL,'GS ','SGS ','239 ','.gs ','yes'),
  (238,'Turks and Caicos Islands ',NULL,'Dependency ','Overseas Territory ','United Kingdom ','Grand Turk ','USD ','Dollar','+1-649 ','TC ','TCA ','796','.tc ','yes'),
  (239,'Northern Mariana Islands ','Commonwealth of The Northern Mariana Islands','Dependency \t','Commonwealth \t','United States \t','Saipan ','USD ','Dollar ','+1-670','MP ','MNP ','580 ','.mp ','yes'),
  (240,'Puerto Rico','Commonwealth of Puerto Rico ','Dependency ','Commonwealth \t','United States ','San Juan ','USD ','Dollar ','+1-787 and 1-939 ','PR ','PRI ','630 ','.pr ','yes'),
  (241,'American Samoa ','Territory of American Samoa ','Dependency','Territory ','United States','Pago Pago ','USD ','Dollar','+1-684 ','AS ','ASM ','016 ','.as ','yes'),
  (242,'Baker Island ',NULL,'Dependency \t','Territory ','United States \t',NULL,NULL,NULL,NULL,'UM ','UMI','581 ',NULL,'yes'),
  (243,'Guam ','Territory of Guam ','Dependency','Territory ','United States ','Hagatna ','USD ','Dollar','+1-671 ','GU','GUM ','316 ','.gu ','yes'),
  (244,'Howland Island ',NULL,'Dependency \t','Territory ','United States ',NULL,NULL,NULL,NULL,'UM ','UMI \t','581',NULL,'yes'),
  (245,'Jarvis Island ',NULL,'Dependency ','Territory ','United States ',NULL,NULL,NULL,NULL,'UM ','UMI ','581 ',NULL,'yes'),
  (246,'Johnston Atoll ',NULL,'Dependency \t','Territory ','United States',NULL,NULL,NULL,NULL,'UM ','UMI ','581 ',NULL,'yes'),
  (247,'Kingman Reef ',NULL,'Dependency \t','Territory ','United States \t',NULL,NULL,NULL,NULL,'UM ','UMI ','581 ',NULL,'yes'),
  (248,'Midway Islands ',NULL,'Dependency ','Territory ','United States \t',NULL,NULL,NULL,NULL,'UM ','UMI ','581 ',NULL,'yes'),
  (249,'Navassa Island ',NULL,'Dependency ','Territory ','United States \t','',NULL,NULL,' \t','UM \t','UMI ','581 ',NULL,'yes'),
  (250,'Palmyra Atoll \t',NULL,'Dependency ','Territory ','United States \t',NULL,NULL,NULL,NULL,'UM ','UMI ','581 ',NULL,'yes'),
  (251,'U.S. Virgin Islands ','United States Virgin Islands ','Dependency ','Territory ','United States ','Charlotte Amalie ','USD ','Dollar ','+1-340 ','VI ','VIR ','850 ','.vi ','yes'),
  (252,'Wake Island',NULL,'Dependency \t','Territory \t','United States',NULL,NULL,NULL,NULL,'UM ','UMI ','850 ',NULL,'yes'),
  (253,'Hong Kong ','Hong Kong Special Administrative Region ','Proto Dependency ','Special Administrative Region ','China ','','HKD ','Dollar','+852 ','HK ','HKG','344 ','.hk ','yes'),
  (254,'Macau ','Macau Special Administrative Region ','Proto Dependency ','Special Administrative Region ','China ','Macau ','MOP ','Pataca ','+853 ','MO ','MAC ','446','.mo ','yes'),
  (255,'Faroe Islands',NULL,'Proto Dependency \t',NULL,'Denmark ','Torshavn ','DKK ','Krone ','+298','FO ','FRO ','234 ','.fo ','yes'),
  (256,'Greenland \t',NULL,'Proto Dependency ',NULL,'Denmark ','Nuuk (Godthab) ','DKK ','Krone ','+299 ','GL ','GRL ','304 ','.gl ','yes'),
  (257,'French Guiana ','Overseas Region of Guiana ','Proto Dependency ','Overseas Region ','France ','Cayenne','EUR ','Euro ','+594 ','GF ','GUF ','254 ','.gf ','yes'),
  (258,'Guadeloupe ','Overseas Region of Guadeloupe ','Proto Dependency ','Overseas Region ','France ','Basse-Terre ','EUR ','Euro ','+590 ','GP ','GLP ','312 ','.gp ','yes'),
  (259,'Martinique','Overseas Region of Martinique ','Proto Dependency','Overseas Region ','France ','Fort-de-France','EUR ','Euro ','+596 ','MQ ','MTQ ','474 ','.mq ','yes'),
  (260,'Reunion ','Overseas Region of Reunion ','Proto Dependency','Overseas Region ','France ','Saint-Denis ','EUR ','Euro','+262 ','RE ','REU','638 ','.re ','yes'),
  (261,'Aland',NULL,'Proto Dependency \t',NULL,'Finland ','Mariehamn ','EUR','Euro ','+358-18 ','AX ','ALA ','248 ','.ax ','yes'),
  (262,'Aruba ',NULL,'Proto Dependency \t',NULL,'Netherlands ','Oranjestad ','AWG ','Guilder ','+297 ','AW ','ABW ','533 ','.aw ','yes'),
  (263,'Netherlands Antilles ','','Proto Dependency \t',NULL,'Netherlands ','Willemstad ','ANG ','Guilder ','+599 ','AN ','ANT ','530 ','.an ','yes'),
  (264,'Svalbard ',NULL,'Proto Dependency',NULL,'Norway ','Longyearbyen ','NOK ','Krone ','+47 ','SJ ','SJM ','744 ','.sj ','yes'),
  (265,'Ascension ',NULL,'Proto Dependency','Dependency of Saint Helena ','United Kingdom ','Georgetown ','SHP ','Pound ','+247 ','AC ','ASC ',NULL,'.ac ','yes'),
  (266,'Tristan da Cunha ',NULL,'Proto Dependency','Dependency of Saint Helena ','United Kingdom ','Edinburgh ','SHP ','Pound \t','+290 ','TA ','TAA',NULL,NULL,'yes'),
  (267,'Antarctica ',NULL,'Disputed Territory \t',NULL,'Undetermined',NULL,NULL,NULL,NULL,'AQ ','ATA ','010 ','.aq ','yes'),
  (268,'Kosovo ',NULL,'Disputed Territory ',NULL,'Administrated by the UN ','Pristina ','CSD and EUR ','Dinar and Euro ','+381 ','CS','SCG','891 ','.cs and .y','yes'),
  (269,'Palestinian Territories (Gaza Strip and West Bank)','','Disputed Territory ','','Administrated by Israel ','Gaza City (Gaza Strip) and Ramallah (West Bank) ','ILS ','Shekel ','+970 ','PS ','PSE','275 ','.ps ','yes'),
  (270,'Western Sahara ',NULL,'Disputed Territory ',NULL,'Administrated by Morocco ','El-Aaiun ','MAD ','Dirham ','+212 ','EH ','ESH ','732 ','.eh ','yes'),
  (271,'Australian Antarctic Territory ','','Antarctic Territory ','External Territory ','Australia ',NULL,NULL,NULL,NULL,'AQ ','ATA ','010 ','.aq ','yes'),
  (272,'Ross Dependency ','Antarctic Territory ','Territory ','New Zealand','',NULL,NULL,NULL,NULL,'AQ ','ATA ','010','.aq ','yes'),
  (273,'Peter I Island ','','Antarctic Territory ','Territory ','Norway ',NULL,NULL,NULL,NULL,'AQ ','ATA ','010','.aq ','yes'),
  (274,'Queen Maud Land ',NULL,'Antarctic Territory ','Territory ','Norway ',NULL,NULL,NULL,NULL,'AQ','ATA ','010 ','.aq ','yes'),
  (275,'British Antarctic Territory ','','Antarctic Territory ','Overseas Territory ','United Kingdom ',NULL,NULL,NULL,NULL,'AQ ','ATA ','010 ','.aq ','yes');
COMMIT;

#
# Data for the `g_currencies` table  (LIMIT 0,500)
#

INSERT INTO `g_currencies` (`id`, `currency_code`, `currency_name`, `currency_symbol`) VALUES 
  (1,'AED','United Arab Emirates Dirham',NULL),
  (2,'AFN','Afghanistan Afghani','?'),
  (3,'ALL','Albania Lek','Lek'),
  (4,'AMD','Armenia Dram',NULL),
  (5,'ANG','Netherlands Antilles Guilder',NULL),
  (6,'AOA','Angola Kwanza',NULL),
  (7,'ARS','Argentina Peso','$'),
  (8,'AUD','Australia Dollar','$'),
  (9,'AWG','Aruba Guilder','�'),
  (10,'AZN','Azerbaijan New Manat','???'),
  (11,'BAM','Bosnia and Herzegovina Convertible Marka','KM'),
  (12,'BBD','Barbados Dollar','$'),
  (13,'BDT','Bangladesh Taka',NULL),
  (14,'BGN','Bulgaria Lev','??'),
  (15,'BHD','Bahrain Dinar',NULL),
  (16,'BIF','Burundi Franc',NULL),
  (17,'BMD','Bermuda Dollar','$'),
  (18,'BND','Brunei Darussalam Dollar','$'),
  (19,'BOB','Bolivia Boliviano','$b'),
  (20,'BRL','Brazil Real','R$'),
  (21,'BSD','Bahamas Dollar','$'),
  (22,'BTN','Bhutan Ngultrum',NULL),
  (23,'BWP','Botswana Pula','P'),
  (24,'BYR','Belarus Ruble','p.'),
  (25,'BZD','Belize Dollar','BZ$'),
  (26,'CAD','Canada Dollar','$'),
  (27,'CDF','Congo/Kinshasa Franc',NULL),
  (28,'CHF','Switzerland Franc',NULL),
  (29,'CLP','Chile Peso','$'),
  (30,'CNY','China Yuan Renminbi','�'),
  (31,'COP','Colombia Peso','$'),
  (32,'CRC','Costa Rica Colon','�'),
  (33,'CUC','Cuba Convertible Peso',NULL),
  (34,'CUP','Cuba Peso','?'),
  (35,'CVE','Cape Verde Escudo',NULL),
  (36,'CZK','Czech Republic Koruna',NULL),
  (37,'DJF','Djibouti Franc',NULL),
  (38,'DKK','Denmark Krone',NULL),
  (39,'DOP','Dominican Republic Peso',NULL),
  (40,'DZD','Algeria Dinar',NULL),
  (41,'EGP','Egypt Pound',NULL),
  (42,'ERN','Eritrea Nakfa',NULL),
  (43,'ETB','Ethiopia Birr',NULL),
  (44,'EUR','Euro Member Countries',NULL),
  (45,'FJD','Fiji Dollar',NULL),
  (46,'FKP','Falkland Islands (Malvinas) Pound',NULL),
  (47,'GBP','United Kingdom Pound',NULL),
  (48,'GEL','Georgia Lari',NULL),
  (49,'GGP','Guernsey Pound',NULL),
  (50,'GHS','Ghana Cedi',NULL),
  (51,'GIP','Gibraltar Pound',NULL),
  (52,'GMD','Gambia Dalasi',NULL),
  (53,'GNF','Guinea Franc',NULL),
  (54,'GTQ','Guatemala Quetzal',NULL),
  (55,'GYD','Guyana Dollar',NULL),
  (56,'HKD','Hong Kong Dollar',NULL),
  (57,'HNL','Honduras Lempira',NULL),
  (58,'HRK','Croatia Kuna','kn'),
  (59,'HTG','Haiti Gourde',NULL),
  (60,'HUF','Hungary Forint',NULL),
  (61,'IDR','Indonesia Rupiah',NULL),
  (62,'ILS','Israel Shekel',NULL),
  (63,'IMP','Isle of Man Pound',NULL),
  (64,'INR','India Rupee',NULL),
  (65,'IQD','Iraq Dinar',NULL),
  (66,'IRR','Iran Rial',NULL),
  (67,'ISK','Iceland Krona',NULL),
  (68,'JEP','Jersey Pound',NULL),
  (69,'JMD','Jamaica Dollar',NULL),
  (70,'JOD','Jordan Dinar',NULL),
  (71,'JPY','Japan Yen',NULL),
  (72,'KES','Kenya Shilling',NULL),
  (73,'KGS','Kyrgyzstan Som',NULL),
  (74,'KHR','Cambodia Riel','?'),
  (75,'KMF','Comoros Franc',NULL),
  (76,'KPW','Korea (North) Won',NULL),
  (77,'KRW','Korea (South) Won',NULL),
  (78,'KWD','Kuwait Dinar',NULL),
  (79,'KYD','Cayman Islands Dollar','$'),
  (80,'KZT','Kazakhstan Tenge',NULL),
  (81,'LAK','Laos Kip',NULL),
  (82,'LBP','Lebanon Pound',NULL),
  (83,'LKR','Sri Lanka Rupee',NULL),
  (84,'LRD','Liberia Dollar',NULL),
  (85,'LSL','Lesotho Loti',NULL),
  (86,'LTL','Lithuania Litas',NULL),
  (87,'LVL','Latvia Lat',NULL),
  (88,'LYD','Libya Dinar',NULL),
  (89,'MAD','Morocco Dirham',NULL),
  (90,'MDL','Moldova Leu',NULL),
  (91,'MGA','Madagascar Ariary',NULL),
  (92,'MKD','Macedonia Denar',NULL),
  (93,'MMK','Myanmar (Burma) Kyat',NULL),
  (94,'MNT','Mongolia Tughrik',NULL),
  (95,'MOP','Macau Pataca',NULL),
  (96,'MRO','Mauritania Ouguiya',NULL),
  (97,'MUR','Mauritius Rupee',NULL),
  (98,'MVR','Maldives (Maldive Islands) Rufiyaa',NULL),
  (99,'MWK','Malawi Kwacha',NULL),
  (100,'MXN','Mexico Peso',NULL),
  (101,'MYR','Malaysia Ringgit',NULL),
  (102,'MZN','Mozambique Metical',NULL),
  (103,'NAD','Namibia Dollar',NULL),
  (104,'NGN','Nigeria Naira',NULL),
  (105,'NIO','Nicaragua Cordoba',NULL),
  (106,'NOK','Norway Krone',NULL),
  (107,'NPR','Nepal Rupee',NULL),
  (108,'NZD','New Zealand Dollar',NULL),
  (109,'OMR','Oman Rial',NULL),
  (110,'PAB','Panama Balboa',NULL),
  (111,'PEN','Peru Nuevo Sol',NULL),
  (112,'PGK','Papua New Guinea Kina',NULL),
  (113,'PHP','Philippines Peso',NULL),
  (114,'PKR','Pakistan Rupee',NULL),
  (115,'PLN','Poland Zloty',NULL),
  (116,'PYG','Paraguay Guarani',NULL),
  (117,'QAR','Qatar Riyal',NULL),
  (118,'RON','Romania New Leu',NULL),
  (119,'RSD','Serbia Dinar',NULL),
  (120,'RUB','Russia Ruble',NULL),
  (121,'RWF','Rwanda Franc',NULL),
  (122,'SAR','Saudi Arabia Riyal',NULL),
  (123,'SBD','Solomon Islands Dollar',NULL),
  (124,'SCR','Seychelles Rupee',NULL),
  (125,'SDG','Sudan Pound',NULL),
  (126,'SEK','Sweden Krona',NULL),
  (127,'SGD','Singapore Dollar',NULL),
  (128,'SHP','Saint Helena Pound',NULL),
  (129,'SLL','Sierra Leone Leone',NULL),
  (130,'SOS','Somalia Shilling',NULL),
  (131,'SPL','Seborga Luigino',NULL),
  (132,'SRD','Suriname Dollar',NULL),
  (133,'STD','São Tomé and Príncipe Dobra',NULL),
  (134,'SVC','El Salvador Colon',NULL),
  (135,'SYP','Syria Pound',NULL),
  (136,'SZL','Swaziland Lilangeni',NULL),
  (137,'THB','Thailand Baht',NULL),
  (138,'TJS','Tajikistan Somoni',NULL),
  (139,'TMT','Turkmenistan Manat',NULL),
  (140,'TND','Tunisia Dinar',NULL),
  (141,'TOP','Tonga Pa''anga',NULL),
  (142,'TRY','Turkey Lira',NULL),
  (143,'TTD','Trinidad and Tobago Dollar',NULL),
  (144,'TVD','Tuvalu Dollar',NULL),
  (145,'TWD','Taiwan New Dollar',NULL),
  (146,'TZS','Tanzania Shilling',NULL),
  (147,'UAH','Ukraine Hryvna',NULL),
  (148,'UGX','Uganda Shilling',NULL),
  (149,'USD','United States Dollar',NULL),
  (150,'UYU','Uruguay Peso',NULL),
  (151,'UZS','Uzbekistan Som',NULL),
  (152,'VEF','Venezuela Bolivar',NULL),
  (153,'VND','Viet Nam Dong',NULL),
  (154,'VUV','Vanuatu Vatu',NULL),
  (155,'WST','Samoa Tala',NULL),
  (156,'XAF','Communauté Financière Africaine (BEAC) CFA Franc BEAC',NULL),
  (157,'XCD','East Caribbean Dollar',NULL),
  (158,'XDR','International Monetary Fund (IMF) Special Drawing Rights',NULL),
  (159,'XOF','Communauté Financière Africaine (BCEAO) Franc',NULL),
  (160,'XPF','Comptoirs Français du Pacifique (CFP) Franc',NULL),
  (161,'YER','Yemen Rial',NULL),
  (162,'ZAR','South Africa Rand',NULL),
  (163,'ZMW','Zambia Kwacha',NULL),
  (164,'ZWD','Zimbabwe Dollar',NULL);
COMMIT;

#
# Data for the `g_group_tasks` table  (LIMIT 0,500)
#

INSERT INTO `g_group_tasks` (`id`, `group_id`, `task_id`, `modified_date`) VALUES 
  (9,NULL,2,1380202302);
COMMIT;

#
# Data for the `g_logins` table  (LIMIT 0,500)
#

INSERT INTO `g_logins` (`id`, `group_id`, `user_first_name`, `user_last_name`, `login_name`, `login_pass`, `image_name`, `is_active`) VALUES 
  (1,1,'Pronab','Saha','admin','cfc773db59db49193621ff8f315b37566ad56f3e$255fdf803b3c31149f2c842675a201be4ac41a54','profile.jpg','yes'),
  (5,2,'pronab','saha','developer','19fc2a762b2a3664df77c10287a314025dd08078$519ace4a8cbb2a3e9468ba28338394f3f860027e','','yes');
COMMIT;

#
# Data for the `g_security_questions` table  (LIMIT 0,500)
#

INSERT INTO `g_security_questions` (`id`, `question`) VALUES 
  (1,'Who is your childhood hero?'),
  (2,'What is your pet name?');
COMMIT;

#
# Data for the `g_sessions` table  (LIMIT 0,500)
#

INSERT INTO `g_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES 
  ('94cf6edb2e8d58dea1ed9013d188576b','::1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.76 Safari/537.36',1380693855,'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"login_data\";a:11:{s:7:\"user_id\";s:1:\"1\";s:10:\"first_name\";s:6:\"Pronab\";s:9:\"last_name\";s:4:\"Saha\";s:10:\"login_name\";s:5:\"admin\";s:10:\"login_pass\";s:81:\"cfc773db59db49193621ff8f315b37566ad56f3e$255fdf803b3c31149f2c842675a201be4ac41a54\";s:11:\"login_image\";s:11:\"profile.jpg\";s:8:\"group_id\";s:1:\"1\";s:10:\"group_name\";s:19:\"Super Administrator\";s:6:\"active\";s:3:\"yes\";s:9:\"user_name\";s:11:\"Pronab Saha\";s:3:\"tid\";s:88:\"mqtF0zsn0bZo9t~gtBiOk4OM~t5CdUCYp0JJjyyFuJfjYmX6IkeH3eLa27072ES~MXTW9Na9lsZITjPYTkBg3g--\";}}');
COMMIT;

#
# Data for the `g_system_tasks` table  (LIMIT 0,500)
#

INSERT INTO `g_system_tasks` (`id`, `task_name`, `parent_task_id`, `controller_name`, `function_name`, `sorting_order`, `category`, `is_active`) VALUES 
  (1,'System',0,'NULL','NULL',1,'Menu','yes'),
  (2,'User groups',1,'usergroups','index',1,'Menu','yes'),
  (3,'Users',1,'users','index',2,'Menu','yes'),
  (4,'Module Registration',1,'modules','index',3,'Menu','yes'),
  (5,'Installer maker',0,'NULL','NULL',4,'Menu','yes'),
  (6,'Create installer',5,'installer','index',1,'Menu','yes');
COMMIT;

#
# Data for the `g_user_contacts` table  (LIMIT 0,500)
#

INSERT INTO `g_user_contacts` (`id`, `login_id`, `address`, `city`, `state`, `zip`, `country`, `email`, `phone`, `mobile`, `is_active`) VALUES 
  (1,1,'Malibagh, Dhaka','Dhaka','Dhaka','1217','Bangladesh','pranab.su@gmail.com','+8801711982980','+8801711982980','yes'),
  (5,5,'','Dhaka','','1217','Bangladesh','pranab_su@yahoo.com','','','yes');
COMMIT;

#
# Data for the `g_user_groups` table  (LIMIT 0,500)
#

INSERT INTO `g_user_groups` (`id`, `group_name`, `is_active`) VALUES 
  (1,'Super Administrator','yes'),
  (2,'Developer','yes');
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;