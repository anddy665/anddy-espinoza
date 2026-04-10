<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Widget_Base;

class Sponsors extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-sponsors';
	}

	public function get_title()
	{
		return esc_html__('Sponsors', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-slider-album webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'sponsors', 'slider'];
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
					'layout_two' => __('Layout Two', 'noxfolio-toolkit'),
				]
			]
		);

		$this->end_controls_section();

		include nt_get_elementor_option('sponsors-one-option.php');
		include nt_get_elementor_option('sponsors-two-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .sec-title, .client-logo-wrap h6', ['layout_one', 'layout_two', 'layout_three']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include nt_get_elementor_template('sponsors-one.php');
		include nt_get_elementor_template('sponsors-two.php');
	}
}
