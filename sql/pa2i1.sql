-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 06 mai 2025 à 13:04
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pa2i1`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`id`, `name`) VALUES
(1, 'Tristan '),
(2, 'Noah'),
(3, 'Alexandre');

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `id_provider` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `application`
--

INSERT INTO `application` (`id`, `id_contract`, `id_provider`, `price`, `active`) VALUES
(1, 1, 3, '10.00', 0),
(3, 16, 5, '5.00', 0),
(21, 18, 2, '1300.00', 0),
(22, 19, 1, '2000.00', 0),
(23, 19, 2, '2500.00', 0),
(24, 20, 1, '3000.00', 0),
(25, 21, 1, '1500.00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `siret` varchar(30) NOT NULL,
  `legal_form` varchar(20) NOT NULL,
  `activity_sector` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `country` varchar(25) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `subscription` int(11) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `id_user`, `name`, `siret`, `legal_form`, `activity_sector`, `phone`, `link`, `address`, `postal_code`, `country`, `description`, `subscription`, `exp_date`, `active`) VALUES
(1, 2, 'esgi', '0', '', '', '0', '', '', '0', '', NULL, NULL, NULL, 1),
(2, 22, 'Entreprise Test', '12345678', 'SARL', 'Informatique', '123456789', 'https://entreprise-test.com', '123 Rue du Test, 75001 Paris', '75001', 'France', NULL, NULL, NULL, 0),
(3, 23, 'EDF', '10256348', 'SAS', 'Energie', '783091529', 'https://edf.fr', '7 allee du bois des Chenes', '94370', 'France', NULL, NULL, NULL, 1),
(5, 25, 'ESGI', '10256348', 'SAS', 'Ecole', '754545454', 'https://esgi.fr', 'Boulevard st antoine', '7012', 'France', NULL, NULL, NULL, 1),
(6, 26, 'NaTran', '0123456789', 'SARL', 'Energie', '0147852369', 'https://www.youtube.com', 'Clever', '75003', 'France', 'Gestion des apports en gaz', NULL, NULL, 1),
(7, 28, 'ABC Corp', '123456789', 'SAS', 'Informatique', '623456789', 'https://abccorp.com', '15 avenue des Champs', '75008', 'France', NULL, NULL, NULL, 0),
(8, 59, 'Posca', '1523647', 'SAS', 'feutre', '0792153684', 'https://posca.fr', '34 boulevard St martin, Nancy', '54700', 'France', NULL, NULL, NULL, 1),
(9, 62, 'Toshiba', 'fr125865', 'SNC', 'Electronique', '0625314852', 'https://toshiba.com', '54 rue boulevard François, Nogent sur marnes', '94', 'France', NULL, NULL, NULL, 1),
(10, 66, 't', 't', 't', 't', 't', 'http://t', 't', 't', 't', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `client_invoices`
--

CREATE TABLE `client_invoices` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `issued_date` date NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `status` enum('paid','pending') DEFAULT 'pending',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client_invoices`
--

INSERT INTO `client_invoices` (`id`, `client_id`, `amount`, `issued_date`, `pdf_path`, `status`, `description`) VALUES
(1, 2, '1200.50', '2025-04-08', 'factures/clients/facture_12345.pdf', 'pending', 'Facturation du service de bien-être entreprise - mars 2025');

-- --------------------------------------------------------

--
-- Structure de la table `concerne`
--

CREATE TABLE `concerne` (
  `id` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_hashtag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_provider` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `is_medical` int(11) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `complain` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `id_application` int(11) DEFAULT NULL,
  `pay_status` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `publication` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '1',
  `active` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contracts`
--

INSERT INTO `contracts` (`id`, `name`, `date`, `id_client`, `id_provider`, `id_event`, `title`, `content`, `is_medical`, `location`, `capacity`, `complain`, `price`, `id_application`, `pay_status`, `file`, `id_room`, `publication`, `status`, `active`) VALUES
(1, 'contrat esgi 2025', '2025-01-30', 1, 3, NULL, 'test', 'contenu', 0, 0, 0, NULL, 10, 1, NULL, 'chaipas', NULL, 1, 6, 1),
(15, 'test', '2025-03-25', 1, NULL, 3, 'linux', 'cours', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 5, 1, 1, 0),
(16, 'devis n1', '2025-03-25', 1, 5, NULL, 'demande de cours de linux', 'aze', 0, 0, 0, NULL, 5, 3, NULL, NULL, NULL, 1, 4, 1),
(17, 'Devis n2', '2025-03-25', 1, NULL, NULL, 'Demande de cours de piano', 'Cours de piano ?', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1),
(18, 'Devis ESGI/BC 03/2025', '2025-03-29', 1, 2, 4, 'Cours de yoga du rire', 'Nous aimerions avoir un prof de yoga du rire pour donner des cours dans notre entreprise', 0, 0, 0, NULL, 1300, 21, NULL, NULL, 3, 1, 5, 2),
(19, 'Devis n3', '2025-03-29', 1, 2, 5, 'TeamBuilding pour 30 personnes', 'Un teambulding autour d\'un escape game ou tout autre jeu', 0, 0, 0, NULL, 2500, 23, NULL, NULL, 2, 1, 4, 2),
(20, 'Devis 4', '2025-04-01', 1, 1, 6, 'karting', 'Devis pour mettre en place et gérer un event de kart', 0, 0, 0, NULL, 3000, 24, NULL, NULL, 4, 1, 5, 2),
(21, 'Cours de yoga', '2025-04-09', 1, 1, 7, 'Demande de cours de yoga', 'Cours de yoga', 0, 0, 0, NULL, 1500, 25, NULL, NULL, 1, 1, 5, 2),
(22, 'Checkup santé 2025', '2025-04-27', 1, NULL, NULL, 'Faire un checkup aux employés', 'examiner par un médecin les employés de l\'entreprise pour vérifier qu\'ils sont tous apte pour 2025', 1, 0, 25, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `id_enterprise` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `id_enterprise`, `id_users`, `phone`, `link`, `status`) VALUES
(1, 1, 4, '', '', 1),
(2, 1, 64, NULL, NULL, 1),
(3, 1, 65, '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  `id_room` int(1) DEFAULT NULL,
  `participant` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `id_contract`, `id_company`, `title`, `description`, `start_date`, `end_date`, `start_hour`, `end_hour`, `id_room`, `participant`, `active`) VALUES
(1, 1, 1, 'event 1', 'Cours event 1', '2025-04-09', '2025-04-10', '14:00:00', '17:30:00', 1, NULL, 0),
(3, 15, 1, 'linux', 'cours', '2025-03-30', '2025-03-30', '16:38:00', '18:38:00', 5, NULL, 0),
(4, 18, 1, 'Cours de yoga du rire', 'Nous aimerions avoir un prof de yoga du rire pour donner des cours dans notre entreprise', '2025-04-02', '2025-04-02', '10:00:00', '11:30:00', 3, 30, 1),
(5, 19, 1, 'TeamBuilding pour 30 personnes', 'Un teambulding autour d\'un escape game ou tout autre jeu', '2025-04-14', '2025-04-14', '15:30:00', '16:30:00', 2, 30, 1),
(6, 20, 1, 'karting', 'Mettre en place et gérer un event de kart', '2025-04-30', '2025-04-30', '11:00:00', '14:30:00', 4, 30, 1),
(7, 21, 1, 'Demande de cours de yoga', 'Cours de yoga', '2025-04-10', '2025-04-10', '13:50:00', '13:52:00', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_categories`
--

INSERT INTO `forum_categories` (`categorie_id`, `nom`) VALUES
(1, 'bricolage'),
(2, 'musique');

-- --------------------------------------------------------

--
-- Structure de la table `forum_commentaires`
--

CREATE TABLE `forum_commentaires` (
  `commentaire_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_commentaires`
--

INSERT INTO `forum_commentaires` (`commentaire_id`, `message_id`, `utilisateur_id`, `contenu`, `date_creation`, `active`) VALUES
(1, 1, 1, 'test', '2025-01-31 18:00:34', 1),
(2, 1, 1, 'blabal', '2025-03-09 15:09:12', 1),
(3, 1, 1, 'francis', '2025-03-09 15:10:37', 1),
(4, 1, 4, 'bitch', '2025-03-09 15:14:58', 0),
(5, 1, 1, 'espèce de connard va, je t\'aurais !', '2025-03-09 15:15:32', 0),
(6, 1, 3, 'espèce de connard va, je t\'aurais !', '2025-03-10 10:10:22', 0),
(7, 1, 3, 'dorémi', '2025-03-10 16:06:08', 1),
(8, 1, 4, 'Care', '2025-03-10 16:22:39', 1),
(9, 1, 4, 'GILLET', '2025-03-10 16:32:52', 1),
(10, 1, 4, 'connard', '2025-03-10 16:32:58', 0),
(11, 1, 4, 'fzeaf', '2025-03-11 08:52:47', 1),
(12, 1, 4, 'connard', '2025-03-11 08:52:53', 0),
(13, 1, 4, 'feuzihcfuizh', '2025-03-18 10:08:23', 1),
(14, 1, 4, 'azer', '2025-03-18 10:29:14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `forum_messages`
--

CREATE TABLE `forum_messages` (
  `message_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum_messages`
--

INSERT INTO `forum_messages` (`message_id`, `utilisateur_id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 1, 'Le piano c\'est cool', 'par contre les partitions c\'est absolument l\'horreur', '2025-01-31 18:00:10');

-- --------------------------------------------------------

--
-- Structure de la table `forum_message_categories`
--

CREATE TABLE `forum_message_categories` (
  `message_id` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `hashtags`
--

CREATE TABLE `hashtags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fav` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_intent_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `payment_intent_id`, `user_id`, `payment_type`, `amount`, `currency`, `status`, `created_at`) VALUES
(1, 'ch_3RIdHlF9UK6PhOmT02GBiuRZ', NULL, NULL, 59900, 'usd', 'succeeded', '2025-04-27 22:02:54'),
(2, 'ch_3RJCdgF9UK6PhOmT2HXOOxCH', NULL, NULL, 59900, 'usd', 'succeeded', '2025-04-29 11:47:54');

-- --------------------------------------------------------

--
-- Structure de la table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `siret` int(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `address` varchar(50) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `vat_number` varchar(50) NOT NULL,
  `link` varchar(25) NOT NULL,
  `cv` varchar(25) DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT '1',
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `providers`
--

INSERT INTO `providers` (`id`, `user_id`, `company_name`, `siret`, `phone`, `service_type`, `service_description`, `address`, `postal_code`, `country`, `vat_number`, `link`, `cv`, `statut`, `active`) VALUES
(1, 3, 'teryuio', 152475, 330564815, 'Gestion d\'évènements', 'création et gestion d\'évènements pour entreprise, teambulding ...', '8 boulevard de bercy', 75003, 'France', 'FR21459', '', 'Tristan.pdf', 1, 1),
(2, 43, 'MD Créations', 98765432, 612345678, 'Musique', 'Création de logos, identités visuelles et supports de communication.', '15 avenue des Arts', 75002, 'France', 'FR987654321', 'https://mdcreations.fr', NULL, 1, 1),
(3, 44, 'b', 10, 10, 'b', 'bb', 'b', 10, 'b', '10', 'b', NULL, 1, 1),
(4, 60, 'a', 1, 10, 'a', 'a', '1', 10, 'fr', '1', 'https://a', NULL, 1, 1),
(5, 61, 'ChiLeChat', 123456789, 792153684, 'chat ', 'louer un chat gris', '34 rue yamagoshi Tokyo', 68, 'Japon', 'JP15238', 'https://chi.com', NULL, 1, 1),
(6, 63, 'Genshin', 12569, 765314829, 'combat', 'Tabassages organisé', 'Lieu dit du Manoir hanté', 0, 'NuPart', 'CH457826', 'https://genshin.com', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_employees` int(11) NOT NULL,
  `id_providers` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reporting`
--

CREATE TABLE `reporting` (
  `id` int(11) NOT NULL,
  `type_signal` int(100) NOT NULL,
  `content` text NOT NULL,
  `screen` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reporting`
--

INSERT INTO `reporting` (`id`, `type_signal`, `content`, `screen`, `date`, `active`) VALUES
(1, 1, 'pas de msg privé', 'text.jpg', '2025-03-11 20:00:32', 1),
(2, 6, 'pas de faqq', NULL, '2025-03-11 20:00:35', 1),
(3, 4, 'Signalement automatique : Liss Julien (jliss@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-11 09:52:53, \'connard\'', NULL, '2025-03-11 20:00:37', 1),
(4, 4, 'Signalement automatique : Boudinar Alexandre (alexandre.boudinar1105@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-10 11:10:22, \'espèce de connard va, je t\'aurais !\'', NULL, '2025-03-11 20:00:39', 1),
(5, 4, 'Signalement automatique : Boudinar Alexandre (alexandre.boudinar1105@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-10 11:10:22, \'espèce de connard va, je t\'aurais !\'', NULL, '2025-03-11 20:00:40', 1),
(6, 4, 'Signalement automatique : Boudinar Alexandre (alexandre.boudinar1105@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-10 17:06:08, \'dorémi\'', NULL, '2025-03-11 20:00:43', 1),
(7, 4, 'Signalement automatique : Liss Julien (jliss@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-11 09:52:53, \'connard\'', NULL, '2025-03-11 20:00:44', 1),
(8, 4, 'Signalement automatique : Boudinar Alexandre (alexandre.boudinar1105@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-10 17:06:08, \'dorémi\'', NULL, '2025-03-11 20:00:46', 1),
(9, 4, 'Signalement automatique : Gillet Tristan (gillet.tristan.94@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-01-31 19:00:34, \'test\'', NULL, '2025-03-28 21:55:22', 0),
(10, 4, 'Signalement automatique : Liss Julien (jliss@gmail.com), membre de votre entreprise, a été signalé pour des propos dans le forum le 2025-03-11 09:52:53, \'connard\'', NULL, '2025-03-11 20:00:19', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reporting_type`
--

CREATE TABLE `reporting_type` (
  `id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reporting_type`
--

INSERT INTO `reporting_type` (`id`, `content`) VALUES
(1, 'Chat'),
(2, 'Topic'),
(3, 'Chatbot'),
(4, 'Account'),
(5, 'Event'),
(6, 'FAQ');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `id_user`, `id_event`, `active`) VALUES
(1, 4, 1, 1),
(5, 4, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `name`, `address`, `postal_code`, `country`, `city`, `capacity`, `id_client`, `active`) VALUES
(1, 'Salle Voltaire', '245 rue du faubourg saint antoine', '75012', 'France', 'Paris', 30, 1, 1),
(2, 'Salle Baudelaire', '7 allee du bois des Chenes', '94370', 'France', 'Sucy-en-Brie', 25, 1, 1),
(3, 'Salle Fontaine', '8 boulevard de bercy', '75012', 'France', 'Paris', 50, 1, 1),
(4, 'Accord Arena', '8 boulevard de bercy', '75012', 'France', 'Paris', 40, 1, 1),
(5, 'Salle Accord Arena', '8 boulevard de bercy', '75012', 'France', 'Paris', 40000, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `id_clients` int(11) DEFAULT NULL,
  `id_providers` int(11) DEFAULT NULL,
  `id_employees` int(11) DEFAULT NULL,
  `id_admin` int(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `username`, `email`, `image`, `password`, `token`, `expiration`, `id_clients`, `id_providers`, `id_employees`, `id_admin`, `created_at`, `active`) VALUES
(1, 'Gillet', 'Tristan', 'tgillet', 'gillet.tristan.94@gmail.com', NULL, 'ac16704bb7d18d564c0ebb7b71d63dbeb0f382d6cae62639260396123fe9b83fb3a1c0aa0e34565093961dc5d300b6dffe8750ef2a28f23227a0d5683cf5b13e', 'a22ca5a356249c1de7042d4be71320ba', '2025-04-29', NULL, NULL, NULL, 1, '2025-05-03 12:51:23', 1),
(2, 'Prisset', 'Noah', 'nprisset', 'prisset.noah@gmail.com', NULL, '99daaf3bb118dbb61a880fc2885f2c4d41fd6cfef8ddfba94366b92bd4eabc5621185282949579568dee4720d41cc7a09b9fd0d52d7fa86acfdebdbf3e78916d', '5b202363d03c05971f692a7b8586394e', '2025-04-29', 1, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(3, 'Boudinar', 'Alexandre', 'aboudinar', 'abdoudinar@gmail.com', NULL, 'd742c1e8c6c10536427392b22e0922e9517118595536c458957cea2c81d1d10f7d370d21f020b64fd7ec68c79da4567c2ae03686f261cee21a20f4d191744bd1', '5f2518a4f4683b9228b6c6a375518530', '2025-04-09', NULL, 1, NULL, NULL, '2025-05-03 12:51:23', 1),
(4, 'Liss', 'Julien', 'jliss', 'jliss@gmail.com', NULL, 'd20b9f0f90dfc68c4408aa21e4ba530e26810e0473b06be8ebbe64c29cd279719131ceafc782762bbeef5d9692fec52fb9f38725aa47a91a884900c1311c7d1f', '0b6139be485e75dc5ee318754ec4ca05', '2025-04-27', NULL, NULL, 1, NULL, '2025-05-03 12:51:23', 1),
(22, 'Doe', 'John', NULL, 'test@example.com', NULL, '5a6e62af036cb861088a081b3e3dc9257ab34c28de08714dbb1dabe52abd68ee570244496013e9908f18ef651804e9ddace8d7a1def401c4b9e95b862f77febe', NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-03 12:51:23', 0),
(23, 'Gillet', 'Sabine', 'sgillet', 'sabine.gillet@gmail.com', NULL, '8c3ce1a2f2b0df6a8be04c6c92ca75fdae52dfb8ffb67661c23ec2f1f2cc872146cf53ee4093e5dd8fb7a94192240955adcc8decb5c703bed75598c5c5a34ba5', '58b7f2a6a62ff699c097b1b1215b6ce7', '2025-03-10', 3, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(25, 'Sananes', 'Frédérique', NULL, 'Fsananes@gmail.com', NULL, '53b7e949c41c96d9d71f4b6c42d208b779f628b141f3ce7654f9955d0c04097d861cde17097569a0b03a5d4a421066a7a58a0ecae6015679e92fa596f544f5d9', NULL, NULL, 5, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(26, 'Gillet', 'Xavier', 'xgillet', 'xgillet@gmail.com', 'profile_26_1742147124.png', '85417adbbb09092c8ba1087399c43d6e235d40bb3887644775fe6292dd9a40952ba2f78181ed14dedac9e013f524e057137de90216452d44b9b2bb9634bb813a', 'a472b8be8b5606dc1c616df08e4e6261', '2025-04-23', 6, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(28, 'Dupont', 'Marie', 'mdupont', 'marie.dupont@abccorp.com', NULL, '71ecbc46b1ba23825da0aeae61a322d373f9df138171566853d15e2444c5dfda89164af51290f8c45cd2e0f9bcbedbddf6094e0f3e8dc6133cf7b8c99243d180', NULL, NULL, 7, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(43, 'Sanson', 'Véronique', 'svéronique', 'Véronique.sanson@example.com', 'profile_43_1742138976.png', '80d94b6f8f6d2a01ef88155dac311439cfe258a24458e244da9193120125b1fdcbac1fa525f870a0d9fc3517178e8c0fba50bb415d940fc57b62966314b5fc70', '9c1d8ffbc057e6daabc65155b6dec554', '2025-04-23', NULL, 2, NULL, NULL, '2025-05-03 12:51:23', 1),
(44, 'b', 'b', 'vsanson', 'b@gmail.com', NULL, '80d94b6f8f6d2a01ef88155dac311439cfe258a24458e244da9193120125b1fdcbac1fa525f870a0d9fc3517178e8c0fba50bb415d940fc57b62966314b5fc70', 'fcf4dceb3787a0a4ab54296b1bfaa0f7', '2025-03-16', NULL, 3, NULL, NULL, '2025-05-03 12:51:23', 0),
(59, 'Ducoste', 'Thibault', 'tducoste', 'Dthib@gmail.com', NULL, 'df6b9fb15cfdbb7527be5a8a6e39f39e572c8ddb943fbc79a943438e9d3d85ebfc2ccf9e0eccd9346026c0b6876e0e01556fe56f135582c05fbdbb505d46755a', NULL, NULL, 8, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(60, 'a', '1', '1a', 'a@gmail.com', NULL, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', NULL, NULL, NULL, 4, NULL, NULL, '2025-05-03 12:51:23', 1),
(61, 'Yamada', 'Chi', 'cyamada', 'chiYamada@gmail.com', NULL, '94ce57d3f40928c60f063d1369cb0d8335472d50a3651760ef449a499412ccda7b74f90894e44e8ec6195d7b5903d85b170a64fdb66d37c00118232538971366', NULL, NULL, NULL, 5, NULL, NULL, '2025-05-03 12:51:23', 1),
(62, 'Tabari', 'Viviane', 'vtabari', 'Vtabari@gmail.com', NULL, '91393966083c26c5783ac6ae2fc6aa29c2764707e3f2d70db20ac1e5e15c4ff6618874cf7c6d4401badb51abbc61feb7533913127d1a01619abf15bf9ecbc687', NULL, NULL, 9, NULL, NULL, NULL, '2025-05-03 12:51:23', 1),
(63, 'Impact', 'Aether', 'aimpact', 'aether@gmail.com', NULL, '0add0fd93779c9dd18d2bec96cf8258b74509e0864f967f874e1a8ce8a7e5462d2fe3dac1d9790cc7292a879029587129ccf67be4c6e02e1a7207106f7fb4b6d', NULL, NULL, NULL, 6, NULL, NULL, '2025-05-03 12:51:23', 1),
(64, 'Chappell', 'Roan', NULL, 'CRoan@gmail.com', NULL, '$2y$10$IGE7SH1blq9/jNjFDpuD7.yKAIRalqHryIErG/6pGaW2zrMr2EdFe', NULL, NULL, NULL, NULL, 1, NULL, '2025-05-03 12:51:23', 1),
(65, 'Jaiel Ferro', 'Milhane', 'mferro', 'mferro@gmail.com', 'profile_65_1743606647.jpg', '5f157a412fef5f6af5644260f4af1410ef966d530dde1453b72c2430fc48ee46daf096dbe2b32650c3f91420098177297612d99d1a323ff6447e9d64fb30a939', '80205c6d6a932c5fb4d11fa848bc9c29', '2025-04-09', NULL, NULL, 1, NULL, '2025-05-03 12:51:23', 1),
(66, 't', 't', 'tt', 't@t.t', 'profile_66_1744194646.jpg', '99f97d455d5d62b24f3a942a1abc3fa8863fc0ce2037f52f09bd785b22b800d4f2e7b2b614cb600ffc2a4fe24679845b24886d69bb776fcfa46e54d188889c6f', '95a4a30f67a47c80d6814955865a5864', '2025-04-09', 10, NULL, NULL, NULL, '2025-05-03 12:51:23', 0);

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE `visite` (
  `id` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`id`, `id_message`, `id_user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 4),
(4, 1, 4),
(5, 1, 2),
(6, 1, 4),
(7, 1, 4),
(8, 1, 4),
(9, 1, 4),
(10, 1, 4),
(11, 1, 4),
(12, 1, 4),
(13, 1, 4),
(14, 1, 4),
(15, 1, 4),
(16, 1, 4),
(17, 1, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_contract` (`id_contract`),
  ADD KEY `fk_application_provider` (`id_provider`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Index pour la table `client_invoices`
--
ALTER TABLE `client_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_client` (`id_client`),
  ADD KEY `fk_contracts_event` (`id_event`),
  ADD KEY `fk_contracts_provider` (`id_provider`),
  ADD KEY `fk_contracts_contract` (`id_application`),
  ADD KEY `fk_room_contract` (`id_room`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_employees` (`id_users`),
  ADD KEY `fk_id_enterprise` (`id_enterprise`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room_event` (`id_room`),
  ADD KEY `fk_contract` (`id_contract`),
  ADD KEY `fk_company` (`id_company`);

--
-- Index pour la table `forum_commentaires`
--
ALTER TABLE `forum_commentaires`
  ADD PRIMARY KEY (`commentaire_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `fk_forum_commentaires_message` (`message_id`);

--
-- Index pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employee_id` (`employee_id`),
  ADD KEY `fk_client_id` (`client_id`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_payment_type` (`payment_type`);

--
-- Index pour la table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reporting`
--
ALTER TABLE `reporting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_signal` (`type_signal`);

--
-- Index pour la table `reporting_type`
--
ALTER TABLE `reporting_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_event` (`id_event`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room_client` (`id_client`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_providers` (`id_providers`),
  ADD KEY `fk_id_clients` (`id_clients`),
  ADD KEY `fk_id_admin` (`id_admin`),
  ADD KEY `id_employees` (`id_employees`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `client_invoices`
--
ALTER TABLE `client_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `forum_commentaires`
--
ALTER TABLE `forum_commentaires`
  MODIFY `commentaire_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reporting`
--
ALTER TABLE `reporting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `reporting_type`
--
ALTER TABLE `reporting_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_application_contract` FOREIGN KEY (`id_contract`) REFERENCES `contracts` (`id`),
  ADD CONSTRAINT `fk_application_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `client_invoices`
--
ALTER TABLE `client_invoices`
  ADD CONSTRAINT `client_invoices_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `fk_contracts_contract` FOREIGN KEY (`id_application`) REFERENCES `application` (`id`),
  ADD CONSTRAINT `fk_contracts_event` FOREIGN KEY (`id_event`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `fk_contracts_provider` FOREIGN KEY (`id_provider`) REFERENCES `providers` (`id`),
  ADD CONSTRAINT `fk_id_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_room_contract` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Contraintes pour la table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_id_employees` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_id_enterprise` FOREIGN KEY (`id_enterprise`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_company` FOREIGN KEY (`id_company`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_contract` FOREIGN KEY (`id_contract`) REFERENCES `contracts` (`id`),
  ADD CONSTRAINT `fk_room_event` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Contraintes pour la table `forum_commentaires`
--
ALTER TABLE `forum_commentaires`
  ADD CONSTRAINT `fk_forum_commentaires_message` FOREIGN KEY (`message_id`) REFERENCES `forum_messages` (`message_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_commentaires_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `forum_messages`
--
ALTER TABLE `forum_messages`
  ADD CONSTRAINT `forum_messages_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_type` FOREIGN KEY (`payment_type`) REFERENCES `payment_type` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reporting`
--
ALTER TABLE `reporting`
  ADD CONSTRAINT `reporting_ibfk_1` FOREIGN KEY (`type_signal`) REFERENCES `reporting_type` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `id_event` FOREIGN KEY (`id_event`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `administrators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_clients` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_providers` FOREIGN KEY (`id_providers`) REFERENCES `providers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_employees`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
