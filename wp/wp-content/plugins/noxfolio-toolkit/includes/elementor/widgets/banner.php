<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Banner extends Widget_Base
{
	public function get_name()
	{
		return 'noxfolio-banner';
	}

	public function get_title()
	{
		return esc_html__('Banner', 'noxfolio-toolkit');
	}

	public function get_icon()
	{
		return 'eicon-banner webtend-logo';
	}

	public function get_categories()
	{
		return ['noxfolio_elements'];
	}

	public function get_keywords()
	{
		return ['noxfolio', 'toolkit', 'webtend', 'section', 'banner'];
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

		include nt_get_elementor_option('banner-one-option.php');
		include nt_get_elementor_option('banner-two-option.php');

		//Content style
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Content Style', 'noxfolio-toolkit'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		noxfolio_elementor_style_options($this, 'Title', '{{WRAPPER}} .wt-hero-title,{{WRAPPER}} .wt-hero-2-title,{{WRAPPER}} .wt-hero-3-title,{{WRAPPER}} .wt-about-inr-hero-title,{{WRAPPER}} .wt-service-hero-title,{{WRAPPER}} .wt-hero-4-title', ['layout_one', 'layout_two']);
		noxfolio_elementor_style_options($this, 'Summary Text', '{{WRAPPER}} .wt-hero-paragraph,{{WRAPPER}} .wt-hero-2-wrap-paragaraph,{{WRAPPER}} .wt-hero-3-top-paragraph,{{WRAPPER}} .wt-service-hero-paragraph,{{WRAPPER}} .wt-hero-4-paragraph', ['layout_one', 'layout_two']);

		noxfolio_elementor_style_options($this, 'Video Caption', '{{WRAPPER}} .wt-hero-3-play-btn p', ['layout_one']);
		noxfolio_elementor_style_options($this, 'Fun Fact Title', '{{WRAPPER}} .wt-team-counter-paragraph', ['layout_one']);
		noxfolio_elementor_style_options($this, 'Fun Fact Count', '{{WRAPPER}} .wt-team-counter-title', ['layout_one']);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		include nt_get_elementor_template('banner-one.php');
		include nt_get_elementor_template('banner-two.php');
	}
}
