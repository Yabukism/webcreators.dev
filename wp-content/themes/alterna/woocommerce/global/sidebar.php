<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(is_single()){
	$sidebar_name = penguin_get_post_meta_key('sidebar-type');
}else{
	$shop_page_id = woocommerce_get_page_id( 'shop' );
	$sidebar_name = penguin_get_post_meta_key( 'sidebar-type', $shop_page_id);
}

if($sidebar_name == "Global Sidebar" || $sidebar_name == ""){
	dynamic_sidebar('shop');
}else{
	dynamic_sidebar($sidebar_name);
}