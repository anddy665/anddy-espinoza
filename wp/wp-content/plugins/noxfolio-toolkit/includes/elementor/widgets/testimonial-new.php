<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Testimonial_New extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-testimonial-new';
	}

	public function get_title()
	{
		return esc_html__('Testimonial New', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-testimonial webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'testimonial new'];
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

		include nt_get_elementor_option('testimonial-new-one-option.php');
		include nt_get_elementor_option('testimonial-new-two-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Section Title', '{{WRAPPER}} .wt-section-title,{{WRAPPER}} .wt-section-4-title', ['layout_one', 'layout_two', 'layout_five']);

		noxfolio_elementor_style_options($this, 'Name', '{{WRAPPER}} .wt-testimonial-name,{{WRAPPER}} .wt-testimonial-2-name .wt-testimonial-2-review h4, {{WRAPPER}} .wt-testimonial-2-name-title,{{WRAPPER}} .wt-testimonial-3-name-title', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Designation', '{{WRAPPER}} .designation,{{WRAPPER}} .wt-testimonial-2-name-title,{{WRAPPER}} .wt-testimonial-3-name-paragraph', ['layout_two']);
		noxfolio_elementor_style_options($this, 'Testimonial', '{{WRAPPER}} .wt-testimonial-paragraph,{{WRAPPER}} .wt-testimonial-2-paragraph,{{WRAPPER}} .wt-testimonial-2-paragraph', ['layout_one', 'layout_two']);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('testimonial-new-one.php');
		include nt_get_elementor_template('testimonial-new-two.php');
	}
}
