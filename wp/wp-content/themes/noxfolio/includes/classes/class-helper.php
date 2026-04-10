<?php

namespace NoxfolioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Initial Helper functions for this theme.
 */
class Noxfolio_Helper
{

	/**
	 * Get Theme options
	 *
	 * @param  string  $option  option ID
	 * @param  mixed|null  $default
	 *
	 * @return mixed|null
	 */
	public static function get_option($option, $default = null)
	{
		$options = get_option('noxfolio_options');

		return (isset($options[$option])) ? $options[$option] : $default;
	}

	/**
	 * Get a meta options
	 *
	 * @param  string  $prefix_key  meta unique slug
	 * @param  string  $meta_key  meta slug
	 * @param  mixed|null  $default  set a default value
	 * @param  int  $id  post id
	 *
	 * @return mixed|null
	 */
	public static function get_meta($prefix_key, $meta_key, $default = null, $id = '')
	{
		if (! $id) {
			$id = get_the_ID();
		}

		$meta_boxes = get_post_meta($id, $prefix_key, true);

		return (isset($meta_boxes[$meta_key])) ? $meta_boxes[$meta_key] : $default;
	}

	/**
	 * Check if this Page created with elementor
	 *
	 * @return boolean
	 */
	public static function is_elementor_page()
	{
		global $post;
		$is_elementor = false;

		if (\class_exists('\Elementor\Plugin')) {
			$is_elementor = \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor();
		}

		return $is_elementor;
	}

	/**
	 * Get content layout
	 *
	 * @return string
	 */
	public static function site_layout()
	{
		$layout = self::get_option('site_layout', 'full-width');

		if (is_page()) {
			$page_layout = self::get_meta('noxfolio_page_meta', 'site_layout', 'default');

			if ('default' !== $page_layout) {
				$layout = $page_layout;
			}
		} elseif (is_single() && 'noxfolio_portfolio' === get_post_type()) {
			$portfolio_layout = self::get_meta('noxfolio_portfolio_meta', 'portfolio_details_layout', 'default');

			if ('default' !== $portfolio_layout) {
				$layout = $portfolio_layout;
			}
		} elseif (is_single() && 'product' === get_post_type()) {
			$product_layout = self::get_meta('noxfolio_product_meta', 'product_details_layout', 'default');

			if ('default' !== $product_layout) {
				$layout = $product_layout;
			}
		} elseif (is_single() && 'post' === get_post_type()) {
			$post_layout = self::get_meta('noxfolio_post_meta', 'post_details_layout', 'default');

			if ('default' !== $post_layout) {
				$layout = $post_layout;
			}
		}

		return $layout;
	}

	/**
	 * Get Content Sidebar
	 *
	 * @return string
	 */
	public static function content_sidebar()
	{
		$sidebar = 'right-sidebar';

		if (is_page()) {
			$sidebar = 'no-sidebar';
		} elseif (is_single() && 'post' === get_post_type()) {
			$sidebar      = self::get_option('blog_details_sidebar', 'right-sidebar');
			$post_sidebar = self::get_meta('noxfolio_post_meta', 'post_details_sidebar', 'default');

			if ('default' !== $post_sidebar) {
				$sidebar = $post_sidebar;
			}
		} elseif (! is_page()) {
			$sidebar = self::get_option('blog_archive_sidebar', 'right-sidebar');
		}

		if (! is_active_sidebar('primary_sidebar')) {
			$sidebar = 'no-sidebar';
		}

		return $sidebar;
	}

	/**
	 * Get container classes
	 * @return void
	 */
	public static function container()
	{
		$classes = ['container'];

		if (is_page()) {
			if (self::is_elementor_page()) {
				$classes[] = 'container-elementor';
			} else {
				$classes[] = 'container-gap';
			}
		} elseif (is_single() && 'noxfolio_portfolio' == get_post_type()) {
			if (self::is_elementor_page()) {
				$classes[] = 'container-elementor';
			} else {
				$classes[] = 'container-gap';
			}
		} elseif (is_archive() && 'noxfolio_portfolio' == get_post_type()) {
			$classes[] = 'container-gap no-sidebar';
		} elseif ((is_archive() || is_single()) && 'product' == get_post_type()) {
			$classes[] = 'container-gap no-sidebar';
		} else {
			$classes[] = 'container-gap';

			if ('left-sidebar' === self::content_sidebar()) {
				$classes[] = 'have-sidebar left-sidebar';
			} elseif ('right-sidebar' === self::content_sidebar()) {
				$classes[] = 'have-sidebar right-sidebar';
			} elseif ('no-sidebar' === self::content_sidebar()) {
				$classes[] = 'no-sidebar';
			}
		}

		echo esc_attr(implode(' ', $classes));
	}

	/**
	 * Check Default header
	 *
	 * @return string
	 */
	public static function check_default_header()
	{
		$default_header = self::get_option('default_header', 'enabled');

		if (is_page()) {
			$page_default_header = self::get_meta('noxfolio_page_meta', 'page_default_header', 'default');

			if ('default' !== $page_default_header) {
				$default_header = $page_default_header;
			}
		} elseif (is_single() && 'noxfolio_portfolio' === get_post_type()) {
			$portfolio_default_header = self::get_meta('noxfolio_portfolio_meta', 'portfolio_default_header', 'default');

			if ('default' !== $portfolio_default_header) {
				$default_header = $portfolio_default_header;
			}
		} elseif (is_single() && 'product' === get_post_type()) {
			$product_default_header = self::get_meta('noxfolio_product_meta', 'product_default_header', 'default');

			if ('default' !== $product_default_header) {
				$default_header = $product_default_header;
			}
		} elseif (is_single() && 'post' === get_post_type()) {
			$post_default_header = self::get_meta('noxfolio_post_meta', 'post_default_header', 'default');

			if ('default' !== $post_default_header) {
				$default_header = $post_default_header;
			}
		}

		return $default_header;
	}

	/**
	 * Check Default Footer
	 *
	 * @return string
	 */
	public static function check_default_footer()
	{
		$default_footer = self::get_option('default_footer', 'enabled');

		if (is_page()) {
			$page_default_footer = self::get_meta('noxfolio_page_meta', 'page_default_footer', 'default');

			if ('default' !== $page_default_footer) {
				$default_footer = $page_default_footer;
			}
		} elseif (is_single() && 'noxfolio_portfolio' === get_post_type()) {
			$portfolio_default_footer = self::get_meta('noxfolio_portfolio_meta', 'portfolio_default_footer', 'default');

			if ('default' !== $portfolio_default_footer) {
				$default_footer = $portfolio_default_footer;
			}
		} elseif (is_single() && 'product' === get_post_type()) {
			$product_default_footer = self::get_meta('noxfolio_product_meta', 'product_default_footer', 'default');

			if ('default' !== $product_default_footer) {
				$default_footer = $product_default_footer;
			}
		} elseif (is_single() && 'post' === get_post_type()) {
			$post_default_footer = self::get_meta('noxfolio_post_meta', 'post_default_footer', 'default');

			if ('default' !== $post_default_footer) {
				$default_footer = $post_default_footer;
			}
		}

		return $default_footer;
	}

	/**
	 * Set Theme Default Colors
	 *
	 * @return array
	 */
	public static function get_default_colors()
	{
		$colors = [];

		$primary_color    = self::get_option('primary_color', '#c9f31d');
		$secondary_color  = self::get_option('secondary_color', '#1f1f1f');
		$body_color       = self::get_option('body_color', '#b1b1b1');
		$headline_color   = self::get_option('headline_color', '#ffffff');
		$border_color     = self::get_option('border_color', '#353535');
		$dark_color       = self::get_option('dark_color', '#070707');
		$dark_light_color = self::get_option('dark_light_color', '#131313');
		$white_color      = self::get_option('white_color', '#ffffff');

		$colors['noxfolio_primary'] = [
			'slug'  => 'noxfolio-primary-color',
			'title' => esc_html__('Noxfolio Primary Color', 'noxfolio'),
			'value' => ! empty($primary_color) ? $primary_color : '#c9f31d',
		];

		$colors['noxfolio_secondary'] = [
			'slug'  => 'noxfolio-secondary-color',
			'title' => esc_html__('Noxfolio Secondary Color', 'noxfolio'),
			'value' => ! empty($secondary_color) ? $secondary_color : '#1f1f1f',
		];

		$colors['noxfolio_body'] = [
			'slug'  => 'noxfolio-body-color',
			'title' => esc_html__('Noxfolio Body Color', 'noxfolio'),
			'value' => ! empty($body_color) ? $body_color : '#b1b1b1;',
		];

		$colors['noxfolio_headline'] = [
			'slug'  => 'noxfolio-headline-color',
			'title' => esc_html__('Noxfolio Headline Color', 'noxfolio'),
			'value' => ! empty($headline_color) ? $headline_color : '#ffffff',
		];

		$colors['noxfolio_border'] = [
			'slug'  => 'noxfolio-border-color',
			'title' => esc_html__('Noxfolio Border Color', 'noxfolio'),
			'value' => ! empty($border_color) ? $border_color : '#353535;',
		];

		$colors['noxfolio_dark'] = [
			'slug'  => 'noxfolio-dark-color',
			'title' => esc_html__('Noxfolio Dark Color', 'noxfolio'),
			'value' => ! empty($dark_color) ? $dark_color : '#070707',
		];

		$colors['noxfolio_dark_light'] = [
			'slug'  => 'noxfolio-dark-light-color',
			'title' => esc_html__('Noxfolio Dark-Light Color', 'noxfolio'),
			'value' => ! empty($dark_light_color) ? $dark_light_color : '#131313',
		];

		$colors['noxfolio_white'] = [
			'slug'  => 'noxfolio-white-color',
			'title' => esc_html__('Noxfolio White Color', 'noxfolio'),
			'value' => ! empty($white_color) ? $white_color : '#ffffff',
		];

		return $colors;
	}

	/**
	 * Get theme Global Color
	 *
	 * @return array
	 */
	public static function get_global_colors()
	{
		$colors = self::get_default_colors();

		// Add Custom Global Color
		$custom_colors = self::get_option('custom_global_color', []);
		if (is_array($custom_colors) && ! empty($custom_colors)) {
			foreach ($custom_colors as $index => $custom_color) {
				if ($custom_color['color_value']) {
					$color_index = $index + 1;
					$color_slug  = 'noxfolio_custom_color_' . $color_index;

					$colors[$color_slug] = [
						'slug'  => 'noxfolio-custom-color-' . $color_index,
						'title' => esc_html($custom_color['color_title']),
						'value' => $custom_color['color_value'],
					];
				}
			}
		}

		return $colors;
	}

	/**
	 * Theme Page Font
	 */
	public static function get_page_fonts()
	{

		$fonts = [];

		$is_enabled_page_typo   = self::get_meta('noxfolio_page_meta', 'custom_typo_type', 'default-font');

		if ('custom-font' !== $is_enabled_page_typo) {
			return $fonts;
		}

		$fonts = [
			'_primary'   => [
				'slug'               => 'noxfolio-primary-font',
				'font-family'        => 'Inter',
				'backup-font-family' => 'sans-serif'
			],
			'_secondary' => [
				'slug'               => 'noxfolio-secondary-font',
				'font-family'        => 'Hanken Grotesk',
				'backup-font-family' => 'sans-serif'
			],
		];

		$primary_font   = self::get_meta('noxfolio_page_meta', 'primary_font', []);
		$secondary_font = self::get_meta('noxfolio_page_meta', 'secondary_font', []);

		// Update Primary Font
		if (! empty($primary_font['font-family'])) {
			$fonts['_primary']['font-family'] = $primary_font['font-family'];

			if (! empty($primary_font['backup-font-family'])) {
				$fonts['_primary']['backup-font-family'] = $primary_font['backup-font-family'];
			}
		}

		// Update Secondary Font
		if (! empty($secondary_font['font-family'])) {
			$fonts['_secondary']['font-family'] = $secondary_font['font-family'];

			if (! empty($secondary_font['backup-font-family'])) {
				$fonts['_secondary']['backup-font-family'] = $secondary_font['backup-font-family'];
			}
		}

		return $fonts;
	}

	/**
	 * Get Elementor content for display
	 *
	 * @param  int  $content_id
	 */
	public static function get_elementor_content($content_id)
	{
		$content = '';
		if (\class_exists('\Elementor\Plugin')) {
			$elementor_instance = \Elementor\Plugin::instance();
			$content            = $elementor_instance->frontend->get_builder_content_for_display($content_id);
		}

		return $content;
	}

	/**
	 * Render SVG Icon
	 *
	 * @param  string  $name  icon name
	 *
	 * @return false|string
	 */
	public static function render_svg_icon($name)
	{
		$icon_path = NOXFOLIO_PATH . "/assets/svg/{$name}.svg";

		if (! file_exists($icon_path)) {
			return false;
		}

		ob_start();

		include $icon_path;

		return ob_get_clean();
	}

	/**
	 * Back to Top
	 *
	 * @return string
	 */
	public static function site_back_to_top()
	{
		$back_to_top = self::get_option('back_to_top', 'enabled');

		if (is_page()) {
			$back_to_top_page = self::get_meta('noxfolio_page_meta', 'back_to_top_page', 'default');

			if ('default' !== $back_to_top_page) {
				$back_to_top = $back_to_top_page;
			}
		}

		return $back_to_top;
	}

	/**
	 * Check Page Grid Line
	 */
	public static function site_grid_line()
	{
		$site_grid_lone = self::get_option('site_grid_line', 'enabled');

		if (is_page()) {
			$page_grid_line = self::get_meta('noxfolio_page_meta', 'page_grid_line', 'default');

			if ('default' !== $page_grid_line) {
				$site_grid_lone = $page_grid_line;
			}
		}

		return $site_grid_lone;
	}
}
