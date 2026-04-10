<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;


class Recent_Post_New extends Widget_Base
{


	public function get_name()
	{
		return 'noxfolio-recent-post-new';
	}

	public function get_title()
	{
		return esc_html__('Recent Post New', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-posts-grid webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'recent', 'blog', 'post', 'new'];
	}

	public function get_style_depends()
	{
		return ['slick'];
	}

	public function get_script_depends()
	{
		return ['slick'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __('Layout', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => __('Select Layout', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'layout_one',
				'options' => [
					'layout_one' => __('Layout One', 'noxfolio-toolkit'),
					'layout_two' => __('Layout Two', 'noxfolio-toolkit'),
				]
			]
		);

		$this->add_control(
			'post_type',
			[
				'label'       => esc_html__('Post Type', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'cpt'   => esc_html__('Blog Type', 'noxfolio-toolkit'),
					'elementor-field'   => esc_html__('With Elementor', 'noxfolio-toolkit'),
				],
				'default'     => 'cpt',

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_header_section',
			[
				'label' => __('Header Section', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout_type!' => 'layout_five',
				]
			]
		);

		$this->add_control(
			'layout_one_title',
			[
				'label' => esc_html__('Title', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add title', 'noxfolio-toolkit'),
				'default' => esc_html__('Default Title', 'noxfolio-toolkit'),
			]
		);

		$this->add_control(
			'layout_one_title_tag',
			[
				'label'       => esc_html__('Title Tag', 'noxfolio-toolkit'),
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'h1' => [
						'title' => esc_html__('H1', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h1',
					],
					'h2' => [
						'title' => esc_html__('H2', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => esc_html__('H3', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => esc_html__('H4', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => esc_html__('H5', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => esc_html__('H6', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default'     => 'h2',
				'toggle'      => false,
			]
		);

		$this->add_control(
			'layout_one_summary_text',
			[
				'label' => esc_html__('Summary Text', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add Summary Text', 'noxfolio-toolkit'),
				'default' => esc_html__('Default Summary Text', 'noxfolio-toolkit'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'widget_content',
			[
				'label' => esc_html__('General', 'noxfolio-toolkit'),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__('Title Tag', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'h2' => [
						'title' => esc_html__('H2', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h2',
					],
					'h3' => [
						'title' => esc_html__('H3', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => esc_html__('H4', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => esc_html__('H5', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => esc_html__('H6', 'noxfolio-toolkit'),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default'     => 'h4',
				'toggle'      => false,
			]
		);

		$this->add_control(
			'title_word',
			[
				'label'   => esc_html__('Title Length', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'        => esc_html__('Show Excerpt?', 'noxfolio-toolkit'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off'    => esc_html__('No', 'noxfolio-toolkit'),
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_count',
			[
				'label'     => esc_html__('Excerpt Word', 'noxfolio-toolkit'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 12,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label'        => esc_html__('Show Read More', 'noxfolio-toolkit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off'    => esc_html__('No', 'noxfolio-toolkit'),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label'     => esc_html__('Read More Text', 'noxfolio-toolkit'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Read More', 'noxfolio-toolkit'),
				'condition' => [
					'show_read_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'read_more_icon',
			[
				'label'       => esc_html__('Read More Icon', 'noxfolio-toolkit'),
				'label_block' => false,
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default'     => [
					'value'   => 'fal fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'show_thumbnail',
			[
				'label'        => esc_html__('Show Thumbnail?', 'noxfolio-toolkit'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off'    => esc_html__('No', 'noxfolio-toolkit'),
				'default'      => 'yes',
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'post_thumbnail',
				'default'   => 'large',
				'exclude'   => [
					'custom',
				],
				'condition' => [
					'show_thumbnail' => 'yes',
				],
			]
		);


		$this->add_control(
			'column_size',
			[
				'label'                => esc_html__('Set Column Base On Bootstrap', 'noxfolio-toolkit'),
				'type'                 => \Elementor\Controls_Manager::SELECT,
				'options'              => [
					'2' => esc_html__('2 column', 'noxfolio-toolkit'),
					'3' => esc_html__('3 column', 'noxfolio-toolkit'),
					'4' => esc_html__('4 column', 'noxfolio-toolkit'),
					'6' => esc_html__('6 column', 'noxfolio-toolkit'),
					'8' => esc_html__('8 column', 'noxfolio-toolkit'),
				],
				'default' => '4',
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six'],
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'query_content',
			[
				'label' => esc_html__('Query', 'noxfolio-toolkit'),
				'condition' => [
					'post_type' => 'cpt'
				]
			]
		);

		$this->add_control(
			'post_from',
			[
				'label'   => esc_html__('Post From', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'all'           => esc_html__('All Posts', 'noxfolio-toolkit'),
					'categories'    => esc_html__('Categories', 'noxfolio-toolkit'),
					'specific-post' => esc_html__('Specific Posts', 'noxfolio-toolkit'),
				],
				'default' => 'all',
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label'       => esc_html__('Select Posts', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post(),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_from' => 'specific-post',
				],
			]
		);

		$this->add_control(
			'cat_slugs',
			[
				'label'       => esc_html__('Select Categories', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_category(),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_from' => 'categories',
				],
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label'   => esc_html__('Limit Item', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'   => esc_html__('Order By', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ID'     => esc_html__('ID', 'noxfolio-toolkit'),
					'author' => esc_html__('Author', 'noxfolio-toolkit'),
					'title'  => esc_html__('Title', 'noxfolio-toolkit'),
					'date'   => esc_html__('Date', 'noxfolio-toolkit'),
					'rand'   => esc_html__('Random', 'noxfolio-toolkit'),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'sort_order',
			[
				'label'   => esc_html__('Sort Order', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__('Ascending', 'noxfolio-toolkit'),
					'DESC' => esc_html__('Descending', 'noxfolio-toolkit'),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'        => esc_html__('Show Pagination', 'noxfolio-toolkit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off'    => esc_html__('No', 'noxfolio-toolkit'),
				'return_value' => 'yes',
				'condition'    => [
					'layout_type' => ['layout_six'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'custom_elementor_post_list',
			[
				'label' => esc_html__('Post With Elementor ', 'noxfolio-toolkit'),
				'condition' => [
					'post_type' => 'elementor-field'
				]
			]
		);

		$layout_one_post_list = new \Elementor\Repeater();

		$layout_one_post_list->add_control(
			'select_post',
			[
				'label'       => esc_html__('Select Post', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post('post'),
				'label_block' => true,
			]
		);

		$layout_one_post_list->add_control(
			'title',
			[
				'label' => esc_html__('Custom Title', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '2',
				'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
				'default' => esc_html__('Website Development', 'noxfolio-toolkit'),
				'description' => esc_html__('Keep empty to use default title', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);


		$layout_one_post_list->add_control(
			'image',
			[
				'label' => esc_html__('image', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [],
			]
		);

		$this->add_control(
			'layout_one_post_list',
			[
				'label' => esc_html__('Post List', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $layout_one_post_list->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five'],
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->end_controls_section();

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title,{{WRAPPER}} .wt-section-4-title', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
		noxfolio_elementor_style_options($this, 'Section Summary Text', '{{WRAPPER}} .wt-section-paragraph,{{WRAPPER}} .wt-portfolio-4-top-paragraph', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);

		noxfolio_elementor_style_options($this, 'Post Title', '{{WRAPPER}} .wt-blog-title a,{{WRAPPER}} .wt-blog-4-title a', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five']);
		noxfolio_elementor_style_options($this, 'Post Meta', '{{WRAPPER}} .wt-blog-meta span, {{WRAPPER}} .wt-blog-meta span a, {{WRAPPER}} .wt-blog-4-meta', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('recent-post-new-one.php');
		include nt_get_elementor_template('recent-post-new-two.php');
	}
}
