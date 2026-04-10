<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Service_Box extends Widget_Base {

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
        return 'noxfolio-service-box';
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
        return esc_html__( 'Service Box', 'noxfolio-toolkit' );
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
        return 'eicon-icon-box webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'service', 'feature', 'box'];
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
                'label' => esc_html__( 'General', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content_heading',
            [
                'label'     => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'service_index',
            [
                'label'       => esc_html__( 'Service Index', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '01', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter service index', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'default'     => esc_html__( 'Brand Identity Design', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter service title', 'noxfolio-toolkit' ),
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
            'description',
            [
                'label'       => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => esc_html__( 'Welcome to our portfolio website!', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter service description', 'noxfolio-toolkit' ),
            ]
        );

		$this->add_control(
			'service_url',
			[
				'label'   => esc_html__( 'URL', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'               => '#',
					'is_external'       => false,
					'nofollow'          => false,
					'custom_attributes' => '',
				],
				'placeholder' => esc_html__( 'Service URL', 'noxfolio-toolkit' ),
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'service_box_style',
            [
                'label' => esc_html__( 'Service Box', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'service_box_tabs' );

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
                    '{{WRAPPER}} .noxfolio-service-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-service-box',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-service-box',
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
                    '{{WRAPPER}} .noxfolio-service-box:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-service-box:hover' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .noxfolio-service-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-service-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_style_heading',
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
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-service-box:hover .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_style_heading',
            [
                'label'     => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-service-box:hover .description' => 'color: {{VALUE}}',
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
		<div class="noxfolio-service-box">
			<?php
				if ( $settings['service_index'] ) {
					$this->add_render_attribute( 'service_index', 'class', 'service-index' );
					$this->add_inline_editing_attributes( 'service_index', 'none' );

					printf( '<span %1$s>%2$s</span>',
						$this->get_render_attribute_string( 'service_index' ),
						nt_kses_basic( $settings['service_index'] )
					);
				}
			?>
			<div class="service-content">
				<?php
					if ( $settings['title'] ) {
						$this->add_render_attribute( 'title', 'class', 'title' );
						$this->add_inline_editing_attributes( 'title', 'none' );

						printf( '<%1$s %2$s>%3$s</%1$s>',
							nt_escape_tags( $settings['title_tag'] ),
							$this->get_render_attribute_string( 'title' ),
							nt_kses_basic( $settings['title'] )
						);
					}

					if ( $settings['description'] ) {
						$this->add_render_attribute( 'description', 'class', 'description' );
						$this->add_inline_editing_attributes( 'description', 'basic' );

						printf( '<p %1$s>%2$s</p>',
							$this->get_render_attribute_string( 'description' ),
							nt_kses_basic( $settings['description'] )
						);
					}
				?>
			</div>
			<?php
				if ( $settings['service_url']['url'] ) {
					$this->add_render_attribute( 'service_url', 'class', 'service-url' );
					$this->add_link_attributes( 'service_url', $settings['service_url'] );

					printf( '<a %1$s><i class="far fa-arrow-right"></i></a>',
						$this->get_render_attribute_string( 'service_url' )
					);
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
		<div class="noxfolio-service-box">
			<# if ( settings.service_index ) {
				view.addRenderAttribute( 'service_index', 'class', 'service-index' );
				view.addInlineEditingAttributes( 'service_index', 'none' ); #>
				<span {{{ view.getRenderAttributeString( 'service_index' ) }}}>
				{{{ settings.service_index }}}
				</span>
			<# } #>
			<div class="service-content">
				<# if ( settings.title ) {
					view.addRenderAttribute( 'title', 'class', 'title' );
					view.addInlineEditingAttributes( 'title', 'none' ); #>
					<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>
						{{{ settings.title }}}
					</{{ settings.title_tag }}>
				<# } #>
				<# if ( settings.description ) {
					view.addRenderAttribute( 'description', 'class', 'description' );
					view.addInlineEditingAttributes( 'description', 'basic' ); #>
					<p {{{ view.getRenderAttributeString( 'description' ) }}}>
					{{{ settings.description }}}
					</p>
				<# } #>
			</div>
			<# if ( settings.service_url.url ) { #>
				<a href="{{{ settings.service_url.url }}}" class="service-url"><i class="far fa-arrow-right"></i></a>
			<# } #>
		</div>
		<?php
    }
}
