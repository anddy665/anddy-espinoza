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


$layout_one_testimonial = new \Elementor\Repeater();

$layout_one_testimonial->add_control(
	'name',
	[
		'label' => esc_html__('Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Randall J. Ferguson', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_testimonial->add_control(
	'designation',
	[
		'label' => esc_html__('Designation', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Designation', 'noxfolio-toolkit'),
		'default' => esc_html__('/CEO & Founder', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_testimonial->add_control(
	'tagline',
	[
		'label' => esc_html__('Tagline', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Designation', 'noxfolio-toolkit'),
		'default' => esc_html__('Excellent Work', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_testimonial->add_control(
	'testimonial',
	[
		'label' => esc_html__('Testimonial Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Testimonial', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Content', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_testimonial->add_control(
	'rating',
	[
		'label' => esc_html__('Average Rating', 'noxfolio-addon'),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'size_units' => ['count'],
		'range' => [
			'count' => [
				'min' => 1,
				'max' => 5,
				'step' => 1,
			],
		],
		'default' => [
			'unit' => 'count',
			'size' => 5,
		],
	]
);

$layout_one_testimonial->add_control(
	'image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
		'description' => esc_html__('Image size should be 80*80 px', 'noxfolio-toolkit'),
	]
);


$this->add_control(
	'layout_one_testimonial',
	[
		'label' => esc_html__('Testimonial List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_testimonial->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ name }}}',
	]
);

$layout_one_other_images = new \Elementor\Repeater();

$layout_one_other_images->add_control(
	'image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
		'description' => esc_html__('Image size should be 80*80 px', 'noxfolio-toolkit'),
	]
);

$this->add_control(
	'layout_one_other_images',
	[
		'label' => esc_html__('Other Images', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_other_images->get_controls(),
		'prevent_empty' => false,
	]
);

$this->end_controls_section();
