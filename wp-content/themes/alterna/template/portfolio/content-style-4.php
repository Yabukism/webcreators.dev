<?php
/**
 * Portfolio Item Content Style 4
 *
 * @since alterna 7.0
 */
global $thumbnail_size, $page_columns;
$portfolio_type = intval(penguin_get_post_meta_key('portfolio-type'));
?>
    <div class="portfolio-wrap">
		<div class="portfolio-img">
        <?php
			if( has_post_thumbnail(get_the_ID())) {
				echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size);
			}else{
				echo '<img src="'.get_template_directory_uri().'/img/portfolio-no-thumbs.png" alt="">' ;
			}
		?>
			<div class="post-mask-content">
                    <div class="centered">
                        <h4 class="entry-title" itemprop="name"><a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" itemprop="url"><?php echo get_the_title(); ?></a></h4>
                        <a class="btn btn-theme" href="<?php echo esc_url(get_permalink()); ?>"><?php echo _e('View Details','alterna'); ?></a>
                    </div>
            </div>
        </div>
    </div>
</article>