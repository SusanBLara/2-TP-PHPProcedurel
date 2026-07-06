<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/forumController.php';
require_once __DIR__ . '/../controllers/utilisateurController.php';

$page = $_GET['page'] ?? 'forum-accueil';
$data = [];

switch ($page) {
    case 'connexion':
        $data = utilisateurConnexionController($connex);
        break;

    case 'inscription':
        $data = utilisateurInscriptionController($connex);
        break;

    case 'deconnexion':
        utilisateurDeconnexionController();
        break;

    case 'forum-ajouter':
        $data = forumAjouterController($connex);
        break;

    case 'forum-modifier':
        $data = forumModifierController($connex);
        break;

    case 'forum-supprimer':
        $data = forumSupprimerController($connex);
        break;

    case 'forum-accueil':
    default:
        $data = forumAccueilController($connex);
        break;
}

$currentPage = $data['page'] ?? 'forum-accueil';

require_once __DIR__ . '/../views/layout/header.php';

$viewMap = [
    'forum-accueil' => __DIR__ . '/../views/forum/accueil.php',
    'forum-ajouter' => __DIR__ . '/../views/forum/ajouter.php',
    'forum-modifier' => __DIR__ . '/../views/forum/modifier.php',
    'forum-supprimer' => __DIR__ . '/../views/forum/supprimer.php',
    'utilisateur-connexion' => __DIR__ . '/../views/utilisateur/connexion.php',
    'utilisateur-inscription' => __DIR__ . '/../views/utilisateur/inscription.php',
    'utilisateur-deconnexion' => __DIR__ . '/../views/utilisateur/deconnexion.php',
];

$viewFile = $viewMap[$currentPage] ?? __DIR__ . '/../views/forum/accueil.php';

if (file_exists($viewFile)) {
    require $viewFile;
}

require_once __DIR__ . '/../views/layout/footer.php';