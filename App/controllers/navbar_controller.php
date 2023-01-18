<?php

declare(strict_types=1);
$active_tab = \sanitize_text_field($_GET['page']);
$settings_url = \add_query_arg(['page' => 'pppu_settings'], $_SERVER['REQUEST_URI']);
$password_change_url = \add_query_arg(['page' => 'pppu_password_change'], $_SERVER['REQUEST_URI']);
$create_users_with_pages_url = \add_query_arg(['action' => 'create_users_with_pages'], $_SERVER['REQUEST_URI']);
$change_users_password_url = \add_query_arg(['action' => 'change_users_password'], $_SERVER['REQUEST_URI']);
$error_url = \add_query_arg(['error' => 'nonce_error'], $_SERVER['REQUEST_URI']);
include PPPU_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'navbar.php';
