
var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	
$j(document).ready(function() {
	"use strict";

var maxHeight = 0;

$j('.mix a').each(function(){
   var thisH = $j(this).height();
   if (thisH > maxHeight) { maxHeight = thisH; }
});

$j('.mix a' ).height(maxHeight);

	$j( '.filter a' ).click(function( event ) {
		event.preventDefault();
	});


	$j('.open-popup-link').magnificPopup({
		type: 'inline',
		gallery: {
			// options for gallery
			enabled: true
		}
	});

	$j(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$j.magnificPopup.close();
	});



});
// Instantiate MixItUp:

var containerEl = document.querySelector('#prod-container');
var mixer;
var initialFilter = 'all';

if (containerEl) {
	mixer = mixitup(containerEl, {
		animation: {
			enable: true,
			easing: 'ease-in-out'
		},
		load: {
			 filter: initialFilter
	 }

	});
}
});
