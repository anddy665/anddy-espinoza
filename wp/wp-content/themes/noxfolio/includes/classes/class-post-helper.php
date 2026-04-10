<?php

namespace NoxfolioTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Post Helper Function
 */
class Noxfolio_Post_Helper {

	/**
	 * Get Post Media
	 *
	 * @param  int|string  $idd
	 * @param  string  $class
	 *
	 * @return void
	 */
	public static function render_media( $idd = '', $class = '' ) {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		if ( empty( $idd ) ) {
			$idd = get_the_ID();
		}

		$wrapper_class = [ 'entry-media' ];

		if ( ! empty( $class ) ) {
			$wrapper_class[] = $class;
		};

		if ( 'no-sidebar' === Noxfolio_Helper::content_sidebar() ) {
			$size = 'noxfolio_1290x620';
		} else {
			$size = 'noxfolio_850x520';
		}

		?>
        <div class="<?php echo esc_attr( implode( ' ', $wrapper_class ) ) ?>">
			<?php the_post_thumbnail( $size, [ 'alt' => wp_kses_post( get_the_title() ) ] ); ?>
        </div>
		<?php
	}

	/**
	 * Get Post Meta
	 *
	 * @return void
	 */
	public static function post_archive_meta( $idd = '' ) {
		if ( empty( $idd ) ) {
			$idd = get_the_ID();
		}
		$author_id = get_post_field( 'post_author', $idd );
		?>
        <div class="entry-post-meta">
            <span class="author">
                <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>">
                    <i class="fal fa-user"></i>
                    <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
                </a>
            </span>
            <span class="date">
                <i class="fal fa-calendar-alt"></i>
                <?php echo esc_html( get_the_date() ) ?>
            </span>
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                <span class="comments">
                <a href="<?php echo esc_url( esc_url( get_comments_link() ) ) ?>">
                    <i class="fal fa-comments"></i>
                    <span><?php echo esc_html__( 'Comments ', 'noxfolio' ) ?></span>
                    <?php echo '(' . esc_html( get_comments_number() ) . ')' ?>
                </a>
            </span>
			<?php endif; ?>
        </div>
		<?php
	}

	/**
	 * Post content top
	 *
	 * @return void
	 */
	public static function post_content_top() {
		if ( 'post' != get_post_type() ) {
			return;
		}

		$author_id = get_post_field( 'post_author', get_the_ID() );
		?>
        <div class="entry-content-top">
			<?php echo get_the_category_list() ?>
            <div class="post-date-author">
                <div class="author-img">
					<?php echo wp_kses_post( get_avatar( $author_id, 55 ) ); ?>
                </div>
                <div class="post-by">
                    <span><?php esc_html_e( 'Post By', 'noxfolio' ) ?></span>
                    <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>" class="text-big">
						<?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
                    </a>
                </div>
                <div class="post-date">
                    <span><?php esc_html_e( 'Published', 'noxfolio' ) ?></span>
                    <span class="text-big">
						<?php echo esc_html( get_the_date() ) ?>
					</span>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Post Navigation
	 *
	 * @return void
	 */
	public static function post_navigation() {
		if ( 'post' !== get_post_type() ) {
			return;
		}

		$prev = get_previous_post();
		$next = get_next_post();

		if ( empty( $prev ) && empty( $next ) ) {
			return;
		}

		?>
        <div class="entry-post-navigation">
			<?php foreach ( [ $prev, $next ] as $post ) :
				if ( ! empty( $post ) ) : ?>
                    <div class="<?php echo esc_attr( $post === $prev ? 'prev-post' : 'next-post' ); ?>">
						<?php if ( has_post_thumbnail( $post->ID ) ) : ?>
                            <div class="post-thumbnail">
								<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ) ?>
                            </div>
						<?php endif; ?>
                        <div class="post-content">
                            <span class="post-date">
                                <i class="fal fa-calendar-alt"></i>
                                <?php echo esc_html( get_the_date() ) ?>
                            </span>
                            <h6 class="post-title">
                                <a href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>">
									<?php
									if ( get_the_title( $post->ID ) ) {
										$display_title = wp_trim_words( get_the_title( $post->ID ), '8', '...' );
									} else {
										if ( $post === $prev ) {
											$display_title = esc_html__( 'Previous Post', 'eigency' );
										} else {
											$display_title = esc_html__( 'Next Post', 'eigency' );
										}
									}
									echo wp_kses_post( $display_title );
									?>
                                </a>
                            </h6>
                        </div>
                    </div>
				<?php endif;
			endforeach; ?>
        </div>
		<?php
	}

	/**
	 * Post Author Info
	 *
	 * @return void
	 */
	public static function post_author_info() {
		global $post;
		$user_id = get_the_author_meta( 'ID' );

		// Get author's display name - NB! changed display_name to first_name. Error in code.
		$display_name = get_the_author_meta( 'display_name', $post->post_author );

		// If display name is not available then use nickname as display name
		if ( empty( $display_name ) ) {
			$display_name = get_the_author_meta( 'nickname', $post->post_author );
		}

		$user_description = get_the_author_meta( 'user_description', $post->post_author );
		$user_posts       = get_author_posts_url( $user_id );
		$user_avatar      = get_avatar( $user_id, 160 );

		$user_meta = get_user_meta( $user_id, 'noxfolio_user_meta', true );

		?>
        <div class="entry-author-info">
            <div class="author-avatar">
				<?php echo wp_kses_post( $user_avatar ); ?>
            </div>
            <div class="author-desc">
                <h4 class="name">
                    <a href="<?php echo esc_url( $user_posts ) ?>"> <?php echo esc_html( $display_name ) ?> </a>
                </h4>
				<?php
				echo wpautop( $user_description );

				if ( ! empty( $user_meta[ 'user_social_links' ] ) ) : ?>
                    <ul class="user-links">
						<?php foreach ( $user_meta[ 'user_social_links' ] as $item ) : ?>
                            <li>
                                <a href="<?php echo esc_url( $item[ 'social_link' ] ) ?>">
                                    <i class="<?php echo esc_attr( $item[ 'social_icon' ] ) ?>"></i>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php endif;
				?>
            </div>
        </div>
		<?php
	}

	/**
	 * Pagination
	 *
	 * @param $query
	 *
	 * @return void
	 */
	public static function pagination( $query = false ) {
		if ( $query ) {
			$wp_query = $query;
		} else {
			global $paged, $wp_query;
		}

		if ( empty( $paged ) ) {
			$query_vars = $wp_query->query_vars;
			$paged      = $query_vars[ 'paged' ] ?? 1;
		}

		$max_page = $wp_query->max_num_pages;

		// Exit if pagination not need
		if ( ! ( $max_page > 1 ) ) {
			return;
		}

		//return $output;
		$big = 999999999;

		$page_items = paginate_links( [
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'type'      => 'array',
			'current'   => max( 1, $paged ),
			'end_size'  => 1,
			'mid_size'  => 1,
			'total'     => $max_page,
			'prev_text' => is_rtl() ? '<i class="far fa-angle-right"></i>' : '<i class="far fa-angle-left"></i>',
			'next_text' => is_rtl() ? '<i class="far fa-angle-left"></i>' : '<i class="far fa-angle-right"></i>',
		] );
		?>
        <ul class="noxfolio-pagination">
			<?php foreach ( $page_items as $key => $value ) : ?>
                <li class="page"><?php echo wp_kses_post( $value ) ?></li>
			<?php endforeach; ?>
        </ul>
		<?php
	}
}
