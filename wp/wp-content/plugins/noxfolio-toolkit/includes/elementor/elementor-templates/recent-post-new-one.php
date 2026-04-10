<?php


if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Blog area start -->
    <section class="wt-blog-3-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4"></div>
                <div class="col-xl-4">
                    <div class="wt-section-wrapper wt-section-3-wrapper mb-70 wt_fade_anim">
                        <?php if ($settings['layout_one_title']) : ?>
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                <span class="wt-reveal-line"><?php echo nt_kses_basic($settings['layout_one_title']); ?></span>
                            </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        <?php endif; ?>
                        <?php if ($settings['layout_one_summary_text']) : ?>
                            <p class="wt-section-paragraph wt-section-3-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-4"></div>
            </div>
            <div class="row">
                <?php if ('cpt' == $settings['post_type']) :

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $args = [
                        'post_type'           => 'post',
                        'post_status'         => 'publish',
                        'posts_per_page'      => $settings['post_limit'],
                        'orderby'             => $settings['order_by'],
                        'order'               => $settings['sort_order'],
                        'ignore_sticky_posts' => 1,
                        'paged'               => $paged
                    ];

                    if ('categories' == $settings['post_from'] && $settings['cat_slugs']) {
                        $args['tax_query'] = [
                            [
                                'taxonomy' => 'category',
                                'field'    => 'slug',
                                'terms'    => $settings['cat_slugs'],
                            ],
                        ];
                    }

                    if ('specific-post' == $settings['post_from'] && $settings['post_ids']) {
                        $args['post__in'] = $settings['post_ids'];
                    }

                    $wp_query = new WP_Query($args);

                    while ($wp_query->have_posts()): $wp_query->the_post();
                        $idd = get_the_ID();

                        if ($settings['title_word']) {
                            $the_title = wp_trim_words(get_the_title(), $settings['title_word'], '..');
                        } else {
                            $the_title = get_the_title();
                        }

                        $excerpt_count = $settings['excerpt_count'];

                ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="wt-blog-wrapper wt_fade_anim" data-delay=".3">
                                <?php if (has_post_thumbnail() && 'yes' === $settings['show_thumbnail']): ?>
                                    <div class="wt-blog-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo get_the_post_thumbnail($idd, $settings['post_thumbnail_size']); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="wt-blog-meta wt-blog-3-meta">
                                    <?php
                                    if (has_category()) :
                                        $categories = get_the_category();
                                    ?>
                                        <span><a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></span>
                                    <?php endif; ?>
                                    <span><?php the_time('F Y'); ?></span>
                                </div>

                                <div class="wt-blog-content">
                                    <<?php echo esc_attr($settings['title_tag']); ?> class="wt-blog-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($the_title); ?></a></<?php echo esc_attr($settings['title_tag']); ?>>
                                </div>

                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
                <?php if ('elementor-field' == $settings['post_type']) : ?>
                    <?php
                    if (is_array($settings['layout_one_post_list'])) :
                        foreach ($settings['layout_one_post_list'] as $post) :

                            $custom_post_post_query_args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page'      => 1,
                                'post__in' => array($post['select_post']),
                            );
                            $custom_post_post_query = new \WP_Query($custom_post_post_query_args);
                    ?>
                            <?php while ($custom_post_post_query->have_posts()) :
                                $custom_post_post_query->the_post();
                                $idd             = get_the_ID();
                                if ($settings['title_word']) {
                                    $the_title = wp_trim_words(get_the_title(), $settings['title_word'], '..');
                                } else {
                                    $the_title = get_the_title();
                                }
                                $categories_list = get_the_terms($idd, 'category', '', '', '');

                            ?>
                                <div class="col-xl-<?php echo esc_attr($settings['column_size']); ?> col-lg-6 col-md-6">
                                    <div class="wt-blog-wrapper wt_fade_anim" data-delay=".3">
                                        <div class="wt-blog-thumb">
                                            <a href="<?php the_permalink(); ?>"> <?php nt_elementor_rendered_image($post, 'image'); ?></a>
                                        </div>
                                        <div class="wt-blog-meta wt-blog-3-meta">
                                            <?php
                                            if (has_category()) :
                                                $categories = get_the_category();
                                            ?>
                                                <span><a href="<?php esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></span>
                                            <?php endif; ?>
                                            <span><?php the_time('F Y'); ?></span>

                                        </div>
                                        <div class="wt-blog-content">
                                            <<?php echo esc_attr($settings['title_tag']); ?> class="wt-blog-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if (!empty($post['title'])):
                                                        echo nt_kses_basic($post['title']);
                                                    else:
                                                        echo nt_kses_basic($the_title);
                                                    endif;
                                                    ?>
                                                </a>
                                            </<?php echo esc_attr($settings['title_tag']); ?>>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            endwhile;
                            wp_reset_postdata();
                        endforeach;
                    endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Blog area end -->
<?php endif; ?>