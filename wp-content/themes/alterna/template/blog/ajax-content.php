<?php
/**
 * Blog Ajax Main Content
 *
 * @since alterna 7.0
 */
 
global $paged, $page_nums, $page_cats, $page_columns, $page_columns_class, $thumbnail_size, $page_auto_load, $page_item_style, $page_image_no_crop, $page_ajax_link;

// get show columns
$page_columns = isset($page_columns) ? intval($page_columns) : 1;
// get show item number
$page_nums = isset($page_nums) ? intval($page_nums) : 10;
// get item categories
$page_cats = isset($page_cats) ? esc_attr($page_cats) : "";
// get ajax style
$page_item_style = isset($page_item_style) ? (intval($page_item_style) + 1) : 1;
$page_columns_class = alterna_get_element_columns(intval($page_columns));
$thumbnail_size = alterna_get_thumbnail_size(intval($page_columns), $page_image_no_crop);

if($paged == 0){$paged = 1;}
                        
$args = array(	'post_type' => 'post',
				'post_status' => 'publish',
				'paged' => $paged,
				'posts_per_page'=> $page_nums
			 );
			 
if($page_cats != "") {
	$cats = explode("," , $page_cats);
	if(count($cats) > 0 && $cats[0] != "" ) {
		$args['category__in'] = $cats;
	}
}
// The Query
$blog_posts = new WP_Query($args);
if ( $blog_posts->have_posts() ) {
?>
<div class="ajax-main-area">
    <section class="ajax-isotope row blog-ajax-type">
		<?php 
        	while ( $blog_posts->have_posts() ) {
				$blog_posts->the_post();
				get_template_part( 'template/blog/ajax/content-style', $page_item_style); ?>
    	<?php } ?>
    </section>
    <?php 
		if($blog_posts->max_num_pages > $paged) {
	?>
    <div class="ajax-load-content" data-link="<?php echo (isset($page_ajax_link) && $page_ajax_link != "" ? esc_url($page_ajax_link) : esc_url(get_pagenum_link($paged+1))) ;?>" data-page="<?php echo esc_attr($paged+1); ?>" data-max="<?php echo esc_attr($blog_posts->max_num_pages); ?>"></div>
    <div class="ajax-load-btn-container row">
    	<?php if($page_auto_load != "on"){ ?>
    	<a class="post-ajax-load-btn btn btn-theme float-btn btn-lg"><span><i class="fa fa-refresh"></i></span><?php echo __('Click Load More ...','alterna'); ?></a>
        <?php }else{ ?>
        <span class="post-ajax-scroll-load"><i class="fa fa-arrow-down"></i></span>
        <?php } ?>
        <span class="post-ajax-loading"><i class="fa fa-spinner fa-spin"></i><?php echo __('Load ...','alterna'); ?></span>
   	</div>
    <?php } ?>
</div>
<?php
}
wp_reset_postdata();
?>