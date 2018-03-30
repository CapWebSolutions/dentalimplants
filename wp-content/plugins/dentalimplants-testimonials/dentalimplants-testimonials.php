<?php

/*
 * Plugin Name: DentalImplants Testimonials
 * Plugin URI: https://capwebsolutions.com/
 * Description: Adds the Testimonial post type for the theme.
 * Author: Cap Web Solutions
 * Version: 1.0.0
 * Author URI: https://capwebsolutions.com/
 * 
 *
 */


// Get all the things
require_once( dirname( __FILE__ ) . '/post-types.php' );
require_once( dirname( __FILE__ ) . '/metaboxes.php' );
require_once( dirname( __FILE__ ) . '/helper-functions.php' );


// Load Translations
add_action( 'plugins_loaded', 'dentalimplants_testimonials_init' );
function dentalimplants_testimonials_init() {
	load_plugin_textdomain( 'dentalimplants-testimonials', false, 'dentalimplants-testimonials/languages' );
}

adds_new_testimonials_image_sizes();

// Set up templates for new post type
add_filter( 'archive_template', 'load_archive_template' );
add_filter( 'archive_template', 'load_taxonomy_archive_template', 11 );
add_filter( 'single_template', 'load_single_template' );