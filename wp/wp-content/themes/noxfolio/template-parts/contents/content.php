<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;
use NoxfolioTheme\Classes\Noxfolio_Post_Helper;

$archive_meta  = Helper::get_option( 'archive_post_meta', 'yes' );
$show_excerpt  = Helper::get_option( 'archive_post_excerpt', 'yes' );
$excerpt_count = Helper::get_option( 'post_excerpt_count', 30 );
$show_button   = Helper::get_option( 'archive_post_button', 'yes' );
$button_text   = Helper::get_option( 'post_button_text', __( 'Read More', 'noxfolio' ) );

$post_class = array( 'entry-post', 'clearfix' );

if ( ! has_post_thumbnail() ) {
	$post_class[] = 'no-thumbnail';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<?php Noxfolio_Post_Helper::render_media(); ?>
	<div class="entry-summary">
		<?php
		if ( 'product' !== get_post_type() && 'yes' === $archive_meta ) {
				Noxfolio_Post_Helper::post_archive_meta( get_the_ID() );
		}

        the_title( '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

		if ( 'yes' === $show_excerpt ) {
			if ( has_excerpt() ) {
				echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
			} else {
				echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
			}
		}

		if ( 'yes' === $show_button && ! empty( $button_text ) ) {
			if ( 'product' === get_post_type() ) {
				echo '<a class="read-more" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'View Product', 'noxfolio' ) . '<i class="far fa-arrow-right"></i></a>';
			} else {
				echo '<a class="read-more" href="' . esc_url( get_permalink() ) . '">' . esc_html( $button_text ) . '<i class="far fa-arrow-right"></i></a>';
			}
		}
		?>
	</div>
</article>
