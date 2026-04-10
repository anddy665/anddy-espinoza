<?php
if ('layout_one' == $settings['layout_type']) :
    $terms = get_terms([
        'taxonomy'   => 'noxfolio_portfolio_category',
        'hide_empty' => true,
    ]);
?>
    <!-- Portfolio area start -->
    <section class="wt-portfolio-3-area">
        <div class="container">
            <div class="row">
                <?php if ($settings['layout_one_title']) : ?>
                    <div class="col-xl-6 col-lg-7">
                        <div class="wt-section-wrapper wt-section-3-wrapper mb-70 wt_fade_anim" data-delay=".3">
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                            </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($settings['layout_one_summary_text']) : ?>
                    <div class="col-xl-6 col-lg-5">
                        <div class="wt-portfolio-3-top-paragraph mt-40 wt_fade_anim" data-delay=".5">
                            <p><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ('yes' == $settings['enable_filter']) : ?>
                <div class="row">
                    <div class="col">
                        <div class="wt-portfolio-3-filter masonary-menu pb-60 wt_fade_anim" data-delay=".3">
                            <button data-filter="*" class="active"><span><?php echo esc_html($settings['show_all_text']); ?></span></button>
                            <?php foreach ($terms as $index => $term) : ?>
                                <button data-filter=".<?php echo esc_attr($term->slug); ?>"><span><?php echo esc_html($term->name); ?></span></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row grid">
                <?php
                $args = [
                    'post_type'           => 'noxfolio_portfolio',
                    'post_status'         => 'publish',
                    'posts_per_page'      => $settings['post_limit'],
                    'orderby'             => $settings['order_by'],
                    'order'               => $settings['sort_order'],
                    'ignore_sticky_posts' => 1,
                ];

                if ('categories' == $settings['post_from'] && $settings['cat_slugs']) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'noxfolio_portfolio_category',
                            'field'    => 'slug',
                            'terms'    => $settings['cat_slugs'],
                        ],
                    ];
                }

                if ('specific-post' == $settings['post_from'] && $settings['post_ids']) {
                    $args['post__in'] = $settings['post_ids'];
                }

                $wp_query = new WP_Query($args);
                $counter = 1;
                while ($wp_query->have_posts()): $wp_query->the_post();
                    $idd             = get_the_ID();
                    $categories_list = get_the_terms($idd, 'noxfolio_portfolio_category', '', '', '');

                    if ($settings['title_word']) {
                        $the_title = wp_trim_words(get_the_title(), $settings['title_word'], '..');
                    } else {
                        $the_title = get_the_title();
                    }

                    $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($idd), 'full');

                ?>
                    <div class="col-xl-4 col-lg-6 col-md-6 grid-item <?php if ($categories_list && !is_wp_error($categories_list)) {
                                                                            $cat_slug = wp_list_pluck($categories_list, 'slug');
                                                                            echo implode(' ', $cat_slug);
                                                                        }
                                                                        ?>">
                        <div class="wt-portfolio-3-wrapper wt_fade_anim" data-delay=".3">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="wt-portfolio-3-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail($idd, $settings['post_thumbnail_size']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="wt-portfolio-3-content">
                                <?php if ($categories_list && !is_wp_error($categories_list)) : ?>
                                    <p class="wt-portfolio-3-paragraph">
                                        <?php
                                        $categories = array();
                                        foreach ($categories_list as $category) {
                                            $categories[] = $category->name;
                                        }
                                        echo implode(', ', $categories);
                                        ?>
                                    </p>
                                <?php endif; ?>
                                <<?php echo nt_escape_tags($settings['title_tag']); ?> class="wt-portfolio-3-title">
                                    <a href="<?php the_permalink(); ?>"> <?php echo nt_kses_basic($the_title); ?></a>
                                </<?php echo nt_escape_tags($settings['title_tag']); ?>>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <!-- Portfolio area end -->
<?php endif; ?>