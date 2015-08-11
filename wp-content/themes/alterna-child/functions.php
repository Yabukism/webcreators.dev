<?php

// ビジュアルエディタ用CSS
add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ) {
  $initArray['body_class'] = 'editor-area';
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
// FancyBox
function add_fancyBox_class( $html, $id = '', $caption = '', $title = '', $align = '', $url = '', $size = '', $alt = '' ) {
    return str_replace( '><img src', ' class="fancyBox"><img src', $html );
}
add_filter( 'image_send_to_editor', 'add_fancyBox_class' );
// Custom post type ping
function portfolio_pings_at_publish( $post_id ) {
    wp_schedule_single_event( strtotime( '+10 min' ), 'do_pings', array( $post_id ) );
}
add_action( 'publish_portfolio', 'portfolio_pings_at_publish', 10, 1 );


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
// add_action('init', 'my_custom_init');
// function my_custom_init() {
//     add_post_type_support( 'portfolio', 'publicize' );
// }
?>
