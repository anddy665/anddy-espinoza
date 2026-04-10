<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use NoxfolioToolkit\ElementorAddon\Traits\Carousel_Helper;

defined( 'ABSPATH' ) || exit;

class Testimonials extends Widget_Base {
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
        return 'noxfolio-testimonials';
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
        return esc_html__( 'Testimonials', 'noxfolio-toolkit' );
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
        return 'eicon-testimonial webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'testimonial', 'feedback', 'client'];
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

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'placeholder' => esc_html__( 'Enter Name', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'placeholder' => esc_html__( 'Enter Title', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'placeholder' => esc_html__( 'Enter Testimonial Content', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'   => esc_html__( 'Image', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'       => esc_html__( 'Testimonials', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'name'        => esc_html__( 'Rodolfo E. Shannon', 'noxfolio-toolkit' ),
                        'title'       => esc_html__( 'CEO & Founder', 'noxfolio-toolkit' ),
                        'description' => esc_html__( 'I have been using Noxfolio for the past few months, and I am blown away by its performance.', 'noxfolio-toolkit' ),
                        'image'       => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'        => esc_html__( 'James N. Johnson', 'noxfolio-toolkit' ),
                        'title'       => esc_html__( 'Web Developer', 'noxfolio-toolkit' ),
                        'description' => esc_html__( 'I have been using Noxfolio for the past few months, and I am blown away by its performance.', 'noxfolio-toolkit' ),
                        'image'       => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name'        => esc_html__( 'Kenneth J. Luton', 'noxfolio-toolkit' ),
                        'title'       => esc_html__( 'Web Designer', 'noxfolio-toolkit' ),
                        'description' => esc_html__( 'I have been using Noxfolio for the past few months, and I am blown away by its performance.', 'noxfolio-toolkit' ),
                        'image'       => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label'       => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-quote-left',
                    'library' => 'fa-solid',
                ],
                'skin'        => 'inline',
                'label_block' => false,
                'separator'   => 'before',
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
				    '{{WRAPPER}} .noxfolio-testimonials' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
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
            'box_style_section',
            [
                'label' => esc_html__( 'Testimonial', 'noxfolio-toolkit' ),
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
                    '{{WRAPPER}} .noxfolio-testimonial-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-testimonial-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-testimonial-box' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => esc_html__( 'Border', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-testimonial-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box',
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
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover' => 'border-color: {{VALUE}}',
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
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__( 'Image', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_heading',
            [
                'label'     => esc_html__( 'Image', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'img_width',
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
                    '{{WRAPPER}} .author-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height',
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
                    '{{WRAPPER}} .author-image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .author-image img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .author-image img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_heading',
            [
                'label'     => esc_html__( 'Quote Icon', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'quote_size',
            [
                'label'     => esc_html__( 'Area Size', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .quote-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'quote_font_size',
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
                    '{{WRAPPER}} .noxfolio-testimonial-box .quote-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs( 'quote_icon_tab' );

        $this->start_controls_tab(
            'quote_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'quote_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .quote-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quote_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .quote-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'quote_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'quote_hover_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover .quote-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'quote_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover .quote-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label' => esc_html__( 'Description', 'noxfolio-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box .description',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box:hover .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_gap',
            [
                'label'     => esc_html__( 'Bottom Gap', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label'     => esc_html__( 'Name', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box .name',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'name_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Tile', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => esc_html__( 'Typography', 'noxfolio-toolkit' ),
                'selector' => '{{WRAPPER}} .noxfolio-testimonial-box .name',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-testimonial-box .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->register_arrows_options( ['layout_condition' => true] );

        $this->register_dots_options( ['layout_condition' => true] );
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

        if ( empty( $settings['testimonials'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'noxfolio-testimonials' );

        if( 'carousel' == $settings['layout'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'noxfolio-carousel-wrapper' );
        }

        ?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if( 'grid' == $settings['layout'] ) :
				foreach ( $settings['testimonials'] as $item ) {
                    $this->render_single_item( $item, $settings );
                }
			elseif( 'carousel' == $settings['layout'] ) : ?>
			<div class="noxfolio-carousel-active">
				<?php foreach ( $settings['testimonials'] as $item ) : ?>
				<div class="noxfolio-carousel-item">
					<?php $this->render_single_item( $item, $settings ); ?>
				</div>
				<?php endforeach; ?>
			</div>
			<?php $this->render_carousel_navigation(); ?>
			<?php endif; ?>
        </div>
        <?php
    }

	/**
	 * Render Single Item
	 *
	 * @param int $index
	 * @param array $testimonial
	 * @return void
	 */
	private function render_single_item( $item, $settings ) {
		?>
		<div class="noxfolio-testimonial-box">
			<?php if ( $item['image']['url'] || $item['image']['id'] ) : ?>
			<div class="author-image">
				<?php if ( $settings['quote_icon']['value'] ) : ?>
				<span class="quote-icon">
					<?php Icons_Manager::render_icon( $settings['quote_icon'] );?>
				</span>
				<?php endif; ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'full', 'image' )?>
			</div>
			<?php endif; ?>
			<?php
				if( $item['description'] ) {
					printf( '<p class="description">%1$s</p>',
						nt_kses_basic( $item['description'] )
					);
				}
			?>
			<div class="author-info">
				<?php
					if( $item['name'] ) {
						printf( '<h4 class="name">%1$s</h4>',
							esc_html( $item['name'] )
						);
					}
					if( $item['title'] ) {
						printf( '<span class="title">%1$s</span>',
							esc_html( $item['title'] )
						);
					}
				?>
			</div>
		</div>
		<?php
	}
}