<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use NoxfolioToolkit\ElementorAddon\Templates\Posts_Template;
use NoxfolioToolkit\ElementorAddon\Traits\Carousel_Helper;

defined( 'ABSPATH' ) || exit;

class Recent_Posts extends Widget_Base {

    use Carousel_Helper;

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
        return 'noxfolio-recent-posts';
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
        return esc_html__( 'Recent Post', 'noxfolio-toolkit' );
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
        return ['slick'];
    }

    /**
     * Retrieve the list of Style the widget depended on.
     *
     * Used to set style dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget style dependencies.
     */
    public function get_style_depends() {
        return ['slick'];
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
        return ['noxfolio', 'toolkit', 'webtend', 'post', 'blog', 'latest', 'slider', 'carousel'];
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
            'widget_content',
            [
                'label' => esc_html__( 'General', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'     => esc_html__( 'Grid', 'noxfolio-toolkit' ),
                    'carousel' => esc_html__( 'Carousel', 'noxfolio-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'Title Tag', 'noxfolio-toolkit' ),
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
            'title_word',
            [
                'label'   => esc_html__( 'Title Length', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt?', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_count',
            [
                'label'     => esc_html__( 'Excerpt Word', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'        => esc_html__( 'Show Read More', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'     => esc_html__( 'Read More Text', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Read More', 'noxfolio-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'       => esc_html__( 'Read More Icon', 'noxfolio-toolkit' ),
                'label_block' => false,
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_divider',
            [
                'label'        => esc_html__( 'Show Divider', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label'        => esc_html__( 'Show Thumbnail?', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'post_thumbnail',
                'default'   => 'large',
                'exclude'   => [
                    'custom',
                ],
                'condition' => [
                    'show_thumbnail' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'thumb_position',
            [
                'label'       => esc_html__( 'Thumbnail Position', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'default'     => 'thumb-before',
                'options'     => [
                    'thumb-before' => esc_html__( 'Before', 'noxfolio-toolkit' ),
                    'thumb-after'  => esc_html__( 'After', 'noxfolio-toolkit' ),
                    'thumb-left'   => esc_html__( 'Left', 'noxfolio-toolkit' ),
                    'thumb-right'  => esc_html__( 'Right', 'noxfolio-toolkit' ),
                ],
                'condition'   => [
                    'show_thumbnail' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_meta',
            [
                'label'        => esc_html__( 'Show Meta', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'active_meta',
            [
                'label'       => esc_html__( 'Active Meta', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'default'     => ['date', 'comments'],
                'options'     => [
                    'date'     => esc_html__( 'Date', 'noxfolio-toolkit' ),
                    'comments' => esc_html__( 'Comments', 'noxfolio-toolkit' ),
                ],
                'condition'   => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_position',
            [
                'label'       => esc_html__( 'Meta Position', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'default'     => 'meta-before',
                'options'     => [
                    'meta-before' => esc_html__( 'Before Title', 'noxfolio-toolkit' ),
                    'meta-after'  => esc_html__( 'After Title', 'noxfolio-toolkit' ),
                ],
                'conditions'  => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_meta',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
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
                'condition'            => [
                    'layout' => 'grid',
                ],
                'separator'            => 'before',
                'selectors'            => [
                    '{{WRAPPER}} .noxfolio-post-boxes' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_content',
            [
                'label' => esc_html__( 'Query', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'post_from', [
                'label'   => esc_html__( 'Post From', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All Posts', 'noxfolio-toolkit' ),
                    'categories'    => esc_html__( 'Categories', 'noxfolio-toolkit' ),
                    'specific-post' => esc_html__( 'Specific Posts', 'noxfolio-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'       => esc_html__( 'Select Posts', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => nt_select_post(),
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
                'options'     => nt_select_category(),
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
                'default' => 3,
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

        $this->add_control(
            'show_pagination',
            [
                'label'        => esc_html__( 'Show Pagination', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'condition'    => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->end_controls_section();

        $default_view = [
            'per_view_desk'   => 3,
            'per_view_tab'    => 2,
            'per_view_mobile' => 1,
        ];

        $this->register_carousel_options( ['layout_condition' => true, 'per_view_default' => $default_view] );

        $this->start_controls_section(
            'post_style',
            [
                'label' => esc_html__( 'Post Item', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => esc_html__( 'Column Gap', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-post-boxes' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'      => esc_html__( 'Row Gap', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-post-boxes' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-post-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-post-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'label'    => esc_html__( 'Item Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-post-box',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-post-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'item_tabs' );

        $this->start_controls_tab(
            'item_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-post-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'item_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'item_hover_background',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-post-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_area_style',
            [
                'label' => esc_html__( 'Content Area', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__( 'Text Align', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'  => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'start',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box'               => 'text-align: {{Value}};',
                    '{{WRAPPER}} .noxfolio-post-box .post-content' => 'align-items: {{Value}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_border',
                'label'    => esc_html__( 'Item Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .post-content',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .post-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'content_tabs' );

        $this->start_controls_tab(
            'content_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'post_content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .post-content',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'content_hover_background',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box:hover .post-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box:hover .post-content' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-post-box:hover .post-content',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'thumbnail_style',
            [
                'label'     => esc_html__( 'Thumbnail', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_thumbnail' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_spacing',
            [
                'label'     => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-thumbnail' => '--thumb-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                    '{{WRAPPER}} .post-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .post-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'img_fit',
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
                    '{{WRAPPER}} .post-thumbnail img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_position',
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
                    '{{WRAPPER}} .post-thumbnail img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'thumb_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .post-thumbnail',
            ]
        );

        $this->add_responsive_control(
            'thumb_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .post-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .post-title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .post-title',
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'divide_spacing',
            [
                'label'     => esc_html__( 'Divider Spacing', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'margin: {{SIZE}}{{UNIT}} 0',
                ],
                'condition' => [
                    'show_divider' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'divide_height',
            [
                'label'     => esc_html__( 'Divider Height', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'show_divider' => 'yes',
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
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'excerpt_typo',
                'label'     => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} .noxfolio-post-box p',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_spacing',
            [
                'label'     => esc_html__( 'Spacing Top', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-post-box p' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'meta_heading',
            [
                'label'      => esc_html__( 'Post Meta', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::HEADING,
                'separator'  => 'before',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_meta',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label'      => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .post-meta a'                           => 'color: {{VALUE}}',
                    '{{WRAPPER}} .post-meta a:not(:first-child)::before' => 'background-color: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_meta',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'meta_hover_color',
            [
                'label'      => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .post-meta a:hover' => 'color: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_meta',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'       => 'meta_typo',
                'label'      => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector'   => '{{WRAPPER}} .post-meta a',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'show_meta',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'active_meta',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'read_more_heading',
            [
                'label'     => esc_html__( 'Read More', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .read-more:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'read_more_typo',
                'label'     => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} .read-more',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_spacing',
            [
                'label'     => esc_html__( 'Spacing Top', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .read-more' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
				'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination_style',
            [
                'label'     => esc_html__( 'Pagination', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout'          => 'grid',
                    'show_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_align',
            [
                'label'     => esc_html__( 'Alignment', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'  => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-center-h',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-end-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label'      => esc_html__( 'Gap', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
            [
                'label'      => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Text Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_pagination_style' );

        $this->start_controls_tab(
            'tab_pagination_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_hover',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );
        $this->add_control(
            'hover_pagination_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers:hover, {{WRAPPER}} .noxfolio-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers:hover, {{WRAPPER}} .noxfolio-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-pagination .page-numbers:hover, {{WRAPPER}} .noxfolio-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->register_arrows_options( ['layout_condition' => true] );
        $this->register_dots_options( ['layout_condition' => true] );
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

        $template = new Posts_Template();

        $template->render( $settings );
    }
}
