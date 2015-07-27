<?php
/**
 * Portfolio Widget Recent Style 1
 *
 * @since alterna 7.0
 */
global $portfolio_recent_post_content;
$output = '';

$output .= '<div class="sidebar-portfolio-recent icon-style">
				<div class="post-type"><span class="'.alterna_get_post_type_icon(penguin_get_post_meta_key('portfolio-type'),'portfolio').'"></span></div>
				<div class="post-content">
					<h5 class="entry-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h5>
					<div class="portfolio-categories">'.alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / ').'</div>
				</div>
			</div>';



$portfolio_recent_post_content = $output;
?>
