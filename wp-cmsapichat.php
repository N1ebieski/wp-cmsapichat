<?php

/**
 * Plugin Name: WP CMSapichat
 * Author: Mariusz Wysokiński
 * Author URI: https://intelekt.net.pl
 * Description: Adds support for the site through the cmsapichat.pl tool
 * Version: 1.3.0
 *
 * @wordpress-plugin
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

// Autoloader

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Configuration

require_once __DIR__ . '/config/wp-cmsapichat.php';

// Init providers

$composite = new \WPCmsapichat\Providers\ProviderComposite();

$composite->through(...array_map(fn (string $class) => new $class(), WP_CMSAPICHAT_PUC_PROVIDERS))->process();
