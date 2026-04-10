<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use NoxfolioTheme\Classes\Noxfolio_Helper;

defined( 'ABSPATH' ) || exit;

class Site_Logo extends Widget_Base {

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
        return 'noxfolio-site-logo';
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
        return esc_html__( 'Site Logo', 'noxfolio-toolkit' );
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
        return 'eicon-site-logo webtend-logo';
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
        return ['noxfolio', 'toolkit', 'header', 'footer', 'logo', 'site'];
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
            'logo_form',
            [
                'label'   => esc_html__( 'Logo', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label'     => esc_html__( 'Type', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'text'  => esc_html__( 'Text', 'noxfolio-toolkit' ),
                    'image' => esc_html__( 'Image', 'noxfolio-toolkit' ),
                ],
                'default'   => 'text',
                'condition' => [
                    'logo_form' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'text_logo',
            [
                'label'      => esc_html__( 'Text logo', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => 'Noxfolio',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'logo_type',
                            'operator' => '==',
                            'value'    => 'text',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'image_logo',
            [
                'label'      => esc_html__( 'Image Logo', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' => NT_THEME_ASSETS . '/img/logo.png',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'logo_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_alignment',
            [
                'label'       => esc_html__( 'Logo Alignment', 'noxfolio-toolkit' ),
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
                'default'     => 'left',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .noxfolio-site-logo' => 'text-align: {{VALUE}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'   => esc_html__( 'URL Type', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'noxfolio-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'label'       => esc_html__( 'Custom URL', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => home_url(),
                'condition'   => [
                    'url_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Style', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'logo_typography',
                'selector' => '{{WRAPPER}} .noxfolio-site-logo',
            ]
        );

        $this->add_control(
            'logo_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-site-logo a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'logo_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-site-logo a:hover' => 'color: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .noxfolio-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .noxfolio-site-logo a img' => 'max-width: {{SIZE}}{{UNIT}};',
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
        $settings = $this->get_settings();

        if ( 'custom' === $settings['url_type'] && ! empty( $settings['custom_url']['url'] ) ) {
            $url = $settings['custom_url']['url'];
        } else {
            $url = home_url();
        }

        $site_logo_type  = Noxfolio_Helper::get_option( 'site_logo_type', 'text' );
        $site_text_logo  = Noxfolio_Helper::get_option( 'site_text_logo', 'Noxfolio' );
        $site_image_logo = Noxfolio_Helper::get_option( 'site_image_logo', ['url' => ''] );
        ?>
        <div class="noxfolio-site-logo">
            <a href="<?php echo esc_url( $url ) ?>">
                <?php if ( 'custom' === $settings['logo_form'] ): ?>
                    <?php if ( 'text' === $settings['logo_type'] ): ?>
                        <?php echo esc_html( $settings['text_logo'] ) ?>
                    <?php elseif ( $settings['image_logo']['url'] ): ?>
                        <img src="<?php echo esc_url( $settings['image_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif;?>
                <?php else: ?>
                    <?php if ( 'text' === $site_logo_type && ! empty( $site_text_logo ) ): ?>
                        <?php echo esc_html( $site_text_logo ) ?>
                    <?php elseif ( 'image' === $site_logo_type && ! empty( $site_image_logo['url'] ) ): ?>
                        <img src="<?php echo esc_url( $site_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif;?>
                <?php endif;?>
            </a>
        </div>
        <?php
    }
}