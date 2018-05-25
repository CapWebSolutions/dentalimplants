<?php
/**
 * Dental Implants Infini-Pro.
 *
 * This file adds the lead capture page template to the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplants.git/
 */

// Add landing page body class to the head.
add_filter( 'body_class', 'dentalimplants_add_body_class' );
function dentalimplants_add_body_class( $classes ) {

	$classes[] = 'lead-capture-page';

	return $classes;

}

// Remove Skip Links.
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
add_action( 'wp_enqueue_scripts', 'dentalimplants_dequeue_skip_links' );
function dentalimplants_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Hook lead capture widget area.
add_action( 'genesis_loop', 'dentalimplants_lead_capture' );
function dentalimplants_lead_capture() {

	genesis_widget_area( 'lead-capture', array(
		'before' => '<div class="lead-capture">',
		'after'  => '</div>',
	) );

}

// Remove offscreen content.
remove_action( 'genesis_before_header', 'dentalimplants_offscreen_content_output' );

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation.
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove site footer widgets.
remove_theme_support( 'genesis-footer-widgets' );

// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
