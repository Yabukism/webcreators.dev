<?php
/**
 * Portfolio Shortcode Content Style 3
 *
 * @since alterna 7.0
 */
global $portfolio_shortcode_content, $portfolio_shortcode_thumbnail_size;
$output = '';
$output .= '<div class="portfolio-wrap">
				<a href="'.esc_url(get_permalink()).'" >
					<div class="portfolio-img">';
					if( has_post_thumbnail(get_the_ID())) {
						$output .= get_the_post_thumbnail(get_the_ID(), $portfolio_shortcode_thumbnail_size);
					}else{
						$output .= '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
					}
$output .= '</div>
    	</a>
    </div>
    <div class="portfolio-content">
        <div class="portfolio-title">
			<div class="portfolio-type">
                <span class="'.alterna_get_post_type_icon(penguin_get_post_meta_key('portfolio-type'),'portfolio').'"></span>
            </div>
            <h4 class="entry-title" itemprop="name"><a href="'.esc_url(get_permalink()).'" itemprop="url">'.get_the_title().'</a></h4>
        </div>
    </div>';

$portfolio_shortcode_content = $output;
?>
