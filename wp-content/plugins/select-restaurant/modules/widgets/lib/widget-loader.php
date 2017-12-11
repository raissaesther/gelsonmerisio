<?php

if ( ! function_exists( 'qode_restaurant_register_widgets' ) ) {
	function qode_restaurant_register_widgets() {
		$widgets = apply_filters( 'qode_restaurant_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'qode_restaurant_register_widgets' );
}