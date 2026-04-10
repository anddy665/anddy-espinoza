<?php
namespace NoxfolioToolkit\TemplateBuilder;

use CSF;

defined( 'ABSPATH' ) || exit;

class Template_Metaboxes {

    protected static $instance = null;
    private $prefix            = 'noxfolio_template_meta';

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        if ( ! class_exists( 'CSF' ) ) {
            return;
        }

        $this->init_metaboxes();
    }

    public function init_metaboxes() {
        CSF::createMetabox( $this->prefix, [
            'title'        => esc_html__( 'Template Settings', 'noxfolio-toolkit' ),
            'post_type'    => 'noxfolio_template',
            'show_restore' => true,
            'theme'        => 'dark',
            'data_type'    => 'unserialize',
        ] );

        CSF::createSection( $this->prefix, [
            'fields' => [
                [
                    'id'     => 'noxfolio_tb_settings',
                    'type'   => 'fieldset',
                    'title'  => esc_html__( 'Common Settings', 'noxfolio-toolkit' ),
                    'fields' => [
                        [
                            'id'          => 'template_type',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Template Type', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Type', 'noxfolio-toolkit' ),
                            'options'     => [
                                'header'    => esc_html__( 'Header', 'noxfolio-toolkit' ),
                                'footer'    => esc_html__( 'Footer', 'noxfolio-toolkit' ),
                                'block'     => esc_html__( 'Block', 'noxfolio-toolkit' ),
                                'popup'     => esc_html__( 'Popup', 'noxfolio-toolkit' ),
                                'offcanvas' => esc_html__( 'OffCanvas', 'noxfolio-toolkit' ),
                            ],
                            'default'     => 'block',
                        ],
                        [
                            'id'         => 'popup_width',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Width', 'noxfolio-toolkit' ),
                            'subtitle'   => esc_html__( 'Select or type a value (PX)', 'noxfolio-toolkit' ),
                            'options'    => [
                                'full'   => esc_html__( 'Full', 'noxfolio-toolkit' ),
                                'custom' => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                            ],
                            'default'    => 'custom',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Width', 'noxfolio-toolkit' ),
                            'default'    => [
                                'width' => '820',
                            ],
                            'height'     => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_width', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_height',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Height', 'noxfolio-toolkit' ),
                            'subtitle'   => esc_html__( 'Set the popup max height.', 'noxfolio-toolkit' ),
                            'options'    => [
                                'fit_content' => esc_html__( 'Fit Content', 'noxfolio-toolkit' ),
                                'full'        => esc_html__( 'Full', 'noxfolio-toolkit' ),
                                'custom'      => esc_html__( 'Custom', 'noxfolio-toolkit' ),
                            ],
                            'default'    => 'fit_content',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_height',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Height', 'noxfolio-toolkit' ),
                            'default'    => [
                                'height' => '520',
                            ],
                            'width'      => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_height', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_position',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Position', 'noxfolio-toolkit' ),
                            'subtitle'   => esc_html__( 'Choose the popup position on page.', 'noxfolio-toolkit' ),
                            'options'    => [
                                'center-center' => esc_html__( 'Center Center', 'noxfolio-toolkit' ),
                                'center-left'   => esc_html__( 'Center Left', 'noxfolio-toolkit' ),
                                'center-right'  => esc_html__( 'Center Right', 'noxfolio-toolkit' ),
                                'bottom-center' => esc_html__( 'Bottom Center', 'noxfolio-toolkit' ),
                                'top-center'    => esc_html__( 'Top Center', 'noxfolio-toolkit' ),
                                'bottom-left'   => esc_html__( 'Bottom Left', 'noxfolio-toolkit' ),
                                'top-left'      => esc_html__( 'Top Left', 'noxfolio-toolkit' ),
                                'bottom-right'  => esc_html__( 'Bottom Right', 'noxfolio-toolkit' ),
                                'top-right'     => esc_html__( 'Top Right', 'noxfolio-toolkit' ),
                            ],
                            'default'    => 'center-center',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
						[
                            'id'         => 'popup_bg_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Background Color', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#131313',
                        ],
                        [
                            'id'         => 'popup_overly_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Overly Color', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 'rgba(0, 0, 0, 0.5)',
                        ],
                        [
                            'id'         => 'popup_close_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#c9f31d',
                        ],
                        [
                            'id'         => 'popup_close_bg',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#070707',
                        ],
                        [
                            'id'         => 'popup_close_size',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Close Size', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'units'      => ['px'],
                            'default'    => [
                                'width'  => '40',
                                'height' => '40',
                            ],
                            'show_units' => false,
                        ],
                        [
                            'id'         => 'popup_close_radius',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Close Radius', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_delay',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Delay', 'noxfolio-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 3,
                            'subtitle'   => esc_html__( 'Show when page is loaded (Second).', 'noxfolio-toolkit' ),
                        ],
                        [
                            'id'         => 'offcanvas_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Width', 'noxfolio-toolkit' ),
                            'height'     => false,
                            'units'      => ['px'],
                            'default'    => [
                                'width' => '420',
                            ],
                            'show_units' => false,
                            'dependency' => ['template_type', '==', 'offcanvas'],
                        ],
                    ],
                ],
                [
                    'id'           => 'noxfolio_tb_include',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Display On', 'noxfolio-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'noxfolio-toolkit' ),
                    'button_title' => esc_html__( 'Add Display Rule', 'noxfolio-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Define Rule', 'noxfolio-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Display on', 'noxfolio-toolkit' ),
                            'options' => [
                                'entire_website'     => esc_html__( 'Entire Website', 'noxfolio-toolkit' ),
                                'all_pages'          => esc_html__( 'All Pages', 'noxfolio-toolkit' ),
                                'front_page'         => esc_html__( 'Front Page', 'noxfolio-toolkit' ),
                                'post_page'          => esc_html__( 'Post Page', 'noxfolio-toolkit' ),
                                'post_details'       => esc_html__( 'Post Details', 'noxfolio-toolkit' ),
                                'all_archive'        => esc_html__( 'All Archive', 'noxfolio-toolkit' ),
                                'date_archive'       => esc_html__( 'Date Archive', 'noxfolio-toolkit' ),
                                'author_archive'     => esc_html__( 'Author Archive', 'noxfolio-toolkit' ),
                                'search_page'        => esc_html__( 'Search Page', 'noxfolio-toolkit' ),
                                '404_page'           => esc_html__( '404 Page', 'noxfolio-toolkit' ),
                                'specific_pages'     => esc_html__( 'Specific Pages', 'noxfolio-toolkit' ),
                                'specific_posts'     => esc_html__( 'Specific Posts', 'noxfolio-toolkit' ),
                                'shop_page'          => esc_html__( 'Shop Page', 'noxfolio-toolkit' ),
                                'product_details'    => esc_html__( 'Product Details', 'noxfolio-toolkit' ),
                                'specific_products'  => esc_html__( 'Specific Products', 'noxfolio-toolkit' ),
                                'portfolio_details'  => esc_html__( 'Portfolio Details', 'noxfolio-toolkit' ),
                                'specific_portfolio' => esc_html__( 'Specific Portfolio', 'noxfolio-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                        [
                            'id'          => 'portfolio_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Portfolio', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Portfolio', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'noxfolio_portfolio',
                            ],
                            'dependency'  => ['rule', '==', 'specific_portfolio'],
                        ],
                    ],
                ],
                [
                    'id'           => 'noxfolio_tb_exclude',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Hide On', 'noxfolio-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'noxfolio-toolkit' ),
                    'button_title' => esc_html__( 'Add Hide Rule', 'noxfolio-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Hide Rule', 'noxfolio-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Hide on', 'noxfolio-toolkit' ),
                            'options' => [
                                'entire_website'     => esc_html__( 'Entire Website', 'noxfolio-toolkit' ),
                                'all_pages'          => esc_html__( 'All Pages', 'noxfolio-toolkit' ),
                                'front_page'         => esc_html__( 'Front Page', 'noxfolio-toolkit' ),
                                'post_page'          => esc_html__( 'Post Page', 'noxfolio-toolkit' ),
                                'post_details'       => esc_html__( 'Post Details', 'noxfolio-toolkit' ),
                                'all_archive'        => esc_html__( 'All Archive', 'noxfolio-toolkit' ),
                                'date_archive'       => esc_html__( 'Date Archive', 'noxfolio-toolkit' ),
                                'author_archive'     => esc_html__( 'Author Archive', 'noxfolio-toolkit' ),
                                'search_page'        => esc_html__( 'Search Page', 'noxfolio-toolkit' ),
                                '404_page'           => esc_html__( '404 Page', 'noxfolio-toolkit' ),
                                'specific_pages'     => esc_html__( 'Specific Pages', 'noxfolio-toolkit' ),
                                'specific_posts'     => esc_html__( 'Specific Posts', 'noxfolio-toolkit' ),
                                'shop_page'          => esc_html__( 'Shop Page', 'noxfolio-toolkit' ),
                                'product_details'    => esc_html__( 'Product Details', 'noxfolio-toolkit' ),
                                'specific_products'  => esc_html__( 'Specific Products', 'noxfolio-toolkit' ),
                                'portfolio_details'  => esc_html__( 'Portfolio Details', 'noxfolio-toolkit' ),
                                'specific_portfolio' => esc_html__( 'Specific Portfolio', 'noxfolio-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                        [
                            'id'          => 'portfolio_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Portfolio', 'noxfolio-toolkit' ),
                            'placeholder' => esc_html__( 'Select Portfolio', 'noxfolio-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'noxfolio_portfolio',
                            ],
                            'dependency'  => ['rule', '==', 'specific_portfolio'],
                        ],
                    ],
                ],
            ],
        ] );
    }
}

Template_Metaboxes::instance()->initialize();