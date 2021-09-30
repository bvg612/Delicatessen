<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search product&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>">
	<span class="wpisset-header-search-btn-horizontal-lines"></span>
	<span class="wpisset-header-search-btn-vertical-lines"></span>
	<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg"><g transform="scale(0.75)"><path fill="%23000" d="M48,46.59l-18.35,-18.36l1.42674e-08,-1.60484e-08c6.23812,-7.01685 5.60685,-17.7621 -1.41,-24.0002c-7.01685,-6.23812 -17.7621,-5.60685 -24.0002,1.41c-6.23812,7.01685 -5.60685,17.7621 1.41,24.0002c6.44136,5.7265 16.1489,5.7265 22.5902,-2.85348e-08l18.35,18.36Zm-46.06,-29.59l-4.79828e-10,0.000117736c1.25089e-06,-8.28427 6.71573,-15 15,-15c8.28427,1.25089e-06 15,6.71573 15,15c-1.24735e-06,8.2608 -6.67915,14.9668 -14.9399,14.9999l8.56671e-07,-1.35216e-11c-8.29408,0.000131139 -15.0271,-6.70599 -15.0601,-15Z"></path></g></svg>
	<!-- <i class="fa fa-search"></i> -->
</button>
	<input type="hidden" name="post_type" value="product" />

</form>
