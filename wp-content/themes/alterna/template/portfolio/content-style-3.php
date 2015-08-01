<?php
/**
 * Portfolio Item Content Style 3
 *
 * @since alterna 7.0
 */
global $thumbnail_size, $page_columns;
?>
    <div class="portfolio-wrap">
    	<a href="<?php echo esc_url(get_permalink());?>" >
			<div class="portfolio-img">
			<?php if( has_post_thumbnail(get_the_ID())) {
                echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size);
            }else{
                echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
            }?>
        	</div>
    	</a>
    </div>
    <div class="portfolio-content">
        <div class="portfolio-title">
        	<div class="portfolio-type">
                <span class="<?php echo alterna_get_post_type_icon(penguin_get_post_meta_key('portfolio-type'),'portfolio');?>"></span>
            </div>
           <?php if(intval($page_columns) == 2) { ?>
            <h5 class="entry-title" itemprop="name"><a href="<?php echo esc_url(get_permalink()); ?>" itemprop="url"><?php the_title(); ?></a></h5>
            <?php }else{ ?>
            <h4 class="entry-title" itemprop="name"><a href="<?php echo esc_url(get_permalink()); ?>" itemprop="url"><?php the_title(); ?></a></h4>
            <?php } ?>
        </div>
    </div>
</article>