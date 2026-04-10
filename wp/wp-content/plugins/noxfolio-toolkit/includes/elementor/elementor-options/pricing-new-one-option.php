<?php

//content
$this->start_controls_section(
	'layout_one_content',
	[
		'label' => esc_html__('Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_one'
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

$layout_one_pricing_list = new \Elementor\Repeater();

$layout_one_pricing_list->add_control(
	'plan_title',
	[
		'label' => esc_html__('Plan Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'default' => esc_html__('Basic Package', 'noxfolio-toolkit'),
	]
);

$layout_one_pricing_list->add_control(
	'url',
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

$layout_one_pricing_list->add_control(
	'price',
	[
		'label' => esc_html__('Price', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'label_block' => true,
		'default' => esc_html__('$380.00', 'noxfolio-toolkit'),
	]
);

// $layout_one_pricing_list->add_control(
// 	'description',
// 	[
// 		'label' => esc_html__('Description', 'noxfolio-toolkit'),
// 		'type' => \Elementor\Controls_Manager::TEXTAREA,
// 		'rows' => '2',
// 		'default' => esc_html__('Default Text', 'noxfolio-toolkit'),
// 	]
// );


$layout_one_pricing_list->add_control(
	'service_list',
	[
		'label' => esc_html__('Service List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::CODE,
		'label_block' => true,
		'default' => wp_kses('<li><i class="flaticon-check-mark"></i>Custom page website design</li>
		<li><i class="flaticon-check-mark"></i>Responsive design</li>
		<li><i class="flaticon-check-mark"></i>Basic SEO setup</li>
		<li><i class="flaticon-check-mark"></i>Contact form integration</li>
		<li><i class="flaticon-check-mark"></i>Social media links integration</li>
		<li><i class="flaticon-check-mark"></i>2 revisions included</li>', array('li' => array()))
	]
);



$this->add_control(
	'layout_one_pricing_list',
	[
		'label' => esc_html__('Pricing List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_pricing_list->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ plan_title }}}',
	]
);

$this->end_controls_section();
