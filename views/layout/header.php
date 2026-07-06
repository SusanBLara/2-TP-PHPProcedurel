<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Maisonneuve</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php?page=forum-accueil">Accueil</a>

    <?php if (isset($_SESSION['utilisateur_id'])) : ?>
        <a href="index.php?page=forum-ajouter">Créer un article</a>
        <a href="index.php?page=deconnexion">Déconnexion</a>
    <?php else : ?>
        <a href="index.php?page=inscription">Inscription</a>
        <a href="index.php?page=connexion">Connexion</a>
    <?php endif; ?>
</nav>

<main>
