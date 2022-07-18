<?php

/**
 * Plugin Name: Private Posts Per User
 * Description: Plugin który pozwala na tworzenie stron widocznych tylko dla pojedynczego użytkownika.
 * Version: 1.0
 * Author: Tomasz hofdun
 * License: GPL2
 * Text Domain: pppu
 * Tested up to: 6.0.0
 * Class name PPPU.
 */

declare(strict_types=1);

namespace PPPU;

if (!\defined('ABSPATH')) {
    exit;
}

require_once 'Dev/log.php';
require_once 'App/config.php';
require_once 'App/bootstrap.php';

require 'vendor/autoload.php';

App::instance();
