<?php

//content
$this->start_controls_section(
	'layout_two_section_content',
	[
		'label' => esc_html__('Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_two'
		]
	]
);

$this->add_control(
	'layout_two_sec_title',
	[
		'label' => esc_html__('Section Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Section Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Section Title', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_email_title',
	[
		'label' => esc_html__('Email Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Email Title', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_email_address',
	[
		'label' => esc_html__('Email Address', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Address', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Email Address', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_email_url',
	[
		'label' => esc_html__('Email Url', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Email Address', 'noxfolio-toolkit'),
		'default' => esc_html__('mailto:support-noxfolio@gmail.com', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_call_title',
	[
		'label' => esc_html__('Call Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Call Title', 'noxfolio-toolkit'),
		'default' => esc_html__('need helps?', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_call_number',
	[
		'label' => esc_html__('Call Number', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Call Number', 'noxfolio-toolkit'),
		'default' => esc_html__('+000 (123) 456 88 99', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_two_call_url',
	[
		'label' => esc_html__('Call Url', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Call Number', 'noxfolio-toolkit'),
		'default' => esc_html__('tel:+0001234568899', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$layout_two_social_icons = new \Elementor\Repeater();

$layout_two_social_icons->add_control(
	'name',
	[
		'label' => esc_html__('Social Network Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add Social Network Name', 'noxfolio-toolkit'),
		'default' => esc_html__('Facebook', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_two_social_icons->add_control(
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

$layout_two_social_icons->add_control(
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
	'layout_two_social_icons',
	[
		'label' => __('Social Networks', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_two_social_icons->get_controls(),
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
	'layout_two_copyright_text',
	[
		'label' => esc_html__('Copyright Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Copyright Text', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Copyright Text', 'noxfolio-toolkit'),
		'label_block' => true
	]
);


$this->end_controls_section();

//content
$this->start_controls_section(
	'layout_two_contact_content',
	[
		'label' => esc_html__('Contact Form', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => 'layout_two'
		]
	]
);

$this->add_control(
	'layout_two_contact_title',
	[
		'label' => esc_html__('Contact Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'placeholder' => esc_html__('Add Contact Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Default Title', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$this->add_control(
	'layout_one_select_cf7_form',
	[
		'label' => esc_html__('Select your Metform   form', 'noxfolio-addon'),
		'label_block' => true,
		'type' => \Elementor\Controls_Manager::SELECT,
		'options' => nt_select_post('metform-form'),
	]
);

$this->end_controls_section();
