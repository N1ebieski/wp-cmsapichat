<?php

declare(strict_types=1);

namespace WPCmsapichat\Providers\Puc;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use WPCmsapichat\Providers\Provider;
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

final class PucProvider extends Provider
{
    public function boot(): void
    {
        $myUpdateChecker = PucFactory::buildUpdateChecker(
            WP_CMSAPICHAT_PUC_REPO,
            realpath(__DIR__ . '/../../../wp-cmsapichat.php'),
            WP_CMSAPICHAT_NAME
        );

        $myUpdateChecker->setBranch(WP_CMSAPICHAT_PUC_BRANCH);
    }
}
