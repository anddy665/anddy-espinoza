<?php

namespace NoxfolioTheme\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Load Theme Admin
 */
class Admin_Panel {

	protected static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function initialize() {
		add_action( 'admin_menu', [ $this, 'theme_dashboard_menu' ] );
		add_action( 'admin_init', [ $this, 'redirect_theme_dashboard' ] );
	}

	/**
	 * Add Dashboard Menu
	 *
	 * @return void
	 */
	public function theme_dashboard_menu() {
		add_menu_page(
			NOXFOLIO_NAME,
			NOXFOLIO_NAME,
			'manage_options',
			'noxfolio_dashboard',
			[ $this, 'render_welcome_template' ],
			NOXFOLIO_ASSETS . '/img/webtend-logo.png',
			2
		);

		$submenu = [];

		$submenu[] = [
			esc_html__( 'Welcome', 'noxfolio' ),
			esc_html__( 'Welcome', 'noxfolio' ),
			'manage_options',
			'noxfolio_dashboard',
			[ $this, 'render_welcome_template' ],
		];

		$submenu[] = [
			esc_html__( 'Server Status', 'noxfolio' ),
			esc_html__( 'Server Status', 'noxfolio' ),
			'edit_posts',
			'noxfolio_server_status',
			[ $this, 'render_server_status' ],
		];

		$submenu[] = [
			esc_html__( 'Help Center', 'noxfolio' ),
			esc_html__( 'Help Center', 'noxfolio' ),
			'edit_posts',
			'noxfolio_help_center',
			[ $this, 'render_help_center' ],
		];

		$submenu = apply_filters( 'noxfolio_dashboard_submenu', [ $submenu ] );

		foreach ( $submenu[ 0 ] as $key => $value ) {
			add_submenu_page(
				'noxfolio_dashboard',
				$value[ 0 ],
				$value[ 1 ],
				$value[ 2 ],
				$value[ 3 ],
				$value[ 4 ]
			);
		}
	}

	/**
	 * Render Heading
	 *
	 * @return void
	 */
	public static function render_heading() {
		global $submenu;

		$menu_items = '';

		if ( isset( $submenu[ 'noxfolio_dashboard' ] ) ) {
			$menu_items = $submenu[ 'noxfolio_dashboard' ];
		}

		if ( ! empty( $menu_items ) ): ?>
            <div class="wrap noxfolio-dashboard-header">
                <div class="noxfolio-dashboard-banner" style="background-image: url( <?php echo NOXFOLIO_ASSETS . '/img/dashboard-banner.jpg' ?> );">
                    <h3><?php echo esc_html__( 'Thanks For Purchasing', 'noxfolio' ) . ' ' . NOXFOLIO_NAME ?></h3>
                    <p>
						<?php echo sprintf(
							wp_kses( __( 'A theme is developed by <a href="%s" target="_blank">WebTend</a>', 'noxfolio' ), [ 'a' => [ 'href' => true, 'target' => true ] ] ),
							esc_url( 'https://themeforest.net/user/webtend' )
						); ?>
                    </p>
                </div>
                <div class="dashboard-nav-wrapper">
					<?php foreach ( $menu_items as $item ):
						$class = isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == $item[ 2 ] ? 'nav-tab-active' : ''; ?>
                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . $item[ 2 ] . '' ) ); ?>" class="nav-tab <?php echo esc_attr( $class ); ?>">
							<?php echo esc_html( $item[ 0 ] ); ?>
                        </a>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif;
	}

	/**
	 * Render Welcome Template
	 *
	 * @return void
	 */
	public function render_welcome_template() {
		self::render_heading();

		require_once NOXFOLIO_ADMIN . '/templates/welcome.php';
	}

	/**
	 * Render Theme Requirements
	 *
	 * @return void
	 */
	public function render_server_status() {
		self::render_heading();

		require_once NOXFOLIO_ADMIN . '/templates/server-status.php';
	}

	/**
	 * Render Help Template
	 *
	 * @return void
	 */
	public function render_help_center() {
		$this->render_heading();

		require_once NOXFOLIO_ADMIN . '/templates/help-center.php';
	}

	/**
	 * Redirect To Theme Dashboard
	 *
	 * @return void
	 */
	public function redirect_theme_dashboard() {
		global $pagenow;

		if ( is_admin() && isset( $_GET[ 'activated' ] ) && 'themes.php' === $pagenow ) {
			wp_safe_redirect( esc_url( admin_url( 'admin.php?page=noxfolio_dashboard' ) ) );

			exit;
		}
	}

	/**
	 * Let to Number
	 *
	 * @return void
	 */
	public function let_to_num( $v ) {
		$l   = substr( $v, - 1 );
		$ret = substr( $v, 0, - 1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			case 'T':
				$ret *= 1024;
			case 'G':
				$ret *= 1024;
			case 'M':
				$ret *= 1024;
			case 'K':
				$ret *= 1024;
				break;
		}

		return $ret;
	}

	/**
	 * Memory Limit
	 *
	 * @return void
	 */
	public function memory_limit() {
		$limit = $this->let_to_num( WP_MEMORY_LIMIT );
		if ( function_exists( 'memory_get_usage' ) ) {
			$limit = max( $limit, $this->let_to_num( @ini_get( 'memory_limit' ) ) );
		}

		return $limit;
	}
}

Admin_Panel::instance()->initialize();
