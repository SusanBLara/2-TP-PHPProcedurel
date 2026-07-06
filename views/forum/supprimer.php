<h1>Supprimer l'article</h1>

<article class="card">
	<h2><?= htmlspecialchars($data['article']['titre'] ?? '') ?></h2>

	<p><?= nl2br(htmlspecialchars($data['article']['article'] ?? '')) ?></p>

	<small>
		Écrit par <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>
	</small>
</article>

<p>Voulez-vous vraiment supprimer cet article? Cette action est irréversible.</p>

<form method="post" action="index.php?page=forum-supprimer&id=<?= (int) ($data['article']['id_forum'] ?? 0) ?>">
	<button type="submit">Oui, supprimer</button>
	<a href="index.php?page=forum-accueil">Annuler</a>
</form>
