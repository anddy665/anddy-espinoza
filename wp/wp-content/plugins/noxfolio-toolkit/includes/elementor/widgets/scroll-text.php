<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Scroll_Text extends Widget_Base {

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
        return 'noxfolio-scroll-text';
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
        return esc_html__( 'Scroll Text', 'noxfolio-toolkit' );
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
        return 'eicon-ellipsis-h webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'scroll', 'text', 'timeline'];
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
                'label' => esc_html__( 'Texts', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_type',
            [
                'label'       => esc_html__( 'Text type', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'normal'   => esc_html__( 'Normal text', 'noxfolio-toolkit' ),
                    'separate' => esc_html__( 'Separate Text', 'noxfolio-toolkit' ),
                ],
                'default'     => 'separate',
            ]
        );

        $this->add_control(
            'scroll_text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Web Designer Developer', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Enter Scroll Text', 'noxfolio-toolkit' ),
                'condition'   => [
                    'text_type' => 'normal',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your text', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'custom_style',
            [
                'label'        => esc_html__( 'Custom Style', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'no', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $repeater->add_control(
            'single_text_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'single_text_typography',
                'label'     => esc_html__( 'Text Typography', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'single_text_shadow',
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'      => 'single_text_stroke',
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [
                    'custom_style' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'scroll_texts',
            [
                'label'       => esc_html__( 'Texts', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'text' => esc_html__( 'Product Design', 'noxfolio-toolkit' ),
                    ],
                    [
                        'text' => esc_html__( 'Digital Marketing', 'noxfolio-toolkit' ),
                    ],
                    [
                        'text' => esc_html__( 'Art Direction', 'noxfolio-toolkit' ),
                    ],
                    [
                        'text' => esc_html__( 'UI/UX Design', 'noxfolio-toolkit' ),
                    ],
                    [
                        'text' => esc_html__( 'Motion Graphics', 'noxfolio-toolkit' ),
                    ],
                ],
                'title_field' => '{{{ text }}}',
                'condition'   => [
                    'text_type' => 'separate',
                ],
            ]
        );

        $this->add_control(
            'scroll_direction',
            [
                'label'       => esc_html__( 'Scroll Direction', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    'scroll-left'  => esc_html__( 'Right to Left', 'noxfolio-toolkit' ),
                    'scroll-right' => esc_html__( 'Left to Right', 'noxfolio-toolkit' ),
                ],
                'default'     => 'scroll-left',
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label'     => esc_html__( 'Animation Duration(Second)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 1,
                'selectors' => [
                    '{{WRAPPER}} .scroll-text-inner' => 'animation-duration: {{VALUE}}s',
                ],
            ]
        );

        $this->add_control(
            'divider_type',
            [
                'label'     => esc_html__( 'Divider Type', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'default' => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'text'    => esc_html__( 'Text', 'noxfolio-toolkit' ),
                    'icon'    => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                ],
                'separator' => 'before',
                'default'   => 'icon',
            ]
        );

        $this->add_control(
            'divider_icon',
            [
                'label'     => esc_html__( 'Divider Icon', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star-of-life',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'divider_type' => 'icon',
                ],
            ],
        );

        $this->add_control(
            'divider_text',
            [
                'label'       => esc_html__( 'Divider Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( '_', 'noxfolio-toolkit' ),
                'placeholder' => esc_html__( 'Divider Text', 'noxfolio-toolkit' ),
                'condition'   => [
                    'divider_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label'     => esc_html__( 'HTML Tag', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'h1'  => 'H1',
                    'h2'  => 'H2',
                    'h3'  => 'H3',
                    'h4'  => 'H4',
                    'h5'  => 'H5',
                    'h6'  => 'H6',
                    'div' => 'div',
                    'p'   => 'p',
                ],
                'default'   => 'h5',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => esc_html__( 'Pause On Hover', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'clone_text',
            [
                'label'        => esc_html__( 'Clone Text', 'noxfolio-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
                'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'clone_count',
            [
                'label'       => esc_html__( 'Clone', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    '1'  => esc_html__( 'One Times', 'noxfolio-toolkit' ),
                    '2'  => esc_html__( 'Two Times', 'noxfolio-toolkit' ),
                    '3'  => esc_html__( 'Three Times', 'noxfolio-toolkit' ),
                    '4'  => esc_html__( 'Four Times', 'noxfolio-toolkit' ),
                    '5'  => esc_html__( 'Five Times', 'noxfolio-toolkit' ),
                    '6'  => esc_html__( 'Six Times', 'noxfolio-toolkit' ),
                    '7'  => esc_html__( 'Seven Times', 'noxfolio-toolkit' ),
                    '8'  => esc_html__( 'Eight Times', 'noxfolio-toolkit' ),
                    '9'  => esc_html__( 'Nine Times', 'noxfolio-toolkit' ),
                    '10' => esc_html__( 'Ten Times', 'noxfolio-toolkit' ),
                ],
                'default'     => '2',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'text_style_section',
            [
                'label' => esc_html__( 'Text Style', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-scroll-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-scroll-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-scroll-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__( 'Text Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-scroll-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-scroll-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'text_stroke',
                'selector' => '{{WRAPPER}} .noxfolio-scroll-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'text_bg',
                'label'    => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .noxfolio-scroll-text',
            ]
        );

        $this->add_control(
            'text_v_alignment',
            [
                'label'     => esc_html__( 'Vertical Alignment', 'noxfolio-toolkit' ),
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
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-scroll-text' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .scroll-text-inner'    => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'divider_style',
            [
                'label'     => esc_html__( 'Divider Style', 'noxfolio-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'divider_size',
            [
                'label'     => esc_html__( 'Size', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'divider_type' => 'icon',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'divider_typo',
                'label'     => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector'  => '{{WRAPPER}} .divider',
                'condition' => [
                    'divider_type' => 'text',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'      => 'divider_stroke',
                'selector'  => '{{WRAPPER}} .divider',
                'condition' => [
                    'divider_type' => 'text',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_spacing',
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
                    '{{WRAPPER}} .divider' => 'margin: 0 {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Icon Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'color: {{VALUE}}; fill: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Scroll Text
     *
     * @return void
     */
    private function add_divider() {
        $settings = $this->get_settings_for_display();
        ?>
		<span class="divider">
			<?php if ( 'text' === $settings['divider_type'] ) {
				echo esc_html( $settings['divider_text'] );
			} elseif ( 'icon' === $settings['divider_type'] ) {
				Icons_Manager::render_icon( $settings['divider_icon'] );
			} else {
				echo "&nbsp;";
			}?>
		</span>
		<?php
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

		$this->add_render_attribute( 'wrapper', [
			'class' => 'noxfolio-scroll-text ' . $settings['scroll_direction']
		] );

		if ( 'yes' === $settings['pause_on_hover'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'pause-on-hover' );
        }

		$clone_count = ( 'yes' === $settings['clone_text'] && ! empty( $settings['clone_count'] ) ) ? $settings['clone_count'] : 1;

        ?>
		<<?php echo nt_escape_tags( $settings['html_tag'] ) . ' ' . $this->get_render_attribute_string( 'wrapper' ) ?>>
			<?php for ( $x = 0; $x <= $clone_count; $x++ ) {
				if ( 'normal' === $settings['text_type'] ): ?>
				<span class="scroll-text-inner">
					<span class="text">
						<?php echo nt_kses_basic( $settings['scroll_text'] ) ?>
					</span>
					<?php $this->add_divider(); ?>
				</span>
				<?php elseif ( 'separate' === $settings['text_type'] ): ?>
				<span class="scroll-text-inner">
					<?php foreach ( $settings['scroll_texts'] as $index => $item ): ?>
					<span class="text elementor-repeater-item-<?php echo $item['_id']; ?>">
						<?php echo nt_kses_basic( $item['text'] ) ?>
					</span>
					<?php $this->add_divider(); ?>
					<?php endforeach?>
				</span>
				<?php endif;
			} ?>
		</<?php echo nt_escape_tags( $settings['html_tag'] ) ?>>
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
			view.addRenderAttribute( 'wrapper', {
				'class' : 'noxfolio-scroll-text ' + settings.scroll_direction
			} );

			if ( 'yes' == settings.pause_on_hover ) {
				view.addRenderAttribute( 'wrapper', 'class', 'pause-on-hover' );
			}

			var clone_count = ('yes' == settings.clone_text && settings.clone_count) ? settings.clone_count : 1;
            var iconHTML = elementor.helpers.renderIcon( view, settings.divider_icon, {}, 'i' , 'object' );

		#>
		<{{{ settings.html_tag }}} {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<# for ( var x = 0; x <= clone_count; x++ ) {
				if ( 'normal' == settings.text_type ) { #>
					<span class="scroll-text-inner">
						<span class="text">
							{{{ settings.scroll_text }}}
						</span>
						<span class="divider">
							<# if ( 'text' == settings.divider_type ) { #>
								{{{ settings.divider_text }}}
							<# } else if ( 'icon' == settings.divider_type ) { #>
								{{{ iconHTML.value }}}
							<# } else {  #>
								&nbsp;
							<# } #>
						</span>
					</span>
				<# } else if ( 'separate' == settings.text_type ) { #>
					<span class="scroll-text-inner">
						<# _.each( settings.scroll_texts, function( item, index ) { #>
							<span class="text elementor-repeater-item-{{ item._id }}">
								{{{ item.text }}}
							</span>
							<span class="divider">
								<# if ( 'text' == settings.divider_type ) { #>
									{{{ settings.divider_text }}}
								<# } else if ( 'icon' == settings.divider_type ) { #>
									{{{ iconHTML.value }}}
								<# } else {  #>
									&nbsp;
								<# } #>
							</span>
						<# }); #>
					</span>
				<# }
			} #>
		</{{{ settings.html_tag }}}>
		<?php
	}
}