<?php
function render(string $page, array $data = []): void
{
    $viewFile = VIEW_DIR . '/' . str_replace('-', '/', $page) . '.php';

    require VIEW_DIR . '/layout/header.php';

    if (file_exists($viewFile)) {
        require $viewFile;
    } else {
        require VIEW_DIR . '/forum/accueil.php';
    }

    require VIEW_DIR . '/layout/footer.php';
}
