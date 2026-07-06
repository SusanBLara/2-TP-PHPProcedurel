<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Maisonneuve</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<nav>
    <a href="index.php?controller=forum&function=accueil">Accueil</a>

    <?php if (isset($_SESSION['utilisateur_id'])) : ?>
        <a href="index.php?controller=forum&function=ajouter">Créer un article</a>
        <a href="index.php?controller=utilisateur&function=deconnexion">Déconnexion</a>
    <?php else : ?>
        <a href="index.php?controller=utilisateur&function=inscription">Inscription</a>
        <a href="index.php?controller=utilisateur&function=connexion">Connexion</a>
    <?php endif; ?>
</nav>

<main>
