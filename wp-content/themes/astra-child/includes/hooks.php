<?php

add_filter('woocommerce_get_price_html', 'cbs_simpe_product_price', 10, 2);

function cbs_simpe_product_price($price, $product) {

	// _sd($product);exit;

	$woocommerce_price_thousand_sep = get_option('woocommerce_price_thousand_sep');
	$woocommerce_price_decimal_sep  = get_option('woocommerce_price_decimal_sep');
	$woocommerce_price_num_decimals = get_option('woocommerce_price_num_decimals');
	$woocommerce_price_num_decimals = ($woocommerce_price_num_decimals != '') ? $woocommerce_price_num_decimals : 2;

	if ($product->get_type() == 'simple') {
		$product_price 		= number_format((float)$product->get_regular_price(), $woocommerce_price_num_decimals, $woocommerce_price_decimal_sep, $woocommerce_price_thousand_sep);
	} else {
		$product_price 		= number_format((float)$product->get_price(), $woocommerce_price_num_decimals, $woocommerce_price_decimal_sep, $woocommerce_price_thousand_sep);
	}
	
	$product_sale_price = number_format((float)$product->get_sale_price(), $woocommerce_price_num_decimals, $woocommerce_price_decimal_sep, $woocommerce_price_thousand_sep);

	if ($product_sale_price && $product_sale_price != '0' . $woocommerce_price_decimal_sep . '00') {
		$product_sale_price_array = explode($woocommerce_price_decimal_sep, $product_sale_price);
	}

	$product_price_array = explode($woocommerce_price_decimal_sep, $product_price);

	ob_start();

	?>

		<?php if ($product_sale_price && $product_sale_price != '0' . $woocommerce_price_decimal_sep . '00'): ?>
			<ins>
				<span class="woocommerce-Price-amount amount cbs-style">
					<?= $product_sale_price_array[0] ?>
					<span class="precision"><?= ',' . $product_sale_price_array[1] ?></span>
					<span class="currency"><?= get_woocommerce_currency_symbol() ?></span>
				</span>
			</ins>
			<del>
				<span class="woocommerce-Price-amount amount cbs-style">
					<?= $product_price_array[0] ?>
					<span class="precision"><?= ',' . $product_price_array[1] ?></span>
					<span class="currency"><?= get_woocommerce_currency_symbol() ?></span>
				</span>
			</del>
		<?php else: ?>
			<span class="woocommerce-Price-amount amount cbs-style">
				<?= $product_price_array[0] ?>
				<span class="precision"><?= ',' . $product_price_array[1] ?></span>
				<span class="currency"><?= get_woocommerce_currency_symbol() ?></span>
			</span>
		<?php endif; ?>

	<?php

	$price_html = ob_get_contents();
	ob_end_clean();

	return $price_html;

}