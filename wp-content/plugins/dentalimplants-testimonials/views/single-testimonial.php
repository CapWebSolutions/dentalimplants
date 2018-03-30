<?php
/**
 * Testimonial Post Type: Single Post View
 *
 * @package    Pineland Testimonials
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'genesis_entry_header', 'pineland_testimonial_info', 10 );
function pineland_testimonial_info() {

	global $post;
	$post_id = get_the_ID( $post->ID ); 
	$testimonial_descriptor = get_post_meta( $post_id, '_pineland_testimonial_descriptor', true );
	$testimonial_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$testimonial_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'pineland-testimonial-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	$testimonial_content = '<div class="testimonial-wrap">';
	$source   = get_the_term_list( get_the_ID(), 'source', '', ', ', '' );
	if ( $source ) {
		$testimonial_content .= sprintf('<div class="testimonial-source">' . esc_attr( strip_tags( $source ) ) . '</div>');
	}
	$testimonial_content .= sprintf('<div class="testimonial-descriptor">%s</div>', $testimonial_descriptor );
	if( !empty( $testimonial_featured_img ) ) { 
		$testimonial_content .= sprintf('<span class="alignright testimonial-image">%s</span>', $testimonial_featured_img ); 
	}	
	if( !empty( $testimonial_company ) ) { 
		$testimonial_content .= sprintf('<p class="testimonial-company">%s</p>', $testimonial_company ); 
	}
	if( !empty( $testimonial_location ) ) { 
		$testimonial_content .= sprintf('<p class="testimonial-location">%s</p>', $testimonial_location ); 
	}
	$testimonial_content .= '</div>';  // close testimonial-wrap

	printf( '<article class="testimonial-entry">%s</article>', $testimonial_content  );


}

genesis();