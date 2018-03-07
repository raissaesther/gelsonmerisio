
var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	// Instantiate MixItUp:
	$j( '.filter a' ).click(function( event ) {
	  event.preventDefault();
	});

	var mixer = mixitup('#prod-container');

	});
