<?php
function cptui_register_my_cpts_testimonial() {
	
		/**
		 * Post Type: Testimonial.
		 */
	
		$labels = array(
			"name" => __( "Testimonial", "CapWebWP/Developers" ),
			"singular_name" => __( "Testimonial", "CapWebWP/Developers" ),
			"menu_name" => __( "My Testimonial", "CapWebWP/Developers" ),
			"all_items" => __( "All Testimonial", "CapWebWP/Developers" ),
			"add_new" => __( "Add New Testimonial", "CapWebWP/Developers" ),
			"add_new_item" => __( "Add New Testimonial", "CapWebWP/Developers" ),
			"edit_item" => __( "Edit Testimonial", "CapWebWP/Developers" ),
			"new_item" => __( "New Testimonial", "CapWebWP/Developers" ),
			"view_item" => __( "View Testimonial", "CapWebWP/Developers" ),
			"view_items" => __( "View All Testimonial", "CapWebWP/Developers" ),
			"search_items" => __( "Search Testimonial", "CapWebWP/Developers" ),
			"not_found" => __( "No Testimonial Found", "CapWebWP/Developers" ),
			"not_found_in_trash" => __( "No Testimonial found in trash", "CapWebWP/Developers" ),
			"featured_image" => __( "Featured Image", "CapWebWP/Developers" ),
			"set_featured_image" => __( "Set Featured Image for this testimonial", "CapWebWP/Developers" ),
			"remove_featured_image" => __( "Remove Featured Image", "CapWebWP/Developers" ),
			"use_featured_image" => __( "Us as Featured Image for this testimonial", "CapWebWP/Developers" ),
			"archives" => __( "Testimonial Archives", "CapWebWP/Developers" ),
			"insert_into_item" => __( "Insert into Testimonial", "CapWebWP/Developers" ),
			"uploaded_to_this_item" => __( "Uploaded to this Testimonial", "CapWebWP/Developers" ),
			"filter_items_list" => __( "Filter Testimonial List", "CapWebWP/Developers" ),
			"items_list" => __( "Testimonial List", "CapWebWP/Developers" ),
			"attributes" => __( "Testimonial Attributes", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Testimonial", "CapWebWP/Developers" ),
			"labels" => $labels,
			"description" => "Manages testimonials for website",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => "testimonial",
			"show_in_menu" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "testimonial", "with_front" => true ),
			"query_var" => true,
			"menu_icon" => "dashicons-testimonial",
			"supports" => array( "title", "editor", "thumbnail", "revisions", "genesis-cpt-archives-settings" ),
		);
	
		register_post_type( "testimonial", $args );
	}
	
	add_action( 'init', 'cptui_register_my_cpts_testimonial' );
	
	
	function dentalimplants_testimonial_title( $input ) {
	
		global $post_type;
	
		if( is_admin() && 'Enter title here' == $input && 'testimonial' == $post_type )
			return 'Testimonial Featured Name';
		return $input;
	}
	add_filter('gettext','dentalimplants_testimonial_title');

	/**
 
* Load Custom Post Type and Flush Rewrite Rules
 *
 * We run this on plugin activation to prevent the problem of the custom post
 * type URLs not loading initially (because their URL pattern is not included
 * in the cached rewrite rules). We explicitly call the code to register the
 * custom post type because that code, which executes on the `init`, hook
 * has not yet executed.
 */


function cptui_register_my_cpts_activation() {
	cptui_register_my_cpts_testimonial();
	flush_rewrite_rules();
}

/**
 * Flush the rewrite rules.
 *
 * We run this on plugin deactivation to ensure the rewrite rules no longer
 * included the URL pattern for our Custom Post Type.
 */
function cptui_register_my_cpts_deactivation() {
	flush_rewrite_rules();
	flush_rewrite_rules();
}