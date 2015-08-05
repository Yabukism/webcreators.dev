<?php

// ビジュアルエディタ用CSS
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ) {
  $initArray['body_class'] = 'editor-area';
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
// FancyBox
function remove_img_attr( $html ) {
  $class = 'fancyBox';
  return str_replace( '<a ', '<a class="'. $class. '" ', $html );
}
add_filter( 'image_send_to_editor', 'remove_img_attr' );

// Caption image size
add_shortcode('caption', 'my_img_caption_shortcode');
function my_img_caption_shortcode($attr, $content = null) {
  if ( ! isset( $attr['caption'] ) ) {
    if ( preg_match( '#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches ) ) {
      $content = $matches[1];
      $attr['caption'] = trim( $matches[2] );
    }
  }
  $output = apply_filters('img_caption_shortcode', '', $attr, $content);
  if ( $output != '' )
    return $output;
  extract(shortcode_atts(array(
    'id'  => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  ), $attr, 'caption'));
  if ( 1 > (int) $width || empty($caption) )
    return $content;
  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
  return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
// Sidebar
if ( ! function_exists( 'child_theme_setup' ) ):
function child_theme_setup() {
    // ダイナミックサイドバーの定義を子テーマのものに入れ替える
    remove_action( 'widgets_init', 'alterna_widgets_init' );
    add_action( 'widgets_init', 'alterna_widgets_init_child' );
}
endif;
add_action( 'after_setup_theme', 'child_theme_setup' );
function alterna_widgets_init_child(){
  register_sidebar( array(
    'id' => 'sidebar-1',
    'name' => __( 'Global Sidebar', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  ));
  register_sidebar( array(
    'id'  =>'sidebar-footer-1',
    'name' => __( 'Footer 1', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
  ));
  register_sidebar( array(
    'id'  =>'sidebar-footer-2',
    'name' => __( 'Footer 2', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
  ));

  register_sidebar( array(
    'id'  =>'sidebar-footer-3',
    'name' => __( 'Footer 3', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
  ));

  register_sidebar( array(
    'id'  =>'sidebar-footer-4',
    'name' => __( 'Footer 4', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4><div class="line"></div><div class="clear"></div>'
  ));
  register_sidebar( array(
    'id' => 'sidebar-2',
    'name' => __( 'Portfolio page', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  ));
  register_sidebar( array(
    'id' => 'sidebar-3',
    'name' => __( 'NonSNS', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  ));
  register_sidebar( array(
    'id' => 'sidebar-4',
    'name' => __( 'Single Portfolio', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  ));
  register_sidebar( array(
    'id' => 'sidebar-5',
    'name' => __( 'Footnote', 'alterna' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  ));
}
?>
