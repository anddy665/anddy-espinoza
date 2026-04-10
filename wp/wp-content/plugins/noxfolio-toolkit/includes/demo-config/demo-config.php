<?php
namespace NoxfolioToolkit\DemoConfig;

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

class Noxfolio_Demo_Config {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_filter( 'ocdi/import_files', [$this, 'import_files'] );
        add_filter( 'ocdi/after_import', [$this, 'after_import_demo'] );
        add_filter( 'ocdi/register_plugins', [$this, 'register_plugins'] );
        add_filter( 'ocdi/plugin_page_setup', [$this, 'plugin_page_setup'] );
    }

    /**
     * Plugin Page Setup
     *
     * @return void
     */
    public function plugin_page_setup( $default_settings ) {
        $default_settings['parent_slug'] = 'themes.php';
        $default_settings['page_title']  = esc_html__( 'Noxfolio Demo Import', 'noxfolio-toolkit' );
        $default_settings['menu_title']  = esc_html__( 'Import Demo Data', 'noxfolio-toolkit' );
        $default_settings['capability']  = 'import';
        $default_settings['menu_slug']   = 'noxfolio_demo_import';

        return $default_settings;
    }

    /**
     * Import Files
     */
    public function import_files() {
        return [
            [
                'import_file_name'             => esc_html__( 'Main Demo', 'noxfolio-toolkit' ),
                'local_import_file'            => NT_INCLUDES . '/demo-config/demo/content.xml',
                'local_import_widget_file'     => NT_INCLUDES . '/demo-config/demo/widgets.wie',
                'local_import_customizer_file' => NT_INCLUDES . '/demo-config/demo/customizer.dat',
                'import_notice'                => esc_html__( 'Works best on a new install of WordPress. Before you begin, make sure all the required plugins are install and activated. After you import this demo, you need to setup menu and front page. Read documentation for more information.', 'noxfolio-toolkit' ),
                'preview_url'                  => esc_url( 'https://webtend.site/wp/noxfolio/' ),
            ],
        ];
    }

    /**
     * After Import Demo
     *
     * Do Stuff After Demo Import
     */
    public function after_import_demo() {
        $main_menu   = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
        $mobile_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations',
            [
                'primary_menu' => $main_menu->term_id,
                'mobile_menu'  => $mobile_menu->term_id,
            ]
        );

        $template = get_posts( [
            'post_type'      => 'elementor_library',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'title'          => 'Noxfolio Default Kit',
        ] );

        if ( $template ) {
            update_option( 'elementor_active_kit', $template[0]->ID );
        }

        // Update Elementor Options
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );
        update_option( 'elementor_experiment-container', 'active' );
        update_option( 'elementor_experiment-nested-elements', 'active' );
        update_option( 'elementor_experiment-additional_custom_breakpoints', 'active' );

        $front_page = get_posts( [
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'title'          => 'Home One',
        ] );

        $blog_page = get_posts( [
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'title'          => 'Blog',
        ] );

        update_option( 'show_on_front', 'page' );
        if ( $front_page ) {
            update_option( 'page_on_front', $front_page[0]->ID );
        }
        if ( $blog_page ) {
            update_option( 'page_for_posts', $blog_page[0]->ID );
        }
    }

    /**
     * Register Plugins
     */
    public function register_plugins( $plugins ) {
        $theme_plugins = [
            [
                'name'        => esc_html__( 'Elementor Website Builder', 'noxfolio-toolkit' ),
                'slug'        => 'elementor',
                'required'    => true,
                'preselected' => true,
            ],
            [
                'name'        => esc_html__( 'Noxfolio Toolkit', 'noxfolio-toolkit' ),
                'slug'        => 'noxfolio-toolkit',
                'source'      => get_template_directory() . '/inc/plugins/noxfolio-toolkit.zip',
                'required'    => true,
                'version'     => '1.0.6',
                'preselected' => true,
            ],
            [
                'name'        => esc_html__( 'MetForm', 'noxfolio-toolkit' ),
                'slug'        => 'metform',
                'required'    => true,
                'preselected' => true,
            ],
        ];

        return array_merge( $plugins, $theme_plugins );
    }
}

Noxfolio_Demo_Config::instance()->initialize();
