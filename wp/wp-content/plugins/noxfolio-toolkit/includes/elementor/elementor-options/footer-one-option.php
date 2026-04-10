<?php

//content
$this->start_controls_section(
	'layout_one_section_content',
	[
		'label' => esc_html__('Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_one'
		]
	]
);

$this->add_control(
	'layout_one_sec_title',
	[
		'label' => esc_html__('Section Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Section Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Section Title', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_email_title',
	[
		'label' => esc_html__('Email Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Email Title', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_email_address',
	[
		'label' => esc_html__('Email Address', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Address', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Email Address', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_email_url',
	[
		'label' => esc_html__('Email Url', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Address', 'noxfolio-toolkit'),
		'default' => esc_html__('mailto:support-noxfolio@gmail.com', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_menu_title',
	[
		'label' => esc_html__('Menu Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Menu Title', 'noxfolio-toolkit'),
		'default' => esc_html__('menu', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_menus = new \Elementor\Repeater();

$layout_one_menus->add_control(
	'name',
	[
		'label' => esc_html__('Menu Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Menu Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Home', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_menus->add_control(
	'url',
	[
		'label' => esc_html__('Add Url', 'noxfolio-toolkit'),
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

$this->add_control(
	'layout_one_menus',
	[
		'label' => __('Menus', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_menus->get_controls(),
		'prevent_empty' => false,
	]
);

$this->add_control(
	'layout_one_menu_icon',
	[
		'label' => esc_html__('Menu Icon Image', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
	]
);

$layout_one_social_icons = new \Elementor\Repeater();

$layout_one_social_icons->add_control(
	'name',
	[
		'label' => esc_html__('Social Network Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Social Network Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Facebook', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_social_icons->add_control(
	'social_icon',
	[
		'label' => esc_html__('Select Icon', 'noxfolio-toolkit'),
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
		'label' => esc_html__('Add Url', 'noxfolio-toolkit'),
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

$this->add_control(
	'layout_one_social_icons',
	[
		'label' => __('Social Networks', 'noxfolio-toolkit'),
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
	'layout_one_sliding_text',
	[
		'label' => esc_html__('Sliding Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Sliding Text', 'noxfolio-toolkit'),
		'default' => esc_html__('noxfolio modern agency', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_copyright_text',
	[
		'label' => esc_html__('Copyright Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Copyright Text', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Copyright Text', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_shape',
	[
		'label' => esc_html__('Shape', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [],
	]
);


$this->end_controls_section();
