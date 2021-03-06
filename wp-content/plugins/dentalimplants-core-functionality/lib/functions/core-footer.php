<?php
/**
 * General
 *
 * This file contains footer setup functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/starter-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2017, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


// Create a shortcode to display our custom Go to top link in footer
add_shortcode( 'footer_custombacktotop', 'cap_web_footer_back_to_top' );
function cap_web_footer_back_to_top( $atts ) {
	$top_of_page = '<a href="#" class="top">Top of page</a>';
	return $top_of_page;
}

// Set up split custom footer
// Ref: https://sridharkatakam.com/split-footer-genesis/
add_shortcode( 'sitename', 'capweb_site_name' );
function capweb_site_name() {
	return '<a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'sitename' ) . '">' . get_bloginfo( 'name' ) . '</a>';
}

// * Change the footer text
add_filter( 'genesis_footer_creds_text', 'cap_web_footer_creds_filter' );
function cap_web_footer_creds_filter( $creds ) {
	$rel = is_front_page() ? '' : 'rel="nofollow"';
	$cred1_url = '/disclaimer/';
	$cred1_title = 'Disclaimer';
	
	$creds = '<div class="footer-alignleft">';
	$creds .= '<a href="' . $cred1_url . '">' . $cred1_title . '</a><br/>';
	$creds .= 'Copyright [footer_copyright] [sitename], 467 Pennsylvania Avenue, Suite 201, Fort Washington, PA 19034';
	$creds .= '</div><div class="footer-alignright">';
	$creds .= "Website by <a {$rel} href=\"https://capwebsolutions.com/\" target=\"_blank\" >Cap Web Solutions</a><br>";
	$creds .= '[footer_custombacktotop]</div>';
	return $creds;
}
