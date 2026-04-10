<?php

/**
 * Helper functions
 *
 */

use NoxfolioTheme\Classes\Noxfolio_Helper;

defined('ABSPATH') || exit;

/**
 * Retrieve the name of the highest priority template file that exists.
 *
 * @param string|array $template_names Template file(s) to search for, in order.
 * @param string $origin_path Template file(s) origin path. (../noxfolio-toolkit/elementor/widgets/)
 * @param string $override_path New template file(s) override path. (../noxfolio)
 *
 * @return array The template filename if one is located.
 */
function nt_get_locate_template($template_names, $origin_path, $override_path)
{
	$files = [];
	$file  = '';

	foreach ((array) $template_names as $template_name) {
		if (file_exists(get_stylesheet_directory() . $override_path . $template_name)) {
			$file = get_stylesheet_directory() . $override_path . $template_name;
		} elseif (file_exists(get_template_directory() . $override_path . $template_name)) {
			$file = get_template_directory() . $override_path . $template_name;
		} elseif (file_exists(realpath(__DIR__ . '/..') . $origin_path . $template_name)) {
			$file = realpath(__DIR__ . '/..') . $origin_path . $template_name;
		}
		$files[] = $file;
	}

	return $files;
}

/**
 * Get a list of Posts
 *
 * @param string $post_type
 *
 * @return array
 */
function nt_select_post($post_type = 'post')
{
	$args = [
		'post_type'   => $post_type,
		'numberposts' => -1,
		'orderby'     => 'title',
		'order'       => 'ASC',
	];

	$query_query = get_posts($args);

	$posts = [];
	if ($query_query) {
		foreach ($query_query as $query) {
			$posts[$query->ID] = $query->post_title;
		}
	}

	return $posts;
}

/**
 * Get All Category For Query
 *
 * @param string $category
 *
 * @return array
 */
function nt_select_category($category = 'category')
{
	$terms = get_terms([
		'taxonomy'   => $category,
		'hide_empty' => true,
	]);

	$options = [];

	if (! empty($terms) && ! is_wp_error($terms)) {
		foreach ($terms as $term) {
			$options[$term->slug] = $term->name;
		}
	}

	return $options;
}

/**
 * Get a list of all Contact Form 7
 *
 * @return array
 * @since 1.0.0
 */
function nt_select_cf7()
{
	$forms_list = [];

	if (function_exists('wpcf7')) {
		$forms = get_posts([
			'post_type'      => 'wpcf7_contact_form',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		]);

		if (! empty($forms)) {
			$forms_list = wp_list_pluck($forms, 'post_title', 'ID');
		} else {
			$forms_list[0] = esc_html__('No Contact From found', 'noxfolio-toolkit');
		}
	} else {
		$forms_list[0] = esc_html__('Please Install & Active Contact Contact Form 7', 'noxfolio-toolkit');
	}

	return $forms_list;
}

/**
 * Get a list of all block builder block
 *
 * @param string $type
 *
 * @return array
 */
function nt_select_builder_block($type = 'block')
{
	$items = [];
	$lists = ['0' => __('--- Select Template ---', 'noxfolio-toolkit')];

	$args = [
		'post_type'      => 'noxfolio_template',
		'posts_per_page' => -1,
	];

	$posts = get_posts($args);

	foreach ($posts as $post) {
		$meta = get_post_meta($post->ID, 'noxfolio_tb_settings', true);

		if ($type == $meta['template_type']) {
			$items[$post->ID] = $post->post_title;
		}
	}

	return $lists + $items;
}

/**
 * Get list of Elementor Template
 *
 * @return array
 */
function nt_select_elementor_template()
{
	$args = [
		'post_type'   => 'elementor_library',
		'numberposts' => -1,
		'orderby'     => 'title',
		'order'       => 'ASC',
		'tax_query'   => [
			'relation' => 'OR',
			[
				'taxonomy' => 'elementor_library_type',
				'field'    => 'slug',
				'terms'    => 'section',
			],
			[
				'taxonomy' => 'elementor_library_type',
				'field'    => 'slug',
				'terms'    => 'page',
			],
		],
	];

	$query_query = get_posts($args);

	$lists = ['0' => __('--- Select Template ---', 'noxfolio-toolkit')];
	$items = [];

	if ($query_query) {
		foreach ($query_query as $query) {
			$items[$query->ID] = $query->post_title;
		}
	}

	return $lists + $items;
}

/**
 * Social Share links
 */
function nt_post_share_links()
{
	global $post;

	if (! isset($post->ID)) {
		return;
	}

	$share_items       = Noxfolio_Helper::get_option('social_share_item', []);
	$enabled_platforms = array_key_exists('enabled', $share_items) ? $share_items['enabled'] : [];

	$post_title     = urlencode(get_the_title());
	$post_permalink = urlencode(get_permalink());
	$img_url        = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail')[0] ?? '';

	$social_platforms = [
		'twitter'  => [
			'url'  => 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_permalink,
			'icon' => 'fab fa-twitter',
		],
		'facebook' => [
			'url'  => 'https://www.facebook.com/share.php?u=' . $post_permalink,
			'icon' => 'fab fa-facebook-f',
		],
		'linkedin' => [
			'url'  => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_permalink . '&title=' . $post_title,
			'icon' => 'fab fa-linkedin-in',
		],
		'reddit'   => [
			'url'  => 'https://reddit.com/submit?url=' . $post_permalink . '&title=' . $post_title,
			'icon' => 'fab fa-reddit-alien',
		],
		'whatsapp' => [
			'url'  => 'https://wa.me/?text=' . $post_title . '%20' . $post_permalink,
			'icon' => 'fab fa-whatsapp',
		],
		'telegram' => [
			'url'  => 'https://telegram.me/share/url?url=' . $post_permalink . '&text=' . $post_title,
			'icon' => 'fab fa-telegram-plane',
		],
	];

	if (strlen($img_url) > 0) {
		$social_platforms['pinterest'] = [
			'url'  => 'https://pinterest.com/pin/create/button/?url=' . $post_permalink . '&media=' . $img_url,
			'icon' => 'fab fa-pinterest-p',
		];
	}

	$html = '';

	foreach ($enabled_platforms as $key => $platform) {
		if (array_key_exists($key, $social_platforms)) {
			$html .= '<a target="_blank" href="' . esc_url($social_platforms[$key]['url']) . '">
                <i class="fab fa-' . $social_platforms[$key]['icon'] . '"></i>
            </a>';
		}
	}

	echo $html;
}


/**
 * Set posts per page for custom post types and taxonomies
 */
if (! function_exists('nt_cpt_per_page')) {
	add_filter('pre_get_posts', 'nt_cpt_per_page');

	function nt_cpt_per_page($query)
	{

		if ($query->is_post_type_archive('noxfolio_portfolio') && ! is_admin() && $query->is_main_query()) {
			$post_per_page = Noxfolio_Helper::get_option('portfolio_post_per_page', '9');
			$query->set('posts_per_page', $post_per_page);
		}

		return $query;
	}
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 *
 * @return array
 */
function nt_get_allowed_html_tags($level = 'basic')
{
	return [
		'b'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'i'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'u'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		's'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'br'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'em'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'del'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'ins'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sub'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sup'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'code'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'mark'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'small'  => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strike' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'abbr'   => [
			'title' => [],
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'span'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strong' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
	];
}

/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 *
 * @return string $default default tag will be return during no matches
 */

function nt_escape_tags($tag, $default = 'span')
{

	$supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

	if (! in_array($tag, $supports, true)) {
		return $default;
	}

	return $tag;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 *
 * @return string
 */
function nt_kses_basic($string = '')
{
	return wp_kses($string, nt_get_allowed_html_tags('basic'));
}

if (!function_exists('nt_get_elementor_template')) :
	function nt_get_elementor_template($template_name = null)
	{
		$template_path = apply_filters('elementor/template-path', 'elementor-templates/');
		$template = locate_template($template_path . $template_name);
		if (!$template) {
			$template = RT_ELEMENTOR . '/elementor-templates/' . $template_name;
		}
		if (file_exists($template)) {
			return $template;
		} else {
			return false;
		}
	}
endif;


if (!function_exists('nt_get_elementor_option')) :
	function nt_get_elementor_option($template_name = null)
	{
		$template_path = apply_filters('elementor/template-options', 'elementor-options/');
		$template = locate_template($template_path . $template_name);
		if (!$template) {
			$template = RT_ELEMENTOR . '/elementor-options/' . $template_name;
		}
		if (file_exists($template)) {
			return $template;
		}
	}
endif;

if (!function_exists('nt_elementor_rendered_image')) {
	function nt_elementor_rendered_image($content, $name, $class = '')
	{
		// Ensure the content field exists and is an array
		if (!isset($content[$name]) || !is_array($content[$name])) {
			return;
		}

		// Handle single image case (when the content is not a gallery but a single image)
		$is_gallery = isset($content[$name][0]) && is_array($content[$name][0]);
		$images = $is_gallery ? $content[$name] : [$content[$name]];

		foreach ($images as $image_item) {
			// Ensure each item is an array and contains either an ID or a URL
			if (!is_array($image_item) || (empty($image_item['id']) && empty($image_item['url']))) {
				continue;
			}

			// Get the image URL
			$image = !empty($image_item['id'])
				? wp_get_attachment_image_url($image_item['id'], 'full')
				: esc_url($image_item['url']);

			// If the image URL is empty, skip this item
			if (empty($image)) {
				continue;
			}

			// Prepare the image attributes (title, class, alt)
			$image_attr = '';
			$title = \Elementor\Control_Media::get_image_title($image_item);
			$alt = \Elementor\Control_Media::get_image_alt($image_item);

			// Add title attribute if available
			if (!empty($title)) {
				$image_attr .= 'title="' . esc_attr($title) . '" ';
			}

			// Add class attribute if provided
			if (!empty($class)) {
				$image_attr .= 'class="' . esc_attr($class) . '" ';
			}

			// Ensure alt attribute has fallback if empty
			$alt = !empty($alt) ? esc_attr($alt) : '';

			// Output the image tag
			printf(
				'<img src="%s" alt="%s" %s>',
				esc_url($image),
				$alt,
				$image_attr
			);
		}
	}
}


if (!function_exists('nt_get_elementor_thumbnail_alt')) :
	function nt_get_elementor_thumbnail_alt($thumbnail_id)
	{
		return get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	}
endif;

if (!function_exists('noxfolio_elementor_style_options')) :
	function noxfolio_elementor_style_options($agrs, $label, $selector, $condition, $style = 'color', $typo = true, $color = true)
	{

		if ($style == 'background-color') :
			if ($color) :
				$agrs->add_control(
					str_replace(' ', '_', $label) . '_color',
					[
						'label' => __('Background Color', 'noxfolio-toolkit'),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							$selector => $style . ': {{VALUE}}',
						],
						'condition' => [
							'layout_type' => $condition
						]
					]
				);
			endif;
			return;
		endif;

		//Label
		$agrs->add_control(
			str_replace(' ', '_', $label) . '_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => __($label, 'noxfolio-toolkit'),
				'separator' => 'after',
				'condition' => [
					'layout_type' => $condition
				]
			]
		);

		$agrs->add_responsive_control(
			str_replace(' ', '_', $label) . '_padding',
			[
				'label' => __(' Padding', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout_type' => $condition
				]
			]
		);

		$agrs->add_responsive_control(
			str_replace(' ', '_', $label) . '_margin',
			[
				'label' => __(' Margin', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout_type' => $condition
				]
			]
		);

		if ($typo) :
			$agrs->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => str_replace(' ', '_', $label) . '_typo',
					'label' => esc_html__(' Typography', 'noxfolio-toolkit'),
					'selector' => $selector,
					'condition' => [
						'layout_type' => $condition
					]
				]
			);

		endif;
		if ($color) :
			$agrs->add_control(
				str_replace(' ', '_', $label) . '_color',
				[
					'label' => __('Color', 'noxfolio-toolkit'),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						$selector => $style . ': {{VALUE}} !important;',
					],
					'condition' => [
						'layout_type' => $condition
					]
				]
			);
		endif;
	}
endif;
