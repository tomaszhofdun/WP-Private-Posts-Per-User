<?php

declare(strict_types=1);

namespace PPPU;

use Exception;

trait Singleton
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
        // do not allow to clone Singleton
    }

    /**
     * @throws Exception
     */
    public function __wakeup(): void
    {
        throw new Exception('Cannot unserialize singleton');
    }

    public static function instance()
    {
        $called_class = \get_called_class();
        if (null === self::$instance) {
            self::$instance = new $called_class();
        }

        return self::$instance;
    }
}
