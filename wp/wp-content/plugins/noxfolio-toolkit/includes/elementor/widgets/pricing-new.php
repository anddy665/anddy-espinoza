<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Pricing_New extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-pricing-new';
	}

	public function get_title()
	{
		return esc_html__('Pricing New', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-about webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'pricing new'];
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

		include nt_get_elementor_option('pricing-new-one-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title', ['layout_one', 'layout_two', 'layout_three']);
		noxfolio_elementor_style_options($this, 'Summary Text', '{{WRAPPER}} .wt-section-paragraph,{{WRAPPER}} .wt-portfolio-3-top-paragraph p', ['layout_one', 'layout_two', 'layout_three']);

		noxfolio_elementor_style_options($this, 'Pricing Title', '{{WRAPPER}} .wt-pricing-2-subtitle', ['layout_one', 'layout_two', 'layout_three']);
		noxfolio_elementor_style_options($this, 'Pricing Description', '{{WRAPPER}} .wt-pricing-2-paragraph', ['layout_two']);
		noxfolio_elementor_style_options($this, 'Price', '{{WRAPPER}} .wt-pricing-2-title', ['layout_one', 'layout_two', 'layout_three']);
		noxfolio_elementor_style_options($this, 'Features', '{{WRAPPER}} .wt-pricing-2-list ul li', ['layout_one', 'layout_two', 'layout_three']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('pricing-new-one.php');
	}
}
