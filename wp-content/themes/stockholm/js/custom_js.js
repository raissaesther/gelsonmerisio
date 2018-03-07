
var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	// Instantiate MixItUp:
	$j( '.filter a' ).click(function( event ) {
	  event.preventDefault();
	});

	var mixer = mixitup('#prod-container');


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
