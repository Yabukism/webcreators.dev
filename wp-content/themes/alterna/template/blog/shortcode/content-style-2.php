<?php
/**
 * Blog Shortcode Content Style 2
 *
 * @since alterna 7.0
 */
global $blog_shortcode_content, $blog_shortcode_thumbnail_size;

$output = '';

$output .= '<div class="post-element-content">
				<div class="post-img"><a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail(get_the_ID(), $blog_shortcode_thumbnail_size , array('alt' => get_the_title(),'title' => '')).'</a>
				</div>
				';
$output	.=		'<div class="date" class="entry-date updated" itemprop="datePublished" datetime="'.esc_attr( get_the_date( 'c' ) ).'"><span class="day">'.get_the_date('d').'</span><span class="month">'.get_the_date('M').'</span><span class="year">'.get_the_date('Y').'</span></div>';
					
$num_comments = get_comments_number(get_the_ID());

$output .=		'<div class="post-comments"><a href="'.get_permalink(get_the_ID()).'#comments'.'"><i class="fa fa-comments"></i>'.esc_attr($num_comments).'</a></div>';
					
$output	.=	'</div>';

$output .= '<section class="post-content">
				<header class="entry-header">
					<h4 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">'.get_the_title().'</a></h4>
				</header>';

$output .= 	'</section>';

$blog_shortcode_content = $output;
?>