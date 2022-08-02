<?php

declare(strict_types=1);

$actions = PPPU_PLUGIN_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR;

if (\current_user_can('administrator') && isset($_GET['action'])) {
    $action = \sanitize_text_field($_GET['action']);

    switch ($action) {
        case 'create_users_with_pages':
            include $actions . 'create_users_with_pages.php';
            break;
    }

    return;
}

include PPPU_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'settings.php';
