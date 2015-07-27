<?php
/**
 * Page Header Slider
 * 
 * @since alterna 7.0
 */

global $post_id;

if(!(is_category()|| is_tag() || is_404() || is_search() || is_date()) && intval(penguin_get_post_meta_key('slide-type', $post_id)) != 0){
	if(intval(penguin_get_post_meta_key('slide-type', $post_id)) == 1 && intval(penguin_get_post_meta_key('layer-slide-id', $post_id)) != 0){
?>
	<div id="layerslide-container" class="page-slider-container">
		<?php echo do_shortcode('[layerslider id="'.(intval(penguin_get_post_meta_key('layer-slide-id', $post_id))).'"]'); ?>
	</div>
<?php }elseif(intval(penguin_get_post_meta_key('slide-type', $post_id)) == 2 && intval(penguin_get_post_meta_key('rev-slide-id', $post_id )) != 0){?>
	<div id="revslide-container" class="page-slider-container">
		<?php echo do_shortcode('[rev_slider '.(intval(penguin_get_post_meta_key('rev-slide-id', $post_id))).']'); ?>
    </div>
<?php }
}
?>