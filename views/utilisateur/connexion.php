<h1>Connexion</h1>

<p><?= htmlspecialchars($data['message'] ?? '') ?></p>

<form method="post" action="index.php?page=connexion">
    <label>Nom d'utilisateur</label>
    <input type="text" name="nom_utilisateur" required>

    <label>Mot de passe</label>
    <input type="password" name="mot_de_passe" required>

    <button type="submit">Se connecter</button>
</form>
