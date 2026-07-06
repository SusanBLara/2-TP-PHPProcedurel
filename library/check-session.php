<?php

function verifierSessionUtilisateur(): void
{
    $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);

    if (!isset($_SESSION['fingerPrint']) || $_SESSION['fingerPrint'] !== $fingerPrint) {
        header('Location: index.php?page=connexion');
        exit;
    }
}