<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use NoxfolioToolkit\ElementorAddon\Templates\Portfolio_Template;

defined( 'ABSPATH' ) || exit;

class Portfolio extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'noxfolio-portfolio';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Portfolio', 'noxfolio-toolkit' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-posts-grid webtend-logo';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that Currently, Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'noxfolio_elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'noxfolio', 'toolkit', 'webtend', 'portfolio', 'project', 'recent', 'work' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'Portfolio', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'portfolio_design',
			[
				'label'       => esc_html__( 'Design', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'design-one'   => esc_html__( 'Design One', 'noxfolio-toolkit' ),
					'design-two'   => esc_html__( 'Design Two', 'noxfolio-toolkit' ),
					'design-three' => esc_html__( 'Design Three', 'noxfolio-toolkit' ),
					'design-four'  => esc_html__( 'Design Four', 'noxfolio-toolkit' ),
				],
				'default'     => 'design-one',
			]
		);

		$this->add_control(
			'title_word',
			[
				'label'   => esc_html__( 'Title Word', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'step'    => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'       => esc_html__( 'HTML Tag', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'h3' => [
						'title' => esc_html__( 'H3', 'noxfolio-toolkit' ),
						'icon'  => 'eicon-editor-h3',
					],
					'h4' => [
						'title' => esc_html__( 'H4', 'noxfolio-toolkit' ),
						'icon'  => 'eicon-editor-h4',
					],
					'h5' => [
						'title' => esc_html__( 'H5', 'noxfolio-toolkit' ),
						'icon'  => 'eicon-editor-h5',
					],
					'h6' => [
						'title' => esc_html__( 'H6', 'noxfolio-toolkit' ),
						'icon'  => 'eicon-editor-h6',
					],
				],
				'default'     => 'h4',
				'toggle'      => false,
			]
		);

		$this->add_control(
			'show_category',
			[
				'label'        => esc_html__( 'Show Category', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_arrow_link',
			[
				'label'        => esc_html__( 'Show Arrow Link', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'portfolio_design!' => 'design-two',
				],
			]
		);

		$this->add_control(
			'use_thumbnail_url',
			[
				'label'        => esc_html__( 'Use Thumbnail as URL', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'        => esc_html__( 'Show Excerpt', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->add_control(
			'excerpt_word',
			[
				'label'     => esc_html__( 'Excerpt Word', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'default'   => 12,
				'condition' => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'default' => 'large',
				'exclude' => [
					'custom',
				],
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'                => esc_html__( 'Grid Column', 'noxfolio-toolkit' ),
				'type'                 => Controls_Manager::SELECT,
				'options'              => [
					''  => esc_html__( 'Default', 'noxfolio-toolkit' ),
					'1' => esc_html__( '1 column', 'noxfolio-toolkit' ),
					'2' => esc_html__( '2 column', 'noxfolio-toolkit' ),
					'3' => esc_html__( '3 column', 'noxfolio-toolkit' ),
					'4' => esc_html__( '4 column', 'noxfolio-toolkit' ),
				],
				'default'              => '',
				'tablet_extra_default' => '',
				'tablet_default'       => '',
				'mobile_default'       => '',
				'separator'            => 'before',
				'selectors'            => [
					'{{WRAPPER}} .noxfolio-portfolio-items' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
				],
				'condition'            => [
					'portfolio_design!' => 'design-four',
				],
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'     => esc_html__( 'Source', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_from', [
				'label'   => esc_html__( 'Portfolio From', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'all'           => esc_html__( 'All Portfolio', 'noxfolio-toolkit' ),
					'categories'    => esc_html__( 'Categories', 'noxfolio-toolkit' ),
					'specific-post' => esc_html__( 'Specific Portfolio', 'noxfolio-toolkit' ),
				],
				'default' => 'all',
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label'       => esc_html__( 'Select Portfolio', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_post( 'noxfolio_portfolio' ),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_from' => 'specific-post',
				],
			]
		);

		$this->add_control(
			'cat_slugs',
			[
				'label'       => esc_html__( 'Select Categories', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => nt_select_category( 'noxfolio_portfolio_category' ),
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'post_from' => 'categories',
				],
			]
		);

		$this->add_control(
			'post_limit', [
				'label'   => esc_html__( 'Limit Item', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 1,
			]
		);

		$this->add_control(
			'order_by', [
				'label'   => esc_html__( 'Order By', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ID'     => esc_html__( 'ID', 'noxfolio-toolkit' ),
					'author' => esc_html__( 'Author', 'noxfolio-toolkit' ),
					'title'  => esc_html__( 'Title', 'noxfolio-toolkit' ),
					'date'   => esc_html__( 'Date', 'noxfolio-toolkit' ),
					'rand'   => esc_html__( 'Random', 'noxfolio-toolkit' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'sort_order', [
				'label'   => esc_html__( 'Sort Order', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'Ascending', 'noxfolio-toolkit' ),
					'DESC' => esc_html__( 'Descending', 'noxfolio-toolkit' ),
				],
				'default' => 'DESC',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'portfolio_style_section',
			[
				'label' => esc_html__( 'Portfolio Item', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label'      => esc_html__( 'Column Gap', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-portfolio-items' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'      => esc_html__( 'Row Gap', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-portfolio-items' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_margin',
			[
				'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'thumb_style_sec',
			[
				'label' => esc_html__( 'Thumbnail', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_margin',
			[
				'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .thumbnail' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'thumb_height',
			[
				'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .thumbnail' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'thumb_fit',
			[
				'label'     => esc_html__( 'Object Fit', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''           => esc_html__( 'Default', 'noxfolio-toolkit' ),
					'cover'      => esc_html__( 'Cover', 'noxfolio-toolkit' ),
					'fill'       => esc_html__( 'Fill', 'noxfolio-toolkit' ),
					'contain'    => esc_html__( 'Contain', 'noxfolio-toolkit' ),
					'none'       => esc_html__( 'None', 'noxfolio-toolkit' ),
					'scale-down' => esc_html__( 'Scale Down', 'noxfolio-toolkit' ),
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .thumbnail img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'thumb_position',
			[
				'label'     => esc_html__( 'Object Position', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'noxfolio-toolkit' ),
					'top'    => esc_html__( 'Top', 'noxfolio-toolkit' ),
					'bottom' => esc_html__( 'Bottom', 'noxfolio-toolkit' ),
					'left'   => esc_html__( 'left', 'noxfolio-toolkit' ),
					'right'  => esc_html__( 'Right', 'noxfolio-toolkit' ),
					'center' => esc_html__( 'Center', 'noxfolio-toolkit' ),
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .thumbnail img' => 'object-position: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'thumbnail_overly',
			[
				'label'     => esc_html__( 'Overly', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .thumbnail::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'thumb_border',
				'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .portfolio-item .thumbnail',
			]
		);

		$this->add_responsive_control(
			'thumb_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'section_id',
				'label'    => esc_html__( 'Section Label', 'noxfolio-toolkit' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .portfolio-item .content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'content_border',
				'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .portfolio-item .content',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color_typography_section',
			[
				'label' => esc_html__( 'Color & Typography', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'noxfolio-toolkit' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .portfolio-item .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .title' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'portfolio_design' => 'design-two',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'portfolio_design' => 'design-two',
				],
			]
		);

		$this->add_control(
			'categories_heading',
			[
				'label'     => esc_html__( 'Categories', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'categories_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .categories' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'portfolio_design!' => 'design-two',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'categories_typo',
				'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .portfolio-item .categories',
			]
		);

		$this->add_control(
			'categories_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .categories, {{WRAPPER}} .portfolio-item .categories a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'categories_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .categories' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'portfolio_design' => 'design-two',
				],
			]
		);

		$this->add_responsive_control(
			'categories_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .categories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'portfolio_design' => 'design-two',
				],
			]
		);

		$this->add_control(
			'excerpt_heading',
			[
				'label'     => esc_html__( 'Excerpt', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->add_control(
			'excerpt_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .excerpt' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'excerpt_typography',
				'label'     => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector'  => '{{WRAPPER}} .portfolio-item .excerpt',
				'condition' => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'portfolio_design' => 'design-four',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style_section',
			[
				'label'     => esc_html__( 'Arrow Link', 'noxfolio-toolkit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_arrow_link'   => 'yes',
					'portfolio_design!' => 'design-two',
				],
			]
		);

		$this->add_control(
			'arrow_size',
			[
				'label'     => esc_html__( 'Size', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .arrow-link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'arrow_font_size',
			[
				'label'     => esc_html__( 'Font Size', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .arrow-link' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'arrow_style_tab' );

		$this->start_controls_tab(
			'arrow_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
			]
		);

		$this->add_control(
			'arrow_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .arrow-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item .arrow-link' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_border',
				'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .portfolio-item .arrow-link',
			]
		);

		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'      => esc_html__( 'Border_radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item .arrow-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
			]
		);

		$this->add_control(
			'arrow_hover_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item:hover .arrow-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item:hover .arrow-link' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-item:hover .arrow-link' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_hover_border_radius',
			[
				'label'      => esc_html__( 'Border_radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .portfolio-item:hover .arrow-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the Frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$template = new Portfolio_Template();
		$template->render( $settings );
	}
}
