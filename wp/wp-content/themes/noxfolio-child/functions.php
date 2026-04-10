<?php

/*
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'noxfolio_child_enqueue_styles' );
function noxfolio_child_enqueue_styles() {
	wp_enqueue_style( 'noxfolio-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[ 'noxfolio-style' ]
	);
}

/*
 * Your code goes below
 */