<?php
if ('layout_two' == $settings['layout_type']) :
    $terms = get_terms([
        'taxonomy'   => 'noxfolio_portfolio_category',
        'hide_empty' => true,
    ]);
?>
    <!-- Portfolio Area start-->
    <section class="wt-portfolio-4-area">
        <div class="wt-portfolio-4-top">
            <div class="container">
                <div class="row align-items-center">
                    <?php if ($settings['layout_one_title']) : ?>
                        <div class="col-xl-6 col-lg-7">
                            <div class="wt-section-4-wrapper mb-60">
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_one_title']); ?></<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['layout_one_summary_text']) : ?>
                        <div class="col-xl-6 col-lg-5">
                            <div class="wt-portfolio-4-top-descri wt_fade_anim">
                                <p class="wt-portfolio-4-top-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="wt-portfolio-4-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wt-portfolio-4-slider">
                            <div class="wt-portfolio-4-active swiper-container">
                                <div class="swiper-wrapper">
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
                                            <div class="wt-portfolio-4-wrapper swiper-slide">
                                                <div class="wt-portfolio-4-thumb">
                                                    <div class="image not-hide-cursor" data-cursor="<?php esc_attr_e('Drag', 'noxfolio-toolkit'); ?>">
                                                        <?php if (has_post_thumbnail()) : ?>
                                                            <a class="cursor-hide" href="<?php the_permalink(); ?>">
                                                                <?php echo get_the_post_thumbnail($idd, $settings['post_thumbnail_size'], 'w-100'); ?>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="wt-portfolio-4-box">
                                                    <div class="wt-portfolio-4-content">
                                                        <?php if ($categories_list && !is_wp_error($categories_list)) : ?>
                                                            <p class="wt-portfolio-4-paragraph">
                                                                <?php
                                                                $categories = array();
                                                                foreach ($categories_list as $category) {
                                                                    $categories[] = $category->name;
                                                                }
                                                                echo implode(', ', $categories);
                                                                ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <<?php echo nt_escape_tags($settings['title_tag']); ?> class="wt-portfolio-4-title">
                                                            <a href="<?php the_permalink(); ?>"> <?php echo nt_kses_basic($the_title); ?></a>
                                                        </<?php echo nt_escape_tags($settings['title_tag']); ?>>
                                                    </div>
                                                    <div class="wt-portfolio-4-icon">
                                                        <a href="<?php the_permalink(); ?>"><i class="fa-solid fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                    <?php if ('elementor-field' == $settings['portfolio_type']) : ?>
                                        <?php
                                        if (is_array($settings['layout_one_portfolio_list'])) :
                                            foreach ($settings['layout_one_portfolio_list'] as $portfolio) :

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
                                                    <div class="wt-portfolio-4-wrapper swiper-slide">
                                                        <div class="wt-portfolio-4-thumb">
                                                            <div class="image not-hide-cursor" data-cursor="<?php esc_attr_e('Drag', 'noxfolio-toolkit'); ?>">
                                                                <a class="cursor-hide" href="<?php the_permalink(); ?>">
                                                                    <?php nt_elementor_rendered_image($portfolio, 'image', 'w-100'); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="wt-portfolio-4-box">
                                                            <div class="wt-portfolio-4-content">
                                                                <?php if ($categories_list && !is_wp_error($categories_list)) : ?>
                                                                    <p class="wt-portfolio-4-paragraph">
                                                                        <?php
                                                                        $categories = array(); // Initialize an empty array
                                                                        foreach ($categories_list as $category) {
                                                                            $categories[] = $category->name; // Add category names to the array
                                                                        }
                                                                        echo implode(', ', $categories); // Output the list as a comma-separated string
                                                                        ?>
                                                                    </p>
                                                                <?php endif; ?>

                                                                <<?php echo nt_escape_tags($settings['title_tag']); ?> class="wt-portfolio-4-title">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php
                                                                        if (!empty($portfolio['title'])):
                                                                            echo nt_kses_basic($portfolio['title']);
                                                                        else:
                                                                            echo nt_kses_basic($the_title);
                                                                        endif;
                                                                        ?>
                                                                    </a>
                                                                </<?php echo nt_escape_tags($settings['title_tag']); ?>>

                                                            </div>
                                                            <div class="wt-portfolio-4-icon">
                                                                <a href="<?php the_permalink(); ?>"><i class="fa-solid fa-plus"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Area End-->
<?php endif; ?>