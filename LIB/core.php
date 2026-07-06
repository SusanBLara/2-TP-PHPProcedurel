<?php
function app_base_path(): string
{
    global $config;

    if (!empty($config['base_url'])) {
        return rtrim((string) $config['base_url'], '/');
    }

    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $basePath = str_replace('\\', '/', dirname($scriptName));

    if ($basePath === '/' || $basePath === '.') {
        return '';
    }

    return rtrim($basePath, '/');
}

function render(string $page, array $data = []): void
{
    $viewFile = VIEW_DIR . '/' . str_replace('-', '/', $page) . '.php';
    $basePath = app_base_path();

    if ($basePath !== '') {
        $basePath .= '/';
    } else {
        $basePath = '/';
    }

    if (file_exists($viewFile)) {
        require $viewFile;
    } else {
        echo 'Vue introuvable.';
    }
}
