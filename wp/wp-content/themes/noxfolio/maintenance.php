<?php
/**
 * The template for maintenance mode
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;

wp_head();

$maintenance_img      = Helper::get_option( 'maintenance_img', array( 'url' => NOXFOLIO_ASSETS . '/img/maintenance.png' ) );
$maintenance_title    = Helper::get_option( 'maintenance_title', __( 'The site is currently down for maintenance', 'noxfolio' ) );
$maintenance_subtitle = Helper::get_option( 'maintenance_subtitle', __( 'We apologize for any inconvenience caused', 'noxfolio' ) );
$maintenance_page     = Helper::get_option( 'maintenance_page' );
?>
<div class="noxfolio-maintenance-page">
	<div class="container">
		<div class="maintenance-content">
			<div class="maintenance-img">
				<img src="<?php echo esc_url( $maintenance_img['url'] ); ?>" alt="<?php esc_attr_e( 'Maintenance Mode', 'noxfolio' ); ?>">
			</div>
			<h2 class="maintenance-title">
				<?php echo esc_html( $maintenance_title ); ?>
			</h2>
			<p><?php echo esc_html( $maintenance_subtitle ); ?></p>
		</div>
	</div>
</div>
<?php
wp_footer();
