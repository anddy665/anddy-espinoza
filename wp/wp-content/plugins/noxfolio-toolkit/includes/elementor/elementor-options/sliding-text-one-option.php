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

$layout_one_sliding_text = new \Elementor\Repeater();

$layout_one_sliding_text->add_control(
	'text',
	[
		'label' => esc_html__('Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'rows' => '2',
		'placeholder' => esc_html__('Add Title', 'noxfolio-toolkit'),
		'default' => esc_html__('Video Marketing', 'noxfolio-toolkit'),
		'label_block' => true
	]
);

$layout_one_sliding_text->add_control(
	'icon',
	[
		'label' => __('Icon', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::ICONS,
		'default' => [
			'value' => 'flaticon-asterisk',
			'library' => 'custom-icon',
		],
	]
);

$this->add_control(
	'layout_one_sliding_text',
	[
		'label' => esc_html__('Sliding Text', 'noxfolio-toolkit'),
		'type' => \Elementor\Controls_Manager::REPEATER,
		'fields' => $layout_one_sliding_text->get_controls(),
		'prevent_empty' => false,
		'title_field' => '{{{ text }}}',
	]
);


$this->end_controls_section();
