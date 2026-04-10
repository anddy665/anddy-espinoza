<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Info_Box extends Widget_Base {

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
        return 'noxfolio-info-box';
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
        return esc_html__( 'Info Box', 'noxfolio-toolkit' );
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
        return 'eicon-info-box webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'info', 'image', 'icon', 'box', 'iconic'];
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
            'section_content_additional',
            [
                'label' => esc_html__( 'Additional Options', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
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
            'read_more',
            [
                'label'        => esc_html__( 'Read More Button', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'badge',
            [
                'label'        => esc_html__( 'Badge', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'wrapper_link',
            [
                'label'        => esc_html( 'Wrapper Link', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html( 'Be aware! When Wrapper Link activated then title link and read more link will not work', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'wrapper_link_url',
            [
                'label'       => esc_html__( 'Wrapper URL', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => false,
                    'nofollow'          => false,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Enter Wrapper URL', 'noxfolio-toolkit' ),
                'condition'   => [
                    'wrapper_link' => 'yes',
                ],
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
                'default'     => [
                    'value'   => 'far fa-paper-plane',
                    'library' => 'fa-regular',
                ],
                'condition'   => [
                    'icon_type' => 'icon',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image',
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
                'separator'  => 'before',
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
                            'name'     => 'image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_inline',
            [
                'label'     => esc_html__( 'Icon Inline', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'icon_position' => ['left', 'right'],
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
                    '{{WRAPPER}} .noxfolio-info-box'            => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-info-box .box-title' => 'align-items: {{VALUE}};',
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

        $this->add_responsive_control(
            'text_icon_align',
            [
                'label'     => esc_html__( 'Text Icon Align', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => '',
                'options'   => [
                    'start'         => [
                        'title' => esc_html__( 'Start', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-start-h',
                    ],
                    'center'        => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-center-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'end'           => [
                        'title' => esc_html__( 'End', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-end-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box .box-title' => 'justify-content: {{VALUE}}',
                ],
                'condition' => [
                    'icon_inline' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => esc_html__( 'Title & Description', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter box title', 'noxfolio-toolkit' ),
                'default'     => esc_html__( 'Awards Winning Company', 'noxfolio-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label'        => esc_html__( 'Title Link', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'title_link_url',
            [
                'label'       => esc_html__( 'Title Link URL', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'title_link' => 'yes',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'With over 20 years of experience, we work to provide better service to our customers.', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter box description', 'noxfolio-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_read_more',
            [
                'label'     => esc_html( 'Read More', 'noxfolio-toolkit' ),
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Read More', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_link',
            [
                'label'       => esc_html__( 'Link to', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'noxfolio-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'   => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'left'  => esc_html__( 'Left', 'noxfolio-toolkit' ),
                    'right' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                ],
                'condition' => [
                    'read_more_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_badge',
            [
                'label'     => esc_html__( 'Badge', 'noxfolio-toolkit' ),
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'POPULAR', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Type Badge Title', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label'   => esc_html__( 'Position', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'top-right'    => esc_html__( 'Top Right', 'noxfolio-toolkit' ),
                    'top-left'     => esc_html__( 'Top Left', 'noxfolio-toolkit' ),
                    'bottom-right' => esc_html__( 'Bottom Right', 'noxfolio-toolkit' ),
                    'bottom-left'  => esc_html__( 'Bottom Left', 'noxfolio-toolkit' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box' => '--badge-h-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box ' => '--badge-v-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_rotate',
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
                    '{{WRAPPER}} .noxfolio-info-box ' => '--badge-rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_info_box',
            [
                'label' => esc_html__( 'Info Box', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'info_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'info_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .noxfolio-info-box',
            ]
        );

        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'info_box_tab' );

        $this->start_controls_tab(
            'info_box_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_bg',
                'selector' => '{{WRAPPER}} .noxfolio-info-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-info-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_box_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_hover_bg',
                'selector' => '{{WRAPPER}} .noxfolio-info-box::before',
            ]
        );

        $this->add_control(
            'info_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'info_box_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-info-box:hover',
            ]
        );

        $this->add_control(
            'extra_hover_effect',
            [
                'label'       => esc_html__( 'Extra Hover Effect', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'none'            => esc_html__( 'None', 'noxfolio-toolkit' ),
                    'left-bordered'   => esc_html__( 'Left bordered', 'noxfolio-toolkit' ),
                    'right-bordered'  => esc_html__( 'Right bordered', 'noxfolio-toolkit' ),
                    'top-bordered'    => esc_html__( 'Top bordered', 'noxfolio-toolkit' ),
                    'bottom-bordered' => esc_html__( 'Bottom bordered', 'noxfolio-toolkit' ),
                ],
                'default'     => 'none',
            ]
        );

        $this->add_control(
            'extra_hover_effect_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .left-bordered, {{WRAPPER}} .right-bordered, {{WRAPPER}} .top-bordered, {{WRAPPER}} .bottom-bordered' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'extra_hover_effect!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'extra_hover_effect_border',
            [
                'label'      => esc_html__( 'Border Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .left-bordered, {{WRAPPER}} .right-bordered' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .top-bordered, {{WRAPPER}} .bottom-bordered' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'extra_hover_effect!' => 'none',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
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
                            'name'     => 'image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
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
                    '{{WRAPPER}} .box-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .box-icon img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box-icon img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box-icon img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .box-icon img' => 'object-position: {{VALUE}};',
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
                    '{{WRAPPER}} .noxfolio-info-box ' => '--icon-space: {{SIZE}}px;',
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
                    '{{WRAPPER}} .box-icon' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .box-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .box-icon',
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
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-icon' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-icon' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-icon' => 'border-color: {{VALUE}};',
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
                'size_units' => ['px', '%', 'custom'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-info-box:hover .box-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_desc_style',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .noxfolio-info-box .box-title',
            ]
        );

        $this->add_responsive_control(
            'title_space',
            [
                'label'      => esc_html__( 'Bottom Spacing', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_divider',
            [
                'label'        => esc_html__( 'Show Divider', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_responsive_control(
            'divider_size',
            [
                'label'      => esc_html__( 'Divider Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .title-divider' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'title_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_spacing',
            [
                'label'      => esc_html__( 'Divider Spacing', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .title-divider' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition'  => [
                    'title_divider' => 'yes',
                ],
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
                    '{{WRAPPER}} .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-divider' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'title_divider' => 'yes',
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
                    '{{WRAPPER}} .noxfolio-info-box:hover .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .title-divider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'title_divider' => 'yes',
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
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_responsive_control(
            'desc_top_space',
            [
                'label'     => esc_html__( 'Spacing Top', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .description' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'desc_bottom_space',
            [
                'label'     => esc_html__( 'Spacing Bottom', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'desc_tabs' );

        $this->start_controls_tab(
            'tab_desc_normal',
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
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_desc_hover',
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
                    '{{WRAPPER}} .noxfolio-info-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_read_more',
            [
                'label'     => esc_html__( 'Read More', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .read-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'selector' => '{{WRAPPER}} .read-more-btn span',
            ]
        );

        $this->add_responsive_control(
            'read_more_top_space',
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
                    '{{WRAPPER}} .read-more-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'read_more_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'selector'    => '{{WRAPPER}} .read-more-btn',
            ]
        );

        $this->add_responsive_control(
            'read_more_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .read-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_read_more_style' );

        $this->start_controls_tab(
            'tab_read_more_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-btn, {{WRAPPER}} .read-more-btn .btn-text,  {{WRAPPER}} .read-more-btn .btn-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_read_more_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .read-more-btn, {{WRAPPER}} .noxfolio-info-box:hover .read-more-btn .btn-text, {{WRAPPER}} .noxfolio-info-box:hover .read-more-btn .btn-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .read-more-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .read-more-btn' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'btn_icon_heading',
            [
                'label'     => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_space',
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
                    '{{WRAPPER}} .read-more-btn.icon-left .btn-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .read-more-btn.icon-right .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_area',
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
                    '{{WRAPPER}} .read-more-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_size',
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
                    '{{WRAPPER}} .read-more-btn .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .read-more-btn .btn-icon i, {{WRAPPER}} .read-more-btn .btn-icon svg' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'read_more_icon_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .read-more-btn .btn-icon',
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .read-more-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'read_more_icon_tab' );

        $this->start_controls_tab(
            'read_more_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_icon_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-btn .btn-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more-btn .btn-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'read_more_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_icon_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .read-more-btn .btn-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-info-box:hover .read-more-btn .btn-icon' => 'background-color: {{VALUE}}',
                ],
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
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .box-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_shadow',
                'selector' => '{{WRAPPER}} .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .box-badge',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
	protected function render_icon( $icon_inline = false ) {
        $settings = $this->get_settings_for_display();

        $has_icon  =  ! empty( $settings['icon'] );
        $has_image =  ! empty( $settings['image']['url'] );

        if ( $has_icon && 'icon' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'font-icon', 'class', $settings['selected_icon'] );
        } elseif ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if (  ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        if ( $icon_inline ) {
            $wrapper_tag = 'span';
        } else {
            $wrapper_tag = 'div';
        }

        if ( $has_icon || $has_image ): ?>
        <<?php echo nt_escape_tags( $wrapper_tag ) ?> class="box-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
				<?php Icons_Manager::render_icon( $settings['selected_icon'] );?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
        </<?php echo nt_escape_tags( $wrapper_tag ) ?>>
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

		$this->add_render_attribute( 'info_box', [
			'class' => 'noxfolio-info-box ' . $settings['text_align'] . ' icon-' . $settings['icon_position']
		]);

		if ( 'yes' === $settings['icon_back_top'] ) {
			$this->add_render_attribute( 'info_box', 'class', 'icon-back-top');
		}

        ?>
        <div <?php echo $this->get_render_attribute_string( 'info_box' ) ?>>
            <?php if ( 'yes' !== $settings['icon_inline'] ) {
                $this->render_icon();
            }?>
            <div class="box-content">
                <?php if ( ! empty( $settings['title_text'] ) ) : ?>
                    <<?php echo nt_escape_tags( $settings['title_tag'], 'h4' ) ?> class="box-title">
                        <?php
                            if ( 'yes' === $settings['icon_inline'] && 'top' !== $settings['icon_position'] ) {
                                $this->render_icon( true );
                            }
                            if ( ! empty( $settings['title_text'] ) ) {
                                $this->add_inline_editing_attributes( 'title_text', 'none' );
                                $this->add_render_attribute( 'title_text', 'class', 'title-text' );

                                if ( 'yes' == $settings['title_link'] && ! empty( $settings['title_link_url']['url'] ) ) {
                                    $this->add_link_attributes( 'title_text', $settings['title_link_url'] );

                                    printf( '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        nt_kses_basic( $settings['title_text'] )
                                    );
                                } else {
                                    printf( '<span %1$s>%2$s</span>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        nt_kses_basic( $settings['title_text'] )
                                    );
                                }
                            }
                        ?>
                    </<?php echo nt_escape_tags( $settings['title_tag'], 'h4' ) ?>>
					<?php if ( 'yes' === $settings['title_divider'] ) : ?>
					<span class="title-divider"></span>
					<?php endif; ?>
                <?php endif; ?>
                <?php
                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_render_attribute( 'description_text', 'class', 'description' );
                        $this->add_inline_editing_attributes( 'description_text', 'basic' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            nt_kses_basic( $settings['description_text'] )
                        );
                    }

                    if ( 'yes' === $settings['read_more'] && $settings['read_more_link']['url'] ) :
                        $this->add_render_attribute( 'read_more', 'class', 'read-more-btn' );
                        $this->add_render_attribute( 'read_more', 'class', 'icon-' . $settings['read_more_icon_align'] );
                        $this->add_render_attribute( 'read_more_text', 'class', 'btn-text' );
                        $this->add_inline_editing_attributes( 'read_more_text', 'none' );

                        if ( ! empty( $settings['read_more_link']['url'] ) ) {
                            $this->add_link_attributes( 'read_more', $settings['read_more_link'] );
                        }

                        ?>
                        <a <?php echo $this->get_render_attribute_string( 'read_more' ); ?>>
                            <span <?php echo $this->get_render_attribute_string( 'read_more_text' ) ?>>
								<?php echo esc_html( $settings['read_more_text'] ); ?>
							</span>
							<?php if ( $settings['read_more_icon']['value'] ) : ?>
                            <span class="btn-icon">
								<?php Icons_Manager::render_icon( $settings['read_more_icon'] ); ?>
							</span>
							<?php endif; ?>
                        </a>
                        <?php
                    endif;
                ?>
            </div>
            <?php if ( 'yes' === $settings['badge'] && '' != $settings['badge_text'] ) : ?>
            <div class="box-badge badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
                <?php echo esc_html( $settings['badge_text'] ); ?>
            </div>
            <?php endif; ?>
            <?php
                if ( ! Plugin::$instance->editor->is_edit_mode() && 'yes' === $settings['wrapper_link'] ) {
                    $this->add_render_attribute( 'wrapper_link', 'class', 'box-wrapper-link' );
                    $this->add_link_attributes( 'wrapper_link', $settings['wrapper_link_url'] );

                    printf( '<a %1$s></a>',
                        $this->get_render_attribute_string( 'wrapper_link' )
                    );
                }

				if ( 'none' !== $settings['extra_hover_effect'] ) {
					printf( '<span class="%1$s"></span>',
						esc_attr( $settings['extra_hover_effect'] )
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
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, {}, 'i' , 'object' );

			view.addRenderAttribute( 'info_box', {
				'class' : 'noxfolio-info-box ' + settings.text_align + ' icon-' + settings.icon_position
			} );

			if ( 'yes' == settings.icon_back_top ) {
				view.addRenderAttribute( 'info_box', 'class', 'icon-back-top' );
			}
        #>
        <div {{{ view.getRenderAttributeString('info_box') }}}>
            <# if ( 'top' == settings.icon_position || 'yes' != settings.icon_inline ) { #>
                <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
                <div class="box-icon">
                    <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                        <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                    <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                        <# if ( iconHTML.rendered ) { #>
                            {{{ iconHTML.value }}}
                        <# } #>
                    <# } #>
                </div>
                <# } #>
            <# } #>
            <div class="box-content">
                <# if ( settings.title_text ) { #>
                    <{{{settings.title_tag}}} class="box-title">
                        <# if ( 'yes' == settings.icon_inline && 'top' != settings.icon_position ) { #>
                            <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
                            <span class="box-icon">
                                <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                                    <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
									<# if ( iconHTML.rendered ) { #>
										{{{ iconHTML.value }}}
									<# } #>
                                <# } #>
                            </span>
                            <# } #>
                        <# } #>
                        <#
                            view.addInlineEditingAttributes( 'title_text', 'none' );
                            view.addRenderAttribute( 'title_text', 'class', 'title-text' );

                            if( 'yes' == settings.title_link && settings.title_link_url ) {
                                view.addRenderAttribute( 'title_text', 'href', settings.title_link_url.url );

                                var title_html = '<a ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</a>';
                                print( title_html );
                            } else {
                                var title_html = '<span ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</span>';
                                print( title_html );
                            }
                        #>
                    </{{{settings.title_tag}}}>
					<# if ( 'yes' == settings.title_divider ) { #>
					<span class="title-divider"></span>
					<# } #>
                <# } #>
                <# if ( settings.description_text ) {
                    view.addRenderAttribute( 'description_text', 'class', 'description' );
                    view.addInlineEditingAttributes( 'description_text', 'basic' ); #>
                    <p {{{ view.getRenderAttributeString('description_text') }}}>
                        {{{ settings.description_text }}}
                    </p>
                <# } #>
                <# if ( 'yes' == settings['read_more'] && settings.read_more_link.url ) {
                    view.addRenderAttribute( 'read_more', 'class', 'read-more-btn' );
                    view.addRenderAttribute( 'read_more', 'class', 'icon-' + settings.read_more_icon_align );
                    view.addRenderAttribute( 'read_more', 'href', settings.read_more_link.url );
                    view.addRenderAttribute( 'read_more_text', 'class', 'btn-text' );
                    view.addInlineEditingAttributes( 'read_more_text', 'none' );

                    var iconHTMLMore = elementor.helpers.renderIcon( view, settings.read_more_icon, {}, 'i' , 'object' );
				#>
                    <a {{{ view.getRenderAttributeString('read_more') }}}>
                        <span {{{ view.getRenderAttributeString('read_more_text') }}}>
							{{{ settings.read_more_text }}}
						</span>
						<# if ( iconHTMLMore.rendered ) { #>
						<span class="btn-icon">
							{{{ iconHTMLMore.value }}}
						</span>
                        <# } #>
                    </a>
                <# } #>
            </div>
            <# if ( 'yes' === settings.badge && settings.badge_text != '' ) { #>
            <div class="box-badge badge-{{{settings.badge_position}}}">
                {{{settings.badge_text}}}
            </div>
            <# } #>
			<# if ( 'none' != settings.extra_hover_effect ) { #>
			<span class="{{{ settings.extra_hover_effect }}}"></span>
			<# } #>
        </div>
        <?php
    }
}