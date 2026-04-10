<?php
namespace NoxfolioToolkit\Helper;

use NoxfolioTheme\Classes\Noxfolio_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Noxfolio Maintenance
 */
class Noxfolio_Maintenance {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'template_redirect', [$this, 'maintenance_mode'] );
        add_action( 'admin_bar_menu', [$this, 'admin_bar_maintenance'], 99 );
    }

    /**
     * Maintenance Mode
     *
     * @return void
     */
    public function maintenance_mode() {
        global $wp_query, $post;

        $maintenance_mode = Noxfolio_Helper::get_option( 'maintenance_mode', 'disabled' );
        $maintenance_page = Noxfolio_Helper::get_option( 'maintenance_page', '' );

        if ( 'enabled' !== $maintenance_mode ) {
            return;
        }

        if (  ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
            if ( isset( $maintenance_page ) ) {
                $wp_query->is_page      = true;
                $wp_query->is_single    = false;
                $wp_query->is_home      = false;
                $wp_query->is_singular  = false;
                $wp_query->is_category  = false;
                $wp_query->is_404       = false;
                $wp_query->post_count   = 0;
                $wp_query->current_post = -1;

                if ( '' !== $maintenance_page ) {
                    $post = get_post( $maintenance_page );

                    $wp_query->post_count   = 1;
                    $wp_query->current_post = -1;
                    $wp_query->posts        = [$post];

                    $wp_query->queried_object    = $post;
                    $wp_query->queried_object_id = $maintenance_page;
                } else {
                    $wp_query->posts = [];
                    include get_template_directory() . '/maintenance.php';
                    exit();
                }
            }

        }
    }

    /**
     * Add Nav to admin bar
     *
     * @return void
     */
    public function admin_bar_maintenance( $admin_bar ) {
        $maintenance_mode = Noxfolio_Helper::get_option( 'maintenance_mode', 'disabled' );
        $maintenance_page = Noxfolio_Helper::get_option( 'maintenance_page', '' );

        if ( 'enabled' !== $maintenance_mode ) {
            return;
        }

        $admin_bar->add_menu( [
            'id'    => 'noxfolio-maintenance-item',
            'title' => __( 'Maintenance Mode is ON', 'noxfolio-toolkit' ),
            'href'  => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_options#tab=maintenance-mode' ),
            'meta'  => [
                'title'  => __( 'Maintenance Mode is ON', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );

        if ( '' !== $maintenance_page ) {
            $admin_bar->add_menu( [
                'id'     => 'noxfolio-maintenance-sub-item',
                'parent' => 'noxfolio-maintenance-item',
                'title'  => __( 'View Maintenance Page', 'noxfolio-toolkit' ),
                'href'   => get_post_permalink( $maintenance_page ),
                'meta'   => [
                    'title'  => __( 'View Maintenance Page', 'noxfolio-toolkit' ),
                    'target' => '_blank',
                ],
            ] );
        }

        $admin_bar->add_menu( [
            'id'     => 'noxfolio-maintenance-sub-item',
            'parent' => 'noxfolio-maintenance-item',
            'title'  => __( 'View Maintenance Settings', 'noxfolio-toolkit' ),
            'href'   => get_site_url( null, 'wp-admin/admin.php?page=noxfolio_options#tab=maintenance-mode' ),
            'meta'   => [
                'title'  => __( 'View Maintenance Settings', 'noxfolio-toolkit' ),
                'target' => '_self',
            ],
        ] );
    }
}

Noxfolio_Maintenance::instance()->initialize();