/*
* Toggles Search Field on and off for twenty fourteen style search in Genesis
*
*/
jQuery(document).ready(function($){
	$(".search-toggle").click(function() {
		$("#search-container").slideToggle('slow', function(){
			$(".search-toggle").toggleClass('active');
		});

	});
});