<?php

declare(strict_types=1);

namespace PPPU;

use PPPU\Services\ActionsLoader;
use PPPU\Services\FilterLoader;

if (!\defined('ABSPATH')) {
    exit;
}

final class App
{
    use Singleton;

    private function __construct()
    {
        $this->loadServices();
    }

    private function loadServices(): void
    {
        ActionsLoader::instance();
        FilterLoader::instance();
    }
}