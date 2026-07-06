<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Créer un nouvel utilisateur</h1>

<p><?= htmlspecialchars($data['message'] ?? '') ?></p>

<form method="post" action="<?= htmlspecialchars($basePath) ?>index.php?controller=utilisateur&amp;function=inscription">
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Nom d'utilisateur</label>
    <input type="text" name="nom_utilisateur" required>

    <label>Mot de passe</label>
    <input type="password" name="mot_de_passe" required>

    <label>Date de naissance</label>
    <input type="date" name="date_naissance" required>

    <button type="submit">Créer</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
