<?php
/**
 * Dental Implants Infini-Pro.
 *
 * This file adds the Customizer additions to the Dental Implants Infini-Pro theme.
 *
 * @package DentalImplants
 * @author  Cap Web Solutions
 * @license GPL-2.0+
 * @link    https://github.com/capwebsolutions.com/dentalimplatns.git/
 */

add_action( 'customize_register', 'dentalimplants_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function dentalimplants_customizer_register() {

	global $wp_customize;

	$images = apply_filters( 'dentalimplants_images', array( '1', '3', '5', '7' ) );

	$wp_customize->add_section( 'dentalimplants-settings', array(
		'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1000 pixels tall</strong>.', 'dentalimplants-infini-pro' ),
		'title'       => __( 'Front Page Background Images', 'dentalimplants-infini-pro' ),
		'priority'    => 35,
	) );

	foreach( $images as $image ) {

		$wp_customize->add_setting( $image .'-dentalimplants-image', array(
			'default'           => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
			'sanitize_callback' => 'esc_url_raw',
			'type'              => 'option',
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $image .'-dentalimplants-image', array(
			'label'    => sprintf( __( 'Featured Section %s Image:', 'dentalimplants-infini-pro' ), $image ),
			'section'  => 'dentalimplants-settings',
			'settings' => $image .'-dentalimplants-image',
			'priority' => $image+1,
		) ) );

	}

	$wp_customize->add_setting(
		'dentalimplants_accent_color',
		array(
			'default'           => dentalimplants_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'dentalimplants_accent_color',
			array(
				'description' => __( 'Change the default color for some links, link hovers, buttons, and button hovers.', 'dentalimplants-infini-pro' ),
				'label'       => __( 'Accent Color', 'dentalimplants-infini-pro' ),
				'section'     => 'colors',
				'settings'    => 'dentalimplants_accent_color',
			)
		)
	);

}
