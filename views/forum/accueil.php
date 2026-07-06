<h1>Forum Maisonneuve</h1>

<?php foreach (($data['articles'] ?? []) as $article) : ?>

    <article class="card">
        <h2><?= htmlspecialchars($article['titre']) ?></h2>

        <p><?= nl2br(htmlspecialchars($article['article'])) ?></p>

        <small>
            Écrit par <?= htmlspecialchars($article['nom']) ?>
            le <?= $article['date_publication'] ?>
        </small>

        <?php if (
            isset($_SESSION['utilisateur_id']) &&
            $_SESSION['utilisateur_id'] == $article['id_utilisateur']
        ) : ?>
            <p>
                <a href="index.php?page=forum-modifier&id=<?= (int) $article['id_forum'] ?>">Modifier</a>
                <a href="index.php?page=forum-supprimer&id=<?= (int) $article['id_forum'] ?>">Supprimer</a>
            </p>
        <?php endif; ?>
    </article>

<?php endforeach; ?>
