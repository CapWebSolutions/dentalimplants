/**
 * This script adds the jquery effects to the Infinity Pro Theme.
 *
 * @package Infinity\JS
 * @author StudioPress
 * @license GPL-2.0+
 */
/* Sections commented out for hello bar ala sk
 ref: https://sridharkatakam.com/fixed-notice-bar-header-in-infinity-pro/#comment-486535
 */

( function($) {

	var $body         = $( 'body' ),
		$content      = $( '.offscreen-content' ),
		// headerHeight  = $( '.site-header' ).height(),
		// $siteHeader   = $( '.site-header' ),
		headerHeight  = $( '.fixed-header' ).height(),
        $siteHeader   = $( '.fixed-header' ),
		$siteInner    = $( '.site-inner' ),
		sOpen         = false,
		windowHeight  = $(window).height();

	$(document).ready(function() {

		// Match height for content and sidebar.
		$( '.content, .sidebar' ).matchHeight({
			property: 'min-height'
		});

		// Set offscreen container height.
		$( '.offscreen-container' ).css({
			'height': windowHeight + 'px'
		});

		// Toggle the offscreen content.
		$( '.offscreen-content-toggle' ).click(function() {
			__toggleOffscreenContent();
		});

	});

	// Add white class to site container after search icon after 108px on front page only. .
	// if ( $body.hasClass( 'front-page' ) ) {
		$(document).on( 'scroll', function() {
		// Function to toggle the offscreen content.
			if ( $(document).scrollTop() > 108 ) {

				$( '.site-container' ).addClass( 'white' );
				$( '.fa-search' ).addClass( 'white' );
				$( '.search-toggle' ).addClass( 'white' );

			} else {
				$( '.site-container' ).removeClass( 'white' );
				$( '.fa-search' ).removeClass( 'white' );
				$( '.search-toggle' ).removeClass( 'white' );
			}

		});
	// }

	// Push the .site-inner down dependant on the header height.
	if ( ! $body.hasClass( 'front-page' ) ) {

		__repositionSiteHeader( headerHeight, $siteInner );

		$(window).resize(function() {

			// Update header height value.
			headerHeight = $siteHeader.height();
			__repositionSiteHeader( headerHeight, $siteInner );


		});

	}

	// Function to toggle the offscreen content.
	function __toggleOffscreenContent() {

		if (sOpen) {
			$content.fadeOut();
			$body.toggleClass( 'no-scroll' );
			sOpen = false;
		} else {
			$content.fadeIn();
			$body.toggleClass( 'no-scroll' );
			sOpen = true;
		}

	}

	// Function to get the CSS value of the position property of the passed element.
	function __getPositionValue( selector ) {

		var position = $( selector ).css( 'position' );

		return position;

	}

	// Function to position the site header.
	function __repositionSiteHeader( headerHeight, $siteInner ) {
		if ( 'fixed' == __getPositionValue( '.fixed-header' ) ) {
			$siteInner.css( 'margin-top', headerHeight + 'px' );
		} else {
			$siteInner.removeAttr( 'style' );
		}

	}

})(jQuery);
