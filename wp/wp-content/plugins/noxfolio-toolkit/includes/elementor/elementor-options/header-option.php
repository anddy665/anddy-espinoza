<?php

$this->start_controls_section(
	'logo_section',
	[
		'label' => __('Site Logo', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	]
);

$this->add_control(
	'logo',
	[
		'label' => __('Logo', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);

$this->add_control(
	'logo_size',
	[
		'label' => __('Logo Size', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
		'description' => __('Set Logo Size.', 'noxfolio-toolkit'),
		'default' => [
			'width' => '123',
			'height' => '35',
		],
	]
);

$this->end_controls_section();

$this->start_controls_section(
	'nav_section',
	[
		'label' => __('Navigation', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	]
);

$this->add_control(
	'nav_menu',
	[
		'label'     => esc_html__('Select Menu', 'noxfolio-toolkit'),
		'type'      => \Elementor\Controls_Manager::SELECT,
		'options'   => $this->get_menus_list(),
	]
);

$this->end_controls_section();


$this->start_controls_section(
	'other_settings',
	[
		'label' => esc_html__('Other Settings', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	]
);

$this->add_control(
	'menu_title',
	[
		'label' => esc_html__('Menu Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Menu', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$this->add_control(
	'button_label',
	[
		'label' => esc_html__('Button Label', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Inquiries', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$this->add_control(
	'button_url',
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

$this->add_control(
	'social_title',
	[
		'label' => esc_html__('Social Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Social', 'noxfolio-toolkit'),
		'label_block' => true,
		'condition' => [
			'layout_type' => 'layout_one'
		],
	]
);


$social_icons = new \Elementor\Repeater();

$social_icons->add_control(
	'name',
	[
		'label' => esc_html__('Social', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Facebook', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$social_icons->add_control(
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
	'social_icons',
	[
		'label' => __('Social Networks', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $social_icons->get_controls(),
		'prevent_empty' => false,
		'condition' => [
			'layout_type' => 'layout_one'
		],
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
	'email_address',
	[
		'label' => esc_html__('Email Address', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('hello-noxfolio@gmail.com', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);


$this->end_controls_section();

$this->start_controls_section(
	'popup_settings',
	[
		'label' => esc_html__('Popup Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => ['layout_two', 'layout_one'],
		],
	]
);

$this->add_control(
	'popup_close_text',
	[
		'label' => esc_html__('Close Button Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Close', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$popup_social_icons = new \Elementor\Repeater();

$popup_social_icons->add_control(
	'name',
	[
		'label' => esc_html__('Name', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'placeholder' => esc_html__('Add title', 'noxfolio-toolkit'),
		'default' => esc_html__('Facebook', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$popup_social_icons->add_control(
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

$popup_social_icons->add_control(
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
	'popup_social_icons',
	[
		'label' => __('Social Networks', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $popup_social_icons->get_controls(),
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
	'popup_contact_title',
	[
		'label' => esc_html__('Contact Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Contact Us', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$popup_contact_info = new \Elementor\Repeater();

$popup_contact_info->add_control(
	'content',
	[
		'label' => esc_html__('Contact Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Content', 'noxfolio-toolkit'),
		'default' => wp_kses_post(__('<a href="https://www.google.com/maps/@23.8223586,90.3661283,15z" target="_blank">Manchester 21, Zurich, CH</a>', 'noxfolio-toolkit')),
		'label_block' => true
	]
);

$popup_contact_info->add_control(
	'icon',
	[
		'label' => __('Icon', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::ICONS,
		'default' => [
			'value' => 'fa fa-location-dot',
			'library' => 'custom-icon',
		],
	]
);

$this->add_control(
	'popup_contact_info',
	[
		'label' => esc_html__('Contact Info', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $popup_contact_info->get_controls(),
		'prevent_empty' => false,
	]
);

$this->add_control(
	'popup_logo',
	[
		'label' => __('Logo', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);

$this->add_control(
	'popup_logo_size',
	[
		'label' => __('Logo Size', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
		'description' => __('Set Logo Size.', 'noxfolio-toolkit'),
		'default' => [
			'width' => '90',
			'height' => '38',
		],
	]
);

$this->end_controls_section();

$this->start_controls_section(
	'mobile_menu_settings',
	[
		'label' => esc_html__('Mobile Menu Content', 'noxfolio-toolkit'),
		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		'condition' => [
			'layout_type' => ['layout_three', 'layout_four', 'layout_five'],
		],
	]
);

$this->add_control(
	'mobile_menu_summary_text',
	[
		'label' => esc_html__('Summary Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Add Summary Text', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$mobile_menu_social_icons = new \Elementor\Repeater();

$mobile_menu_social_icons->add_control(
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

$mobile_menu_social_icons->add_control(
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
	'mobile_menu_social_icons',
	[
		'label' => __('Social Networks', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $mobile_menu_social_icons->get_controls(),
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
	'mobile_menu_contact_title',
	[
		'label' => esc_html__('Contact Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Contact Us', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$mobile_menu_contact_info = new \Elementor\Repeater();

$mobile_menu_contact_info->add_control(
	'content',
	[
		'label' => esc_html__('Contact Content', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXTAREA,
		'rows' => '2',
		'placeholder' => esc_html__('Add Content', 'noxfolio-toolkit'),
		'default' => wp_kses_post(__('<a href="https://www.google.com/maps/@23.8223586,90.3661283,15z" target="_blank">Manchester 21, Zurich, CH</a>', 'noxfolio-toolkit')),
		'label_block' => true
	]
);

$mobile_menu_contact_info->add_control(
	'icon',
	[
		'label' => __('Icon', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::ICONS,
		'default' => [
			'value' => 'fa fa-location-dot',
			'library' => 'custom-icon',
		],
	]
);

$this->add_control(
	'mobile_menu_contact_info',
	[
		'label' => esc_html__('Contact Info', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $mobile_menu_contact_info->get_controls(),
		'prevent_empty' => false,
	]
);

$this->add_control(
	'mobile_menu_logo',
	[
		'label' => __('Logo', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => \Elementor\Utils::get_placeholder_image_src(),
		],
	]
);

$this->add_control(
	'mobile_menu_logo_size',
	[
		'label' => __('Logo Size', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
		'description' => __('Set Logo Size.', 'noxfolio-toolkit'),
		'default' => [
			'width' => '90',
			'height' => '38',
		],
	]
);

$this->add_control(
	'mobile_menu_subscribe_title',
	[
		'label' => esc_html__('Subscribe Title', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__('Get Update', 'noxfolio-toolkit'),
		'label_block' => true,
	]
);

$this->end_controls_section();
