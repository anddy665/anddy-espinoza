<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!-- Service area start -->
    <section class="wt-service-4-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-6">
                    <div class="wt-section-4-wrapper mb-60">
                        <?php if ($settings['layout_two_title']) : ?>
                            <<?php echo esc_attr($settings['layout_two_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_two_title']); ?></<?php echo esc_attr($settings['layout_two_title_tag']); ?>>
                        <?php endif; ?>
                        <?php if ($settings['layout_two_summary_text']) : ?>
                            <div class="wt-section-4-descr">
                                <p class="wt-section-4-paragraph"><?php echo nt_kses_basic($settings['layout_two_summary_text']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if (is_array($settings['layout_two_service_list'])) :
                    foreach ($settings['layout_two_service_list'] as $service) :
                ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="wt-service-4-wrapper wt_fade_anim" data-delay=".3">
                                <div class="wt-service-4-top">
                                    <div class="wt-service-4-icon">
                                        <span><?php \Elementor\Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                                    </div>
                                    <h4 class="wt-service-4-title">
                                        <a href="<?php echo esc_url($service['url']['url']); ?>" <?php if (!empty($service['url']['is_external'])) : ?> target="_blank" <?php endif; ?>><?php echo esc_html($service['title']); ?></a>
                                    </h4>
                                </div>
                                <div class="wt-service-4-bottom">
                                    <p class="wt-service-4-paragraph"><?php echo esc_html($service['description']); ?></p>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>
    <!-- Service area end -->
<?php endif; ?>