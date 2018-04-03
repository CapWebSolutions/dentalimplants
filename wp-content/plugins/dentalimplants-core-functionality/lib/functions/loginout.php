<?php
/**
 * Login/logout Page
 *
 * @author       Matt Ryan
 * @link         http://www.mattryan.co/
 * @copyright    Copyright (c) 2018, Matt Ryan
 * @license      GPL-3.0+
 */

// Remove our default page content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Add custom login form to our page content
// add_action( 'genesis_entry_content', 'cws_do_login_form' );
add_action( 'login_enqueue_scripts', 'cws_do_login_form' );
function cws_do_login_form() {

// Get login status and username
	$loggedin = is_user_logged_in();
	$user = wp_get_current_user();

// If already logged in, output pleasent message with logout option.
// The logout option will redirect back to this custom login/logout page.

	if ( $loggedin ) { ?>

		<h2>You are already logged in!</h2>
		<p>Hello <?php echo $user->user_firstname; ?>! Looks like you are already signed in. No need to log in again.</p>
		<p><a href="/">Go to the front page </a> or <a href="<?php echo wp_logout_url( get_permalink() . "/login" ); ?>">Log Out</a></p>

	<?php
	} else {
// Set up array to pass to login function
		$args = array(
			'form_id'			=> 'loginform',
			'redirect'			=> get_bloginfo( 'url' ),
			'id_username'		=> 'user_login',
			'id_password'		=> 'user_pass',
			'id_remember'		=> 'rememberme',
			'id_submit'			=> 'wp-submit',
			'label_username'	=> __( 'Username' ),
			'label_password'	=> __( 'Password' ),
			'label_remember'	=> __( 'Remember Me' ),
			'label_log_in'		=> __( 'Log In' ),
		);
		?>

			$login_header_url = apply_filters( 'login_headerurl', $login_header_url );
<!--
	Create content for custom login page.
	Format the login page and provide instructions to visitor.
	Offer links to website front page and password retreival.
	Call WP function to display UI.
	Display lost password link.
-->
		<center><h1>Website Login Page</h1><hr>
		<h5>Enter your username and password to access <br>the administrative area of your website,<br>
		<a href="/">or click here for the website Front Page</a></h5>
		<hr>
		Use the '<strong>Lost your password?</strong>' link below <br>to have a password reset link sent to you by email.
		<br><hr><br>
		</center>
		<?php

		wp_login_form( $args );

		?>
		<a href="<?php echo wp_lostpassword_url(); ?>" title="Lost Password">Lost your password?</a>
		<?php
	}
}


function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
	
function my_login_logo_url_title() {
	return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/* Hide the login error message */
function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

/* Remove error shake */
function my_login_head() {
	remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

/* Change login redirect */
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

/* Set remember me to checked */
function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );
	
function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}