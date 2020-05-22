CREATE TABLE IF NOT EXISTS `abonne` (
  `idAbonne` int(4) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idAbonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `abonne`
--

INSERT INTO `abonne` (`idAbonne`, `prenom`) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura'),
(5, 'Jimmy'),
(6, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `idEmprunt` int(3) NOT NULL AUTO_INCREMENT,
  `idLivre` int(4) DEFAULT NULL,
  `idAbonne` int(4) DEFAULT NULL,
  `dateSortie` date DEFAULT NULL,
  `dateRendu` date DEFAULT NULL,
  PRIMARY KEY (`idEmprunt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `emprunt`
--

INSERT INTO `emprunt` (`idEmprunt`, `idLivre`, `idAbonne`, `dateSortie`, `dateRendu`) VALUES
(1, 100, 1, '2011-12-17', '2011-12-18'),
(2, 101, 2, '2011-12-18', '2011-12-20'),
(3, 100, 3, '2011-12-19', '2011-12-22'),
(4, 103, 4, '2011-12-19', '2011-12-22'),
(5, 104, 1, '2011-12-19', '2011-12-28'),
(6, 105, 2, '2012-03-20', '2012-03-26'),
(7, 105, 3, '2013-06-13', NULL),
(8, 100, 2, '2013-06-15', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE IF NOT EXISTS `livre` (
  `idLivre` int(4) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(25) DEFAULT NULL,
  `titre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idLivre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`idLivre`, `auteur`, `titre`) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le père Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');