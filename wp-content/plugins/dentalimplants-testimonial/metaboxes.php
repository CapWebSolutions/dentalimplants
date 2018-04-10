<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */

/**
 * Get the bootstrap!
 */

if ( file_exists( dirname( __FILE__ ) . '/metabox/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/metabox/init.php';
}


add_action( 'cmb2_init', 'cws_register_testimonial_metabox' );
function cws_register_testimonial_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_dentalimplants_testimonial_';

	/**
	 * Metabox to be displayed on a single page ID
	 */
	$cmb_testimonial = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Testimonial Details:', 'dentalimplants-testimonial' ),
		'object_types' => array( 'testimonial', ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, 
		'taxonomies'	=> array('type'),
	) );
	
	$cmb_testimonial->add_field( array(
		'name' => __( 'Location', 'dentalimplants-testimonial' ),
		'id'   => $prefix . 'location',
		'type' => 'text',
	) );

	$cmb_testimonial->add_field( array(
		'name' => __( 'Display Excerpt', 'dentalimplants-testimonial' ),
		'id'   => $prefix . 'display_excerpt',
		'type' => 'checkbox',
	) );
}

function cws_cmb2_sanitize_text_callback( $value, $field_args, $field ) {
	$value = strip_tags( $value, '<p><a><br><br/>' );
    return $value;
}
add_filter( 'cmb2_sanitize_text', 'cmb2_sanitize_text_callback', 10, 2 );