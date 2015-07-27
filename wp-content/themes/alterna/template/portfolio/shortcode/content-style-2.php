<?php
/**
 * Portfolio Shortcode Content Style 2
 *
 * @since alterna 7.0
 */
global $portfolio_shortcode_content, $portfolio_shortcode_thumbnail_size;
$output = '';

$output .= '<div class="portfolio-wrap">
				<a href="'.esc_url(get_permalink(get_the_ID())).'" itemprop="url">
					<div class="portfolio-img">';
					if( has_post_thumbnail(get_the_ID())) {
						$output .= get_the_post_thumbnail(get_the_ID(), $portfolio_shortcode_thumbnail_size);
					}else{
						$output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
					}
$output .= 			'</div>
					<div class="post-tip">
						<div class="bg"></div>
						<div class="post-tip-info">
							<h4 class="entry-title" itemprop="name">'.get_the_title().'</h4>
							<p>'.penguin_string_limit_words(get_the_excerpt(),8);
							
							if(penguin_get_post_meta_key('portfolio-client') != "") {
								$output .= '<span class="portfolio-client"><strong>'.__('Client: ','alterna').'</strong>'.esc_html(penguin_get_post_meta_key('portfolio-client')).'</span>';
							}
$output .= 					'</p>
						</div>
					</div>
				</a>
			</div>';

$portfolio_shortcode_content = $output;
?>
