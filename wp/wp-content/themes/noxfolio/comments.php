<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Noxfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! post_type_supports( get_post_type(), 'comments' ) ) {
	return;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) :
		?>
		<h4 class="comments-title">
			<?php
			comments_number(
				esc_html__( 'Comments (0)', 'noxfolio' ),
				esc_html__( 'Comments (1)', 'noxfolio' ),
				esc_html__( 'Comments (%)', 'noxfolio' )
			);
			?>
		</h4>
		<!-- Comment List -->
		<ul class="comment-list">
		<?php
		wp_list_comments(
			array(
				'walker'      => new Noxfolio_Comment_Walker(),
				'avatar_size' => 100,
				'short_ping'  => true,
			)
		)
		?>
		</ul>
		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
			?>
			<p class="no-comments">
				<?php esc_html_e( 'Comments are closed.', 'noxfolio' ); ?>
			</p>
			<?php
		endif;
	endif;
	?>
	<?php
	comment_form(
		array(
			'title_reply_before' => wp_kses_post( '<h4 id="reply-title" class="comment-reply-title"><span>' ),
			'title_reply_after'  => wp_kses_post( '</span></h4>' ),
			'title_reply'        => esc_html__( 'Leave a Comment', 'noxfolio' ),
			'fields'             => apply_filters(
				'comment_form_default_fields',
				array(
					'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Full Name *', 'noxfolio' ) . '" required /></p>',
					'email'  => '<p class="comment-form-email"><input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Email *', 'noxfolio' ) . '" required /></p>',
					'url'    => '<p class="comment-form-url"><input id="url" name="url" type="url" placeholder="' . esc_attr__( 'Website', 'noxfolio' ) . '" /></p>',
				)
			),
			'comment_field'      => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__( 'Write Comment', 'noxfolio' ) . '" required></textarea></p>',
			'class_submit'       => 'submit-btn',
			'label_submit'       => esc_html__( 'Leave a Comment', 'noxfolio' ),
			'format'             => 'xhtml',
		)
	);
	?>
</div>
