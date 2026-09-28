-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 08 Mars 2019 à 17:43
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO" ;
SET time_zone = "+00:00" ;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :   cgay 
--

-- --------------------------------------------------------

--
-- Structure de la table  Service 
--

CREATE TABLE  Service  (
    idService     integer (10) PRIMARY KEY AUTO_INCREMENT,
    nomService    varchar (50) NOT NULL,
    duree          integer (10),
    description    varchar (4096)       
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table  RendezVous 
--

CREATE TABLE  RendezVous  (
    idRdv           integer (20) PRIMARY KEY AUTO_INCREMENT,
    date_rdv        DATE NOT NULL,
    heure_rdv       TIME NOT NULL,
    statut          varchar (20),
    message         varchar (4096),
    idService       integer (10) NOT NULL,
    FOREIGN KEY (idService) REFERENCES Service(idService)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

INSERT INTO service (nomService, duree, description)
VALUES  ("Reflexologie plantaire", 75, ""),
        ("Reflexologie plantaire, palmaire et crânienne", 90, ""),
        ("Shiatsu", 90, ""),
        ("Mixte shiatsu et réflexologie", 115, "");
  
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;