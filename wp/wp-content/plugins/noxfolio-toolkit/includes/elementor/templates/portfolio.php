<?php
namespace NoxfolioToolkit\ElementorAddon\Templates;

use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Portfolio Template
 */
class Portfolio_Template {

    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        ?>
        <div class="noxfolio-portfolio-items <?php echo esc_attr( $settings['portfolio_design'] ) ?>">
			<?php
				$args = [
					'post_type'           => 'noxfolio_portfolio',
					'post_status'         => 'publish',
					'posts_per_page'      => $settings['post_limit'],
					'orderby'             => $settings['order_by'],
					'order'               => $settings['sort_order'],
					'ignore_sticky_posts' => 1,
				];

				if ( 'categories' == $settings['post_from'] && $settings['cat_slugs'] ) {
					$args['tax_query'] = [
						[
							'taxonomy' => 'noxfolio_portfolio_category',
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
					$this->render_portfolio_item( $settings );
				endwhile;
				wp_reset_postdata();
			?>
		</div>
        <?php
	}

    /**
     * Render Render portfolio Item
     *
     * @param array $settings
     * @return void
     */
    public function render_portfolio_item( $settings ) {
	    $default = [
		    'portfolio_design'  => 'design-one',
		    'title_word'        => 10,
		    'title_tag'         => 'h3',
		    'show_category'     => 'yes',
		    'show_excerpt'      => 'yes',
		    'show_arrow_link'   => 'yes',
		    'excerpt_word'      => 12,
		    'thumbnail_size'    => 'large',
		    'use_thumbnail_url' => 'no',
	    ];

        $options         = wp_parse_args( $settings, $default );
        $categories_list = get_the_term_list( get_the_ID(), 'noxfolio_portfolio_category', '<div class="categories">', '<span>,</span>', '</div>' );
        $idd             = get_the_ID();

        ?>
        <div class="portfolio-item">
            <div href="" class="thumbnail">
                <?php
                    echo get_the_post_thumbnail( $idd, $options[ 'thumbnail_size' ] );

                    if ( 'design-one' === $options[ 'portfolio_design' ] && 'yes' === $options[ 'show_arrow_link' ] ) {
                        $this->get_arrow_link( $idd );
                    }

                    if ( 'yes' === $options[ 'use_thumbnail_url' ] ) {
                        echo '<a class="thumbnail-url" href="' . esc_url( get_the_permalink( $idd ) ) . '"></a>';
                    }
                ?>
            </div>
            <div class="content">
				<?php
					if ( 'design-three' === $options['portfolio_design'] && 'yes' === $options['show_arrow_link'] ) {
						$this->get_arrow_link( $idd );
					}

					if ( ! is_wp_error( $categories_list ) && $categories_list && 'yes' === $options['show_category'] ) {
						echo $categories_list;
					}

					printf( '<%1$s class="title"><a href="%2$s">%3$s</a></%1$s>',
						nt_escape_tags( $options['title_tag'], 'h3' ),
						esc_url( get_the_permalink() ),
						wp_trim_words( get_the_title(), $options['title_word'], '...' )
					);

					if ( 'design-four' === $options['portfolio_design'] ) {
						if ( 'yes' === $options['show_excerpt'] ) {
							if ( has_excerpt() ) {
								$excerpt =  wp_trim_words( get_the_excerpt(), $options['excerpt_word'], '...' );
							} else {
								$excerpt = wp_trim_words( get_the_content(), $options['excerpt_word'], '...' );
							}

							printf( '<p class="excerpt">%1$s</p>',
								nt_kses_basic( $excerpt )
							);
						}

						if ( 'yes' === $options['show_arrow_link'] ) {
							$this->get_arrow_link( $idd );
						}
					}
				?>
			</div>
        </div>
        <?php
	}

    /**
     * Get Arrow Link
     *
     * @param int $id
     * @return void
     */
    private function get_arrow_link( $id ) {
        printf( '<a href="%1$s" class="arrow-link"><i class="far fa-arrow-right"></i></a>',
            esc_url( get_the_permalink( $id ) )
        );
    }
}