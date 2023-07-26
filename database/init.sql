CREATE DATABASE `sportisimo` COLLATE 'utf8mb4_unicode_520_ci';

CREATE TABLE `brands` (
  `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) COLLATE 'utf8mb4_unicode_520_ci' NOT NULL,
  `created_at` datetime NOT NULL DEFAULT NOW(),
  `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB' COLLATE 'utf8mb4_unicode_520_ci';

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'Nike',	'2023-07-22 22:20:51',	NULL),
(2,	'Adidas',	'2023-07-22 22:21:00',	NULL),
(3,	'Puma',	'2023-07-22 22:21:06',	NULL),
(4,	'Reebok',	'2023-07-22 22:21:44',	NULL),
(5,	'Vans',	'2023-07-22 22:22:06',	NULL),
(6,	'Umbro',	'2023-07-22 22:22:10',	NULL),
(7,	'New Balance',	'2023-07-22 22:22:32',	NULL),
(8,	'FILA',	'2023-07-22 22:23:13',	NULL),
(9,	'Under Armor',	'2023-07-22 22:23:27',	NULL),
(10,	'Northface',	'2023-07-22 22:23:47',	NULL);
