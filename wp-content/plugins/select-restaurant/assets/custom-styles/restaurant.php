<?php

if (!function_exists('qode_restaurant_style') && qode_restaurant_theme_installed()) {
    function qode_restaurant_style()
    {

        if (qode_options()->getOptionValue('first_color') !== '') {
            echo qode_dynamic_css('.qode-working-hours-holder .qode-wh-title .qode-wh-title-accent-word,
                                    #ui-datepicker-div .ui-datepicker-current-day:not(.ui-datepicker-today) a', array(
                'color' => qode_options()->getOptionValue('first_color')
            ));
            echo qode_dynamic_css('#ui-datepicker-div .ui-datepicker-today', array(
                'background-color' => qode_options()->getOptionValue('first_color')
            ));
        }

    }

    add_action('qode_style_dynamic', 'qode_restaurant_style');
}