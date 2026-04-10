<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- About area start-->
    <section class="wt-about-4-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="wt-about-4-wrapper">
                        <?php if ($settings['layout_one_title']) : ?>
                            <div class="wt-about-4-content wt_fade_anim" data-delay=".3">
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-about-4-title">
                                    <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                                </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            </div>
                        <?php endif; ?>
                        <div class="wt-about-4-wrap wt_fade_anim" data-delay=".5">
                            <?php if ($settings['layout_one_summary_text']) : ?>
                                <div class="wt-about-4-descri">
                                    <p class="wt-about-4-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($settings['layout_one_button_url']['url'])) : ?>
                                <div class="wt-about-4-button">
                                    <div class="wt-hover-btn-wrapper">
                                        <a class="wt-btn-circle wt-hover-btn-item wt-hover-btn" href="<?php echo esc_url($settings['layout_one_button_url']['url']); ?>" <?php if (!empty($settings['layout_one_button_url']['is_external'])) : ?> target="_blank" <?php endif; ?>>
                                            <span class="wt-btn-circle-icon">
                                                <i class="fa-regular fa-arrow-up-right"></i>
                                            </span>
                                            <i class="wt-btn-circle-dot"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="wt-about-4-counter">
                    <?php
                    foreach ($settings['layout_one_counter_list'] as $index => $item) :
                    ?>
                        <div class="wt-about-4-counter-item wt_fade_anim" data-delay=".3">
                            <div class="wt-about-4-counter-count">
                                <h2 class="wt-about-4-counter-title"><span class="purecounter" data-purecounter-duration="2" data-purecounter-end="<?php echo esc_attr($item['number']); ?>"></span><?php echo esc_attr($item['symbol']); ?></h2>
                            </div>
                            <div class="wt-about-4-counter-text">
                                <p class="wt-about-4-counter-paragraph"><?php echo esc_html($item['title']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- About area end -->
<?php endif; ?>