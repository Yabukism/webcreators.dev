<?php
/**
 * Portfolio Shortcode Content Style 4
 *
 * @since alterna 7.0
 */
global $portfolio_shortcode_content, $portfolio_shortcode_thumbnail_size;
$output = '';

$output .= '<div class="portfolio-wrap">
					<div class="portfolio-img">';
	
						if( has_post_thumbnail(get_the_ID())) {
							$output .= get_the_post_thumbnail(get_the_ID(), $portfolio_shortcode_thumbnail_size);
						}else{
							$output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
						}
	
	$output .= 			'<div class="post-mask-content">
							<div class="centered">
								<h4 class="entry-title" itemprop="name"><a href="'.esc_url(get_permalink(get_the_ID())).'" itemprop="url">'.get_the_title().'</a></h4>
								<a class="btn btn-theme" href="'.esc_url(get_permalink()).'" target="_self">'.__('View Details','alterna').'</a>
							</div>
						</div>
					</div>
			</div>';
			
$portfolio_shortcode_content = $output;
?>
