<?php

namespace NoxfolioTheme\Classes;

defined('ABSPATH') || exit;

/**
 * Load Theme Assets
 */
class Noxfolio_Assets
{

	protected static $instance = null;

	public static function instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function initialize()
	{
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles'], 99);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 99);
		add_action('wp_enqueue_scripts', [$this, 'global_root_css'], 99);

		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

		add_action('wp_head', [$this, 'custom_header_scripts']);
		add_action('wp_footer', [$this, 'custom_footer_scripts']);
	}

	/**
	 * Load Google Font
	 *
	 * @return string
	 */
	public function google_font_url()
	{
		$fonts_url     = '';
		$font_families = [];
		$subsets       = 'latin';

		$primary_font   = Noxfolio_Helper::get_option('primary_font', ['font-family' => '']);
		$secondary_font = Noxfolio_Helper::get_option('secondary_font', ['font-family' => '']);

		if ('' == $primary_font || is_array($primary_font) && ! $primary_font['font-family']) {
			if ('off' !== _x('on', 'Inter', 'noxfolio')) {
				$font_families[] = 'Inter:300i,400i,300,400,500,600,700';
			}
		}

		if ('' == $secondary_font || is_array($secondary_font) && ! $secondary_font['font-family']) {
			if ('off' !== _x('on', 'DM Sans', 'noxfolio')) {
				$font_families[] = 'DM Sans:300i,400i,300,400,500,600,700';
			}
		}

		if ($font_families) {
			$fonts_url = add_query_arg([
				'family' => urlencode(implode('|', $font_families)),
				'subset' => urlencode($subsets),
			], 'https://fonts.googleapis.com/css');
		}

		return esc_url_raw($fonts_url);
	}

	/**
	 * Admin Google Font
	 */
	public function admin_google_font_url()
	{
		$fonts_url     = '';
		$font_families = [];
		$subsets       = 'latin';

		if ('off' !== _x('on', 'Inter', 'noxfolio')) {
			$font_families[] = 'Inter:300,400,500,600';
		}

		$fonts_url = add_query_arg([
			'family' => urlencode(implode('|', $font_families)),
			'subset' => urlencode($subsets),
		], 'https://fonts.googleapis.com/css');

		return esc_url_raw($fonts_url);
	}

	/**
	 * Register Scripts
	 */
	public function register_scripts()
	{
		wp_register_style('magnific-popup', NOXFOLIO_VENDOR . '/magnific-popup/style.min.css', [], '1.1.0');
		wp_register_script('magnific-popup', NOXFOLIO_VENDOR . '/magnific-popup/scripts.min.js', ['jquery'], '1.1.0', true);

		wp_register_style('slick', NOXFOLIO_VENDOR . '/slick/slick.min.css', [], '1.8.1');
		wp_register_script('slick', NOXFOLIO_VENDOR . '/slick/slick.min.js', ['jquery'], '1.8.1', true);
	}

	/**
	 * Enqueue Theme Style
	 *
	 * @return void
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style('noxfolio-fonts', $this->google_font_url(), [], null);
		wp_enqueue_style('fontawesome', NOXFOLIO_VENDOR . '/fontawesome/all.min.css', [], '5.14');
		wp_enqueue_style('noxfolio-theme', NOXFOLIO_ASSETS . '/css/theme.min.css', [], NOXFOLIO_VERSION);
		wp_enqueue_style('noxfolio-style', get_stylesheet_uri(), [], NOXFOLIO_VERSION);

		if (is_rtl()) {
			wp_enqueue_style('noxfolio-rtl-style', NOXFOLIO_ASSETS . '/css/theme-rtl.min.css', [], NOXFOLIO_VERSION);
		}
	}

	/**
	 * Inline CSS
	 *
	 * @return void
	 */
	public function global_root_css()
	{
		$primary_font    = Noxfolio_Helper::get_option('primary_font', ['font-family' => '']);
		$secondary_font  = Noxfolio_Helper::get_option('secondary_font', ['font-family' => '']);
		$container_width = Noxfolio_Helper::get_option('container_width', []);
		$boxed_width     = Noxfolio_Helper::get_option('boxed_width', []);
		//page fonts
		$page_fonts    = Noxfolio_Helper::get_page_fonts();

		$inline_css = [];

		if (! empty($container_width)) {
			$inline_css[] = '--noxfolio-container-width: ' . $container_width['width'] . 'px';
		} else {
			$inline_css[] = '--noxfolio-container-width: 1320px';
		}

		if (! empty($boxed_width)) {
			$inline_css[] = '--noxfolio-boxed-width: ' . $boxed_width['width'] . 'px';
		} else {
			$inline_css[] = '--noxfolio-boxed-width: 1530px';
		}

		if (is_array($primary_font) && $primary_font['font-family']) {
			$inline_css[] = '--noxfolio-primary-font: ' . $primary_font['font-family'];
		} else {
			$inline_css[] = '--noxfolio-primary-font: Inter';
		}

		if (is_array($primary_font) && $secondary_font['font-family']) {
			$inline_css[] = '--noxfolio-secondary-font: ' . $secondary_font['font-family'];
		} else {
			$inline_css[] = '--noxfolio-secondary-font: DM Sans';
		}

		$colors = Noxfolio_Helper::get_global_colors();

		foreach ($colors as $key => $color) {
			$inline_css[] = '--' . $color['slug'] . ':' . $color['value'];
		}

		if (did_action('elementor/loaded')) {
			foreach ($colors as $key => $color) {
				$inline_css[] = '--e-global-color-' . $key . ':' . $color['value'];
			}
		}

		if (is_page()) {
			foreach ($page_fonts as $font) {
				$inline_css[] = '--' . $font['slug'] . ':' . $font['font-family'] . ', ' . $font['backup-font-family'];
			}
		}

		$output = '
        :root {
            ' . esc_attr(implode('; ', $inline_css)) . '
        }
        ';

		wp_add_inline_style('noxfolio-theme', $output);
	}

	/**
	 * Enqueue Theme Scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script('noxfolio-theme', NOXFOLIO_ASSETS . '/js/theme.min.js', ['jquery'], NOXFOLIO_VERSION, true);

		wp_localize_script(
			'noxfolio-theme',
			'noxfolioLocalize',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
				'is_rtl'   => is_rtl(),
			]
		);

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}

	/**
	 * Admin CSS
	 */
	public function enqueue_admin_scripts()
	{
		wp_enqueue_style('noxfolio-admin-fonts', $this->admin_google_font_url(), [], null);
		wp_enqueue_style('noxfolio-admin', NOXFOLIO_ASSETS . '/css/admin.min.css', [], NOXFOLIO_VERSION, 'all');
		wp_enqueue_script('noxfolio-admin', NOXFOLIO_ASSETS . '/js/admin.min.js', ['jquery'], NOXFOLIO_VERSION, true);

		wp_localize_script(
			'noxfolio-admin',
			'noxfolioAdminLocalize',
			[
				'ajax_url' => admin_url('admin-ajax.php'),
			]
		);
	}

	/**
	 * Custom Header Scripts
	 */
	public function custom_header_scripts()
	{
		if ('' !== Noxfolio_Helper::get_option('custom_header_scripts')): ?>
			<script>
				<?php echo Noxfolio_Helper::get_option('custom_header_scripts'); ?>
			</script>
		<?php endif;
	}

	/**
	 * Custom Scripts
	 */
	public function custom_footer_scripts()
	{
		if ('' !== Noxfolio_Helper::get_option('custom_footer_scripts')): ?>
			<script>
				<?php echo Noxfolio_Helper::get_option('custom_footer_scripts'); ?>
			</script>
<?php endif;
	}
}

Noxfolio_Assets::instance()->initialize();
