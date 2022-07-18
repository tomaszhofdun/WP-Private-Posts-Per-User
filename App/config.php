<?php

declare(strict_types=1);

if (!\defined('ABSPATH')) {
    exit;
}

global $wpdb;
\define('PPPU_CHARSET', $wpdb->get_charset_collate());

\define('PPPU_PLUGIN_PATH', \plugin_dir_path(__FILE__));
\define('PPPU_PLUGIN_APP_URL', \plugin_dir_url(__FILE__));

\define('PPPU_APP_NAMESPACE', 'PPPU');
\define('PPPU_APP_NAME', 'Private Posts Per User');

\define('PPPU_APP_CATALOG_NAME', \basename(\dirname(PPPU_PLUGIN_PATH))); // Private Posts Per User
\define('PPPU_APP_TEXT_DOMAIN', PPPU_APP_CATALOG_NAME); // Private Posts Per User
\define('PPPU_APP_MAIN_FILE', PPPU_APP_CATALOG_NAME . '.php');  // Private Posts Per User.php
\define('PPPU_APP_MAIN_FILE_PATH', \dirname(PPPU_PLUGIN_PATH) . DIRECTORY_SEPARATOR . PPPU_APP_MAIN_FILE);

// Define path and URL to the ACF plugin.
\define('MY_ACF_PATH', PPPU_PLUGIN_PATH . '/includes/advanced-custom-fields/');
\define('MY_ACF_URL', PPPU_PLUGIN_APP_URL . '/includes/advanced-custom-fields/');

\define('MY_ACFE_PATH', PPPU_PLUGIN_PATH . '/includes/acf-extended/');
\define('MY_ACFE_URL', PPPU_PLUGIN_APP_URL . '/includes/acf-extended/');
