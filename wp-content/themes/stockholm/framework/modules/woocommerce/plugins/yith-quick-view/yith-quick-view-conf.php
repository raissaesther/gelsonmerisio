<?php

/*************** YITH QUICK VIEW CONTENT FILTERS - begin ***************/

//Override product title
remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'yith_wcqv_product_summary', 'qode_woocommerce_yith_template_single_title', 5 );

//Remove add to cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//Remove deafult actions for product image and add custom
remove_action('yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10);
remove_action('yith_wcqv_product_image', 'woocommerce_show_product_images', 20);
add_action('yith_wcqv_product_image', 'qode_woocommerce_show_product_images', 9);

//Add yith quick view button
//add_action( 'qode_woocommerce_after_product_image', 'qode_woocommerce_quickview_link', 2 );

//Add additional html around single meta
add_action('yith_wcqv_product_summary', 'qode_woocommerce_share_tag_before', 32);
add_action('yith_wcqv_product_summary', 'qode_woocommerce_share_tag_after', 35);

add_action( 'yith_wcqv_product_summary', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 31 );

//Add social share (default woocommerce_share)
add_action( 'yith_wcqv_product_summary', 'qode_woocommerce_share', 32 );

//Remove product meta
remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );


/*************** YITH QUICK VIEW CONTENT FILTERS - end ***************/

