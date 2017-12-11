<?php
if ( ! function_exists( 'qode_restaurant_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function qode_restaurant_load_widget_class() {
		include_once QODE_RESTAURANT_ABS_PATH . '/modules/widgets/lib/widget-class.php';
	}

	add_action( 'qode_before_options_map', 'qode_restaurant_load_widget_class' );
}

if ( ! function_exists( 'qode_restaurant_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to qodef_themename_action_after_options_map action
	 */
	function qode_restaurant_load_widgets() {

		foreach ( glob( QODE_RESTAURANT_ABS_PATH . '/modules/widgets/*/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}

		include_once QODE_RESTAURANT_ABS_PATH . '/modules/widgets/lib/widget-loader.php';
	}

	add_action( 'qode_before_options_map', 'qode_restaurant_load_widgets' );
}