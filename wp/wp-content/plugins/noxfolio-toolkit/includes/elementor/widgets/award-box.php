<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Award_Box extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'noxfolio-award-box';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Award Box', 'noxfolio-toolkit' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-integration webtend-logo';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that Currently, Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['noxfolio_elements'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['noxfolio', 'toolkit', 'webtend', 'award', 'box'];
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
            'award_content',
            [
                'label' => esc_html__( 'Award Box', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'       => esc_html__( 'Tagline', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'WP', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter tag', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'count',
            [
                'label'       => esc_html__( 'Count', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '06X', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter award counter', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Developer Award', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter award name', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'year',
            [
                'label'       => esc_html__( 'Year', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '2018', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter award year', 'noxfolio-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Award Box', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-award-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-award-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'box_style_tabs' );

        $this->start_controls_tab(
            'box_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-award-box',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-award-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-award-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'box_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-award-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-award-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'color_typography_section',
            [
                'label' => esc_html__( 'Color & Typography', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tag_heading',
            [
                'label' => esc_html__( 'Tagline', 'noxfolio-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tag_typography',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .tag',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'tag_stroke',
                'selector' => '{{WRAPPER}} .tag',
            ]
        );

        $this->add_control(
            'tag_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tag' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tag_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover .tag' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tag_hover_stroke_color',
            [
                'label'     => esc_html__( 'Stroke Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover .tag' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'count_heading',
            [
                'label'     => esc_html__( 'Count', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'count_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .count',
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'count_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover .count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label'     => esc_html__( 'Name', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .name',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-award-box:hover .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'year_heading',
            [
                'label'     => esc_html__( 'Year', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'year_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .year' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'year_typography',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .year',
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'year_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .year' => 'background-color: {{VALUE}}',
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
		?>
		<div class="noxfolio-award-box">
			<?php
				if ( ! empty( $settings['year'] ) ) {
					$this->add_render_attribute( 'year', 'class', 'year' );
					$this->add_inline_editing_attributes( 'year', 'none' );

					printf( '<span %1$s>%2$s</span>',
						$this->get_render_attribute_string( 'year' ),
						nt_kses_basic( $settings['year'] )
					);
				}

				if ( ! empty( $settings['tag'] ) ) {
					$this->add_render_attribute( 'tag', 'class', 'tag' );
					$this->add_inline_editing_attributes( 'tag', 'none' );

					printf( '<span %1$s>%2$s</span>',
						$this->get_render_attribute_string( 'tag' ),
						nt_kses_basic( $settings['tag'] )
					);
				}

				if ( ! empty ( $settings['count'] ) || ! empty ( $settings['name']) ) {
					echo '<span class="title-count-wrap">';

					if ( ! empty( $settings['count'] ) ) {
						$this->add_render_attribute( 'count', 'class', 'count' );
						$this->add_inline_editing_attributes( 'count', 'none' );

						printf( '<span %1$s>%2$s</span>',
							$this->get_render_attribute_string( 'count' ),
							nt_kses_basic( $settings['count'] )
						);
					}

					if ( ! empty( $settings['name'] ) ) {
						$this->add_render_attribute( 'name', 'class', 'name' );
						$this->add_inline_editing_attributes( 'name', 'none' );

						printf( '<span %1$s>%2$s</span>',
							$this->get_render_attribute_string( 'name' ),
							nt_kses_basic( $settings['name'] )
						);
					}

					echo '</span>';
				}
			?>
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
		<div class="noxfolio-award-box">
			<# if ( settings.year ) {
				view.addRenderAttribute( 'year', 'class', 'year' );
				view.addInlineEditingAttributes( 'year', 'none' ); #>
				<span {{{ view.getRenderAttributeString('year') }}}>
					{{{ settings.year }}}
				</span>
			<# } #>

			<# if ( settings.tag ) {
				view.addRenderAttribute( 'tag', 'class', 'tag' );
				view.addInlineEditingAttributes( 'tag', 'none' );
			#>
			<span {{{ view.getRenderAttributeString('tag') }}}>
				{{{ settings.tag }}}
			</span>
			<# } #>

			<# if ( settings.count || settings.name ) { #>
			<span class="title-count-wrap">
				<# if ( settings.count ) {
					view.addRenderAttribute( 'count', 'class', 'count' );
					view.addInlineEditingAttributes( 'count', 'none' );
				#>
				<span {{{ view.getRenderAttributeString('count') }}}>
					{{{ settings.count }}}
				</span>
				<# } #>

				<# if ( settings.name ) {
					view.addRenderAttribute( 'name', 'class', 'name' );
					view.addInlineEditingAttributes( 'name', 'none' );
				#>
				<span {{{ view.getRenderAttributeString('name') }}}>
					{{{ settings.name }}}
				</span>
				<# } #>
			</span>
			<# } #>
		</div>
		<?php
    }
}