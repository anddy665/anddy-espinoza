<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Maquee area start -->
    <section class="wt-maquee-3-area fix">
        <div class="wt-maquee-3-slider">
            <div class="swiper wt-maquee-3-active">
                <div class="swiper-wrapper wt-maquee-3-transition">
                    <?php foreach ($settings['layout_one_sliding_text'] as $index =>  $item) : ?>
                        <div class="wt-maquee-3-box swiper-slide">
                            <div class="wt-maquee-3-icon">
                                <span><?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                            </div>
                            <div class="wt-maquee-3-content">
                                <h5 class="wt-maquee-3-title"><?php echo esc_html($item['text']); ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Maquee area end -->
<?php endif; ?>