<?php

/*
 * Plugin Name: Pi Dental Center Testimonial
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

//* Set up rewrite rules flushing on plugin activation/deactivation. Get rid of nasty 404 errors. 
register_activation_hook(   __FILE__, 'cptui_register_my_cpts_activation' );
register_deactivation_hook( __FILE__, 'cptui_register_my_cpts_deactivation' );


// Load Translations
add_action( 'plugins_loaded', 'dentalimplants_testimonial_init' );
function dentalimplants_testimonial_init() {
	load_plugin_textdomain( 'dentalimplants-testimonial', false, 'dentalimplants-testimonial/languages' );
}

adds_new_testimonial_image_sizes();

// Set up templates for new post type
// add_filter( 'archive_template', 'load_archive_template' );
// add_filter( 'single_template', 'load_single_template' );