<?php
/**
 * Portfolio Shortcode Content Style 1
 *
 * @since alterna 7.0
 */
global $portfolio_shortcode_content, $portfolio_shortcode_thumbnail_size;
$output = '';

// get portfolio item type
$portfolio_type = get_post_meta($post->ID, 'post-foramt', true); 
	
if(intval($portfolio_type) == 0){
	if(has_post_thumbnail(get_the_ID())) {
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$output .= '<div class="post-img">
				<a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail(get_the_ID(), $portfolio_shortcode_thumbnail_size , array('alt' => get_the_title(),'title' => '')).'
				</a>
				<div class="post-tip">
					<div class="bg"></div>
					<a href="'.esc_url(get_permalink()).'"><div class="link left-link"><i class="big-icon-link"></i></div></a>
					<a href="'.esc_url($full_image[0]).'" class="fancyBox"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
				</div>
			</div>';
	}
}else if(intval($portfolio_type) == 1){
	// get post gallery list
$output .= '<div class="flexslider alterna-fl post-gallery">
				<ul class="slides">';
					$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$output .= 			'<li><a href="'.esc_url($full_image[0]).'" class="fancybox-thumb" rel="fancybox-thumb['.get_the_ID().']"><img src="'.esc_url($attachment_image[0]).'" alt=""></a></li>'.alterna_get_gallery_list(get_the_ID(), $portfolio_shortcode_thumbnail_size);
$output .= '	</ul>
			</div>';
}else if(intval($portfolio_type) == 2){
	// get video conent type
	$video_type 	= penguin_get_post_meta_key('video-type');
	// get custom video type content
	$video_content 	= penguin_get_post_meta_key('video-content');
$output .= '<div class="post-video">';
	if(intval($video_type) == 0){
		$output .= do_shortcode('[youtube id="'.$video_content.'" width="100%" height="300"]');
	}else if(intval($video_type) == 1){
		$output .= do_shortcode('[vimeo id="'.$video_content.'" width="100%" height="300"]');
	}else{
	   $output .=  $video_content;
	}
$output .= '</div>';
}
$output .= '<div class="portfolio-content">
				<header>
					<h4 class="entry-title" itemprop="name"><a href="'.esc_url(get_permalink()).'" itemprop="url">'.get_the_title().'</a></h4>
					<span class="portfolio-categories" itemprop="genre">'.alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / ').'</span>
				</header>
			</div>';

$portfolio_shortcode_content = $output;
?>
