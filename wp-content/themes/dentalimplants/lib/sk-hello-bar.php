<?php 
genesis_register_sidebar( array(
    'id'          => 'notice-bar',
    'name'        => __( 'Notice Bar', 'infinity-pro' ),
    'description' => __( 'This is the notice bar section which appears above the header.', 'infinity-pro' ),
) );

add_action( 'genesis_before_header', 'sk_fixed_header_open' );
/**
 * Open tag for div.fixed-header.
 */
function sk_fixed_header_open() {
    echo '<div class="fixed-header">';
}

add_action( 'genesis_before_header', 'sk_notice_bar' );
/**
 * Display notice-bar widget area.
 */
function sk_notice_bar() {
    genesis_widget_area( 'notice-bar', array(
        'before'    => '<div class="notice-bar widget-area">',
        'after'     => '</div>',
    ) );
}

add_action( 'genesis_after_header', 'sk_fixed_header_close' );
/**
 * Close tag for div.fixed-header.
 */
function sk_fixed_header_close() {
    echo '</div>';
}