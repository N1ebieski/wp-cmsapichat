<?php

declare(strict_types=1);

namespace WPCmsapichat\Providers\Api;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use WPCmsapichat\Actions\Api\Plugins\RegisterIndexRoute\RegisterIndexRouteAction;
use WPCmsapichat\Actions\SEOPress\RegisterMeta\RegisterMetaAction as SEOPressRegisterMetaAction;
use WPCmsapichat\Actions\YoastWPSeo\RegisterMeta\RegisterMetaAction as YoastWPSeoRegisterMetaAction;
use WPCmsapichat\Providers\Provider;

final class ApiProvider extends Provider
{
    public function boot(): void
    {
        add_action('rest_api_init', [new RegisterIndexRouteAction(), 'handle']);

        if (! function_exists('is_plugin_active')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        if (is_plugin_active('wordpress-seo/wp-seo.php')) {
            add_action('rest_api_init', [new YoastWPSeoRegisterMetaAction(), 'handle']);
        }

        if (is_plugin_active('wp-seopress/seopress.php')) {
            add_action('rest_api_init', [new SeoPressRegisterMetaAction(), 'handle']);
        }
    }
}
