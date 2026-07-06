<?php

require_once __DIR__ . '/../models/forumModel.php';
require_once __DIR__ . '/../LIB/check-session.php';

function forum_controller_accueil(array $request, mysqli $connex): array
{
    return [
        'page' => 'forum-accueil',
        'articles' => recupererArticlesForum($connex),
    ];
}

function forum_controller_ajouter(array $request, mysqli $connex): array
{
    verifierSessionUtilisateur();

    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = trim($_POST['titre'] ?? '');
        $article = trim($_POST['article'] ?? '');
        $utilisateurId = (int) $_SESSION['utilisateur_id'];

        if ($titre !== '' && $article !== '') {
            creerArticleForum($connex, $titre, $article, $utilisateurId);
            header('Location: index.php?controller=forum&function=accueil');
            exit;
        }

        $message = 'Veuillez remplir tous les champs.';
    }

    return [
        'page' => 'forum-ajouter',
        'message' => $message,
    ];
}

function forum_controller_modifier(array $request, mysqli $connex): array
{
    verifierSessionUtilisateur();

    $id = isset($request['id']) ? (int) $request['id'] : 0;
    $utilisateurId = (int) $_SESSION['utilisateur_id'];

    $article = recupererArticleParIdEtUtilisateur($connex, $id, $utilisateurId);

    if (!$article) {
        die('Article introuvable ou accès interdit.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre = trim($_POST['titre'] ?? '');
        $texte = trim($_POST['article'] ?? '');

        modifierArticleForum($connex, $id, $utilisateurId, $titre, $texte);
        header('Location: index.php?controller=forum&function=accueil');
        exit;
    }

    return [
        'page' => 'forum-modifier',
        'article' => $article,
    ];
}

function forum_controller_supprimer(array $request, mysqli $connex): array
{
    verifierSessionUtilisateur();

    $id = isset($request['id']) ? (int) $request['id'] : 0;
    $utilisateurId = (int) $_SESSION['utilisateur_id'];

    $article = recupererArticleParIdEtUtilisateur($connex, $id, $utilisateurId);

    if (!$article) {
        die('Article introuvable ou accès interdit.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        supprimerArticleForum($connex, $id, $utilisateurId);

        header('Location: index.php?controller=forum&function=accueil');
        exit;
    }

    return [
        'page' => 'forum-supprimer',
        'article' => $article,
    ];
}
