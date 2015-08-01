<?php
/**
 * Blog Ajax Category Content
 *
 * @since alterna 8.4
 */

get_header(); 
	
global $blog_page_id, $paged, $page_columns_class, $thumbnail_size;

$layout				=	alterna_get_page_layout($blog_page_id);
$layout_class 		=	alterna_get_page_layout_class($blog_page_id);
$sidebar_name		=	penguin_get_post_meta_key('sidebar-type', $blog_page_id);
$page_columns		=	intval(penguin_get_post_meta_key('page-posts-cols', $blog_page_id));
$page_item_style	=	intval(penguin_get_post_meta_key('blog-ajax-show-type', $blog_page_id, 0)) + 1;
$page_auto_load		=	penguin_get_post_meta_key('page-posts-ajax-auto', $blog_page_id);
$page_image_no_crop	=	penguin_get_post_meta_key('page-posts-img-no-crop', $blog_page_id);

$page_columns_class = alterna_get_element_columns(intval($page_columns));
$thumbnail_size = alterna_get_thumbnail_size(intval($page_columns), $page_image_no_crop);
?>
<div id="main" class="container">
	<div class="row">
        <section class="<?php echo $layout == 1 ? 'col-md-12 col-sm-12' : 'alterna-col col-lg-9 col-md-8 col-sm-8 alterna-'.$layout_class; ?>">
			<div class="ajax-main-area">
                <section class="ajax-isotope row blog-ajax-type">
                    <?php 
                        while ( have_posts() ) {
                            the_post();
                            get_template_part( 'template/blog/ajax/content-style', $page_item_style); ?>
                    <?php } ?>
                </section>
                <?php 
                    if($wp_query->max_num_pages > $paged) {
                ?>
                <div class="ajax-load-content" data-link="<?php echo (isset($page_ajax_link) && $page_ajax_link != "" ? esc_url($page_ajax_link) : esc_url(get_pagenum_link($paged+1))) ;?>" data-page="<?php echo esc_attr($paged+1); ?>" data-max="<?php echo esc_attr($wp_query->max_num_pages); ?>"></div>
                <div class="ajax-load-btn-container row">
                    <?php if($page_auto_load != "on"){ ?>
                    <a class="post-ajax-load-btn btn btn-theme btn-lg"><?php echo __('Click Load More ...','alterna'); ?></a>
                    <?php }else{ ?>
                    <span class="post-ajax-scroll-load"><i class="fa fa-arrow-down"></i></span>
                    <?php } ?>
                    <span class="post-ajax-loading"><i class="fa fa-spinner fa-spin"></i><?php echo __('Load ...','alterna'); ?></span>
                </div>
                <?php } ?>
            </div>
		</section>
		<?php if($layout != 1) { ?> 
            <aside class="alterna-col col-lg-3 col-md-4 col-sm-4 alterna-<?php echo $layout_class;?>"><?php generated_dynamic_sidebar($sidebar_name); ?></aside>
            <?php } ?>
    </div>
</div>
<?php get_footer(); ?>