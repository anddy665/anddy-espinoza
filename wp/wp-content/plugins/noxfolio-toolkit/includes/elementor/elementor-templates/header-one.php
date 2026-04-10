<?php if ('layout_one' == $settings['layout_type']) : ?>
    <!-- wt-offcanvus-area-start -->
    <div class="wtoffcanvas-area">
        <div class="wtoffcanvas">
            <div class="wtoffcanvas__close-btn">
                <button class="close-btn"><i class="fal fa-times"></i></button>
            </div>
            <div class="wtoffcanvas__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($settings['mobile_menu_logo']['url']); ?>" width="<?php echo esc_attr($settings['mobile_menu_logo_size']['width']); ?>" height="<?php echo esc_attr($settings['mobile_menu_logo_size']['height']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
            </div>
            <?php if (!empty($settings['mobile_menu_summary_text'])) : ?>
                <div class="wtoffcanvas__title">
                    <p><?php echo esc_html($settings['mobile_menu_summary_text']); ?></p>
                </div>
            <?php endif; ?>
            <div class="wt-main-menu-mobile d-xl-none"></div>

            <div class="wtoffcanvas__contact-info">
                <?php if (!empty($settings['mobile_menu_contact_title'])) : ?>
                    <div class="wtoffcanvas__contact-title">
                        <h5><?php echo esc_html($settings['mobile_menu_contact_title']); ?></h5>
                    </div>
                <?php endif; ?>
                <?php if (is_array($settings['mobile_menu_contact_info'])) : ?>
                    <ul>
                        <?php foreach ($settings['mobile_menu_contact_info'] as $contact) : ?>
                            <li>
                                <?php \Elementor\Icons_Manager::render_icon($contact['icon'], ['aria-hidden' => 'true'], 'i'); ?>
                                <?php echo nt_kses_basic($contact['content']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="wtoffcanvas__input">
                <?php if (!empty($settings['mobile_menu_subscribe_title'])) : ?>
                    <div class="wtoffcanvas__input-title">
                        <h4><?php echo esc_html($settings['mobile_menu_subscribe_title']); ?></h4>
                    </div>
                <?php endif; ?>
                <form action="#">
                    <div class="p-relative">
                        <input type="text" placeholder="Enter mail">
                        <button>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
            <?php if (is_array($settings['mobile_menu_social_icons'])) : ?>
                <div class="wtoffcanvas__social">
                    <div class="social-icon">
                        <?php foreach ($settings['mobile_menu_social_icons'] as $social_icon) : ?>
                            <a href="<?php echo esc_url($social_icon['social_url']['url']); ?>"><?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true'], 'i'); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- wt-offcanvus-area-end -->
    <!-- header area start -->
    <div class="wt-header-height">
        <div id="header-sticky" class="wt-header-3-area wt-header-transparent">
            <div class="container">
                <div class="wt-header-3-wrapper p-relative">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="wt-header-wrapper">

                                <!-- Header logo -->
                                <div class="wt-header-logo">
                                    <a href="<?php echo esc_url(home_url('/')); ?>">
                                        <img src="<?php echo esc_url($settings['logo']['url']); ?>" width="<?php echo esc_attr($settings['logo_size']['width']); ?>" height="<?php echo esc_attr($settings['logo_size']['height']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                    </a>
                                </div>

                                <!-- Header menu -->
                                <div class="wt-header-main-menu d-none d-lg-block">
                                    <nav class="wt-main-menu-content">
                                        <?php
                                        wp_nav_menu(
                                            array(
                                                'menu' => $settings['nav_menu'],
                                                'menu_class' => 'navigation clearfix',
                                                'container'       => '',
                                                'fallback_cb'     => false,
                                                'container_class' => '',
                                            )
                                        );
                                        ?>
                                    </nav>
                                </div>
                                <?php if (!empty($settings['button_label'])) : ?>
                                    <!-- Header Button -->
                                    <div class="wt-header-buton icon_main d-none d-lg-block">
                                        <a class="wt-header-btn" href="<?php echo esc_url($settings['button_url']['url']); ?>" <?php if (!empty($settings['button_url']['is_external'])) : ?> target="_blank" <?php endif; ?>><?php echo esc_html($settings['button_label']); ?>
                                            <span class="icon_box">
                                                <i class="icon_first fa-regular fa-arrow-right"></i>
                                                <i class="icon_second fa-regular fa-arrow-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <!-- Header Site-Ber Button -->
                                <div class="wt-header-3-toggle d-lg-none">
                                    <button class="wt-menu-bar">
                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 5C3.88071 5 5 3.88071 5 2.5C5 1.11929 3.88071 0 2.5 0C1.11929 0 0 1.11929 0 2.5C0 3.88071 1.11929 5 2.5 5ZM2.5 15C3.88071 15 5 13.8807 5 12.5C5 11.1193 3.88071 10 2.5 10C1.11929 10 0 11.1193 0 12.5C0 13.8807 1.11929 15 2.5 15ZM15 2.5C15 3.88071 13.8807 5 12.5 5C11.1193 5 10 3.88071 10 2.5C10 1.11929 11.1193 0 12.5 0C13.8807 0 15 1.11929 15 2.5ZM12.5 15C13.8807 15 15 13.8807 15 12.5C15 11.1193 13.8807 10 12.5 10C11.1193 10 10 11.1193 10 12.5C10 13.8807 11.1193 15 12.5 15Z" fill="white"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header area end -->
<?php endif; ?>