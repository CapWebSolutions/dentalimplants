<?php
/**
 * Dental Implants Infini-Pro.
 *
 * This file calls the Child and Genesis init.php files for the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplatns.git/
 */


/**
 * This function defines the Genesis Child theme constants
 * and calls necessary theme files
 *
 */


function dentalimplants_init() {
	// Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'Dental Implants Infinity Pro' );
	define( 'CHILD_THEME_URL', 'https://github.com/capwebsolutions/dentalimplants.git/' );
	define( 'CHILD_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
	define( 'DENTALIMPLANTS_SETTINGS_FIELD', 'dentalimplants' );

	// Developer Information (do not remove)
	define( 'CHILD_DEVELOPER', 'Cap Web Solutions' );
	define( 'CHILD_DEVELOPER_URL', 'https://capwebsolutions.com/'  );

	/** Define Directory Location Constants */
	if ( ! defined( 'CHILD_DIR' ) )
		define( 'CHILD_DIR', get_stylesheet_directory() );

	/** Define URL Location Constants */
	if ( ! defined( 'CHILD_URL' ) )
	define( 'CHILD_URL', get_stylesheet_directory_uri() );
	define( 'DENTALIMPLANTS_LIB', CHILD_URL . '/lib' );
	define( 'DENTALIMPLANTS_IMAGES', CHILD_URL . '/images' );
	define( 'DENTALIMPLANTS_ADMIN', CHILD_LIB . '/admin' );
	define( 'DENTALIMPLANTS_ADMIN_IMAGES', CHILD_LIB . '/images' );
	define( 'DENTALIMPLANTS_JS' , CHILD_URL .'/lib/js' );
	define( 'DENTALIMPLANTS_CSS' , CHILD_URL .'/css' );

	// Load admin files when necessary
	if ( is_admin() ) {
		// Plugins
		include_once( CHILD_DIR . '/lib/plugins/plugins.php' );
		// Theme Settings
		require_once( CHILD_DIR . '/lib/admin/theme-defaults.php' );
	}


	//Structure
	//include_once( CHILD_DIR . '/lib/structure/header.php');
	include_once( CHILD_DIR . '/lib/structure/post.php');
	include_once( CHILD_DIR . '/lib/structure/sidebar.php');
	include_once( CHILD_DIR . '/lib/structure/comment-form.php');
	include_once( CHILD_DIR . '/lib/structure/footer.php');
	include_once( CHILD_DIR . '/lib/structure/top-image.php');

	// Add image upload and color select to theme customizer.
	include_once( CHILD_DIR . '/lib/functions/customize.php');  
	
	include_once( CHILD_DIR . '/lib/functions/helper-functions.php');  // misc helper functions
	
	include_once( CHILD_DIR . '/lib/functions/html-sitemap.php');  // HTML sitemap
	
	include_once( CHILD_DIR . '/lib/functions/output.php'); // customizer css
}

add_filter( 'http_request_args', 'dentalimplants_dont_update_theme', 5, 2 );
/**
 * Don't Update Theme
 * If there is a theme in the repo with the same name,
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r Request arguments
 * @param string $url Request url
 * @return array $r Request arguments
 */
function dentalimplants_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}