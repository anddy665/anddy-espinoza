<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- About area start -->
    <section class="wt-about-3-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-11">
                    <div class="wt-about-3-thumb wt_fade_anim" data-delay=".3" data-tilt>
                        <?php nt_elementor_rendered_image($settings, 'layout_one_image'); ?>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="wt-about-3-wrapper wt_fade_anim" data-delay=".5">
                        <?php if ($settings['layout_one_title']) : ?>
                            <div class="wt-section-wrapper wt-section-3-wrapper mb-45">
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                    <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                                </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            </div>
                        <?php endif; ?>
                        <?php if ($settings['layout_one_summary_text']) : ?>
                            <p class="wt-about-3-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                        <?php endif; ?>
                        <div class="wt-about-3-bottom">
                            <div class="wt-about-3-member">
                                <h4 class="wt-about-3-member-title"><?php echo esc_html($settings['layout_one_client_caption']); ?></h4>
                                <?php if (is_array($settings['layout_one_client_image'])) : ?>
                                    <ul>
                                        <?php foreach ($settings['layout_one_client_image'] as $image) : ?>
                                            <li><img src="<?php echo esc_url($image['url']); ?>" alt="<?php nt_get_elementor_thumbnail_alt($image['id']); ?>"></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="wt-about-3-button">
                                <div class="wt-hover-btn-wrapper">
                                    <a class="wt-btn-circle wt-hover-btn-item wt-hover-btn" href="<?php echo esc_url($settings['layout_one_button_url']['url']); ?>" <?php if (!empty($settings['layout_one_button_url']['is_external'])) : ?> target="_blank" <?php endif; ?>>
                                        <span class="wt-btn-circle-icon">
                                            <i class="fa-regular fa-arrow-up-right"></i>
                                        </span>
                                        <i class="wt-btn-circle-dot"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About area end -->
<?php endif; ?>