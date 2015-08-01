<?php
/**
 * The config for woocommerce
 *
 * @version    2.1.6
 */
 
if (class_exists( 'woocommerce' )) {
	global $alterna_options;
	
	global $woocommerce_loop;
	$woocommerce_loop['columns'] = 4;
	
	if(isset($alterna_options['shop-per-page'])){
		// Display 24 products per page. Goes in functions.php
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$alterna_options['shop-per-page'].';' ), 20 );
	}
	
	// Setting shop page image use fancybox lightbox
	if(get_option( 'woocommerce_enable_lightbox' ) != 'yes'){
		update_option( 'woocommerce_enable_lightbox', 'yes');
	}
	
	// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'alterna'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'alterna'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		<?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}