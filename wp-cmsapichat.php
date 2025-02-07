<?php
/**
 * Plugin Name: Cmsapichat.pl Plugin
 * Author: Mariusz Wysokiński
 * Author URI: https://intelekt.net.pl
 * Description: Adds support for the site through the cmsapichat.pl tool
 * Version: 1.1
 * 
 * @wordpress-plugin
 */

// To prevent calling the plugin directly
if ( ! function_exists( 'add_action' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Auto updates

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/N1ebieski/wp-cmsapichat.git',
	__FILE__,
	'wp-cmsapichat'
);

$myUpdateChecker->setBranch('production');

add_action('rest_api_init', function () {
    register_rest_route('meta/v1', '/plugins', [
        'methods' => 'GET',
        'callback' => function () {
            if (! function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            
            $plugins = get_option('active_plugins');
            
            return rest_ensure_response($plugins);
        },
        'permission_callback' => function () {
            return current_user_can('manage_options'); // Only for admins
        },
    ]);
});

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if (is_plugin_active('wordpress-seo/wp-seo.php')) {
    add_action('rest_api_init', function () {
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
    });
}

if (is_plugin_active('wp-seopress/seopress.php')) {
    add_action('rest_api_init', function () {
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
    });
}
