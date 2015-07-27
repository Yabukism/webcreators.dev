<?php
/**
 * Portfolio Single Page Style 1
 *
 * @since alterna 7.0
 */
$portfolio_type = intval(penguin_get_post_meta_key('portfolio-type'));
$thumbnail_size = 'alterna-nocrop-thumbs';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry single1'); ?> itemscope itemtype="http://schema.org/CreativeWork">
  <div class="row">
    <div class="single-portfolio-left-content col-lg-12 col-md-12 col-sm-12" >
     <?php if($portfolio_type == 1) { ?>
     <div class="post-element-content">
      <div class="flexslider alterna-fl post-gallery">
        <ul class="slides">
          <?php
          if( has_post_thumbnail(get_the_ID())) {
            $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size);
            $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            ?>
            <li>
              <a href="<?php echo esc_url($full_image[0]); ?>" class="fancybox-thumb" rel="fancybox-thumb[<?php echo get_the_ID(); ?>]"><img src="<?php echo esc_url($attachment_image[0]); ?>" alt="" ></a>
            </li>
            <?php } ?>
            <?php echo alterna_get_gallery_list(get_the_ID() , $thumbnail_size);?>
          </ul>
        </div>
      </div>
      <?php }elseif($portfolio_type == 2 && $portfolio_type != '') { ?>
      <div class="post-element-content">
        <?php
        echo do_shortcode('['.(intval(penguin_get_post_meta_key('video-type')) == 0 ? 'youtube' : 'vimeo').' id="'.penguin_get_post_meta_key('video-content').'" width="100%" height="300"]');
        ?>
      </div>
      <?php }else{ ?>
      <?php if(has_post_thumbnail(get_the_ID())) { ?>
      <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size); ?>
      <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
      <div class="post-element-content">
        <a href="<?php echo $full_image[0]; ?>" class="fancyBox">
          <div class="post-img">
            <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
          </div>
        </a>
      </div>
      <?php } ?>
      <?php } ?>
      <?php the_title( '<h3 class="entry-title" itemprop="name"><a href="' . esc_url( get_permalink() ) . '" itemprop="url">', '</a></h3>' ); ?>
      <?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="fa fa-edit"></i>', '</div>'); ?>
      <div class="entry-content" itemprop="text">
       <?php the_content(); ?>
       <?php wp_link_pages(); ?>
     </div>





     <?php if(penguin_get_options_key('portfolio-enable-share') == "on") { ?>
     <div class="portfolio-share">
       <?php echo  penguin_get_options_key('portfolio-share-code'); ?>
     </div>
     <?php } ?>



     <div class="post-related">
      <div class="alterna-title">
        <h3><?php _e('You may also like' , 'alterna'); ?></h3>
        <div class="line"></div>
      </div>
      <?php echo do_shortcode('[related_posts_by_tax posts_per_page="3" format="thumbnails" taxonomies="country,portfolio_categories,era-name" title=""]'); ?>
    </div>

  </div>
</div>
</article>
