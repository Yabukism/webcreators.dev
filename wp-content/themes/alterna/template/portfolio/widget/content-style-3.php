<?php
/**
 * Portfolio Widget Recent Style 3
 *
 * @since alterna 7.0
 */
global $portfolio_recent_post_content;
$output = '';
$thumbnail_size = 'alterna-s-thumbs';

$output .= '<div class="sidebar-portfolio-recent big-thumbs-style">';

if(has_post_thumbnail(get_the_ID())) {
$output .= '<a href="'.esc_url(get_permalink()).'"><div class="post-img">
				'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size , array('alt' => get_the_title(),'title' => '')).'
				<div class="post-tip">
            		<div class="bg"></div>
					<span class="link"><span class="'.alterna_get_post_type_icon(penguin_get_post_meta_key('portfolio-type'),'portfolio').'"></span></span>
				</div>
			</div></a>';
}
$output .= '<div class="post-content">
				<h5 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h5>
			</div>';
$output .= '</div>';

$portfolio_recent_post_content = $output;
?>
