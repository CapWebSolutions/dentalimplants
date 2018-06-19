<?php
/**
 * Theme Name: Dental Implants Infini-Pro
 * Theme URI: https://github.com/capwebsolutions/dentalimplants.git/
 * Author: Cap Web Solutions
 * Author URI: https://capwebsolutions.com/
 * Description: The Dental Implants Infini-Pro child theme for Genesis is a uniquely customized version of Studiopress' Infinity Pro child theme for the Pi Dental Center. 
 * Version: 1.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dentalimplants
*/


/** Define Directory Location Constants */
if ( ! defined( 'CHILD_DIR' ) )
	define( 'CHILD_DIR', get_stylesheet_directory() );


// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( CHILD_DIR . '/lib/setup/theme-defaults.php' );

// Helper functions.
include_once( CHILD_DIR . '/lib/functions/helper-functions.php' );

// Include customizer CSS.
include_once( CHILD_DIR . '/lib/setup/output.php' );

// Add image upload and color select to theme customizer.
require_once( CHILD_DIR . '/lib/customizer/customize.php' );

// Special functionality 
include_once( CHILD_DIR . '/lib/functions/twentyfourteen-search.php' ); /* old-school search functino */
include_once( CHILD_DIR . '/lib/functions/sk-hello-bar.php' ); /* Phone number stuck to top of page */
include_once( CHILD_DIR . '/lib/functions/cws-under-nav-image-bar.php' ); /* Full width image under interior navs */


// Set Localization (do not remove).
add_action( 'after_setup_theme', 'dentalimplants_localization_setup' );
function dentalimplants_localization_setup(){
	load_child_theme_textdomain( 'dentalimplants', CHILD_DIR . '/languages' );
}

define( 'CHILD_THEME_NAME', 'Dental Implants Infini-Pro' );
define( 'CHILD_THEME_URL', 'https://github.com/capwebsolutions/dentalimplants.git/' );
define( 'CHILD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'CHILD_THEME_IMAGES', CHILD_DIR . '/images' );

// Developer Information (do not remove)
define( 'CHILD_DEVELOPER', 'Cap Web Solutions' );
define( 'CHILD_DEVELOPER_URL', 'https://capwebsolutions.com/'  );

// Enqueue scripts and styles.
add_action( 'wp_enqueue_scripts', 'dentalimplants_enqueue_scripts_styles' );
function dentalimplants_enqueue_scripts_styles() {

	wp_enqueue_style( 'dentalimplants-fonts', '//fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,700|Raleway:700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dentalimplants-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_Style( 'dentalimplants-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION  ); /* Used by twentyfourteen-style search bar */
	wp_enqueue_script( 'dentalimplants-match-height', get_stylesheet_directory_uri() . '/js/match-height.js', array( 'jquery' ), '0.5.2', true );
	wp_enqueue_script( 'dentalimplants-global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery', 'dentalimplants-match-height' ), '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'dentalimplants-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	wp_localize_script(
		'dentalimplants-responsive-menu',
		'genesis_responsive_menu',
		dentalimplants_responsive_menu_settings()
	);
	// wp_enqueue_script( 'dentalimplants-sticky-header', get_stylesheet_directory_uri() . '/js/sticky-header.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'dentalimplants-hidesearch', get_stylesheet_directory_uri() . '/js/hidesearch.js', array('jquery'), CHILD_THEME_VERSION, true ); /* Used by twentyfourteen-style search bar */
}

// Define our responsive menu settings.
function dentalimplants_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'dentalimplants' ),
		'menuIconClass'    => 'ionicons-before ion-ios-drag',
		'subMenu'          => __( 'Submenu', 'dentalimplants' ),
		'subMenuIconClass' => 'ionicons-before ion-chevron-down',
		'menuClasses'      => array(
			'others' => array(
				'.nav-primary',
			),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 400,
	'height'          => 130,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add image sizes.
add_image_size( 'mini-thumbnail', 75, 75, TRUE );
add_image_size( 'team-member', 600, 600, TRUE );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove header right widget area.
unregister_sidebar( 'header-right' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Remove navigation meta box.
add_action( 'genesis_theme_settings_metaboxes', 'dentalimplants_remove_genesis_metaboxes' );
function dentalimplants_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

// Remove skip link for primary navigation.
add_filter( 'genesis_skip_links_output', 'dentalimplants_skip_links_output' );
function dentalimplants_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	return $links;

}

// Force Content Sidebar layout on internal pages.
if ( is_page() && !is_front_page() ) {
	add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );
}

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Header Menu', 'dentalimplants-infini-pro' ), 'secondary' => __( 'Footer Menu', 'dentalimplants-infini-pro' ) ) );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
// add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'dentalimplants_secondary_menu_args' );
function dentalimplants_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'dentalimplants_author_box_gravatar' );
function dentalimplants_author_box_gravatar( $size ) {
	return 100;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'dentalimplants_comments_gravatar' );
function dentalimplants_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Setup widget counts.
function dentalimplants_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

// Determine the widget area class.
function dentalimplants_widget_area_class( $id ) {

	$count = dentalimplants_count_widgets( $id );

	$class = '';

	// Hack to resolve Infinity Pro bug/feature in flex widget alignment. 
	if ( 'front-page-6' === $id && ( 0 === $count % 4 || 1 === $count % 4 ) ) {
			$class .= ' widget-fourths';
			return $class;
	}

	if ( $count == 1 ) {
		$class .= ' widget-full';
	} elseif ( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif ( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif ( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

// Add support for 4-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 1 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 2 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 3 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 4 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 5 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 6 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the front page 7 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry-1',
	'name'        => __( 'After Entry 1', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the after entry style 1 section.', 'dentalimplants-infini-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry-2',
	'name'        => __( 'After Entry 2', 'dentalimplants-infini-pro' ),
	'description' => __( 'This is the after entry style 2 section.', 'dentalimplants-infini-pro' ),
) );


//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

/**
* Add utility bar above header.
*
* @author Carrie Dils
* @copyright Copyright (c) 2013, Carrie Dils
* @license GPL-2.0+
*/
function utility_bar() {
 
	echo '<div class="my-site-header"><div class="utility-bar"><div class="wrap">';
 
	genesis_widget_area( 'utility-bar-left', array(
		'before' => '<div class="utility-bar-left">',
		'after' => '</div>',
	) );
 
	genesis_widget_area( 'utility-bar-right', array(
		'before' => '<div class="utility-bar-right">',
		'after' => '</div>',
	) );
 
	echo '</div></div></div>';
 
}

function display_after_entry_1_widgets(){
	echo '<div class="after-entry-1"><div class="wrap">';
	
	genesis_widget_area( 'after-entry-1', array(
		'before' => '<div class="after-entry-1">',
		'after' => '</div>',
	) );
	
	echo '</div></div>';
}
function display_after_entry_2_widgets(){
	echo '<div class="after-entry-2"><div class="wrap">';

	genesis_widget_area( 'after-entry-2', array(
		'before' => '<div class="after-entry-2">',
		'after' => '</div>',
	) );

	echo '</div></div>';
}

/* Display Featured Image on top of the post on single team member pages */
add_action( 'genesis_before_entry_content', 'display_team_member_featured_image_on_page', 1 );
function display_team_member_featured_image_on_page() {
	if ( ! is_singular( 'post' ) && is_page_template('page_team') )  return;

	$image = genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'team-member',
		'context' => '',
		'attr'    => array ( 'class' => 'aligncenter', 'alt' => the_title_attribute( 'echo=0' ) ), // set a default WP image class

	) );
	if ( $image ) {
		printf( '<div class="featured-image-class">%s</div>', $image ); 
	}
}

//* Add custom body class to the head
// add_filter( 'genesis_attr_site-header', 'cws_add_css_header_class' );
function cws_add_css_header_class( $attributes ) {

		$attributes['class'] .= NAV_BG_IMAGE_CSS;
		return $attributes;

}

// All of the pages pulled in as HTML pages have generic title. 
// Want to hide these from front end. 
add_action( 'genesis_before_entry', 'remove_title_from_some_pages' );
function remove_title_from_some_pages(){
	$my_id_list = array( 
		4104,	// /health-issues-and-dentistry/conditions
		5047, 	// /misc page
		5332, 	// /patients/gallery 
	);  
	foreach ($my_id_list as $value) {
		$my_id = $value; 
	}
	if ( is_tree( $my_id ) ) {
		// remove title
		//ref: https://sridharkatakam.com/remove-titles-pages-genesis/
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	}
}

// To check a Page by ID and all its child Pages incl. grand children
// ref: https://sridharkatakam.com/useful-functions-checking-pages-sub-pages-wordpress/
function is_tree( $pid ) { // $pid = The ID of the page we're looking for pages underneath

	global $post; // load details about this page

	$anc = get_post_ancestors( $post->ID );

	foreach( $anc as $ancestor ) {
		if ( is_page() && $ancestor == $pid ) {
			return true;
		}
	}

	if ( is_page() && ( is_page ( $pid ) ) ) {
		return true; // we're at the page or at a sub page
	}
	else {
	   return false; // we're elsewhere
	}
}



//* Remove all post info for single posts.  
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	if ( is_single() ) $post_info = '';
	return $post_info;
}


//* Customize the post info function on testamonial CPT archive
add_filter( 'genesis_post_info', 'capweb_post_info_filter' );
function capweb_post_info_filter($post_info) {
if ( is_post_type_archive('testimonial') ) {
	$post_info = '[post_date]';
	return $post_info;
}}