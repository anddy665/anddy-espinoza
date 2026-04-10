<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!-- Hero area start -->
    <section class="wt-hero-4-area fix">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="wt-hero-4-wrapper">
                        <div class="wt-hero-4-content wt_fade_anim" data-delay=".3">
                            <<?php echo esc_attr($settings['layout_two_title_tag']); ?> class="wt-hero-4-title"><?php echo nt_kses_basic($settings['layout_two_title_first_part']); ?>
                                <span class="p-relative z-index-1"><?php nt_elementor_rendered_image($settings, 'layout_two_title_fist_image'); ?></span>
                                <?php echo nt_kses_basic($settings['layout_two_title_middle_part']); ?>
                                <span><?php nt_elementor_rendered_image($settings, 'layout_two_title_second_image'); ?></span> <?php echo nt_kses_basic($settings['layout_two_title_last_part']); ?>
                            </<?php echo esc_attr($settings['layout_two_title_tag']); ?>>

                            <div class="wt-hero-4-descrip">
                                <?php if ($settings['layout_two_summary_text']) : ?>
                                    <p class="wt-hero-4-paragraph"><?php echo nt_kses_basic($settings['layout_two_summary_text']); ?></p>
                                <?php endif; ?>
                                <div class="wt-hero-4-button">
                                    <div class="wt-hover-btn-wrapper">
                                        <a class="wt-btn-circle wt-hover-btn-item wt-hover-btn" href="<?php echo esc_url($settings['layout_two_button_url']['url']); ?>" <?php if (!empty($settings['layout_two_button_url']['is_external'])) : ?> target="_blank" <?php endif; ?>>
                                            <span class="wt-btn-circle-icon">
                                                <i class="fa-regular fa-arrow-up-right"></i>
                                            </span>
                                            <i class="wt-btn-circle-dot"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wt-hero-4-thumb wt_fade_anim" data-delay=".5">
                            <?php nt_elementor_rendered_image($settings, 'layout_two_image'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero area end -->
<?php endif; ?>