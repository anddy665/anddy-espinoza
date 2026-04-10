<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Noxfolio
 */

use NoxfolioTheme\Classes\Noxfolio_Helper as Helper;
use NoxfolioTheme\Classes\Noxfolio_Post_Helper;

$show_post_share = Helper::get_option( 'blog_details_share', 'no' );
$show_tag        = Helper::get_option( 'blog_details_tag', 'yes' );
$show_nav        = Helper::get_option( 'blog_details_nav', 'yes' );
$author_info     = Helper::get_option( 'blog_author_info', 'no' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-post-details clearfix' ); ?>>
	<?php Noxfolio_Post_Helper::post_content_top(); ?>
	<?php Noxfolio_Post_Helper::render_media(); ?>
	<div class="entry-content clearfix">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'noxfolio' ) . '</span>',
				'after'  => '</div>',
			)
		);
		?>
	</div>
	<?php if ( ( 'yes' === $show_tag && has_tag() ) || 'yes' === $show_post_share ) : ?>
	<div class="entry-tags-share">
		<?php
		if ( 'yes' === $show_tag && has_tag() ) {
			the_tags( '<div class="post-tags-wrap"><span>' . esc_html__( 'Tags', 'noxfolio' ) . '</span>', '', '</div>' );
		}
		?>
		<?php if ( function_exists( 'nt_post_share_links' ) && 'yes' === $show_post_share ) : ?>
		<div class="post-share-wrap">
			<span><?php echo esc_html__( 'Share', 'noxfolio' ); ?></span>
			<?php nt_post_share_links(); ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php
	if ( 'yes' === $author_info ) {
		Noxfolio_Post_Helper::post_author_info();
	}

	if ( 'yes' === $show_nav ) {
		Noxfolio_Post_Helper::post_navigation();
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
</article>
