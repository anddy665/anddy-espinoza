<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Pricing_Table extends Widget_Base {

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
        return 'noxfolio-pricing-table';
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
        return esc_html__( 'Pricing Table', 'noxfolio-toolkit' );
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
        return 'eicon-price-table webtend-logo';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
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
        return ['noxfolio', 'toolkit', 'webtend', 'price', 'table', 'pricing'];
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
            'section_general',
            [
                'label' => esc_html__( 'General', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'widget_layout',
            [
                'label'       => esc_html__( 'Layout', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'layout-one' => esc_html__( 'Layout One', 'noxfolio-toolkit' ),
                    'layout-two' => esc_html__( 'Layout Two', 'noxfolio-toolkit' ),
                ],
                'default'     => 'layout-one',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Header', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Basic Plan', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter title', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => esc_html__( 'Subtitle', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Try Out Basic Plan Save 20%', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter title', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter description', 'noxfolio-toolkit' ),
                'default'     => esc_html__( 'Our pricing widget  offers branding with its user-friendly design.', 'noxfolio-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing',
            [
                'label' => esc_html__( 'Pricing', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label'       => esc_html__( 'Currency', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    ''             => esc_html__( 'None', 'noxfolio-toolkit' ),
                    'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'noxfolio-toolkit' ),
                    'custom'       => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                ],
                'default'     => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label'     => esc_html__( 'Custom Symbol', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label'   => esc_html__( 'Price', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '19.95',
            ]
        );

        $this->add_control(
            'period',
            [
                'label'   => esc_html__( 'Period', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '/per month', 'noxfolio-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => esc_html__( 'Features', 'noxfolio-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature_text',
            [
                'label'   => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::TEXTAREA,
				'row' 	  => 3,
                'default' => esc_html__( 'Website Design', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'feature_icon',
            [
                'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'skin'        => 'inline',
                'label_block' => false,
            ]
        );

        $repeater->add_control(
            'single_features_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list {{CURRENT_ITEM}} .feature-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'single_features_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list {{CURRENT_ITEM}} .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'show_label'  => false,
                'default'     => [
                    [
                        'feature_text' => esc_html__( 'Website Design', 'noxfolio-toolkit' ),
                        'icon'         => 'fas fa-check',
                    ],
                    [
                        'feature_text' => esc_html__( 'Mobile Apps Design', 'noxfolio-toolkit' ),
                        'icon'         => 'fas fa-check',
                    ],
                    [
                        'feature_text' => esc_html__( 'Product Design', 'noxfolio-toolkit' ),
                        'icon'         => 'fas fa-check',
                    ],
                    [
                        'feature_text' => esc_html__( 'Digital Marketing', 'noxfolio-toolkit' ),
                        'icon'         => 'fas fa-check',
                    ],
                    [
                        'feature_text' => esc_html__( 'Custom Support', 'noxfolio-toolkit' ),
                        'icon'         => 'fas fa-check',
                    ],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->add_control(
            'hide_icon',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Hide Icon', 'noxfolio-toolkit' ),
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Button Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Choose Plan', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Type button text here', 'noxfolio-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'       => esc_html__( 'Link', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'https://example.com',
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'selected_button_icon',
            [
                'label'   => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_indent',
            [
                'label'     => esc_html__( 'Icon Spacing', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button.icon-right .button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_button_icon[value]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_rotate',
            [
                'label'     => esc_html__( 'Icon Rotate', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button .button-icon' => 'transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'selected_button_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_badge',
            [
                'label' => esc_html__( 'Badge', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label'        => esc_html__( 'Show', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Popular', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Type badge text', 'noxfolio-toolkit' ),
                'condition'   => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__( 'General', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'table_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pricing-table' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'pricing_table_tabs' );

        $this->start_controls_tab(
            'table_normal_tabs',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'table_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pricing-table' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'table_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-pricing-table',
            ]
        );

        $this->add_responsive_control(
            'table_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'table_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-pricing-table',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'table_hover_tabs',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'table_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pricing-table:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'table_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pricing-table:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pricing-table:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'table_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-pricing-table:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'table_content_style',
            [
                'label' => esc_html__( 'Content Area', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'table_header_heading',
            [
                'label' => esc_html__( 'Header Area', 'noxfolio-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'table_header_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'table_header_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-header' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'table_header_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .table-header',
            ]
        );

        $this->add_responsive_control(
            'table_header_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}}  .table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_icon_heading',
            [
                'label'     => esc_html__( 'Icon Area', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => [
					'widget_layout' => 'layout-two',
				],
            ]
        );

        $this->add_control(
            'title_icon_font_size',
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
                    '{{WRAPPER}} .title-wrap i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
				'condition' => [
					'widget_layout' => 'layout-two',
				],
            ]
        );
        $this->add_control(
            'title_icon_size',
            [
                'label'     => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-wrap i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
				'condition' => [
					'widget_layout' => 'layout-two',
				],
            ]
        );

        $this->add_control(
            'title_icon_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-wrap i' => 'color: {{VALUE}}',
                ],
				'condition' => [
					'widget_layout' => 'layout-two',
				],
            ]
        );

        $this->add_control(
            'title_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-wrap i' => 'background-color: {{VALUE}}',
                ],
				'condition' => [
					'widget_layout' => 'layout-two',
				],
            ]
        );

        $this->add_control(
            'table_content_heading',
            [
                'label'     => esc_html__( 'Content Area', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'table_content_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .table-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'table_content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'table_content_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .table-content',
            ]
        );

        $this->add_responsive_control(
            'table_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .table-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title_desc',
            [
                'label' => esc_html__( 'Title & Description', 'noxfolio-toolkit' ),
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

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .table-title',
            ]
        );

        $this->add_control(
            'subtitle_heading',
            [
                'label'     => esc_html__( 'Subtitle', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .table-subtitle',
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'desc_spacing',
            [
                'label'      => esc_html__( 'Spacing Top', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .table-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .table-desc',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_pricing',
            [
                'label' => esc_html__( 'Pricing', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .table-price' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_price',
            [
                'type'  => Controls_Manager::HEADING,
                'label' => esc_html__( 'Price', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-price .table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typography',
                'selector' => '{{WRAPPER}} .table-price .table-price-text',
            ]
        );

        $this->add_control(
            'heading_currency',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Currency', 'noxfolio-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-price .table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'currency_typography',
                'selector' => '{{WRAPPER}} .table-price .table-currency',
            ]
        );

        $this->add_control(
            'heading_period',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Period', 'noxfolio-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-price .table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'period_typography',
                'selector' => '{{WRAPPER}} .table-price .table-period',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_features',
            [
                'label' => esc_html__( 'Features', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'features_spacing',
            [
                'label'      => esc_html__( 'Space Between', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'min'        => 1,
                'max'        => 100,
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pricing-table .features-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list .feature-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_list_typography',
                'selector' => '{{WRAPPER}} .features-list .feature-text',
            ]
        );

        $this->add_control(
            'feature_icon_heading',
            [
                'label'     => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'features_icon_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list .feature-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'widget_layout' => 'layout-two',
                ],
            ]
        );

        $this->add_control(
            'feature_icon_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list li:hover .feature-icon' => 'color: {{VALUE}}',
                ],

                'condition' => [
                    'widget_layout' => 'layout-two',
                ],
            ]
        );

        $this->add_control(
            'feature_icon_hover_bg',
            [
                'label'     => esc_html__( 'Background Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .features-list li:hover .feature-icon' => 'background-color: {{VALUE}}',
                ],

                'condition' => [
                    'widget_layout' => 'layout-two',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_icon_size',
            [
                'label'      => esc_html__( 'Icon size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'min'        => 1,
                'max'        => 100,
                'selectors'  => [
                    '{{WRAPPER}} .features-list .feature-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'icon_vertical_position',
			[
				'label'     => esc_html__( 'Icon Vertical Position', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => -50,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-icon i, {{WRAPPER}} .feature-icon svg' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
            [
                'label'      => esc_html__( 'Spacing Top', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'min'        => 1,
                'max'        => 100,
                'selectors'  => [
                    '{{WRAPPER}} .table-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .noxfolio-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .noxfolio-button',
            ]
        );

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button .button-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button, {{WRAPPER}} .noxfolio-button .button-text, {{WRAPPER}} .noxfolio-button .button-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover, {{WRAPPER}} .noxfolio-button:hover .button-text, {{WRAPPER}} .noxfolio-button:hover .button-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge',
            [
                'label'     => esc_html__( 'Badge', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .table-badge',
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .table-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'badge_border',
                'selector' => '{{WRAPPER}} .table-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .table-badge',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get Currency symbol
     *
     * @param $symbol_name
     * @return void
     */
    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht'         => '&#3647;',
            'bdt'          => '&#2547;',
            'dollar'       => '&#36;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound'        => '&#163;',
            'peso'         => '&#8369;',
            'peseta'       => '&#8359',
            'lira'         => '&#8356;',
            'ruble'        => '&#8381;',
            'shekel'       => '&#8362;',
            'rupee'        => '&#8360;',
            'real'         => 'R$',
            'krona'        => 'kr',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];

        return isset( $symbols[$symbol_name] ) ? $symbols[$symbol_name] : '';
    }

    /**
     * Table Price
     *
     * @return void
     */
    private function render_table_price( $settings ) {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'price', 'none' );
        $this->add_render_attribute( 'price', 'class', 'price-text' );

        $this->add_inline_editing_attributes( 'period', 'none' );
        $this->add_render_attribute( 'period', 'class', 'period' );

		if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }

        if ( $settings['price'] ):
        ?>
		<div class="table-price">
			<span class="currency">
				<?php echo esc_html( $currency ); ?>
			</span>
			<span <?php echo $this->get_render_attribute_string( 'price' ); ?>>
				<?php echo esc_html( $settings['price'] ); ?>
			</span>
			<?php if ( $settings['period'] ): ?>
			<span <?php echo $this->get_render_attribute_string( 'period' ); ?>>
				<?php echo esc_html( $settings['period'] ); ?>
			</span>
			<?php endif;?>
		</div>
		<?php endif;
    }

	/**
	 * Render Table button
	 *
	 * @return void
	 */
	private function render_table_button(){
        $settings = $this->get_settings_for_display();

		if ( $settings['button_link']['url'] ) : ?>
		<div class="table-btn">
			<a <?php $this->print_render_attribute_string( 'button_url' ); ?>>
				<span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
					<?php echo esc_html( $settings['button_text'] ); ?>
				</span>
				<?php if ( $settings['selected_button_icon']['value'] ) : ?>
				<span class="button-icon">
					<?php Icons_Manager::render_icon( $settings['selected_button_icon'] );?>
				</span>
				<?php endif; ?>
			</a>
		</div>
		<?php endif;
	}

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_link_attributes( 'button_url', $settings['button_link'] );
        $this->add_render_attribute( 'button_url', 'class', 'noxfolio-button icon-right' );

		$this->add_render_attribute( 'button_text', 'class', 'button-text' );
        $this->add_inline_editing_attributes( 'button_text', 'none' );

		?>
		<div class="noxfolio-pricing-table <?php echo esc_attr( $settings['widget_layout'] ) ?>">
			<div class="table-header">
				<?php
					if ( 'layout-two' === $settings['widget_layout'] ) {
						echo '<div class="title-wrap">';
						echo '<i class="far fa-check"></i>';
					}

					if ( ! empty( $settings['title'] ) ) {
						$this->add_render_attribute( 'title', 'class', 'table-title' );
						$this->add_inline_editing_attributes( 'title', 'none' );

						printf( '<h4 %1$s>%2$s</h4>',
							$this->get_render_attribute_string( 'title' ),
							nt_kses_basic( $settings['title'] )
						);
					}

					if ( ! empty( $settings['subtitle'] ) ) {
						$this->add_render_attribute( 'subtitle', 'class', 'table-subtitle' );
						$this->add_inline_editing_attributes( 'subtitle', 'none' );

						printf( '<span %1$s>%2$s</span>',
							$this->get_render_attribute_string( 'subtitle' ),
							nt_kses_basic( $settings['subtitle'] )
						);
					}

					if ( 'layout-two' === $settings['widget_layout'] ) {
						echo '</div>';
					}

					$this->render_table_price( $settings );

					if ( 'layout-two' === $settings['widget_layout'] ) {
						echo '<div class="title-line"><svg viewBox="0 0 97 70" xmlns="http://www.w3.org/2000/svg"><path d="M81.1389 1.64106C84.5601 7.32124 89.4123 11.771 92.781 17.4462C93.3524 18.4082 95.8877 20.9594 95.828 22.231M95.828 22.231C95.7496 23.8821 91.8631 24.9639 90.961 25.2444C86.4128 26.6585 78.4658 29.0446 73.4105 29.9916M95.828 22.231C80.5337 14.4314 53.3249 18.3827 47.0532 34.8048M47.0532 34.8048C45.3928 39.1526 45.1999 44.3745 47.0842 50.4839C50.6472 62.035 64.3467 54.3769 61.3152 43.6467C59.6408 37.7227 52.876 35.3982 47.0532 34.8048ZM47.0532 34.8048C45.3808 34.6344 43.7861 34.6068 42.4121 34.6777C25.3766 35.5571 7.50622 51.0988 0.999925 68.6619" stroke-width="2" stroke-miterlimit="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';

						$this->render_table_button();
					}
				?>
			</div>
			<div class="table-content">
				<?php
					if ( ! empty( $settings['description'] ) ) {
						$this->add_render_attribute( 'description', 'class', 'table-desc' );
						$this->add_inline_editing_attributes( 'description', 'none' );

						printf( '<p %1$s>%2$s</p>',
							$this->get_render_attribute_string( 'description' ),
							nt_kses_basic( $settings['description'] )
						);
					}
				?>

				<?php if ( ! empty( $settings['features_list'] ) ) : ?>
				<ul class="features-list">
					<?php foreach ( $settings['features_list'] as $index => $feature ) :
						$feature_text_key = $this->get_repeater_setting_key( 'feature_text', 'features_list', $index );
						$this->add_render_attribute( $feature_text_key, 'class', 'feature-text' );
						$this->add_inline_editing_attributes( $feature_text_key, 'none' );
						?>
						<li class="elementor-repeater-item-<?php echo $feature['_id']; ?>">
							<?php if ( 'yes' !== $settings['hide_icon'] ) : ?>
							<span class="feature-icon">
								<?php Icons_Manager::render_icon( $feature['feature_icon'] );?>
							</span>
							<?php endif; ?>
							<span <?php echo $this->get_render_attribute_string( $feature_text_key ); ?>>
								<?php echo esc_html( $feature['feature_text'] ); ?>
							</span>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php
					if ( 'layout-one' === $settings['widget_layout'] ) {
						$this->render_table_button();
					}
				?>
			</div>
			<?php
				if ( 'yes' === $settings['show_badge'] && ! empty( $settings['badge_text'] ) ) {
					$this->add_render_attribute( 'badge_text', 'class', 'table-badge' );
					$this->add_inline_editing_attributes( 'badge_text', 'none' );

					printf( '<span %1$s>%2$s</span>',
						$this->get_render_attribute_string( 'badge_text' ),
						esc_html( $settings['badge_text'] )
					);
				}
			?>
		</div>
		<?php
    }
}
