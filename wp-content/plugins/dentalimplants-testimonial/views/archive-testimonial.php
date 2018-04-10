<?php
/**
 * Testimonial Post Type: Archive/Taxonomy View
 *
 * @package    DentalImplants Testimonial
 * @author     Cap Web Solutions
 * @copyright  2018 Matt Ryan 
 *
 */

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'genesis_entry_header', 'dentalimplants_testimonial_info', 10 );
function dentalimplants_testimonial_info() {

	global $post;
	$post_id = get_the_ID( $post->ID ); 

	$testimonial_featured_img = '';
	if( has_post_thumbnail( ) ) {
		$testimonial_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'dentalimplants-testimonial-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	
	$testimonial_content = '<div class="testimonial-wrap">';

	if( !empty( $testimonial_featured_img ) ) { 
		$testimonial_content .= sprintf('<span class="alignright testimonial-image">%s</span>', $testimonial_featured_img ); 
	}	

	if( !empty( $testimonial_location ) ) { 
		$testimonial_content .= sprintf('<p class="testimonial-location">%s</p>', $testimonial_location ); 
	}

	$testimonial_content .= '</div>';  // close testimonial-wrap

	printf( '<article class="testimonial-entry">%s</article>', $testimonial_content  );
}

genesis();