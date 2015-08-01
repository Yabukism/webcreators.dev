<?php
/**
 * Blog Shortcode Content Style 3
 *
 * @since alterna 7.0
 */
global $blog_shortcode_content, $blog_shortcode_thumbnail_size;

$output = '';

$output .= '<div class="post-element-content">
				<div class="post-img"><a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail(get_the_ID(), $blog_shortcode_thumbnail_size , array('alt' => get_the_title(),'title' => '')).'</a>
				</div>
			</div>';

$output .= '<section class="post-content">
				<header class="entry-header">
					<h4 class="entry-title" itemprop="name">
						<div class="post-type">
							<span class="'.alterna_get_post_type_icon(get_post_format()).'"></span>
							</div><a href="' . esc_url( get_permalink() ) . '" itemprop="url">'.get_the_title().'</a></h4>
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
