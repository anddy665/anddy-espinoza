<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Footer area start -->
    <div class="wt-footer-2-area wt-footer-3-area fix">
        <div class="wt-footer-2-center">
            <div class="container">
                <div class="row">
                    <?php if (!empty($settings['layout_one_sec_title'])) : ?>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <div class="wt-footer-2-title">
                                <div class="wt-section-wrapper mb-70 wt_reveal_anim">
                                    <h2 class="wt-section-title wt_reveal_anim">
                                        <?php echo nt_kses_basic($settings['layout_one_sec_title']); ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (is_array($settings['layout_one_social_icons'])): ?>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <div class="wt-footer-2-social wt-footer-right-social d-none d-md-block">
                                <ul>
                                    <?php foreach ($settings['layout_one_social_icons'] as $item): ?>
                                        <li>
                                            <a href="<?php echo esc_url($item['social_url']['url']); ?>" <?php if (!empty($item['social_url']['is_external'])) : ?> target="_blank" <?php endif; ?>>
                                                <span class="active-media"><?php echo esc_html($item['name']); ?></span>
                                                <span class="hover-media"><?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-xl-2 col-lg-2 col-md-2">
                        <div class="wt-footer-2-widget-menu d-none d-sm-block">
                            <div class="wt-header-menu">
                                <ul>
                                    <li>
                                        <?php if (!empty($settings['layout_one_menu_icon']['url'])) : ?>
                                            <a href="#" class="footer-menu-icon"><img src="<?php echo esc_url($settings['layout_one_menu_icon']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"> <?php echo esc_html($settings['layout_one_menu_title']); ?></a>
                                        <?php endif; ?>
                                        <ul class="submenu">
                                            <?php foreach ($settings['layout_one_menus'] as $item) : ?>
                                                <li><a href="<?php echo esc_url($item['url']['url']); ?>" <?php if (!empty($item['url']['is_external'])) : ?> target="_blank" <?php endif; ?>><?php echo esc_html($item['name']); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="wt-footer-2-widget-mail wt-footer-widget-mail">
                            <h6><?php echo nt_kses_basic($settings['layout_one_email_title']); ?></h6>
                            <a href="<?php echo esc_url($settings['layout_one_email_url']); ?>"><?php echo nt_kses_basic($settings['layout_one_email_address']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wt-footer-2-bottom">
            <div class="container-fluid">
                <?php if (!empty($settings['layout_one_sliding_text'])) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="wt-about-bottom-content text-center">
                                <h2 class="wt-about-title wt-footer-2-animated-title"><?php echo nt_kses_basic($settings['layout_one_sliding_text']); ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($settings['layout_one_copyright_text'])) : ?>
                    <div class="row">
                        <div class="col">
                            <div class="wt-footer-copyright text-center wt_fade_anim">
                                <p class="wt-footer-copyright-pagaraph"><?php echo nt_kses_basic($settings['layout_one_copyright_text']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="wt-footer-2-shape">
            <?php nt_elementor_rendered_image($settings, 'layout_one_shape', 'wt-footer-2-shape-1'); ?>
        </div>
    </div>
    <!-- Footer area end -->
<?php endif; ?>