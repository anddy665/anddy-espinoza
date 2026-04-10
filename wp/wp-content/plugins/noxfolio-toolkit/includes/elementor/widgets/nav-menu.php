<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use NoxfolioTheme\Classes\Noxfolio_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Nav_Menu extends Widget_Base {

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
        return 'noxfolio-nav-menu';
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
        return esc_html__( 'Nav Menu', 'noxfolio-toolkit' );
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
        return 'eicon-nav-menu webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'header', 'footer', 'nav', 'menu'];
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
                'label' => esc_html__( 'Nav Menu', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_type',
            [
                'label'   => esc_html__( 'Menu', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'theme-default' => esc_html__( 'Theme Default', 'noxfolio-toolkit' ),
                    'custom'        => esc_html__( 'Custom Menu', 'noxfolio-toolkit' ),
                ],
                'default' => 'theme-default',
            ]
        );

        $this->add_control(
            'selected_menu',
            [
                'label'     => esc_html__( 'Select Menu', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus_list(),
                'condition' => [
                    'menu_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'menu_alignment',
            [
                'label'       => esc_html__( 'Menu Alignment', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'center',
                'toggle'      => false,
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'menu_height',
            [
                'label'      => esc_html__( 'Menu Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper ul.primary-menu > li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_wrapper_height',
            [
                'label'      => esc_html__( 'Wrapper Min Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-nav-menu' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'slide_panel_section',
			[
				'label' => esc_html__( 'Slide Panel', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'slide_menu_type',
            [
                'label'   => esc_html__( 'Menu', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'theme-default' => esc_html__( 'Theme Default', 'noxfolio-toolkit' ),
                    'custom'        => esc_html__( 'Custom Menu', 'noxfolio-toolkit' ),
                ],
                'default' => 'theme-default',
            ]
        );

        $this->add_control(
            'slide_selected_menu',
            [
                'label'     => esc_html__( 'Select Menu', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus_list(),
                'condition' => [
                    'slide_menu_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'mobile_breakpoint',
            [
                'label'   => esc_html__( 'Breakpoint', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'mobile-expand-all'  => esc_html__( 'All Screen', 'noxfolio-toolkit' ),
                    'mobile-expand-xl'   => esc_html__( 'Large (< 1200px)', 'noxfolio-toolkit' ),
                    'mobile-expand-lg'   => esc_html__( 'Tablet (< 1025px)', 'noxfolio-toolkit' ),
                    'mobile-expand-md'   => esc_html__( 'Mobile (< 768px)', 'noxfolio-toolkit' ),
                    'mobile-expand-none' => esc_html__( 'None', 'noxfolio-toolkit' ),
                ],
                'default' => 'mobile-expand-lg',
            ]
        );

        $this->add_control(
            'toggle_alignment',
            [
                'label'       => esc_html__( 'Toggle Alignment', 'noxfolio-toolkit' ),
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
                'default'     => 'flex-end',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .noxfolio-nav-menu' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_logo_form',
            [
                'label'   => esc_html__( 'Panel Logo', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'panel_logo_type',
            [
                'label'     => esc_html__( 'Type', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'text'  => esc_html__( 'Text', 'noxfolio-toolkit' ),
                    'image' => esc_html__( 'Image', 'noxfolio-toolkit' ),
                ],
                'default'   => 'text',
                'condition' => [
                    'panel_logo_form' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'panel_text_logo',
            [
                'label'      => esc_html__( 'Text logo', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => 'Noxfolio',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'panel_logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'panel_logo_type',
                            'operator' => '==',
                            'value'    => 'text',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'panel_image_logo',
            [
                'label'      => esc_html__( 'Image Logo', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' => NT_THEME_ASSETS . '/img/options/logo.png',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'panel_logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'panel_logo_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'show_panel_button',
            [
                'label'        => esc_html__( 'Show Panel Button', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Button Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Get A Quote', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Button Text', 'noxfolio-toolkit' ),
                'condition'   => [
                    'show_panel_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__( 'Button URL', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => false,
                    'nofollow'          => false,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Enter button URL', 'noxfolio-toolkit' ),
                'condition'   => [
                    'show_panel_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'       => esc_html__( 'Button Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'label_block' => false,
                'default'     => [
                    'value'   => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'show_panel_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'icon-right',
                'options'   => [
                    'icon-left'  => esc_html__( 'Before', 'noxfolio-toolkit' ),
                    'icon-right' => esc_html__( 'After', 'noxfolio-toolkit' ),
                ],
                'condition' => [
                    'show_panel_button'     => 'yes',
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Menu Items', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_item_spacing',
            [
                'label'       => esc_html__( 'Item Spacing', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 0,
                'max'         => 100,
                'selectors'   => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li' => 'margin: 0 {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_item_typography',
                'selector' => '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li a',
            ]
        );

        $this->add_control(
            'submenu_heading',
            [
                'label'     => esc_html__( 'Submenu', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submenu_bg',
            [
                'label'     => esc_html__( 'Submenu Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'submenu_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper .sub-menu',
            ]
        );

        $this->add_control(
            'submenu_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submenu_item_typography',
                'selector' => '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper .sub-menu a',
            ]
        );

        $this->start_controls_tabs( 'nav-menu-tab' );

        $this->start_controls_tab(
            'menu_item_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper ul.sub-menu li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menu_item_hover',
            [
                'label' => esc_html__( 'Hover/Current', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li a:hover'               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper li.current_page_item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_hover_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .nav-menu-wrapper ul.sub-menu li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'panel_style',
            [
                'label' => esc_html__( 'Slide Panel', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggler_color',
            [
                'label'     => esc_html__( 'Toggler Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .navbar-toggler'       => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-nav-menu .navbar-toggler .line' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'panel_bg',
            [
                'label'     => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_typography',
                'selector' => '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a',
            ]
        );

        $this->add_control(
            'panel_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper ul.primary-menu'                      => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a'                  => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a .submenu-toggler' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'panel-menu-tab' );

        $this->start_controls_tab(
            'panel_item_normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-close'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'panel_item_hover',
            [
                'label' => esc_html__( 'Current', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'logo_heading',
            [
                'label'     => esc_html__( 'Panel Logo', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'logo_typography',
                'selector' => '{{WRAPPER}} .slide-panel-logo',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slide-panel-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label'          => esc_html__( 'Max Width', 'noxfolio-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slide-panel-logo' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slide_panel_button',
            [
                'label'     => esc_html__( 'Slide Panel Button', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_panel_button' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_wrapper_padding',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

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
                'default'   => '',
                'selectors' => [
					'{{WRAPPER}} .noxfolio-button, {{WRAPPER}} .noxfolio-button .button-text, {{WRAPPER}} .noxfolio-button .button-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .noxfolio-button .button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
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
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover, {{WRAPPER}} .noxfolio-button:hover .button-text, {{WRAPPER}} .noxfolio-button:hover .button-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .noxfolio-button:hover .button-icon svg' => 'fill: {{VALUE}};',
                ],
			]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'Button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover ' => 'border-color: {{VALUE}};',
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
    }

    /**
     * Render Button
     *
     * @return void
     */
    protected function render_button() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'button_wrapper' => [
				'class' => 'noxfolio-button-wrapper',
			],
			'button'  => [
				'class' => [
					'noxfolio-button',
					$settings['icon_align'],
				],
			],
		] );

		if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }

		?>
		<div <?php $this->print_render_attribute_string( 'button_wrapper' );?>>
			<a <?php $this->print_render_attribute_string( 'button' );?>>
				<span class="button-text">
					<?php echo nt_kses_basic( $settings['button_text'] );?>
        		</span>
				<?php if ( ! empty( $settings['selected_icon']['value'] ) ):  ?>
				<span class="button-icon">
					<?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?>
				</span>
				<?php endif; ?>
			</a>
		</div>
		<?php
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
        $settings = $this->get_settings();

        $args = [
            'container'       => 'div',
            'container_class' => 'nav-menu-wrapper nav-' . $settings['menu_alignment'],
            'menu_class'      => 'primary-menu',
            'after'           => '',
            'link_before'     => '<span class="link-text">',
            'link_after'      => '</span>',
            'fallback_cb'     => false,
			'depth'           => 4,
        ];

        if ( 'custom' == $settings['menu_type'] && ! empty( $settings['selected_menu'] ) ) {
            $args['menu'] = $settings['selected_menu'];
        } elseif ( has_nav_menu( 'primary_menu' ) ) {
            $args['theme_location'] = 'primary_menu';
        }

        $panel_logo_type  = Noxfolio_Helper::get_option( 'panel_logo_type', 'text' );
        $panel_text_logo  = Noxfolio_Helper::get_option( 'panel_text_logo', __( 'noxfolio', 'noxfolio-toolkit' ) );
        $panel_image_logo = Noxfolio_Helper::get_option( 'panel_image_logo', ['url' => get_template_directory_uri() . '/assets/img/logo.png'] );

        ?>
        <nav class="noxfolio-nav-menu <?php echo esc_attr( $settings['mobile_breakpoint'] ) ?>">
            <?php wp_nav_menu( $args );?>
            <div class="navbar-toggler">
                <span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </div>
            <div class="slide-panel-wrapper">
                <div class="slide-panel-overly"></div>
                <div class="slide-panel-content">
                    <div class="slide-panel-close">
                        <i class="fal fa-times"></i>
                    </div>
                    <div class="slide-panel-logo">
                        <?php if ( 'custom' === $settings['panel_logo_form'] ): ?>
                            <?php if ( 'text' === $settings['panel_logo_type'] ): ?>
                                <?php echo esc_html( $settings['panel_text_logo'] ) ?>
                            <?php elseif ( $settings['panel_image_logo']['url'] ): ?>
                                <img src="<?php echo esc_url( $settings['panel_image_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif;?>
                        <?php else: ?>
                            <?php if ( 'text' === $panel_logo_type && ! empty( $panel_text_logo ) ): ?>
                                <?php echo esc_html( $panel_text_logo ) ?>
                            <?php elseif ( 'image' === $panel_logo_type && ! empty( $panel_image_logo['url'] ) ): ?>
                                <img src="<?php echo esc_url( $panel_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                    <?php
						$panel_args = [
							'container'       => 'div',
							'container_class' => 'slide-panel-menu',
							'menu_class'      => 'primary-menu',
							'after'           => '',
							'link_before'     => '<span class="link-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => false,
							'depth'           => 4,
						];

						if ( 'custom' == $settings['slide_menu_type'] && ! empty( $settings['slide_selected_menu'] ) ) {
							$panel_args['menu'] = $settings['slide_selected_menu'];
						} elseif ( has_nav_menu( 'mobile_menu' ) ) {
							$panel_args['theme_location'] = 'mobile_menu';
						} elseif ( has_nav_menu( 'primary_menu' ) ) {
							$panel_args['theme_location'] = 'primary_menu';
						}

                        wp_nav_menu( $panel_args );

						if ( 'yes' === $settings['show_panel_button'] ) {
							$this->render_button();
						}
                    ?>
                </div>
            </div>
        </nav>
        <?php
    }

    /**
     * Get Menus List
     *
     * @since 1.0.0
     * @access protected
     */
    protected function get_menus_list() {
        $nav_menus = [];
        $terms     = get_terms( 'nav_menu' );
        foreach ( $terms as $term ) {
            $nav_menus[$term->name] = $term->name;
        }

        return $nav_menus;
    }
}
