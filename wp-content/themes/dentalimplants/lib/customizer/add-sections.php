<?php
/**
 * Customizer: Add Sections
 *
 * This file demonstrates how to add Sections to the Customizer
 * 
 * @package   code-examples
 * @copyright Copyright (c) 2015, WordPress Theme Review Team
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */
 

/**
 * Theme Options Customizer Implementation.
 *
 * Implement the Theme Customizer for Theme Settings.
 *
 * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * 
 * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
 */
function theme_slug_register_customizer_sections( $wp_customize ){

	/*
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}
	
	
	/**
	 * Add Header Section for General Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_header',
		// $args
		array(
			'title'			=> __( 'Header Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the header section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_general'
		)
	);
	
	
	/**
	 * Add Footer Section for General Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_footer',
		// $args
		array(
			'title'			=> __( 'Footer Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the footer section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_general'
		)
	);
	
	
	/**
	 * Add Front Page Section for General Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_frontpage',
		// $args
		array(
			'title'			=> __( 'Front Page Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the front page section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_general'
		)
	);
	
	
	/**
	 * Add Color Section for Color Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_colors',
		// $args
		array(
			'title'			=> __( 'Color Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the colors section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_colorslayouts'
		)
	);
	
	
	/**
	 * Add Layout Section for Layout Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_layouts',
		// $args
		array(
			'title'			=> __( 'Layout Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the layouts section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_colorslayouts'
		)
	);
	
	
	/**
	 * Add CSS Section for Advanced Options.
	 * 
	 * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
	 * @link $wp_customize->add_section() https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */
	$wp_customize->add_section(
		// $id
		'theme_slug_section_css',
		// $args
		array(
			'title'			=> __( 'CSS Options', 'theme-slug' ),
			'description'	=> __( 'Some description for the options in the CSS section', 'theme-slug' ),
			'panel'			=> 'theme_slug_panel_advanced'
		)
	);
}

// Settings API options initilization and validation.
add_action( 'customize_register', 'theme_slug_register_customizer_sections' );