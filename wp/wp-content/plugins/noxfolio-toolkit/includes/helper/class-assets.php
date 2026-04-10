<?php

namespace NoxfolioToolkit\Helper;

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

	public function __construct()
	{
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
	}


	public function register_scripts()
	{
		wp_register_style('animate', NT_VENDOR . '/animate/animate.css', [], '1.1.0');
		wp_register_style('bootstrap', NT_VENDOR . '/bootstrap/bootstrap.min.css', [], '1.1.0');
		wp_register_script('bootstrap', NT_VENDOR . '/bootstrap/bootstrap.min.js', ['jquery'], '1.1.0', true);

		wp_register_style('swiper', NT_VENDOR . '/swiper/swiper-bundle.css', [], '1.1.0');
		wp_register_script('swiper', NT_VENDOR . '/swiper/swiper-bundle.js', ['jquery'], '1.1.0', true);

		wp_register_style('fontawesome-six', NT_VENDOR . '/fontawesome/font-awesome-pro.css', [], '6.0.0');

		// wp_register_style('nice-select', NT_VENDOR . '/nice-select/nice-select.min.css', [], '1.1.0');
		// wp_register_script('nice-select', NT_VENDOR . '/nice-select/nice-select.js', ['jquery'], '1.1.0', true);

		wp_register_style('magnific-popup', NT_VENDOR . '/magnific-popup/magnific-popup.css', [], '1.1.0');
		wp_register_script('magnific-popup', NT_VENDOR . '/magnific-popup/magnific-popup.js', ['jquery'], '1.1.0', true);

		wp_register_style('slick', NT_VENDOR . '/slick/slick.css', [], '1.8.1');
		wp_register_script('slick', NT_VENDOR . '/slick/slick.js', ['jquery'], '1.8.1', true);

		wp_register_style('noxfolio-flat-icons', NT_VENDOR . '/flaticon/flaticon_noxfolio.css', [], '1.8.1');

		// wp_register_script('gsap', NT_VENDOR . '/gsap/gsap.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-scroll-to-plugin', NT_VENDOR . '/gsap/gsap-scroll-to-plugin.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-scroll-smoother', NT_VENDOR . '/gsap/gsap-scroll-smoother.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-scroll-trigger', NT_VENDOR . '/gsap/gsap-scroll-trigger.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-split-text', NT_VENDOR . '/gsap/gsap-split-text.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-chroma', NT_VENDOR . '/gsap/chroma.min.js', ['jquery'], '3.11.4', true);
		// wp_register_script('gsap-scroll-magic', NT_VENDOR . '/gsap/scroll-magic.js', ['jquery'], '3.11.4', true);

		// wp_register_script('countdown', NT_VENDOR . '/countdown.js', ['jquery'], '3.11.4', true);
		// wp_register_script('text-slide', NT_VENDOR . '/text-slide.js', ['jquery'], '3.11.4', true);
		// wp_register_script('range-slider', NT_VENDOR . '/range-slider.js', ['jquery'], '3.11.4', true);
		wp_register_script('purecounter', NT_VENDOR . '/purecounter.js', ['jquery'], '3.11.4', true);
		// wp_register_script('wow', NT_VENDOR . '/wow.js', ['jquery'], '3.11.4', true);
		// wp_register_script('vanilla-tilt', NT_VENDOR . '/vanilla-tilt.min.js', ['jquery'], '3.11.4', true);
		wp_register_script('isotope-pkgd', NT_VENDOR . '/isotope-pkgd.js', ['jquery'], '3.11.4', true);
		wp_register_script('imagesloaded-pkgd', NT_VENDOR . '/imagesloaded-pkgd.js', ['jquery'], '3.11.4', true);
		// wp_register_script('wt-cursor', NT_VENDOR . '/wt-cursor.js', ['jquery'], '3.11.4', true);
		wp_register_script('slider-active', NT_VENDOR . '/slider-active.js', ['jquery'], '3.11.4', true);
	}

	public function enqueue_styles()
	{
		//wp_enqueue_style('nice-select');
		wp_enqueue_style('animate');
		wp_enqueue_style('swiper');
		wp_enqueue_style('bootstrap');
		wp_enqueue_style('fontawesome-six');
		wp_enqueue_style('magnific-popup');
		wp_enqueue_style('slick');
		wp_enqueue_style('noxfolio-flat-icons');
	}


	/**
	 * Enqueue Theme Scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('swiper');
		// wp_enqueue_script('nice-select');
		wp_enqueue_script('magnific-popup');
		wp_enqueue_script('slick');
		// wp_enqueue_script('gsap');
		// wp_enqueue_script('gsap-scroll-to-plugin');
		// wp_enqueue_script('gsap-scroll-smoother');
		// wp_enqueue_script('gsap-scroll-trigger');
		// wp_enqueue_script('gsap-split-text');
		// wp_enqueue_script('gsap-chroma');
		// wp_enqueue_script('gsap-scroll-magic');
		// wp_enqueue_script('countdown');
		// wp_enqueue_script('text-slide');
		// wp_enqueue_script('range-slider');
		wp_enqueue_script('purecounter');
		// wp_enqueue_script('wow');
		// wp_enqueue_script('vanilla-tilt');
		wp_enqueue_script('isotope-pkgd');
		wp_enqueue_script('imagesloaded-pkgd');
		// wp_enqueue_script('wt-cursor');
		wp_enqueue_script('slider-active');
		wp_enqueue_script('noxfolio-addon', NT_ASSETS . '/js/noxfolio-addon.js', ['jquery'], NOXFOLIO_VERSION, true);

		// wp_localize_script(
		// 	'omio-addon',
		// 	'OmioObject',
		// 	[
		// 		'ajax_url' => admin_url('admin-ajax.php'),
		// 		'error_text' => esc_html__('An error occurred. Please try again.', 'omio-toolkit'),
		// 	]
		// );
	}
}

Noxfolio_Assets::instance();
