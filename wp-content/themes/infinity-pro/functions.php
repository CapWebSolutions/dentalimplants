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


/**
 * This file adds most of the initial functions and settings for the Dental Implants Infini-Pro theme. 
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );
require_once( 'lib/init.php' );

// Calls the theme's constants & files
dentalimplants_init();

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'dentalimplants_localization_setup' );
function dentalimplants_localization_setup(){
	load_child_theme_textdomain( 'dentalimplants', get_stylesheet_directory() . '/languages' );
}

// Enqueue scripts and styles.
add_action( 'wp_enqueue_scripts', 'dentalimplants_enqueue_scripts_styles' );
function dentalimplants_enqueue_scripts_styles() {

	wp_enqueue_style( 'dentalimplants-fonts', '//fonts.googleapis.com/css?family=Cormorant+Garamond:400,400i,700|Raleway:700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dentalimplants-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'dentalimplants-match-height', get_stylesheet_directory_uri() . '/js/match-height.js', array( 'jquery' ), '0.5.2', true );
	wp_enqueue_script( 'dentalimplants-global', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery', 'dentalimplants-match-height' ), '1.0.0', true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'dentalimplants-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'dentalimplants-responsive-menu',
		'genesis_responsive_menu',
		dentalimplants_responsive_menu_settings()
	);
	wp_enqueue_script(
		'dentalimplants-search-bar',
		get_stylesheet_directory_uri() . '/js/dentalimplants-search-bar.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

}

// Define our responsive menu settings.
function dentalimplants_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'dentalimplants-pro' ),
		'menuIconClass'    => 'ionicons-before ion-ios-drag',
		'subMenu'          => __( 'Submenu', 'dentalimplants-pro' ),
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

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Header Menu', 'dentalimplants-pro' ), 'secondary' => __( 'Footer Menu', 'dentalimplants-pro' ) ) );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Add offscreen content if active.
// add_action( 'genesis_after_header', 'dentalimplants_offscreen_content_output' );
function dentalimplants_offscreen_content_output() {

	$button = '<button class="offscreen-content-toggle"><i class="icon ion-ios-close-empty"></i> <span class="screen-reader-text">' . __( 'Hide Offscreen Content', 'dentalimplants-pro' ) . '</span></button>';

	if ( is_active_sidebar( 'offscreen-content' ) ) {

		echo '<div class="offscreen-content-icon"><button class="offscreen-content-toggle"><i class="icon ion-ios-more"></i> <span class="screen-reader-text">' . __( 'Show Offscreen Content', 'dentalimplants-pro' ) . '</span></button></div>';

	}

	genesis_widget_area( 'offscreen-content', array(
		'before' => '<div class="offscreen-content"><div class="offscreen-container"><div class="widget-area"><div class="wrap">',
		'after'  => '</div>' . $button . '</div></div></div>',
	));

}

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

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'front-page-1',
	'name'        => __( 'Front Page 1', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 1 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 2 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 3 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 4 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 5 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 6 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'dentalimplants-pro' ),
	'description' => __( 'This is the front page 7 section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'lead-capture',
	'name'        => __( 'Lead Capture', 'dentalimplants-pro' ),
	'description' => __( 'This is the lead capture section.', 'dentalimplants-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'offscreen-content',
	'name'        => __( 'Offscreen Content', 'dentalimplants-pro' ),
	'description' => __( 'This is the offscreen content section.', 'dentalimplants-pro' ),
) );

add_action( 'genesis_header', 'custom_get_header_search_toggle' );
/**
 * Outputs the header search form toggle button.
 */
function custom_get_header_search_toggle() {
    printf(
        '<a href="#header-search-wrap" aria-controls="header-search-wrap" aria-expanded="false" role="button" class="toggle-header-search"><span class="screen-reader-text">%s</span><span class="ionicons ion-ios-search"></span></a>',
        __( 'Show Search', 'dentalimplants-pro' )
    );
}

add_action( 'genesis_header', 'custom_do_header_search_form' );
/**
 * Outputs the header search form.
 */
function custom_do_header_search_form() {
    $button = sprintf(
        '<a href="#" role="button" aria-expanded="false" aria-controls="header-search-wrap" class="toggle-header-search close"><span class="screen-reader-text">%s</span><span class="ionicons ion-ios-close-empty"></span></a>',
        __( 'Hide Search', 'dentalimplants-pro' )
    );

    printf(
        '<div id="header-search-wrap" class="header-search-wrap">%s %s</div>',
        get_search_form( false ),
        $button
    );
}


/* Code to Display Featured Image on top of the post on single team member pages */
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

// remove_action( 'genesis_loop', 'genesis_404' ); // Remove the default Genesis 404 content
// add_action( 'genesis_loop', 'cd_custom_404' ); // Add function for custom 404 content

function cd_custom_404() {

    if ( is_404() ) {
        get_template_part('/partials/sitemap'); // Plop in our customized sitemap code
    }

}

add_filter( 'genesis_sitemap_output', 'pidental_sitemap');
function pidental_sitemap() {
	$heading = ( genesis_a11y( 'headings' ) ? 'h2' : 'h4' );
	
	$sitemap  = '<p>Thank you for visiting our website. Here is a map of our pages.</p><ul>';
	$sitemap  =  sprintf( '<%2$s>%1$s</%2$s>', __( 'Pages:', 'genesis' ), $heading );
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_list_pages( 'title_li=&echo=0&depth=' ) );

	$sitemap .=  sprintf( '<hr><%2$s>%1$s</%2$s>', __( 'Categories:', 'genesis' ) , $heading );
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_list_categories( 'sort_column=name&title_li=&echo=0' ) );
	
	$sitemap .=  sprintf( '<%2$s>%1$s</%2$s>', __( 'Monthly:', 'genesis' ) , $heading );
    $sitemap .=  sprintf( '<ul>%s</ul>', wp_get_archives( 'type=monthly&echo=0' ) );
 
    $sitemap .=  sprintf( '<%2$s>%1$s</%2$s>', __( 'Recent Posts:', 'genesis' ) , $heading );
	$sitemap .=  sprintf( '<ul>%s</ul>', wp_get_archives( 'type=postbypost&limit=100&echo=0' ) );
	
	$sitemap .= sprintf( '</ul><hr><a href="%s">Back Home</a>', home_url() );

	return $sitemap;

}