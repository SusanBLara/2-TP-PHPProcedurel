<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Forum Maisonneuve</h1>

<?php if (!empty($data['message'])) : ?>
    <p><?= htmlspecialchars($data['message']) ?></p>
<?php endif; ?>

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
                <a href="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=modifier&amp;id=<?= (int) $article['id_forum'] ?>">Modifier</a>
                <a href="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=supprimer&amp;id=<?= (int) $article['id_forum'] ?>">Supprimer</a>
            </p>
        <?php endif; ?>
    </article>

<?php endforeach; ?>

<?php if (empty($data['articles'])) : ?>
    <p>Aucun article a afficher pour le moment.</p>
<?php endif; ?>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
