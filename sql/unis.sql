
-- Généré le :  mer. 23 jan. 2019 à 20:55

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `uniscite`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(500) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse1` varchar(500) NOT NULL,
  `adresse2` varchar(500) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `email` varchar(500) NOT NULL,
  `ville` varchar(500) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `pays` varchar(15) NOT NULL,
  `handicap` varchar(150) NOT NULL,
  `permis` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `volontaire`
--

DROP TABLE IF EXISTS `volontaire`;
CREATE TABLE IF NOT EXISTS `volontaire` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_inscrit` varchar(50)  NULL DEFAULT 1, /* <=> pre_volontaire */
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse1` varchar(500) NOT NULL,
  `adresse2` varchar(500) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `email` varchar(500) NOT NULL,
  `ville` varchar(500) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `pays` varchar(15) NOT NULL,
  `handicap` varchar(150) NOT NULL,
  `permis` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `assurance`
--

DROP TABLE IF EXISTS `assurance`;
CREATE TABLE IF NOT EXISTS `assurance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `email` varchar(500) NOT NULL,
  `ville` varchar(500) NOT NULL,
  `telephone` varchar(500) NOT NULL,
  `pays` varchar(500) NOT NULL,
  `typeassurance` int(11) NOT NULL ,
  `numAssurer` varchar(50) NOT NULL,
  `adresse1` varchar(500) NOT NULL,
  `adresse2` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `typeassurance`
--

DROP TABLE IF EXISTS `typeassurance`;
CREATE TABLE IF NOT EXISTS `typeassurance` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(500) NOT NULL,
  `type_vehicule` varchar(500) NOT NULL,
  `immatriculation` varchar(500) NOT NULL,
  `assurance` int(11) not null ,
  PRIMARY KEY (`id`),
  KEY `Vehicule_Assurance_FK` (`assurance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `assure`
--

DROP TABLE IF EXISTS `assure`;
CREATE TABLE IF NOT EXISTS `assure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assurance` int(11) NULL ,
  `employe` int(11) NULL,
  `volontaire` int(11) NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (assurance) REFERENCES assurance(id),
  FOREIGN KEY (employe) REFERENCES employe(id),
  FOREIGN KEY (volontaire) REFERENCES volontaire(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

DROP TABLE IF EXISTS `vehicule_de`;
CREATE TABLE IF NOT EXISTS `possede` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicule` int(11) default 0,
  `employe` int(11) default 0,
  `volontaire` int(11) default 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (employe) REFERENCES employe(id),
  FOREIGN KEY (volontaire) REFERENCES volontaire(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reunion_employe`
--

DROP TABLE IF EXISTS `reunion_composition`;
CREATE TABLE IF NOT EXISTS `reunion_employe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reunion` int(11) default 0,
  `employe` int(11) default 0,
  `volontaire` int(11) default 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (reunion) REFERENCES reunion(id),
  FOREIGN KEY (employe) REFERENCES employe(id),
  FOREIGN KEY (volontaire) REFERENCES volontaire(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;