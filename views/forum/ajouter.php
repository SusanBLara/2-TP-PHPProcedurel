<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Créer un article</h1>

<p><?= htmlspecialchars($data['message'] ?? '') ?></p>

<form method="post" action="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=ajouter">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>

    <label>Article</label>
    <textarea name="article" required><?= htmlspecialchars($_POST['article'] ?? '') ?></textarea>

    <button type="submit">Publier</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
