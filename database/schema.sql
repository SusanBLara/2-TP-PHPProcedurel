CREATE DATABASE forumEtudiants
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE forumEtudiants;

CREATE TABLE utilisateur (
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
nom VARCHAR(50) NOT NULL,
nom_utilisateur VARCHAR(50) NOT NULL UNIQUE,
mot_de_passe VARCHAR(255) NOT NULL,
date_naissance DATE NOT NULL
);

CREATE TABLE forum (
    id_forum INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    article TEXT NOT NULL,
    date_publication DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT NOT NULL,

    CONSTRAINT fk_forum_utilisateur
        FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
