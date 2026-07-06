<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('config/config.php');
require_once(CONNEX_DIR);
require_once('LIB/core.php');

$controller = isset($_REQUEST['controller']) ? strtolower((string) $_REQUEST['controller']) : $config['default_controller'];
$function = isset($_REQUEST['function']) ? strtolower((string) $_REQUEST['function']) : $config['default_function'];

$controller = preg_replace('/[^a-z0-9_-]/', '', $controller);
$function = preg_replace('/[^a-z0-9_-]/', '', $function);

$controller_file = 'controllers/' . $controller . 'Controller.php';

if (!file_exists($controller_file)) {
    echo 'Controleur introuvable.';
    exit;
}

require_once($controller_file);

$controller_function = strtolower($controller) . '_controller_' . $function;

if (!function_exists($controller_function)) {
    echo 'Action introuvable.';
    exit;
}

$data = call_user_func($controller_function, $_REQUEST, $connex);

$current_page = $data['page'] ?? 'forum-accueil';
render($current_page, $data);
