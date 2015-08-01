<?php

global $alterna_options, $google_custom_fonts, $options_custom_color, $theme_customize_list, $woocommerce_customize_list;

if($google_custom_fonts == null){
	alterna_get_custom_font();
}

if(penguin_get_options_key('custom-enable-color') == "on"){
 // setting colors
 foreach($options_custom_color as $key => $value){
	 if(isset($alterna_options[$key])){
		 $current_colors[$key] = '#'.$alterna_options[$key];
	 }else{
		 $current_colors[$key] = '#'.$value;
	 }
 }
}else{
	$current_colors['theme-color'] = '#7ab80e';
}

$theme_customize_list['url']							= '"'.get_template_directory_uri().'/img"';

if(intval(penguin_get_options_key('global-layout-width')) >= 970 && intval(penguin_get_options_key('global-layout-width')) <= 1170){
	$theme_customize_list['wrapper_width']					= intval(penguin_get_options_key('global-layout-width')).'px';
}

if(intval(penguin_get_options_key('global-layout')) == 0){
	$theme_customize_list['boxed_layout_padding']			= intval(penguin_get_options_key('global-layout-boxed-padding')).'px';
}

$theme_customize_list['wrapper_width']					= intval(penguin_get_options_key('global-layout-width')).'px';

$theme_customize_list['header_logo_padding_top']					= intval(penguin_get_options_key('logo-image-padding-top')).'px';
$theme_customize_list['header_right_content_padding_top']			= intval(penguin_get_options_key('header-right-area-padding-top')).'px';

// fixed logo
if(penguin_get_options_key('fixed-enable') == "on"){
	$theme_customize_list['fixed_logo_width']		= intval(penguin_get_options_key('fixed-logo-image-width')).'px';
	$theme_customize_list['fixed_logo_img']			= '"'.penguin_get_options_key('fixed-logo-image').'"';
	$theme_customize_list['fixed_logo_img_retina']	= '"'.penguin_get_options_key('fixed-logo-retina-image').'"';
}

// custom font
if(penguin_get_options_key('custom-enable-font') == "on"){
	$theme_customize_list['body_family']					= $google_custom_fonts['general_font'].',Helvetica,Arial,sans-serif';
	$theme_customize_list['body_font_size']					= penguin_get_options_key('custom-general-font-size').'px';
	$theme_customize_list['h_family']						= $google_custom_fonts['title_font'].',Helvetica,Arial,sans-serif';
	$theme_customize_list['menu_family']					= $google_custom_fonts['menu_font'].',Helvetica,Arial,sans-serif';
	$theme_customize_list['menu_size']						= penguin_get_options_key('custom-menu-font-size').'px';
}

// custom color
if(penguin_get_options_key('custom-enable-color') == "on"){

	$theme_customize_list['theme_color']	= $current_colors['theme-color'];
	$theme_customize_list['body_color']		= $current_colors['custom-general-color'];
	$theme_customize_list['links_color']	= $current_colors['custom-links-color'];
	$theme_customize_list['links_color_hover']	= $current_colors['custom-links-hover-color'];
	$theme_customize_list['h_color']		= $current_colors['custom-h-color'];
	
	$theme_customize_list['menu_color']								= $current_colors['custom-menu-font-color'];
	$theme_customize_list['menu_color_hover']						= $current_colors['custom-menu-hover-font-color'];
	$theme_customize_list['menu_background_color']					= $current_colors['custom-menu-background-color'];
	$theme_customize_list['menu_background_color_hover']			= $current_colors['custom-menu-background-hover-color'];
	$theme_customize_list['menu_border_bottom_color']				= $current_colors['custom-menu-border-bottom-color'];
	$theme_customize_list['sub_menu_color']							= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['sub_menu_color_hover']					= $current_colors['custom-sub-menu-hover-font-color'];
	$theme_customize_list['sub_menu_background_color']				= $current_colors['custom-sub-menu-background-color'];
	$theme_customize_list['sub_menu_background_color_hover']		= $current_colors['custom-sub-menu-hover-background-color'];
	$theme_customize_list['sub_menu_border_top_color']				= $current_colors['custom-sub-menu-hover-border-top-color'];
	$theme_customize_list['sub_menu_border_bottom_color']			= $current_colors['custom-sub-menu-hover-border-bottom-color'];
	// style 2
	$theme_customize_list['menu_style_2_border_bottom_color']		= $current_colors['custom-menu-border-bottom-color'];
	$theme_customize_list['menu_style_2_color']						= $current_colors['custom-menu-font-color'];
	$theme_customize_list['menu_style_2_sub_menu_color']			= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['menu_style_2_menu_background_color']		= $current_colors['custom-menu-background-color'];
	// style 3
	$theme_customize_list['menu_style_3_border_bottom_color']		= $current_colors['custom-menu-border-bottom-color'];
	$theme_customize_list['menu_style_3_color']						= $current_colors['custom-menu-font-color'];
	$theme_customize_list['menu_style_3_sub_menu_color']			= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['menu_style_3_menu_background_color']		= $current_colors['custom-menu-background-color'];
	// style 4
	$theme_customize_list['menu_style_4_border_bottom_color']		= $current_colors['custom-menu-border-bottom-color'];
	$theme_customize_list['menu_style_4_color']						= $current_colors['custom-menu-font-color'];
	$theme_customize_list['menu_style_4_color_hover']				= $current_colors['custom-menu-hover-font-color'];
	$theme_customize_list['menu_style_4_background_color_hover']	= $current_colors['custom-menu-background-hover-color'];
	$theme_customize_list['menu_style_4_sub_menu_color']			= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['menu_style_4_sub_menu_background_color']	= $current_colors['custom-sub-menu-background-color'];
	$theme_customize_list['menu_style_4_sub_menu_background_color_hover']			= $current_colors['custom-sub-menu-hover-background-color'];
	$theme_customize_list['menu_style_4_sub_menu_border_top_color']	= $current_colors['custom-sub-menu-hover-border-top-color'];
	$theme_customize_list['menu_style_4_sub_menu_border_bottom_color']			= $current_colors['custom-sub-menu-hover-border-bottom-color'];	
	// style 5
	$theme_customize_list['menu_style_5_border_bottom_color']					= $current_colors['custom-menu-border-bottom-color'];	
	$theme_customize_list['menu_style_5_color']									= $current_colors['custom-menu-font-color'];	
	$theme_customize_list['menu_style_5_color_hover']							= $current_colors['custom-menu-hover-font-color'];	
	$theme_customize_list['menu_style_5_sub_menu_background_color']				= $current_colors['custom-sub-menu-background-color'];	
	$theme_customize_list['menu_style_5_sub_menu_background_color_hover']		= $current_colors['custom-sub-menu-hover-background-color'];	
	$theme_customize_list['menu_style_5_sub_menu_border_bottom_color']			= $current_colors['custom-sub-menu-hover-border-bottom-color'];	
	// style 6
	$theme_customize_list['menu_style_6_sub_menu_color']			= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['menu_style_6_sub_menu_color_hover']			= $current_colors['custom-sub-menu-hover-font-color'];
	$theme_customize_list['menu_style_6_sub_menu_background_color']	= $current_colors['custom-sub-menu-background-color'];
	$theme_customize_list['menu_style_6_sub_menu_background_color_hover']			= $current_colors['custom-sub-menu-hover-background-color'];
	// style 7
	$theme_customize_list['menu_style_7_background_color']					= $current_colors['custom-menu-background-color'];
	$theme_customize_list['menu_style_7_background_color_hover']			= $current_colors['custom-menu-background-hover-color'];
	$theme_customize_list['menu_style_7_sub_menu_color']			= $current_colors['custom-sub-menu-font-color'];
	$theme_customize_list['menu_style_7_sub_menu_color_hover']			= $current_colors['custom-sub-menu-hover-font-color'];
	$theme_customize_list['menu_style_7_sub_menu_background_color']	= $current_colors['custom-sub-menu-background-color'];
	$theme_customize_list['menu_style_7_sub_menu_background_color_hover']			= $current_colors['custom-sub-menu-hover-background-color'];

	
	$theme_customize_list['mobile_menu_background_color']				= $current_colors['custom-mobile-menu-background-color'];	
	$theme_customize_list['mobile_2_level_menu_background_color']				= $current_colors['custom-mobile-2-level-menu-background-color'];	
	$theme_customize_list['mobile_3_level_menu_background_color']				= $current_colors['custom-mobile-3-level-menu-background-color'];	
	$theme_customize_list['mobile_menu_color']				= $current_colors['custom-mobile-menu-font-color'];	
	$theme_customize_list['mobile_menu_color_hover']				= $current_colors['custom-mobile-menu-hover-font-color'];	
	$theme_customize_list['mobile_icon_color']				= $current_colors['custom-mobile-icon-color'];	
	$theme_customize_list['mobile_icon_border_color']				= $current_colors['custom-mobile-icon-border-color'];	
	$theme_customize_list['mobile_menu_top_border_color']				= $current_colors['custom-mobile-menu-top-border-color'];	
	
	$theme_customize_list['mobile_menu_background_color_2']				= $current_colors['custom-mobile-menu-background-color'];	
	$theme_customize_list['mobile_2_level_menu_background_color_2']				= $current_colors['custom-mobile-2-level-menu-background-color'];	
	$theme_customize_list['mobile_3_level_menu_background_color_2']				= $current_colors['custom-mobile-3-level-menu-background-color'];	
	$theme_customize_list['mobile_menu_color_2']				= $current_colors['custom-mobile-menu-font-color'];	
	$theme_customize_list['mobile_menu_color_hover_2']				= $current_colors['custom-mobile-menu-hover-font-color'];	
	$theme_customize_list['mobile_icon_color_2']				= $current_colors['custom-mobile-icon-color'];	
	$theme_customize_list['mobile_icon_border_color_2']				= $current_colors['custom-mobile-icon-border-color'];	
	$theme_customize_list['mobile_menu_top_border_color_2']				= $current_colors['custom-mobile-menu-top-border-color'];
	
	$theme_customize_list['header_banner_color']	= $current_colors['custom-header-banner-text-color'];
	$theme_customize_list['header_banner_links_color']	= $current_colors['custom-header-banner-links-color'];
	$theme_customize_list['header_banner_links_color_hover']	= $current_colors['custom-header-banner-links-hover-color'];
	$theme_customize_list['header_banner_background_color']	= $current_colors['custom-header-banner-bg-color'];
	
	$theme_customize_list['header_topbar_background_color']	= $current_colors['custom-header-topbar-bg-color'];
	$theme_customize_list['header_topbar_sub_menu_background_color']	= $current_colors['custom-header-topbar-sub-menu-hover-bg-color'];
	$theme_customize_list['header_topbar_border_color']	= $current_colors['custom-header-topbar-border-color'];
	$theme_customize_list['header_topbar_links_color']	= $current_colors['custom-header-topbar-hover-font-color'];
	$theme_customize_list['header_topbar_links_color_hover']	= $current_colors['custom-header-topbar-hover-font-color'];
	
	$theme_customize_list['footer_color']	= $current_colors['custom-footer-text-color'];
	$theme_customize_list['footer_links_color']	= $current_colors['custom-footer-links-color'];
	$theme_customize_list['footer_links_color_hover']	= $current_colors['custom-footer-links-hover-color'];
	$theme_customize_list['footer_h_color']	= $current_colors['custom-footer-h-color'];
	$theme_customize_list['footer_bottom_color']	= $current_colors['custom-footer-bottom-color'];
	$theme_customize_list['footer_bottom_links_color']	= $current_colors['custom-footer-bottom-links-color'];
	$theme_customize_list['footer_bottom_links_color_hover']	= $current_colors['custom-footer-bottom-links-hover-color'];
	
	$theme_customize_list['footer_banner_color']	= $current_colors['custom-footer-banner-text-color'];
	$theme_customize_list['footer_banner_links_color']	= $current_colors['custom-footer-banner-links-color'];
	$theme_customize_list['footer_banner_links_color_hover']	= $current_colors['custom-footer-banner-links-hover-color'];
	$theme_customize_list['footer_banner_background_color']	= $current_colors['custom-footer-banner-bg-color'];
}


//WooCommerce
if (class_exists( 'woocommerce' )) { 
	$woocommerce_customize_list['url']					=  '"'.get_template_directory_uri().'/woocommerce/assets"';
	
	if(penguin_get_options_key('custom-enable-color') == "on"){
		$woocommerce_customize_list['theme_color']	= $current_colors['theme-color'];
	}
}
?>