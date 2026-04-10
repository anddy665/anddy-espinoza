<?php if ('layout_one' == $settings['layout_type']) : ?>
    <div class="wt-footer-2-top">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="wt-brand-2-slider">
                        <div class="wt-brand-2-active swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['layout_one_sponsors'] as $item) : ?>
                                    <div class="wt-brand-2-item swiper-slide">
                                        <div class="wt-brand-2-thumb">
                                            <?php nt_elementor_rendered_image($item, 'image'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>