<?php

declare(strict_types=1);

namespace WPCmsapichat\Providers;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

abstract class Provider
{
    abstract public function register(): void;
}
