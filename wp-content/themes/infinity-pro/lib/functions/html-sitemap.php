<?php 
/**
 * Dental Implants Infini-Pro.
 *
 * Replace default genesis archive content with custom content for the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplatns.git/
 */

function ultra_sitemap() {
	$heading = ( genesis_a11y( 'headings' ) ? 'h2' : 'h4' );
	
	$sitemap  = '<p>Thank you for visiting our website. Here is a map of our pages.</p><ul>';
	$sitemap  =  sprintf( '<%2$s>%1$s</%2$s>', __( 'Pages:', 'genesis' ), $heading );

	// Build list of pages to be excluded from map.
	$exclude_list = remove_these_unwanted_pages( $list );

	// Dump remaining pages to output buffer - $sitemap
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_list_pages( 'title_li=&echo=0&depth=&exclude='.$exclude_list ) );

	// Now get a listing of all post categories
	$sitemap .=  sprintf( '<hr><%2$s>%1$s</%2$s>', __( 'Categories:', 'genesis' ) , $heading );
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_list_categories( 'sort_column=name&title_li=&echo=0' ) );
 
	// Output 100 most recent posts
    $sitemap .=  sprintf( '<%2$s>%1$s</%2$s>', __( 'Recent Posts:', 'genesis' ) , $heading );
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_get_archives( 'type=postbypost&limit=100&echo=0' ) );

	// $sitemap .= sprintf( '</ul><hr><a href="%s">Back Home</a>', home_url() );

	return $sitemap;
}
add_filter( 'genesis_sitemap_output', 'ultra_sitemap');

/**
 * Remove These Unwanted Pages
 *
 * Builds list of post IDs to exclude from page listing for sitemap.
 *  
 * @param [string] $exclude_list - null
 * 
 * @return[string] $exclude_list - returned list if comma separated page IDs to exclude from wp_list_pages output
 */
function remove_these_unwanted_pages( $exclude_list ) {

	$exclude_list = '11112,15558,15556,'; //sitemap, sitemap1 & 2

	// First group to exclude is all wsm_education post types
	$args = array( 'post_type' => 'wsm_education');

	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$exclude_list .= get_the_id() .',';
	endwhile;
	wp_reset_postdata;

	// Next group is pages with 'Download Confirmation' or 'Thank You' in title
	$all_page_ids = get_all_page_ids();
	foreach ($all_page_ids as $id) {
		$post_object = get_post($id);
		// preg_match() {@link http://php.net/manual/en/function.preg-match.php}
		// If we match the expression, the page is excluded
		if ( 
			preg_match("/\b(download confirmation)\b/i", $post_object->post_title ) || 
			preg_match( "/\b(thank you)\b/i", $post_object->post_title )  || 
			preg_match( "/\b(order series)\b/i", $post_object->post_title )  || 
			preg_match( "/\b(make to stock)\b/i", $post_object->post_title ) || 
			preg_match( "/\b(-[0-9])\b/i", $post_object->post_name ) 
		) {
			$exclude_list .= $post_object->ID .',';
		}
	}
	// Reset query back
	wp_reset_postdata;
	// var_dump($exclude_list);
	return $exclude_list;
}