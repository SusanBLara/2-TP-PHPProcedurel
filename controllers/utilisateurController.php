<?php

require_once __DIR__ . '/../models/utilisateurModel.php';

function utilisateur_controller_connexion(array $request, ?mysqli $connex): array
{
    $message = '';

    if (!$connex) {
        return [
            'page' => 'utilisateur-connexion',
            'message' => 'Connexion impossible: la base de donnees est indisponible.',
        ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomUtilisateur = trim($_POST['nom_utilisateur'] ?? '');
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        $utilisateur = trouverUtilisateurParNom($connex, $nomUtilisateur);

        if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
            session_regenerate_id();

            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

            header('Location: ' . app_base_path() . '/index.php?controller=forum&function=accueil');
            exit;
        }

        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }

    return [
        'page' => 'utilisateur-connexion',
        'message' => $message,
    ];
}

function utilisateur_controller_inscription(array $request, ?mysqli $connex): array
{
    $message = '';

    if (!$connex) {
        return [
            'page' => 'utilisateur-inscription',
            'message' => 'Inscription impossible: la base de donnees est indisponible.',
        ];
    }

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

function utilisateur_controller_deconnexion(array $request, ?mysqli $connex): void
{
    session_unset();
    session_destroy();

    header('Location: ' . app_base_path() . '/index.php?controller=utilisateur&function=connexion');
    exit;
}
