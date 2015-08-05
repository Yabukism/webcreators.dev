<?php
include_once ('penguin/tinymce/tinymce.php');

//=============================
// Title
//=============================
function alterna_title_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text'		=>	'Title',
		  'icon'		=>	'',
		  'icon_color'	=>	'',
		  'size' 		=>	'h3',
		  'align'		=>	'left',
		  'line'		=>	'yes',
		  'uppercase'	=>	'no',
		  'bold'		=>	'no',
		  'type'		=>	'default',
		  ), $atts ) );
	
	if($icon_color == 'theme' || $icon_color == ''){
		$icon_color = 'btn-theme';
	}
	
	if($type == 'old'){
		$title_content = '<'.esc_attr($size).' class="'.esc_attr($align).' '.($uppercase == "yes" ? "uppercase" : "").' '.($bold == "yes" ? "bold" : "").'">'.($icon != '' ? '<i class="fa '.$icon.'"></i>' : '' ).esc_html($text).'</'.esc_attr($size).'>';
		return '<div class="alterna-title">'.$title_content.'<div class="line"><span class="left-line"></span><span class="right-line"></span></div></div><div class="clear"></div>';
	}
	
	
	$output = '<div class="alterna-sc-title '.esc_attr($align).'"><div class="row"><div class="col-md-12">';
	$output .= '<div class="alterna-sc-title-container"><'.esc_attr($size).' class="alterna-sc-entry-title '.($uppercase == "yes" ? "uppercase" : "").' '.($bold == "yes" ? "bold" : "").'">';
	if($icon != ''){
		$output .= '<span class="alterna-sc-title-icon '.esc_attr($icon_color).'"><i class="fa '.esc_attr($icon).'"></i></span>';
	}
	
	$output .= esc_html($text).'</'.esc_attr($size).'>';
	
	if($line == "yes"){
		$output .= '<div class="alterna-sc-title-line"></div>';
	}
	
	$output .= '</div>';
	
	$output .= '</div></div></div>';
	return $output;
}
add_shortcode('title', 'alterna_title_func');

//=============================
// Button
//=============================
function alterna_button_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text' => 'Button',
		  'icon' => '',
		  'style'=> '',
		  'color'=> '',
		  'size' => '',
		  'align'=>	'left',
		  'url'	 => '#',
		  'target' => '_self',
		  'btn_block' => 'no',
		  'min_width'	=> ''
		  ), $atts ) );

	if($color == 'theme' || $color == ''){	
		$color = 'btn-theme ';
	}
	
	if($size == 'default'){	
		$size = '';	
	}
	
	if($style == 'border'){
		$style = 'border-btn';
	} else if($style == 'float'){
		$style = 'float-btn';
	} else if($style == 'default'){
		$style = '';
	} else if($style == 'icon' && $icon != ''){
		$style = ' icon-btn';
	} else if($style == 'mix'){
		$style = 'float-btn';
		if($icon != ''){
			$style .= ' icon-btn';
		}
	}

	if($btn_block == 'yes'){
		$style .= ' btn-block';
	}
	
	$output = '';
	
	if($align == 'center' || $align == 'right'){
		$output .= '<p class="alterna-button-align-'.$align.'">';
	}
	
	$output .= '<a '.($min_width != '' ? 'style="min-width:'.intval($min_width).'px;"' : '').' class="btn '.esc_attr($style).' '.esc_attr($size).' '.esc_attr($color).'" href="'.esc_attr($url).'" target="'.esc_attr($target).'"';
	
	if($icon != '') {
		$icon = '<span><i class="fa '.esc_attr($icon).'"></i></span>';
	}
	
	$output .= ' >'.$icon.$text.'</a>';
	
	if($align == 'center' || $align == 'right'){
		$output .= '</p>';
	}
	
	return $output;
}
add_shortcode('button', 'alterna_button_func');

//=============================
// Service
//=============================
function alterna_service_func($atts, $content = null){
	extract( shortcode_atts( array(
			'type'		=> '',
			'align'		=> 'center',
			'icon'		=> 'fa-flag',
			'bg_type'	=> '',
			'icon_bg'	=> 'yes',
			'title'		=>	'',
			'color'		=>	'btn-theme',
			'url'		=>	'',
			'btn_name'	=>	'',
			'btn_style'	=>	'float-btn',
			'btn_target'=>	'',
			'icon_effect'=> 'rotate-scale',
			'effect'	=>	'',
			'item_link' => '',
			'item_link_type' => 'normal',
			'item_link_target' => '',
			'hover_bg'	=>	'no'
		  ), $atts ) );
	
	if($bg_type == "none"){$bg_type = '';}
	if($color == "theme" || $color == ''){$color = 'btn-theme';}
	
	$icon_bg_type = 'alterna-service-icon-bg';
	
	if($icon_bg == "no"){
		$icon_bg_type	= 'alterna-service-icon-no-bg';
	}
	
	$item_link_class = '';
	
	if($item_link != '' && $item_link_type == 'normal'){
		$item_link_class = ' alterna-service-link';
		$item_link = ' data-link="'.esc_attr($item_link).'"';
	}
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-service '.esc_attr($bg_type).' '.esc_attr($item_link_class).' '.esc_attr($align).' '.esc_attr($icon_bg_type).' animate" data-effect="'.esc_attr($effect).'" '.$item_link.'>';
	}else{
		$output = '<div class="alterna-service '.esc_attr($bg_type).' '.esc_attr($align).' '.esc_attr($icon_bg_type).'" '.$item_link.'>';
	}
	
	$output .= '<div class="alterna-service-img-content">';
	if($type == 'image'){
		$output .= '<div class="alterna-service-img">';
		if($item_link != '' && $item_link_type == 'icon'){
			$output .= '<a href="'.esc_url($item_link).'" target="'.esc_attr($item_link_target).'"><img src="'.esc_url($icon).'" alt="'.esc_attr($title).'"></a>';
		}else{
			$output .= '<img src="'.esc_url($icon).'" alt="'.esc_attr($title).'">';
		}
		$output .= '</div>';
	}else{
		
		$icon_color = $color;
		
		if($icon_bg == "no" && $color != ''){
			$icon_color = $color.'-t';
		}
		
		$output .= '<div class="alterna-service-icon '.esc_attr($icon_color).' service-'.esc_attr($icon_effect).'">';
		if($item_link != '' && $item_link_type == 'icon'){
			$output .= '<a href="'.esc_url($item_link).'" target="'.esc_attr($item_link_target).'"><i class="fa '.esc_attr($icon).'"></i></a>';
		}else{
			$output .= '<i class="fa '.esc_attr($icon).'"></i>';
		}
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '<div class="alterna-service-content">';
	if($title != ""){
		$output .= '<h3 class="alterna-service-title">'.esc_attr($title).'</h3>';
	}
	$output .= '<div class="alterna-service-entry-content">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	if($url != ""){
		$output .= do_shortcode('[button style="'.esc_attr($btn_style).'" color="'.esc_attr($color).'" url="'.esc_attr($url).'" text="'.esc_attr($btn_name).'" target="'.esc_attr($btn_target).'"]');
	}
	$output .= '</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('service', 'alterna_service_func');

//=============================
// Alert Message
//=============================
function alterna_alert_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'type' => 'alert-warning',
		  'close' => 'yes'
		  ), $atts ) );
	
	$output = '<div class="alert '.esc_attr($type).' '.($close == "yes" ? "alert-dismissable" : "").' fade in">';
	if($close == "yes"){
  		$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	}
  	$output .= do_shortcode($content);
 	$output .= '</div>';

	return $output;
}
add_shortcode('alert', 'alterna_alert_func');

//=============================
// Icons
//=============================
function alterna_icon_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'name' => '',
		  'align'=> '',
		  'size' => '',
		  'color'=> '',
		  'style'=> '',
		  ), $atts ) );
		  
	if($name == ''){
		return '';
	}
	if($size == 'default'){$size = '';}
	if($color == 'theme' || $color == ''){$color = 'btn-theme';}
	return '<div class="alterna-sc-icon '.esc_attr($align).'"><span class="'.esc_attr($color).' '.esc_attr($size).'"><i class="fa '.esc_attr($name).' '.esc_attr($style).'"></i></span></div>';
}
add_shortcode('icon', 'alterna_icon_func');

//=============================
// Social
//=============================
function alterna_social_func($atts, $content = null){
	global $alterna_icon_items, $alterna_icon_default_color, $alterna_icon_default_params;
	$alterna_icon_items = array();
	extract( shortcode_atts( array(
			'bg_color' 			=> '',
			'color'				=> '',
			'tooltip' 			=> 'no',
			'tooltip_placement' => 'top',
			'circle' 			=> 'no'
		  ), $atts ) );
	
	$alterna_icon_default_color = array('bg_color' => $bg_color, 'color' => $color);
	$alterna_icon_default_params = array('tooltip' => $tooltip, 'placement' => $tooltip_placement);
	
	$output = '<ul class="inline alterna-social '.($circle == "yes" ? 'social-circle' : '').'">';
	do_shortcode($content);
	
	if(count($alterna_icon_items) > 0) {
		foreach($alterna_icon_items as $alterna_icon_item) {
			$output .= $alterna_icon_item;
		}
	}
	$output .= '</ul>';
	return $output;
}
add_shortcode('social', 'alterna_social_func');

function alterna_social_item_func($atts, $content = null){
	global $alterna_icon_items, $alterna_icon_default_color, $alterna_icon_default_params;
	extract( shortcode_atts( array(
			'type' 		=> 'twitter',
			'url' 		=> '#',
			'target' 	=> '_blank',
			'title' 	=> ''
		  ), $atts ) );
	
	if($alterna_icon_default_params['tooltip'] == "yes"){
		$atts['tooltip'] = $alterna_icon_default_params['tooltip'];
		$atts['placement'] = $alterna_icon_default_params['placement'];
	}
	
	$atts['bg_color'] = $alterna_icon_default_color['bg_color'];
	$atts['color'] = $alterna_icon_default_color['color'];
	
	$alterna_icon_items[] = alterna_get_social_list('',false, $atts);
	
	return "";
}
add_shortcode('social_item', 'alterna_social_item_func');

//=============================
// Map
//=============================
function alterna_map_func($atts, $content = null){
	global $alterna_map_id;
	if(isset($alterna_map_id)){
		$alterna_map_id++;
	}else{
		$alterna_map_id = 1;
	}
	extract( shortcode_atts( array(
		  'zoom'	=> '13',
		  'scrollwheel' => 'yes',
		  'draggable'	=> 'yes',
		  'latlng' => '',
		  'width' => '300',
		  'height' => '200',
		  'show_marker' => 'no',
		  'show_info' =>'no',
		  'info_width' => '260',
		  'theme'	=>	''
		  ), $atts ) );
	
	if($width != "100%"){$width = $width.'px';}
	if($height != "100%"){$height = $height.'px';}
	if($theme == 'default'){$theme = '';}
	
	$output = '<div id="alterna-gmap-'.$alterna_map_id.'" class="map_canvas" style="float:left;width:'.esc_attr($width).';height:'.esc_attr($height).';"  data-zoom="'.esc_attr($zoom).'" data-latlng="'.esc_attr($latlng).'" data-scrollwheel="'.esc_attr($scrollwheel).'" data-draggable="'.esc_attr($draggable).'" data-theme="'.esc_attr($theme).'" ';
	
	if($show_marker == 'yes'){
		$output .= 'data-showmarker="'.esc_attr($show_marker).'" ';
		if($show_info == "yes"){
			$output .= 'data-showinfo="'.esc_attr($show_info).'" ';
			$output .= 'data-infowidth="'.esc_attr($info_width).'" ';
			$output .= 'data-infobg="'.get_template_directory_uri().'/img/tipbox.png" >';
			$output .= '</div>';
			$output .= '<div id="alterna-gmap-'.$alterna_map_id.'-map-info" style="display:none;">'.do_shortcode($content).'</div>';
			return $output;
		}
		$output .= '></div>';
		return $output;
	}
	$output .= '></div>';
	return $output;
}
add_shortcode('map', 'alterna_map_func');


//=============================
// FlexSlider
//=============================
function alterna_flexslider_func($atts, $content = null){
	global $alterna_flexslider_items;
	$alterna_flexslider_items = array();
	extract( shortcode_atts( array(
		  'auto' => 'no',
		  'delay' => '5000'
		  ), $atts ) );
		  
	$output = '<div class="flexslider alterna-fl post-gallery" '.($auto == "yes" ? 'data-delay="'.esc_attr($delay).'"' : '').' ><ul class="slides">';
	
	do_shortcode($content);
	if(count($alterna_flexslider_items) > 0){
		foreach($alterna_flexslider_items as $alterna_flexslider_item){
			$output .= '<li>'.$alterna_flexslider_item.'</li>';
		}
	}
	
	$output .= '</ul></div>';
	return $output;
}
add_shortcode('flexslider', 'alterna_flexslider_func');

function alterna_flexslider_item_func($atts, $content = null){
	global $alterna_flexslider_items;
	extract( shortcode_atts( array(
		  'type' 	=>	'image',
		  'src'	 	=>	'',
		  'url'		=>	'',
		  'target'	=>	'_blank'
		  ), $atts ) );
	switch($type){
		case 'image' :
			if($url != ""){
				$alterna_flexslider_items[] = '<a href="'.esc_url($url).'" target="'.esc_attr($target).'"><img src="'.esc_url($src).'" alt="img" ></a>';
			}else{
				$alterna_flexslider_items[] = '<img src="'.esc_url($src).'" alt="img" >';
			}
			break;
		case 'video' :
			$alterna_flexslider_items[] = do_shortcode($content);
			break;
	}
	return "";
}
add_shortcode('flexslider_item', 'alterna_flexslider_item_func');

//=============================
// Carousel
//=============================
function alterna_carousel_func($atts, $content = null){
	global $alterna_carousel_items,$alterna_carousel_id;
	$alterna_carousel_items = array();
	if(isset($alterna_carousel_id)){
		$alterna_carousel_id++;
	}else{
		$alterna_carousel_id = 1;
	}
	extract( shortcode_atts( array(
		  'auto'  => '',
		  'delay' => ''
		  ), $atts ) );
	$output =  '<div id="carousel-'.esc_attr($alterna_carousel_id).'" class="carousel slide '.($auto == "yes" ? 'carousel-auto' : 'carousel-stop').'" data-ride="carousel" '.($delay != "" ? 'data-delay="'.esc_attr($delay).'"' : '').'>';
	
	do_shortcode($content);
	
	$output .= '<ol class="carousel-indicators">';
	$count = 0;
	foreach($alterna_carousel_items as $alterna_carousel_item){
		$output .= '<li data-target="#carousel-'.esc_attr($alterna_carousel_id).'" data-slide-to="'.$count.'" '.($count == 0 ? 'class="active"' : '').'></li>';
		$count++;
	}
  	$output .= '</ol>';
	$output .= '<div class="carousel-inner">';
	
	$count = 0;
	foreach($alterna_carousel_items as $alterna_carousel_item){
		$output .= '<div class="item '.($count == 0 ? 'active' : '').'">'.$alterna_carousel_item.'</div>';
		$count++;
	}
	$output .= '</div>';
	
	$output .= '<a class="left carousel-control" href="#carousel-'.esc_attr($alterna_carousel_id).'" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#carousel-'.esc_attr($alterna_carousel_id).'" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span> </a>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode('carousel', 'alterna_carousel_func');

function alterna_carousel_item_func($atts, $content = null){
	global $alterna_carousel_items;
	extract( shortcode_atts( array(
		  'src'	 => ''
		  ), $atts ) );
	$alterna_carousel_items[] = '<img src="'.esc_url($src).'" alt="img" ><div class="carousel-caption">'.do_shortcode($content).'</div>';
	return "";
}
add_shortcode('carousel_item', 'alterna_carousel_item_func');

//=============================
// Dropcap
//=============================
function alterna_dropcap_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'text' 		=> '',
		  'type' 		=> '',
		  'txt_color'	=> '#000000',
		  'bg_color'	=> '#ff0000'
		  ), $atts ) );
	
	$output = '<span class="dropcap';
	switch($type){
		case "text":
			$output .= ' dropcap-text" style="color:'.esc_attr($txt_color).'"';
			break;
		default :
			$output .= ' dropcap-default" style="background:'.esc_attr($bg_color).';color:'.esc_attr($txt_color).'"';
	}
	$output .= '>';
	$output .= $text.'</span>';
	return $output;
}
add_shortcode('dropcap', 'alterna_dropcap_func');

//=============================
// Blockquote
//=============================
function alterna_blockquote_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'border_color'	=> '#eeeeee',
		  'bg_color'		=> '#ffffff',
		  'effect'			=> ''
		  ), $atts ) );
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-blockquote animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="alterna-blockquote" >';
	}
	
	$output .= '<blockquote style="border-left: 5px solid '.esc_attr($border_color).';'.($bg_color != '' ? 'background:'.esc_attr($bg_color).';' : '').'">'.do_shortcode($content).'</blockquote></div>';

	return $output;
}
add_shortcode('blockquote', 'alterna_blockquote_func');

//=============================
// Call To Action
//=============================
function alterna_call_to_action_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'style' => '',
		  'title' => '',
		  'size' => '',
		  'url'	 => '',
		  'btn_title' => '',
		  'btn_color' => '',
		  'btn_style' => '',
		  'target' => '_self',
		  'effect' => ''
		  ), $atts ) );
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="call-to-action '.esc_attr($style).' animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="call-to-action '.esc_attr($style).'">';
	}
	$output .= '<div class="call-to-action-content">';
	
	if($size == 'default'){
		$size = '';
	}
	
	if($size == 'big' && $title != ''){
		$output .= '<h1 class="call-to-action-title">'.esc_html($title).'</h1>';
	}
	else if($title != ''){
		$output .= '<h3 class="call-to-action-title">'.esc_html($title).'</h3>';
	}
	
	if($content != ''){ 
		$output .= '<p class="desc '.esc_attr($size).'">'.do_shortcode($content).'</p>';
	}
	
	if($btn_title != '' && $url != '') {
		if($btn_color == '' || $btn_color == 'theme'){
			$btn_color = 'btn-theme';
		}
		$btn_size = '';
		if($size == 'big'){
			$btn_size = 'btn-lg';
		}
		$output .= '<p><a class="btn '.esc_attr($btn_style).' '.esc_attr($btn_color).' '.esc_attr($btn_size).'" href="'.esc_url($url).'" target="'.esc_attr($target).'">'.esc_attr($btn_title).'</a></p>';
	}
	$output .= '</div>';
	$output .= '</div>';
	return $output;
}
add_shortcode('call_to_action', 'alterna_call_to_action_func');

//=============================
// Bullets
//=============================
function alterna_bullets_func($atts, $content = null){
	global $alterna_bullets_effect;
	extract( shortcode_atts( array(
		  'effect'	=>	'',
		  'size'	=>	'',
		  ), $atts ) );
	$alterna_bullets_effect = $effect;
	
	if($size == 'default'){$size = '';}
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-bullets '.esc_attr($size).' animate-list" data-effect="'.esc_attr($effect).'" >';
	}else{
		$output = '<div class="alterna-bullets '.esc_attr($size).'" >';
	}
	
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('bullets', 'alterna_bullets_func');

function alterna_bullet_func($atts, $content = null){
	global $alterna_bullets_effect;
	extract( shortcode_atts( array(
		'icon'	=>	'',
		'color'	=>	''
		), $atts ) );

	if($alterna_bullets_effect != "" && $alterna_bullets_effect != "none"){
		$output = '<div class="alterna-bullet animate-item" data-effect="'.esc_attr($alterna_bullets_effect).'">';
	}else{
		$output = '<div class="alterna-bullet">';
	}
	
	if($color == 'theme' || $color == ''){$color = 'btn-theme';}
	
	$output .= '<span class="alterna-bullet-icon '.esc_attr($color).'"><i class="fa '.esc_attr($icon).'"></i></span>';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('bullet', 'alterna_bullet_func');

//=============================
// PriceTable
//=============================
function alterna_price_func($atts, $content = null){
	extract( shortcode_atts( array(
		'type'	=>	'',
		'title'	=>	'',
		'price'	=>	'',
		'plan'	=>	'',
		'color'=>'',
		'btn_target'=>'',
		'btn_url'=>'',
		'btn_text'=>'',
		'btn_style' => '',
		'effect' => ''
		), $atts ) );
	
	if($type == 'default'){
		$type = '';
	}
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-price animate '.esc_attr($type).'" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="alterna-price '.esc_attr($type).'">';
	}
	
	if($color == '' || $color == 'theme'){
		$color = 'btn-theme';
	}

	$output .= '<div class="alterna-price-header">';
	if($title != ''){
		$output .= '<h4 class="price-title">'.esc_attr($title).'</h4>';
	}
	if($price != ''){
		$output .= '<h1 class="price-num '.esc_attr($color).'-t">'.esc_attr($price).'</h1>';
	}
	if($plan != ''){
		$output .= '<div class="price-plan">'.esc_attr($plan).'</div>';
	}
	$output .= '</div>';
	
	$output .= '<div class="alterna-price-content">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	
	$output .= '<div class="alterna-price-footer">';
	$output .= do_shortcode('[button style="'.esc_attr($btn_style).'" color="'.esc_attr($color).'" target="'.esc_attr($btn_target).'" url="'.esc_attr($btn_url).'" text="'.esc_attr($btn_text).'"]');
	$output .= '</div>';
	
	$output .= '</div>';
	
	return $output;
}
add_shortcode('price', 'alterna_price_func');

//=============================
// Accordion
//=============================
function alterna_accordion_func($atts, $content = null){
	global $alterna_accordion_id, $alterna_accordion_items,$alterna_accordion_item_id,$alterna_accordion_item_effect;
	// setting accordion id
	if(isset($alterna_accordion_id)){
		$alterna_accordion_id++;
	}else{
		$alterna_accordion_id = 1;
	}
	$alterna_accordion_item_id = 1;
	extract( shortcode_atts( array(
		  'effect' => '',
		  ), $atts ) );
		  
	$alterna_accordion_items = array();
	$alterna_accordion_item_effect = $effect;
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-accordion alterna-accordion-main animate-list" data-effect="'.esc_attr($effect).'" id="accordion-'.esc_attr($alterna_accordion_id).'">';
	}else{
		$output = '<div class="alterna-accordion alterna-accordion-main" id="accordion-'.esc_attr($alterna_accordion_id).'">';
	}
	do_shortcode($content);
	foreach($alterna_accordion_items as $alterna_accordion_item){
		$output .= $alterna_accordion_item;
	}
	$output .= '</div>';
	return $output;
}
add_shortcode('accordion', 'alterna_accordion_func');

function alterna_accordion_item_func($atts, $content = null){
	global $alterna_accordion_items,$alterna_accordion_id,$alterna_accordion_item_id,$alterna_accordion_item_effect;
	extract( shortcode_atts( array(
		  'title' => '',
		  'open' => '',
		  'color' => ''
		  ), $atts ) );
	
	if($alterna_accordion_item_effect != ""){
		$output = '<div class="panel accordion-panel animate-item" data-effect="'.esc_attr($alterna_accordion_item_effect).'">';
	}else{
		$output = '<div class="panel accordion-panel">';
	}
	
	if($color == '' || $color == 'theme'){$color = 'btn-theme';}
	
	$alterna_accordion_items[] = $output.'<div class="accordion-heading"><h4 class="accordion-title"><a class="accordion-toggle '.($open == "true" || $open == "yes" ? '' : 'collapsed').'" data-toggle="collapse" data-parent="#accordion-'.esc_attr($alterna_accordion_id).'" href="#accordion-'.esc_attr($alterna_accordion_id).'-item-'.esc_attr($alterna_accordion_item_id).'"><span class="accordion-icon '.esc_attr($color).'"><i class="fa fa-minus"></i><i class="fa fa-plus"></i></span>'.esc_html($title).'</a></h4></div><div id="accordion-'.esc_attr($alterna_accordion_id).'-item-'.esc_attr($alterna_accordion_item_id).'" class="accordion-collapse collapse '.($open == "true" || $open == "yes" ? "in" : "").'"><div class="accordion-body">'.do_shortcode($content).'</div></div></div>';
	$alterna_accordion_item_id++;
	return "";
}
add_shortcode('accordion_item', 'alterna_accordion_item_func');

//=============================
// Toggle
//=============================
function alterna_toggle_func($atts, $content = null){
	global $alterna_toggle_id;
	if(isset($alterna_toggle_id)){
		$alterna_toggle_id++;
	}else{
		$alterna_toggle_id = 1;
	}
	extract( shortcode_atts( array(
		  'effect' => '',
		  'title' => '',
		  'faq' => '',
		  'open'  => '',
		  'color' => ''
		  ), $atts ) );
	if($effect != "" && $effect != "none"){
		$output = '<div class="alterna-toggle alterna-accordion animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="alterna-toggle alterna-accordion">';
	}
	if($color == '' || $color == 'theme'){$color = 'btn-theme';}
	$output .= '<div class="accordion-heading"><h4 class="accordion-title"><a class="accordion-toggle '.($open == "true" || $open == "yes" ? '' : 'collapsed').'" data-toggle="collapse" href="#toggle-'.esc_attr($alterna_toggle_id).'"><span class="accordion-icon '.esc_attr($color).'">';
	
	if($faq == 'yes'){
		$output .= '<i class="fa fa-question-circle"></i>';
	}else{
		$output .= '<i class="fa fa-minus"></i><i class="fa fa-plus"></i>';
	}
	
	$output .= '</span>'.esc_html($title).'</a></h4></div><div id="toggle-'.esc_attr($alterna_toggle_id).'" class="accordion-collapse collapse '.($open == "true" || $open == "yes" ? "in" : "").'"><div class="accordion-body">'.do_shortcode($content).'</div></div></div>';
	return $output;
}
add_shortcode('toggle', 'alterna_toggle_func');

//=============================
// Tabs
//=============================
function alterna_tabs_func($atts, $content = null){
	global $tabs_title_array,$tabs_content_array;
	extract( shortcode_atts( array(
			'align'		=>	'',
			'effect'	=>	''
		  ), $atts ) );
	$tabs_title_array 	= array();
	$tabs_content_array = array();
	do_shortcode($content);
	if($effect != "" && $effect != "none"){
		$output = '<div class="tabs animate '.esc_attr($align).'" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="tabs '.esc_attr($align).'">';
	}
	$output .= '<ul class="tabs-nav inline">';
	$output .= implode("",$tabs_title_array);
	$output .= '</ul>';
	$output .= '<div class="tabs-container">';
	$output .= implode("",$tabs_content_array);
	$output .='</div></div>';
	return $output;
}
add_shortcode('tabs', 'alterna_tabs_func');

function alterna_tabs_item_func($atts, $content = null){
	global $tabs_title_array,$tabs_content_array;
	extract( shortcode_atts( array(
			'icon'	=>	'',
		  	'title' => 'No title!'
		  ), $atts ) );
		  
	$tabs_title_array[] = '<li>'.($icon != "" ? '<span><i class="fa fa-fw '.esc_attr($icon).'"></i></span>' : '').$title.'</li>';
	$tabs_content_array[]	= '<div class="tabs-content">'.do_shortcode($content).'</div>';
	return "";
}
add_shortcode('tabs_item', 'alterna_tabs_item_func');

//=============================
// SideTabs
//=============================
function alterna_sidetabs_func($atts, $content = null){
	global $sidetabs_title_array,$sidetabs_content_array;
	extract( shortcode_atts( array(
			'effect'	=>	'',
			'align'		=>	'left'
		  ), $atts ) );
	$sidetabs_title_array 	= array();
	$sidetabs_content_array = array();
	if($effect != "" && $effect != "none"){
		$output = '<div class="sidetabs animate '.esc_attr($align).'" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="sidetabs '.esc_attr($align).'">';
	}
	do_shortcode($content);
	$output .= '<ul class="sidetabs-nav mline">';
	$output .= implode("", $sidetabs_title_array);
	$output .= '</ul>';
	$output .= '<div class="sidetabs-container">';
	$output .= implode("", $sidetabs_content_array);
	$output .='</div></div>';
	return $output;
}
add_shortcode('sidetabs', 'alterna_sidetabs_func');

function alterna_sidetabs_item_func($atts, $content = null){
	global $sidetabs_title_array,$sidetabs_content_array;
	extract( shortcode_atts( array(
		  'title' => 'No title!',
		  'icon' => ''
		  ), $atts ) );
	$sidetabs_title_array[] = '<li>'.($icon != '' ? '<i class="fa fa-fw '.esc_attr($icon).'"></i>' : '' ).$title.'</li>';
	$sidetabs_content_array[]	= '<div class="sidetabs-content">'.do_shortcode($content).'</div>';
	return "";
}
add_shortcode('sidetabs_item', 'alterna_sidetabs_item_func');

//=============================
// Testimonials
//=============================
function alterna_testimonials_func($atts, $content = null) {
	global $alterna_testimonials_type;
	extract( shortcode_atts( array(
		  	'type'		=> '',
			'autoplay'	=> 'no',
			'delay'		=>	'6000',
			'show_nav'	=>	'yes',
			'effect'	=>	''
		  ), $atts ) );
	
	$alterna_testimonials_type = $type;
	$testimonials_type = '';
	
	if($type == 'avatar'){
		 $testimonials_type = "testimonials-avatar";
	}else if($type == 'wide'){
		$testimonials_type = "testimonials-wide";
		if($show_nav == 'yes'){
			$testimonials_type .= " testimonials-show-nav";
		}
	}
	
	if($effect != "" && $effect != "none"){
		$output ='<div class="testimonials '.esc_attr($testimonials_type).' '.($autoplay == 'yes' ? " testimonials-auto" : "").' animate" data-effect="'.esc_attr($effect).'" data-delay="'.esc_attr($delay).'">';
	}else{
		$output ='<div class="testimonials '.esc_attr($testimonials_type).' '.($autoplay == 'yes' ? " testimonials-auto" : "").'" data-delay="'.esc_attr($delay).'">';
	}
	
	if($type == 'wide'){
		$output .= '<i class="fa fa-quote-left"></i>';
	}
	
	$output .= do_shortcode($content);

	if($show_nav == 'yes'){
		$output .='<a class="testimonials-prev"><i class="fa fa-angle-left"></i></a><a class="testimonials-next"><i class="fa fa-angle-right"></i></a>';
	}
	
	$output .= '</div>';
	return $output;
}
add_shortcode('testimonials', 'alterna_testimonials_func');

function alterna_testimonials_item_func($atts, $content = null){
	global $alterna_testimonials_type;
	
	extract( shortcode_atts( array(
		  	'name'	=>  '',
			'job'	=>	'',
			'src'	=>	'',
			'url'	=>	'',
		  ), $atts ) );
	
	$output = '<div class="testimonials-item">';
	if($alterna_testimonials_type == 'avatar'){
		if($src == ""){
			$src = get_template_directory_uri() . '/img/testimonials-client.png';
		}
		$output .= '<div class="testimonials-avatar"><img src="'.esc_url($src).'" alt="'.esc_attr($name).'" ></div>';
	}
	
	if($alterna_testimonials_type == 'wide'){
		$output .= '<div class="testimonials-content">';
		$output .= $content;
		$output .= '</div>';
		
		$output .= '<div class="testimonials-name"><span>';
		if($url != ''){
			$output .= '<a href="'.esc_url($url).'" target="_blank">'.esc_attr($name).'</a>';
		}else{
			$output .= esc_attr($name);
		}
		$output .= '</span>'.( $job != '' ? '<span class="testimonials-job">- '.esc_attr($job) : "" ).'</span></div></div>';
	}else{
		$output .= '<div class="testimonials-content">';
		$output .= '<i class="fa fa-quote-left"></i>'.do_shortcode($content).'<i class="fa fa-quote-right"></i><span class="testimonials-arraw"></span></div><div class="testimonials-name"><div class="testimonials-icon"><i class="fa fa-user fa-fw"></i><span>';
		if($url != ''){
			$output .= '<a href="'.esc_url($url).'" target="_blank">'.esc_attr($name).'</a>';
		}else{
			$output .= esc_attr($name);
		}
		$output .= '</span>'.( $job != '' ? '<span class="testimonials-job">- '.esc_attr($job) : "" ).'</span></div></div></div>';
	}

	return  $output;
}
add_shortcode('testimonials_item', 'alterna_testimonials_item_func');

//=============================
// Team
//=============================
function alterna_team_func($atts, $content = null){
	extract( shortcode_atts( array(
			'name' 	=>	'',
			'job'	=>	'',
			'src'	=>	'',
			'color'	=>	'',
			'url'	=>	'',
			'target'=>	'_blank',
			'effect'=>	''
		  ), $atts ) );
	
	if($effect != "" && $effect != "none"){
		$output = '<div class="team animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="team">';
	}
	
	if($color == '' || $color == 'theme'){
		$color = 'btn-theme';
	}
	
	$output	.='<div class="team-avatar '.esc_attr($color).'">';
	if($url != ""){
		$output .='<a href="'.esc_url($url).'" target="'.esc_attr($target).'"><img src="'.esc_url($src).'" alt="'.esc_attr($name).'" /></a>';
	}else{
		$output .='<img src="'.esc_url($src).'" alt="'.esc_attr($name).'" />';
	}
	$output .='</div>';
	$output .='<div class="team-user-info">';
	if($url != ""){
		$output .='<a href="'.esc_url($url).'" target="'.esc_attr($target).'"><h4 class="team-title">'.esc_attr($name).'</h4></a>';
	}else{
		$output .='<h4 class="team-title">'.esc_attr($name).'</h4>';
	}
	$output	.='<div class="team-job">'.esc_attr($job).'</div>';
	$output	.='</div>';
	$output	.='<div class="team-content">'.do_shortcode($content).'</div>';
	$output	.='<div class="team-socials">';
	$socials = array('twitter'=>'twitter',
			 'facebook'=>'facebook',
			 'author'=>'user',
			 'flickr'=>'flickr',
			 'dribbble'=>'dribbble',
			 'pinterest'=>'pinterest',
			 'github'=>'github-alt',
			 'tumblr'=>'tumblr',
			 'instagram'=>'instagram',
			 'email'=>'envelope-o',
			 'linkedin'=>'linkedin-square',
			 'google'=>'google-plus',
			 'trello'=>'trello',
			 'renren'=>'renren',
			 'skype'=>'skype',
			 'weibo'=>'weibo',
			 'xing'=>'xing',
			 'youtube'=>'youtube',
			 'github'=>'github-alt',
			 'rebel'=>'rebel',
			 'slidesshare'=>'slidesshare',
			 'stackoverflow'=>'stack-overflow',
			 'sutmbleupon' => 'sutmbleupon',
			 'wechat'=>'wechat',
			 'yelp' => 'yelp',
			 'vine' => 'vine',
			 'soundcloud' => 'soundcloud',
			 'lastfm' => 'lastfm',
			 'dropbox' => 'dropbox',
			 'digg' => 'digg',
			 'behance' => 'behance'
			 );
	foreach($socials as $key=>$val){
	  if(isset($atts[$key]) && $atts[$key]!= ""){
		  $output	.='<a href="'.esc_attr($atts[$key]).'" target="'.esc_attr($target).'"><i class="fa fa-'.esc_attr($socials[$key]).'"></i></a>';
	  }
	}
	$output	.='</div>';
	$output	.='</div>';
	return $output;
}
add_shortcode('team', 'alterna_team_func');

		  
//=============================
// Image
//=============================
function alterna_img_func($atts, $content = null){
	extract( shortcode_atts( array(
			'align'	=>	'',
			'url'	=>	'',
			'title'	=>	'',
			'src'	=>	'',
			'target'=>	'_self',
			'fancybox'=>'no',
			'effect' => ''
		  ), $atts ) );
	
	if($align == 'default'){
		$align = '';
	}
	
	$output = '';
	if($url != ''){
		$output .= '<a href="'.esc_url($url).'" class="'.($fancybox == "yes" ? 'fancyBox' : '').'" title="'.esc_attr($title).'" target="'.esc_attr($target).'">';
	}
	
	if($effect != "" && $effect != "none"){
		$output .= '<img class="'.esc_attr($align).' animate" data-effect="'.esc_attr($effect).'" src="'.esc_url($src).'" alt="'.esc_attr($title).'">';
	}else{
		$output .= '<img class="'.esc_attr($align).'" src="'.esc_url($src).'" alt="'.esc_attr($title).'">';
	}
	if($url != ''){
		$output .= '</a>';
	}
	return $output;
}
add_shortcode('img', 'alterna_img_func');

//=============================
// History
//=============================
function alterna_history_func($atts, $content = null){
	extract( shortcode_atts( array(
			'date'	=>	'',
			'start' => 'no',
			'title' => '',
			'color'	=>	'',
			'img'	=>	'',
			'img_align'	=>	'alignleft',
			'effect' => ''
		  ), $atts ) );
	if($effect != "" && $effect != "none"){
		$output = '<div class="history animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="history">';
	}
	
	if($color == '' || $color == 'theme'){
		$color = 'btn-theme';
	}
	
	$output .= '<div class="history-date-content">';
	$output .= '<div class="history-date '.esc_attr($color).'">'.esc_html($date).'<div class="history-hor-line '.esc_attr($color).'"></div></div>';
	$output .= '<div class="history-line '.esc_attr($color).'"></div>';
	if($start == "yes"){
		$output .= '<div class="history-start-point '.esc_attr($color).'"><span></span></div>';
	}
	$output .= '</div>';
	$output .= '<div class="history-content">';
	$output .= '<h4 class="history-title">'.esc_html($title).'</h4>';
	$output .= '<div class="history-entry-content">';
	if($img != ''){
		$output .= do_shortcode('[img src="'.esc_url($img).'" align="'.esc_attr($img_align).'"]');
	}
	$output .= do_shortcode($content).'</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode('history', 'alterna_history_func');

//=============================
// Skills
//=============================
function alterna_skills_func($atts, $content = null){
	extract( shortcode_atts( array(
		 
		  ), $atts ) );
	return '<div class="skills">'.do_shortcode($content).'</div>';
}
add_shortcode('skills', 'alterna_skills_func');

function alterna_skill_func($atts, $content = null){
	extract( shortcode_atts( array(
			'name'	=> 'Name',
			'percent' => '50%',
			'text' => '',
			'color'	=> 'theme'
		  ), $atts ) );
	if($color == 'theme' || $color == ''){$color = 'btn-theme';}
	return '<div class="skill-element"><span class="skill-bg '.esc_attr($color).'" data-percent="'.$percent.'"></span><span class="skill-name">'.$name.'</span><span class="skill-progress">'.($text == "" ? $percent : $text).'</span></div>';
}
add_shortcode('skill', 'alterna_skill_func');

//=============================
// Clients
//=============================
function alterna_clients_func($atts, $content = null){
	extract( shortcode_atts( array(
			'effect'	=>	''
		  ), $atts ) );
		  
	if($effect != "" && $effect != "none"){
		$output = '<div class="clients animate" data-effect="'.esc_attr($effect).'">';
	}else{
		$output = '<div class="clients">';
	}
	$output .= '<div class="clients-elements">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	$output .= '<span class="client-arrow-left"><i class="fa fa-angle-left"></i></span><span class="client-arrow-right"><i class="fa fa-angle-right"></i></span>';
	$output .= '</div>';
	return $output;
}
add_shortcode('clients', 'alterna_clients_func');

function alterna_client_func($atts, $content = null){
	extract( shortcode_atts( array(
			'src'		=> '',
			'url'		=> '',
			'target'	=> '',
			'title'		=>	''
		  ), $atts ) );
	
	$output = '<div class="client-element"><div class="client-content">';
	if($url != ''){
		$output .= '<a href="'.esc_url($url).'" target="'.esc_attr($target).'">';
	}
	$output .= '<img src="'.esc_url($src).'" alt="'.$title.'" />';
	if($url != ''){
		$output .= '</a>';
	}
	$output .= '</div></div>';
	return $output;
}
add_shortcode('client', 'alterna_client_func');

//=============================
// Columns
//=============================
function alterna_space_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'line'	=> 'no',
		  'style'	=>	'solid',
		  'size'	=>	''
		  ), $atts ) );
		  if($size == 'default'){
			  $size = '';
		  }
	return '<div class="row"><div class="col-md-12"><div class="alterna-space '.$size.' '.($line =="yes" ? 'alterna-line '.$style : '').'">'.do_shortcode($content).'</div></div></div>';
}
add_shortcode('space', 'alterna_space_func');

function alterna_wide_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id'		=>	''
		  ), $atts ) );
	if($id != ""){
		$id = 'id="'.esc_attr($id).'"';
	}
	return '<div '.$id.' class="wide-background"><div class="row"><div class="col-md-12">'.do_shortcode($content).'</div></div></div>';
}
add_shortcode('wide', 'alterna_wide_func');

function alterna_one_func($atts, $content = null){
	return '<div class="row"><div class="col-md-12">'.do_shortcode($content).'</div></div>';
}
add_shortcode('one', 'alterna_one_func');

function alterna_row_func($atts, $content = null){
	return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode('row', 'alterna_row_func');

function alterna_inner_row_func($atts, $content = null){
	return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode('inner_row', 'alterna_inner_row_func');

function alterna_one_half_func($atts, $content = null){
	return '<div class="col-md-6 col-sm-6">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'alterna_one_half_func');

function alterna_one_third_func($atts, $content = null){
	return '<div class="col-md-4 col-sm-4">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'alterna_one_third_func');

function alterna_two_third_func($atts, $content = null){
	return '<div class="col-md-8 col-sm-8">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'alterna_two_third_func');

function alterna_one_fourth_func($atts, $content = null){
	return '<div class="col-md-3 col-sm-3">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'alterna_one_fourth_func');

function alterna_two_fourth_func($atts, $content = null){
	return '<div class="col-md-6 col-sm-6">'.do_shortcode($content).'</div>';
}
add_shortcode('two_fourth', 'alterna_two_fourth_func');

function alterna_three_fourth_func($atts, $content = null){
	return '<div class="col-md-9 col-sm-9">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'alterna_three_fourth_func');


//=============================
// Youtube Video Player
//=============================
function alterna_youtube_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
	if($width == "100%") {
		$out_width = 'class="full-width-show" width="600"';
	}else{
		$out_width = 'width="'.$width.'"';
	}
	
	$output = '<div class="video-youtube"><iframe title="YouTube Video Player" src="//www.youtube.com/embed/' . $id . '?html5=1" '.$out_width.' height="' . $height . '" allowfullscreen></iframe></div>';
		
	return $output;
}
add_shortcode('youtube', 'alterna_youtube_func');

//=============================
// Vimeo Video Player
//=============================
function alterna_vimeo_func($atts, $content = null){
	extract( shortcode_atts( array(
		  'id' => '',
		  'width' => '600',
		  'height' => '360',
		  ), $atts ) );
		  
	if($width == "100%") {
		$out_width = 'class="full-width-show" width="600"';
	}else{
		$out_width = 'width="'.$width.'"';
	}
		
	$output = '<div class="video-vimeo"><iframe title="Vimeo Video Player" src="//player.vimeo.com/video/' . $id . '" '.$out_width.' height="' . $height . '" ></iframe></div>';
		
	return $output;
}
add_shortcode('vimeo', 'alterna_vimeo_func');

//=============================
// Soundcloud Audio Player
//=============================
function alterna_soundcloud_func($atts, $content = null){
	extract( shortcode_atts( array(
		  	'url' => '',
			'iframe' => 'true',
			'width' => '100%',
			'height' => 166,
			'auto_play' => 'true',
			'show_comments' => 'true',
			'color' => 'ff7700',
			'theme_color' => 'ff6699',
		  ), $atts ) );
	
	// use iframe
	if($iframe == 'true'){
		$url = '//w.soundcloud.com/player?' . http_build_query($atts);
		if($width == "100%") {
			$out_width = 'class="full-width-show" width="600"';
		}else{
			$out_width = 'width="'.$width.'"';
		}
		return '<div class="sound-sl"><iframe '.$out_width.' height="'.$height.'" scrolling="no" src="'.$url.'"></iframe></div>';
	}else{
	// use flash
		$url = '//player.soundcloud.com/player.swf?' . http_build_query($atts);
		return '<div class="sound-sl"><object width="'.$width.'" height="'.$height.'">
                                <param name="movie" value="'.$url.'"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="'.$width.'" height="'.$height.'" src="'.$url.'" allowscriptaccess="always" type="application/x-shockwave-flash"></embed>
                              </object></div>';
	}
	return "";
}

add_shortcode('soundcloud', 'alterna_soundcloud_func');

//=============================
// One Page Navigation
//=============================
function alterna_pagenav_func($atts, $content = null){
	global $alterna_pagenav_items;
	extract( shortcode_atts( array(
			'position' => 'right',
			'style'=> ''
		), $atts ) );
	$alterna_pagenav_items = array();
	$output = "";
	do_shortcode($content);
	if(count($alterna_pagenav_items) > 0){
		if($position == "left" || $position == "right"){
			$output ='<ul class="alterna-pagenav mline ';
		}else{
			$output ='<ul class="alterna-pagenav inline ';
		}
		$output .= esc_attr($position).' '.esc_attr($style).'">';
		$output .= implode("",$alterna_pagenav_items);
		$output .= '</ul>';
	}
	return $output;
}
add_shortcode('pagenav', 'alterna_pagenav_func');

function alterna_pagenav_item_func($atts, $content = null){
	global $alterna_pagenav_items;
	extract( shortcode_atts( array(
			'link' => '',
			'title'=> ''
		), $atts ) );
	$alterna_pagenav_items[] = '<li><a href="#'.esc_attr($link).'" title="'.esc_attr($title).'"></a>';
	return "";
}
add_shortcode('pagenav_item', 'alterna_pagenav_item_func');


/*-------------------------------------------------------------
 			THEME CONTENT WITH SHORTCODE
-------------------------------------------------------------*/

//=============================
// Blog List
//=============================
function alterna_blog_list_func($atts, $content = null){
	global $blog_shortcode_content, $blog_shortcode_thumbnail_size;
	
	extract( shortcode_atts( array(
		  	'number' 		=>	'4',
			'columns'		=>	'4',
			'type' 			=>	'',
			'style'			=>	'1',
			'orderby'		=>	'',
			'order'			=>	'',
			'cat__in'		=>	'',
			'tag__in'		=>	'',
			'post__in'		=>	'',
			'post__not_in'	=> 	'',
			'nocrop'		=>	'',
			'effect'		=>	''
		  ), $atts ) );
	
	$output = "";
	//get related posts
	$blog_posts = alterna_get_blog_widget_post($type, $number, $orderby, $cat__in, $tag__in, $post__in, $post__not_in);
	
	if($blog_posts != "" && $blog_posts->have_posts()){
		$columns = intval($columns) - 2;
		$blog_shortcode_columns = alterna_get_element_columns(intval($columns));
		$blog_shortcode_thumbnail_size = alterna_get_thumbnail_size(intval($columns), $nocrop);
		
		if($effect != "" && $effect != "none"){
			$output .= '<div class="row"><div class="alterna-shortcode-blog-post animate-list">';
		}else{
			$output .= '<div class="row"><div class="alterna-shortcode-blog-post ">';
		}
		while($blog_posts->have_posts()) {
			$blog_posts->the_post();
			$blog_shortcode_content = "";
			
			if($effect != "" && $effect != "none"){
				$output .= '<article id="post-'.get_the_ID().'" class="'.implode(' ', get_post_class('shortcode-post-entry blog-element blog-shortcode-style-'.esc_attr($style).' '.esc_attr($blog_shortcode_columns)) ).' animate-item" data-effect="'.esc_attr($effect).'" itemscope itemtype="http://schema.org/Article">';
			}else{
				$output .= '<article id="post-'.get_the_ID().'" class="'.implode(' ', get_post_class('shortcode-post-entry blog-element blog-shortcode-style-'.esc_attr($style).' '.esc_attr($blog_shortcode_columns)) ).'" itemscope itemtype="http://schema.org/Article">';
			}
			get_template_part( 'template/blog/shortcode/content-style', esc_attr($style));
			$output .= $blog_shortcode_content;
			$output .= '</article>';
		}
		$output .= '</div></div>';
	}
	wp_reset_postdata();
	return $output;  
}
add_shortcode('blog_list', 'alterna_blog_list_func');

//=============================
// Portfolio List
//=============================
function alterna_portfolio_list_func($atts, $content = null){
	global $portfolio_shortcode_content, $portfolio_shortcode_thumbnail_size;
	extract( shortcode_atts( array(
		  	'number' 		=>	'4',
			'columns'		=>	'4',
			'type' 			=>	'',
			'style'			=>	'1',
			'orderby'		=>	'',
			'order'			=>	'',
			'cat_slug_in'		=>	'',
			'tag_slug_in'		=>	'',
			'post__in'		=>	'',
			'post__not_in'		=> 	'',
			'nocrop'		=>	'',
			'effect'		=>	''
		  ), $atts ) );
	$output = "";
	$portfolios = alterna_get_portfolio_widget_post($type, $number, $orderby , $cat_slug_in, $tag_slug_in, $post__in, $post__not_in, $order);
	
	if($portfolios != "" && $portfolios->have_posts()){
		$columns = intval($columns) - 2;
		$portfolio_shortcode_columns = alterna_get_element_columns(intval($columns));
		$portfolio_shortcode_thumbnail_size = alterna_get_thumbnail_size(intval($columns), $nocrop);
		
		if($effect != "" && $effect != "none"){
			$output .= '<div class="row"><div class="alterna-shortcode-portfolio-post animate-list">';
		}else{
			$output .= '<div class="row"><div class="alterna-shortcode-portfolio-post">';
		}
		while($portfolios->have_posts()) {
			$portfolios->the_post();
			$portfolio_shortcode_content = "";
			if($effect != "" && $effect != "none"){
				$output .= '<article id="post-'.get_the_ID().'" class="'.implode(' ', get_post_class('shortcode-portfolio-entry portfolio-element portfolio-style-'.esc_attr($style).' '.esc_attr($portfolio_shortcode_columns)) ).' animate-item" data-effect="'.esc_attr($effect).'" itemscope itemtype="http://schema.org/CreativeWork">';
			}else{
				$output .= '<article id="post-'.get_the_ID().'" class="'.implode(' ', get_post_class('shortcode-portfolio-entry portfolio-element portfolio-style-'.esc_attr($style).' '.esc_attr($portfolio_shortcode_columns)) ).'" itemscope itemtype="http://schema.org/CreativeWork">';
			}
			
			get_template_part( 'template/portfolio/shortcode/content-style', esc_attr($style));
			$output .= $portfolio_shortcode_content;
			$output .= '</article>';
		}
		$output .= '</div></div>';
	}
	
	wp_reset_postdata();
	return $output;
}

add_shortcode('portfolio_list', 'alterna_portfolio_list_func');


function alterna_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'alterna_clean_shortcodes');
add_filter('widget_text', 'alterna_clean_shortcodes');

/* Visual Composer */
add_action( 'init', 'alterna_integrateWithVC');

function alterna_integrateWithVC() {
if (function_exists('vc_map')){
	
$effect_list = array("none", "bounce", "flash", "pulse", "rubberBand", "shake", "swing", "tada", "wobble", "bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp", "bounceOut", "bounceOutDown", "bounceOutLeft", "bounceOutRight", "bounceOutUp", "fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig", "fadeOut", "fadeOutDown", "fadeOutDownBig", "fadeOutLeft", "fadeOutLeftBig", "fadeOutRight", "fadeOutRightBig", "fadeOutUp", "fadeOutUpBig", "flip", "flipInX", "flipInY", "flipOutX", "flipOutY", "lightSpeedIn", "lightSpeedOut", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight", "rotateOut", "rotateOutDownLeft", "rotateOutDownRight", "rotateOutUpLeft", "rotateOutUpRight", "hinge", "rollIn", "rollOut", "zoomIn", "zoomInDown", "zoomInLeft", "zoomInRight", "zoomInUp", "zoomOut", "zoomOutDown", "zoomOutLeft", "zoomOutRight", "zoomOutUp");

$color_list = array('theme', 'darkcyan', 'deepskyblue', 'royalblue', 'blueviolet', 'purple', 'deeppink', 'crimson', 'green', 'lawngreen', 'yellow', 'gold', 'orange', 'orangered', 'chocolate', 'red', 'btn-primary' , 'btn-info' , 'btn-success' , 'btn-warning' , 'btn-danger');

	/* wide background */
	$attributes = array(
		'type' => 'dropdown',
		'heading' => __("Alterna Wide Background",'alterna'),
		'param_name' => 'wide',
		"value" => array('no','yes'),
		'description' => __("Enable row with wide background",'alterna')
	);
	vc_add_param('vc_row', $attributes);
	
	/* icon */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Icon",'alterna'),
		"base" => "icon",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Name",'alterna'),
				"param_name" => "name",
				"value" => '',
				"description" => __('FontAwesome icon name e.g. fa-flag (optional)','alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align",'alterna'),
				"param_name" => "align",
				"value" => array('center','left','right'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Size",'alterna'),
				"param_name" => "size",
				"value" => array('default', 'fa-lg' , 'fa-2x', 'fa-3x', 'fa-4x', 'fa-5x'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Style",'alterna'),
				"param_name" => "style",
				"value" => '',
				"description" => __("The icon style, default don't need input. e.g. fa-fw , fa-border , pull-right , pull-left , fa-spin, fa-stack, fa-inverse",'alterna')
				)
		)
	) );
	
	/* title */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Title",'alterna'),
		"base" => "title",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type",'alterna'),
				"param_name" => "type",
				"value" => array('default','old'),
				"description" => __('old type : Alterna old version like V6 title style.','alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'alterna'),
				"param_name" => "text",
				"value" => __("Title",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Size",'alterna'),
				"param_name" => "size",
				"value" => array('h3','h1','h2','h4','h5','h6')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align",'alterna'),
				"param_name" => "align",
				"value" => array('left','center','right')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Name",'alterna'),
				"param_name" => "icon",
				"value" => '',
				"description" => __('FontAwesome icon name e.g. fa-flag (optional)','alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Color",'alterna'),
				"param_name" => "icon_color",
				"value" => $color_list
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Uppercase",'alterna'),
				"param_name" => "uppercase",
				"value" => array('no','yes')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Bold",'alterna'),
				"param_name" => "bold",
				"value" => array('no','yes')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Line",'alterna'),
				"param_name" => "line",
				"value" => array('yes','no')
				)
		)
	) );
	
	/* space */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Space",'alterna'),
		"base" => "space",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/alterna.css'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Line",'alterna'),
				"param_name" => "line",
				"value" => array('yes','no')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Space Size",'alterna'),
				"param_name" => "size",
				"value" => array('default','small','big')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Line Style",'alterna'),
				"param_name" => "style",
				"value" => array('solid','dashed')
				)
		  )
	));
	
	/* buttons */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Button",'alterna'),
		"base" => "button",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(	
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Title",'alterna'),
				"param_name" => "text",
				"value" => __("Button",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Name",'alterna'),
				"param_name" => "icon",
				"value" => '',
				"description" => __('FontAwesome icon name e.g. fa-flag (optional)','alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Style",'alterna'),
				"param_name" => "style",
				"value" => array('default', 'icon', 'float', 'mix'),
				"description" => __("Button style, default don't need choose.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Size",'alterna'),
				"param_name" => "size",
				"value" => array('default', 'btn-lg' , 'btn-sm' , 'btn-xs'),
				"description" => __("Button size, default don't need choose.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Block (optional)",'alterna'),
				"param_name" => "btn_block",
				"value" => array('no','yes')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button URL",'alterna'),
				"param_name" => "url",
				"value" => '#'
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Target",'alterna'),
				"param_name" => "target",
				"value" => array('_self','_blank'),
				)
		 )
	) );
	
	/* image */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Image",'alterna'),
		"base" => "img",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"admin_enqueue_css" => array(get_template_directory_uri().'/vc_extend/alterna.css'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align",'alterna'),
				"param_name" => "align",
				"value" => array('default','alignnone','alignleft','aligncenter','alignright')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Image Src",'alterna'),
				"param_name" => "src",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("URL (optional)",'alterna'),
				"param_name" => "url",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Target (optional)",'alterna'),
				"param_name" => "target",
				"value" => array('_self','_blank'),
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title (optional)",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("FancyBox (optional)",'alterna'),
				"param_name" => "fancybox",
				"value" => array('no','yes')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				)
		  )
	));
  
	/* alert message */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Alert Message",'alterna'),
		"base" => "alert",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Alert Type",'alterna'),
				"param_name" => "type",
				"value" => array('alert-success' , 'alert-info' , 'alert-warning' , 'alert-danger'),
				"description" => __("The alert message type.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Alert Close",'alterna'),
				"param_name" => "close",
				"value" => array('yes' , 'no'),
				"description" => __("The alert can been close.",'alterna')
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __("Input alert message content.",'alterna')
				)
		 )
	));
	
	/* toggle */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Toggle",'alterna'),
		"base" => "toggle",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Toggle Title",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Toggle Faqs Style",'alterna'),
				"param_name" => "faq",
				"value" => array('yes','no'),
				"description" => __("The toggle show as faqs style.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Toggle Open",'alterna'),
				"param_name" => "open",
				"value" => array('yes','no'),
				"description" => __("The toggle content default show or hide.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* call to action */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Call to action",'alterna'),
		"base" => "call_to_action",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Call to action Style",'alterna'),
				"param_name" => "style",
				"value" => array('default','bar'),
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Call to action Size",'alterna'),
				"param_name" => "size",
				"value" => array('default','big'),
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" =>  __("Button Title (optional)",'alterna'),
				"param_name" => "btn_title",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" =>  __("Button Link (optional)",'alterna'),
				"param_name" => "url",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Link Target (optional)",'alterna'),
				"param_name" => "target",
				"value" => array('_self','_blank'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Style (optional)",'alterna'),
				"param_name" => "btn_style",
				"value" => array('default','float-btn'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Color (optional)",'alterna'),
				"param_name" => "btn_color",
				"value" => $color_list
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* service */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Service",'alterna'),
		"base" => "service",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Type",'alterna'),
				"param_name" => "type",
				"value" => array('icon','image'),
				"description" => __("The service show icon type.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Name or Image URL",'alterna'),
				"param_name" => "icon",
				"value" => '',
				"description" => __('FontAwesome icon name e.g. fa-flag or image type src link.','alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Title (options)",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align",'alterna'),
				"param_name" => "align",
				"value" => array('center','left'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Element Link (options)",'alterna'),
				"param_name" => "item_link",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Button Link (options)",'alterna'),
				"param_name" => "url",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Button Title (options)",'alterna'),
				"param_name" => "btn_name",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Button Style (options)",'alterna'),
				"param_name" => "btn_style",
				"value" => array('default', 'float'),
				"description" => __("Button style, default don't need choose.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Service Button Target (options)",'alterna'),
				"param_name" => "btn_target",
				"value" => array('_self','_blank'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Type (options)",'alterna'),
				"param_name" => "bg_type",
				"value" => array('none','default_bg','content_bg'),
				"description" => __("The service show background type.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Icon Background (options)",'alterna'),
				"param_name" => "icon_bg",
				"value" => array('yes','no'),
				"description" => __("The service icon show background.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "icon_effect",
				"value" => array('rotate-scale','rotate','scale','none'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* history */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna History",'alterna'),
		"base" => "history",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Date",'alterna'),
				"param_name" => "date",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Start Point",'alterna'),
				"param_name" => "start",
				"value" => array('no','yes'),
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Image URL",'alterna'),
				"param_name" => "img",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Image Align",'alterna'),
				"param_name" => "img_align",
				"value" => array('alignleft','aligncenter','alignright','alignnone'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* team */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Team",'alterna'),
		"base" => "team",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Name",'alterna'),
				"param_name" => "name",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Job",'alterna'),
				"param_name" => "job",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Avatar Image Src ",'alterna'),
				"param_name" => "src",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Link (optional)",'alterna'),
				"param_name" => "url",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Link Target (options)",'alterna'),
				"param_name" => "target",
				"value" => array('_self','_blank'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Twitter Link (optional)",'alterna'),
				"param_name" => "twitter",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Facebook Link (optional)",'alterna'),
				"param_name" => "facebook",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Flickr Link (optional)",'alterna'),
				"param_name" => "flickr",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Dribbble Link (optional)",'alterna'),
				"param_name" => "dribbble",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Pinterest Link (optional)",'alterna'),
				"param_name" => "pinterest",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Github Link (optional)",'alterna'),
				"param_name" => "github",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Tumblr Link (optional)",'alterna'),
				"param_name" => "tumblr",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Instagram Link (optional)",'alterna'),
				"param_name" => "instagram",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Trello Link (optional)",'alterna'),
				"param_name" => "trello",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Google Link (optional)",'alterna'),
				"param_name" => "google",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Linkedin Link (optional)",'alterna'),
				"param_name" => "linkedin",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Email Link (optional)",'alterna'),
				"param_name" => "email",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Author Link (optional)",'alterna'),
				"param_name" => "author",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* price */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Price Plan",'alterna'),
		"base" => "price",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type",'alterna'),
				"param_name" => "type",
				"value" => array('default','free','recommend'),
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'alterna'),
				"param_name" => "title",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Price",'alterna'),
				"param_name" => "price",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Plan",'alterna'),
				"param_name" => "plan",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Color",'alterna'),
				"param_name" => "color",
				"value" => $color_list
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Text",'alterna'),
				"param_name" => "btn_text",
				"value" => ''
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Link",'alterna'),
				"param_name" => "btn_url",
				"value" => ''
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Link Target (options)",'alterna'),
				"param_name" => "btn_target",
				"value" => array('_self','_blank'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Button Style (options)",'alterna'),
				"param_name" => "btn_style",
				"value" => array('default','float-btn'),
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* google map */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Map",'alterna'),
		"base" => "map",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("LatLng",'alterna'),
				"param_name" => "latlng",
				"value" => '',
				"description" => __("The map LatLng value from google map.e.g. 40.716038,-74.080811",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Map Width",'alterna'),
				"param_name" => "width",
				"value" => '300',
				"description" => __("The map show width.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Map Height",'alterna'),
				"param_name" => "height",
				"value" => '200',
				"description" => __("The map show height.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Map Zoom",'alterna'),
				"param_name" => "zoom",
				"value" => '13',
				"description" => __("The map default show zoom.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Draggable",'alterna'),
				"param_name" => "draggable",
				"value" => array('yes' ,'no' ),
				"description" => __("The map can drag.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Scroll Wheel",'alterna'),
				"param_name" => "scrollwheel",
				"value" => array('yes' ,'no' ),
				"description" => __("The map can scroll wheel zoom.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Marker",'alterna'),
				"param_name" => "show_marker",
				"value" => array('yes' ,'no' ),
				"description" => __("The map show marker.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Address Information",'alterna'),
				"param_name" => "show_info",
				"value" => array('yes' ,'no' ),
				"description" => __("The map show info box of address.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Show Information Width",'alterna'),
				"param_name" => "info_width",
				"value" => '260',
				"description" => __("The map info address box width.",'alterna')
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __("MAP Address Content.",'alterna')
				)
		)
	) );
	
	/* dropcap */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Dropcap",'alterna'),
		"base" => "dropcap",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Alert Dropcap Text",'alterna'),
				"param_name" => "text",
				"value" => '1'
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Alert Dropcap Type",'alterna'),
				"param_name" => "type",
				"value" => array('default','text'),
				"description" => __("The dropcap type , default is text with background",'alterna')
				),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Text Color",'alterna'),
				"param_name" => "txt_color",
				"value" => '#ffffff',
				"description" => __("The dropcap text color.",'alterna')
				),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Color",'alterna'),
				"param_name" => "bg_color",
				"value" => '#000000',
				"description" => __("The dropcap background color.",'alterna')
				)
		 )
	));
	
	/* blockquote */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Blockquote",'alterna'),
		"base" => "blockquote",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Color",'alterna'),
				"param_name" => "border_color",
				"value" => '#eeeeee',
				"description" => __("The blockquote border color.",'alterna')
				),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Color",'alterna'),
				"param_name" => "bg_color",
				"value" => '#ffffff',
				"description" => __("The blockquote background color.",'alterna')
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Element show effect",'alterna'),
				"param_name" => "effect",
				"value" => $effect_list
				),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content",'alterna'),
				"param_name" => "content",
				"value" => __('Input content...','alterna')
				)
		 )
	));
	
	/* blog list */
	wpb_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Blog List",'alterna'),
		"base" => "blog_list",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Posts Number",'alterna'),
			 "param_name" => "number",
			 "value" => '4',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Columns",'alterna'),
			 "param_name" => "columns",
			 "value" => '4',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Type",'alterna'),
			 "param_name" => "type",
			 "value" => array('recent','related','popular','featured')
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Style",'alterna'),
			 "param_name" => "style",
			 "value" => array('1','2','3','4'),
			 "description" => __("Show item style.",'alterna')
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order By",'alterna'),
			 "param_name" => "orderby",
			 "value" => '',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order",'alterna'),
			 "param_name" => "order",
			 "value" => array('DESC','ASC')
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Categories ids use , ",'alterna'),
			 "param_name" => "cat__in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tags ids use , ",'alterna'),
			 "param_name" => "tag__in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Included post ids use , ",'alterna'),
			 "param_name" => "post__in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Not included post ids use , ",'alterna'),
			 "param_name" => "post__not_in",
			 "value" => '',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image don't crop",'alterna'),
			 "param_name" => "nocrop",
			 "value" => array('off','on')
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Element show with effect",'alterna'),
			 "param_name" => "effect",
			 "value" => $effect_list
		  )
		 )
	));

	/* portfolio list */
	wpb_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Portfolio List",'alterna'),
		"base" => "portfolio_list",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Posts Number",'alterna'),
			 "param_name" => "number",
			 "value" => '4',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Columns",'alterna'),
			 "param_name" => "columns",
			 "value" => '4',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Type",'alterna'),
			 "param_name" => "type",
			 "value" => array('recent','related','featured')
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Show Style",'alterna'),
			 "param_name" => "style",
			 "value" => array('1','2','3','4'),
			 "description" => __("Show item style.",'alterna')
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order By",'alterna'),
			 "param_name" => "orderby",
			 "value" => '',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order",'alterna'),
			 "param_name" => "order",
			 "value" => array('DESC','ASC')
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Categories slugs use , ",'alterna'),
			 "param_name" => "cat_slug_in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Tags slugs use , ",'alterna'),
			 "param_name" => "tag_slug_in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Included post ids use , ",'alterna'),
			 "param_name" => "post__in",
			 "value" => '',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Not included post ids use , ",'alterna'),
			 "param_name" => "post__not_in",
			 "value" => '',
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image don't crop",'alterna'),
			 "param_name" => "nocrop",
			 "value" => array('off','on')
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Element show with effect",'alterna'),
			 "param_name" => "effect",
			 "value" => $effect_list
		  )
		)
	));
	
	/* youtube */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Youtube",'alterna'),
		"base" => "youtube",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Youtube ID",'alterna'),
				"param_name" => "id",
				"value" => '',
				"description" => __("Enter video ID (eg.6htyfxPkYDU).",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width",'alterna'),
				"param_name" => "width",
				"value" => '100%',
				"description" => __("Youtube default show width.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height",'alterna'),
				"param_name" => "height",
				"value" => '360',
				"description" => __("Youtube default show width.",'alterna')
				)
		)
	));
	
	/* vimeo */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Vimeo",'alterna'),
		"base" => "vimeo",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Vimeo ID",'alterna'),
				"param_name" => "id",
				"value" => '',
				"description" => __("Enter video ID (eg.54578415).",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width",'alterna'),
				"param_name" => "width",
				"value" => '100%',
				"description" => __("Vimeo default show width.",'alterna')
				),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height",'alterna'),
				"param_name" => "height",
				"value" => '360',
				"description" => __("Vimeo default show width.",'alterna')
				)
		)
	));
	
	/* Soundcloud */
	vc_map( array(
		"icon" => "icon-wpb-alterna",
		"name" => __("Alterna Soundcloud",'alterna'),
		"base" => "soundcloud",
		"class" => "",
		"controls" => "full",
		"category" => __('Alterna Content','alterna'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Soundcloud URL",'alterna'),
				"param_name" => "url",
				"value" => '',
				"description" => __("Enter soundcloud url like http://api.soundcloud.com/tracks/38987054.",'alterna')
				)
		)
	));
	
}

}