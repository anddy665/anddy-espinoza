<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!-- Testimonial area start -->
    <section class="wt-testimonial-4-area fix">
        <div class="container">
            <?php if ($settings['layout_two_title']) : ?>
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="wt-section-4-wrapper text-center mb-60">
                            <<?php echo esc_attr($settings['layout_two_title_tag']); ?> class="wt-section-4-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_two_title']); ?></<?php echo esc_attr($settings['layout_two_title_tag']); ?>>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xxl-12">
                    <div class="wt-testimonial-4-slide p-relative wt_fade_anim">
                        <div class="wt-testimonial-4-active swiper-container">
                            <div class="wt-testimonial-4-swiper-wrapper swiper-wrapper">
                                <?php
                                if (is_array($settings['layout_two_testimonial'])) :
                                    $i = 1;
                                    foreach ($settings['layout_two_testimonial'] as $item) :
                                        $class = '';
                                        if (2 == $i) {
                                            $class = 'two';
                                        } elseif (3 == $i) {
                                            $class = 'three';
                                        } elseif (4 == $i) {
                                            $class = 'four';
                                        } elseif (5 == $i) {
                                            $class = 'five';
                                        }
                                ?>

                                        <div class="wt-testimonial-4-wrapper swiper-slide <?php echo esc_attr($class); ?>">
                                            <div class="wt-testimonial-top">
                                                <div class="wt-testimonial-img">
                                                    <?php nt_elementor_rendered_image($item, 'image'); ?>
                                                </div>
                                                <div class="wt-testimonial-review">
                                                    <div class="star-ratings">
                                                        <div class="fill-ratings" style="width: 88%">
                                                            <span><?php for ($k = 0; $k < $item['rating']['size']; $k++) : ?>★<?php endfor; ?></span>
                                                        </div>
                                                        <div class="empty-ratings">
                                                            <span>★★★★★</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wt-testimonial-content">
                                                <p class="wt-testimonial-paragraph wt-testimonial-4-paragraph"><?php echo nt_kses_basic($item['testimonial']); ?></p>
                                                <h5 class="wt-testimonial-name"><?php echo esc_html($item['name']); ?></h5>
                                            </div>
                                        </div>
                                <?php
                                        $i++;
                                    endforeach;
                                endif; ?>
                            </div>
                        </div>
                        <div class="wt-testimonial-4-arrow-box ">
                            <button class="slider-prev" tabindex="0" aria-label="<?php esc_attr_e('Previous slide', 'noxfolio-toolkit'); ?>">
                                <i class="fa-regular fa-arrow-left"></i>
                            </button>
                            <button class="slider-next" tabindex="0" aria-label="<?php esc_attr_e('Next slide', 'noxfolio-toolkit'); ?>">
                                <i class="fa-regular fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="wt-testimonial-4-dot text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial area end -->
<?php endif; ?>