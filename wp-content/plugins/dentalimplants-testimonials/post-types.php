<?php
function cptui_register_my_cpts_testimonial() {
	
		/**
		 * Post Type: Testimonials.
		 */
	
		$labels = array(
			"name" => __( "Testimonials", "CapWebWP/Developers" ),
			"singular_name" => __( "Testimonial", "CapWebWP/Developers" ),
			"menu_name" => __( "My Testimonials", "CapWebWP/Developers" ),
			"all_items" => __( "All Testimonials", "CapWebWP/Developers" ),
			"add_new" => __( "Add New Testimonial", "CapWebWP/Developers" ),
			"add_new_item" => __( "Add New Testimonial", "CapWebWP/Developers" ),
			"edit_item" => __( "Edit Testimonial", "CapWebWP/Developers" ),
			"new_item" => __( "New Testimonial", "CapWebWP/Developers" ),
			"view_item" => __( "View Testimonial", "CapWebWP/Developers" ),
			"view_items" => __( "View Testimonials", "CapWebWP/Developers" ),
			"search_items" => __( "Search Testimonials", "CapWebWP/Developers" ),
			"not_found" => __( "No Testimonials Found", "CapWebWP/Developers" ),
			"not_found_in_trash" => __( "No Testimonials found in trash", "CapWebWP/Developers" ),
			"featured_image" => __( "Author Image", "CapWebWP/Developers" ),
			"set_featured_image" => __( "Set Author Image for this testimonial", "CapWebWP/Developers" ),
			"remove_featured_image" => __( "Remove Author Image", "CapWebWP/Developers" ),
			"use_featured_image" => __( "Us as Author Image for this testimonial", "CapWebWP/Developers" ),
			"archives" => __( "Testimonial Archives", "CapWebWP/Developers" ),
			"insert_into_item" => __( "Insert into Testimonial", "CapWebWP/Developers" ),
			"uploaded_to_this_item" => __( "Uploaded to this Testimonial", "CapWebWP/Developers" ),
			"filter_items_list" => __( "Filter Testimonial List", "CapWebWP/Developers" ),
			"items_list" => __( "Testimonial List", "CapWebWP/Developers" ),
			"attributes" => __( "Testimonial Attributes", "CapWebWP/Developers" ),
		);
	
		$args = array(
			"label" => __( "Testimonials", "CapWebWP/Developers" ),
			"labels" => $labels,
			"description" => "Manages testimonials for website",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => "testimonials",
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
			return 'Testimonial Author Name';
		return $input;
	}
	add_filter('gettext','dentalimplants_testimonial_title');