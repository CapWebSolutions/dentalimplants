<?php
/**
 * Login/logout Page
 *
 * This file restylers the site's login page. 
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/dentalimplants-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/* 
 * Pull in the styles sheet here since WP is not yet far enough along to use enqueue functions. 
  */
 function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . CORE_FUNCTION_URL . 'assets/css/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

/* Change the login logo URL - no need to go to wp.org - let's go to us. */
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
	
function my_login_logo_url_title() {
	// This is the alt tag for the image. 
	return get_bloginfo( 'name' ) . '-' . get_bloginfo( 'description' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/* Hide the login error message - no need to clue in the hackers on what they got right, or wrong */
function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');


/* Remove error shake, just because.  */
function my_login_head() {
	remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

/* Change login redirect for non-admin users. */
function admin_login_redirect( $redirect_to, $request, $user )
{
	global $user;
	if( isset( $user->roles ) && is_array( $user->roles ) ) {
		if( in_array( "administrator", $user->roles ) ) {
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter("login_redirect", "admin_login_redirect", 10, 3);

/* Set remember me to be checked */
function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );
	
function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}