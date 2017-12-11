<?php
/**
 * Options map file
 */

if ( ! function_exists( 'qode_membership_membership_options_map' ) ) {
	/**
	 * Map plugin options
     *
     * @param $page
	 */
	function qode_membership_membership_options_map($page) {

		if ( qode_membership_theme_installed() ) {

			$panel_social_login = qode_add_admin_panel( array(
				'page'  => $page,
				'name'  => 'panel_social_login',
				'title' => esc_html__('Enable Social Login', 'qode-membership')
			) );

			qode_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Social Login', 'qode-membership'),
				'description'   => esc_html__('Enabling this option will allow login from social networks of your choice', 'qode-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qode_panel_enable_social_login'
				),
				'parent'        => $panel_social_login
			) );

			$panel_enable_social_login = qode_add_admin_panel( array(
				'page'            => $page,
				'name'            => 'panel_enable_social_login',
				'title'           => esc_html__('Enable Login via', 'qode-membership'),
				'hidden_property' => 'enable_social_login',
				'hidden_value'    => 'no'
			) );

			qode_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Facebook', 'qode-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Facebook', 'qode-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qode_enable_facebook_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_facebook_social_login_container = qode_add_admin_container( array(
				'name'            => 'enable_facebook_social_login_container',
				'hidden_property' => 'enable_facebook_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			qode_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_facebook_login_fbapp_id',
				'default_value' => '',
				'label'         => esc_html__('Facebook App ID', 'qode-membership'),
				'description'   => esc_html__('Copy your application ID form created Facebook Application', 'qode-membership'),
				'parent'        => $enable_facebook_social_login_container
			) );

			qode_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_google_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Google+', 'qode-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Google+', 'qode-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qode_enable_google_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_google_social_login_container = qode_add_admin_container( array(
				'name'            => 'enable_google_social_login_container',
				'hidden_property' => 'enable_google_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			qode_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_google_login_client_id',
				'default_value' => '',
				'label'         => esc_html__('Client ID', 'qode-membership'),
				'description'   => esc_html__('Copy your Client ID form created Google Application', 'qode-membership'),
				'parent'        => $enable_google_social_login_container
			) );

		}

	}

	add_action( 'qode_themename_action_social_options', 'qode_membership_membership_options_map' );

}
