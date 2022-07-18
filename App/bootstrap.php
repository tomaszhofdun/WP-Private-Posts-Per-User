<?php

declare(strict_types=1);

namespace PPPU;

if (!\defined('ABSPATH')) {
    exit;
}

/**
 * Load Project classes with PSR-4 autoloader.
 */
\spl_autoload_register(function ($class): void {
    $prefix = __NAMESPACE__ . '\\';
    $base_dir = PPPU_PLUGIN_PATH . '/';

    $len = \strlen($prefix);

    if (0 !== \strncmp($prefix, $class, $len)) {
        return;
    }

    $relative_class = \substr($class, $len);
    $file = $base_dir . \str_replace('\\', '/', $relative_class) . '.php';

    if (\file_exists($file)) {
        require $file;
    }
});
