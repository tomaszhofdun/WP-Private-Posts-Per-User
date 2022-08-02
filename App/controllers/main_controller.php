<?php

declare(strict_types=1);

$controller = PPPU_PLUGIN_PATH . 'controllers' . DIRECTORY_SEPARATOR;

if (\current_user_can('administrator') && isset($_GET['page'])) {
    $page = \sanitize_text_field($_GET['page']);

    include $controller . 'navbar_controller.php';

    switch ($page) {
        case 'pppu_settings':
            include $controller . 'pppu_settings.php';
            break;
    }
}
