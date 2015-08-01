<?php
/**
 * Portfolio Item Content Style 2
 *
 * @since alterna 7.0
 */
global $thumbnail_size, $page_columns;
$portfolio_type = intval(penguin_get_post_meta_key('portfolio-type'));
?>
    <div class="portfolio-wrap">
    	<a href="<?php echo esc_url(get_permalink(get_the_ID()));?>" itemprop="url">
			<div class="portfolio-img">
			<?php 
			if( has_post_thumbnail(get_the_ID())) {
				echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size);
			}else{
				echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
			}
			?>
			</div>
			<div class="post-tip">
            	<div class="bg"></div>
				<div class="post-tip-info">
                	<?php if(intval($page_columns) == 2) { ?>
                    <h5 class="entry-title" itemprop="name"><?php the_title(); ?></h5>
                    <?php }else{ ?>
                    <h4 class="entry-title" itemprop="name"><?php the_title(); ?></h4>
                    <?php } ?>
                    <p><?php echo penguin_string_limit_words(get_the_excerpt(),8); ?><?php
                    if(penguin_get_post_meta_key('portfolio-client') != "") {
                        echo '<span class="portfolio-client"><strong>'.__('Client: ','alterna').'</strong>'.esc_html(penguin_get_post_meta_key('portfolio-client')).'</span>';
                    }
                 	?></p>
            	</div>
        	</div>
    	</a>
    </div>
</article>