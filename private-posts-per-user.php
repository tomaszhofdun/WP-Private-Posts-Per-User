<?php

/**
 * Plugin Name: Private Posts Per User
 * Description: The plugin allows to create a single page that is only visible to a specific user
 * Version: 1.0
 * Author: Tomasz Hofdun
 * License: GPL2
 * Text Domain: private-posts-per-user
 * Domain Path: /App/lang
 */

declare(strict_types=1);

namespace PPPU;

if (!\defined('ABSPATH')) {
    exit;
}

require_once 'App/config.php';
require_once 'App/bootstrap.php';

require 'vendor/autoload.php';

App::instance();
