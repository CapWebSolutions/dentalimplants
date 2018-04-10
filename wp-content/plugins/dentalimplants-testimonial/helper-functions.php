<?php

/**
 * Adds new image sizes.
 *
 * @since 1.0.0
 *
 * @return void
 */
function adds_new_testimonial_image_sizes() {
	$config = array(
		'dentalimplants-testimonial-image' => array(
			'width'  => 200,
			'height' => 200,
			'crop'   => true,
		),
	);

	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}

/**
 * Dental Implants Testimonial Post Type
 *
 * @package    Simple_Listing_Post_Type
 * @author     Robin Cornett <hello@robincornett.com>
 * @copyright  2017 Matt Ryan
 *
 */


 /**
 * load Testimonial archive template
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_archive_template( $archive_template ) {
	if ( is_post_type_archive( 'testimonial' ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/archive-testimonial.php';
	}

	return $archive_template;

}

/**
 * load single Testimonial template
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
function load_single_template( $single_template ) {
	if ( is_singular( 'testimonial' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-testimonial.php';
	}
	return $single_template;

}
