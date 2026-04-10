<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Skill area start -->
    <section class="wt-skill-4-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-10">
                    <div class="wt-skill-4-left wt_fade_anim" data-delay=".3">
                        <div class="wt-section-4-wrapper mb-60">
                            <?php if ($settings['layout_one_title']) : ?>
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_one_title']); ?></<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            <?php endif; ?>
                            <?php if ($settings['layout_one_summary_text']) : ?>
                                <p class="wt-section-4-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="wt-skill-4-wrap">
                            <?php
                            foreach ($settings['layout_one_skills_list'] as $index => $item) :
                            ?>
                                <div class="wt-skill-4-item">
                                    <div class="progress-lavel"><?php echo esc_html($item['title']); ?></div>
                                    <div class="progress_bar">
                                        <div class="progress-item">
                                            <div class="item_value">0%</div>
                                            <div class="item_bar">
                                                <div class="progress" data-progress="<?php echo esc_attr($item['percentage']); ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="wt-hero-4-thumb wt-skill-4-thumb wt_fade_anim" data-delay=".5">
                        <?php nt_elementor_rendered_image($settings, 'layout_one_image'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Skill area end -->
<?php endif; ?>