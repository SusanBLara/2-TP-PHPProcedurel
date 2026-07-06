<?php

require_once __DIR__ . '/../models/forumModel.php';
require_once __DIR__ . '/../library/check-session.php';

function forumAccueilController(mysqli $connex): array
{
    return [
        'page' => 'forum-accueil',
        'articles' => recupererArticlesForum($connex),
    ];
}

function forumAjouterController(mysqli $connex): array
{
    verifierSessionUtilisateur();

    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = trim($_POST['titre'] ?? '');
        $article = trim($_POST['article'] ?? '');
        $utilisateurId = (int) $_SESSION['utilisateur_id'];

        if ($titre !== '' && $article !== '') {
            creerArticleForum($connex, $titre, $article, $utilisateurId);
            header('Location: index.php?page=forum-accueil');
            exit;
        }

        $message = 'Veuillez remplir tous les champs.';
    }

    return [
        'page' => 'forum-ajouter',
        'message' => $message,
    ];
}

function forumModifierController(mysqli $connex): array
{
    verifierSessionUtilisateur();

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $utilisateurId = (int) $_SESSION['utilisateur_id'];

    $article = recupererArticleParIdEtUtilisateur($connex, $id, $utilisateurId);

    if (!$article) {
        die('Article introuvable ou accès interdit.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = trim($_POST['titre'] ?? '');
        $texte = trim($_POST['article'] ?? '');

        modifierArticleForum($connex, $id, $utilisateurId, $titre, $texte);
        header('Location: index.php?page=forum-accueil');
        exit;
    }

    return [
        'page' => 'forum-modifier',
        'article' => $article,
    ];
}

function forumSupprimerController(mysqli $connex): array
{
    verifierSessionUtilisateur();

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $utilisateurId = (int) $_SESSION['utilisateur_id'];

    $article = recupererArticleParIdEtUtilisateur($connex, $id, $utilisateurId);

    if (!$article) {
        die('Article introuvable ou accès interdit.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        supprimerArticleForum($connex, $id, $utilisateurId);

        header('Location: index.php?page=forum-accueil');
        exit;
    }

    return [
        'page' => 'forum-supprimer',
        'article' => $article,
    ];
}
