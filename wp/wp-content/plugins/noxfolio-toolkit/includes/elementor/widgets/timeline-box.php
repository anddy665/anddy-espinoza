<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Timeline_Box extends Widget_Base {

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
		return 'noxfolio-timeline-box';
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
		return esc_html__( 'Timeline Box', 'noxfolio-toolkit' );
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
		return 'eicon-radio webtend-logo';
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
		return [ 'noxfolio', 'toolkit', 'webtend', 'resume', 'timeline', 'box' ];
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
			'timeline_content_section',
			[
				'label' => esc_html__( 'Timeline Box', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_design',
			[
				'label'       => esc_html__( 'Design', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => [
					'design-one' => esc_html__( 'Design One', 'noxfolio-toolkit' ),
					'design-two' => esc_html__( 'Design Two', 'noxfolio-toolkit' ),
				],
				'default'     => 'design-one',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'duration',
			[
				'label'       => esc_html__( 'Duration', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Duration', 'noxfolio-toolkit' ),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'row'		  => 3,
				'placeholder' => esc_html__( 'Enter timeline title', 'noxfolio-toolkit' ),
			]
		);

		$repeater->add_control(
			'institution',
			[
				'label'       => esc_html__( 'Institution', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter institution title', 'noxfolio-toolkit' ),
			]
		);

		$this->add_control(
			'timeline_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'label'       => esc_html__( 'Items', 'noxfolio-toolkit' ),
				'default'     => [
					[
						'duration'    => esc_html__( '2021 - Present', 'noxfolio-toolkit' ),
						'title'       => esc_html__( 'Lead Product Designer', 'noxfolio-toolkit' ),
						'institution' => esc_html__( 'Google', 'noxfolio-toolkit' ),
					],
					[
						'duration'    => esc_html__( '2018 - 2021', 'noxfolio-toolkit' ),
						'title'       => esc_html__( 'Senior Product Designer', 'noxfolio-toolkit' ),
						'institution' => esc_html__( 'Webflow', 'noxfolio-toolkit' ),
					],
					[
						'duration'    => esc_html__( '2016 - 2018', 'noxfolio-toolkit' ),
						'title'       => esc_html__( 'Junior UX/UI Designer', 'noxfolio-toolkit' ),
						'institution' => esc_html__( 'LinkedIn', 'noxfolio-toolkit' ),
					],
					[
						'duration'    => esc_html__( '2014 - 2016', 'noxfolio-toolkit' ),
						'title'       => esc_html__( 'Graphics Designer', 'noxfolio-toolkit' ),
						'institution' => esc_html__( 'Webtend', 'noxfolio-toolkit' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label'        => esc_html__( 'Show dots on line', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'timeline_style_section',
			[
				'label' => esc_html__( 'Timeline Box', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-timeline-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-timeline-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .noxfolio-timeline-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'box_border',
				'placeholder' => '0',
				'default'     => '0',
				'selector'    => '{{WRAPPER}} .noxfolio-timeline-box',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-timeline-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .noxfolio-timeline-box',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'color_typo_section',
			[
				'label' => esc_html__( 'Color & Typography', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'duration_heading',
			[
				'label' => esc_html__( 'Duration', 'noxfolio-toolkit' ),
				'type'  => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'duration_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-duration' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'duration_typography',
				'selector' => '{{WRAPPER}} .timeline-duration',
			]
		);

		$this->add_control(
			'duration_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-duration i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'widget_design' => 'design-two'
				]
			]
		);

		$this->add_responsive_control(
			'duration_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .timeline-duration i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'widget_design' => 'design-two'
				]
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => esc_html__( 'Title', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .timeline-title',
			]
		);

		$this->add_control(
			'institution_heading',
			[
				'label'     => esc_html__( 'Institution', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'institution_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-institution' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'institution_typography',
				'selector' => '{{WRAPPER}} .timeline-institution',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_line_style_section',
			[
				'label' => esc_html__( 'Arrow/Line/Dots', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_heading',
			[
				'label' => esc_html__( 'Arrow', 'noxfolio-toolkit' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'arrow_area_size',
			[
				'label'     => esc_html__( 'Area Size', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-arrow-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_icon_size',
			[
				'label'     => esc_html__( 'Font Size', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-arrow-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrow_icon_border',
				'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .timeline-arrow-icon',
			]
		);

		$this->add_responsive_control(
			'arrow_icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .timeline-arrow-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'arrow_icon_tab' );

		$this->start_controls_tab(
			'arrow_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
			]
		);

		$this->add_control(
			'arrow_icon_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-arrow-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_icon_bg',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-arrow-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_icon_hover',
			[
				'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
			]
		);

		$this->add_control(
			'arrow_icon_hover_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item:hover .timeline-arrow-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'arrow_icon_hover_bg',
			[
				'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-item:hover .timeline-arrow-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'line_heading',
			[
				'label'     => esc_html__( 'Line', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'line_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .noxfolio-timeline-box .timeline-line::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dots_heading',
			[
				'label'     => esc_html__( 'Dots', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_dots' => 'yes'
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .noxfolio-timeline-box .timeline-dots'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .noxfolio-timeline-box .timeline-dots::after' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'show_dots' => 'yes'
				],
			]
		);

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

		if ( empty( $settings['timeline_items'] ) ) {
			return;
		}

		$timeline_items = $settings['timeline_items'];
		$column_count   = 2;
		$items_per_col  = ceil( count( $timeline_items ) / $column_count );
		$total_dots     = ceil( count( $timeline_items ) / 2 );
		?>
		<div class="noxfolio-timeline-box <?php echo esc_attr( $settings['widget_design'] ) ?>">
			<?php foreach ( $timeline_items as $index => $item ) :
				if ( $index % $items_per_col === 0 ) {
					echo '<div class="timeline-column">';
				}
				?>
				<div class="timeline-item">
					<div class="timeline-arrow-icon">
						<i class="far fa-arrow-right"></i>
					</div>
					<div class="timeline-content">
						<?php if ( ! empty( $item['duration'] ) ) :
							$duration_key = $this->get_repeater_setting_key( 'duration', 'timeline_items', $index );
							$this->add_inline_editing_attributes( $duration_key, 'none' );
							$this->add_render_attribute( $duration_key, 'class', 'timeline-duration' );
							?>
							<span <?php $this->print_render_attribute_string( $duration_key ); ?>>
								<?php if ( 'design-two' === $settings['widget_design'] ) {
									echo '<i class="far fa-calendar-alt"></i>';
								}?>
								<?php echo esc_html( $item['duration'] ); ?>
							</span>
						<?php endif; ?>
						<?php if ( ! empty( $item['title'] ) ) :
							$title_key = $this->get_repeater_setting_key( 'title', 'timeline_items', $index );
							$this->add_inline_editing_attributes( $title_key, 'none' );
							$this->add_render_attribute( $title_key, 'class', 'timeline-title' );
							?>
							<h4 <?php $this->print_render_attribute_string( $title_key ); ?>>
								<?php echo nt_kses_basic( $item['title'] ); ?>
							</h4>
						<?php endif; ?>
						<?php if ( ! empty( $item['institution'] ) ) :
							$institution_key = $this->get_repeater_setting_key( 'institution', 'timeline_items', $index );
							$this->add_inline_editing_attributes( $institution_key, 'none' );
							$this->add_render_attribute( $institution_key, 'class', 'timeline-institution' );
							?>
							<span <?php $this->print_render_attribute_string( $institution_key ); ?>>
								<?php echo esc_html( $item['institution'] ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
				<?php
				if ( ( $index + 1 ) % $items_per_col === 0 || $index === count( $timeline_items ) - 1 ) {
					echo '</div>';
				}
			endforeach; ?>
			<div class="timeline-line">
				<?php
					if ( 'yes' === $settings['show_dots'] ) {
						for ( $i = 0; $i < $total_dots; $i ++ ) {
							echo '<span class="timeline-dots"></span>';
						}
					}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="noxfolio-timeline-box {{ settings.widget_design }}">
			<#
				var timelineItems = settings.timeline_items;
				var columnCount = 2;
				var itemsPerColumn = Math.ceil( timelineItems.length / columnCount );
				var totalDots = Math.ceil( timelineItems.length / 2 );
			#>
			<# _.each( timelineItems, function( item, index ) { #>
				<# if ( index % itemsPerColumn === 0 ) { #>
				<div class="timeline-column">
				<# } #>
				<div class="timeline-item">
					<div class="timeline-arrow-icon">
						<i class="far fa-arrow-right"></i>
					</div>
					<div class="timeline-content">
						<# if ( item.duration ) {
							var durationKey = view.getRepeaterSettingKey( 'duration', 'timeline_items', index );
							view.addRenderAttribute( durationKey, 'class', 'timeline-duration' );
							view.addInlineEditingAttributes( durationKey, 'none' );

							#>
							<span {{{ view.getRenderAttributeString( durationKey ) }}}>
								<# if ( 'design-two' == settings.widget_design ) { #>
									<i class="far fa-calendar-alt"></i>
								<# } #>
								{{{ item.duration }}}
							</span>
						<# } #>
						<# if ( item.title ) {
							var titleKey = view.getRepeaterSettingKey( 'title', 'timeline_items', index );
							view.addInlineEditingAttributes( titleKey, 'none' );
							view.addRenderAttribute( titleKey, 'class', 'timeline-title' );
							#>
							<h4 {{{ view.getRenderAttributeString( titleKey ) }}}>
								{{{ item.title }}}
							</h4>
						<# } #>
						<# if ( item.institution ) {
							var institutionKey = view.getRepeaterSettingKey( 'institution', 'timeline_items', index );
							view.addInlineEditingAttributes( institutionKey, 'none' );
							view.addRenderAttribute( institutionKey, 'class', 'timeline-institution' );
							#>
							<span {{{ view.getRenderAttributeString( institutionKey ) }}}>
								{{{ item.institution }}}
							</span>
						<# } #>
					</div>
				</div>
				<# if ( ( index + 1 ) % itemsPerColumn === 0 || index === timelineItems.length - 1 ) { #>
				</div>
				<# } #>
			<# }); #>
			<div class="timeline-line">
				<# if ( 'yes' === settings.show_dots ) { #>
					<# for (var i = 0; i < totalDots; i++) { #>
						<span class="timeline-dots"></span>
					<# } #>
				<# } #>
			</div>
		</div>
		<?php
	}
}
