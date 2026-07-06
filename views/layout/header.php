<?php $basePath = $basePath ?? ''; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Maisonneuve</title>
   <link rel="stylesheet" href="<?php echo $basePath; ?>public/css/style.css">
</head>
<body>

<nav>
    <a href="<?php echo $basePath; ?>index.php?controller=forum&amp;function=accueil">Accueil</a>

    <?php if (isset($_SESSION['utilisateur_id'])) : ?>
        <a href="<?php echo $basePath; ?>index.php?controller=forum&amp;function=ajouter">Créer un article</a>
        <a href="<?php echo $basePath; ?>index.php?controller=utilisateur&amp;function=deconnexion">Déconnexion</a>
    <?php else : ?>
        <a href="<?php echo $basePath; ?>index.php?controller=utilisateur&amp;function=inscription">Inscription</a>
        <a href="<?php echo $basePath; ?>index.php?controller=utilisateur&amp;function=connexion">Connexion</a>
    <?php endif; ?>
</nav>

<main>
