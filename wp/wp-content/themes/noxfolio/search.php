<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;
use NoxfolioTheme\Classes\Noxfolio_Post_Helper;

get_header();
?>

<div class="<?php Helper::container(); ?>">
	<div class="content-area">
		<div class="entry-posts">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/contents/content' );
				}

				Noxfolio_Post_Helper::pagination();
			} else {
				get_template_part( 'template-parts/contents/content', 'none' );
			}
			?>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
