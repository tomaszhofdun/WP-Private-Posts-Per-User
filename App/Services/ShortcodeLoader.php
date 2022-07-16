<?php

declare(strict_types=1);

namespace PPPU\Services;

use PPPU\Singleton;

if (!defined('ABSPATH')) {
    exit;
}


class ShortcodeLoader
{
    use Singleton;

    private function __construct()
    {
        // add_shortcode('bartag', 'bartag_func');
    }
}
