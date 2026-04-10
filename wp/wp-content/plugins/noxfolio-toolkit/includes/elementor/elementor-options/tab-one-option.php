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

$this->add_control(
	'layout_one_tab_one_name',
	[
		'label' => esc_html__('Tab One Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Tab One Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Experience', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_one_content = new \Elementor\Repeater();

$layout_one_tab_one_content->add_control(
	'title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Senior web Developer', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_one_content->add_control(
	'company_name',
	[
		'label' => esc_html__('Company Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Google', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_one_content->add_control(
	'description',
	[
		'label' => esc_html__('Description', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Description', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Description', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_one_content->add_control(
	'date',
	[
		'label' => esc_html__('Description', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Date', 'noxfolio-toolkit'),
		'default' => esc_html__('2018-2021', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$this->add_control(
	'layout_one_tab_one_content',
	[
		'label' => esc_html__('Tab One Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_tab_one_content->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ title }}}',
	]
);

$this->add_control(
	'layout_one_tab_two_name',
	[
		'label' => esc_html__('Tab Two Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Two Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Skill & Tools', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$layout_one_tab_two_content = new \Elementor\Repeater();

$layout_one_tab_two_content->add_control(
	'title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Html', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_two_content->add_control(
	'number',
	[
		'label' => esc_html__('Number', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Number', 'noxfolio-toolkit'),
		'default' => esc_html__('95', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_two_content->add_control(
	'symbol',
	[
		'label' => esc_html__('Symbol', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Symbol', 'noxfolio-toolkit'),
		'default' => esc_html__('%', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$layout_one_tab_two_content->add_control(
	'image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);


$this->add_control(
	'layout_one_tab_two_content',
	[
		'label' => esc_html__('Tab Two Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_tab_two_content->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ title }}}',
	]
);

$this->add_control(
	'layout_one_tab_three_name',
	[
		'label' => esc_html__('Tab Three Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Tab Three Name', 'noxfolio-toolkit'),
		'default' => esc_html__('win awards', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_three_content = new \Elementor\Repeater();

$layout_one_tab_three_content->add_control(
	'title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Senior web Developer', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_three_content->add_control(
	'company_name',
	[
		'label' => esc_html__('Company Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Google', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_three_content->add_control(
	'description',
	[
		'label' => esc_html__('Description', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Description', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Description', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_tab_three_content->add_control(
	'date',
	[
		'label' => esc_html__('Description', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Date', 'noxfolio-toolkit'),
		'default' => esc_html__('2018-2021', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$this->add_control(
	'layout_one_tab_three_content',
	[
		'label' => esc_html__('Tab Three Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_tab_three_content->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ title }}}',
	]
);


$this->end_controls_section();

// $this->start_controls_section(
// 	'section_image_two',
// 	[
// 		'label' => esc_html__('Images', 'noxfolio-toolkit'),
// 		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
// 		'condition' => [
// 			'layout_type' => 'layout_one'
// 		]
// 	]
// );

// $this->add_control(
// 	'layout_one_image',
// 	[
// 		'label' => esc_html__('Image', 'noxfolio-toolkit'),
// 		'type' => \Elementor\Controls_Manager::MEDIA,
// 		'default' => [
// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
// 		],
// 	]
// );

// $this->add_control(
// 	'layout_one_shape',
// 	[
// 		'label' => esc_html__('Shape', 'noxfolio-toolkit'),
// 		'type' => \Elementor\Controls_Manager::MEDIA,
// 		'default' => [],
// 	]
// );

// $this->end_controls_section();
