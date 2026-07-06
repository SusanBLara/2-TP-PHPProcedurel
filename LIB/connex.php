<?php
$connex = @mysqli_connect('localhost', 'root', 'admin', 'forumEtudiants', 3306);

if (!$connex) {
    $GLOBALS['db_error'] = mysqli_connect_error();
    $connex = null;
    return;
}

mysqli_set_charset($connex, 'utf8mb4');
