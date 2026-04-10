<?php
namespace NoxfolioToolkit\ElementorAddon\Templates;

use NoxfolioTheme\Classes\Noxfolio_Post_Helper;
use Elementor\Icons_Manager;
use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Portfolio Template
 */
class Posts_Template {

    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
		$wrapper = 'noxfolio-post-boxes';

        if( 'carousel' == $settings['layout'] ) {
            $wrapper = 'noxfolio-post-boxes noxfolio-carousel-wrapper';
        }
        ?>
        <div class="<?php echo esc_attr( $wrapper ); ?>">
            <?php if( 'grid' == $settings['layout'] ) : ?>
                <?php $this->render_loop( $settings );?>
            <?php elseif( 'carousel' == $settings['layout'] ) : ?>
                <div class="noxfolio-carousel-active">
                    <?php $this->render_loop( $settings );?>
                </div>
				<?php $this->carousel_navigation( $settings ); ?>
            <?php endif; ?>
        </div>
        <?php
    }

	/**
	 * Render Loop
	 *
	 * @param array $settings
	 * @return void
	 */
	public function render_loop( $settings ) {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
            'paged'               => $paged
        ];

        if ( 'categories' == $settings['post_from'] && $settings['cat_slugs'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slugs'],
                ],
            ];
        }

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new WP_Query( $args );

        while ( $wp_query->have_posts() ): $wp_query->the_post();
            if ( 'grid' == $settings['layout'] ) :
                $this->render_post_item( $settings );
            elseif( 'carousel' == $settings['layout'] ) : ?>
                <div class="noxfolio-carousel-item">
                    <?php $this->render_post_item( $settings ); ?>
                </div>
            <?php endif;
        endwhile;
        wp_reset_postdata();

        if ( 'yes' === $settings['show_pagination'] ) {
			Noxfolio_Post_Helper::pagination( $wp_query );
        }
    }

	/**
	 * Render Post Item
	 *
	 * @param array $settings
	 * @return void
	 */
	public function render_post_item( $settings ) {
        $idd = get_the_ID();

        if ( $settings['title_word'] ) {
            $the_title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
        } else {
            $the_title = get_the_title();
        }

        $excerpt_count = $settings['excerpt_count'];

		$post_class = 'noxfolio-post-box' .' '. $settings['thumb_position'] .' '. $settings['meta_position'];
        ?>
        <div class="<?php echo esc_attr( $post_class ) ?>">
            <?php if ( has_post_thumbnail() && 'yes' === $settings['show_thumbnail'] ): ?>
            <div class="post-thumbnail">
                <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ); ?>
            </div>
            <?php endif;?>
            <div class="post-content">
                <<?php echo nt_escape_tags( $settings['title_tag'], 'h4' ); ?> class="post-title">
                    <a href="<?php echo get_the_permalink() ?>">
                        <?php echo $the_title; ?>
                    </a>
                </<?php echo nt_escape_tags( $settings['title_tag'], 'h4' ); ?>>
				<?php
					if ( 'yes' === $settings['show_divider'] ) {
						echo '<span class="divider"></span>';
					}

					$this->render_meta( $settings['show_meta'], $settings['active_meta'] );

					if ( 'yes' === $settings['show_excerpt'] ) {
						if ( has_excerpt() ) {
							echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
						} else {
							echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
						}
					}
				?>
				<?php if ( 'yes' === $settings['show_read_more'] && ! empty( $settings['read_more_text'] ) ) : ?>
				<a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more">
					<?php echo esc_html( $settings['read_more_text'] ) ?>
					<span class="read-more-icon">
						<?php Icons_Manager::render_icon( $settings['read_more_icon'], ['aria-hidden' => 'true'] ); ?>
					</span>
				</a>
				<?php endif; ?>
            </div>
        </div>
        <?php
    }

	/**
	 * Render Post Meta
	 *
	 * @return void
	 */
	private function render_meta( $show_meta, $active_meta ) {
		if ( 'yes' !== $show_meta ) {
			return;
		}
		if ( ! in_array( 'date', $active_meta ) && ! in_array( 'comments', $active_meta ) ) {
            return;
        }
        ?>
        <div class="post-meta">
			<?php if ( in_array( 'date', $active_meta ) ): ?>
            <a class="post-date" href="<?php echo esc_url( get_the_permalink() ) ?>">
                <i class="far fa-calendar-alt"></i>
                <?php echo esc_html( get_the_date() ) ?>
            </a>
			<?php endif; ?>
            <?php if ( in_array( 'comments', $active_meta ) && ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) ): ?>
            <a class="post-comments" href="<?php echo esc_url( esc_url( get_comments_link() ) ) ?>">
                <i class="far fa-comments"></i>
                <span><?php echo esc_html__( 'Comments ', 'noxfolio-toolkit' ) ?> </span>
                <?php echo '(' . esc_html( get_comments_number() ) . ')'  ?>
            </a>
            <?php endif;?>
        </div>
        <?php
	}

	/**
	 * Carousel Navigation
	 *
	 * @param array $settings
	 * @return void
	 */
	public function carousel_navigation( $settings ) {
    }
}