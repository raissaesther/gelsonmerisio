<?php

if ( ! function_exists( 'qode_restaurant_register_working_hours_widget' ) ) {
	/**
	 * Function that register working hours widget
	 */
	function qode_restaurant_register_working_hours_widget( $widgets ) {
		$widgets[] = 'QodeRestaurantWorkingHoursWidget';
		
		return $widgets;
	}
	
	add_filter( 'qode_restaurant_filter_register_widgets', 'qode_restaurant_register_working_hours_widget' );
}