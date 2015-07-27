<?php
/**
 * Portfolio Single Page Style 3
 *
 * @since alterna 8.0 custom
 */
$portfolio_type	=	intval(penguin_get_post_meta_key('portfolio-type'));
$thumbnail_size	=	'alterna-nocrop-thumbs';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry'); ?> itemscope itemtype="http://schema.org/CreativeWork">
  <div class="row history3">
   <div class="single-portfolio-left-content col-lg-8 col-md-6 col-sm-6" >
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
     <?php if (is_object_in_term($post->ID, 'historyformat','movie')){
      get_template_part( 'template/portfolio/content','movie');
    } ?>
    <?php wp_link_pages(); ?>
  </div>
</div>

<div class="single-portfolio-right-content col-lg-4 col-md-6 col-sm-6">
  <?php if($portfolio_type == 1) { ?>
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
  <?php }elseif($portfolio_type == 2 && $portfolio_type != '') { ?>
  <?php
  echo do_shortcode('['.(intval(penguin_get_post_meta_key('video-type')) == 0 ? 'youtube' : 'vimeo').' id="'.penguin_get_post_meta_key('video-content').'" width="100%" height="300"]');
  ?>
  <?php }else{ ?>
  <?php if(has_post_thumbnail(get_the_ID())) { ?>
  <?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size); ?>
  <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
  <a href="<?php echo $full_image[0]; ?>" class="fancyBox">
    <div class="post-img">
     <img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
   </div>
 </a>
 <?php } ?>
 <?php } ?>


 <ul class="single-portfolio-meta single-portfolio-style-3">

   <li>
    <div class="type"><i class="fa fa-group"></i><?php _e('Country','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID,  'country' );
      if ( ! empty( $product_terms ) ) {
        if ( ! is_wp_error( $product_terms ) ) {
          foreach( $product_terms as $term ) {
            echo '<a href="' . get_term_link( $term->slug, 'country' ) . '">' . esc_html( $term->name ) . '</a>';
          }
        }
      }
      ?>
    </div>
  </li>

  <li>
    <div class="type"><i class="fa fa-folder-open"></i><?php _e('Categories','alterna'); ?></div>
    <div class="value" itemprop="genre"><?php echo alterna_get_custom_portfolio_category_links( alterna_get_custom_post_categories(get_the_ID(),'portfolio_categories',false)  , ' / '); ?></div>
  </li>
  <?php if(penguin_get_post_meta_key('portfolio-client') != "") { ?>
  <li>
    <div class="type"><i class="fa fa-user"></i>&nbsp;<?php _e('Client','alterna'); ?></div>
    <div class="value" itemprop="author"><?php echo esc_attr(penguin_get_post_meta_key('portfolio-client')); ?></div>
  </li>
  <?php } ?>
  <?php if(penguin_get_post_meta_key('portfolio-skills') != "") { ?>
  <li>
    <div class="type"><i class="fa fa-bolt"></i><?php _e('Skills','alterna'); ?></div>
    <div class="value"><?php echo esc_attr(penguin_get_post_meta_key('portfolio-skills')); ?></div>
  </li>
  <?php } ?>
  <?php if(penguin_get_post_meta_key('portfolio-colors') != "") { ?>
  <li>
    <div class="type"><i class="fa fa-adjust"></i><?php _e('Colors','alterna'); ?></div>
    <div class="value"><?php echo alterna_get_color_list(penguin_get_post_meta_key('portfolio-colors')); ?></div>
  </li>
  <?php } ?>
  <?php if(penguin_get_post_meta_key('portfolio-system') != "") { ?>
  <li>
    <div class="type"><i class="fa fa-desktop"></i><?php _e('Used System','alterna'); ?></div>
    <div class="value"><?php echo esc_attr(penguin_get_post_meta_key('portfolio-system')); ?></div>
  </li>
  <?php } ?>
  <?php if(penguin_get_post_meta_key('portfolio-price') != "") { ?>
  <li>
    <div class="type"><i class="fa fa-usd"></i><?php _e('Price','alterna'); ?></div>
    <div class="value"><?php echo esc_attr(penguin_get_post_meta_key('portfolio-price')); ?></div>
  </li>
  <?php } ?>

  <?php alterna_get_portfolio_custom_fields(penguin_get_post_meta_key('portfolio-custom-fields')); ?>

  <?php if(penguin_get_post_meta_key('portfolio-link') != ""){ ?>
  <li>
    <div class="type"><i class="fa fa-link"></i><?php _e('Link','alterna'); ?></div>
    <div class="value"><a href="<?php echo esc_url(penguin_get_post_meta_key('portfolio-link')); ?>"><?php echo esc_url(penguin_get_post_meta_key('portfolio-link')); ?></a></div>
  </li>
  <?php } ?>

  <?php if(post_custom('wpcf-start-year')): ?>
    <li>
      <div class="type"><i class="fa fa-history"></i><?php _e('Start date','alterna'); ?></div>
      <div class="value">
        <?php echo post_custom('wpcf-start-era'); ?><?php echo post_custom('wpcf-start-year'); ?>

        <?php if(post_custom('wpcf-start-month')): ?><?php _e('-','alterna'); ?>
          <?php echo post_custom('wpcf-start-month'); ?>
        <?php endif; ?>

        <?php if(post_custom('wpcf-start-day')): ?><?php _e('-','alterna'); ?>
          <?php echo post_custom('wpcf-start-day'); ?>
        <?php endif; ?>
      </div>
    </li>
  <?php endif; ?>

  <?php if(post_custom('wpcf-end-year')): ?>
    <li>
      <div class="type"><i class="fa fa-history"></i><?php _e('End date','alterna'); ?></div>
      <div class="value">
        <?php echo post_custom('wpcf-end-era'); ?><?php echo post_custom('wpcf-end-year'); ?>

        <?php if(post_custom('wpcf-end-month')): ?><?php _e('-','alterna'); ?>
          <?php echo post_custom('wpcf-end-month'); ?>
        <?php endif; ?>

        <?php if(post_custom('wpcf-end-day')): ?><?php _e('-','alterna'); ?>
          <?php echo post_custom('wpcf-end-day'); ?>
        <?php endif; ?>
      </div>
    </li>
  <?php endif; ?>

  <li>
    <div class="type"><i class="fa fa-institution"></i><?php _e('Era name','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID,  'era-name' );
      if ( ! empty( $product_terms ) ) {
        if ( ! is_wp_error( $product_terms ) ) {
          foreach( $product_terms as $term ) {
            echo '<a href="' . get_term_link( $term->slug, 'era-name' ) . '">' . esc_html( $term->name ) . '</a>';
          }
        }
      }
      ?>

    </div>
  </li>

  <li>
    <div class="type"><i class="fa fa-group"></i><?php _e('Ethnic','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID,  'historypeople' );
      if ( ! empty( $product_terms ) ) {
        if ( ! is_wp_error( $product_terms ) ) {
          foreach( $product_terms as $term ) {
            echo '<a href="' . get_term_link( $term->slug, 'historypeople' ) . '">' . esc_html( $term->name ) . '</a>';
          }
        }
      }
      ?>
    </div>
  </li>
</ul>

<?php edit_post_link(__('Edit', 'alterna'), '<div class="post-edit"><i class="fa fa-edit"></i>', '</div>'); ?>
<?php if(penguin_get_options_key('portfolio-enable-share') == "on") { ?>
<div class="portfolio-share">
 <?php echo  penguin_get_options_key('portfolio-share-code'); ?>
</div>
<?php } ?>
</div>
</div>
<?php if(penguin_get_options_key('portfolio-related-enable') == "on") { ?>
<div class="post-related">
  <div class="alterna-title">
    <h3><?php _e('You may also like' , 'alterna'); ?></h3>
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
}	?>
</div>
<?php } ?>
<div class="footnote">
  <?php generated_dynamic_sidebar('Footnote'); ?>
</div>
</article>
