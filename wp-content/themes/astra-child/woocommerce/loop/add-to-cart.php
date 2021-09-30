<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
echo '<div class="button-wrapper">';
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="product_type_simple add_to_cart_button ajax_add_to_cart" %s><img src="%s"  width="16" height="16"></i></a>',
		esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_url( get_site_url().'/source/Images/bascet.svg')
		
	),
	$product,
	$args
);
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" class="heart"><img src="%s"  width="16" height="16"></i></a>',
		esc_url( get_site_url().'/wishlist' ),
		esc_url( get_site_url().'/source/Images/heart.svg')
	),
	$product,
	$args
);
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" class="heart"><img src="%s"  width="16" height="16">
		</a>',
		esc_url( get_site_url().'/product/'.$product->get_slug() ),
		esc_url( get_site_url().'/source/Images/eye.svg')
	
	),
	$product,
	$args
);

echo '</div>';
