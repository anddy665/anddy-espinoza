<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Mini_Search extends Widget_Base {

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
        return 'noxfolio-mini-search';
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
        return esc_html__( 'Mini Search', 'noxfolio-toolkit' );
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
        return 'eicon-search webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'header', 'search', 'mini'];
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

        $this->add_responsive_control(
            'button_alignment',
            [
                'label'       => esc_html__( 'Button Alignment', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'left',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .noxfolio-search-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'search_button_style',
            [
                'label' => esc_html__( 'Search Icon', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'search_button_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .search-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_button_size',
            [
                'label'      => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .search-icon' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .search-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'search_wrapper',
            [
                'label' => esc_html__( 'Search Canvas', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .noxfolio-search-overly' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'overly_opacity',
            [
                'label'      => esc_html__( 'Overly Opacity', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'step' => 0.1,
                        'max'  => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-wrapper.show-search-canvas .noxfolio-search-overly' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'input_heading',
            [
                'label'     => esc_html__( 'Input', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'field_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-form input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .noxfolio-search-form input',
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'field_typography',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-search-form input',
            ]
        );

        $this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => esc_html__( 'Normal State', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-form input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-form input' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => esc_html__( 'Focus', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'field_focus_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .noxfolio-search-canvas input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .noxfolio-search-canvas input' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .noxfolio-search-canvas input' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'close_heading',
            [
                'label'     => esc_html__( 'Close', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'close_button_color',
            [
                'label'     => esc_html__( 'Close', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .search-close' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_button_size',
            [
                'label'      => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-search-wrapper .search-close' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();
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
        ?>
        <div class="noxfolio-search-wrapper">
            <div class="search-icon">
                <i class="far fa-search"></i>
            </div>
            <div class="noxfolio-search-overly"></div>
            <div class="noxfolio-search-canvas">
                <div class="search-close">
                    <i class="fal fa-times"></i>
                </div>
                <form role="search" method="get" class="noxfolio-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type keyword & Hit Enter', 'placeholder', 'noxfolio-toolkit' ); ?>" value="<?php echo get_search_query() ?>" name="s"/>
                </form>
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
        <div class="noxfolio-search-wrapper">
            <div class="search-icon">
                <i class="far fa-search"></i>
            </div>
            <div class="noxfolio-search-overly"></div>
            <div class="noxfolio-search-canvas">
                <div class="search-close">
                    <i class="fal fa-times"></i>
                </div>
                <form role="search" method="get" class="noxfolio-search-form" action="#">
                    <input type="search" class="search-field" placeholder="Type keyword & Hit Enter" />
                </form>
            </div>
        </div>
        <?php
    }
}