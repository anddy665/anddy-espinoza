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
		'default'     => 'h1',
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
	'layout_one_video_url',
	[
		'label' => esc_html__('Video Url', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Video Url', 'noxfolio-toolkit'),
		'default' => esc_html__('#', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_video_caption',
	[
		'label' => esc_html__('Video Caption', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Video Caption', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Video Caption', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_button_url',
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
	]
);

$layout_one_counter_list = new \Elementor\Repeater();

$layout_one_counter_list->add_control(
	'title',
	[
		'label' => esc_html__('Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add title', 'noxfolio-toolkit'),
		'default' => esc_html__('Project Complete', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$layout_one_counter_list->add_control(
	'number',
	[
		'label' => esc_html__('Number', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Number', 'noxfolio-toolkit'),
		'default' => esc_html__('8', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_counter_list->add_control(
	'symbol',
	[
		'label' => esc_html__('Symbol', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Symbol', 'noxfolio-toolkit'),
		'default' => esc_html__('k+', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$this->add_control(
	'layout_one_counter_list',
	[
		'label' => esc_html__('Fun fact List', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_counter_list->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ title }}}',
	]
);

$layout_one_social_icons = new \Elementor\Repeater();

$layout_one_social_icons->add_control(
	'text',
	[
		'label' => esc_html__('Social Network', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Network', 'noxfolio-toolkit'),
		'default' => esc_html__('facebook', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$layout_one_social_icons->add_control(
	'social_icon',
	[
		'label' => __('Select Icon', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::ICONS,
		'default' => [
			'value' => 'fab fa-facebook-f',
			'library' => 'brand',
		],
		'label_block' => true,
	]
);

$layout_one_social_icons->add_control(
	'social_url',
	[
		'label' => __('Add Url', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::URL,
		'placeholder' => __('#', 'noxfolio-toolkit'),
		'show_external' => false,
		'default' => [
			'url' => '#',
			'is_external' => false,
			'nofollow' => false,
		],
		'show_label' => false,
	]
);

$this->add_control(
	'layout_one_social_icons',
	[
		'label' => __('Social Icons', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_social_icons->get_controls(),
		'prevent_empty' => false,
		'default' => [
			[
				'social_url' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			],
		],
	]
);

$this->add_control(
	'layout_one_image',
	[
		'label' => esc_html__('Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);


$this->end_controls_section();
