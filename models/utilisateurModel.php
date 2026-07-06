<?php

function trouverUtilisateurParNom(mysqli $connex, string $nomUtilisateur): ?array
{
    $sql = 'SELECT * FROM utilisateur WHERE nom_utilisateur = ?';
    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 's', $nomUtilisateur);
    mysqli_stmt_execute($stmt);

    $resultat = mysqli_stmt_get_result($stmt);
    $utilisateur = mysqli_fetch_assoc($resultat);

    return $utilisateur ?: null;
}

function creerUtilisateur(
    mysqli $connex,
    string $nom,
    string $nomUtilisateur,
    string $motDePasse,
    string $dateNaissance
): bool {
    $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO utilisateur (nom, nom_utilisateur, mot_de_passe, date_naissance) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $nom, $nomUtilisateur, $motDePasseHash, $dateNaissance);

    try {
        return mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $exception) {
        return false;
    }
}
