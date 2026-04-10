<?php

namespace NoxfolioToolkit\Helper;

use NoxfolioTheme\Admin\Admin_Panel;
use NoxfolioTheme\Classes\Noxfolio_Helper;
use CSF;

defined('ABSPATH') || exit;

/**
 * Noxfolio Toolkit Helper
 */
class Noxfolio_Theme_Options
{
	protected static $instance = null;

	private $options_prefix = 'noxfolio_options';
	private $menu_slug = 'noxfolio_options';
	private $template_builder_url;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function initialize()
	{
		if (! class_exists('CSF')) {
			return;
		}

		$this->template_builder_url = admin_url('edit.php?post_type=noxfolio_template');

		$this->theme_options();
		$this->general_section();
		$this->header_section();
		$this->footer_section();
		$this->page_title_section();
		$this->blog_section();
		$this->portfolio_section();
		$this->color_scheme_section();
		$this->typography_section();
		$this->error_section();
		$this->maintenance_section();
		$this->custom_scrips_section();
		$this->backup_section();

		add_filter('csf_color_palette', [$this, 'custom_color_palette']);
		add_filter('csf_options_before', [$this, 'add_dashboard_banner']);
	}

	/**
	 * Create Theme Option
	 */
	public function theme_options()
	{
		CSF::createOptions($this->options_prefix, [
			'menu_title'         => esc_html__('Theme Options', 'noxfolio-toolkit'),
			'menu_slug'          => $this->menu_slug,
			'framework_title'    => esc_html__('Theme Options', 'noxfolio-toolkit'),
			'show_in_customizer' => true,
			'menu_type'          => 'submenu',
			'menu_parent'        => 'noxfolio_dashboard',
			'show_bar_menu'      => false,
		]);
	}

	/**
	 * General Option
	 */
	public function general_section()
	{
		CSF::createSection($this->options_prefix, [
			'id'    => 'general_options',
			'title' => esc_html__('General', 'noxfolio-toolkit'),
		]);

		/**
		 * Site Layout
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'general_options',
			'title'  => esc_html__('Layout', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Layout', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'site_layout',
					'type'     => 'select',
					'title'    => esc_html__('Layout', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Set the website layout.', 'noxfolio-toolkit'),
					'options'  => [
						'full-width' => esc_html__('Full Width', 'noxfolio-toolkit'),
						'boxed'      => esc_html__('Boxed', 'noxfolio-toolkit'),
					],
					'default'  => 'full-width',
				],
				[
					'id'         => 'boxed_width',
					'type'       => 'dimensions',
					'title'      => esc_html__('Boxed Container Width.', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Set the boxed outer container width.', 'noxfolio-toolkit'),
					'default'    => [
						'width' => '1530',
						'unit'  => 'px',
					],
					'height'     => false,
					'units'      => ['px'],
					'dependency' => ['site_layout', '==', 'boxed'],
				],
				[
					'id'         => 'boxed_container_color',
					'type'       => 'background',
					'title'      => esc_html__('Boxed Background Color', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Set the boxed inner container background color.', 'noxfolio-toolkit'),
					'output'     => '.noxfolio-boxed-layout .noxfolio-body-content',
					'dependency' => ['site_layout', '==', 'boxed'],
				],
				[
					'id'       => 'body_bg',
					'type'     => 'background',
					'title'    => esc_html__('Body Background', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Set the <body> background.', 'noxfolio-toolkit'),
					'output'   => 'body',
				],
				[
					'id'       => 'container_width',
					'type'     => 'dimensions',
					'title'    => esc_html__('Container Width.', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Set the container maximum width.', 'noxfolio-toolkit'),
					'default'  => [
						'width' => '1320',
						'unit'  => 'px',
					],
					'height'   => false,
					'units'    => ['px'],
				],
				[
					'id'       => 'site_border',
					'type'     => 'switcher',
					'title'    => esc_html__('Site Border', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Set a colored border around the website.', 'noxfolio-toolkit'),
					'default'  => false,
				],
				[
					'id'          => 'site_border_color',
					'type'        => 'color',
					'title'       => esc_html__('Site Border Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Set the site border color.', 'noxfolio-toolkit'),
					'output'      => '.noxfolio-site-border .noxfolio-body-content',
					'output_mode' => 'border-color',
					'dependency'  => ['site_border', '==', true],
				],
				[
					'id'          => 'site_border_width',
					'type'        => 'number',
					'title'       => esc_html__('Site Border Width.', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Set the site border width.', 'noxfolio-toolkit'),
					'unit'        => 'px',
					'output'      => '.noxfolio-site-border .noxfolio-body-content',
					'output_mode' => 'border-width',
					'dependency'  => ['site_border', '==', true],
				],
			],
		]);

		/**
		 * Preloader
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'general_options',
			'title'  => esc_html__('Preloader', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Preloader', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'site_preloader',
					'type'     => 'button_set',
					'title'    => esc_html__('Site Preloader', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable site Preloader', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enabled', 'noxfolio-toolkit'),
						'Disabled' => esc_html__('Disabled', 'noxfolio-toolkit'),
					],
					'default'  => 'enabled',
				],
				[
					'id'         => 'preloader_text',
					'type'       => 'text',
					'title'      => esc_html__('Preloader Text', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Site Preloader Main Text', 'noxfolio-toolkit'),
					'default'    => esc_html__('Noxfolio', 'noxfolio-toolkit'),
					'dependency' => ['site_preloader', '==', 'enabled'],
				],
				[
					'id'         => 'preloader_loading_text',
					'type'       => 'text',
					'title'      => esc_html__('Loading Text', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Site Preloader small Text', 'noxfolio-toolkit'),
					'default'    => esc_html__('Loading', 'noxfolio-toolkit'),
					'dependency' => ['site_preloader', '==', 'enabled'],
				],
				[
					'type'       => 'subheading',
					'content'    => esc_html__('Preloader Styling', 'noxfolio-toolkit'),
					'dependency' => ['site_preloader', '==', 'enabled'],
				],
				[
					'id'          => 'preloader_background',
					'type'        => 'color',
					'title'       => esc_html__('Background Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Preloader background color', 'noxfolio-toolkit'),
					'output'      => '.site-preloader .preloader-layer .overly',
					'output_mode' => 'background-color',
					'dependency'  => ['site_preloader', '==', 'enabled'],
				],
				[
					'id'          => 'preloader_text_color',
					'type'        => 'color',
					'title'       => esc_html__('Text Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Preloader text colors', 'noxfolio-toolkit'),
					'output'      => '.site-preloader .animation-preloader .loading-text, .site-preloader .animation-preloader .text-loading .letters-loading::before',
					'output_mode' => 'color',
					'dependency'  => ['site_preloader', '==', 'enabled'],
				],
				[
					'id'          => 'spinner_base_color',
					'type'        => 'color',
					'title'       => esc_html__('Spinner Base Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Preloader spinner base color', 'noxfolio-toolkit'),
					'output'      => '.site-preloader .animation-preloader .spinner',
					'output_mode' => 'border-color',
					'dependency'  => ['site_preloader', '==', 'enabled'],
				],
				[
					'id'          => 'spinner_line_color',
					'type'        => 'color',
					'title'       => esc_html__('Spinner Line Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Preloader spinner line color', 'noxfolio-toolkit'),
					'output'      => '.site-preloader .animation-preloader .spinner',
					'output_mode' => 'border-top-color',
					'dependency'  => ['site_preloader', '==', 'enabled'],
				],
			],
		]);

		/**
		 * Back to Top
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'general_options',
			'title'  => esc_html__('Back to Top', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Back to Top', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'back_to_top',
					'type'     => 'button_set',
					'title'    => esc_html__('Back to Top', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Add a back to top button on bottom right corner.', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'enabled',
				],
				[
					'id'         => 'back_to_top_mobile',
					'type'       => 'switcher',
					'title'      => esc_html__('Show on Mobile', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Show the back to top button on mobile devices..', 'noxfolio-toolkit'),
					'default'    => true,
					'dependency' => ['back_to_top', '==', 'enabled'],
				],
				[
					'id'          => 'back_to_top_color',
					'type'        => 'color',
					'title'       => esc_html__('Icon Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Back to Top icon color', 'noxfolio-toolkit'),
					'output'      => '.back-to-top',
					'output_mode' => 'color',
					'dependency'  => ['back_to_top', '==', 'enabled'],
				],
				[
					'id'          => 'back_to_top_bg',
					'type'        => 'color',
					'title'       => esc_html__('Background', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Back to Top icon background color', 'noxfolio-toolkit'),
					'output'      => '.back-to-top',
					'output_mode' => 'background-color',
					'dependency'  => ['back_to_top', '==', 'enabled'],
				],
				[
					'id'          => 'back_top_hover_color',
					'type'        => 'color',
					'title'       => esc_html__('Hover Color', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Back to Top icon hover color', 'noxfolio-toolkit'),
					'output'      => '.back-to-top:hover',
					'output_mode' => 'color',
					'dependency'  => ['back_to_top', '==', 'enabled'],
				],
				[
					'id'          => 'back_top_hover_bg',
					'type'        => 'color',
					'title'       => esc_html__('Hover Background', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Back to Top icon hover background color', 'noxfolio-toolkit'),
					'output'      => '.back-to-top:hover',
					'output_mode' => 'background-color',
					'dependency'  => ['back_to_top', '==', 'enabled'],
				],
			],
		]);

		/**
		 * Grid Line
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'general_options',
			'title'  => esc_html__('Grid Line', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Grid Lines', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'site_grid_line',
					'type'     => 'button_set',
					'title'    => esc_html__('Grid Line', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Show grid line to website', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'enabled',
				],
				[
					'id'          => 'line_color',
					'type'        => 'color',
					'title'       => esc_html__('Line Color', 'noxfolio-toolkit'),
					'output'      => ['.noxfolio-grid-lines span'],
					'output_mode' => 'background-color',
					'dependency'  => ['site_grid_line', '==', 'enabled'],
				],
			],
		]);
	}

	/**
	 * Header Options
	 */
	public function header_section()
	{
		CSF::createSection($this->options_prefix, [
			'id'    => 'header_options',
			'title' => esc_html__('Header', 'noxfolio-toolkit'),
		]);

		/**
		 * Header Layout
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'header_options',
			'title'  => esc_html__('General', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('General', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'notice',
					'style'   => 'info',
					'content' => esc_html__('If you used theme builder for site header then disable default theme header', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'default_header',
					'type'     => 'button_set',
					'title'    => esc_html__('Default Header', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Theme default header', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'disabled',
				],
				[
					'type'       => 'notice',
					'style'      => 'warning',
					'content'    => esc_html__('You disabled default theme header. Set your site header form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
					'dependency' => [
						'default_header',
						'==',
						'disabled',
					],
				],
				[
					'id'         => 'mobile_breakpoint',
					'type'       => 'select',
					'title'      => esc_html__('Breakpoint', 'noxfolio-toolkit'),
					'options'    => [
						'mobile-expand-xl'   => esc_html__('Large (< 1200px)', 'noxfolio-toolkit'),
						'mobile-expand-lg'   => esc_html__('Tablet (< 1025px)', 'noxfolio-toolkit'),
						'mobile-expand-md'   => esc_html__('Mobile (< 768px)', 'noxfolio-toolkit'),
						'mobile-expand-none' => esc_html__('None', 'noxfolio-toolkit'),
					],
					'default'    => 'mobile-expand-xl',
					'dependency' => [
						'default_header',
						'==',
						'enabled',
					],
				],
				[
					'id'         => 'header_button',
					'type'       => 'button_set',
					'title'      => esc_html__('Show Header Button', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Show a button to header right side', 'noxfolio-toolkit'),
					'options'    => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'    => 'enabled',
					'dependency' => [
						'default_header',
						'==',
						'enabled',
					],
				],
				[
					'id'         => 'button_text',
					'title'      => esc_html__('Button Text', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Text for Header Button.', 'noxfolio-toolkit'),
					'type'       => 'text',
					'default'    => esc_html__('Get a Quote', 'noxfolio-toolkit'),
					'dependency' => [
						['default_header', '==', 'enabled'],
						['header_button', '==', 'enabled'],
					],
				],
				[
					'id'         => 'button_url',
					'title'      => esc_html__('Button URL', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('URL for Header Button.', 'noxfolio-toolkit'),
					'type'       => 'text',
					'default'    => '#',
					'dependency' => [
						['default_header', '==', 'enabled'],
						['header_button', '==', 'enabled'],
					],
				],
				[
					'id'         => 'button_icon',
					'title'      => esc_html__('Button Icon', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Icon for Header Button.', 'noxfolio-toolkit'),
					'type'       => 'icon',
					'default'    => 'fa fa-angle-right',
					'dependency' => [
						['default_header', '==', 'enabled'],
						['header_button', '==', 'enabled'],
					],
				],
				[
					'id'         => 'hide_panel_button',
					'type'       => 'button_set',
					'title'      => esc_html__('Hide Button From Mobile Panel', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Show OR Hide Header Button From Mobile Panel', 'noxfolio-toolkit'),
					'options'    => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'    => 'no',
					'dependency' => [
						['default_header', '==', 'enabled'],
						['header_button', '==', 'enabled'],
					],
				],
				[
					'id'       => 'transparent_header',
					'type'     => 'button_set',
					'title'    => esc_html__('Transparent Header', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Set header to transparent background before scroll.', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'disabled',
				],
			],
		]);

		/**
		 * Site Logo
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'header_options',
			'title'  => esc_html__('Logo', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Header Logo', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'site_logo_type',
					'type'     => 'button_set',
					'title'    => esc_html__('Site Logo Type', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Select site logo type', 'noxfolio-toolkit'),
					'options'  => [
						'text'  => esc_html__('Text', 'noxfolio-toolkit'),
						'image' => esc_html__('Image', 'noxfolio-toolkit'),
					],
					'default'  => 'image',
				],
				[
					'id'         => 'site_text_logo',
					'type'       => 'text',
					'title'      => esc_html__('Text logo', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Type logo text', 'noxfolio-toolkit'),
					'default'    => esc_html__('Noxfolio', 'noxfolio-toolkit'),
					'dependency' => ['site_logo_type', '==', 'text'],
				],
				[
					'id'         => 'site_image_logo',
					'type'       => 'media',
					'title'      => esc_html__('Image logo', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Upload OR Select image for site logo', 'noxfolio-toolkit'),
					'library'    => 'image',
					'url'        => false,
					'default'    => [
						'url'       => NT_THEME_ASSETS . '/img/logo.png',
						'thumbnail' => NT_THEME_ASSETS . '/img/logo.png',
					],
					'dependency' => ['site_logo_type', '==', 'image'],
				],
				[
					'id'         => 'logo_dimension',
					'type'       => 'dimensions',
					'title'      => esc_html__('Logo Dimensions', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Site logo Dimensions', 'noxfolio-toolkit'),
					'output'     => '.default-header .noxfolio-site-logo img',
					'dependency' => ['site_logo_type', '==', 'image'],
				],
				[
					'id'          => 'logo_max_width',
					'type'        => 'number',
					'unit'        => 'px',
					'title'       => esc_html__('Max Width', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Logo wrapper max width', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-site-logo',
					'output_mode' => 'max-width',
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Mobile Panel Logo', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'panel_logo_type',
					'type'     => 'button_set',
					'title'    => esc_html__('Panel Logo Type', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Select Logo type', 'noxfolio-toolkit'),
					'options'  => [
						'text'  => esc_html__('Text', 'noxfolio-toolkit'),
						'image' => esc_html__('Image', 'noxfolio-toolkit'),
					],
					'default'  => 'image',
				],
				[
					'id'         => 'panel_text_logo',
					'type'       => 'text',
					'title'      => esc_html__('Text logo', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Type logo text', 'noxfolio-toolkit'),
					'default'    => 'Noxfolio',
					'dependency' => ['panel_logo_type', '==', 'text'],
				],
				[
					'id'         => 'panel_image_logo',
					'type'       => 'media',
					'title'      => esc_html__('Image logo', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Select OR Upload image', 'noxfolio-toolkit'),
					'library'    => 'image',
					'url'        => false,
					'default'    => [
						'url'       => NT_THEME_ASSETS . '/img/logo.png',
						'thumbnail' => NT_THEME_ASSETS . '/img/logo.png',
					],
					'dependency' => ['panel_logo_type', '==', 'image'],
				],
				[
					'id'         => 'slide_panel_dimension',
					'type'       => 'dimensions',
					'title'      => esc_html__('Logo Dimensions', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Image logo Dimensions', 'noxfolio-toolkit'),
					'output'     => '.default-header .slide-panel-logo img',
					'dependency' => ['panel_logo_type', '==', 'image'],
				],
				[
					'id'          => 'panel_logo_max_width',
					'type'        => 'number',
					'unit'        => 'px',
					'title'       => esc_html__('Max Width', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Logo wrapper max width', 'noxfolio-toolkit'),
					'output'      => '.noxfolio-nav-menu .slide-panel-wrapper .slide-panel-logo',
					'output_mode' => 'max-width',
				],
			],
		]);

		/**
		 * Styling
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'header_options',
			'title'  => esc_html__('Styling', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Header Styling', 'noxfolio-toolkit'),
				],
				[
					'id'               => 'header_bg',
					'type'             => 'color',
					'title'            => esc_html__('Header Background', 'noxfolio-toolkit'),
					'output'           => ['.site-header.default-header'],
					'output_mode'      => 'background-color',
					'output_important' => true,
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Menu Items', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'menu_item_color',
					'type'        => 'color',
					'title'       => esc_html__('Menu Item Color', 'noxfolio-toolkit'),
					'desc'        => esc_html__('This is the menu item font color.', 'noxfolio-toolkit'),
					'output'      => ['.default-header .noxfolio-nav-menu .nav-menu-wrapper a, .noxfolio-transparent-header .default-header .nav-menu-wrapper ul.primary-menu > li > a'],
					'output_mode' => 'color',
				],
				[
					'id'          => 'menu_item_hover_color',
					'type'        => 'color',
					'title'       => esc_html__('Active/Hover Color', 'noxfolio-toolkit'),
					'desc'        => esc_html__('This is the menu item font color.', 'noxfolio-toolkit'),
					'output'      => ['.default-header .noxfolio-nav-menu .nav-menu-wrapper a:hover, .default-header .noxfolio-nav-menu .nav-menu-wrapper li.current_page_item > a'],
					'output_mode' => 'color',
				],
				[
					'id'     => 'menu_typography',
					'type'   => 'typography',
					'title'  => esc_html__('Menu Typography', 'noxfolio-toolkit'),
					'color'  => false,
					'output' => '.default-header .noxfolio-nav-menu .nav-menu-wrapper a',
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Submenu', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'submenu_bg',
					'type'        => 'color',
					'title'       => esc_html__('Submenu Background', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .nav-menu-wrapper .sub-menu',
					'output_mode' => 'background-color',
				],
				[
					'id'          => 'submenu_item_divider',
					'type'        => 'color',
					'title'       => esc_html__('Item Divider', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)',
					'output_mode' => 'border-color',
				],
				[
					'id'          => 'submenu_item_color',
					'type'        => 'color',
					'title'       => esc_html__('Item Color', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .nav-menu-wrapper .sub-menu a',
					'output_mode' => 'color',
				],
				[
					'id'          => 'submenu_item_hover_color',
					'type'        => 'color',
					'title'       => esc_html__('Item Hover Color', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .nav-menu-wrapper .sub-menu a:hover',
					'output_mode' => 'color',
				],
				[
					'id'     => 'submenu_typography',
					'type'   => 'typography',
					'title'  => esc_html__('Item Typography', 'noxfolio-toolkit'),
					'color'  => false,
					'output' => '.default-header .noxfolio-nav-menu .nav-menu-wrapper .sub-menu a',
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Mobile Slide Panel', 'noxfolio-toolkit'),
				],
				[
					'id'     => 'toggler_color',
					'type'   => 'color',
					'title'  => esc_html__('Toggler Color', 'noxfolio-toolkit'),
					'output' => [
						'border-color'     => '.default-header .noxfolio-nav-menu .navbar-toggler, .noxfolio-transparent-header .default-header .noxfolio-nav-menu .navbar-toggler',
						'background-color' => '.default-header .noxfolio-nav-menu .navbar-toggler .line, .noxfolio-transparent-header .default-header .noxfolio-nav-menu .navbar-toggler .line',
					],
				],
				[
					'id'          => 'slide_panel_bg',
					'type'        => 'color',
					'title'       => esc_html__('Background', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .slide-panel-wrapper.show-panel .slide-panel-content',
					'output_mode' => 'background-color',
				],
				[
					'id'          => 'panel_item_divider',
					'type'        => 'color',
					'title'       => esc_html__('Item Divider', 'noxfolio-toolkit'),
					'output'      => [
						'.default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a',
						'.default-header .noxfolio-nav-menu .slide-panel-wrapper ul.primary-menu, .default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a .submenu-toggler'
					],
					'output_mode' => 'border-color',
				],
				[
					'id'          => 'panel_item_color',
					'type'        => 'color',
					'title'       => esc_html__('Item Color', 'noxfolio-toolkit'),
					'output'      => [
						'.default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a',
						'.default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-close'
					],
					'output_mode' => 'color',
				],
				[
					'id'          => 'panel_item_hover_color',
					'type'        => 'color',
					'title'       => esc_html__('Item Hover Color', 'noxfolio-toolkit'),
					'output'      => '.default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a',
					'output_mode' => 'color',
				],
				[
					'id'     => 'panel_typography',
					'type'   => 'typography',
					'title'  => esc_html__('Item Typography', 'noxfolio-toolkit'),
					'color'  => false,
					'output' => '.default-header .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a',
				],
			],
		]);
	}

	/**
	 * Footer Options
	 */
	public function footer_section()
	{
		CSF::createSection($this->options_prefix, [
			'id'    => 'footer_options',
			'title' => esc_html__('Footer', 'noxfolio-toolkit'),
		]);

		/**
		 * Footer Layout
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'footer_options',
			'title'  => esc_html__('General', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('General', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'notice',
					'style'   => 'info',
					'content' => esc_html__('If you used theme builder for site footer then disable default theme header', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'default_footer',
					'type'     => 'button_set',
					'title'    => esc_html__('Default Footer', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Theme default footer', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'disabled',
				],
				[
					'type'       => 'notice',
					'style'      => 'warning',
					'content'    => esc_html__('You disabled default theme footer. Set your site footer form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
					'dependency' => [
						'default_footer',
						'==',
						'disabled',
					],
				],
			],
		]);

		/**
		 * Footer Widgets
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'footer_options',
			'title'  => esc_html__('Footer Widgets', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Footer Widgets', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'footer_background',
					'type'        => 'background',
					'title'       => esc_html__('Footer background', 'noxfolio-toolkit'),
					'output'      => '.site-footer .footer-widgets',
					'output_mode' => 'background-color',
				],
				[
					'id'     => 'footer_text_color',
					'type'   => 'color',
					'title'  => esc_html__('Text Color', 'noxfolio-toolkit'),
					'output' => [
						'--text-color' => '.site-footer',
					],
				],
				[
					'id'     => 'footer_text_hover_color',
					'type'   => 'color',
					'title'  => esc_html__('Hover Color', 'noxfolio-toolkit'),
					'output' => [
						'--hover-text-color' => '.site-footer',
					],
				],
				[
					'id'               => 'footer_content_typography',
					'type'             => 'typography',
					'title'            => esc_html__('Content Typography', 'noxfolio-toolkit'),
					'color'            => false,
					'line_height_unit' => 'em',
					'preview'          => false,
					'output'           => ['.site-footer .footer-widgets .widget'],
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Widget Title', 'noxfolio-toolkit'),
				],
				[
					'id'               => 'footer_title_typography',
					'type'             => 'typography',
					'title'            => esc_html__('Title', 'noxfolio-toolkit'),
					'output'           => '.footer-widgets .widget .widget-title',
					'color'            => false,
					'line_height_unit' => 'em',
					'preview'          => false,
				],
				[
					'id'     => 'footer_title_color',
					'type'   => 'color',
					'title'  => esc_html__('Color', 'noxfolio-toolkit'),
					'output' => '.footer-widgets .widget .widget-title, .footer-widgets .widget.widget_rss a.rsswidget',
				],
			],
		]);

		/**
		 * Footer Widgets
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'footer_options',
			'title'  => esc_html__('Footer Copyright', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Footer', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'copyright_text',
					'type'    => 'textarea',
					'title'   => esc_html__('Copyright Text', 'noxfolio-toolkit'),
					'default' => esc_html__('Copyright © 2023. All rights reserved.', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Style', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'copyright_color_bg',
					'type'        => 'color',
					'title'       => esc_html__('Copyright Background', 'noxfolio-toolkit'),
					'output'      => '.site-footer .footer-copyright',
					'output_mode' => 'background-color',
				],
				[
					'id'     => 'copyright_color',
					'type'   => 'color',
					'title'  => esc_html__('Copyright text color', 'noxfolio-toolkit'),
					'output' => '.site-footer .footer-copyright, .site-footer .footer-copyright a',
				],
			],
		]);
	}

	/**
	 * Page Title
	 */
	public function page_title_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Page Title', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Page Title', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'site_page_title',
					'type'    => 'button_set',
					'title'   => esc_html__('Site Page Title', 'noxfolio-toolkit'),
					'options' => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default' => 'enabled',
				],
				[
					'id'         => 'site_breadcrumb',
					'type'       => 'button_set',
					'title'      => esc_html__('Site Breadcrumb', 'noxfolio-toolkit'),
					'options'    => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'    => 'enabled',
					'dependency' => ['site_page_title', '==', 'enabled'],
				],
				[
					'type'       => 'subheading',
					'content'    => esc_html__('Page Title Styling', 'noxfolio-toolkit'),
					'dependency' => ['site_page_title', '==', 'enabled'],
				],
				[
					'id'         => 'page_title_bg',
					'type'       => 'background',
					'title'      => esc_html__('Background', 'noxfolio-toolkit'),
					'output'     => '.page-title-wrapper',
					'dependency' => ['site_page_title', '==', 'enabled'],
				],
				[
					'id'          => 'page_title_overly_color',
					'type'        => 'color',
					'title'       => esc_html__('Overly Color', 'noxfolio-toolkit'),
					'output'      => '.page-title-wrapper::before',
					'dependency'  => ['site_page_title', '==', 'enabled'],
					'output_mode' => 'background-color',
				],
				[
					'id'         => 'page_title_typo',
					'type'       => 'typography',
					'title'      => esc_html('Typography', 'noxfolio-toolkit'),
					'output'     => '.page-title-wrapper .page-title',
					'dependency' => ['site_page_title', '==', 'enabled'],
				],
				[
					'id'               => 'page_breadcrumb_typo',
					'type'             => 'typography',
					'line_height_unit' => 'em',
					'title'            => esc_html('Breadcrumb Typography', 'noxfolio-toolkit'),
					'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
					'dependency'       => ['site_page_title', '==', 'enabled'],
				],
			],
		]);
	}

	/**
	 * Blog Options
	 */
	public function blog_section()
	{
		CSF::createSection($this->options_prefix, [
			'id'    => 'blog_options',
			'title' => esc_html__('Blog', 'noxfolio-toolkit'),
		]);

		/**
		 * Blog Archive
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'blog_options',
			'title'  => esc_html__('Blog Archive', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Blog Archive', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'blog_archive_title',
					'type'        => 'text',
					'title'       => esc_html__('Blog Archive Title', 'noxfolio-toolkit'),
					'subtitle'    => esc_html__('Archive page title.', 'noxfolio-toolkit'),
					'placeholder' => esc_html__('Type title', 'noxfolio-toolkit'),
					'default'     => esc_html__('Latest News', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'blog_archive_sidebar',
					'type'     => 'select',
					'title'    => esc_html__('Sidebar', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Select Blog Archive Sidebar. Left sidebar or right sidebar or No sidebar', 'noxfolio-toolkit'),
					'options'  => [
						'left-sidebar'  => esc_html('Left Sidebar', 'noxfolio-toolkit'),
						'right-sidebar' => esc_html('Right Sidebar', 'noxfolio-toolkit'),
						'no-sidebar'    => esc_html('No Sidebar', 'noxfolio-toolkit'),
					],
					'default'  => 'right-sidebar',
				],
				[
					'id'       => 'archive_post_category',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Categories', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable post categories on blog archive page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'archive_post_date',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Date', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable post date on blog archive page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'archive_post_comments',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Comments', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable post comments count on blog archive page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'archive_post_excerpt',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Excerpt', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post Excerpt on Blog Archive page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'         => 'post_excerpt_count',
					'type'       => 'number',
					'title'      => esc_html__('Excerpt Word Count', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Set how many words you want to show in the post Excerpt', 'noxfolio-toolkit'),
					'default'    => 30,
					'dependency' => [
						'archive_post_excerpt',
						'==',
						'yes',
					],
				],
				[
					'id'       => 'archive_post_button',
					'type'     => 'button_set',
					'title'    => esc_html__('Read More Button', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post Read More Button on Blog Archive page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'         => 'post_button_text',
					'type'       => 'text',
					'title'      => esc_html__('Button Text', 'noxfolio-toolkit'),
					'default'    => esc_html__('Read More', 'noxfolio-toolkit'),
					'dependency' => [
						'archive_post_button',
						'==',
						'yes',
					],
				],
			],
		]);

		/**
		 * Blog Single
		 */
		CSF::createSection($this->options_prefix, [
			'parent' => 'blog_options',
			'title'  => esc_html__('Blog Single', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Blog single', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'blog_details_sidebar',
					'type'    => 'select',
					'title'   => esc_html__('Sidebar', 'noxfolio-toolkit'),
					'options' => [
						'left-sidebar'  => esc_html('Left Sidebar', 'noxfolio-toolkit'),
						'right-sidebar' => esc_html('Right Sidebar', 'noxfolio-toolkit'),
						'no-sidebar'    => esc_html('No Sidebar', 'noxfolio-toolkit'),
					],
					'default' => 'right-sidebar',
					'desc'    => esc_html__('Select Blog Details Sidebar. Left sidebar or right sidebar or No sidebar', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'blog_details_meta',
					'type'     => 'button_set',
					'title'    => esc_html__('Show Post Meta', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post meta on details page title area', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'blog_details_share',
					'type'     => 'button_set',
					'title'    => esc_html__('Show Post Share Links', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post social share links.', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'no',
				],
				[
					'id'         => 'social_share_item',
					'type'       => 'sorter',
					'title'      => esc_html__('Social Share Links', 'noxfolio-toolkit'),
					'default'    => [
						'enabled'  => [
							'facebook'  => esc_html__('Facebook', 'noxfolio-toolkit'),
							'twitter'   => esc_html__('Twitter', 'noxfolio-toolkit'),
							'pinterest' => esc_html__('Pinterest', 'noxfolio-toolkit'),
							'linkedin'  => esc_html__('Linkedin', 'noxfolio-toolkit'),
						],
						'disabled' => [
							'reddit'   => esc_html__('Reddit', 'noxfolio-toolkit'),
							'whatsapp' => esc_html__('Whatsapp', 'noxfolio-toolkit'),
							'telegram' => esc_html__('Telegram', 'noxfolio-toolkit'),
						],
					],
					'dependency' => [
						'blog_details_share',
						'==',
						'yes',
					],
				],
				[
					'id'       => 'blog_details_tag',
					'type'     => 'button_set',
					'title'    => esc_html__('Related Tags', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable related tag on Blog Details page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'blog_details_nav',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Navigation', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post navigation on Blog Details page', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'yes',
				],
				[
					'id'       => 'blog_author_info',
					'type'     => 'button_set',
					'title'    => esc_html__('Post Author', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable or Disable Post author information box.', 'noxfolio-toolkit'),
					'options'  => [
						'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
						'no'  => esc_html__('No', 'noxfolio-toolkit'),
					],
					'default'  => 'no',
				],
			],
		]);
	}

	/**
	 * Portfolio Options
	 */
	public function portfolio_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Portfolio', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Portfolio', 'noxfolio-toolkit'),
				],
				[
					'id'          => 'portfolio_slug',
					'type'        => 'text',
					'title'       => esc_html__('Portfolio Slug', 'noxfolio-toolkit'),
					'placeholder' => esc_html__('portfolio', 'noxfolio-toolkit'),
					'desc'        => esc_html__('You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don\'t forget to save the permalinks settings from Settings > Permalinks after changing the slug value.', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'portfolio_post_per_page',
					'type'     => 'number',
					'title'    => esc_html__('Post Per Page', 'noxfolio-toolkit'),
					'default'  => 9,
					'subtitle' => esc_html__('Number of posts to show per page', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Page Title Area', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'archive_page_title',
					'type'     => 'text',
					'title'    => esc_html__('Page Title', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Archive Page Title', 'noxfolio-toolkit'),
					'default'  => esc_html__('Our Portfolio', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'subheading',
					'content' => esc_html__('Archive Page Design', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'portfolio_style',
					'title'    => esc_html__('Design', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Portfolio style', 'noxfolio-toolkit'),
					'type'     => 'select',
					'default'  => 'normal',
					'options'  => [
						'design-one' => esc_html__('Normal Style', 'noxfolio-toolkit'),
						'design-two' => esc_html__('Hover Content', 'noxfolio-toolkit'),
					],
				],
				[
					'id'      => 'portfolio_section_title',
					'title'   => esc_html__('Section Title', 'noxfolio-toolkit'),
					'type'    => 'text',
					'default' => esc_html__('Take A Look Our Popular Works', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'portfolio_section_subtitle',
					'title'   => esc_html__('Subtitle', 'noxfolio-toolkit'),
					'type'    => 'text',
					'default' => esc_html__('Portfolio', 'noxfolio-toolkit'),
				],
			],
		]);
	}

	/**
	 * Color Options
	 */
	public function color_scheme_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Color Scheme', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Color Scheme', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'primary_color',
					'type'     => 'color',
					'title'    => esc_html__('Primary', 'noxfolio-toolkit'),
					'default'  => '#c9f31d',
					'subtitle' => esc_html__('Theme main brand color. Used by most elements throughout the website.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #c9f31d', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'secondary_color',
					'type'     => 'color',
					'title'    => esc_html__('Secondary', 'noxfolio-toolkit'),
					'default'  => '#1f1f1f',
					'subtitle' => esc_html__('Theme secondary color. Used mainly as element background color and button hover colors', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #1f1f1f', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'body_color',
					'type'     => 'color',
					'title'    => esc_html__('Body', 'noxfolio-toolkit'),
					'default'  => '#b1b1b1',
					'subtitle' => esc_html__('A light to medium gray color, easy to read color, used by all text elements.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #b1b1b1', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'headline_color',
					'type'     => 'color',
					'title'    => esc_html__('Headline', 'noxfolio-toolkit'),
					'default'  => '#ffffff',
					'subtitle' => esc_html__('A white, contrasting color, used by all headlines in your website.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #ffffff', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'border_color',
					'type'     => 'color',
					'title'    => esc_html__('Border', 'noxfolio-toolkit'),
					'default'  => '#353535',
					'subtitle' => esc_html__('A lighter dark color. Generally used as common color for border etc.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #353535', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'dark_color',
					'type'     => 'color',
					'title'    => esc_html__('Dark Color', 'noxfolio-toolkit'),
					'default'  => '#070707',
					'subtitle' => esc_html__('It\'s a Dark Neutral color. Generally used as background color for body and dark sections etc.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #070707', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'dark_light_color',
					'type'     => 'color',
					'title'    => esc_html__('Dark-Light Color', 'noxfolio-toolkit'),
					'default'  => '#131313',
					'subtitle' => esc_html__('It\'s a lighter dark color. Generally used as background color for body and dark sections etc.', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #131313', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'white_color',
					'type'     => 'color',
					'title'    => esc_html__('White Color', 'noxfolio-toolkit'),
					'default'  => '#ffffff',
					'subtitle' => esc_html__('It\'s a White Neutral Color. Generally used as the color white elements of website', 'noxfolio-toolkit'),
					'desc'     => esc_html__('Default: #ffffff', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'custom_global_color',
					'type'     => 'group',
					'class'    => 'noxfolio-global-colors-options',
					'title'    => esc_html__('Add Global Color', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('If you want to add custom global color, you can add here. Those global will be elementor global color as well.', 'noxfolio-toolkit'),
					'fields'   => [
						[
							'id'    => 'color_title',
							'type'  => 'text',
							'title' => esc_html__('Title', 'noxfolio-toolkit'),
						],
						[
							'id'    => 'color_value',
							'type'  => 'color',
							'title' => esc_html__('Color', 'noxfolio-toolkit'),
						],
					],
				],
			],
		]);
	}

	/**
	 * Typography Options
	 */
	public function typography_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Typography', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Typography', 'noxfolio-toolkit'),
				],
				[
					'id'                 => 'primary_font',
					'type'               => 'typography',
					'title'              => esc_html__('Primary Font', 'noxfolio-toolkit'),
					'subtitle'           => esc_html__('The main font of your website. The most readable font, used by all text elements.', 'noxfolio-toolkit'),
					'font_weight'        => true,
					'font_style'         => true,
					'extra_styles'       => true,
					'font_size'          => false,
					'line_height'        => false,
					'letter_spacing'     => false,
					'text_align'         => false,
					'text_transform'     => false,
					'color'              => false,
					'backup_font_family' => false,
					'subset'             => true,
					'preview'            => false,
				],
				[
					'id'                 => 'secondary_font',
					'type'               => 'typography',
					'title'              => esc_html__('Secondary Font', 'noxfolio-toolkit'),
					'subtitle'           => esc_html__('The secondary font of your website. Used by secondary headlines and smaller elements.', 'noxfolio-toolkit'),
					'font_weight'        => true,
					'font_style'         => true,
					'extra_styles'       => true,
					'font_size'          => false,
					'line_height'        => false,
					'letter_spacing'     => false,
					'text_align'         => false,
					'text_transform'     => false,
					'color'              => false,
					'backup_font_family' => false,
					'subset'             => true,
					'preview'            => false,
				],
				[
					'type'    => 'notice',
					'style'   => 'info',
					'content' => esc_html__('For better performance, it\'s recommended you limit typography to two font families.', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'body_typo_types',
					'type'    => 'button_set',
					'title'   => esc_html__('Body Typography', 'noxfolio-toolkit'),
					'options' => [
						'default-font' => esc_html__('Default', 'noxfolio-toolkit'),
						'custom-font'  => esc_html__('Custom', 'noxfolio-toolkit'),
					],
					'default' => 'default-font',
				],
				[
					'id'               => 'body_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Body', 'noxfolio-toolkit'),
					'output'           => 'body',
					'line_height_unit' => 'em',
					'dependency'       => [
						'body_typo_types',
						'==',
						'custom-font',
					],
				],
				[
					'id'      => 'heading_typo_type',
					'type'    => 'button_set',
					'title'   => esc_html__('Heading Typography', 'noxfolio-toolkit'),
					'options' => [
						'default-font' => esc_html__('Default', 'noxfolio-toolkit'),
						'custom-font'  => esc_html__('Custom', 'noxfolio-toolkit'),
					],
					'default' => 'default-font',
				],
				[
					'id'               => 'heading1_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 1', 'noxfolio-toolkit'),
					'output'           => 'h1',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
				[
					'id'               => 'heading2_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 2', 'noxfolio-toolkit'),
					'output'           => 'h2',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
				[
					'id'               => 'heading3_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 3', 'noxfolio-toolkit'),
					'output'           => 'h3',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
				[
					'id'               => 'heading4_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 4', 'noxfolio-toolkit'),
					'output'           => 'h4',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
				[
					'id'               => 'heading5_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 5', 'noxfolio-toolkit'),
					'output'           => 'h5',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
				[
					'id'               => 'heading6_typo',
					'type'             => 'typography',
					'title'            => esc_html__('Heading 6', 'noxfolio-toolkit'),
					'output'           => 'h6',
					'line_height_unit' => 'em',
					'dependency'       => [
						'heading_typo_type',
						'==',
						'custom-font',
					],
				],
			],
		]);
	}

	/**
	 * Custom Script Options
	 */
	public function custom_scrips_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Custom Scripts', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Custom Scripts', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'custom_header_scripts',
					'type'     => 'code_editor',
					'title'    => esc_html__('Js Code(Head)', 'noxfolio-toolkit'),
					'settings' => [
						'theme' => 'mbo',
						'mode'  => 'javascript',
					],
					'subtitle' => esc_html__('Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_head hook.
                    ', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'custom_footer_scripts',
					'type'     => 'code_editor',
					'title'    => esc_html__('Js Code(Footer)', 'noxfolio-toolkit'),
					'settings' => [
						'theme' => 'mbo',
						'mode'  => 'javascript',
					],
					'subtitle' => esc_html__('Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_footer hook.
                    ', 'noxfolio-toolkit'),
				],
				[
					'type'    => 'submessage',
					'style'   => 'info',
					'content' => esc_html__('You Can add also custom css in Appearance>Customize>Additional CSS', 'noxfolio-toolkit'),
				],
			],
		]);
	}

	/**
	 * Error Options
	 */
	public function error_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('404 Page', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('404 Page', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'error_title',
					'type'    => 'text',
					'title'   => esc_html__('Title', 'noxfolio-toolkit'),
					'default' => esc_html__('Oops!', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'error_message',
					'type'    => 'textarea',
					'title'   => esc_html__('Message', 'noxfolio-toolkit'),
					'default' => esc_html__('This Page Are Can\'t be Found', 'noxfolio-toolkit'),
				],
				[
					'id'      => 'error_button_text',
					'type'    => 'text',
					'title'   => esc_html__('Error Button Text', 'noxfolio-toolkit'),
					'default' => esc_html__('Go to Home', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'error_img',
					'type'     => 'media',
					'title'    => esc_html__('404 Illustration', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Upload OR Select a illustration for 404 page', 'noxfolio-toolkit'),
					'library'  => 'image',
					'url'      => false,
					'default'  => [
						'url'       => NT_THEME_ASSETS . '/img/404-illustration.png',
						'thumbnail' => NT_THEME_ASSETS . '/img/404-illustration.png',
					],
				],
			],
		]);
	}

	/**
	 * Maintenance Options
	 */
	public function maintenance_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Maintenance Mode', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Maintenance Mode', 'noxfolio-toolkit'),
				],
				[
					'id'       => 'maintenance_mode',
					'type'     => 'button_set',
					'title'    => esc_html__('Maintenance Mode', 'noxfolio-toolkit'),
					'subtitle' => esc_html__('Enable maintenance mode top your website.', 'noxfolio-toolkit'),
					'options'  => [
						'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
						'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
					],
					'default'  => 'disabled',
				],
				[
					'id'          => 'maintenance_page',
					'type'        => 'select',
					'title'       => esc_html__('Maintenance Page', 'noxfolio-toolkit'),
					'placeholder' => esc_html__('Default', 'noxfolio-toolkit'),
					'options'     => 'pages',
					'dependency'  => ['maintenance_mode', '==', 'enabled'],
				],
				[
					'id'         => 'maintenance_title',
					'type'       => 'text',
					'title'      => esc_html__('Maintenance Title', 'noxfolio-toolkit'),
					'default'    => esc_html__('The site is currently down for maintenance', 'noxfolio-toolkit'),
					'dependency' => [
						['maintenance_mode', '==', 'enabled'],
						['maintenance_page', '==', ''],
					],
				],
				[
					'id'         => 'maintenance_subtitle',
					'type'       => 'textarea',
					'title'      => esc_html__('Maintenance Subtitle', 'noxfolio-toolkit'),
					'default'    => esc_html__('We apologize for any inconvenience caused', 'noxfolio-toolkit'),
					'dependency' => [
						['maintenance_mode', '==', 'enabled'],
						['maintenance_page', '==', ''],
					],
				],
				[
					'id'         => 'maintenance_img',
					'type'       => 'media',
					'title'      => esc_html__('Maintenance Img', 'noxfolio-toolkit'),
					'subtitle'   => esc_html__('Upload OR Select a illustration for maintenance page', 'noxfolio-toolkit'),
					'library'    => 'image',
					'url'        => false,
					'default'    => [
						'url'       => NT_THEME_ASSETS . '/img/maintenance.png',
						'thumbnail' => NT_THEME_ASSETS . '/img/maintenance.png',
					],
					'dependency' => [
						['maintenance_mode', '==', 'enabled'],
						['maintenance_page', '==', ''],
					],
				],
			],
		]);
	}

	/**
	 * Backup Options
	 */
	public function backup_section()
	{
		CSF::createSection($this->options_prefix, [
			'title'  => esc_html__('Backup', 'noxfolio-toolkit'),
			'fields' => [
				[
					'type'    => 'heading',
					'content' => esc_html__('Backup', 'noxfolio-toolkit'),
				],
				[
					'type' => 'backup',
				],
			],
		]);
	}

	/**
	 * Add custom color palette
	 */
	public function custom_color_palette()
	{
		$colors = Noxfolio_Helper::get_default_colors();

		$new_color = [];

		foreach ($colors as $color) {
			array_push($new_color, $color['value']);
		}

		return $new_color;
	}

	public function add_dashboard_banner()
	{
		Admin_Panel::render_heading();
	}
}

Noxfolio_Theme_Options::instance()->initialize();
