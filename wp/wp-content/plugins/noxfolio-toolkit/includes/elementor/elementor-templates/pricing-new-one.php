<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Pricing area start -->
    <section class="wt-pricing-3-area">
        <div class="container">
            <div class="row">
                <?php if ($settings['layout_one_title']) : ?>
                    <div class="col-xl-6 col-lg-7">
                        <div class="wt-section-wrapper wt-section-3-wrapper mb-70 wt_fade_anim" data-delay=".3">
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                            </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($settings['layout_one_summary_text']) : ?>
                    <div class="col-xl-6 col-lg-5">
                        <div class="wt-portfolio-3-top-paragraph mt-40 wt_fade_anim" data-delay=".5">
                            <p><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php
                foreach ($settings['layout_one_pricing_list'] as $index => $item) :
                    $class = '';
                    if ($index  == 1) {
                        $class = "two";
                    } elseif ($index == 2) {
                        $class = "three";
                    }
                ?>
                    <div class="col-xl-12">
                        <div class="wt-pricing-2-wrapper wt-pricing-3-wrapper wt_fade_anim <?php echo esc_attr($class); ?>" data-delay=".3">
                            <div class="wt-pricing-2-top wt-pricing-3-top">
                                <h6 class="wt-pricing-2-subtitle"><?php echo esc_html($item['plan_title']); ?></h6>
                                <h4 class="wt-pricing-2-title"><?php echo esc_html($item['price']); ?></h4>
                            </div>
                            <?php if (!empty($item['service_list'])) : ?>
                                <div class="wt-pricing-2-list wt-pricing-3-list">
                                    <ul>
                                        <?php echo wp_kses($item['service_list'], array(
                                            'li' => array(
                                                'class' => array()
                                            ),
                                            'ul' => array(
                                                'class' => array()
                                            ),
                                            'i' => array(
                                                'class' => array()
                                            )
                                        )); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="wt-cercal-sm-button wt-pricing-3-button">
                                <a href="<?php echo esc_url($item['url']['url']); ?>"><i class="fa-regular fa-arrow-up-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Pricing area end -->
<?php endif; ?>