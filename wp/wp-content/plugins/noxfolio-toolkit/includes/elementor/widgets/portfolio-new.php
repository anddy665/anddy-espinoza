<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use NoxfolioToolkit\ElementorAddon\Templates\Portfolio as PortfolioTemplate;
use NoxfolioToolkit\ElementorAddon\Traits\Carousel_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Portfolio_New extends Widget_Base
{

	use Carousel_Helper;

	public function get_name()
	{
		return 'noxfolio-portfolio-new';
	}

	public function get_title()
	{
		return esc_html__('Portfolio New', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-gallery-grid webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'portfolio', 'project', 'portfolio-new'];
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
					'layout_three' => __('Layout Three', 'noxfolio-toolkit'),

				]
			]
		);

		$this->add_control(
			'portfolio_type',
			[
				'label'       => esc_html__('Portfolio Type', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'cpt'   => esc_html__('Custom Post Type', 'noxfolio-toolkit'),
					'elementor-field'   => esc_html__('With Elementor', 'noxfolio-toolkit'),
				],
				'default'     => 'cpt',
				'condition' => [
					'layout_type!' => ['layout_one']
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_header_section',
			[
				'label' => __('Header Section', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default'     => 'h3',
				'toggle'      => false,
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'title_word',
			[
				'label'   => esc_html__('Title Length', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__('Show Category', 'noxfolio-toolkit'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off'    => esc_html__('No', 'noxfolio-toolkit'),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'post_thumbnail',
				'default' => 'large',
				'condition' => [
					'portfolio_type' => 'cpt'
				],
				'exclude' => [
					'custom',
				],
			],

		);

		$this->add_control(
			'enable_filter',
			[
				'label' => esc_html__('Enable Filter', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'noxfolio-toolkit'),
				'label_off' => esc_html__('No', 'noxfolio-toolkit'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'layout_type' => 'layout_one'
				]
			]
		);

		$this->add_control(
			'show_all_text',
			[
				'label' => esc_html__('Show All Text', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('All Project', 'noxfolio-toolkit'),
				'label_block' => true,
				'condition' => [
					'enable_filter' => 'yes',
					'layout_type' => 'layout_one'
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'query_content',
			[
				'label' => esc_html__('Query', 'noxfolio-toolkit'),
				'condition' => [
					'portfolio_type' => 'cpt'
				]
			]
		);

		$this->add_control(
			'post_from',
			[
				'label'   => esc_html__('Portfolio From', 'noxfolio-toolkit'),
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
				'label'       => esc_html__('Select Portfolio', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post('noxfolio_portfolio'),
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
				'options'     => nt_select_category('noxfolio_portfolio_category'),
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
				'default' => 6,
				'min'     => 1,
			]
		);

		$this->add_control(
			'cat_limit',
			[
				'label'   => esc_html__('Limit Category', 'noxfolio-toolkit'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'custom_elementor_portfolio_list',
			[
				'label' => esc_html__('Portfolio With Elementor ', 'noxfolio-toolkit'),
				'condition' => [
					'portfolio_type' => 'elementor-field'
				]
			]
		);

		$layout_one_portfolio_list = new \Elementor\Repeater();

		$layout_one_portfolio_list->add_control(
			'select_portfolio',
			[
				'label'       => esc_html__('Select Portfolio', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post('noxfolio_portfolio'),
				'label_block' => true,
			]
		);

		$layout_one_portfolio_list->add_control(
			'title',
			[
				'label' => esc_html__('Custom Title', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '2',
				'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
				'default' => esc_html__('website', 'noxfolio-toolkit'),
				'description' => esc_html__('Keep empty to use default title', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);


		$layout_one_portfolio_list->add_control(
			'image',
			[
				'label' => esc_html__('image', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [],
			]
		);

		$this->add_control(
			'layout_one_portfolio_list',
			[
				'label' => esc_html__('Portfolio List', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $layout_one_portfolio_list->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'layout_type' => ['layout_one', 'layout_two', 'layout_six', 'layout_nine']
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$layout_two_portfolio_list = new \Elementor\Repeater();

		$layout_two_portfolio_list->add_control(
			'select_portfolio',
			[
				'label'       => esc_html__('Select Portfolio', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post('noxfolio_portfolio'),
				'label_block' => true,
			]
		);

		$layout_two_portfolio_list->add_control(
			'title',
			[
				'label' => esc_html__('Custom Title', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '2',
				'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
				'default' => esc_html__('website', 'noxfolio-toolkit'),
				'description' => esc_html__('Keep empty to use default title', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);

		$layout_two_portfolio_list->add_control(
			'summary_text',
			[
				'label' => esc_html__('Summary Text', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '2',
				'placeholder' => esc_html__('Add Summary Text', 'noxfolio-toolkit'),
				'default' => esc_html__('Default Summary Text', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);


		$layout_two_portfolio_list->add_control(
			'image',
			[
				'label' => esc_html__('image', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [],
			]
		);

		$this->add_control(
			'layout_two_portfolio_list',
			[
				'label' => esc_html__('Portfolio List', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $layout_two_portfolio_list->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'layout_type' => 'layout_five'
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$layout_three_portfolio_list = new \Elementor\Repeater();

		$layout_three_portfolio_list->add_control(
			'select_portfolio',
			[
				'label'       => esc_html__('Select Portfolio', 'noxfolio-toolkit'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post('noxfolio_portfolio'),
				'label_block' => true,
			]
		);

		$layout_three_portfolio_list->add_control(
			'title',
			[
				'label' => esc_html__('Custom Title', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '2',
				'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
				'default' => esc_html__('website', 'noxfolio-toolkit'),
				'description' => esc_html__('Keep empty to use default title', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);

		$layout_three_portfolio_list->add_control(
			'year',
			[
				'label' => esc_html__('Year', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => '2',
				'placeholder' => esc_html__('Add Year', 'noxfolio-toolkit'),
				'default' => esc_html__('2020-2022', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);

		$layout_three_portfolio_list->add_control(
			'company_name',
			[
				'label' => esc_html__('Company Name', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'rows' => '2',
				'placeholder' => esc_html__('Add Company Name', 'noxfolio-toolkit'),
				'default' => esc_html__('Microsoft', 'noxfolio-toolkit'),
				'label_block' => true
			]
		);


		$layout_three_portfolio_list->add_control(
			'image',
			[
				'label' => esc_html__('image', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [],
			]
		);

		$this->add_control(
			'layout_three_portfolio_list',
			[
				'label' => esc_html__('Portfolio List', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $layout_three_portfolio_list->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'layout_type' =>  ['layout_three']
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'more_portfolio_section',
			[
				'label' => esc_html__('More Portfolio Button', 'noxfolio-toolkit'),
				'condition' => [
					'layout_type' => ['layout_two']
				]
			]
		);

		$this->add_control(
			'more_portfolio_button_url',
			[
				'label' => esc_html__('Button Url', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__('#', 'noxfolio-toolkit'),
				'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'show_label' => false,
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

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-3-title,{{WRAPPER}} .wt-section-4-title', ['layout_one', 'layout_two', 'layout_three']);
		noxfolio_elementor_style_options($this, 'Summary Text', '{{WRAPPER}} .wt-portfolio-3-top-paragraph p,{{WRAPPER}} .wt-portfolio-4-top-paragraph, {{WRAPPER}} .wt-section-4-paragraph', ['layout_one', 'layout_two', 'layout_three']);

		noxfolio_elementor_style_options($this, 'Portfolio Title', '{{WRAPPER}} .wt-portfolio-3-title a, {{WRAPPER}} .wt-portfolio-4-title a, {{WRAPPER}} .wt-project-4-title', ['layout_one', 'layout_two', 'layout_three']);
		noxfolio_elementor_style_options($this, 'Portfolio Category', '{{WRAPPER}} .wt-portfolio-3-paragraph, {{WRAPPER}} .wt-portfolio-4-paragraph', ['layout_one', 'layout_two']);


		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('portfolio-new-one.php');
		include nt_get_elementor_template('portfolio-new-two.php');
		include nt_get_elementor_template('portfolio-new-three.php');

?>

<?php
	}
}
