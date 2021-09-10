-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Septembre 2020 à 09:13
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `nuru_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `bon_sortie`
--

CREATE TABLE IF NOT EXISTS `bon_sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `date_bon` date DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bon_sortie_utilisateur1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `description`, `date_bon`, `utilisateur_id`) VALUES
(1, 'une description de ce bon de sortie de test, bon je ne sais pas quoi ecrire mais suis sï¿½r que tu comprend rien vraiment de tout ï¿½a mais bon courage alors si tu penses que tu peut continuer ï¿½ lire jusqu''ï¿½ la fin de ce texte mais bravo heinnnnnn.', '2020-09-04', 1),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit numquam molestias sit deserunt unde neque eaque similique, velit nisi alias obcaecati excepturi dolorum ullam labore laudantium est voluptas ex.', '2020-09-07', 1),
(3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit numquam molestias sit deserunt unde neque eaque similique, velit nisi alias obcaecati excepturi dolorum ullam labore laudantium est voluptas ex.', '2020-09-07', 1),
(4, 'dzaezrtrydssff', '2020-09-07', 1),
(5, 'Achat poisson', '2020-09-12', 1),
(6, 'Achat poisson', '2020-09-12', 1),
(7, 'pour la fÃªte d''aujourd''hui  je viens de prendre dans le stock un bidon d''huile  de qualitÃ© de 20 L , un pagne d''oignon, les Ã©pices .', '2020-09-28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `designation`) VALUES
(1, 'cuisine'),
(2, 'Aliment'),
(3, 'alimentation'),
(4, 'savon'),
(5, 'alimentation'),
(6, 'vertiaire');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE IF NOT EXISTS `depense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` double DEFAULT NULL,
  `motif` varchar(255) DEFAULT NULL,
  `devise` varchar(255) DEFAULT NULL,
  `date_depense` date DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_depense_utilisateur1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `depense`
--

INSERT INTO `depense` (`id`, `montant`, `motif`, `devise`, `date_depense`, `utilisateur_id`) VALUES
(1, 500, 'transport agent', 'fc', '2020-09-03', 1),
(2, 600, 'achat biere', 'fc', '2020-09-03', 1),
(3, 400, 'test motif depense', 'fc', '2020-09-04', 1),
(4, 34000, 'achhat meuble', 'fc', '2020-09-05', 1),
(5, 230000, 'transport agent', 'fc', '2020-09-05', 1),
(6, 230000, 'achat', 'fc', '2020-09-07', 1),
(7, 4000, 'SAVON', 'fc', '2020-09-11', 1),
(8, 98000, 'fff', 'fc', '2020-09-12', 1),
(9, 10000, 'SAVON', 'fc', '2020-09-21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `don`
--

CREATE TABLE IF NOT EXISTS `don` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cout` double DEFAULT NULL,
  `nom_bienfaiteur` varchar(255) DEFAULT NULL,
  `date_don` date DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_don_utilisateur_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `don`
--

INSERT INTO `don` (`id`, `cout`, `nom_bienfaiteur`, `date_don`, `utilisateur_id`) VALUES
(1, 40000, 'jean louis 2', '2020-09-04', 1),
(2, 890000, 'tatimsoft group', '2020-09-04', 1),
(3, 29000, 'esis salama', '2020-09-04', 1),
(4, 780000, 'tatimsoft group', '2020-09-07', 1),
(5, 5000, 'KALONJI', '2020-09-11', 1),
(6, 26, 'KALONJI', '2020-09-22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `postnom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `etat_sante` varchar(255) DEFAULT NULL,
  `lieu_naissance` varchar(255) DEFAULT NULL,
  `date_naissance` varchar(255) DEFAULT NULL,
  `nom_pere` varchar(255) DEFAULT NULL,
  `nom_mere` varchar(255) DEFAULT NULL,
  `nom_tuteur` varchar(255) DEFAULT NULL,
  `adresse_responsable` varchar(255) DEFAULT NULL,
  `contact_responsable` varchar(255) DEFAULT NULL,
  `ecole_provenance` varchar(255) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `matricule`, `nom`, `postnom`, `prenom`, `genre`, `etat_sante`, `lieu_naissance`, `date_naissance`, `nom_pere`, `nom_mere`, `nom_tuteur`, `adresse_responsable`, `contact_responsable`, `ecole_provenance`, `date_inscription`) VALUES
(1, '20NE002', 'ilungav', 'kakudji', 'naomi', 'f', 'normal', 'kolwezi', '2020-10-10', 'joseph kalama', 'joseph kalama', 'toto kasumbalesa', '026 Av. Manika Q.Kasapa', '0999090099', 'saint pierre', '2020-09-03'),
(2, '20NE003', 'nday', 'ndimina', 'mardochee', 'm', 'normal', 'lubumbashi', '2020-09-23', 'ali kazadi', 'marceline kazadi', 'martine nyembo', '026 Av. Manika Q.Kasapa', '0999090099', 'lycee christ sauveur', '2020-09-03'),
(5, '20NE006', 'KANAM', 'LWAMBA', 'LYDIE', 'f', 'normal', 'kolwezi', '2020-09-10', 'ILUNGA', 'KADJATA', 'NGALULA', '026 Av. Manika Q.Kasapa', '0999090099', 'WEMA', '2020-09-07'),
(6, '20NE007', 'kasongo', 'ilunga', 'pierre', 'm', 'bon', 'lubumbashi', '2020-09-07', 'kasongo', 'ngalula', 'tshibola', 'nÂ°50 av kolwezi C/Kenya', '0825286957', 'Anuarite', '2020-09-07'),
(7, '20NE008', 'Juma', 'pierre', 'patient', 'm', 'bon', 'lubumbashi', '2020-09-11', 'mwamba', 'mwamba', 'leon', 'nÂ°20 av kasumbalesa', '0821111565', 'tanguhapo', '2020-09-11'),
(8, '20NE009', 'YAV', 'KAT', 'Yves', 'M', 'bon', 'lubumbashi', '2010-09-01', 'kasongo', 'ngalula', 'tshibola', 'nÂ°50 av kolwezi C/Kenya', '0825286957', 'Anuarite', '2020-09-12'),
(9, '20NE008', 'KILUFYA', 'MOFYA', 'JEAN', 'm', 'BON', 'KASENGA', '2020-06-01', 'KILUFYA', 'JEANNETTE', 'BIENVENU', 'SURCULAIRE 45', '0994581256', 'LWISHA', '2020-09-21'),
(10, '20NE009', 'nnnn', 'nnnn', 'kkknnn', 'm', 'nnn', 'jjjjkkk', '2020-09-16', 'nnn,,,,,,', ',,,,mlmlmkm', 'tshibola', 'nÂ°50 av kolwezi C/Kenya', '0821111565', 'bnnjnnn', '2020-09-22'),
(11, '20NE0010', 'Ngandu', 'kyalwe', 'Jacque', 'm', 'bon', 'kilwa', '2020-09-01', 'kasongo', 'kazadi', 'tshibola', 'SURCULAIRE 45', '0825286957', 'tanguhapo', '2020-09-28');

-- --------------------------------------------------------

--
-- Structure de la table `entree`
--

CREATE TABLE IF NOT EXISTS `entree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qte_entree` int(11) DEFAULT NULL,
  `date_entree` date DEFAULT NULL,
  `don_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entree_don1_idx` (`don_id`),
  KEY `fk_entree_produit1_idx` (`produit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `entree`
--

INSERT INTO `entree` (`id`, `qte_entree`, `date_entree`, `don_id`, `produit_id`) VALUES
(1, 32, '2020-09-04', 1, 2),
(2, 56, '2020-09-04', 1, 1),
(3, 8708, '2020-09-04', 2, 2),
(4, 20, '2020-09-04', 3, 2),
(5, 43, '2020-09-04', 3, 1),
(6, 6, '2020-09-07', 4, 3),
(7, 67, '2020-09-07', 4, 4),
(8, 0, '2020-09-11', 5, 3),
(9, 5, '2020-09-11', 5, 8),
(10, 21, '2020-09-22', 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

CREATE TABLE IF NOT EXISTS `frais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `devise` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`id`, `designation`, `montant`, `devise`) VALUES
(1, 'ggyyy', 4000, 'fc'),
(2, 'Internat', 9000, 'fc'),
(3, 'frais scolaire', 38000, 'fc'),
(4, 'frais scolaire', 12500, 'fc'),
(5, 'frais scolaire', 3000, 'fc'),
(6, 'frais scolaire', 2500, 'fc'),
(7, 'frais scolaire', 50, 'usd');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` double DEFAULT NULL,
  `date_paiement` date DEFAULT NULL,
  `eleve_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `frais_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paiement_eleve1_idx` (`eleve_id`),
  KEY `fk_paiement_utilisateur1_idx` (`utilisateur_id`),
  KEY `fk_paiement_frais_scolaire1_idx` (`frais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `paiement`
--

INSERT INTO `paiement` (`id`, `montant`, `date_paiement`, `eleve_id`, `utilisateur_id`, `frais_id`) VALUES
(1, 2000, '2020-09-03', 1, 1, 1),
(2, 33000, '2020-09-07', 1, 1, 3),
(3, 38000, '2020-09-07', 5, 1, 3),
(4, 2000, '2020-09-07', 1, 1, 1),
(5, 12500, '2020-09-07', 1, 1, 3),
(6, 3000, '2020-09-07', 6, 1, 3),
(7, 150, '2020-09-09', 1, 1, 1),
(8, 2500, '2020-09-11', 7, 1, 3),
(9, 781, '2020-09-12', 7, 1, 1),
(10, 235, '2020-09-22', 7, 1, 1),
(11, 1500, '2020-09-26', 1, 1, 2),
(12, 2500, '2020-09-28', 1, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produit_categorie1_idx` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id`, `designation`, `categorie_id`) VALUES
(1, 'produit cuisine', 2),
(2, 'produit champ', 1),
(3, 'bidon huile', 3),
(4, 'farine', 1),
(5, 'mayi', 2),
(6, 'Braise', 3),
(7, 'sucre', 1),
(8, 'savon', 4),
(9, 'sucre', 1),
(10, 'Poisson', 1);

-- --------------------------------------------------------

--
-- Structure de la table `soin`
--

CREATE TABLE IF NOT EXISTS `soin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motif` varchar(255) DEFAULT NULL,
  `date_soin` date DEFAULT NULL,
  `eleve_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_soin_eleve1_idx` (`eleve_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `soin`
--

INSERT INTO `soin` (`id`, `motif`, `date_soin`, `eleve_id`) VALUES
(1, 'Utilisez Collections pour enregistrer du contenu ultérieurement (image, texte ou page Web complète) directement dans le navigateur.', '2020-09-04', 1),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur impedit numquam molestias sit deserunt unde neque eaque similique, velit nisi alias obcaecati excepturi dolorum ullam labore laudantium est voluptas ex.', '2020-09-07', 1),
(3, 'DGRRRETTYRFGFDG', '2020-09-07', 1),
(4, 'gfhjvhjjkdnwjchjv&lt;gjdskSJJHXCJ', '2020-09-11', 7),
(5, 'bnbnbvhjghg', '2020-09-12', 7),
(6, 'consultation pour le problÃ¨me des yeux a l''hÃ´pital sainte Yvonne', '2020-09-28', 1),
(7, 'consultation pour le nerf', '2020-09-28', 1),
(8, 'mal a la tÃªte', '2020-09-28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE IF NOT EXISTS `sortie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qte_sortie` int(11) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `produit_id` int(11) NOT NULL,
  `bon_sortie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sortie_produit1_idx` (`produit_id`),
  KEY `fk_sortie_bon_sortie1_idx` (`bon_sortie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `sortie`
--

INSERT INTO `sortie` (`id`, `qte_sortie`, `date_sortie`, `produit_id`, `bon_sortie_id`) VALUES
(1, 7, '2020-09-04', 2, 1),
(2, 20, '2020-09-04', 1, 1),
(3, 10, '2020-09-07', 4, 2),
(4, 97, '2020-09-07', 2, 2),
(5, 2, '2020-09-07', 3, 3),
(6, 8000, '2020-09-07', 2, 4),
(7, 9, '2020-09-07', 1, 4),
(8, 1, '2020-09-28', 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `systeme_annee`
--

CREATE TABLE IF NOT EXISTS `systeme_annee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `annee` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `systeme_annee`
--

INSERT INTO `systeme_annee` (`id`, `annee`) VALUES
(1, '2020'),
(2, '2021');

-- --------------------------------------------------------

--
-- Structure de la table `systeme_date`
--

CREATE TABLE IF NOT EXISTS `systeme_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date DEFAULT NULL,
  `mois_id` int(11) NOT NULL,
  `annee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_systeme_date_systeme_mois1_idx` (`mois_id`),
  KEY `fk_systeme_date_systeme_annee1_idx` (`annee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `systeme_date`
--

INSERT INTO `systeme_date` (`id`, `jour`, `mois_id`, `annee_id`) VALUES
(1, '2020-09-03', 9, 1),
(2, '2020-09-04', 9, 1),
(3, '2020-09-05', 9, 1),
(4, '2020-09-06', 9, 1),
(5, '2020-09-07', 9, 1),
(6, '2020-09-09', 9, 1),
(7, '2020-09-11', 9, 1),
(8, '2020-09-12', 9, 1),
(9, '2020-09-15', 9, 1),
(10, '2020-09-21', 9, 1),
(11, '2020-09-22', 9, 1),
(12, '2020-09-25', 9, 1),
(13, '2020-09-26', 9, 1),
(14, '2020-09-28', 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `systeme_mois`
--

CREATE TABLE IF NOT EXISTS `systeme_mois` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mois_en_chiffre` varchar(255) DEFAULT NULL,
  `mois_en_lettre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `systeme_mois`
--

INSERT INTO `systeme_mois` (`id`, `mois_en_chiffre`, `mois_en_lettre`) VALUES
(1, '01', 'Janvier'),
(2, '02', 'Fevrier'),
(3, '03', 'Mars'),
(4, '04', 'Avril'),
(5, '05', 'Mai'),
(6, '06', 'Juin'),
(7, '07', 'Juillet'),
(8, '08', 'Aout'),
(9, '09', 'Septembre'),
(10, '10', 'Octobre'),
(11, '11', 'Novembre'),
(12, '12', 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `postnom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `prenom`, `contact`, `email`, `username`, `password`, `role`) VALUES
(1, 'monga', 'mwamba', 'debora', '0977323000', 'debora@gmail.com', 'debora', '$2y$10$wops7fK8c41CHFVsVBDYi.RnRRsh70jLm.4BUIIte//EpNEMd1RfC', 'admin'),
(2, 'miji', 'kaputu', 'eli', '0988899977', 'eli@gmail.com', 'eli', '$2y$10$RoDLgHsJcigxan02BLQaZOBCsHQkxdiCe59CeUT62VzE/2YrzWg6G', 'receptionniste');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bon_sortie`
--
ALTER TABLE `bon_sortie`
  ADD CONSTRAINT `fk_bon_sortie_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `fk_depense_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `don`
--
ALTER TABLE `don`
  ADD CONSTRAINT `fk_don_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `entree`
--
ALTER TABLE `entree`
  ADD CONSTRAINT `fk_entree_don1` FOREIGN KEY (`don_id`) REFERENCES `don` (`id`),
  ADD CONSTRAINT `fk_entree_produit1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_paiement_eleve1` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `fk_paiement_frais_scolaire1` FOREIGN KEY (`frais_id`) REFERENCES `frais` (`id`),
  ADD CONSTRAINT `fk_paiement_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `soin`
--
ALTER TABLE `soin`
  ADD CONSTRAINT `fk_soin_eleve1` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `fk_sortie_bon_sortie1` FOREIGN KEY (`bon_sortie_id`) REFERENCES `bon_sortie` (`id`),
  ADD CONSTRAINT `fk_sortie_produit1` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `systeme_date`
--
ALTER TABLE `systeme_date`
  ADD CONSTRAINT `fk_systeme_date_systeme_annee1` FOREIGN KEY (`annee_id`) REFERENCES `systeme_annee` (`id`),
  ADD CONSTRAINT `fk_systeme_date_systeme_mois1` FOREIGN KEY (`mois_id`) REFERENCES `systeme_mois` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
