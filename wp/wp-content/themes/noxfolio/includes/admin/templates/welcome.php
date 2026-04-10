<?php
/**
 * Template Welcome
 *
 * Welcome Template for admin panel
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

<div class="noxfolio-dashboard-pages noxfolio-welcome-page">
	<div class="noxfolio-welcome-wrapper">
		<div class="wrapper-left">
			<div class="theme-screenshot">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>">
			</div>
		</div>
		<div class="wrapper-right">
			<div class="noxfolio-welcome-title">
				<h3>
					<?php esc_html_e( 'Welcome to', 'noxfolio' ); ?>
					<?php echo esc_html( wp_get_theme()->get( 'Name' ) ); ?>

					<span class="version-theme">
						<?php esc_html_e( 'Version - ', 'noxfolio' ); ?>
						<?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?>
					</span>
					<?php if ( is_child_theme() ) : ?>
					<span class="version-theme">
						<?php esc_html_e( 'Parent Theme Version - ', 'noxfolio' ); ?>
						<?php echo esc_html( NOXFOLIO_VERSION ); ?>
					</span>
					<?php endif; ?>
				</h3>
				<p>
					<?php
					printf(
						/* translators: %s: Theme name */
						esc_html__( '%s is already installed and ready to use! Let\'s build something impressive.', 'noxfolio' ),
						esc_html( NOXFOLIO_NAME )
					);
					?>
				</p>
			</div>
			<h6 class="noxfolio-welcome-step-title">
				<?php echo esc_html__( 'Just complete the steps below:', 'noxfolio' ); ?>
			</h6>
			<ul>
				<li>
					<span class="step-title">
						<?php esc_html_e( 'Step 1', 'noxfolio' ); ?>
					</span>
					<?php
					printf(
						/* translators: server status url */
						wp_kses( __( 'Check <a href="%s">Server status</a> to avoid errors with your WordPress.', 'noxfolio' ), $allowed_html ),
						esc_url( admin_url( 'admin.php?page=noxfolio_server_status' ) )
					);
					?>
				</li>
				<li>
					<span class="step-title">
						<?php esc_html_e( 'Step 2', 'noxfolio' ); ?>
					</span>
					<?php esc_html_e( 'Install Required and recommended plugins.', 'noxfolio' ); ?>
				</li>
				<li>
					<span class="step-title">
						<?php esc_html_e( 'Step 3', 'noxfolio' ); ?>
					</span>
					<?php esc_html_e( 'Import demo content', 'noxfolio' ); ?>
				</li>
			</ul>
		</div>
	</div>
</div>
