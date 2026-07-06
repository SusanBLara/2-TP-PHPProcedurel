<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Modifier l'article</h1>

<form method="post" action="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=modifier&amp;id=<?= (int) ($data['article']['id_forum'] ?? 0) ?>">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($data['article']['titre'] ?? '') ?>" required>

    <label>Article</label>
    <textarea name="article" required><?= htmlspecialchars($data['article']['article'] ?? '') ?></textarea>

    <button type="submit">Modifier</button>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
