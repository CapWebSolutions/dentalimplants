<?php 
/**
 * Create a twenty fourteen styler flyout search in Genesis
 * @link: https://wpbeaches.com/adding-fly-search-field-box-genesis-based-twentyfourteen/
 * 
 */


//Allow PHP to run in Widgets
function genesis_execute_php_widgets( $html ) {
	if ( strpos( $html, "<" . "?php" ) !==false ) {
	ob_start();
	eval( "?".">".$html );
	$html=ob_get_contents();
	ob_end_clean();
		}
	return $html;
}
add_filter( 'widget_text','genesis_execute_php_widgets' );

//Add in new Search Widget areas
function dentalimplants_extra_widgets() {	
	genesis_register_sidebar( array(
	'id'            => 'search',
	'name'          => __( 'Search', 'dentalimplants-infini-pro' ),
	'description'   => __( 'This is the Search toggle area', 'dentalimplants-infini-pro' ),
	'before_widget' => '<div class="search">',
	'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'dentalimplants_extra_widgets' );


//Position the Search Area
function dentalimplants_search_widget() {
	genesis_widget_area ( 'search', array( 
	'before' => '<div id="search-form-container">',
	'after'  => '</div>',));
}
add_action( 'genesis_after_header','dentalimplants_search_widget' );

function custom_nav_item( $menu, stdClass $args ){
    // make sure we are in the primary menu
    if ( 'primary' != $args->theme_location )

        return $menu;   
		// $menu  .= '</ul><ul class="search-form-container"><div class="search-toggle"><i class="dashicons dashicons-search"></i>
		$menu  .= '</ul><ul class="search-form-container"><div class="search-toggle"><i class="fa fa-search"></i>
				<a href="#search-container" class="screen-reader-text"></a>
				</div>'; 
        return $menu; 
}
add_filter( 'wp_nav_menu_items', 'custom_nav_item', 10, 2 );
