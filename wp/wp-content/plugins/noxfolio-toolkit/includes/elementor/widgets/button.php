<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Button extends Widget_Base {

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
        return 'noxfolio-button';
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
        return esc_html__( 'Button', 'noxfolio-toolkit' );
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
        return 'eicon-button webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'button', 'link'];
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
            'text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Click Here', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Button Text', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => false,
                    'nofollow'          => false,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Enter button URL', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Button Alignment', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button-wrapper' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'label_block' => false,
                'default'     => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
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
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_css_id',
            [
                'label'       => esc_html__( 'Button ID', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => '',
                'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'noxfolio-toolkit' ),
                'description' => sprintf(
                    /* translators: 1: Code open tag, 2: Code close tag. */
                    esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'noxfolio-toolkit' ),
                    '<code>',
                    '</code>'
                ),
                'separator'   => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Button', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_padding',
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
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'custom'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_content_justify',
            [
                'label'     => esc_html__( 'Justify Content', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .noxfolio-button' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_content_align',
            [
                'label'     => esc_html__( 'Align Content', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'start'  => [
                        'title' => esc_html__( 'Start', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-center-v',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'End', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-justify-end-v',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .noxfolio-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .noxfolio-button',
            ]
        );

        $this->add_control(
            'border_radius',
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
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_bg',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'selector'       => '{{WRAPPER}} .noxfolio-button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'      => 'text_shadow',
				'selector'  => '{{WRAPPER}} .noxfolio-button',
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
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'button_hover_bg',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'selector'       => '{{WRAPPER}} .noxfolio-button:hover',
			]
		);

		$this->add_control(
			'hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .noxfolio-button:hover ' => 'border-color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-button:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'hover_box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_area',
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
                    '{{WRAPPER}} .button-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-button' => '--icon-spacing: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
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
                    '{{WRAPPER}} .button-icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'icon_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .button-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .button-icon i, {{WRAPPER}} .button-icon svg' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tab' );

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
                    '{{WRAPPER}} .noxfolio-button .button-icon'     => 'color: {{VALUE}}',
                    '{{WRAPPER}} .noxfolio-button .button-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button .button-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .button-icon',
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
                    '{{WRAPPER}} .noxfolio-button:hover .button-icon'     => 'color: {{VALUE}}',
                    '{{WRAPPER}} .noxfolio-button:hover .button-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover .button-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-button:hover .button-icon' => 'border-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .noxfolio-button:hover .button-icon',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
        $settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'wrapper' => [
				'class' => 'noxfolio-button-wrapper',
			],
			'button'  => [
				'class' => [
					'noxfolio-button',
					$settings['icon_align'],
				],
			],
			'text'    => [
				'class' => 'button-text',
			],
		] );

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }

        if ( ! empty( $settings['button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
        }

        $this->add_inline_editing_attributes( 'text', 'none' );
        ?>
		<div <?php $this->print_render_attribute_string( 'wrapper' );?>>
			<a <?php $this->print_render_attribute_string( 'button' );?>>
				<span <?php $this->print_render_attribute_string( 'text' );?>>
					<?php echo nt_kses_basic( $settings['text'] );?>
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
     * Render button widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template() {
        ?>
		<#
		var button_class = 'noxfolio-button' + ' ' + settings.icon_align

		view.addRenderAttribute( 'text', 'class', 'button-text' );
		view.addInlineEditingAttributes( 'text', 'none' );
		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, {}, 'i' , 'object' );
		#>
		<div class="noxfolio-button-wrapper">
			<a id="{{ settings.button_css_id }}" class="{{{ button_class }}}" href="{{ settings.link.url }}">
				<span {{{ view.getRenderAttributeString( 'text' ) }}}>
                    {{{ settings.text }}}
                </span>
                <# if ( settings.selected_icon.value ) { #>
				<span class="button-icon">
                    <# if ( iconHTML.rendered ) { #>
                        {{{ iconHTML.value }}}
                    <# } #>
                </span>
                <# } #>
			</a>
		</div>
		<?php
    }
}
