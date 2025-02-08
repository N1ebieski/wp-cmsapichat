<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

define('WP_CMSAPICHAT_NAME', 'wp-cmsapichat');

define('WP_CMSAPICHAT_PUC_REPO', $_ENV['WP_CMSAPICHAT_PUC_REPO'] ?? 'https://github.com/N1ebieski/wp-cmsapichat');

define('WP_CMSAPICHAT_PUC_BRANCH', $_ENV['WP_CMSAPICHAT_PUC_BRANCH'] ?? 'production');

define('WP_CMSAPICHAT_PUC_PROVIDERS', [
    \WPCmsapichat\Providers\Puc\PucProvider::class,
    \WPCmsapichat\Providers\Api\ApiProvider::class
]);
