<?php
/**
 * Sidebar 2
 *
 * @since alterna 7.0
 */
?>
<div class="widget widget_search_filter_register_widget">
  <h3 class="widget-title"><span><?php _e('検索','alterna'); ?></span></h3>
  <?php echo do_shortcode('[searchandfilter id="3038"]' ); ?>
</div>
<div class="clear"></div>
<div class="widget">
  <h3 class="widget-title"><span><?php _e('この記事の情報','alterna'); ?></span></h3>
  <ul class="single-portfolio-meta single-portfolio-style-3">
   <li>
    <div class="type"><i class="fa fa-group"></i><?php _e('国名','alterna'); ?></div>
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
    <div class="type"><i class="fa fa-folder-open"></i><?php _e('年代','alterna'); ?></div>
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
      <div class="type"><i class="fa fa-history"></i><?php _e('開始','alterna'); ?></div>
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
      <div class="type"><i class="fa fa-history"></i><?php _e('終了','alterna'); ?></div>
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
    <div class="type"><i class="fa fa-institution"></i><?php _e('時代','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID, 'era-name' );
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
    <div class="type"><i class="fa fa-group"></i><?php _e('民族','alterna'); ?></div>
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
  <?php if(post_custom('wpcf-president')): ?>
    <li>
      <div class="type"><i class="fa fa-graduation-cap"></i><?php _e('皇帝','alterna'); ?></div>
      <div class="value">
        <?php echo post_custom('wpcf-president'); ?>
      </div>
    </li>
  <?php endif; ?>
  <li>
    <div class="type"><i class="fa fa-building"></i><?php _e('建築','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID,  'historybuilding' );
      if ( ! empty( $product_terms ) ) {
        if ( ! is_wp_error( $product_terms ) ) {
          foreach( $product_terms as $term ) {
            echo '<a href="' . get_term_link( $term->slug, 'historybuilding' ) . '">' . esc_html( $term->name ) . '</a>';
          }
        }
      }
      ?>
    </div>
  </li>
  <li>
    <div class="type"><i class="fa fa-picture-o"></i><?php _e('美術','alterna'); ?></div>
    <div class="value">
      <?php
      $product_terms = wp_get_object_terms( $post->ID,  'historyart' );
      if ( ! empty( $product_terms ) ) {
        if ( ! is_wp_error( $product_terms ) ) {
          foreach( $product_terms as $term ) {
            echo '<a href="' . get_term_link( $term->slug, 'historyart' ) . '">' . esc_html( $term->name ) . '</a>';
          }
        }
      }
      ?>
    </div>
  </li>
</ul>
</div>
<div class="clear"></div>

<!-- <div id="tax_country" class="widget widget_categories">
  <h3 class="widget-title"><span>国別カテゴリ</span></h3>
  <ul>
    <?php
    // wp_list_categories('taxonomy=country&orderby=name&title_li='); ?>
  </ul>
</div>
<div class="clear"></div> -->

