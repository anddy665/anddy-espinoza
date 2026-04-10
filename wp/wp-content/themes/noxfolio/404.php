<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;

get_header();

$error_title   = Helper::get_option( 'error_title', __( 'Oops!', 'noxfolio' ) );
$error_message = Helper::get_option( 'error_message', __( 'This Page Are Can\'t be Found', 'noxfolio' ) );
$button_text   = Helper::get_option( 'error_button_text', __( 'Go to Home', 'noxfolio' ) );
$error_img     = Helper::get_option( 'error_img', array( 'url' => NOXFOLIO_ASSETS . '/img/404-illustration.png' ) );

?>
<div class="container">
	<div class="error-content-area">
		<div class="error-illustration">
			<img src="<?php echo esc_url( $error_img['url'] ); ?>">
		</div>
		<div class="error-content">
			<?php if ( $error_title ) : ?>
			<h2 class="error-title"><?php echo esc_html( $error_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $error_message ) : ?>
			<p class="error-message"><?php echo esc_html( $error_message ); ?></p>
			<?php endif; ?>
			<a class="noxfolio-button icon-right" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="button-text"><?php echo esc_html( $button_text ); ?></span>
				<span class="button-icon"><i class="far fa-angle-right"></i></span>
			</a>
		</div>
	</div>
</div>
<?php
get_footer();
