<?php

namespace QodeRestaurant\CPT\RestaurantMenu\Shortcodes\RestaurantMenuList;

use QodeRestaurant\Lib;

/**
 * Class RestaurantMenuList
 * @package QodeRestaurant\CPT\RestaurantMenu\Shortcodes
 */
class RestaurantMenuList implements Lib\ShortcodeInterface {
	/**
     * @var string
     */
	private $base;

	public function __construct() {
		$this->base = 'qode_restaurant_menu_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map
     */
	public function vcMap() {
		if(function_exists('vc_map')) {

			vc_map(array(
				'name'                      => esc_html__('Restaurant Menu List', 'qode-restaurant'),
				'base'                      => $this->getBase(),
				'category'                  => esc_html__('by SELECT RESTAURANT', 'qode-restaurant'),
				'icon'                      => 'icon-wpb-restaurant-menu extended-custom-icon-qode',
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Show Featured Image?', 'qode-restaurant'),
						'param_name'  => 'show_featured_image',
						'value'       => array(
							''    => '',
							esc_html__('Yes', 'qode-restaurant') => 'yes',
							esc_html__('No', 'qode-restaurant')  => 'no'
						),
						'admin_label' => true,
						'description' => esc_html__('Use this option to show featured image of menu items', 'qode-restaurant'),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Title Tag', 'qode-restaurant'),
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						)
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Skin', 'qode-restaurant'),
						'param_name'  => 'skin',
						'value'       => array(
							esc_html__('Dark', 'qode-restaurant') 	 => 'dark',
							esc_html__('Light', 'qode-restaurant')  => 'light'
						),
						'admin_label' => true,
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Order By', 'qode-restaurant'),
						'param_name'  => 'order_by',
						'value'       => array(
							esc_html__('Menu Order', 'qode-restaurant') => 'menu_order',
							esc_html__('Title', 'qode-restaurant')      => 'title',
							esc_html__('Date', 'qode-restaurant')       => 'date'
						),
						'admin_label' => true,
						'save_always' => true,
						'description' => '',
						'group'       => esc_html__('Query and Layout Options', 'qode-restaurant')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Order', 'qode-restaurant'),
						'param_name'  => 'order',
						'value'       => array(
							'ASC'  => 'ASC',
							'DESC' => 'DESC',
						),
						'admin_label' => true,
						'save_always' => true,
						'description' => '',
						'group'       => esc_html__('Query and Layout Options', 'qode-restaurant')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Restaurant Menu Category', 'qode-restaurant'),
						'param_name'  => 'restaurant_menu_category',
						'value'       => '',
						'admin_label' => true,
						'description' => esc_html__('Enter one cafe menu category slug (leave empty for showing all cafe menu categories)', 'qode-restaurant'),
						'group'       => esc_html__('Query and Layout Options', 'qode-restaurant')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Number of Restaurant Menu Items', 'qode-restaurant'),
						'param_name'  => 'number',
						'value'       => '-1',
						'admin_label' => true,
						'save_always' => true,
						'description' => esc_html__('(enter -1 to show all)', 'qode-restaurant'),
						'group'       => esc_html__('Query and Layout Options', 'qode-restaurant')
					)
				)
			));
		}
	}

	/**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
	public function render($atts, $content = null) {
		$args = array(
			'show_featured_image' 	=> '',
			'order_by'     			=> 'date',
			'order'        			=> 'ASC',
			'restaurant_menu_category'	=> '',
			'number'      			=> '-1',
			'title_tag'				=> 'h3',
			'skin'					=> 'dark'
		);

		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);

		$listItemParams = array(
			'show_featured_image'	=> $params['show_featured_image'],
			'title_tag'				=> $params['title_tag']
		);

		$holderClasses = $this->getHolderClasses($params);

		$html = '<div '.qode_get_class_attribute($holderClasses).'>';

		if($query_results->have_posts()) {
			$html .= '<ul class="qode-rml-holder">';

			while($query_results->have_posts()) {
				$query_results->the_post();
				$html .= qode_restaurant_get_shortcode_module_template_part('restaurant-menu', 'templates/restaurant-menu-list-item', '', $listItemParams);
			}

			$html .= '</ul>';

			wp_reset_postdata();
		} else {
			$html .= '<p>'.esc_html__('Sorry, no menu items matched your criteria.', 'qode-restaurant').'</p>';
		}

		$html .= '</div>';

		return $html;
	}

	/**
    * Generates menu list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		
		$query_array = array(
			'post_type' => 'qode-restaurant-menu',
			'orderby' =>$params['order_by'],
			'order' => $params['order'],
			'posts_per_page' => $params['number']
		);
		
		if(!empty($params['restaurant_menu_category'])){
			$query_array['qode-restaurant-menu-category'] = $params['restaurant_menu_category'];
		}
		
		return $query_array;
	}

	private function getHolderClasses($params) {
		$classes = array('qode-restaurant-menu-list');

		if($params['show_featured_image'] === 'yes') {
			$classes[] = 'qode-rml-with-featured-image';
		}

		if($params['skin'] === 'light') {
			$classes[] = 'qode-rml-light';
		}

		return $classes;
	}

}