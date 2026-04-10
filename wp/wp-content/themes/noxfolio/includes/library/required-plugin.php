<?php

/**
 * Required Plugin for Noxfolio theme
 *
 * @package Noxfolio
 */

if (! defined('ABSPATH')) {
    exit('No direct script access allowed');
}

add_action('tgmpa_register', 'noxfolio_register_required_plugins');
function noxfolio_register_required_plugins()
{
    $plugins = [
        [
            'name'     => esc_html__('Elementor Website Builder', 'noxfolio'),
            'slug'     => 'elementor',
            'required' => true,
            'version'  => '3.12',
        ],
        [
            'name'     => esc_html__('Noxfolio Toolkit', 'noxfolio'),
            'slug'     => 'noxfolio-toolkit',
            'source'   => 'https://wp.webtend.net/noxfolio/tf-data/noxfolio-toolkit.zip',
            'required' => true,
            'version'  => '1.0.8',
        ],
        [
            'name'     => esc_html__('MetForm', 'noxfolio'),
            'slug'     => 'metform',
            'required' => false,
        ],
        [
            'name'     => esc_html__('Breadcrumb NavXT', 'noxfolio'),
            'slug'     => 'breadcrumb-navxt',
            'required' => false,
        ],
        [
            'name'     => esc_html__('One Click Demo Import', 'noxfolio'),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
    ];

    $config = [
        'id'           => 'noxfolio_theme_plugins',
        'default_path' => '',
        'menu'         => 'noxfolio_required_plugins',
        'parent_slug'  => 'noxfolio_dashboard',
        'capability'   => 'manage_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => [
            'menu_title' => esc_html__('Required Plugins', 'noxfolio'),
            'page_title' => esc_html__('Required Plugins', 'noxfolio'),
        ],
    ];

    tgmpa($plugins, $config);
}
