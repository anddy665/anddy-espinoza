<?php


if ('layout_two' == $settings['layout_type']) : ?>
    <!-- Blog area start -->
    <section class="wt-blog-4-area fix">
        <div class="container">
            <div class="row wt-blog-4-sectitle-row align-items-center">
                <?php if ($settings['layout_one_title']) : ?>
                    <div class="col-xl-5 col-lg-6">
                        <div class="wt-section-4-wrapper">
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_one_title']); ?></<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($settings['layout_one_summary_text']) : ?>
                    <div class="col-xl-7 col-lg-6">
                        <div class="wt-portfolio-4-top-descri wt_fade_anim">
                            <p class="wt-portfolio-4-top-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="wt-project-widgets wt-hover__widget p-relative wt_fade_anim">
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

                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($idd), $settings['post_thumbnail_size']);

                        ?>
                                <div class="wt-project-item wt-blog-4-item current wt-widget__item wt-hover__reveal-item">
                                    <div class="wt-project-content wt-blog-4-content">
                                        <div class="wt-blog-meta wt-blog-4-meta">
                                            <?php
                                            if (has_category()) :
                                                $categories = get_the_category();
                                            ?>
                                                <span><a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></span>
                                            <?php endif; ?>
                                            <span><?php the_time('F Y'); ?></span>
                                        </div>
                                        <<?php echo nt_escape_tags($settings['title_tag'], 'h4'); ?> class="wt-blog-4-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo esc_html($the_title); ?>
                                            </a>
                                        </<?php echo nt_escape_tags($settings['title_tag'], 'h4'); ?>>
                                        <div class="wt-project-action blog-action">
                                            <a href="<?php the_permalink(); ?>"><span><i class="fa-regular fa-arrow-up-right"></i></span></a>
                                        </div>
                                    </div>
                                    <?php if (!empty($img_src[0])) : ?>
                                        <div class="wt-hover__reveal-bg" data-background="<?php echo esc_url($img_src[0]); ?>"></div>
                                    <?php endif; ?>
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
                                        <div class="wt-project-item wt-blog-4-item wt-widget__item wt-hover__reveal-item">
                                            <div class="wt-project-content wt-blog-4-content">
                                                <div class="wt-blog-meta wt-blog-4-meta">
                                                    <?php
                                                    if (has_category()) :
                                                        $categories = get_the_category();
                                                    ?>
                                                        <span><a href="<?php esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a></span>
                                                    <?php endif; ?>
                                                    <span><?php the_time('F Y'); ?></span>
                                                </div>
                                                <<?php echo nt_escape_tags($settings['title_tag'], 'h4'); ?> class="wt-blog-4-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php
                                                        if (!empty($post['title'])):
                                                            echo nt_kses_basic($post['title']);
                                                        else:
                                                            echo nt_kses_basic($the_title);
                                                        endif;
                                                        ?>
                                                    </a>
                                                </<?php echo nt_escape_tags($settings['title_tag'], 'h4'); ?>>
                                                <div class="wt-project-action blog-action">
                                                    <a href="<?php the_permalink(); ?>"><span><i class="fa-regular fa-arrow-up-right"></i></span></a>
                                                </div>
                                            </div>
                                            <div class="wt-hover__reveal-bg" data-background="<?php echo esc_url($post['image']['url']); ?>"></div>
                                        </div>
                            <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endforeach;
                            endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog area end -->
<?php endif; ?>