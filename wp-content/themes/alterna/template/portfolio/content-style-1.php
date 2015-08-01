<?php
/**
 * Portfolio Item Content Style 1
 *
 * @since alterna 7.0
 */
global $thumbnail_size, $page_columns;
$portfolio_type = intval(penguin_get_post_meta_key('portfolio-type'));
?>
    <div class="portfolio-wrap">
    <?php 	
    // show gallery
    if($portfolio_type == 1) {
    ?>
        <div class="flexslider alterna-fl">
            <ul class="slides">
            <?php
                if( has_post_thumbnail(get_the_ID())) {
                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size);
                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
            ?>
                <li>
                    <a href="<?php echo esc_url($full_image[0]); ?>" class="fancybox-thumb" rel="fancybox-thumb[<?php echo get_the_ID(); ?>]"><img src="<?php echo esc_url($attachment_image[0]); ?>" alt="" ></a>
                </li>
            <?php 
                }
                echo alterna_get_gallery_list(get_the_ID() , $thumbnail_size); 
            ?>
            </ul>
        </div>
    <?php
        // show video with youtube or vimeo
    } else  if($portfolio_type == 2 && penguin_get_post_meta_key('video-content') != '') {
            echo do_shortcode('['.(intval(penguin_get_post_meta_key('video-type')) == 0 ? 'youtube' : 'vimeo').' id="'.penguin_get_post_meta_key('video-content').'" width="100%" height="300"]');
    } else {
    ?>
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
            <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
            <a href="<?php echo esc_url(get_permalink()); ?>"><div class="link left-link"><i class="big-icon-link"></i></div></a>
            <a href="<?php echo esc_url($full_image[0]); ?>" class="fancyBox"><div class="link right-link"><i class="big-icon-preview"></i></div></a>
        </div>
    <?php 
    }
    ?>
    </div>
    <div class="portfolio-content">
        <header>
            <?php if(intval($page_columns) == 2) { ?>
            <h5 class="entry-title" itemprop="name"><a href="<?php echo esc_url(get_permalink()); ?>" itemprop="url"><?php the_title(); ?></a></h5>
            <?php }else{ ?>
            <h4 class="entry-title" itemprop="name"><a href="<?php echo esc_url(get_permalink()); ?>" itemprop="url"><?php the_title(); ?></a></h4>
            <?php } ?>
            <span class="portfolio-categories" itemprop="genre"><?php echo alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false) , ' / '); ?></span>
        </header>
    </div>
</article>