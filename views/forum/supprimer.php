<?php $basePath = $basePath ?? ''; ?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Supprimer l'article</h1>

<article class="card">
	<h2><?= htmlspecialchars($data['article']['titre'] ?? '') ?></h2>

	<p><?= nl2br(htmlspecialchars($data['article']['article'] ?? '')) ?></p>

	<small>
		Écrit par <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>
	</small>
</article>

<p>Voulez-vous vraiment supprimer cet article? Cette action est irréversible.</p>

<form method="post" action="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=supprimer&amp;id=<?= (int) ($data['article']['id_forum'] ?? 0) ?>">
	<button type="submit">Oui, supprimer</button>
	<a href="<?= htmlspecialchars($basePath) ?>index.php?controller=forum&amp;function=accueil">Annuler</a>
</form>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
