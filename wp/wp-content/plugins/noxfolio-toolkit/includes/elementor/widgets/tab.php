<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Tab extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-tab';
	}

	public function get_title()
	{
		return esc_html__('Tab', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-tabs webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'tab'];
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

		include nt_get_elementor_option('tab-one-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Summary Text', '{{WRAPPER}} .wt-section-paragraph', ['layout_one', 'layout_two']);

		noxfolio_elementor_style_options($this, 'Tab Heading', '{{WRAPPER}} .nav-tabs .nav-link', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Active Tab Heading', '{{WRAPPER}} .nav-tabs .nav-link.active', ['layout_two']);
		noxfolio_elementor_style_options($this, 'Tab Title', '{{WRAPPER}} .wt-resume-2-tab-title, {{WRAPPER}} .wt-experience-3-title', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Tab Info', '{{WRAPPER}} .wt-resume-2-tab-subtitle', ['layout_one']);
		noxfolio_elementor_style_options($this, 'Tab Description', '{{WRAPPER}} .wt-resume-2-tab-paragraph, {{WRAPPER}} .wt-experience-3-bottom-paragraph', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Tab Date', '{{WRAPPER}} .wt-resume-2-tab-date span, {{WRAPPER}} .wt-experience-3-top-left p', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Company Name', '{{WRAPPER}} .wt-experience-3-top-right span', ['layout_two']);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('tab-one.php');
	}
}
