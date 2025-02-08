<?php

declare(strict_types=1);

namespace WPCmsapichat\Actions\Api\Plugins\RegisterIndexRoute;

use WPCmsapichat\Actions\Action;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

final class RegisterIndexRouteAction extends Action
{
    public function handle(): void
    {
        register_rest_route('meta/v1', '/plugins', [
            'methods' => 'GET',
            'callback' => function () {
                $plugins = get_option('active_plugins');

                return rest_ensure_response($plugins);
            },
            'permission_callback' => function () {
                return current_user_can('manage_options'); // Only for admins
            },
        ]);
    }
}
