<?php 
/**
 * Dental Implants Infini-Pro.
 *
 * This file sets the markup for the image-bar at the top of the interior pages for the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplants.git/
 * @link    https://sridharkatakam.com/fixed-notice-bar-header-in-infinity-pro/
 */


/** Add new image sizes */
add_image_size( 'image-bar', 1600, 99, TRUE );


genesis_register_sidebar( array(
    'id'          => 'image-bar',
    'name'        => __( 'Image Bar', 'dentalimplants-infini-pro' ),
    'description' => __( 'This is the image bar section which appears below the header.', 'dentalimplants-infini-pro' ),
) );

add_action( 'genesis_before_search_widget_area', 'cws_fixed_image_header_open' );

/**
 * Open tag for div.fixed-image-header.
 */
function cws_fixed_image_header_open() {
    if( ! is_front_page() ) echo '<div class="fixed-image-header">';
    return;
}


add_action( 'genesis_before_search_widget_area', 'cws_image_bar' );
/**
 * Display image-bar widget area.
 */
function cws_image_bar() {
    if( is_front_page() )
        return;
        
    genesis_widget_area( 'image-bar', array(
        'before'    => '<div class="image-bar widget-area">',
        'after'     => '</div>',
    ) );
}

add_action( 'genesis_before_search_widget_area', 'cws_fixed_image_header_close' );
/**
 * Close tag for div.fixed-image-header.
 */
function cws_fixed_image_header_close() {
    if( ! is_front_page() ) echo '</div>';
    return;
}