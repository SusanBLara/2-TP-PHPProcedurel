<?php

require_once __DIR__ . '/../models/utilisateurModel.php';

function utilisateurConnexionController(mysqli $connex): array
{
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomUtilisateur = trim($_POST['nom_utilisateur'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        $utilisateur = trouverUtilisateurParNom($connex, $nomUtilisateur);

        if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
            session_regenerate_id();

            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

            header('Location: index.php?page=forum-accueil');
            exit;
}

        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }

    return [
        'page' => 'utilisateur-connexion',
        'message' => $message,
    ];
}

function utilisateurInscriptionController(mysqli $connex): array
{
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom'] ?? '');
        $nomUtilisateur = trim($_POST['nom_utilisateur'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';
        $dateNaissance = $_POST['date_naissance'] ?? '';

        if ($nom !== '' && $nomUtilisateur !== '' && $motDePasse !== '' && $dateNaissance !== '') {
            $utilisateurExistant = trouverUtilisateurParNom($connex, $nomUtilisateur);

            if ($utilisateurExistant) {
                $message = "Ce nom d'utilisateur existe déjà.";
            } elseif (creerUtilisateur($connex, $nom, $nomUtilisateur, $motDePasse, $dateNaissance)) {
                $message = 'Utilisateur créé avec succès.';
            } else {
                $message = "Impossible de créer l'utilisateur.";
            }
        } else {
            $message = 'Veuillez remplir tous les champs.';
        }
    }

    return [
        'page' => 'utilisateur-inscription',
        'message' => $message,
    ];
}

function utilisateurDeconnexionController(): void
{
    session_unset();
    session_destroy();

    header('Location: index.php?page=connexion');
    exit;
}
