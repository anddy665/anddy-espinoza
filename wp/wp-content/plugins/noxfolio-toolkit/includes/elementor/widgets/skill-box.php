<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Skill_Box extends Widget_Base {

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
        return 'noxfolio-skill-box';
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
        return esc_html__( 'Skill Box', 'noxfolio-toolkit' );
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
        return 'eicon-flash webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'skills', 'box', 'showcase'];
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

        $this->add_control(
            'icon_heading',
            [
                'label'     => esc_html__( 'Icon/Image', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
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
                'default'     => [
                    'value'   => 'fab fa-wordpress',
                    'library' => 'fa-brands',
                ],
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
            'content_heading',
            [
                'label'     => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'WordPress', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter skill title', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
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
                'default'     => 'h5',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'percentage',
            [
                'label'       => esc_html__( 'Percentage', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'separator'   => 'before',
                'default'     => esc_html__( '95%', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter skill percentage: 95%', 'noxfolio-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Skill Box', 'noxfolio-toolkit' ),
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
                    '{{WRAPPER}} .noxfolio-skill-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-skill-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'skill_box_tabs' );

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
                    '{{WRAPPER}} .noxfolio-skill-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-skill-box',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-skill-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-skill-box',
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
                    '{{WRAPPER}} .noxfolio-skill-box:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .noxfolio-skill-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-skill-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_per_area',
            [
                'label'     => esc_html__( 'Icon/Percentage Area', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'widget_design' => 'design-two',
                ],
            ]
        );

        $this->add_control(
            'icon_per_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'custom'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .skill-icon-percentage' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'icon_per_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'custom'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .skill-icon-percentage' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_per_tabs' );

        $this->start_controls_tab(
            'icon_per_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_per_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-icon-percentage' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_per_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .skill-icon-percentage',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_per_shadow',
                'selector' => '{{WRAPPER}} .skill-icon-percentage',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_per_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_per_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .skill-icon-percentage' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'icon_per_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .skill-icon-percentage' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_per_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-skill-box:hover .skill-icon-percentage',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style_section',
            [
                'label'      => esc_html__( 'Icon/Image', 'noxfolio-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .skill-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_img_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .skill-icon img' => 'width: {{SIZE}}{{UNIT}};',
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
                'size_units' => ['px', 'em', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .skill-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_img_fit',
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
                    '{{WRAPPER}} .skill-icon img' => 'object-fit: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_img_position',
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
                    '{{WRAPPER}} .skill-icon img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => 'image',
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
                    '{{WRAPPER}} .skill-icon' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tabs' );

        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .skill-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_rotate',
            [
                'label'     => esc_html__( 'Rotate', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .skill-icon' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .skill-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_rotate',
            [
                'label'     => esc_html__( 'Rotate', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .skill-icon' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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

        $this->start_controls_tabs( 'title_tabs' );

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
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'title_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_responsive_control(
            'title_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_box_shadow',
                'selector' => '{{WRAPPER}} .title',
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
                    '{{WRAPPER}} .noxfolio-skill-box:hover .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .title' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-skill-box:hover .title',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'percentage_style_section',
            [
                'label' => esc_html__( 'Percentage', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'percentage_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .percentage' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'percentage_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'percentage_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .percentage',
            ]
        );

        $this->start_controls_tabs( 'percentage_tabs' );

        $this->start_controls_tab(
            'percentage_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'percentage_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .percentage' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'percentage_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .percentage' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'percentage_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .percentage',
            ]
        );

        $this->add_responsive_control(
            'percentage_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .percentage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'percentage_box_shadow',
                'selector' => '{{WRAPPER}} .percentage',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'percentage_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'percentage_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .percentage' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'percentage_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .percentage' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'percentage_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .percentage' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'percentage_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-skill-box:hover .percentage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'percentage_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-skill-box:hover .percentage',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Title
     *
     * @return void
     */
    private function render_icon() {
        $settings = $this->get_settings_for_display();

        if (  ( $settings['icon_type'] === 'image' && $settings['selected_image']['url'] ) || ( $settings['icon_type'] === 'icon' && $settings['selected_icon']['value'] ) ) {
            echo '<div class="skill-icon">';
            if ( $settings['icon_type'] === 'icon' ) {
                Icons_Manager::render_icon( $settings['selected_icon'] );
            } elseif ( $settings['icon_type'] === 'image' ) {
                printf( '<img src="%1$s" alt="%2$s">',
                    esc_url( $settings['selected_image']['url'] ),
                    esc_html( $settings['title'] )
                );
            }
            echo '</div>';
        }
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

		$this->add_render_attribute('wrapper', [
			'class' => 'noxfolio-skill-box ' . $settings['widget_design']
		])
        ?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ) ?>>
			<?php
				if ( 'design-one' === $settings['widget_design'] ) {
					$this->render_icon();

					if ( $settings['title'] ) {
						$this->add_render_attribute( 'title', 'class', 'title' );
						$this->add_inline_editing_attributes( 'title', 'none' );

						printf( '<%1$s %2$s>%3$s</%1$s>',
							nt_escape_tags( $settings['title_tag'] ),
							$this->get_render_attribute_string( 'title' ),
							nt_kses_basic( $settings['title'] )
						);
					}

					if ( $settings['percentage'] ) {
						$this->add_render_attribute( 'percentage', 'class', 'percentage' );
						$this->add_inline_editing_attributes( 'percentage', 'none' );

						printf( '<span %1$s>%2$s</span>',
							$this->get_render_attribute_string( 'percentage' ),
							nt_kses_basic( $settings['percentage'] )
						);
					}

				} elseif( 'design-two' === $settings['widget_design'] ) {
					echo '<div class="skill-icon-percentage">';
						$this->render_icon();

						if ( $settings['percentage'] ) {
							$this->add_render_attribute( 'percentage', 'class', 'percentage' );
							$this->add_inline_editing_attributes( 'percentage', 'none' );

							printf( '<span %1$s>%2$s</span>',
								$this->get_render_attribute_string( 'percentage' ),
								nt_kses_basic( $settings['percentage'] )
							);
						}
					echo '</div>';

					if ( $settings['title'] ) {
						$this->add_render_attribute( 'title', 'class', 'title' );
						$this->add_inline_editing_attributes( 'title', 'none' );

						printf( '<%1$s %2$s>%3$s</%1$s>',
							nt_escape_tags( $settings['title_tag'] ),
							$this->get_render_attribute_string( 'title' ),
							nt_kses_basic( $settings['title'] )
						);
					}
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
		<#
			view.addRenderAttribute( 'title', 'class', 'title' );
            view.addInlineEditingAttributes( 'title', 'none' );

			view.addRenderAttribute( 'percentage', 'class', 'percentage' );
            view.addInlineEditingAttributes( 'percentage', 'none' );

            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, {}, 'i' , 'object' );

		#>
		<div class="noxfolio-skill-box {{ settings.widget_design }}">
			<# if ( 'design-one' == settings.widget_design ) { #>
				<# if ((settings.icon_type == 'image' && settings.selected_image.url) || (settings.icon_type == 'icon' && iconHTML )) { #>
					<div class="skill-icon">
						<# if ( settings.icon_type == 'image' ) { #>
							<img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title }}}">
						<# } else { #>
							{{{ iconHTML.value }}}
						<# } #>
					</div>
				<# } #>

				<# if( settings.title ) { #>
					<{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{{ settings.title_tag }}}>
				<# } #>

				<# if (settings.percentage) { #>
					<span {{{ view.getRenderAttributeString( 'percentage' ) }}}>{{{ settings.percentage }}}</span>
				<# } #>

			<# } else if ( 'design-two' == settings.widget_design ) { #>
				<div class="skill-icon-percentage">
					<# if ((settings.icon_type == 'image' && settings.selected_image.url) || (settings.icon_type == 'icon' && iconHTML )) { #>
						<div class="skill-icon">
							<# if ( settings.icon_type == 'image' ) { #>
								<img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title }}}">
							<# } else { #>
								{{{ iconHTML.value }}}
							<# } #>
						</div>
					<# } #>

					<# if (settings.percentage) { #>
						<span {{{ view.getRenderAttributeString( 'percentage' ) }}}>{{{ settings.percentage }}}</span>
					<# } #>
				</div>

				<# if( settings.title ) { #>
					<{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{{ settings.title_tag }}}>
				<# } #>
			<# } #>
		</div>
		<?php
    }
}
