<?php
/**
 * Template part for displaying Main Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Noxfolio
 */
use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;

$site_logo_type  = Helper::get_option( 'site_logo_type', 'image' );
$site_text_logo  = Helper::get_option( 'site_text_logo', __( 'Noxfolio', 'noxfolio' ) );
$site_image_logo = Helper::get_option( 'site_image_logo', array( 'url' => NOXFOLIO_ASSETS . '/img/logo.png' ) );

$panel_logo_type  = Helper::get_option( 'panel_logo_type', 'image' );
$panel_text_logo  = Helper::get_option( 'panel_text_logo', __( 'Noxfolio', 'noxfolio' ) );
$panel_image_logo = Helper::get_option( 'panel_image_logo', array( 'url' => NOXFOLIO_ASSETS . '/img/logo.png' ) );

$breakpoint = Helper::get_option( 'mobile_breakpoint', 'mobile-expand-xl' );

$header_button = Helper::get_option( 'header_button', 'enabled' );
$button_text   = Helper::get_option( 'button_text', __( 'Get a Quote', 'noxfolio' ) );
$button_url    = Helper::get_option( 'button_url', '#' );
$button_icon   = Helper::get_option( 'button_icon', 'far fa-angle-right' );

$hide_panel_button = Helper::get_option( 'hide_panel_button', 'no' );

?>
<header class="site-header default-header">
	<div class="header-container">
		<div class="header-navigation">
			<div class="noxfolio-site-logo">
				<a href="<?php echo esc_url( home_url() ); ?>">
				<?php if ( 'text' === $site_logo_type && ! empty( $site_text_logo ) ) : ?>
					<?php echo esc_html( $site_text_logo ); ?>
				<?php elseif ( 'image' === $site_logo_type && ! empty( $site_image_logo['url'] ) ) : ?>
					<img src="<?php echo esc_url( $site_image_logo['url'] ); ?>" alt="<?php echo esc_html( get_bloginfo() ); ?>">
				<?php endif; ?>
				</a>
			</div>
			<nav class="noxfolio-nav-menu <?php echo esc_attr( $breakpoint ); ?>">
				<?php
					$args = array(
						'container'       => 'div',
						'container_class' => 'nav-menu-wrapper nav-left',
						'theme_location'  => 'primary_menu',
						'menu_class'      => 'primary-menu',
						'after'           => '',
						'link_before'     => '<span class="link-text">',
						'link_after'      => '</span>',
						'fallback_cb'     => false,
						'depth'           => 4,
					);

					wp_nav_menu( $args );
					?>
				<?php if ( has_nav_menu( 'mobile_menu' ) || has_nav_menu( 'primary_menu' ) ) : ?>
				<div class="navbar-toggler">
					<span>
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</span>
				</div>
				<?php endif; ?>
				<div class="slide-panel-wrapper">
					<div class="slide-panel-overly"></div>
					<div class="slide-panel-content">
						<div class="slide-panel-close">
							<i class="fal fa-times"></i>
						</div>
						<div class="slide-panel-logo">
						<?php if ( 'text' === $panel_logo_type && ! empty( $panel_text_logo ) ) : ?>
							<?php echo esc_html( $panel_text_logo ); ?>
						<?php elseif ( 'image' === $panel_logo_type && ! empty( $panel_image_logo['url'] ) ) : ?>
							<img src="<?php echo esc_url( $panel_image_logo['url'] ); ?>" alt="<?php echo esc_html( get_bloginfo() ); ?>">
						<?php endif; ?>
						</div>
						<?php
						$mobile_menu = array(
							'container'       => 'div',
							'container_class' => 'slide-panel-menu',
							'theme_location'  => 'mobile_menu',
							'menu_class'      => 'primary-menu',
							'after'           => '',
							'link_before'     => '<span class="link-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => false,
							'depth'           => 4,
						);

						if ( ! has_nav_menu( 'mobile_menu' ) && has_nav_menu( 'primary_menu' ) ) {
							$mobile_menu['theme_location'] = 'primary_menu';
						}

						wp_nav_menu( $mobile_menu );
						?>
						<?php if ( 'enabled' === $header_button && 'yes' !== $hide_panel_button ) : ?>
						<div class="noxfolio-button-wrapper">
							<a href="<?php echo esc_url( $button_url ); ?>" class="noxfolio-button icon-right">
								<span class="button-text">
									<?php echo esc_html( $button_text ); ?>
								</span>
								<?php if ( $button_icon ) : ?>
								<span class="button-icon">
									<i class="<?php echo esc_attr( $button_icon ); ?>"></i>
								</span>
								<?php endif; ?>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</nav>
			<?php if ( 'enabled' === $header_button ) : ?>
			<div class="noxfolio-button-wrapper">
				<a href="<?php echo esc_url( $button_url ); ?>" class="noxfolio-button icon-right">
					<span class="button-text">
						<?php echo esc_html( $button_text ); ?>
					</span>
					<?php if ( $button_icon ) : ?>
					<span class="button-icon">
						<i class="<?php echo esc_attr( $button_icon ); ?>"></i>
					</span>
					<?php endif; ?>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</header>
