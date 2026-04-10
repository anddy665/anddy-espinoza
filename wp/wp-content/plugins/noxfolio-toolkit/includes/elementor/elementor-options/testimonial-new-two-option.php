<?php

//content
$this->start_controls_section(
	'layout_two_content',
	[
		'label' => esc_html__('Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_two'
		]
	]
);


$this->add_control(
	'layout_two_title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Title', 'noxfolio-toolkit'),
	]
);

$this->add_control(
	'layout_two_title_tag',
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



$layout_two_testimonial = new \Elementor\Repeater();

$layout_two_testimonial->add_control(
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


$layout_two_testimonial->add_control(
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

$layout_two_testimonial->add_control(
	'rating',
	[
		'label' => __('Average Rating', 'noxfolio-addon'),
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

$layout_two_testimonial->add_control(
	'image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
		'description' => esc_html__('Image size should be 80*80 px', 'noxfolio-toolkit'),
	]
);


$this->add_control(
	'layout_two_testimonial',
	[
		'label' => esc_html__('Testimonial List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_two_testimonial->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ name }}}',
	]
);

$this->end_controls_section();
