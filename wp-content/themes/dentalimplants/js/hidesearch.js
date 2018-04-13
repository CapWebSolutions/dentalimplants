/*
* Toggles Search Field on and off for twenty fourteen style search in Genesis
* Used by twentyfourteen-style search bar. 
*
*/
jQuery(document).ready(function($){
	$(".search-toggle").click(function() {
		$("#search-container").slideToggle('fast', function(){
			$(".search-toggle").toggleClass('active');
		});

	});
});