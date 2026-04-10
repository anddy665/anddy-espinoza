<?php
if ('layout_three' == $settings['layout_type']) :
    $terms = get_terms([
        'taxonomy'   => 'noxfolio_portfolio_category',
        'hide_empty' => true,
    ]);
?>
    <!-- Project area start -->
    <section class="wt-project-4-area fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="wt-section-4-wrapper mb-60">
                        <?php if ($settings['layout_one_title']) : ?>
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_one_title']); ?></<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        <?php endif; ?>
                        <?php if ($settings['layout_one_summary_text']) : ?>
                            <div class="wt-section-4-descr">
                                <p class="wt-section-4-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="wt-project-widgets wt-hover__widget p-relative wt_fade_anim">
                        <?php if ('cpt' == $settings['portfolio_type']) : ?>
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
                            $i = 1;
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
                                <div class="wt-project-item  wt-widget__item wt-hover__reveal-item <?php esc_html_e($i == 1 ? 'current' : '') ?>">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="wt-project-content wt-project-4-content">
                                            <p class="wt-project-4-paragraph"><span><i class="fa-light fa-calendar-days"></i></span><?php the_date(); ?></p>
                                            <h4 class="wt-project-4-title"><?php echo nt_kses_basic($the_title); ?></h4>
                                            <div class="wt-project-4-action">
                                                <span><i class="fa-regular fa-arrow-up-right"></i></span>
                                            </div>
                                        </div>
                                    </a>
                                    <?php if (!empty($img_src[0])) : ?>
                                        <div class="wt-hover__reveal-bg" data-background="<?php echo esc_url($img_src[0]); ?>"></div>
                                    <?php endif; ?>
                                </div>
                        <?php
                                $i++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                        <?php if ('elementor-field' == $settings['portfolio_type']) : ?>
                            <?php
                            if (is_array($settings['layout_three_portfolio_list'])) :
                                foreach ($settings['layout_three_portfolio_list'] as $portfolio) :

                                    $custom_portfolio_post_query_args = array(
                                        'post_type' => 'noxfolio_portfolio',
                                        'post_status' => 'publish',
                                        'posts_per_page'      => 1,
                                        'post__in' => array($portfolio['select_portfolio']),
                                    );
                                    $custom_portfolio_post_query = new \WP_Query($custom_portfolio_post_query_args);
                            ?>
                                    <?php while ($custom_portfolio_post_query->have_posts()) :
                                        $custom_portfolio_post_query->the_post();
                                        $idd             = get_the_ID();
                                        if ($settings['title_word']) {
                                            $the_title = wp_trim_words(get_the_title(), $settings['title_word'], '..');
                                        } else {
                                            $the_title = get_the_title();
                                        }
                                        $categories_list = get_the_terms($idd, 'noxfolio_portfolio_category', '', '', '');

                                    ?>
                                        <div class="wt-project-item wt-widget__item wt-hover__reveal-item">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="wt-project-content wt-project-4-content">
                                                    <p class="wt-project-4-paragraph"><span><i class="fa-light fa-calendar-days"></i></span><?php echo nt_kses_basic($portfolio['year']); ?></p>
                                                    <<?php echo nt_escape_tags($settings['title_tag']); ?> class="wt-project-4-title">
                                                        <?php
                                                        if (!empty($portfolio['title'])):
                                                            echo nt_kses_basic($portfolio['title']);
                                                        else:
                                                            the_title();
                                                        endif;
                                                        ?>
                                                    </<?php echo nt_escape_tags($settings['title_tag']); ?>>
                                                    <div class="wt-project-4-action">
                                                        <h6><?php echo nt_kses_basic($portfolio['company_name']); ?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php if (!empty($portfolio['image']['url'])) : ?>
                                                <div class="wt-hover__reveal-bg" data-background="<?php echo esc_url($portfolio['image']['url']); ?>"></div>
                                            <?php endif; ?>
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
    <!-- Project area end -->
<?php endif; ?>