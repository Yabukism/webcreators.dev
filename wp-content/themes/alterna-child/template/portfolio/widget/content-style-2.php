<?php
/**
 * Portfolio Widget Recent Style 2
 *
 * @since alterna 7.0
 */
global $portfolio_recent_post_content;
$output = '';
$thumbnail_size = 'thumbnail';

$output .= '<div class="sidebar-portfolio-recent thumbs-style">';

if(has_post_thumbnail(get_the_ID())) { 
$output .= '<aside class="post-thumbs"><a href="'.esc_url(get_permalink()).'"><div class="post-img">
				'.get_the_post_thumbnail(get_the_ID(), $thumbnail_size , array('alt' => get_the_title(),'title' => '')).'
			</div></a></aside>';
}
$output .= '<div class="post-content">
					<h5 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h5>
					<div class="portfolio-categories">'.alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / ').'</div>
				</div>
			</div>';

$portfolio_recent_post_content = $output;
?>
