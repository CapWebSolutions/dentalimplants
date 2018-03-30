<?php
/**
 * Plugin Name: BE Admin Bar Links
 * Plugin URI: https://gist.github.com/billerickson/2829a5634fd534c0f3dd503e3303bec5
 * Description: Adds links to current page in different environments
 * Version:     2.0
 * Author:      Bill Erickson
 * Author URI:  http://www.billerickson.net
 * License:     MIT
 * License URI: http://www.opensource.org/licenses/mit-license.php
 */

/**
 * Admin Bar Links
 *
 */
function be_admin_bar_links( $wp_admin_bar ) {

	$links = array();
	$current = esc_url( 'http://' . $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'] );

	// Production
	if( defined( 'BE_PRODUCTION_URL' ) ) {
		$links['Production'] = str_replace( home_url(), BE_PRODUCTION_URL, $current );
	}

	// WPEngine Dev Environment
	if( defined( 'BE_WPE_INSTALL' ) ) {
		$prefix = '';
		if( defined( 'BE_WPE_USER' ) && defined( 'BE_WPE_PASSWORD' ) ) {
		 	$prefix = BE_WPE_USER . ':' . BE_WPE_PASSWORD . '@';
		}
		$install = BE_WPE_INSTALL;
		if( defined( 'BE_PUSH_TO' ) && 'staging' == BE_PUSH_TO )
			$install .= '.staging';

		$links['Dev'] = str_replace( home_url(), 'https://' . $prefix . $install . '.wpengine.com', $current );
	}

	if ( !defined( 'BE_LOCAL_LIVE' ) ) {
	// CodeKit Local
		$links['Local (Live)'] = str_replace( home_url(), 'http://bills-macbook-pro.local:5757', $current );
	} else {
		$links['Local (Live)'] = str_replace( home_url(), BE_LOCAL_LIVE, $current );
	}

	// WPEngine Admin
	if( defined( 'BE_WPE_INSTALL' ) ) {
		$links['WPE Admin'] = 'https://my.wpengine.com/installs/' . BE_WPE_INSTALL;
	}

	// GitHub
	if( defined( 'BE_GITHUB_INSTALL' ) ) {
		$links['GitHub'] = 'https://github.com/billerickson/' . BE_GITHUB_INSTALL;
		$links['Wiki'] = 'https://github.com/billerickson/' . BE_GITHUB_INSTALL . '/wiki/';
	} elseif ( defined( 'MR_GITHUB_INSTALL' ) ) {
		$links['GitHub'] = 'https://github.com/capwebsolutions/' . MR_GITHUB_INSTALL;
		$links['Wiki'] = 'https://github.com/capwebsolutions/' . MR_GITHUB_INSTALL . '/wiki/';
	}



	$wp_admin_bar->add_node( array(
		'id' => 'ea_url_switch',
		'title' => 'Switch To:',
		'href'  => '#',
	) );

	foreach( $links as $title => $url ) {
		$wp_admin_bar->add_node( array(
			'parent' => 'ea_url_switch',
			'id'     => 'ea_url_switch_' . sanitize_key( $title ),
			'title'  => $title,
			'href'   => $url,
		) );
	}

}
add_action( 'admin_bar_menu', 'be_admin_bar_links', 999 );
