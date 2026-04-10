<?php

namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Section_Title extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'noxfolio-section-title';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Section Title', 'noxfolio-toolkit' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-heading webtend-logo';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that Currently, Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'noxfolio_elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'noxfolio', 'toolkit', 'webtend', 'heading', 'title' ];
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
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 5,
				'default'     => esc_html__( 'Real {{ Problem Solutions}} Experience', 'noxfolio-toolkit' ),
				'description' => esc_html__( '"Focused Title" Settings will be worked, If you use this {{something}} format', 'noxfolio-toolkit' ),
				'placeholder' => esc_html__( 'Type your section title', 'noxfolio-toolkit' ),
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
				'default'     => 'h3',
				'toggle'      => false,
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'label_block' => true,
				'default'     => esc_html__( 'My Resume', 'noxfolio-toolkit' ),
				'placeholder' => esc_html__( 'Type section subtitle', 'noxfolio-toolkit' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'show_title_icon',
			[
				'label'        => esc_html__( 'Show Icon', 'noxfolio-toolkit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'noxfolio-toolkit' ),
				'label_off'    => esc_html__( 'No', 'noxfolio-toolkit' ),
				'default'      => 'no',
				'return_value' => 'yes',

			]
		);

		$this->add_control(
			'selected_title_icon',
			[
				'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-star-of-life',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'show_title_icon' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => esc_html__( 'Text Alignment', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::CHOOSE,
				'separator' => 'before',
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
					'{{WRAPPER}} .noxfolio-section-title' => 'text-align: {{Value}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wrapper_style',
			[
				'label' => esc_html__( 'Section Title', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrapper_margin',
			[
				'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .noxfolio-section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => esc_html__( 'Subtitle', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'subtitle_text_shadow',
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'subtitle_text_stroke',
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_gap',
			[
				'label'     => esc_html__( 'Bottom Gap', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'noxfolio-toolkit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_control(
			'split_text_heading',
			[
				'label'     => esc_html__( 'Focused Text', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_split_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title .focus-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_split_typography',
				'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
				'selector' => '{{WRAPPER}} .title .focus-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_split_text_shadow',
				'selector' => '{{WRAPPER}} .title .focus-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'     => 'title_split_text_stroke',
				'selector' => '{{WRAPPER}} .title .focus-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_icon_style',
			[
				'label'     => esc_html__( 'Title Icon', 'noxfolio-toolkit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_icon_color',
			[
				'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_font_size',
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
					'{{WRAPPER}} .title-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'title_icon_gap',
			[
				'label'     => esc_html__( 'Gap', 'noxfolio-toolkit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
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
		$settings    = $this->get_settings_for_display();
		?>
		<div class="noxfolio-section-title">
			<?php if ( ! empty( $settings['subtitle'] ) ) :
				$this->add_render_attribute( 'subtitle', 'class', 'subtitle' );
				?>
				<span <?php $this->print_render_attribute_string( 'subtitle' ) ?>>
					<?php if ( 'yes' === $settings['show_title_icon'] && ! empty( $settings['selected_title_icon']['value'] ) ) : ?>
					<span class="title-icon">
						<?php Icons_Manager::render_icon( $settings['selected_title_icon'] ); ?>
					</span>
					<?php endif; ?>
					<?php echo nt_kses_basic( $settings['subtitle'] ); ?>
				</span>
			<?php endif; ?>
			<?php
				if ( ! empty( $settings['title'] ) ) {
					$this->add_render_attribute( 'title', 'class', 'title' );
					$title = preg_replace( '/{{(.*?)}}/', '<span class="focus-text">$1</span>', $settings['title'] );

					printf( '<%1$s %2$s>%3$s</%1$s>',
						nt_escape_tags( $settings['title_tag'], 'h3' ),
						$this->get_render_attribute_string( 'title' ),
						nt_kses_basic( $title )
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
		<div class="noxfolio-section-title">
			<# if ( settings.subtitle ) {
				view.addRenderAttribute( 'subtitle', 'class', 'subtitle' ); #>
				<span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>
					<# if ( settings.show_title_icon === 'yes' && settings.selected_title_icon.value ) {
						var iconHTML = elementor.helpers.renderIcon( view, settings.selected_title_icon, {}, 'i' , 'object' );
						#>
						<span class="title-icon">
							<# if ( iconHTML.rendered ) { #>
								{{{ iconHTML.value }}}
							<# } #>
						</span>
					<# } #>
					{{{ settings.subtitle }}}
				</span>
			<# } #>
			<# if ( settings.title ) {
				view.addRenderAttribute( 'title', 'class', 'title' );
				var title = settings.title;
					title = title.replace(/{{(.*?)}}/g, '<span class="focus-text">$1</span>');
				#>
				<{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title' ) }}}>
					{{{ title }}}
				</{{{ settings.title_tag }}}>
			<# } #>
		</div>
		<?php
	}
}
