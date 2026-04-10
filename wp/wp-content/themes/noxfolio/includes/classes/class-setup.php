<?php

namespace NoxfolioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Initial setup for this theme
 */
class Noxfolio_Setup
{

	protected static $instance = null;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function initialize()
	{
		add_action('after_setup_theme', [$this, 'setup_theme']);
		add_action('widgets_init', [$this, 'register_theme_sidebar']);
		add_action('init', [$this, 'register_theme_menu']);
		add_filter('walker_nav_menu_start_el', [$this, 'add_submenu_toggler_icon'], 10, 4);
		add_filter('body_class', [$this, 'body_classes']);
		add_action('after_switch_theme', [$this, 'default_elementor_option']);
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function setup_theme()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on noxfolio, use a find and replace
		 * to change 'noxfolio' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('noxfolio', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		/**
		 * Register image sizes.
		 */
		add_image_size('noxfolio_850x520', 850, 520, true);
		add_image_size('noxfolio_1290x620', 1290, 620, true);
		add_image_size('noxfolio_420x420', 420, 420, true);

		/**
		 * Add theme support for selective refresh for widgets.
		 *
		 * WordPress 4.5 includes a new Customizer framework called selective refresh
		 *
		 * Selective refresh is a hybrid preview mechanism that has the performance benefit of not having to refresh the entire preview window.
		 *
		 * @link https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/
		 */
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Some blocks such as the image block have the possibility to define
		 * a “wide” or “full” alignment by adding the corresponding classname
		 * to the block’s wrapper ( alignwide or alignfull ). A theme can opt-in for this feature by calling
		 * add_theme_support( 'align-wide' ), like we have done below.
		 *
		 * @see Wide Alignment
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
		 */
		add_theme_support('align-wide');

		/**
		 * Set the maximum allowed width for any content in the theme,
		 * like oEmbeds and images added to posts
		 *
		 * @see Content Width
		 * @link https://codex.wordpress.org/Content_Width
		 */
		global $content_width;

		if (! isset($content_width)) {
			if ('no-sidebar' === Noxfolio_Helper::content_sidebar()) {
				$content_width = 1290;
			} else {
				$content_width = 850;
			}
		}

		// Remove support widget block Editor
		remove_theme_support('widgets-block-editor');
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function register_theme_sidebar()
	{
		register_sidebar(
			[
				'name'          => esc_html__('Primary Sidebar', 'noxfolio'),
				'id'            => 'primary_sidebar',
				'description'   => esc_html__('Add widgets here.', 'noxfolio'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			]
		);

		register_sidebar(
			[
				'name'          => esc_html__('Footer Widgets', 'noxfolio'),
				'id'            => 'footer_widgets',
				'description'   => esc_html__('Add widgets here.', 'noxfolio'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			]
		);
	}

	/**
	 * Register Nav Menus
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	public function register_theme_menu()
	{
		register_nav_menus([
			'primary_menu' => esc_html__('Primary Menu', 'noxfolio'),
			'mobile_menu'  => esc_html__('Mobile Menu', 'noxfolio'),
		]);
	}

	/**
	 * Add Submenu Icon
	 */
	public function add_submenu_toggler_icon($item_output, $item, $depth, $args)
	{
		if ('primary-menu' === $args->menu_class) {
			if (in_array('menu-item-has-children', $item->classes)) {
				$item_output = preg_replace('/(<a.*?>[^<]*?)(<\/a>)/', '$1<span class="submenu-toggler"><i class="far fa-angle-down"></i></span>$2', $item_output);
			}
		}

		return $item_output;
	}

	/**
	 * Body Classes
	 */
	public function body_classes($classes)
	{
		if ('boxed' === Noxfolio_Helper::site_layout()) {
			$classes[] = 'noxfolio-boxed-layout';
		}

		if (!empty(Noxfolio_Helper::get_meta('noxfolio_page_meta', 'body_class'))) {
			$classes[] = Noxfolio_Helper::get_meta('noxfolio_page_meta', 'body_class');
		}

		if (Noxfolio_helper::get_option('site_border', false)) {
			$classes[] = 'noxfolio-site-border';
		}

		return $classes;
	}

	/**
	 * Update Elementor Option
	 *
	 * @return void
	 */
	public function default_elementor_option()
	{
		update_option('elementor_disable_color_schemes', 'yes');
		update_option('elementor_disable_typography_schemes', 'yes');
		update_option('elementor_experiment-e_font_icon_svg', 'inactive');
		update_option('elementor_experiment-container', 'active');
		update_option('elementor_experiment-nested-elements', 'active');
		update_option('elementor_experiment-additional_custom_breakpoints', 'active');
	}
}

/**
 * Run Theme
 */
Noxfolio_Setup::instance()->initialize();
