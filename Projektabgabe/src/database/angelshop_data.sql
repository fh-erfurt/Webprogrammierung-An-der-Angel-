--
-- Daten für Tabelle `address`
--

INSERT INTO `angelshop`.`address` (`id`, `createdAt`, `updatedAt`, `street`, `streetNo`, `zip`, `city`, `country`) VALUES
(1, '2021-01-06 09:11:54', NULL, 'Altonaer Straße', 25, '99085', 'Erfurt', 'Deutschland');


--
-- Daten für Tabelle `account`
--

INSERT INTO `angelshop`.`account` (`id`, `createdAt`, `updatedAt`, `firstName`, `lastName`, `birthdate`, `email`, `password`, `address`) VALUES
(1, '2021-01-06 09:12:44', NULL, 'Max', 'Mustermann', '2001-01-06', 'e@mail.de', '$2y$10$OM4sLSM4BiVSrvmebJLrP.UxQeq2Q3Aa8vLp3fRMqOy8jIgZtuIjq', 1);


--
-- Daten für Tabelle `category`
--

INSERT INTO `angelshop`.`category` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
(1, '2021-01-06 09:11:32', NULL, 'Gummifisch'),
(2, '2021-01-06 09:11:32', NULL, 'Wobbler'),
(3, '2021-01-06 09:11:32', NULL, 'Blinker'),
(4, '2021-01-06 09:11:32', NULL, 'Spinner'),
(5, '2021-01-06 09:11:32', NULL, 'Pilker'),
(6, '2021-01-06 09:11:32', NULL, 'Fliegen'),
(7, '2021-01-06 09:11:32', NULL, 'Vorfächer'),
(8, '2021-01-06 09:11:32', NULL, 'Haken'),
(9, '2021-01-06 09:11:32', NULL, 'Bleiköpfe');


--
-- Daten für Tabelle `color`
--

INSERT INTO `angelshop`.`color` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
(1, '2021-01-06 09:10:45', NULL, 'transparent'),
(2, '2021-01-06 09:10:45', NULL, 'weiß'),
(3, '2021-01-06 09:10:45', NULL, 'gelb'),
(4, '2021-01-06 09:10:45', NULL, 'orange'),
(5, '2021-01-06 09:10:45', NULL, 'rot'),
(6, '2021-01-06 09:10:45', NULL, 'grün'),
(7, '2021-01-06 09:10:45', NULL, 'blau'),
(8, '2021-01-06 09:10:45', NULL, 'lila'),
(9, '2021-01-06 09:10:45', NULL, 'pink'),
(10, '2021-01-06 09:10:45', NULL, 'braun'),
(11, '2021-01-06 09:10:45', NULL, 'schwarz'),
(12, '2021-01-06 09:10:45', NULL, 'silber'),
(13, '2021-01-06 09:10:45', NULL, 'gold'),
(14, '2021-01-06 09:10:45', NULL, 'mehrfarbig'),
(15, '2021-01-06 09:10:45', NULL, 'grau');


--
-- Daten für Tabelle `material`
--

INSERT INTO `angelshop`.`material` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
(1, '2021-01-06 09:09:19', NULL, 'Gummimischung'),
(2, '2021-01-06 09:09:19', NULL, 'Blei'),
(3, '2021-01-06 09:09:19', NULL, 'Edelstahl'),
(4, '2021-01-06 09:09:19', NULL, 'Blech'),
(5, '2021-01-06 09:09:19', NULL, 'Fluoro-Carbon'),
(6, '2021-01-06 09:09:19', NULL, 'Fluo-Carbon'),
(7, '2021-01-06 09:09:19', NULL, 'Hardmono'),
(8, '2021-01-06 09:25:19', NULL, 'PVC');


--
-- Daten für Tabelle `manufacturer`
--

INSERT INTO `angelshop`.`manufacturer` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
(1, '2021-01-06 09:17:07', NULL, 'Lieblingsköder'),
(2, '2021-01-06 09:17:07', NULL, 'Balzer'),
(3, '2021-01-06 09:17:07', NULL, 'Gamakatsu'),
(4, '2021-01-06 09:17:07', NULL, 'Fladen'),
(5, '2021-01-06 09:17:07', NULL, 'SavageGear'),
(6, '2021-01-06 09:17:07', NULL, 'Zeck Fishing'),
(7, '2021-01-06 09:17:07', NULL, 'Kopyto'),
(8, '2021-01-06 09:17:07', NULL, 'Cormoran'),
(9, '2021-01-06 09:17:07', NULL, 'D A M'),
(10, '2021-01-06 09:29:56', NULL, 'Rapala'),
(11, '2021-01-06 09:30:20', NULL, 'Shimano'),
(12, '2021-01-06 09:30:20', NULL, 'Spro'),
(13, '2021-01-06 09:30:20', NULL, 'Illex'),
(14, '2021-02-22 09:30:20', NULL, '#LMAB'),
(15, '2021-02-22 09:30:20', NULL, 'Daiwa'),
(16, '2021-02-22 09:30:20', NULL, 'Westin');


--
-- Daten für Tabelle `products`
--

INSERT INTO `angelshop`.`products` (`id`, `createdAt`, `updatedAt`, `name`, `image`, `price`, `discount`, `amount`, `size`, `weight`, `color`, `material`, `manufacturer`, `category`) VALUES
(1, '2021-01-06 09:23:22', NULL, 'Möhrchen', 'gummifisch_moehrchen.jpg', '5.99', 10, 3, '10 cm', NULL, 4, 1, 1, 1),
(2, '2021-01-06 09:23:22', NULL, 'Whisky', 'gummifisch_whisky.jpg', '7.99', 0, 5, '5 cm', NULL, 3, 1, 1, 1),
(3, '2021-01-06 09:29:32', NULL, 'Headbanger Shad - Suspending', 'wobbler_suspending.jpg', '14.99', 0, 1, '22 cm', '73 g', 11, 8, 1, 2),
(4, '2021-01-06 09:29:32', NULL, 'Flachläufer - Firetiger', 'wobbler_firetiger.jpg', '17.49', 0, 1, '9 cm', NULL, 14, 8, 1, 2),
(5, '2021-01-06 09:35:11', NULL, 'Effzett - Krautblinker', 'blinker_kraut.jpg', '5.99', 10, 1, '4,5 cm', '16 g', 12, 3, 9, 3),
(6, '2021-01-06 09:35:11', NULL, 'Blinker-Set mit Krautschutz', 'blinker_krautschutz.jpg', '7.99', 0, 3, '5 cm', '18 g', 14, 3, 4, 3),
(7, '2021-01-06 09:42:27', NULL, 'Bullet Spinner mit Einzelhaken', 'spinner_bullet.jpg', '2.99', 0, 1, '3,5 cm / Hakengröße 1', '3 g', 12, 3, 8, 4),
(8, '2021-01-06 09:42:27', NULL, 'Predator Pike - Surface Spinner', 'spinner_pike.jpg', '6.99', 0, 1, '11 cm', '21 g', 12, 3, 4, 4),
(9, '2021-01-06 09:48:57', NULL, 'Salt-X Pilk - Blades Lure Pilker - Mackerel', 'pilker_lure.jpg', '19.79', 0, 1, '4/0 Haken', '350 g', 14, 3, 9, 5),
(10, '2021-01-06 09:48:57', NULL, 'Salt 3D Slim Jig Minnow - Sardine', 'pilker_sardine.jpg', '9.90', 0, 1, '12,5 cm', '60 g', 12, 3, 5, 5),
(11, '2021-01-06 09:55:00', NULL, 'Goldkopfnymphen-Sortiment', 'fliegen_goldnymphen.jpg', '8.79', 10, 8, NULL, '2,2 g', 14, 3, 2, 6),
(12, '2021-01-06 09:55:00', NULL, 'Nassfliegen- / Nymphensortiment', 'fliegen_nass.jpg', '8.79', 20, 1, NULL, '2,2 g', 14, 3, 2, 6),
(13, '2021-01-06 10:04:37', NULL, 'Pike Fighter Fine Leader - 1x19', 'vorfach_fighter.jpg', '2.95', 0, 1, '20 cm / 0,34 mm', '6,8 kg Tragkraft', 3, 3, 12, 7),
(14, '2021-01-06 10:04:37', NULL, 'Carbon49 Trace - 7x7', 'vorfach_trace.jpg', '4.95', 0, 1, '40 cm / 0,60 mm', '16 kg Tragkraft', 15, 6, 5, 7),
(15, '2021-01-06 10:10:35', NULL, 'Carp Ring Eye Barbless - Schonhaken - lose', 'haken_barbless.jpg', '2.79', 0, 10, '10', NULL, 12, 3, 3, 8),
(16, '2021-01-06 10:10:35', NULL, 'Chebu Hook Mini für Cheburashka-Köpfe', 'haken_cheburashka.jpg', '3.99', 10, 5, '6', NULL, 12, 3, 6, 8),
(17, '2021-01-06 10:17:25', NULL, 'Rattle Jigg Heads UV', 'bleikopf_rattleuvp.jpg', '5.99', 0, 1, '10/0', '100 g', 4, 2, 5, 9),
(18, '2021-01-06 10:17:25', NULL, 'No. 1 Jighead Round', 'bleikopf_round.jpg', '4.95', 10, 4, '5/0', '10 g', 15, 2, 12, 9),
(19, '2021-02-22 10:17:25', NULL, 'Finesse Filet - Firetiger', 'gummifisch_firetiger.jpg', '5.99', 0, 4, '7 cm', NULL, 15, 1, 14, 1),
(20, '2021-02-22 10:17:25', NULL, 'Prorex Classic Shad Pre-Rigged Zander / Perch Kit', 'gummifisch_prorex.jpg', '9.99', 0, 3, '10 cm - #2/0', '7,5 g', 15, 1, 15, 1),
(21, '2021-02-22 10:17:25', NULL, 'Magic', 'gummifisch_magic.jpg', '6.99', 0, 3, '15 cm', NULL, 15, 1, 1, 1),
(22, '2021-02-22 10:17:25', NULL, 'Plankton', 'gummifisch_plankton.jpg', '6.99', 20, 5, '7 cm', NULL, 6, 1, 1, 1),
(23, '2021-02-22 10:17:25', NULL, 'BullTeez - Blue Headlight', 'gummifisch_headlight.jpg', '2.29', 0, 1, '9,5 cm', NULL, 2, 1, 16, 1),
(24, '2021-02-22 10:17:25', NULL, 'Micro Dart Jighead', 'bleikopf_dart.jpg', '4.95', 0, 5, '#8', '1,2 g', 15, 2, 5, 9),
(25, '2021-02-22 10:17:25', NULL, 'Spitze Haken - Blackheads 5/0', 'bleikopf_blackheads.jpg', '4.99', 10, 1, '5/0', '50 g', 11, 2, 1, 9),
(26, '2021-02-22 10:17:25', NULL, 'Spitze Haken - NEO zum Dorschangeln 5/0', 'bleikopf_neo.jpg', '3.99', 0, 1, '5/0', '40 g', 6, 2, 1, 9),
(27, '2021-02-22 10:17:25', NULL, 'Spitze Haken #1', 'bleikopf_spitzehaken.jpg', '2.99', 0, 3, '#1', '12 g', 12, 2, 1, 9),
(28, '2021-02-22 10:17:25', NULL, 'EFFZETT Original Standard Spinner #5', 'spinner_original.jpg', '3.99', 0, 1, '8,5 cm / Drillingsgröße 5/0', '12 g', 14, 3, 9, 4),
(29, '2021-02-22 10:17:25', NULL, 'EFFZETT Dressed Executor Spinner #1', 'spinner_dressed.jpg', '4,99', 0, 1, '#1', '3 g', 13, 3, 9, 4),
(30, '2021-02-22 10:17:25', NULL, 'Spinner #2 - Caviar', 'spinner_caviar.jpg', '4.95', 10, 1, '#2', '6 g', 13, 3, 5, 4),
(31, '2021-02-22 10:17:25', NULL, 'EFFZETT Original Heintz Spoon', 'blinker_heintz.jpg', '2.99', 10, 1, '7 cm', '21 g', 12, 3, 9, 3),
(32, '2021-02-22 10:17:25', NULL, 'Seeker ISP 98 - White Pearl', 'blinker_whitepearl.jpg', '5.99', 20, 1, '9,8 cm', '23 g', 2, 3, 5, 3),
(33, '2021-02-22 10:17:25', NULL, '3D Line Thru Seeker - Eel Pout', 'blinker_eelpout.jpg', '6.95', 0, 1, '7 cm', '13 g', 10, 3, 5, 3),
(34, '2021-02-22 10:17:25', NULL, 'Prorex Diving Minnow DR120 - Live Ayu', 'wobbler_liveayu.jpg', '9.99', 10, 1, '12 cm', '26 g', 14, 8, 15, 2),
(35, '2021-02-22 10:17:25', NULL, 'Tournament Baby Minnow 60SP - Fire Tiger', 'wobbler_minnow.jpg', '13.99', 20, 1, '6 cm', '3,5 g', 14, 8, 15, 2),
(36, '2021-02-22 10:17:25', NULL, 'Ikiru Jerk 120 LL - Zander', 'wobbler_ikiru.jpg', '9.49', 0, 1, '12 cm', '21 g', 10, 8, 12, 2),
(37, '2021-02-22 10:17:25', NULL, 'Prorex Fuorocarbon Leader', 'vorfach_prorex.jpg', '3.49', 10, 1, '30 cm', '36 kg Tragkraft', 15, 5, 15, 7),
(38, '2021-02-22 10:17:25', NULL, 'Matte Black Leader 7x7 Wire', 'vorfach_black.jpg', '3.25', 0, 2, '25 cm', '10 kg Tragkraft', 11, 3, 12, 7),
(39, '2021-02-22 10:17:25', NULL, 'Fine Leader 1x19', 'vorfach_fine.jpg', '1.99', 0, 2, '25 cm', '10 kg Tragkraft', 13, 3, 12, 7);


--
-- Daten für Tabelle `paymethod`
--

INSERT INTO `angelshop`.`paymethod` (`id`, `createdAt`, `updatedAt`, `name`) VALUES
(1, '2021-01-06 09:08:33', NULL, 'PayPal'),
(2, '2021-01-06 09:08:33', NULL, 'Rechnung'),
(3, '2021-01-06 09:08:33', NULL, 'Kreditkarte'),
(4, '2021-01-06 09:08:33', NULL, 'Vorkasse');