<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use NoxfolioToolkit\ElementorAddon\Traits\Carousel_Helper;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
defined( 'ABSPATH' ) || exit;

class Client_Logos extends Widget_Base {

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
        return 'noxfolio-client-logos';
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
        return esc_html__( 'Client Logos', 'noxfolio-toolkit' );
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
        return 'eicon-logo webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'logo', 'carousel', 'brand', ' client', 'slider'];
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
            'section_brand_logos',
            [
                'label' => esc_html__( 'Brad Logos', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'   => esc_html__( 'Grid', 'noxfolio-toolkit' ),
                    'carousel' => esc_html__( 'Carousel', 'noxfolio-toolkit' ),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__( 'Brand Name', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter brand name', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'logo',
            [
                'type'    => Controls_Manager::MEDIA,
                'label'   => esc_html__( 'Image', 'noxfolio-toolkit' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'url',
            [
                'label'       => esc_html__( 'URL', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'               => '#',
                    'is_external'       => false,
                    'nofollow'          => false,
                    'custom_attributes' => '',
                ],
                'placeholder' => esc_html__( 'Enter website URL', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'logo_items',
            [
                'label'   => esc_html__( 'Items', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => esc_html__( 'Brand One', 'noxfolio-toolkit' ),
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'name' => esc_html__( 'Brand Two', 'noxfolio-toolkit' ),
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'name' => esc_html__( 'Brand Three', 'noxfolio-toolkit' ),
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'name' => esc_html__( 'Brand Four', 'noxfolio-toolkit' ),
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'name' => esc_html__( 'Brand Five', 'noxfolio-toolkit' ),
                        'logo' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'url'  => [
                            'url' => '#',
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium',
                'separator' => 'before',
                'exclude'   => [
                    'custom',
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
                    '5' => esc_html__( '5 column', 'noxfolio-toolkit' ),
                    '6' => esc_html__( '6 column', 'noxfolio-toolkit' ),
                ],
                'default'              => '',
                'tablet_extra_default' => '',
                'tablet_default'       => '',
                'mobile_default'       => '',
                'condition'            => [
                    'layout' => 'grid',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .noxfolio-client-logos' => 'grid-template-columns: repeat( {{VALUE}}, 1fr );',
                ],
            ]
        );

        $this->end_controls_section();

        $default_view = [
            'per_view_desk'   => 5,
            'per_view_tab'    => 3,
            'per_view_mobile' => 2,
        ];

		$this->register_carousel_options(['layout_condition' => true, 'per_view_default' => $default_view]);

		$this->start_controls_section(
            'carousel_item_style-section',
            [
                'label' => esc_html__( 'Logo Wrap', 'noxfolio-toolkit' ),
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
                    '{{WRAPPER}} .noxfolio-client-logos' => 'column-gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-client-logos' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_carousel_padding',
            [
                'label'      => esc_html__( 'Padding', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_carousel_margin',
            [
                'label'      => esc_html__( 'Margin', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'box_item_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .noxfolio-client-logos .logo-wrap',
            ]
        );

        $this->add_control(
            'box_item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'carousel_item_tab' );

        $this->start_controls_tab( 'carousel_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'logo_carousel_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_item_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-client-logos .logo-wrap',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'carousel_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'noxfolio-toolkit' ),
            ]
        );

        $this->add_control(
            'logo_hover_carousel_bg',
            [
                'label'     => esc_html__( 'Background Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'logo_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-client-logos .logo-wrap:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_item_hover_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-client-logos .logo-wrap:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs( 'carousel_item_tab' );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__( 'Logo Image', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'img_v_alignment',
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
                    '{{WRAPPER}} .logo-wrap' => 'align-items: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'img_h_alignment',
            [
                'label'     => esc_html__( 'Horizontal Alignment', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'toggle'    => false,
                'selectors' => [
                    '{{WRAPPER}} .logo-wrap' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .logo-wrap img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_max_width',
            [
                'label'      => esc_html__( 'Max Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .logo-wrap img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .logo-wrap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_img_fit',
            [
                'label'     => esc_html__( 'Object Fit', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''        => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'fill'    => esc_html__( 'Fill', 'noxfolio-toolkit' ),
                    'cover'   => esc_html__( 'Cover', 'noxfolio-toolkit' ),
                    'contain' => esc_html__( 'Contain', 'noxfolio-toolkit' ),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .logo-wrap img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'img_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .logo-wrap img',
            ]
        );

        $this->add_control(
            'img_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .logo-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'img_item_tab' );

        $this->start_controls_tab( 'img_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

		$this->add_control(
			'image_opacity',
			[
				'label'   => esc_html__( 'Opacity', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
				],
				'selectors' => [
					 '{{WRAPPER}} .logo-wrap img' => 'opacity: {{SIZE}}',
				 ],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'normal_image_filter',
				'selector' => '{{WRAPPER}} .logo-wrap img',
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img_shadow',
                'selector' => '{{WRAPPER}} .logo-wrap img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'img_hover_tab',
            [
                'label' => esc_html__( 'Normal', 'noxfolio-toolkit' ),
            ]
        );

		$this->add_control(
			'image_hover_opacity',
			[
				'label'   => esc_html__( 'Opacity', 'noxfolio-toolkit' ),
				'type'    => Controls_Manager::SLIDER,
				'range'   => [
					'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
				],
				'selectors' => [
					 '{{WRAPPER}} .logo-wrap:hover img' => 'opacity: {{SIZE}}',
				 ],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'hover_image_filter',
				'selector' => '{{WRAPPER}} .logo-wrap:hover img',
			]
		);

        $this->add_control(
            'img_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo-wrap:hover img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'img-hover_shadow',
                'selector' => '{{WRAPPER}} .logo-wrap:hover img',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

		$this->register_arrows_options(['layout_condition' => true]);
		$this->register_dots_options(['layout_condition' => true]);
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
	public function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['logo_items'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'noxfolio-client-logos' );

        if( 'carousel' == $settings['layout'] ) {
            $this->add_render_attribute( 'wrapper', 'class', 'noxfolio-carousel-wrapper' );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <?php if( 'grid' == $settings['layout'] ) :
				foreach ( $settings['logo_items'] as $index => $item ) {
					$this->render_single_item( $settings, $item, $index );
				}
			elseif( 'carousel' == $settings['layout'] ) : ?>
			<div class="noxfolio-carousel-active">
				<?php foreach ( $settings['logo_items'] as $index => $item ) : ?>
				<div class="noxfolio-carousel-item">
					<?php $this->render_single_item( $settings, $item, $index );; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<?php $this->render_carousel_navigation(); ?>
			<?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render single item
     *
     * @param array $item
     * @return void
     */
    protected function render_single_item( $settings, $item, $index ) {
        ?>
        <div class="logo-wrap">
            <?php
			$image = wp_get_attachment_image_url( $item['logo']['id'], $settings['thumbnail_size'] );
			if ( ! $image ) {
				$image = $item['logo']['url'];
			}
			?>
			<img
				src="<?php echo esc_url( $image ); ?>"
				title="<?php echo esc_attr( $item['name'] ); ?>"
				alt="<?php echo esc_attr( $item['name'] ); ?>"
			>
			<?php
            if ( $item['url']['url'] ) {
                $url_key = $this->get_repeater_setting_key( 'url', 'full', $index );

                $this->add_link_attributes( $url_key, $item['url'] );
                $this->add_render_attribute( $url_key, 'class', 'item-url' );

                printf( '<a %1$s></a>',
                    $this->get_render_attribute_string( $url_key )
                );
            }
            ?>
        </div>
        <?php
    }
}
