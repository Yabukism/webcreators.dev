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
?>
