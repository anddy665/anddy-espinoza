<?php if ('layout_two' == $settings['layout_type']) : ?>
    <!-- Footer area start -->
    <div class="wt-footer-4-area p-relative fix">
        <div class="wt-footer-4-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="wt-footer-widget-top text-center wt_fade_anim" data-delay=".5">
                            <?php if (!empty($settings['layout_two_sec_title'])) :  ?>
                                <div class="wt-section-wrapper">
                                    <h2 class="wt-section-title wt_title_anim"><?php echo nt_kses_basic($settings['layout_two_sec_title']); ?>
                                    </h2>
                                </div>
                            <?php endif; ?>
                            <div class="wt-footer-widget-border"></div>
                            <div class="wt-footer-widget-mail wt-footer-4-widget-mail">
                                <h6><?php echo nt_kses_basic($settings['layout_two_email_title']); ?></h6>
                                <a href="<?php echo esc_url($settings['layout_two_email_url']); ?>"><?php echo nt_kses_basic($settings['layout_two_email_address']); ?></a>
                            </div>

                            <div class="wt-footer-widget-mail wt-footer-4-widget-mail">
                                <h6><?php echo nt_kses_basic($settings['layout_two_call_title']); ?></h6>
                                <a href="<?php echo esc_url($settings['layout_two_call_url']); ?>"><?php echo nt_kses_basic($settings['layout_two_call_number']); ?></a>
                            </div>

                            <?php if (is_array($settings['layout_two_social_icons'])): ?>
                                <div class="wt-footer-right-social wt-footer-4-right-social">
                                    <ul>
                                        <?php foreach ($settings['layout_two_social_icons'] as $item): ?>
                                            <li>
                                                <a href="<?php echo esc_url($item['social_url']['url']); ?>" <?php if (!empty($item['social_url']['is_external'])) : ?> target="_blank" <?php endif; ?>>
                                                    <span class="active-media"><?php echo esc_html($item['name']); ?></span>
                                                    <span class="hover-media"><?php \Elementor\Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true'], 'i'); ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="wt-contact-form-wrapper wt_fade_anim" data-delay=".7">
                            <?php if (!empty($settings['layout_two_contact_title'])) :  ?>
                                <div class="wt-contact-section-wrapper">
                                    <h4 class="wt-contact-section-title"><?php echo nt_kses_basic($settings['layout_two_contact_title']); ?></h4>
                                </div>
                            <?php endif; ?>
                            <?php echo str_replace("<br />", "", trim(do_shortcode('[metform form_id="' . $settings['layout_one_select_cf7_form'] . '" ]'))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($settings['layout_two_copyright_text'])) : ?>
            <div class="wt-footer-2-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="wt-footer-copyright text-center wt_fade_anim">
                                <p class="wt-footer-copyright-pagaraph"><?php echo nt_kses_basic($settings['layout_two_copyright_text']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Footer area end -->
<?php endif; ?>