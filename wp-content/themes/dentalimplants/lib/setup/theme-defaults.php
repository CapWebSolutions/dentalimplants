<?php
/**
 * Dental Implants Infini-Pro.
 *
 * This file adds the default theme settings to the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplants.git/
 */

add_filter( 'genesis_theme_settings_defaults', 'dentalimplants_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 1.0.0
 */
function dentalimplants_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 8;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

add_action( 'after_switch_theme', 'dentalimplants_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 1.0.0
 */
function dentalimplants_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 8,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

	} 

	update_option( 'posts_per_page', 8 );

}

add_filter( 'simple_social_default_styles', 'dentalimplants_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 1.0.0
 */
function dentalimplants_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#000000',
		'border_color'           => '#ffffff',
		'border_color_hover'     => '#ffffff',
		'border_radius'          => 3,
		'border_width'           => 0,
		'icon_color'             => '#000000',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 36,
		);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}
