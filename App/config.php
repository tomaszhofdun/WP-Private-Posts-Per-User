<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;
define('PPPU_CHARSET', $wpdb->get_charset_collate());

define('PPPU_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PPPU_PLUGIN_URL', plugin_dir_url(__FILE__));

define('PPPU_APP_NAMESPACE', 'PPPU');
define('PPPU_APP_NAME', 'Private Posts Per User');


define('PPPU_APP_CATALOG_NAME', basename(dirname(PPPU_PLUGIN_PATH))); // Private Posts Per User
define('PPPU_APP_TEXT_DOMAIN', PPPU_APP_CATALOG_NAME); // Private Posts Per User
define('PPPU_APP_MAIN_FILE', PPPU_APP_CATALOG_NAME . '.php');  // Private Posts Per User.php
define('PPPU_APP_MAIN_FILE_PATH', dirname(PPPU_PLUGIN_PATH) . DIRECTORY_SEPARATOR . PPPU_APP_MAIN_FILE);
