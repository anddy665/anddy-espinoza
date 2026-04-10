<?php
namespace NoxfolioToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Check_List extends Widget_Base {

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
        return 'noxfolio-check-list';
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
        return esc_html__( 'Check List', 'noxfolio-toolkit' );
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
        return 'eicon-bullet-list webtend-logo';
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
        return ['noxfolio', 'toolkit', 'webtend', 'list', 'check', 'icon'];
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
            'section_check_list',
            [
                'label' => esc_html__( 'Check List', 'noxfolio-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_text',
            [
                'label'       => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter list text', 'noxfolio-toolkit' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'   => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'list_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'label'       => esc_html__( 'Items', 'noxfolio-toolkit' ),
                'default'     => [
                    [
                        'list_text'     => esc_html__( 'Best Quality Services', 'noxfolio-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'User Experience Design', 'noxfolio-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'list_text'     => esc_html__( 'Professional Team Members', 'noxfolio-toolkit' ),
                        'selected_icon' => [
                            'value'   => 'fas fa-check',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'title_field' => '{{{ list_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_list',
            [
                'label' => esc_html__( 'List', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'check_list_spacing',
            [
                'label'      => esc_html__( 'Spacing Between', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
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
                    '{{WRAPPER}} .noxfolio-check-list li' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => false,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => esc_html__( 'Alignment', 'noxfolio-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'noxfolio-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'toggle'  => false,
                'default' => 'left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Background', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list' => '--icon-space: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Font Size', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_width',
            [
                'label'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'icon_height',
            [
                'label'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .noxfolio-check-list .list-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'noxfolio-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'custom'],
                'selectors'  => [
                    '{{WRAPPER}} .noxfolio-check-list .list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__( 'Text', 'noxfolio-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'check_list_color',
            [
                'label'     => esc_html__( 'Text Color', 'noxfolio-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .noxfolio-check-list .list-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'check_list_typography',
                'selector' => '{{WRAPPER}} .noxfolio-check-list .list-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .noxfolio-check-list .list-text',
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
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['list_items'] ) ) {
            return;
        }
    ?>
    <ul class="noxfolio-check-list icon-<?php echo esc_attr( $settings['icon_position'] ) ?>">
        <?php foreach( $settings['list_items'] as $index => $item ) :
            $list_text_key = $this->get_repeater_setting_key( 'list_text', 'list_items', $index );
            $this->add_inline_editing_attributes( $list_text_key, 'none' );
            $this->add_render_attribute( $list_text_key, 'class', 'list-text' );?>
            <li>
                <?php if ( ! empty( $item['selected_icon']['value'] ) ) : ?>
                <span class="list-icon">
					<?php Icons_Manager::render_icon( $item['selected_icon'] ); ?>
                </span>
                <?php endif; ?>
                <span <?php echo $this->get_render_attribute_string( $list_text_key ) ?>>
                    <?php echo nt_kses_basic( $item['list_text'] ) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
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
        <ul class="noxfolio-check-list icon-{{{ settings.icon_position }}}">
            <# _.each( settings.list_items, function( item, index ) {
                var text_key = view.getRepeaterSettingKey( 'list_text', 'list_items', index );
                view.addInlineEditingAttributes( text_key, 'none' );
                view.addRenderAttribute( text_key, 'class', 'list-text' ); #>
                <li>
                    <# if ( item.selected_icon.value ) { #>
                    <span class="list-icon">
                        <#
                            var iconHTML = elementor.helpers.renderIcon( view, item.selected_icon, {}, 'i' , 'object' );

                            if ( iconHTML && iconHTML.rendered ) { #>
                                {{{ iconHTML.value }}}
                            <# }
                        #>
                    </span>
                    <# } #>
                    <span {{{ view.getRenderAttributeString( text_key ) }}}>
                        {{{ item.list_text }}}
                    </span>
                </li>
            <# }); #>
        </ul>
        <?php
    }
}
