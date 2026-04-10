<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Service area start -->
    <section class="wt-service-3-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wt-service-3-left wt_fade_anim" data-delay=".3">
                        <div class="wt-section-wrapper wt-section-3-wrapper">
                            <?php if ($settings['layout_one_title']) : ?>
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                    <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                                </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            <?php endif; ?>
                            <?php if ($settings['layout_one_summary_text']) : ?>
                                <p class="wt-section-paragraph wt-section-3-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if (is_array($settings['layout_one_items'])) : ?>
                            <div class="wt-service-3-left-wrapper p-relative z-index-1">
                                <?php
                                foreach ($settings['layout_one_items'] as $index => $item) :
                                    $class = 'one';
                                    if ($index == 1) {
                                        $class = "two";
                                    } elseif ($index == 2) {
                                        $class = "three";
                                    } elseif ($index == 3) {
                                        $class = "four";
                                    } elseif ($index == 4) {
                                        $class = "five";
                                    }
                                ?>
                                    <div class="wt-service-3-left-item <?php echo esc_attr($class); ?>">
                                        <span><?php echo esc_html($item['name']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wt-service-3-right wt_fade_anim" data-delay=".5">
                        <?php
                        if (is_array($settings['layout_one_service_list'])) :
                            $i = 1;
                            foreach ($settings['layout_one_service_list'] as $service) :
                        ?>
                                <div class="wt-service-3-item <?php echo esc_attr($i == 1 ? 'active' : ''); ?>">
                                    <div class="wt-service-3-icon">
                                        <span><?php \Elementor\Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                                    </div>
                                    <div class="wt-service-3-content">
                                        <h4 class="wt-service-3-title">
                                            <a href="<?php echo esc_url($service['url']['url']); ?>" <?php if (!empty($service['url']['is_external'])) : ?> target="_blank" <?php endif; ?>><?php echo esc_html($service['title']); ?></a>
                                        </h4>
                                        <p class="wt-service-3-paragraph"><?php echo esc_html($service['description']); ?></p>
                                        <div class="wt-service-3-button wt-cercal-sm-button">
                                            <a href="<?php echo esc_url($service['url']['url']); ?>" <?php if (!empty($service['url']['is_external'])) : ?> target="_blank" <?php endif; ?>><i class="fa-regular fa-arrow-up-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $i++;
                            endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service area end -->
<?php endif; ?>