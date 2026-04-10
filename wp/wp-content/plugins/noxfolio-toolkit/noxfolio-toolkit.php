<?php

/**
 * Plugin Name: Noxfolio Toolkit
 * Description: A Helper plugin for all Noxfolio Wordpress Themes
 * Plugin URI: #
 * Author: Webtend
 * Author URI: http://webtend.net/
 * Version: 1.0.8
 * Text Domain: noxfolio-toolkit
 * License: GPL2 or later
 * License URI: http://www.gnu.org/licences/gpl-2.0.html
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * The Main Plugin class
 */
final class Noxfolio_Toolkit
{

    /**
     * Addon Version
     *
     * @since 1.0.0
     * @var string The Plugin version.
     */
    const version = '1.0.7';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the Plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Class Constructor
     */
    private function __construct()
    {
        $this->define_constants();

        add_action('plugin_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Noxfolio_Toolkit
     */
    public static function init()
    {
        static $instance = false;

        if (! $instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('NT_VERSION', self::version);
        define('NT_FILE', __FILE__);
        define('NT_PATH', plugin_dir_path(NT_FILE));
        define('NT_URL', plugin_dir_url(NT_FILE));
        define('NT_ASSETS', untrailingslashit(NT_URL . 'assets'));
        define('NT_INCLUDES', untrailingslashit(NT_PATH . 'includes'));
        define('NT_VENDOR', untrailingslashit(NT_URL . 'assets/vendor'));
        define('RT_ELEMENTOR', untrailingslashit(NT_INCLUDES . '/elementor'));
        define('NT_WP_WIDGETS', untrailingslashit(NT_PATH . 'includes/wp-widgets'));
        define('NT_THEME_ASSETS', untrailingslashit(get_template_directory_uri()) . '/assets');
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {
        load_plugin_textdomain('noxfolio-toolkit', false, plugin_basename(dirname(__FILE__)) . '/languages');
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {
        if ($this->is_compatible()) {
            $this->include_files();
        }
    }

    /**
     * Get current theme slug
     *
     * @access public
     * @static
     */
    public static function get_theme_slug()
    {
        return str_replace('-child', '', wp_get_theme()->get('TextDomain'));
    }

    /**
     * Check Compatible
     *
     * @access public
     * @static
     *
     * @return boolean
     */
    public static function theme_is_compatible()
    {
        $plugin_name = trim(dirname(plugin_basename(__FILE__)));
        $theme_name  = self::get_theme_slug();

        return false !== stripos($plugin_name, $theme_name);
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible()
    {
        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        // Check For 'noxfolio-toolkit' Theme install or active
        if (! self::theme_is_compatible()) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_theme']);
            return false;
        }

        return true;
    }

    public function is_active_elementor()
    {
        if (! did_action('elementor/loaded')) {
            return false;
        }

        return true;
    }

    /**
     * Include required plugin files
     *
     * @return void
     */
    public function include_files()
    {
        include_once NT_INCLUDES . '/library/codestar-framework/codestar-framework.php';
        include_once NT_INCLUDES . '/helper/functions.php';
        include_once NT_INCLUDES . '/helper/class-assets.php';

        include_once NT_INCLUDES . '/helper/admin-bar-menu.php';
        include_once NT_INCLUDES . '/helper/theme-options.php';
        include_once NT_INCLUDES . '/helper/metaboxes.php';
        include_once NT_INCLUDES . '/helper/maintenance.php';

        if ($this->is_active_elementor()) {
            include_once NT_INCLUDES . '/elementor/init.php';
            include_once NT_INCLUDES . '/template-builder/template-builder.php';
        }

        include_once NT_WP_WIDGETS . '/recent-post.php';
        include_once NT_WP_WIDGETS . '/call-to-action.php';

        include_once NT_INCLUDES . '/post-type/portfolio/class-portfolio.php';

        include_once NT_INCLUDES . '/demo-config/demo-config.php';
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'noxfolio-toolkit'),
            '<strong>' . esc_html__('Noxfolio Toolkit', 'noxfolio-toolkit') . '</strong>',
            '<strong>' . esc_html__('PHP', 'noxfolio-toolkit') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Noxfolio theme installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_theme()
    {

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            esc_html__('"%1$s" plugin requires Noxfolio theme to be installed and activated', 'noxfolio-toolkit'),
            '<strong>' . esc_html__('Noxfolio Toolkit', 'noxfolio-toolkit') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

/**
 * Initializes the main plugin
 *
 * @return void
 */
function noxfolio_toolkit_loading()
{
    return Noxfolio_Toolkit::init();
}

// kick-off the plugin
noxfolio_toolkit_loading();
