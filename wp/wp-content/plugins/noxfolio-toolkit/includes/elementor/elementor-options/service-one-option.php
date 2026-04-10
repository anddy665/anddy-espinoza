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
		'default' => esc_html__('Default summary text', 'noxfolio-toolkit'),
	]
);


$layout_one_service_list = new \Elementor\Repeater();

$layout_one_service_list->add_control(
	'title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Technical SEO Audits', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_service_list->add_control(
	'description',
	[
		'label' => esc_html__('Description', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Description', 'noxfolio-toolkit'),
		'default' => esc_html__('Default description text', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_service_list->add_control(
	'url',
	[
		'label' => esc_html__('Url', 'noxfolio-toolkit'),
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

$layout_one_service_list->add_control(
	'icon',
	[
		'label' => __('Icon', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::ICONS,
		'default' => [
			'value' => 'flaticon-vector',
			'library' => 'custom-icon',
		],
	]
);

$this->add_control(
	'layout_one_service_list',
	[
		'label' => esc_html__('Service List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_service_list->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ title }}}',
	]
);

$layout_one_items = new \Elementor\Repeater();

$layout_one_items->add_control(
	'name',
	[
		'label' => esc_html__('Item Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('logo', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_items',
	[
		'label' => esc_html__('Item Name List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_items->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ name }}}',
	]
);



$this->end_controls_section();
