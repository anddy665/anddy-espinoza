<?php

if (  ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

if ( class_exists( 'CSF' ) ) {
    CSF::createWidget( 'noxfolio_wp_cta_widget', [
        'title'       => esc_html__( '*Noxfolio CTA', 'noxfolio-toolkit' ),
        'classname'   => 'noxfolio-wp-cta',
        'description' => esc_html__( 'Call to Action', 'noxfolio-toolkit' ),
        'fields'      => [
			[
				'id'      => 'subtitle',
				'type'    => 'text',
				'title'   => esc_html( 'Subtitle', 'noxfolio-toolkit' ),
				'default' => esc_html__( 'Get A Quote.', 'noxfolio-toolkit' ),
			],
            [
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html( 'Title', 'noxfolio-toolkit' ),
                'default' => esc_html__( 'Looking For Creative Web Designer.', 'noxfolio-toolkit' ),
            ],
            [
                'id'      => 'button_text',
                'type'    => 'text',
                'title'   => esc_html( 'Button Text', 'noxfolio-toolkit' ),
                'default' => esc_html( 'Hire Me', 'noxfolio-toolkit' ),
            ],
            [
                'id'      => 'button_url',
                'type'    => 'text',
                'title'   => esc_html( 'Button URL', 'noxfolio-toolkit' ),
                'default' => esc_html( '#', 'noxfolio-toolkit' ),
            ],
            [
                'id'      => 'bg_image',
                'type'    => 'media',
                'title'   => esc_html( 'Background Image', 'noxfolio-toolkit' ),
                'library' => 'image',
            ],
        ],
    ] );

    function noxfolio_wp_cta_widget( $args, $instance ) {

        $allowed_html = [
            'div' => [
                'id'    => [],
                'class' => [],
            ],
            'h3'  => [
                'class' => [],
            ],
            'h4'  => [
                'class' => [],
            ],
            'h5'  => [
                'class' => [],
            ],
            'h6'  => [
                'class' => [],
            ],
			'br'  => [],
        ];

        echo wp_kses( $args['before_widget'], $allowed_html );

		if ( ! empty( $instance['subtitle'] ) ) {
			echo '<span class="subtitle">' . esc_html( $instance['subtitle'] ) . '</span>';
		}

        if ( ! empty( $instance['title'] ) ) {
            echo wp_kses( $args['before_title'], $allowed_html ) . apply_filters( 'widget_title', $instance['title'] ) . wp_kses( $args['after_title'], $allowed_html );
        }
        ?>
        <a href="<?php esc_url( $instance['button_url'] )?>" class="noxfolio-button icon-right">
            <span class="button-text"><?php echo esc_html( $instance['button_text'] ) ?></span>
            <span class="button-icon"><i class="far fa-angle-right"></i></span>
        </a>
		<?php if ( $instance['bg_image']['url'] ) : ?>
		<div class="cta-background" style="background-image: url( <?php echo esc_url( $instance['bg_image']['url'] ) ?> );"></div>
		<?php endif; ?>
        <?php echo wp_kses( $args['after_widget'], $allowed_html );
    }
}
