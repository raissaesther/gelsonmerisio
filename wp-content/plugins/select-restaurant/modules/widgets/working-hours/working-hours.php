<?php

class QodeRestaurantWorkingHoursWidget extends QodeRestaurantWidget {
	public function __construct() {
		parent::__construct(
			'qode_working_hours_widget',
			esc_html__( 'Select Restaurant Working Hours', 'themenametd' ),
			array( 'description' => esc_html__( 'Add a working hours element to your widget areas', 'qode-restaurant' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'qode-restaurant' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'items_title_tag',
				'title'   => esc_html__( 'Items Title Tag', 'qode-restaurant' ),
				'options' => array(
					''		=> esc_html__( '', 'qode-restaurant' ),
					'h2'	=> esc_html__( 'h2', 'qode-restaurant' ),
					'h3'	=> esc_html__( 'h3', 'qode-restaurant' ),
					'h4'	=> esc_html__( 'h4', 'qode-restaurant' ),
					'h5'	=> esc_html__( 'h5', 'qode-restaurant' ),
					'h6'	=> esc_html__( 'h6', 'qode-restaurant' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'qode-restaurant' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		echo $args['before_widget'];
		if ( ! empty( $instance['widget_title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		}
		echo '<div class="qode-working-hours-widget">';
			echo do_shortcode( "[qode_working_hours $params]" ); // XSS OK
		echo '</div>';

		echo $args['after_widget'];
	}
}