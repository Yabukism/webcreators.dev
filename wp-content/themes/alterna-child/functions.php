<?php
/**
 * alterna child theme functions and definitions
 *
 * @since alterna 9.4
 */
/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 *
 */
add_action( 'init', 'add_sidebar' );
function add_sidebar() {
  register_sidebar( array(
                   'id' => 'history-single',
                   'name' => __( 'History Single', 'alterna','historybuilding' ),
                   'before_widget' => '<div id="%1$s" class="widget %2$s">',
                   'after_widget' => '</div>',
                   'before_title' => '<h3 class="widget-title">',
                   'after_title' => '</h3><div class="line"></div><div class="clear"></div>'
                   ));
}

// show portfolio category link
if(taxonomy_exists('country','era-name','historyart','historybuilding','historypeople','historyformat') && is_tax()) {
  global $alterna_options,$term,$portfolio_default_page_id;

  // show default portfolio page
  $portfolio_default_page_id  = alterna_get_default_portfolio_page();
  $portfolio_page = get_page( $portfolio_default_page_id );

  $output .= '<li><i class="fa fa-chevron-right"></i><a href="'.get_permalink($portfolio_default_page_id).'" title="'.$portfolio_page->post_title.'">'.$portfolio_page->post_title.'</a></li>';
  // show category name
  $output .= '<li><i class="fa fa-chevron-right"></i><span>'.__('Category Archive for "','alterna').$term->name.'"</span></li>';
}

if ( ! function_exists( 'alterna_page_title' ) ) :
/**
 * Get Page Title
 *
 * @since alterna 7.0
 */
function alterna_page_title(){

  if(taxonomy_exists('country','era-name','historyart','historypeople','historyformat','historybuilding') && is_tax()) {
    global $term;
    $output = $term->name;
  }
    return $output;
}
endif;

// ビジュアルエディタ用CSS
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ) {
  $initArray['body_class'] = 'editor-area';
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

// FancyBox
add_filter( 'image_send_to_editor', 'remove_img_attr' );
function remove_img_attr( $html ) {
  $class = 'fancyBox';
  return str_replace( '<a ', '<a class="'. $class. '" ', $html );
}

?>
