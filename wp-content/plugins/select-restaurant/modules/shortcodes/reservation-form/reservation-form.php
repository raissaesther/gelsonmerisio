<?php
namespace QodeRestaurant\Shortcodes\ReservationForm;

use QodeRestaurant\Lib\ShortcodeInterface;

class ReservationForm implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'qode_reservation_form';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Reservation Form', 'qode-restaurant'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by SELECT RESTAURANT', 'qode-restaurant'),
			'icon'                      => 'icon-wpb-reservation-form extended-custom-icon-qode',
			'params'					=> array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('OpenTable ID', 'qode-restaurant'),
					'param_name'  => 'open_table_id',
					'admin_label' => true
				)
			)

		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'open_table_id' => ''
		);

		$params = shortcode_atts($default_atts, $atts);

		return qode_restaurant_get_template_part('modules/shortcodes/reservation-form/templates/reservation-form', '', $params, true);
	}

}