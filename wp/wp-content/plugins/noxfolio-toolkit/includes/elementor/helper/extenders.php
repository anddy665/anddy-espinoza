<?php
namespace NoxfolioToolkit\ElementorAddon\Helper;

if (  ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use NoxfolioTheme\Classes\Noxfolio_Helper;

class Noxfolio_Extenders {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        // Section Option
        add_action( 'elementor/element/section/section_layout/before_section_end', [$this, 'register_controls_section'], 10, 1 );

        // Sticky Options
        add_action( 'elementor/element/section/section_advanced/after_section_end', [$this, 'register_controls_sticky'], 10, 1 );
        add_action( 'elementor/element/container/section_layout/after_section_end', [$this, 'register_controls_sticky'], 10, 1 );
        add_action( 'elementor/frontend/section/before_render', [$this, 'sticky_before_render'], 10, 1 );
        add_action( 'elementor/frontend/container/before_render', [$this, 'sticky_before_render'], 10, 1 );

        // Column Options
        add_action( 'elementor/element/column/layout/before_section_end', [$this, 'register_controls_column'], 10, 1 );

        // Accordion Icon Option
        add_action( 'elementor/element/nested-accordion/section_content_style/after_section_end', [$this, 'register_acc_icon_control'], 10, 1 );

        // Global Color
        add_action( 'rest_request_after_callbacks', [$this, 'elementor_add_theme_colors'], 999, 3 );
        add_filter( 'rest_request_after_callbacks', [$this, 'display_global_colors_front_end'], 999, 3 );
    }

    /**
     * Column Alignment
     *
     * @return void
     */
    public function register_controls_section( $section ) {
        $section->add_responsive_control(
            'column_align', [
                'label'     => esc_html__( 'Horizontal Align', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'separator' => 'before',
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                    'center'     => esc_html__( 'Center', 'noxfolio-toolkit' ),
                    'flex-end'   => esc_html__( 'End', 'noxfolio-toolkit' ),
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elementor-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $section->add_responsive_control(
            'overflow_x', [
                'label'     => esc_html__( 'Overflow X', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'visible' => esc_html__( 'Visible', 'noxfolio-toolkit' ),
                    'hidden'  => esc_html__( 'Hidden', 'noxfolio-toolkit' ),
                    'scroll'  => esc_html__( 'Scroll', 'noxfolio-toolkit' ),
                    'auto'    => esc_html__( 'Auto', 'noxfolio-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow-x: {{VALUE}};',
                ],
            ]
        );

        $section->add_responsive_control(
            'overflow_y', [
                'label'     => esc_html__( 'Overflow Y', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'visible' => esc_html__( 'Visible', 'noxfolio-toolkit' ),
                    'hidden'  => esc_html__( 'Hidden', 'noxfolio-toolkit' ),
                    'scroll'  => esc_html__( 'Scroll', 'noxfolio-toolkit' ),
                    'auto'    => esc_html__( 'Auto', 'noxfolio-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow-y: {{VALUE}};',
                ],
            ]
        );
    }

    /**
     * Sticky Section
     *
     * @return void
     */
    public function register_controls_sticky( $section ) {
        $section->start_controls_section(
            'section_sticky_controls',
            [
                'label' => esc_html__( 'Noxfolio Sticky', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'section_sticky_on',
            [
                'label'        => esc_html__( 'Enable Sticky', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description'  => esc_html__( 'Make the section stick to the top when scrolling. This settings will not work in inner section or inner container', 'noxfolio-toolkit' ),
            ]
        );

        $section->add_responsive_control(
            'section_sticky_offset',
            [
                'label'     => esc_html__( 'Offset', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}}.noxfolio-sticky.noxfolio-sticky-active' => 'top: {{SIZE}}px;',
                ],
            ]
        );

        $section->add_control(
            'section_sticky_active_bg',
            [
                'label'     => esc_html__( 'Active Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.noxfolio-sticky.noxfolio-sticky-active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_responsive_control(
            'section_sticky_active_padding',
            [
                'label'      => esc_html__( 'Active Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}}.noxfolio-sticky.noxfolio-sticky-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'     => esc_html__( 'Active Box Shadow', 'noxfolio-toolkit' ),
                'name'      => 'section_sticky_active_shadow',
                'selector'  => '{{WRAPPER}}.noxfolio-sticky.noxfolio-sticky-active',
                'condition' => [
                    'section_sticky_on' => 'yes',
                ],
            ]
        );

        $section->end_controls_section();
    }

    /**
     * Sticky Before Render
     *
     * @param $section
     * @return void
     */
    public function sticky_before_render( $section ) {
        $settings = $section->get_settings_for_display();

        if (  ! empty( $settings['section_sticky_on'] ) == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'noxfolio-sticky' );
        }
    }

    /**
     * Column Order Option
     *
     * @return void
     */
    public function register_controls_column( $column ) {
        $column->add_responsive_control(
            'noxfolio_column_order',
            [
                'label'          => __( 'Column Order', 'noxfolio-toolkit' ),
                'type'           => Controls_Manager::NUMBER,
                'style_transfer' => true,
                'separator'      => 'before',
                'selectors'      => [
                    '{{WRAPPER}}.elementor-column' => '-webkit-box-ordinal-group: calc({{VALUE}} + 1 ); -ms-flex-order:{{VALUE}}; order: {{VALUE}};',
                ],
                'description'    => sprintf(
                    __( 'Column ordering is a great addition for responsive design. You can learn more about CSS order property from %sMDN%s.', 'noxfolio-toolkit' ),
                    '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Flexible_Box_Layout/Ordering_Flex_Items#The_order_property" target="_blank">',
                    '</a>'
                ),
            ]
        );
    }

    /**
     * Register Accordion Icon Control
     *
     * @return void
     */
    public function register_acc_icon_control( $element ) {
        $element->start_controls_section(
            'noxfolio_acc_icon_style',
            [
                'label' => esc_html__( 'Extra Icon Options', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_responsive_control(
            'noxfolio_acc_icon_area_size',
            [
                'label'     => esc_html__( 'Area Size', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '.e-n-accordion-item .e-n-accordion-item-title-icon span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'noxfolio_acc_icon_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '.e-n-accordion-item .e-n-accordion-item-title-icon span',
            ]
        );

        $element->add_responsive_control(
            'noxfolio_acc_icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '.e-n-accordion-item .e-n-accordion-item-title-icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $element->start_controls_tabs( 'noxfolio_acc_icon_tabs' );

        $element->start_controls_tab(
            'noxfolio_acc_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $element->add_control(
            'noxfolio_acc_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-accordion-item .e-n-accordion-item-title-icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab(
            'noxfolio_acc_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $element->add_control(
            'noxfolio_acc_hover_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-accordion-item:not([open]):hover .e-n-accordion-item-title-icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $element->add_control(
            'noxfolio_acc_hover_icon_border',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-accordion-item:not([open]):hover .e-n-accordion-item-title-icon span' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->start_controls_tab(
            'noxfolio_acc_icon_active_tab',
            [
                'label' => esc_html__( 'Active', 'noxfolio-toolkit' ),
            ]
        );

        $element->add_control(
            'noxfolio_acc_active_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-accordion-item[open] .e-n-accordion-item-title-icon span' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $element->add_control(
            'noxfolio_acc_active_icon_border',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .e-n-accordion-item[open] .e-n-accordion-item-title-icon span' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $element->end_controls_tab();

        $element->end_controls_tabs();

        $element->end_controls_section();
    }

    /**
     * Display theme global colors to Elementor Global colors
     *
     * @since 3.7.0
     * @param object          $response rest request response.
     * @param array           $handler Route handler used for the request.
     * @param WP_REST_Request $request Request used to generate the response.
     * @return object
     */
    public function elementor_add_theme_colors( $response, $handler, $request ) {
        $route = $request->get_route();

        if ( '/elementor/v1/globals' != $route ) {
            return $response;
        }

        $data = $response->get_data();

        $theme_colors = Noxfolio_Helper::get_global_colors();

        foreach ( $theme_colors as $key => $color ) {
            $data['colors'][$key] = [
                'id'    => $key,
                'title' => $color['title'],
                'value' => $color['value'],
            ];
        }

        $response->set_data( $data );

        return $response;
    }

    /**
     * Display global colors on Elementor front end Page.
     *
     * @since 3.7.0
     * @param object          $response rest request response.
     * @param array           $handler Route handler used for the request.
     * @param WP_REST_Request $request Request used to generate the response.
     * @return object
     */
    public function display_global_colors_front_end( $response, $handler, $request ) {

        $route = $request->get_route();

        if ( 0 !== strpos( $route, '/elementor/v1/globals' ) ) {
            return $response;
        }

        $theme_colors = Noxfolio_Helper::get_global_colors();

        $rest_id = substr( $route, strrpos( $route, '/' ) + 1 );

        if (  ! in_array( $rest_id, array_keys( $theme_colors ), true ) ) {
            return $response;
        }

        $response = rest_ensure_response(
            [
                'id'    => esc_attr( $rest_id ),
                'title' => $theme_colors[$rest_id]['title'],
                'value' => $theme_colors[$rest_id]['value'],
            ]
        );

        return $response;
    }
}

Noxfolio_Extenders::instance()->initialize();
