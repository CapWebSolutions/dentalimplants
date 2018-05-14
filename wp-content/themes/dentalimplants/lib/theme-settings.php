<?php
/**
 * Dental Implants  Settings
 *
 * This file registers all of Dental Implants specific Theme Settings, accessible from
 * Genesis --> Dental Implants Settings.
 *
 */ 
 
/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package dentalimplants
 * @subpackage Dental_Implants_Settings
 */
class Dental_Implants_Settings extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {
		
		// Specify a unique page ID. 
		$page_id = 'dentalimplants';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Dental Implants Settings', 'dentalimplants' ),
				'menu_title'  => __( 'Dental Implants Settings', 'dentalimplants' ),
				'capability' => 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', 'dentalimplants-settings' );
		$settings_field = 'dentalimplants-settings';
		
		// Set the default values
		$default_settings = array(
			'dentalimplants_section1_video' => CHILD_THEME_IMAGES . '/sample-video.mp4',
			'dentalimplants_section1_video_embed' => '',
			'dentalimplants_header_image' =>  CHILD_THEME_IMAGES . '/bg-nav.jpg',
			);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
			
	// Media uploader
		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
			
	}


	/** 
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */	
	function sanitization_filters() {
					
		genesis_add_option_filter( 'safe_html', $this->settings_field,
			array(
				'dentalimplants_section1_video',
				'dentalimplants_section1_video_embed',
				'dentalimplants_header_image',
			) );
	}
	
	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {
		add_meta_box('dentalimplants_home_video_metabox', 'Front Page Video Settings', array( $this, 'dentalimplants_home_video_metabox' ), $this->pagehook, 'main', 'high');
		add_meta_box('dentalimplants_top_image_metabox', 'Interior Page Full Background Image', array( $this, 'dentalimplants_top_image_metabox' ), $this->pagehook, 'main', 'high');
		// add_meta_box('dentalimplants_footer_info_metabox', 'Footer Info', array( $this, 'dentalimplants_footer_info_metabox' ), $this->pagehook, 'main', 'high');
	}
	
	
	/**
	 * Homepage Video Metabox
	 * @since 1.0.0
	 */
	function dentalimplants_home_video_metabox() {
	
	echo '<p><strong>Video URL:</strong> <em>.mp4 format</em></p>';
	echo '<p><input type="text" name="' . $this->get_field_name( 'dentalimplants_section1_video' ) . '" id="' . $this->get_field_id( 'dentalimplants_section1_video' ) . '" value="' . esc_attr( $this->get_field_value( 'dentalimplants_section1_video' ) ) . '" size="70" /></p>';
	
	echo '<p><strong>Youtube Video ID:</strong><br/>';
	echo '<em>Ex: Ybn5eiUfCTk.</em></p>';
		echo '<p><input type="text" name="' . $this->get_field_name( 'dentalimplants_section1_video_embed' ) . '" id="' . $this->get_field_id( 'dentalimplants_section1_video_embed' ) . '" value="' . esc_attr( $this->get_field_value( 'dentalimplants_section1_video_embed' ) ) . '" size="70" /></p>';
	
	// echo '<p><strong>Poster Image URL:</strong> <em>size: 1280 x 720px</em></p>';
	// echo '<p><input type="text" name="' . $this->get_field_name( 'dentalimplants_section1_video_poster' ) . '" id="' . $this->get_field_id( 'dentalimplants_section1_video_poster' ) . '" value="' . esc_attr( $this->get_field_value( 'dentalimplants_section1_video_poster' ) ) . '" size="70" /><input class="upload_image_button button button-primary" type="button" value="Upload Image" /></p>';

	}
	
	/**
	 * Top Image Metabox
	 * @since 1.0.0
	 */
	function dentalimplants_top_image_metabox() {
	
	echo '<p><strong>Header Image URL:</strong> <em>size: 1256 x 210px</em></p>';
	echo '<p><input type="text" name="' . $this->get_field_name( 'dentalimplants_header_image' ) . '" id="' . $this->get_field_id( 'dentalimplants_header_image' ) . '" value="' . esc_attr( $this->get_field_value( 'dentalimplants_header_image' ) ) . '" size="70" /><input class="upload_image_button button button-primary" type="button" value="Upload Image" /></p>';

	}
	
}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function dentalimplants_add_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new Dental_Implants_Settings;	 	
}
add_action( 'genesis_admin_menu', 'dentalimplants_add_settings' );

