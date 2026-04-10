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
	'layout_one_client_image',
	[
		'label' => esc_html__('Client Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::GALLERY,
		'default' => [],
	]
);

$this->add_control(
	'layout_one_client_caption',
	[
		'label' => esc_html__('Client Caption', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Client Caption', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Client Caption', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_button_url',
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
		'show_label' => true,
	]
);

$this->end_controls_section();

$this->start_controls_section(
	'layout_one_section_image',
	[
		'label' => esc_html__('Images', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_one'
		]
	]
);

$this->add_control(
	'layout_one_image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
	]
);


$this->end_controls_section();
