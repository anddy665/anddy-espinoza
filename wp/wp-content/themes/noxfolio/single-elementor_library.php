<?php
/**
 * The template for displaying all single Elementor Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Noxfolio
 */

get_header();
?>

<div class="elementor-template">
	<div class="elementor-template-inner">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				the_content();
			}
		} else {
			get_template_part( 'template-parts/contents/content', 'none' );
		}
		?>
	</div>
</div>

<?php
get_footer();
