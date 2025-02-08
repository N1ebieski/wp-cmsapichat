<?php

declare(strict_types=1);

namespace WPCmsapichat\Actions\SEOPress\RegisterMeta;

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
        register_meta('post', '_seopress_titles_title', [
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);

        register_meta('post', '_seopress_titles_desc', [
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true,
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            },
        ]);
    }
}
