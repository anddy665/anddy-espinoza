<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Hero area start -->
    <section class="wt-hero-3-area">
        <div class="container">
            <?php if (!empty($settings['layout_one_title'])) : ?>
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-hero-3-title wt_fade_anim"><?php echo wp_kses_post($settings['layout_one_title']); ?></<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                    <div class="wt-hero-3-top-wrap mt-60 wt_fade_anim" data-delay=".5">
                        <div class="wt-hero-3-play-btn">
                            <?php if (!empty($settings['layout_one_video_url'])) : ?>
                                <a class="popup-video" href="<?php echo esc_url($settings['layout_one_video_url']); ?>"><i class="fa-sharp fa-solid fa-play"></i></a>
                            <?php endif; ?>
                            <P><?php echo nt_kses_basic($settings['layout_one_video_caption']); ?></P>
                        </div>
                        <?php if (!empty($settings['layout_one_summary_text'])) : ?>
                            <p class="wt-hero-3-top-paragraph"><?php echo esc_html($settings['layout_one_summary_text']); ?></p>
                        <?php endif; ?>
                        <div class="wt-hero-3-top-button">
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
                <div class="col-xl-8 col-lg-7">
                    <div class="wt-hero-3-thumb wt_fade_anim" data-delay=".7">
                        <?php nt_elementor_rendered_image($settings, 'layout_one_image'); ?>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2">
                    <div class="wt-hero-3-counter mt-40 wt_fade_anim" data-delay=".9">
                        <div class="wt-team-counter-wrap">
                            <?php
                            foreach ($settings['layout_one_counter_list'] as $index => $item) :
                            ?>
                                <div class="wt-team-counter-item">
                                    <div class="wt-team-counter-count">
                                        <h2 class="wt-team-counter-title"><span class="purecounter" data-purecounter-duration="5" data-purecounter-end="<?php echo esc_attr($item['number']); ?>"></span><?php echo esc_html($item['symbol']); ?></h2>
                                    </div>
                                    <div class="wt-team-counter-text">
                                        <p class="wt-team-counter-paragraph"><?php echo esc_html($item['title']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($settings['layout_one_social_icons'])) : ?>
            <div class="wt-hero-3-social wt-footer-right-social wt_fade_anim">
                <ul>
                    <?php foreach ($settings['layout_one_social_icons'] as $social_icon) : ?>
                        <li>
                            <a href="<?php echo esc_url($social_icon['social_url']['url']); ?>">
                                <span class="active-media"><?php echo esc_html($social_icon['text']); ?></span>
                                <span class="hover-media"><?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </section>
    <!-- Hero area end -->
<?php endif; ?>