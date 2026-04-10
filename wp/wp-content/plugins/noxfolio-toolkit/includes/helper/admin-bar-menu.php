<?php
namespace NoxfolioToolkit\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * noxfolio Admin Bar Menu
 */
class Noxfolio_Admin_Bar_Menu {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'admin_bar_menu', [$this, 'add_admin_bar_menu'], 99 );
    }

    /**
     * Add Nav to admin bar
     *
     * @return void
     */
    public function add_admin_bar_menu( $admin_bar ) {
        $admin_bar->add_menu( [
            'id'    => 'noxfolio-menu-item',
            'title' => __( 'Noxfolio', 'noxfolio-toolkit' ),
            'href'  => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_dashboard' ),
            'meta'  => [
                'title'  => __( 'Noxfolio', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );

        $admin_bar->add_menu( [
            'parent' => 'noxfolio-menu-item',
            'id'     => 'noxfolio-welcome',
            'title'  => __( 'Welcome', 'noxfolio-toolkit' ),
            'href'   => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_dashboard' ),
            'meta'   => [
                'title'  => __( 'Welcome', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );

        $admin_bar->add_menu( [
            'parent' => 'noxfolio-menu-item',
            'id'     => 'noxfolio-theme-option',
            'title'  => __( 'Theme Options', 'noxfolio-toolkit' ),
            'href'   => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_options' ),
            'meta'   => [
                'title'  => __( 'Theme Options', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );

        $admin_bar->add_menu( [
            'parent' => 'noxfolio-menu-item',
			'id'     => 'noxfolio-help-center',
            'title'  => __( 'Help Center', 'noxfolio-toolkit' ),
            'href'   => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_help_center' ),
            'meta'   => [
                'title'  => __( 'Help Center', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );
    }
}

Noxfolio_Admin_Bar_Menu::instance()->initialize();