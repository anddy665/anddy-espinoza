<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Testimonial area start -->
    <section class="wt-testimonial-3-area">
        <div class="container">
            <?php if ($settings['layout_one_title']) : ?>
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="wt-section-wrapper wt-section-3-wrapper text-center mb-70">
                            <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                            </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-11">
                    <div class="wt-testimonial-3-slider p-relative wt_fade_anim">
                        <div class="wt-testimonial-3-active swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                if (is_array($settings['layout_one_testimonial'])) :
                                    foreach ($settings['layout_one_testimonial'] as $item) :
                                ?>
                                        <!-- slide 1 -->
                                        <div class="wt-testimonial-2-wrapper wt-testimonial-3-wrapper swiper-slide">
                                            <div class="wt-testimonial-2-img wt-testimonial-3-img">
                                                <?php nt_elementor_rendered_image($item, 'image'); ?>
                                            </div>
                                            <div class="wt-testimonial-2-review wt-testimonial-3-review">
                                                <h4><?php echo nt_kses_basic($item['tagline']); ?></h4>
                                                <div class="star-ratings star-ratings-3">
                                                    <div class="fill-ratings" style="width: 100%">
                                                        <span><?php for ($k = 0; $k < $item['rating']['size']; $k++) : ?>★<?php endfor; ?></span>
                                                    </div>
                                                    <div class="empty-ratings">
                                                        <span>★★★★★</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wt-testimonial-2-content">
                                                <p class="wt-testimonial-2-paragraph wt-testimonial-3-paragraph">
                                                    <?php echo nt_kses_basic($item['testimonial']); ?>
                                                </p>
                                            </div>
                                            <div
                                                class="wt-testimonial-3-name d-flex align-items-center justify-content-center">
                                                <h4 class="wt-testimonial-3-name-title"><?php echo esc_html($item['name']); ?></h4>
                                                <p class="wt-testimonial-3-name-paragraph"><?php echo esc_html($item['designation']); ?></p>
                                            </div>
                                        </div>
                                <?php endforeach;
                                endif; ?>
                            </div>
                        </div>
                        <div class="wt-testimonial-3-arrow-box">
                            <button class="slider-prev" tabindex="0" aria-label="Prev slide"><i
                                    class="fa-thin fa-arrow-left-long"></i></button>
                            <button class="slider-next" tabindex="0" aria-label="Next slide"><i
                                    class="fa-thin fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-testimonial-3-shape">
            <?php
            if (is_array($settings['layout_one_other_images'])) :
                $i = 1;
                foreach ($settings['layout_one_other_images'] as $item) :
            ?>
                    <img class="wt-testimonial-3-shape-<?php echo esc_attr($i); ?>" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr(nt_get_elementor_thumbnail_alt($item['image']['id']));   ?>">
            <?php
                    $i++;
                endforeach;
            endif; ?>
        </div>
    </section>
    <!-- Testimonial area end -->
<?php endif; ?>