<?php
/**
 * Blog Shortcode Content Style 1
 *
 * @since alterna 7.0
 */
global $blog_shortcode_content, $blog_shortcode_thumbnail_size;

$output = '';

if(get_post_format() == "video"){
	$video_type = get_post_meta(get_the_ID(), 'video-type', true);
	$video_content = get_post_meta(get_the_ID(), 'video-content', true);
	if($video_content && $video_content != ''){
$output .= '<div class="post-element-content">
				<div class="post-video">';
                if(intval($video_type) == 0){
					$output .= do_shortcode('[youtube id="'.$video_content.'" width="100%" height="300"]');
                }else if(intval($video_type) == 1){
                    $output .= do_shortcode('[vimeo id="'.$video_content.'" width="100%" height="300"]');
                }else{
                	$output .= $video_content;
                }
$output .= '	</div>
			</div>';
      }
}else if(get_post_format() == "gallery"){
$output .= '<div class="post-element-content">
				<div class="flexslider alterna-fl post-gallery">
					<ul class="slides">';
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                    	$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$output .= 				'<li><a href="'.esc_url($full_image[0]).'" class="fancybox-thumb" rel="fancybox-thumb['.get_the_ID().']"><img src="'.esc_url($attachment_image[0]).'" alt=""></a></li>'.alterna_get_gallery_list(get_the_ID(), $blog_shortcode_thumbnail_size);

$output .= '		</ul>
				</div>
			</div>';
}else{
	if(has_post_thumbnail(get_the_ID())) {
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
$output .= '<div class="post-element-content">
				<div class="post-img"><a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail(get_the_ID(), $blog_shortcode_thumbnail_size , array('alt' => get_the_title(),'title' => '')).'</a>
					<div class="post-tip">
                    <div class="bg"></div>
                    <a href="'.get_permalink().'"><div class="link left-link"><i class="big-icon-link"></i></div></a>
                    <a href="'.esc_url($full_image[0]).'" class="fancyBox"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
                </div>
				</div>
			</div>';
	}
}

$output .= '<section class="post-content">
				<header class="entry-header">
					<h4 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">'.get_the_title().'</a></h4>
					<div class="entry-meta">
						<span class="entry-date"><a href="'.esc_url( get_permalink() ).'"><time class="entry-date updated" itemprop="datePublished" datetime="'.esc_attr( get_the_date( 'c' ) ).'"><i class="fa fa-clock-o"></i>'.esc_html( get_the_date() ).'</time></a></span>';

if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

$num_comments = get_comments_number(get_the_ID());
$output .= '<span class="comments-link"><a href="'.get_permalink(get_the_ID()).'#comments"><i class="fa fa-comments-o"></i><span itemprop="interactionCount">'.$num_comments.'</span></a></span>';

}
					
$output .= 	'		</div>
				</header>';

$output .= 	'</section>';

$blog_shortcode_content = $output;
?>
