<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Widget_Base;

class Footer extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-footer';
	}

	public function get_title()
	{
		return esc_html__('Footer', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-footer webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'top', 'footer'];
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

		include nt_get_elementor_option('footer-one-option.php');
		include nt_get_elementor_option('footer-two-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
		noxfolio_elementor_style_options($this, 'Email Title', '{{WRAPPER}} .wt-footer-widget-mail h6', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
		noxfolio_elementor_style_options($this, 'Email Address', '{{WRAPPER}} .wt-footer-widget-mail a', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
		noxfolio_elementor_style_options($this, 'Copyright', '{{WRAPPER}} .wt-footer-copyright-pagaraph', ['layout_one', 'layout_two', 'layout_three', 'layout_four']);
		noxfolio_elementor_style_options($this, 'Logo Caption', '{{WRAPPER}} .wt-footer-content p', ['layout_one']);
		noxfolio_elementor_style_options($this, 'Menu Title', '{{WRAPPER}} .wt-header-menu ul li a', ['layout_one']);
		noxfolio_elementor_style_options($this, 'Sliding Text', '{{WRAPPER}} .wt-about-bottom-content .wt-about-title', ['layout_one']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('footer-one.php');
		include nt_get_elementor_template('footer-two.php');
	}
}
