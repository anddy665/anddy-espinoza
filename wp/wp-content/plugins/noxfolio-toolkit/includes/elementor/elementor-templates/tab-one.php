<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- Experience area start -->
    <section class="wt-experience-3-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="wt-experience-3-left">
                        <div class="wt-section-wrapper wt-section-3-wrapper mb-70">
                            <?php if ($settings['layout_one_title']) : ?>
                                <<?php echo esc_attr($settings['layout_one_title_tag']); ?> class="wt-section-title wt-section-3-title wt_reveal_anim">
                                    <?php echo nt_kses_basic($settings['layout_one_title']); ?>
                                </<?php echo esc_attr($settings['layout_one_title_tag']); ?>>
                            <?php endif; ?>
                            <?php if ($settings['layout_one_summary_text']) : ?>
                                <p class="wt-section-paragraph wt-section-3-paragraph"><?php echo nt_kses_basic($settings['layout_one_summary_text']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="wt-experience-3-tab-button">
                            <ul class="wt-experience-3-nav-tabs nav nav-tabs" id="myTab" role="tablist">
                                <?php if (!empty($settings['layout_one_tab_one_name'])) : ?>
                                    <li class="wt-experience-3-nav-item nav-item" role="presentation"><button
                                            class="wt-experience-3-nav-link nav-link active" id="home-tab"
                                            data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                            aria-controls="home" aria-selected="true"><?php echo esc_html($settings['layout_one_tab_one_name']); ?></button></li>
                                <?php endif; ?>
                                <?php if (!empty($settings['layout_one_tab_two_name'])) : ?>
                                    <li class="wt-experience-3-nav-item nav-item" role="presentation"><button
                                            class="wt-experience-3-nav-link nav-link" id="profile-tab"
                                            data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                            role="tab" aria-controls="profile" aria-selected="false"><?php echo esc_html($settings['layout_one_tab_two_name']); ?></button></li>
                                <?php endif; ?>
                                <?php if (!empty($settings['layout_one_tab_three_name'])) : ?>
                                    <li class="wt-experience-3-nav-item nav-item" role="presentation"><button
                                            class="wt-experience-3-nav-link nav-link" id="messages-tab"
                                            data-bs-toggle="tab" data-bs-target="#messages" type="button"
                                            role="tab" aria-controls="messages" aria-selected="false"><?php echo esc_html($settings['layout_one_tab_three_name']); ?></button></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-9">
                    <div class="wt-experience-3-wrapper">
                        <div class="tab-content">
                            <?php if (is_array($settings['layout_one_tab_one_content'])) : ?>
                                <div class="tab-pane active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <?php foreach ($settings['layout_one_tab_one_content']  as $index => $tablist): ?>
                                        <div class="wt-experience-3-item wt_fade_anim" data-delay=".3">
                                            <div class="wt-experience-3-top-content">
                                                <div class="wt-experience-3-top-left">
                                                    <p><span><i class="fa-light fa-calendar-days"></i></span>
                                                        <?php echo esc_html($tablist['date']); ?></p>
                                                    <h4 class="wt-experience-3-title"><?php echo esc_html($tablist['title']); ?></h4>
                                                </div>
                                                <div class="wt-experience-3-top-right">
                                                    <span><?php echo esc_html($tablist['company_name']); ?></span>
                                                </div>
                                            </div>
                                            <div class="wt-experience-3-bottom-content">
                                                <p class="wt-experience-3-bottom-paragraph"><?php echo esc_html($tablist['description']); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (is_array($settings['layout_one_tab_two_content'])) : ?>
                                <div class="tab-pane" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="row">
                                        <?php foreach ($settings['layout_one_tab_two_content']  as $index => $tablist): ?>
                                            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="wt-skill-2-wrapper wt_fade_anim" data-delay=".3">
                                                    <div class="wt-skill-2-thumb">
                                                        <?php nt_elementor_rendered_image($tablist, 'image'); ?>
                                                    </div>
                                                    <div class="wt-skill-2-content">
                                                        <h2 class="wt-skill-2-counter-title"><span
                                                                class="purecounter" data-purecounter-duration="3"
                                                                data-purecounter-end="<?php echo esc_attr($tablist['number']); ?>"></span><?php echo esc_html($tablist['symbol']); ?></h2>
                                                        <p class="wt-skill-2-counter-paragraph"><?php echo esc_html($tablist['title']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (is_array($settings['layout_one_tab_three_content'])) : ?>
                                <div class="tab-pane" id="messages" role="tabpanel"
                                    aria-labelledby="messages-tab">
                                    <?php foreach ($settings['layout_one_tab_three_content']  as $index => $tablist): ?>
                                        <div class="wt-experience-3-item wt_fade_anim" data-delay=".3">
                                            <div class="wt-experience-3-top-content">
                                                <div class="wt-experience-3-top-left">
                                                    <p><span><i class="fa-light fa-calendar-days"></i></span>
                                                        <?php echo esc_html($tablist['date']); ?></p>
                                                    <h4 class="wt-experience-3-title"><?php echo esc_html($tablist['title']); ?></h4>
                                                </div>
                                                <div class="wt-experience-3-top-right">
                                                    <span><?php echo esc_html($tablist['company_name']); ?></span>
                                                </div>
                                            </div>
                                            <div class="wt-experience-3-bottom-content">
                                                <p class="wt-experience-3-bottom-paragraph"><?php echo esc_html($tablist['description']); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experience area end -->
<?php endif; ?>