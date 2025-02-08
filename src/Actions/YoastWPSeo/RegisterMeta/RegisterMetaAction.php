<?php

declare(strict_types=1);

namespace WPCmsapichat\Actions\YoastWPSeo\RegisterMeta;

use WPCmsapichat\Actions\Action;

if (!defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

final class RegisterMetaAction extends Action
{
    public function handle(): void
    {
        register_meta('post', '_yoast_wpseo_title', [
            'type' => 'string',
            'single' => false,
            'show_in_rest' => true,
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);

        register_meta('post', '_yoast_wpseo_metadesc', [
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);
    }
}
