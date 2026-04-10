<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Widget_Base;

class Service extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-service';
	}

	public function get_title()
	{
		return esc_html__('Services', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-flow webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'Service'];
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

		include nt_get_elementor_option('service-one-option.php');
		include nt_get_elementor_option('service-two-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title,{{WRAPPER}} .wt-section-4-title', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Section Summary Text', '{{WRAPPER}} .wt-section-paragraph,{{WRAPPER}} .wt-section-4-paragraph', ['layout_one', 'layout_two']);

		noxfolio_elementor_style_options($this, 'Service Title', '{{WRAPPER}} .wt-service-number h4,{{WRAPPER}} .wt-service-bottom-title, {{WRAPPER}} .wt-service-3-title a, {{WRAPPER}} .wt-service-4-title a', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Service Description', '{{WRAPPER}} .wt-service-3-paragraph, {{WRAPPER}} .wt-service-4-paragraph', ['layout_one', 'layout_two']);


		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		include nt_get_elementor_template('service-one.php');
		include nt_get_elementor_template('service-two.php');
	}
}
