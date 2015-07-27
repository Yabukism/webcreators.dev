<?php
/**
 * Template Name: xFilter Template
 *
 * @since alterna 8.0
 */
get_header();

// get page layout
$layout       = alterna_get_page_layout();
$layout_class     = alterna_get_page_layout_class();
?>

<div id="main" class="container">
  <div class="row">
    <div class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">


      <?php
      //カテゴリのリンクを作成する
      $this_url = get_permalink( $post->ID );
      $tax1 = 'country'; //TAX1に自由なタクソノミ名を設定
      $tax2 = 'portfolio_categories'; //TAX2に自由なタクソノミ名を設定
      if ( isset( $_GET[$tax1] ) ) $tax1_get = $_GET[$tax1]; else $tax1_get = 'all'; //URLパラメータを取得
      if ( isset( $_GET[$tax2] ) ) $tax2_get = $_GET[$tax2]; else $tax2_get = 'all'; //URLパラメータを取得
      $tax1_terms = get_terms( $tax1, '&hide_empty=true' );
      if ( $tax1_terms ){
        $current = '';
        if ( $tax1_get == 'all' ) $current = 'current';
        $tax1_term_items = "\t" .'<li><a href="'.$this_url.'?'.$tax1.'=all&'.$tax2.'='.$tax2_get.'" title="View all '.$tax1.'" class="'.$current.'">All '.$tax1.'</a></li>'. "\n";
        foreach( $tax1_terms as $tax1_term ){
          $current = '';
          if ( $tax1_get == $tax1_term->slug ) $current = 'current';
          $tax1_term_items .= "\t" .'<li><a href="'.$this_url.'?'.$tax1.'='.$tax1_term->slug.'&'.$tax2.'='.$tax2_get.'" title="'.$tax1_term->name.'" class="'.$current.'">' .esc_html( $tax1_term->name ). '</a></li>'. "\n";
        }
      }

      $tax1_term_items = '<ul id="tax1">' ."\n". $tax1_term_items. '</ul>' ."\n";
      echo $tax1_term_items;
      $tax2_terms = get_terms( $tax2, '&hide_empty=true' );
      if ( $tax2_terms ){
        $current = '';
        if ( $tax2_get == 'all' ) $current = 'current';
        $tax2_term_items = "\t" .'<li><a href="'.$this_url.'?'.$tax1.'='.$tax1_get.'&'.$tax2.'=all" title="View all '.$tax2.'" class="'.$current.'">All '.$tax2.'</a></li>'. "\n";
        foreach( $tax2_terms as $tax2_term ){
          $current = '';
          if ( $tax2_get == $tax2_term->slug ) $current = 'current';
          $tax2_term_items .= "\t" .'<li><a href="'.$this_url.'?'.$tax1.'='.$tax1_get.'&'.$tax2.'='.$tax2_term->slug.'" title="'.$tax2_term->name.'" class="'.$current.'">' .esc_html( $tax2_term->name ). '</a></li>'. "\n";
        }
      }
      $tax2_term_items = '<ul id="tax2">' ."\n". $tax2_term_items. '</ul>' ."\n";
      echo $tax2_term_items;
      //tax_Queryにパラメータを代入
      $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
      $args = array(
    'post_type' => 'portfolio', //自由なポストタイプを設定
    'paged' => $paged,
    );
      if ( $tax1_get !== 'all' ) {
        $tax1_arg = array(
                          'taxonomy' => $tax1,
                          'field' => 'slug',
                          'terms' => $tax1_get,
                          );
      } else {
        $tax1_arg = '';
      }
      if ( $tax2_get !== 'all' ) {
        $tax2_arg = array(
                          'taxonomy' => $tax2,
                          'field' => 'slug',
                          'terms' => $tax2_get,
                          );
      } else {
        $tax2_arg = '';
      }
      if ( !empty($tax1_arg) || !empty($tax2_arg) ){
        $args['tax_query'] = array(
                                   $tax1_arg, $tax2_arg
                                   );
      }
  //クエリを出力
      $wp_query = new WP_Query();
      $wp_query->query( $args );

      while ( $wp_query->have_posts() ) : $wp_query->the_post();
      ?>

      <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">

        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <h2><?php the_title(); ?></h2></a>
          <div class="excerpt"><?php the_excerpt( ); ?></div>
        </section>
      <?php endwhile; ?>

    </div>
    <?php if($layout != 1) { ?>
    <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar(); ?></aside>
    <?php } ?>

  </div>
</div>

<?php get_footer(); ?>
