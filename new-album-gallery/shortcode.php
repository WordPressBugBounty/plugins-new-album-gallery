<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_shortcode( 'AGAL', 'nag_album_gallery_shortcode' );
function nag_album_gallery_shortcode( $post_id ) {
	ob_start();

	// js
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'nag-isotope-js' );
	wp_enqueue_script( 'nag-imagesloaded-js' );

	// PhotoBox Lightbox
	wp_enqueue_style( 'nag-photobox-css' );
	wp_enqueue_script( 'nag-photobox-js' );

	// css
	wp_enqueue_style( 'nag-bootstrap-css' );
	wp_enqueue_style( 'nag-animate-css' );
	wp_enqueue_style( 'nag-hover-stack-style-css' );
	wp_enqueue_style( 'nag-hover-overlay-effects-css' );
	wp_enqueue_style( 'nag-hover-overlay-effects-style-css' );

	// output code file
	require 'include/album-gallery-output.php';
	wp_reset_query();
	return ob_get_clean();
}

