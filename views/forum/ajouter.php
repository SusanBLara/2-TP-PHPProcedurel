<h1>Créer un article</h1>

<p><?= htmlspecialchars($data['message'] ?? '') ?></p>

<form method="post" action="index.php?controller=forum&function=ajouter">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>

    <label>Article</label>
    <textarea name="article" required><?= htmlspecialchars($_POST['article'] ?? '') ?></textarea>

    <button type="submit">Publier</button>
</form>
