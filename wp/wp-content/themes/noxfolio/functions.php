<?php
/**
 * Noxfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Noxfolio
 */

/**
 * Define constant
 */
$theme   = wp_get_theme();
$name    = $theme->parent() === false ? wp_get_theme()->get( 'Name' ) : wp_get_theme()->parent()->get( 'Name' );
$version = $theme->parent() === false ? wp_get_theme()->get( 'Version' ) : wp_get_theme()->parent()->get( 'Version' );

define( 'NOXFOLIO_NAME', $name );
define( 'NOXFOLIO_VERSION', $version );
define( 'NOXFOLIO_PATH', untrailingslashit( get_template_directory() ) );
define( 'NOXFOLIO_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'NOXFOLIO_ASSETS', untrailingslashit( get_template_directory_uri() ) . '/assets' );
define( 'NOXFOLIO_VENDOR', untrailingslashit( get_template_directory_uri() ) . '/assets/vendor' );
define( 'NOXFOLIO_INCLUDES', NOXFOLIO_PATH . '/includes' );
define( 'NOXFOLIO_CLASSES', NOXFOLIO_PATH . '/includes/classes' );
define( 'NOXFOLIO_ADMIN', NOXFOLIO_PATH . '/includes/admin' );

/**
 * Load theme files
 */
require_once NOXFOLIO_CLASSES . '/class-setup.php';
require_once NOXFOLIO_CLASSES . '/class-helper.php';
require_once NOXFOLIO_CLASSES . '/class-assets.php';
require_once NOXFOLIO_CLASSES . '/class-post-helper.php';
require_once NOXFOLIO_CLASSES . '/class-comment-walker.php';
require_once NOXFOLIO_ADMIN . '/class-admin-panel.php';
require_once NOXFOLIO_INCLUDES . '/library/class-tgm-plugin-activation.php';
require_once NOXFOLIO_INCLUDES . '/library/required-plugin.php';
