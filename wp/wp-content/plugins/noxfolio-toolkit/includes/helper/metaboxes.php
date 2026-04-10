<?php

namespace NoxfolioToolkit\Helper;

use CSF;

defined('ABSPATH') || exit;

/**
 * Noxfolio Toolkit Helper
 */
class Noxfolio_Metaboxes
{
    protected static $instance = null;

    private $post_prefix      = 'noxfolio_post_meta';
    private $page_prefix      = 'noxfolio_page_meta';
    private $user_prefix      = 'noxfolio_user_meta';
    private $portfolio_prefix = 'noxfolio_portfolio_meta';
    private $product_prefix   = 'noxfolio_product_meta';

    private $template_builder_url;

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize()
    {
        if (! class_exists('CSF')) {
            return;
        }

        $this->template_builder_url = admin_url('edit.php?post_type=noxfolio_template');

        $this->post_metaboxes();
        $this->page_metaboxes();
        $this->portfolio_metaboxes();
        $this->user_metaboxes();
        $this->product_metaboxes();
    }

    /**
     * Post Meta
     *
     * @return void
     */
    public function post_metaboxes()
    {
        CSF::createMetabox($this->post_prefix, [
            'title'        => esc_html__('Noxfolio Post Options', 'noxfolio-toolkit'),
            'post_type'    => 'post',
            'show_restore' => true,
        ]);

        // Page Layout
        CSF::createSection($this->post_prefix, [
            'title'  => esc_html__('Layout', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Post Layout', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'post_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__('Layout', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Set the post layout.', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'    => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'full-width' => esc_html__('Full Width', 'noxfolio-toolkit'),
                        'boxed'      => esc_html__('Boxed', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'       => 'blog_details_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__('Sidebar', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Select Blog Archive Sidebar. Left sidebar or right sidebar or No sidebar', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'       => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'left-sidebar'  => esc_html('Left Sidebar', 'noxfolio-toolkit'),
                        'right-sidebar' => esc_html('Right Sidebar', 'noxfolio-toolkit'),
                        'no-sidebar'    => esc_html('No Sidebar', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'right-sidebar',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__('Content Spacing', 'noxfolio-toolkit'),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__('Default top: 0, bottom: 130px', 'noxfolio-toolkit'),
                    'output'     => '.container-gap',
                ],
            ],
        ]);

        // Header
        CSF::createSection($this->post_prefix, [
            'title'  => esc_html__('Header', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post header then disable default header', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'post_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Header', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default header. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default header. Set your post header form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'post_default_header',
                        '==',
                        'disabled',
                    ],
                ],
                [
                    'id'      => 'post_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Transparent Header', 'noxfolio-toolkit'),
                    'desc'    => esc_html__('Set header to transparent background before scroll.', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
            ],
        ]);

        // Page Title
        CSF::createSection($this->post_prefix, [
            'title'  => esc_html__('Page Title', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Page Title', 'noxfolio-toolkit'),
                ],
                [
                    'id'      => 'post_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Page Title', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'post_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Title Type', 'noxfolio-toolkit'),
                    'options'    => [
                        'default' => esc_html__('Default', 'noxfolio-toolkit'),
                        'custom'  => esc_html__('Custom', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'post_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__('Custom Title', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['post_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Customize Style', 'noxfolio-toolkit'),
                    'options'    => [
                        'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
                        'no'  => esc_html__('No', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'no',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__('Page Title Styling', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__('Background', 'noxfolio-toolkit'),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'post_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Overly Color', 'noxfolio-toolkit'),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Breadcrumb Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ]);

        // Footer
        CSF::createSection($this->post_prefix, [
            'title'  => esc_html__('Footer', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post footer then disable default footer', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'post_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Footer', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default footer. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default footer. Set your post footer form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'post_default_footer',
                        '==',
                        'disabled',
                    ],
                ],
            ],
        ]);
    }

    /**
     * Page Meta
     *
     * @return void
     */
    public function page_metaboxes()
    {
        CSF::createMetabox($this->page_prefix, [
            'title'        => esc_html__('Noxfolio Page Options', 'noxfolio-toolkit'),
            'post_type'    => 'page',
            'show_restore' => true,
        ]);

        // Page Layout
        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Layout', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Page Layout', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'site_layout',
                    'type'     => 'select',
                    'title'    => esc_html__('Layout', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Set the page layout.', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'    => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'full-width' => esc_html__('Full Width', 'noxfolio-toolkit'),
                        'boxed'      => esc_html__('Boxed', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__('Content Spacing', 'noxfolio-toolkit'),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__('Default top: 0, bottom: 130px', 'noxfolio-toolkit'),
                    'output'     => '.container-gap',
                ],
                [
                    'id'       => 'page_grid_line',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Grid Line', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Show grid line to website', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'          => 'grid_line_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Line Color', 'noxfolio-toolkit'),
                    'output'      => ['.noxfolio-grid-lines span'],
                    'output_mode' => 'background-color',
                    'dependency'  => ['page_grid_line', '==', 'enabled'],
                ],
                [
                    'id'       => 'page_body_bg',
                    'type'     => 'background',
                    'title'    => esc_html__('Body Background', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Set the <body> background for this page', 'noxfolio-toolkit'),
                    'output'   => 'body',
                ],
            ],
        ]);

        // Header
        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Header', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for page header then disable default header', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'page_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Header', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable page default header. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default header. Set your page header form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'page_default_header',
                        '==',
                        'disabled',
                    ],
                ],
                [
                    'id'      => 'page_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Transparent Header', 'noxfolio-toolkit'),
                    'desc'    => esc_html__('Set header to transparent background before scroll.', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
            ],
        ]);

        // Page Title
        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Page Title', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Page Title', 'noxfolio-toolkit'),
                ],
                [
                    'id'      => 'page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Page Title', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Title Type', 'noxfolio-toolkit'),
                    'options'    => [
                        'default' => esc_html__('Default', 'noxfolio-toolkit'),
                        'custom'  => esc_html__('Custom', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'page_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__('Custom Title', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Breadcrumb', 'noxfolio-toolkit'),
                    'options'    => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Customize Style', 'noxfolio-toolkit'),
                    'options'    => [
                        'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
                        'no'  => esc_html__('No', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'no',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__('Page Title Styling', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__('Background', 'noxfolio-toolkit'),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Overly Color', 'noxfolio-toolkit'),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Breadcrumb Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ]);

        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Typography', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Typography', 'noxfolio-toolkit'),
                ],
                [
                    'id'      => 'custom_typo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Custom Typography', 'noxfolio-toolkit'),
                    'options' => [
                        'default-font' => esc_html__('Default', 'noxfolio-toolkit'),
                        'custom-font'  => esc_html__('Custom', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'                 => 'primary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__('Base Font', 'noxfolio-toolkit'),
                    'subtitle'           => esc_html__('The main font of your website. The most readable font, used by all text elements.', 'noxfolio-toolkit'),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => true,
                    'subset'             => true,
                    'preview'            => false,
                    'dependency' => [
                        'custom_typo_type',
                        '==',
                        'custom-font',
                    ],
                ],
                [
                    'id'                 => 'secondary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__('Heading Font', 'noxfolio-toolkit'),
                    'subtitle'           => esc_html__('The secondary font of your website. Used by secondary headlines and smaller elements.', 'noxfolio-toolkit'),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => true,
                    'subset'             => true,
                    'preview'            => false,
                    'dependency' => [
                        'custom_typo_type',
                        '==',
                        'custom-font',
                    ],
                ],

            ],
        ]);

        // Footer
        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Footer', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for page footer then disable default footer', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'page_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Footer', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable page default footer. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default footer. Set your page footer form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'page_default_footer',
                        '==',
                        'disabled',
                    ],
                ],
            ],
        ]);

        // Back to Top
        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Back to Top', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'id'       => 'back_to_top_page',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Back to Top', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Add a back to top button on bottom right corner.', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'          => 'back_to_top_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Icon Color', 'noxfolio-toolkit'),
                    'subtitle'    => esc_html__('Back to Top icon color', 'noxfolio-toolkit'),
                    'output'      => '.back-to-top',
                    'output_mode' => 'color',
                    'dependency'  => ['back_to_top_page', '!=', 'disabled'],
                ],
                [
                    'id'          => 'back_to_top_bg',
                    'type'        => 'color',
                    'title'       => esc_html__('Background', 'noxfolio-toolkit'),
                    'subtitle'    => esc_html__('Back to Top icon background color', 'noxfolio-toolkit'),
                    'output'      => '.back-to-top',
                    'output_mode' => 'background-color',
                    'dependency'  => ['back_to_top_page', '!=', 'disabled'],
                ],
                [
                    'id'          => 'back_top_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Hover Color', 'noxfolio-toolkit'),
                    'subtitle'    => esc_html__('Back to Top icon hover color', 'noxfolio-toolkit'),
                    'output'      => '.back-to-top:hover',
                    'output_mode' => 'color',
                    'dependency'  => ['back_to_top_page', '!=', 'disabled'],
                ],
                [
                    'id'          => 'back_top_hover_bg',
                    'type'        => 'color',
                    'title'       => esc_html__('Hover Background', 'noxfolio-toolkit'),
                    'subtitle'    => esc_html__('Back to Top icon hover background color', 'noxfolio-toolkit'),
                    'output'      => '.back-to-top:hover',
                    'output_mode' => 'background-color',
                    'dependency'  => ['back_to_top_page', '!=', 'disabled'],
                ],
            ],
        ]);

        CSF::createSection($this->page_prefix, [
            'title'  => esc_html__('Body Class', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Add Body Class', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'body_class',
                    'type'     => 'text',
                    'title'    => esc_html__('Body Class', 'noxfolio-toolkit'),
                    'default'  => '',
                    'subtitle' => esc_html__('Append a class in body tag', 'noxfolio-toolkit'),
                ],
            ],
        ]);
    }

    /**
     * Portfolio Meta
     *
     * @return void
     */
    public function portfolio_metaboxes()
    {
        CSF::createMetabox($this->portfolio_prefix, [
            'title'        => esc_html__('Noxfolio Portfolio Options', 'noxfolio-toolkit'),
            'post_type'    => 'noxfolio_portfolio',
            'show_restore' => true,
        ]);

        // Layout
        CSF::createSection($this->portfolio_prefix, [
            'title'  => esc_html__('Layout', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Post Layout', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'portfolio_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__('Layout', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Set the post layout.', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'    => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'full-width' => esc_html__('Full Width', 'noxfolio-toolkit'),
                        'boxed'      => esc_html__('Boxed', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__('Content Spacing', 'noxfolio-toolkit'),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__('Default top: 0, bottom: 130px', 'noxfolio-toolkit'),
                    'output'     => '.container-gap',
                ],
            ],
        ]);

        // Header
        CSF::createSection($this->portfolio_prefix, [
            'title'  => esc_html__('Header', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post header then disable default header', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'portfolio_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Header', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default header. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default header. Set your post header form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'portfolio_default_header',
                        '==',
                        'disabled',
                    ],
                ],
                [
                    'id'      => 'portfolio_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Transparent Header', 'noxfolio-toolkit'),
                    'desc'    => esc_html__('Set header to transparent background before scroll.', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
            ],
        ]);

        // Page Title
        CSF::createSection($this->portfolio_prefix, [
            'title'  => esc_html__('Page Title', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Page Title', 'noxfolio-toolkit'),
                ],
                [
                    'id'      => 'portfolio_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Page Title', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'portfolio_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Title Type', 'noxfolio-toolkit'),
                    'options'    => [
                        'default' => esc_html__('Default', 'noxfolio-toolkit'),
                        'custom'  => esc_html__('Custom', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'portfolio_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__('Custom Title', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['portfolio_page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'portfolio_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Breadcrumb', 'noxfolio-toolkit'),
                    'options'    => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Customize Style', 'noxfolio-toolkit'),
                    'options'    => [
                        'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
                        'no'  => esc_html__('No', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'no',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__('Page Title Styling', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_bg',
                    'type'       => 'background',
                    'title'      => esc_html__('Background', 'noxfolio-toolkit'),
                    'output'     => '.page-title-wrapper',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'post_title_overly_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Overly Color', 'noxfolio-toolkit'),
                    'output'      => '.page-title-wrapper::before',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_title_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .page-title',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'               => 'page_breadcrumb_typo',
                    'type'             => 'typography',
                    'title'            => esc_html('Breadcrumb Typography', 'noxfolio-toolkit'),
                    'output'           => '.page-title-wrapper .breadcrumb, .page-title-wrapper .breadcrumb a',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ]);

        // Footer
        CSF::createSection($this->portfolio_prefix, [
            'title'  => esc_html__('Footer', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post footer then disable default footer', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'portfolio_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Footer', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default footer. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default footer. Set your post footer form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'portfolio_default_footer',
                        '==',
                        'disabled',
                    ],
                ],
            ],
        ]);
    }

    /**
     * User Meta
     *
     * @return void
     */
    public function user_metaboxes()
    {
        CSF::createProfileOptions($this->user_prefix, [
            'data_type' => 'serialize',
        ]);

        CSF::createSection($this->user_prefix, [
            'fields' => [
                [
                    'title' => esc_html__('Noxfolio Author Options', 'noxfolio-toolkit'),
                    'type'  => 'heading',
                ],
                [
                    'id'           => 'user_social_links',
                    'type'         => 'repeater',
                    'title'        => esc_html__('User Social Links', 'noxfolio-toolkit'),
                    'button_title' => esc_html__('Add New', 'noxfolio-toolkit'),
                    'fields'       => [
                        [
                            'id'    => 'social_icon',
                            'type'  => 'icon',
                            'title' => esc_html__('Icon', 'noxfolio-toolkit'),
                        ],
                        [
                            'id'    => 'social_link',
                            'type'  => 'text',
                            'title' => esc_html__('Link', 'noxfolio-toolkit'),
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Product Metaboxes
     */
    public function product_metaboxes()
    {
        CSF::createMetabox($this->product_prefix, [
            'title'        => esc_html__('Noxfolio Product Options', 'noxfolio-toolkit'),
            'post_type'    => 'product',
            'show_restore' => true,
        ]);

        // Layout
        CSF::createSection($this->product_prefix, [
            'title'  => esc_html__('Layout', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Post Layout', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'product_details_layout',
                    'type'     => 'select',
                    'title'    => esc_html__('Layout', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Set the post layout.', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'    => esc_html__('Theme Default', 'noxfolio-toolkit'),
                        'full-width' => esc_html__('Full Width', 'noxfolio-toolkit'),
                        'boxed'      => esc_html__('Boxed', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__('Content Spacing', 'noxfolio-toolkit'),
                    'show_units' => false,
                    'left'       => false,
                    'right'      => false,
                    'desc'       => esc_html__('Default top: 0, bottom: 130px', 'noxfolio-toolkit'),
                    'output'     => '.container-gap',
                ],
            ],
        ]);

        // Header
        CSF::createSection($this->product_prefix, [
            'title'  => esc_html__('Header', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post header then disable default header', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'product_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Header', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default header. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default header. Set your post header form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'product_default_header',
                        '==',
                        'disabled',
                    ],
                ],
                [
                    'id'      => 'product_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Transparent Header', 'noxfolio-toolkit'),
                    'desc'    => esc_html__('Set header to transparent background before scroll.', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
            ],
        ]);

        // Page Title
        CSF::createSection($this->product_prefix, [
            'title'  => esc_html__('Page Title', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__('Page Title', 'noxfolio-toolkit'),
                ],
                [
                    'id'      => 'product_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__('Page Title', 'noxfolio-toolkit'),
                    'options' => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'product_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Page Title Type', 'noxfolio-toolkit'),
                    'options'    => [
                        'default' => esc_html__('Default', 'noxfolio-toolkit'),
                        'custom'  => esc_html__('Custom', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'product_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__('Custom Title', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['product_page_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__('Product Details', 'noxfolio-toolkit'),
                ],
                [
                    'id'         => 'product_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Product Breadcrumb', 'noxfolio-toolkit'),
                    'options'    => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_product_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__('Customize Style', 'noxfolio-toolkit'),
                    'options'    => [
                        'yes' => esc_html__('Yes', 'noxfolio-toolkit'),
                        'no'  => esc_html__('No', 'noxfolio-toolkit'),
                    ],
                    'default'    => 'no',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__('Page Title Styling', 'noxfolio-toolkit'),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__('Padding', 'noxfolio-toolkit'),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__('Border', 'noxfolio-toolkit'),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__('Background Color', 'noxfolio-toolkit'),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html('Typography', 'noxfolio-toolkit'),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html('Breadcrumb Typography', 'noxfolio-toolkit'),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ]);

        // Footer
        CSF::createSection($this->product_prefix, [
            'title'  => esc_html__('Footer', 'noxfolio-toolkit'),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__('If you used theme builder for post footer then disable default footer', 'noxfolio-toolkit'),
                ],
                [
                    'id'       => 'product_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Default Footer', 'noxfolio-toolkit'),
                    'subtitle' => esc_html__('Enable or Disable post default footer. Default comes form theme option', 'noxfolio-toolkit'),
                    'options'  => [
                        'default'  => esc_html__('Default', 'noxfolio-toolkit'),
                        'enabled'  => esc_html__('Enable', 'noxfolio-toolkit'),
                        'disabled' => esc_html__('Disable', 'noxfolio-toolkit'),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__('You disabled default footer. Set your post footer form ', 'noxfolio-toolkit') . '<a href="' . esc_url($this->template_builder_url) . '">' . esc_html__('here', 'noxfolio-toolkit') . '</a>',
                    'dependency' => [
                        'product_default_footer',
                        '==',
                        'disabled',
                    ],
                ],
            ],
        ]);
    }
}

Noxfolio_Metaboxes::instance()->initialize();
