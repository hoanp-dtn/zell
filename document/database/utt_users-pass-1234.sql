-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 30 Août 2015 à 08:01
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `utt`
--

-- --------------------------------------------------------

--
-- Structure de la table `utt_users`
--

CREATE TABLE IF NOT EXISTS `utt_users` (
`id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` int(2) DEFAULT NULL COMMENT '1:student; 2:teacher',
  `email` varchar(255) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  `time_create` int(11) DEFAULT NULL,
  `time_update` int(11) DEFAULT NULL,
  `avatar` text CHARACTER SET utf8,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `permit` int(11) DEFAULT NULL COMMENT '-1:sup admin,0:member 1:admin, 2: site manager',
  `city` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `address` text CHARACTER SET utf8,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `about` text CHARACTER SET utf8,
  `status` int(2) DEFAULT '2' COMMENT '1: active; 2: pending; 3: deleted',
  `br_id` int(11) DEFAULT NULL COMMENT 'Branch id (chinh nhán hà nội, vĩnh yên,...)',
  `department_id` int(11) DEFAULT NULL COMMENT 'Khoa, phòng,.. ref to department.id'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utt_users`
--

INSERT INTO `utt_users` (`id`, `username`, `password`, `user_type`, `email`, `salt`, `time_create`, `time_update`, `avatar`, `fullname`, `permit`, `city`, `address`, `phone`, `about`, `status`, `br_id`, `department_id`) VALUES
(1, 'adminstrator', 'a71ad49cf77f01dcc8bcae656e5d1985', 1, 'admin@gmail.com', 'a055d9bdbceef5ab8a53bac300b6475d', NULL, NULL, 'avt1.jpg', 'Nguyễn Khắc Thịnh', -1, '17', 'Quận Thành Xuân', '0913271820', NULL, 2, 2, 1),
(2, 'anhproduction', 'a71ad49cf77f01dcc8bcae656e5d1985', 2, 'anhproduction@hotmail.com', 'a055d9bdbceef5ab8a53bac300b6475d', 1422666666, NULL, '144035125117695_489941751153473_6152241066380012329_n.jpg', 'Anh Production', -1, 'Bắc Giang', 'Hiệp Hòa', '0983403896', NULL, 2, 1, 2),
(3, 'admin', 'a0823bac86eac059e9776251f431fa75', 2, 'longlile2211@gmail.com', '59HrhOrxtDds4BT12iMQ8lv1FcCdBaOnSxl6y2MegXB4qpbqjYSCzvwnD6v3lclQOJJ4NtbAXk3RJRyMOhi7EKAaD0NNR5QF8fGlVg7Uu9i9YfETSPmN1qQZTWhs3Xe7s6tDpHjYidSML8VhTYfzy4k731kzAPePa7ZreoBIHKtZk8XVn9UNUnFkL0gzI5WfDypnesiWjpGEZVwyQ2rcJH5wdtuPqmOvhx3FIV026mLuF0zLqbErIRLuagwZbpu', 1422666666, NULL, 'avt1.jpg', 'Nguyễn Khắc Thịnh', 2, NULL, NULL, NULL, NULL, 3, 1, 2),
(4, 'manager', 'a71ad49cf77f01dcc8bcae656e5d1985', 2, 'myheavenhh3@gmail.com', 'a055d9bdbceef5ab8a53bac300b6475d', 1422666666, NULL, '1440676924diem-trung-tuyen-2015.jpg', 'Anh Production', 1, 'Bắc Giang', 'Hiệp Hòa', '0983403896', 'Giới thiệu', 2, 1, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `utt_users`
--
ALTER TABLE `utt_users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utt_users`
--
ALTER TABLE `utt_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
