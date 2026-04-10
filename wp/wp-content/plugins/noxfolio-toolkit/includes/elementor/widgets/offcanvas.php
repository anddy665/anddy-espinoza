<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Offcanvas extends Widget_Base {

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
        return 'noxfolio-offcanvas';
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
        return esc_html__( 'Off Canvas', 'noxfolio-toolkit' );
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
        return 'eicon-sidebar webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'offcanvas', 'toggle', 'sidebar'];
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
            'template_id',
            [
                'label'   => esc_html__( 'Select Template', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => nt_select_builder_block( 'offcanvas' ),
                'default' => '0',
            ]
        );

        $this->add_control(
            'canvas_position',
            [
                'label'   => esc_html__( 'Canvas Position', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  => esc_html__( 'Left', 'noxfolio-toolkit' ),
                    'right' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                ],
                'default' => 'right',
            ]
        );

        $this->add_control(
            'toggle_source',
            [
                'label'       => esc_html__( 'Toggle Source', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'line-icon'     => esc_html__( 'Line Icon', 'noxfolio-toolkit' ),
                    'line-icon-two' => esc_html__( 'Line Icon Two', 'noxfolio-toolkit' ),
                    'toggle-button' => esc_html__( 'Button', 'noxfolio-toolkit' ),
                ],
                'default'     => 'line-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Click Here', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Button Text', 'noxfolio-toolkit' ),
                'condition'   => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'skin'        => 'inline',
                'label_block' => false,
                'default'     => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'toggle_source' => 'toggle-button',
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
                    'button_icon[value]!' => '',
                    'toggle_source'       => 'toggle-button',
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
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button' => '--icon-spacing: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_icon[value]!' => '',
                    'toggle_source'       => 'toggle-button',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'toggle_style_section',
            [
                'label' => esc_html__( 'Toggle', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__( 'Alignment', 'noxfolio-toolkit' ),
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
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle-wrapper' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => true,
            ]
        );

        $this->add_control(
            'toggle_line_area',
            [
                'label'        => esc_html__( 'Toggle Area', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'None', 'noxfolio-toolkit' ),
                'label_on'     => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => '',
                'condition'    => [
                    'toggle_source!' => 'toggle-button',
                ],
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'toggle_area_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'toggle_line_area' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_area_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'toggle_line_area' => 'yes',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'toggle_area_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'toggle_source!' => 'toggle-button',
                ],
            ]
        );

        $this->add_control(
            'toggle_area_line_bg',
            [
                'label'     => esc_html__( 'Line Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle span' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'toggle_source!' => 'toggle-button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'toggle_area_line_border',
                'label'     => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle',
                'condition' => [
                    'toggle_source!' => 'toggle-button',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_area_line_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-offcanvas .offcanvas-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'toggle_source!' => 'toggle-button',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'toggle_button_type',
                'label'     => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} .offcanvas-toggle.toggle-button',
                'condition' => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'border',
                'selector'  => '{{WRAPPER}} .offcanvas-toggle.toggle-button',
                'condition' => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->start_controls_tabs( 'toggle_btn__style',
            [
                'condition' => [
                    'toggle_source' => 'toggle-button',
                ],
            ]
        );

        $this->start_controls_tab(
            'toggle_btn__normal',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'toggle_btn_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_btn__bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'toggle_btn_box_shadow',
                'selector' => '{{WRAPPER}} .offcanvas-toggle.toggle-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'toggle_btn_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'toggle_btn__hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button:hover'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_btn_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_btn_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-toggle.toggle-button:hover ' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'toggle_btn_hover_box_shadow',
                'selector' => '{{WRAPPER}} .offcanvas-toggle.toggle-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'close_style',
            [
                'label' => esc_html__( 'Close', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'close_width_height',
            [
                'label'      => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .offcanvas-close' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_font_size',
            [
                'label'      => esc_html__( 'Font Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .offcanvas-close' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'close_bg',
            [
                'label'     => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-close' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'close_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'canvas_style',
            [
                'label' => esc_html__( 'Canvas', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-offcanvas-wrapper .offcanvas-overly' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'canvas_width',
            [
                'label'       => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 100,
                'max'         => 2000,
                'selectors'   => [
                    '{{WRAPPER}} .noxfolio-offcanvas-wrapper .offcanvas-container' => 'width: {{VALUE}}px;',
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

		if ( ! $settings['template_id'] ) {
            return;
        }

		$this->add_render_attribute( 'toggle', [
			'class' => [ 'offcanvas-toggle', $settings['toggle_source'], ],
		] );

		if ( 'toggle-button' === $settings['toggle_source'] ) {
			$this->add_render_attribute( 'toggle', 'class', $settings['icon_align'] );
		}

        $this->add_inline_editing_attributes( 'button_text', 'none' );
		$this->add_render_attribute( 'button_text', 'class', 'button-text' );
        ?>
		<div class="noxfolio-offcanvas">
			<div class="offcanvas-toggle-wrapper">
				<div <?php $this->print_render_attribute_string( 'toggle' )  ?>>
					<?php if ( 'toggle-button' === $settings['toggle_source'] ): ?>
					<?php if ( $settings['button_text'] ) : ?>
					<span <?php $this->print_render_attribute_string( 'button_text' )  ?>>
						<?php echo nt_kses_basic( $settings['button_text'] ) ?>
					</span>
					<?php endif; ?>
					<?php if ( ! empty( $settings['button_icon']['value'] ) ):  ?>
					<span class="button-icon">
						<?php Icons_Manager::render_icon( $settings['button_icon'] ); ?>
					</span>
					<?php endif; ?>
					<?php else: ?>
					<div class="toggle-inner">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<?php endif;?>
				</div>
			</div>
			<div class="noxfolio-offcanvas-wrapper offcanvas-<?php echo esc_attr( $settings['canvas_position'] ) ?>">
                <div class="offcanvas-overly"></div>
                <div class="offcanvas-container">
                    <div class="offcanvas-close"><i class="fal fa-times"></i></div>
                    <?php echo Plugin::$instance->frontend->get_builder_content_for_display( $settings['template_id'], true ); ?>
                </div>
            </div>
		</div>
		<?php
	}
}