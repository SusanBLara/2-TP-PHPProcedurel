<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connex = mysqli_connect('localhost', 'root', 'admin', 'forumEtudiants', 3306);

if (!$connex) {
    echo 'Erreur de connexion ' . mysqli_connect_error();
    exit();
}

mysqli_set_charset($connex, 'utf8mb4');
