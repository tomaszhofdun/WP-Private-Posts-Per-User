<?php

declare(strict_types=1);

$actions = PPPU_PLUGIN_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'actions' . DIRECTORY_SEPARATOR;

if (\current_user_can('administrator') && isset($_GET['action'])) {
    $action = \sanitize_text_field($_GET['action']);

    switch ($action) {
        case 'change_users_password':
            include $actions . 'change_users_password.php';
            break;
    }

    return;
}

include PPPU_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'change-users-password.php';
