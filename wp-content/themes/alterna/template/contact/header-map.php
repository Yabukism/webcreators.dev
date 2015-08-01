<?php
/**
 * Contact Template > header google map
 *
 * @since alterna 7.0
 */
if(penguin_get_post_meta_key('map-show') == "on") {
	$map_height = intval(penguin_get_post_meta_key('map-height'));
	if($map_height == 0){ $map_height = '320';}
	echo do_shortcode('[map width="100%" height="'.esc_attr($map_height).'" latlng="'.esc_attr(penguin_get_post_meta_key('map-latlng')).'" theme="'.esc_attr(penguin_get_post_meta_key('contact-map-theme')).'" scrollwheel="no" show_marker="yes" show_info="yes" info_width="300"]'.penguin_get_post_meta_key('map-address').'[/map]'); 
}