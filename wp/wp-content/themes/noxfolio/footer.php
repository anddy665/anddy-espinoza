<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;

$back_top_class = 'back-to-top';

if ( Helper::get_option( 'back_to_top_mobile', true ) ) {
	$back_top_class = 'back-to-top show-on-mobile';
}

?>
	</main>
	<?php if ( 'enabled' === Helper::site_back_to_top() ) : ?>
	<a href="#" id="backToTop" class="<?php echo esc_attr( $back_top_class ); ?>">
		<i class="far fa-angle-double-up"></i>
	</a>
	<?php endif; ?>
	<?php
	if ( class_exists( 'Noxfolio_Toolkit' ) ) {
		do_action( 'noxfolio_builder_after_main' );
	}

	if ( 'enabled' === Helper::check_default_footer() && ! is_404() ) {
		get_template_part( 'template-parts/footer/footer', 'default' );
	}

	if ( 'enabled' === Helper::site_grid_line() ) :
        ?>
        <div class="noxfolio-grid-lines">
            <?php
                for ( $i = 0; $i < 9; $i ++ ) {
                    echo '<span></span>';
                }
            ?>
        </div>
        <?php
    endif;
	?>
</div>

<?php wp_footer(); ?>

</body>
</html>
