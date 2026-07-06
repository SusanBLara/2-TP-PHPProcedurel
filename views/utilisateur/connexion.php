<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Connexion</h1>

<p><?= htmlspecialchars($data['message'] ?? '') ?></p>

<form method="post" action="<?= htmlspecialchars($basePath) ?>index.php?controller=utilisateur&amp;function=connexion">
    <label>Nom d'utilisateur</label>
    <input type="text" name="nom_utilisateur" required>

    <label>Mot de passe</label>
    <input type="password" name="mot_de_passe" required>

    <button type="submit">Se connecter</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
