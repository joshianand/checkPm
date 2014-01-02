#
# TABLE STRUCTURE FOR: unavailable_domains
#

DROP TABLE IF EXISTS unavailable_domains;

CREATE TABLE `unavailable_domains` (
  `domain_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification value',
  `domain_name` varchar(500) DEFAULT NULL COMMENT 'Domain name',
  `modified_date` bigint(20) DEFAULT NULL COMMENT 'Modified date',
  PRIMARY KEY (`domain_id`),
  FULLTEXT KEY `domain_name` (`domain_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Unavailable domain list';

#
# TABLE STRUCTURE FOR: supplied_keywords
#

DROP TABLE IF EXISTS supplied_keywords;

CREATE TABLE `supplied_keywords` (
  `keyword_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#
# TABLE STRUCTURE FOR: generated_domains
#

DROP TABLE IF EXISTS generated_domains;

CREATE TABLE `generated_domains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Primary identification key',
  `generated_id` varchar(100) DEFAULT NULL COMMENT 'Genearted id',
  `slogan_or_keyword_id` bigint(20) DEFAULT NULL COMMENT 'Slogan/Keyword reference',
  `domain_name` varchar(500) DEFAULT NULL COMMENT 'Domain name',
  `domain_type` enum('com','net','us') DEFAULT 'com' COMMENT 'Domain type',
  `generation_source` enum('slogan','keyword') DEFAULT 'slogan' COMMENT 'Generation source',
  `status` enum('used','free') DEFAULT 'free' COMMENT 'Domain used status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Generated domain list';

