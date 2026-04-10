<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Counter extends Widget_Base {

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
        return 'noxfolio-counter';
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
        return esc_html__( 'Counter', 'noxfolio-toolkit' );
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
        return 'eicon-counter webtend-logo';
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
     * Retrieve the list of Scripts the widget depended on.
     *
     * Used to set Scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget Scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-numerator'];
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
        return ['noxfolio', 'toolkit', 'webtend', 'counter', 'fun', 'Fact'];
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
            'section_content_heading',
            [
                'label' => esc_html__( 'Counter Box', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label'   => esc_html__( 'Starting Number', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => esc_html__( 'Ending Number', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'default' => 100,
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => esc_html__( 'Number Prefix', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Plus', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => esc_html__( 'Number Suffix', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '+',
                'placeholder' => esc_html__( 'Plus', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'   => esc_html__( 'Animation Duration', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
                'min'     => 100,
                'step'    => 100,
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'        => esc_html__( 'Thousand Separator', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'thousand_separator_char',
            [
                'label'     => esc_html__( 'Separator', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'thousand_separator' => 'yes',
                ],
                'options'   => [
                    ''  => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    '.' => esc_html__( 'Dot', 'noxfolio-toolkit' ),
                    ',' => esc_html__( 'Comma', 'noxfolio-toolkit' ),
                    ' ' => esc_html__( 'Space', 'noxfolio-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Counter Title', 'noxfolio-toolkit' ),
                'default'     => esc_html__( 'Years Of Experience', 'noxfolio-toolkit' ),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter description', 'noxfolio-toolkit' ),
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
                'default'     => 'h6',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label'   => esc_html__( 'Alignment', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left'   => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'text-right'  => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'  => false,
                'default' => 'text-left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_section',
            [
                'label' => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'default' => 'icon',
                'options' => [
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'noxfolio-toolkit' ),
                        'icon'  => 'far fa-image',
                    ],
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'condition'   => [
                    'icon_type' => 'icon',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Image Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'      => esc_html__( 'Icon Position', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::CHOOSE,
                'default'    => 'top',
                'options'    => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => esc_html__( 'Top', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'    => 'top',
                'toggle'     => false,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'selected_icon[value]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'selected_image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_alignment',
            [
                'label'     => esc_html__( 'Icon Vertical Alignment', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Middle', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Bottom', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => false,
                'condition' => [
                    'icon_position' => ['left', 'right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_back_top',
            [
                'label'        => esc_html__( 'Icon Back to Top', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => '',
                'description'  => esc_html__( 'It will move the box icon back to the top position at a lower screen size (480px)', 'noxfolio-toolkit' ),
                'condition'    => [
                    'icon_position' => ['left', 'right'],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_counter_box',
            [
                'label' => esc_html__( 'Counter Box', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'info_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'counter_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .noxfolio-counter-box',
            ]
        );

        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'counter_box_tab' );

        $this->start_controls_tab(
            'counter_box_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'counter_box_bg',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'counter_box_shadow',
                'selector'  => '{{WRAPPER}} .noxfolio-counter-box',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'counter_box_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'counter_box_hover_bg',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box::before',
            ]
        );

        $this->add_control(
            'counter_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'counter_box_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'counter_box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__( 'Icon/Image', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_area_size',
            [
                'label'      => esc_html__( 'Area Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label'      => esc_html__( 'Font Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
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
                    '{{WRAPPER}} .noxfolio-counter-box ' => '--icon-space: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_img_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_img_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tabs' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon svg *' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .noxfolio-counter-box .counter-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .noxfolio-counter-box .counter-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box .counter-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon svg *' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box:hover .counter-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_counter_style',
            [
                'label' => esc_html__( 'Counter', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_typography',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box .counter-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'counter_text_stroke',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box .counter-wrap',
            ]
        );

        $this->start_controls_tabs( 'tabs-counter_style' );

        $this->start_controls_tab(
            'tab_counter_style_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-wrap' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'counter_text_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box .counter-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_counter_style_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-wrap' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_hover_stroke_color',
            [
                'label'     => esc_html__( 'Stroke Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-wrap' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'counter_hover_text_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-counter-box:hover .counter-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'counter_bottom_space',
            [
                'label'     => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label'      => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'title_text',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'description_text',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'title_style_tabs' );

        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'selector'  => '{{WRAPPER}} .noxfolio-counter-box .counter-title',
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'      => 'title_stroke',
                'selector'  => '{{WRAPPER}} .noxfolio-counter-box .counter-title',
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_hover_stroke_color',
            [
                'label'     => esc_html__( 'Stroke Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-title' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->start_controls_tabs( 'desc_style_tab' );

        $this->start_controls_tab(
            'desc_style_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box .counter-desc' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'selector'  => '{{WRAPPER}} .noxfolio-counter-box .counter-desc',
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_bottom_space',
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
                    '{{WRAPPER}} .noxfolio-counter-box .counter-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'desc_style_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-counter-box:hover .counter-desc' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
    protected function render_icon() {
        $settings = $this->get_settings_for_display();

        $has_icon  = ! empty( $settings['selected_icon']['value'] );
        $has_image = ! empty( $settings['selected_image']['url'] );

        if ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['selected_image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if ( $has_icon || $has_image ): ?>
        <div class="counter-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
				<?php Icons_Manager::render_icon( $settings['selected_icon'] );?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
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

        $this->add_render_attribute( 'counter', [
            'class'           => 'elementor-counter-number',
            'data-duration'   => $settings['duration'],
            'data-to-value'   => $settings['ending_number'],
            'data-from-value' => $settings['starting_number'],
        ] );

        if ( 'yes' === $settings['thousand_separator'] ) {
            $delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
            $this->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
        }

		$this->add_render_attribute( 'wrapper', [
			'class' => 'noxfolio-counter-box ' . $settings['text_align'] . ' icon-' . $settings['icon_position']
		]);

		if ( 'yes' === $settings['icon_back_top'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'icon-back-top');
		}
        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
            <?php $this->render_icon();?>
            <div class="counter-inner">
                <?php if ( $settings['ending_number'] && $settings['starting_number'] ): ?>
                <div class="counter-wrap">
                    <?php
                        if ( $settings['prefix'] ) {
                            printf( '<span class="counter-prefix">%1$s</span>',
                                esc_html( $settings['prefix'] )
                            );
                        }
                        if ( $settings['ending_number'] && $settings['starting_number'] ) {
                            printf( '<span %1$s>%2$s</span>',
                                $this->get_render_attribute_string( 'counter' ),
                                esc_html( $settings['starting_number'] )
                            );
                        }
                        if ( $settings['suffix'] ) {
                            printf( '<span class="counter-suffix">%1$s</span>',
                                esc_html( $settings['suffix'] )
                            );
                        }
                    ?>
                </div>
                <?php endif;?>
                <?php
                    if ( $settings['title_text'] ) {
                        $this->add_render_attribute( 'title_text', 'class', 'counter-title' );
                        $this->add_inline_editing_attributes( 'title_text', 'none' );

                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title_text' ),
                            nt_kses_basic( $settings['title_text'] )
                        );
                    }

                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_render_attribute( 'description_text', 'class', 'counter-desc' );
                        $this->add_inline_editing_attributes( 'description_text', 'basic' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            nt_kses_basic( $settings['description_text'] )
                        );
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
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, {}, 'i' , 'object' );

			view.addRenderAttribute( 'wrapper', {
				'class' : 'noxfolio-counter-box ' + settings.text_align + ' icon-' + settings.icon_position
			} );

			if ( 'yes' == settings.icon_back_top ) {
				view.addRenderAttribute( 'wrapper', 'class', 'icon-back-top' );
			}

            view.addRenderAttribute( 'title_text', 'class', 'counter-title' );
            view.addInlineEditingAttributes( 'title_text', 'none' );

			view.addRenderAttribute( 'counter_number', {
				'class'           : 'elementor-counter-number',
				'data-duration'   : settings.duration,
				'data-to-value'   : settings.ending_number,
				'data-from-value' : settings.starting_number,
				'data-delimiter'  : settings.thousand_separator == 'yes' && settings.thousand_separator_char ? settings.thousand_separator_char || ',' : '',
			} );
        #>
        <div {{{ view.getRenderAttributeString('wrapper') }}}>
            <# if (( settings.selected_image.url && settings.icon_type == 'image' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
            <div class="counter-icon">
                <# if ( settings.selected_image.url && settings.icon_type == 'image' ) { #>
                    <img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title_text }}}">
                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                    {{{ iconHTML.value }}}
                <# } #>
            </div>
            <# } #>
            <div class="counter-inner">
                <# if ( settings.ending_number && settings.starting_number ) { #>
                <div class="counter-wrap">
                    <# if( settings.prefix ) { #>
					<span class="counter-prefix">{{{ settings.prefix }}}</span>
                    <# } #>
                    <span {{{ view.getRenderAttributeString('counter_number') }}}>{{{ settings.starting_number }}}</span>
                    <# if( settings.suffix ) { #>
					<span class="counter-suffix">{{{ settings.suffix }}}</span>
                    <# } #>
                </div>
                <# } #>
                <# if( settings.title_text ) { #>
                    <{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>
						{{{ settings.title_text }}}
					</{{{ settings.title_tag }}}>
                <# } #>
                <# if ( settings.description_text ) {
                    view.addRenderAttribute( 'description_text', 'class', 'counter-desc' );
                    view.addInlineEditingAttributes( 'description_text', 'basic' ); #>
                    <p {{{ view.getRenderAttributeString('description_text') }}}>
                        {{{ settings.description_text }}}
                    </p>
                <# } #>
            </div>
        </div>
        <?php
    }
}