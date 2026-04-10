<?php
/**
 * Template Help center
 *
 * Help Center Template for admin panel
 *
 * @package Noxfolio
 */

$allowed_html = array(
	'a' => array(
		'href'   => true,
		'target' => true,
	),
);

?>
<div class="noxfolio-dashboard-pages noxfolio-helper-center-page">
	<div class="noxfolio-help-boxes">
		<div class="help-box doc-box" style="background-image: url( <?php echo esc_url( NOXFOLIO_ASSETS . '/img/doc-bg.jpg' ); ?> );">
			<div class="img">
				<img src="<?php echo esc_url( NOXFOLIO_ASSETS . '/img/doc-img.png' ); ?>" alt="<?php esc_attr_e( 'Documentation', 'noxfolio' ); ?>">
			</div>
			<a href="https://webtend-support.gitbook.io/docs/" target="_blank" class="help-center-btn"><?php esc_html_e( 'Documentation', 'noxfolio' ); ?></a>
		</div>
		<div class="help-box support-box" style="background-image: url( <?php echo esc_url( NOXFOLIO_ASSETS . '/img/support-bg.jpg' ); ?> );">
			<div class="img">
				<img src="<?php echo esc_url( NOXFOLIO_ASSETS . '/img/support-img.png' ); ?>" alt="<?php esc_attr_e( 'Documentation', 'noxfolio' ); ?>">
			</div>
			<a href="https://themeforest.net/user/webtend#contact" target="_blank" class="help-center-btn"><?php esc_html_e( 'Get Support', 'noxfolio' ); ?></a>
		</div>
		<div class="video-box">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>">
			<a href="https://www.youtube.com/channel/UC6OYi2U7vaoC25ZTMPMXzBw" target="_blank">
				<i class="dashicons dashicons-controls-play"></i>
			</a>
		</div>
	</div>
</div>
