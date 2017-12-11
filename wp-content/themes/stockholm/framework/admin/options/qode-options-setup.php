<?php

add_action('after_setup_theme', 'qode_admin_map_init');
function qode_admin_map_init() {

	do_action('qode_before_options_map');

	require_once(QODE_ROOT_DIR.'/framework/admin/options/general/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/logo/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/header/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/footer/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/title/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/fonts/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/elements/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/sidebar/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/blog/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/portfolio/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/slider/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/social/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/error404/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/contact/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/parallax/map.php');
	require_once(QODE_ROOT_DIR.'/framework/admin/options/contentbottom/map.php');

	if(qode_visual_composer_installed() && version_compare(qode_get_vc_version(), '4.4.2') >= 0) {
		require_once(QODE_ROOT_DIR.'/framework/admin/options/visualcomposer/map.php');
	} else {
		qode_framework()->qodeOptions->addOption("enable_grid_elements","no");
	}
	if(class_exists('GFForms')){
		require_once(QODE_ROOT_DIR.'/framework/admin/options/gravityforms/map.php');
	}
	require_once(QODE_ROOT_DIR.'/framework/admin/options/reset/map.php');

	do_action('qode_options_map');

	do_action('qode_after_options_map');
}