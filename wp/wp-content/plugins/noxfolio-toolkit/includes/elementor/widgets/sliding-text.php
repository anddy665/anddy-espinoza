<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Widget_Base;

class Sliding_Text extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-sliding-text';
	}

	public function get_title()
	{
		return esc_html__('Sliding Text', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-slides webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'sliding', 'text'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __('Layout', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => __('Select Layout', 'noxfolio-toolkit'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'default' => 'layout_one',
				'options' => [
					'layout_one' => __('Layout One', 'noxfolio-toolkit'),
				]
			]
		);

		$this->end_controls_section();

		include nt_get_elementor_option('sliding-text-one-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Text', '{{WRAPPER}} .wt-maquee-3-title', ['layout_one']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include nt_get_elementor_template('sliding-text-one.php');
	}
}
