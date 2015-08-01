<?php
/**
 * Blog Shortcode Content Style 4
 *
 * @since alterna 7.0
 */
global $blog_shortcode_content, $blog_shortcode_thumbnail_size;

$output = '';

$output .= '<div class="post-element-content">
				<a href="'.esc_url(get_permalink()).'"><div class="post-img">'.get_the_post_thumbnail(get_the_ID(), $blog_shortcode_thumbnail_size , array('alt' => get_the_title(),'title' => '')).'
				</div>
				';
$output .= 		'<div class="post-cover"></div><h5 class="post-element-title">'.get_the_title().'</h5></a>';
$output	.=		'<div class="date" class="entry-date updated" itemprop="datePublished" datetime="'.esc_attr( get_the_date( 'c' ) ).'"><span class="day">'.get_the_date('d').'</span><span class="month">'.get_the_date('M').'</span><span class="year">'.get_the_date('Y').'</span></div>';
					
$num_comments = get_comments_number(get_the_ID());

$output .=		'<div class="post-comments"><a href="'.get_permalink(get_the_ID()).'#comments'.'"><i class="fa fa-comments"></i>'.esc_attr($num_comments).'</a></div>';
					
$output	.=	'</div>';

$output .= '<section class="post-content">
				<header class="entry-header">
					<h4 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">'.get_the_title().'</a></h4>
				</header>';
if(get_post_format() != "quote") {

$output .= 	'	<div class="entry-summary" itemprop="articleSection">
					'.penguin_string_limit_words(get_the_excerpt()).'
				</div>';
}
$output .= 	'	<a class="more-link" href="'.esc_url( get_permalink() ).'">'.__('Read More','alterna').'</a>
			</section>';

$blog_shortcode_content = $output;
?>