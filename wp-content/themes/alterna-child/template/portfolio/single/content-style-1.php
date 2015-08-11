<?php
/**
 * Portfolio Single Page Style 1
 *
 * @since alterna 7.0
 */
$portfolio_type = intval(penguin_get_post_meta_key('portfolio-type'));
$thumbnail_size = 'alterna-nocrop-thumbs';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry'); ?> itemscope itemtype="http://schema.org/CreativeWork">
   <div class="single-portfolio-left-content" >
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
      <div class="post-meta">
        <div class="post-date">
          <i class="fa fa-calendar"></i><span class="entry-date updated" itemprop="datePublished"><?php _e('投稿日:','alterna'); ?><?php echo esc_html(get_the_date()); ?></span>
        </div>
        <div class="post-date">
          <i class="fa fa-calendar"></i><?php _e('更新日:','alterna'); ?><span class="entry-date updated" itemprop="dateModified"><?php the_modified_date(); ?></span>
        </div>
        <div class="post-date">
         <?php foreach (get_the_terms($post->ID,'country') as $cat) : ?>
           <?php z_taxonomy_image($cat->term_id); ?>
           <a href="<?php echo get_term_link($cat->slug, 'country'); ?>"><?php echo $cat->name; ?></a>
         <?php endforeach; ?>
       </div>
       <div class="post-date">
         <?php foreach (get_the_terms($post->ID,'historyformat') as $cat) : ?>
           <?php z_taxonomy_image($cat->term_id); ?>
           <a href="<?php echo get_term_link($cat->slug, 'historyformat'); ?>"><?php echo $cat->name; ?></a>
         <?php endforeach; ?>
       </div>
     </div>
     <div class="entry-content" itemprop="text">
      <?php the_content(); ?>

      <?php if (is_object_in_term($post->ID, 'historyformat',
        array('movie','drama'))){
        get_template_part( 'template/portfolio/content','movie');
      } ?>

      <?php wp_link_pages(); ?>
    </div>
    <div class="footnote">
      <?php dynamic_sidebar ('sidebar-5'); ?>
    </div>
    <?php if(penguin_get_options_key('portfolio-enable-share') == "on") { ?>
    <div class="portfolio-share">
      <?php echo do_shortcode('[easy-social-share buttons="facebook,twitter,google,pinterest" counters=0 native="no"  native="no" counters=1 counter_pos="insidename" style="button"]'); ?> 
   

   </div>
   <?php } ?>
   <?php comments_template(); ?>

</div>
<?php
if(penguin_get_options_key('portfolio-related-enable') == "on") { ?>
<div class="post-related">
  <div class="alterna-title">
  <h3><?php _e('近い年代のできごと' , 'alterna'); ?></h3>
    <div class="line"></div>
  </div>
  <?php
  $cat_slugs = alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',true,",",'slug');
  if($cat_slugs != ""){
   $related_style = intval(penguin_get_post_meta_key('related-items-style'));
   $show_number = intval(penguin_get_options_key('portfolio-related-num'));
   if($related_style == 0){
    $related_style = intval(penguin_get_options_key('portfolio-related-style')) + 1;
  }
  if($show_number == 0){
    $show_number = 4;
  }
  echo do_shortcode('[portfolio_list columns="4" number="'.esc_attr($show_number).'" style="'.esc_attr($related_style).'" type="related" cat_slug_in="'.esc_attr($cat_slugs).'" post__not_in="'.get_the_ID().'"]');
}
?>
</div>
<?php } ?>
</article>
