-- Base de données du module de rendez-vous (MySQL 5.7+/8, MariaDB 10.x)
-- Noms de tables en minuscules : identiques sous Windows et Linux.
CREATE DATABASE IF NOT EXISTS cabane CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cabane;
SET NAMES utf8mb4;

DROP TABLE IF EXISTS rendezvous;
DROP TABLE IF EXISTS service;

CREATE TABLE service (
    idService   INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nomService  VARCHAR(50)  NOT NULL,
    duree       INT          NOT NULL COMMENT 'durée du soin en minutes',
    description VARCHAR(4096) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE rendezvous (
    idRdv        INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_rdv     DATE         NOT NULL,
    heure_rdv    TIME         NOT NULL COMMENT 'heure de début',
    heure_fin    TIME         NOT NULL COMMENT 'heure de début + durée du service',
    statut       VARCHAR(20)  NOT NULL DEFAULT 'en_attente',
    nom_client   VARCHAR(100) NOT NULL,
    email_client VARCHAR(150) NOT NULL,
    telephone    VARCHAR(20)  NULL,
    message      VARCHAR(1000) NOT NULL DEFAULT '',
    idService    INT          NOT NULL,
    cree_le      DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_rdv_date (date_rdv),
    CONSTRAINT fk_rdv_service FOREIGN KEY (idService) REFERENCES service (idService),
    CONSTRAINT ck_rdv_statut CHECK (statut IN ('en_attente', 'confirmé', 'annulé')),
    CONSTRAINT ck_rdv_heures CHECK (heure_fin > heure_rdv)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO service (nomService, duree, description) VALUES
    ('Réflexologie plantaire', 75, ''),
    ('Réflexologie plantaire, palmaire et crânienne', 90, ''),
    ('Shiatsu', 90, ''),
    ('Mixte shiatsu et réflexologie', 115, '');
