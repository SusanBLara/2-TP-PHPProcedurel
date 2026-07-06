<?php

function recupererArticlesForum(mysqli $connex): array
{
    $sql = 'SELECT forum.*, utilisateur.nom
            FROM forum
            INNER JOIN utilisateur ON forum.id_utilisateur = utilisateur.id
            ORDER BY forum.date_publication DESC';

    $resultat = mysqli_query($connex, $sql);

    if (!$resultat) {
        return [];
    }

    return mysqli_fetch_all($resultat, MYSQLI_ASSOC);
}

function creerArticleForum(mysqli $connex, string $titre, string $article, int $utilisateurId): bool
{
    $sql = 'INSERT INTO forum (titre, article, date_publication, id_utilisateur) VALUES (?, ?, NOW(), ?)';

    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $titre, $article, $utilisateurId);

    return mysqli_stmt_execute($stmt);
}

function recupererArticleParIdEtUtilisateur(mysqli $connex, int $idForum, int $utilisateurId): ?array
{
    $sql = 'SELECT * FROM forum WHERE id_forum = ? AND id_utilisateur = ?';
    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $idForum, $utilisateurId);
    mysqli_stmt_execute($stmt);

    $resultat = mysqli_stmt_get_result($stmt);
    $article = mysqli_fetch_assoc($resultat);

    return $article ?: null;
}

function modifierArticleForum(
    mysqli $connex,
    int $idForum,
    int $utilisateurId,
    string $titre,
    string $article
): bool {
    $sql = 'UPDATE forum SET titre = ?, article = ? WHERE id_forum = ? AND id_utilisateur = ?';
    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 'ssii', $titre, $article, $idForum, $utilisateurId);

    return mysqli_stmt_execute($stmt);
}

function supprimerArticleForum(mysqli $connex, int $idForum, int $utilisateurId): bool
{
    $sql = 'DELETE FROM forum WHERE id_forum = ? AND id_utilisateur = ?';
    $stmt = mysqli_prepare($connex, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $idForum, $utilisateurId);

    return mysqli_stmt_execute($stmt);
}
